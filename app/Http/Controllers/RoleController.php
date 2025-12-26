<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        if (request()->user()->cannot('viewAny', Role::class)) {
            abort(403);
        }

        return view('modules.roles.index');
    }

    public function create(): View
    {
        if (request()->user()->cannot('create', Role::class)) {
            abort(403);
        }

        return view('modules.roles.create');
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        if (request()->user()->cannot('create', Role::class)) {
            abort(403);
        }

        $validatedData = $request->validated();

        DB::transaction(function () use ($validatedData) {
            $roleData = array_merge($validatedData, ['guard_name' => 'web']);

            $role = Role::create($roleData);

            $parsedIds = array_map('intval', $validatedData['permissions'] ?? []);

            $role->givePermissionTo($parsedIds);
        });

        session()->flash('flash.banner', trans('crud.record_created_success'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('roles.index');
    }

    public function edit(Role $role): View
    {
        if (request()->user()->cannot('update', $role)) {
            abort(403);
        }

        return view('modules.roles.edit', compact('role'));
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        if (request()->user()->cannot('update', $role)) {
            abort(403);
        }

        $validatedData = $request->validated();

        $role->update($validatedData);

        $parsedIds = array_map('intval', $validatedData['permissions'] ?? []);

        $role->syncPermissions($parsedIds);

        session()->flash('flash.banner', trans('crud.record_updated_success'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if (request()->user()->cannot('delete', $role)) {
            abort(403);
        }

        try {
            $role->delete();

            $message = trans('crud.record_deleted_success');

            $type = 'success';
        } catch (\Exception $exception) {
            $message = trans('crud.record_deleted_failure');

            $type = 'danger';
        }

        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $type);

        return redirect()->route('roles.index');
    }
}
