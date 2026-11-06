<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AccountFormsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        Storage::fake('public');
    }

    public function test_create_and_prefilled_edit_forms_are_available(): void
    {
        $this->get('/customers/create')->assertOk()->assertSee('Create Customer')->assertSee('name="_token"', false);
        $this->get('/users/create')->assertOk()->assertSee('Create User');
        $this->get('/customers/1/edit')->assertOk()->assertSee('Mika Santos')->assertSee('mika.santos@example.com');
        $this->get('/users/1/edit')->assertOk()->assertSee('Angel Tolentino')->assertSee('value="admin"', false)
            ->assertSee('multipart/form-data')->assertSee('name="avatar"', false);
    }

    public function test_customer_can_be_created_and_edited(): void
    {
        $this->post('/customers', ['full_name' => 'New Customer', 'email' => 'new@example.com', 'phone' => '09123456789'])
            ->assertRedirect('/customers')->assertSessionHas('success');
        $customer = Customer::where('email', 'new@example.com')->firstOrFail();
        $this->assertNotEmpty($customer->customer_code);
        $this->patch('/customers/'.$customer->id, ['full_name' => 'Updated Customer', 'email' => 'new@example.com', 'phone' => null])
            ->assertRedirect('/customers');
        $this->assertDatabaseHas('customers', ['id' => $customer->id, 'full_name' => 'Updated Customer', 'phone' => null]);
    }

    public function test_customer_validation_preserves_input_without_inserting(): void
    {
        $this->from('/customers/create')->post('/customers', ['full_name' => 'Retained Name', 'email' => 'invalid'])
            ->assertRedirect('/customers/create')->assertSessionHasErrors('email')
            ->assertSessionHasInput('full_name', 'Retained Name');
        $this->assertDatabaseCount('customers', 6);
        $this->get('/customers/create')->assertSee('Retained Name')->assertSee('Please correct');
        $this->post('/customers', [])->assertSessionHasErrors(['full_name', 'email']);
        $this->post('/customers', ['full_name' => 'Duplicate', 'email' => 'mika.santos@example.com'])
            ->assertSessionHasErrors('email');
    }

    public function test_user_can_be_created_and_updated_with_same_username(): void
    {
        $this->post('/users', ['username' => 'new.staff', 'full_name' => 'New Staff'])
            ->assertRedirect('/users')->assertSessionHas('success');
        $user = User::where('username', 'new.staff')->firstOrFail();
        $this->assertNull($user->avatar);
        $this->assertNotEmpty($user->staff_code);
        $this->get('/users')->assertSee('images/avatar-placeholder.svg');
        $this->patch('/users/'.$user->id, ['username' => 'new.staff', 'full_name' => 'Updated Staff'])
            ->assertRedirect('/users');
        $this->assertDatabaseHas('users', ['id' => $user->id, 'full_name' => 'Updated Staff']);
    }

    public function test_required_unique_and_length_rules_reject_invalid_users(): void
    {
        $this->post('/users', [])->assertSessionHasErrors(['username', 'full_name']);
        $this->post('/users', ['username' => 'admin', 'full_name' => 'Duplicate'])->assertSessionHasErrors('username');
        $this->patch('/users/2', ['username' => 'admin', 'full_name' => 'Sofia'])->assertSessionHasErrors('username');
        $this->post('/users', ['username' => str_repeat('x', 51), 'full_name' => str_repeat('x', 101)])
            ->assertSessionHasErrors(['username', 'full_name']);
        $this->assertDatabaseCount('users', 6);
    }

    public function test_upload_is_prepared_as_a_300_pixel_jpeg_and_path_only_is_saved(): void
    {
        $this->patch('/users/1', [
            'username' => 'admin', 'full_name' => 'Angel Tolentino',
            'avatar' => UploadedFile::fake()->image('original.png', 720, 480),
        ])->assertRedirect('/users');
        $path = User::findOrFail(1)->avatar;
        $this->assertMatchesRegularExpression('/^avatars\\/[a-f0-9-]{36}\\.jpg$/', $path);
        Storage::disk('public')->assertExists($path);
        $image = getimagesize(Storage::disk('public')->path($path));
        $this->assertSame(300, $image[0]);
        $this->assertSame(300, $image[1]);
        $this->assertSame('image/jpeg', $image['mime']);
        $this->get('/users')->assertSee('storage/'.$path);
    }

    public function test_replacement_deletes_only_the_previous_managed_upload(): void
    {
        foreach (['first.jpg', 'second.png'] as $filename) {
            $oldPath = User::findOrFail(1)->avatar;
            $this->patch('/users/1', [
                'username' => 'admin', 'full_name' => 'Angel Tolentino',
                'avatar' => UploadedFile::fake()->image($filename, 400, 500),
            ])->assertRedirect('/users');
            if (str_starts_with($oldPath, 'avatars/')) {
                Storage::disk('public')->assertMissing($oldPath);
            }
        }
        $this->assertFileExists(public_path('images/users/angel-tolentino.jpg'));
        $this->assertCount(1, Storage::disk('public')->files('avatars'));
    }

    public function test_invalid_oversized_and_svg_uploads_keep_the_existing_photo(): void
    {
        $oldPath = User::findOrFail(1)->avatar;
        $files = [
            UploadedFile::fake()->create('not-image.txt', 10, 'text/plain'),
            UploadedFile::fake()->image('large.jpg')->size(2049),
            UploadedFile::fake()->createWithContent('unsafe.svg', '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>'),
        ];
        foreach ($files as $file) {
            $this->from('/users/1/edit')->patch('/users/1', [
                'username' => 'admin', 'full_name' => 'Retained Name', 'avatar' => $file,
            ])->assertRedirect('/users/1/edit')->assertSessionHasErrors('avatar')
                ->assertSessionHasInput('full_name', 'Retained Name');
            $this->assertSame($oldPath, User::findOrFail(1)->avatar);
        }
        $this->assertCount(0, Storage::disk('public')->allFiles());
    }

    public function test_edit_without_a_new_photo_preserves_existing_avatar(): void
    {
        $oldPath = User::findOrFail(1)->avatar;
        $this->patch('/users/1', ['username' => 'admin', 'full_name' => 'Angel Updated'])
            ->assertRedirect('/users');
        $this->assertSame($oldPath, User::findOrFail(1)->avatar);
    }

    public function test_unvalidated_fields_cannot_change_account_codes_or_roles(): void
    {
        $this->patch('/users/1', ['username' => 'admin', 'full_name' => 'Angel', 'role' => 'Injected', 'staff_code' => 'Changed'])
            ->assertRedirect('/users');
        $this->assertDatabaseHas('users', ['id' => 1, 'role' => 'Administrator', 'staff_code' => 'U-001']);
    }

    public function test_missing_accounts_return_404(): void
    {
        $this->get('/users/999999/edit')->assertNotFound();
        $this->get('/customers/999999/edit')->assertNotFound();
        $this->patch('/users/999999', [])->assertNotFound();
        $this->patch('/customers/999999', [])->assertNotFound();
    }
}
