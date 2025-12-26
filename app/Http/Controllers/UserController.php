<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        if (request()->user()->cannot('viewAny', User::class)) {
            abort(403);
        }

        return view('modules.users.index');
    }

    public function edit(User $user): View
    {
        if (request()->user()->cannot('update', $user)) {
            abort(403);
        }

        return view('modules.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        if (request()->user()->cannot('update', $user)) {
            abort(403);
        }

        $validatedData = $request->validated();

        $user->update($validatedData);

        $user->roles()->sync($validatedData['role_id']);

        session()->flash('flash.banner', trans('crud.record_updated_success'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('users.index');
    }
}
