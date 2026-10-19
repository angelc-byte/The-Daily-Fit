<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_all_required_pages_are_available(): void
    {
        $this->get('/')->assertOk()->assertSee('Style that feels like you.');
        $this->get('/about')->assertOk()->assertSee('Getting dressed should feel simple.');
        $this->get('/customers')->assertOk()->assertSee('Customer Accounts')->assertSee('Mika Santos');
        $this->get('/users')->assertOk()->assertSee('User Accounts')->assertSee('Angel Tolentino');
    }

    public function test_account_pages_render_all_seeded_records(): void
    {
        $this->get('/customers')->assertSee('C-1001')->assertSee('C-1006');
        $this->get('/users')->assertSee('U-001')->assertSee('U-006');
    }

    public function test_seeders_are_repeatable_without_duplicate_accounts(): void
    {
        $this->seed();
        $this->assertDatabaseCount('customers', 6);
        $this->assertDatabaseCount('users', 6);
        $this->assertDatabaseHas('customers', ['full_name' => 'Mika Santos']);
        $this->assertDatabaseHas('users', ['username' => 'admin', 'full_name' => 'Angel Tolentino']);
    }

    public function test_pages_display_database_changes_and_escape_names(): void
    {
        Customer::where('customer_code', 'C-1001')->firstOrFail()
            ->update(['full_name' => '<script>Database customer</script>']);
        User::where('username', 'admin')->firstOrFail()
            ->update(['full_name' => 'Database staff']);

        $this->get('/customers')->assertOk()->assertSee('<script>Database customer</script>')
            ->assertDontSee('<script>Database customer</script>', false);
        $this->get('/users')->assertOk()->assertSee('Database staff');
    }

    public function test_username_must_be_unique(): void
    {
        $this->expectException(QueryException::class);
        User::factory()->create(['username' => 'admin']);
    }

    public function test_account_pages_work_without_records(): void
    {
        Customer::query()->delete();
        User::query()->delete();
        $this->get('/customers')->assertOk()->assertDontSee('Mika Santos');
        $this->get('/users')->assertOk()->assertDontSee('Angel Tolentino');
    }
}
