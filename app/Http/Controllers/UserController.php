<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\AvatarService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->orderBy('staff_code')->get();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.form', ['user' => new User]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        User::create($request->safe()->only(['username', 'full_name']) + [
            'staff_code' => 'U-'.strtoupper(bin2hex(random_bytes(8))),
        ]);

        return redirect()->route('users.index')->with('success', 'User account created successfully. You can now edit it to add a profile photo.');
    }

    public function edit(User $user): View
    {
        return view('users.form', compact('user'));
    }

    public function update(UserRequest $request, User $user, AvatarService $avatars): RedirectResponse
    {
        $data = $request->safe()->only(['username', 'full_name']);
        $oldPath = $user->avatar;
        $newPath = null;

        if ($request->hasFile('avatar')) {
            $newPath = $avatars->store($request->file('avatar'));
            $data['avatar'] = $newPath;
        }

        try {
            $user->update($data);
        } catch (Throwable $exception) {
            $avatars->deleteUpload($newPath);
            throw $exception;
        }

        if ($newPath) {
            $avatars->deleteUpload($oldPath);
        }

        return redirect()->route('users.index')->with('success', 'User account updated successfully.');
    }
}
