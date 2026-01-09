<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class LocationController extends Controller
{
    public function index(): View
    {
        Gate::authorize('viewAny', Location::class);

        return view('modules.locations.index');
    }

    public function create(): View
    {
        Gate::authorize('create', Location::class);

        return view('modules.locations.create');
    }

    public function store(LocationRequest $request): RedirectResponse
    {
        Gate::authorize('create', Location::class);

        $validatedData = $request->validated();

        Location::create($validatedData);

        session()->flash('flash.banner', trans('crud.record_created_success'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('locations.index');
    }

    public function edit(Location $location): View
    {
        Gate::authorize('update', $location);

        return view('modules.locations.edit', compact('location'));
    }

    public function update(LocationRequest $request, Location $location): RedirectResponse
    {
        Gate::authorize('update', $location);

        $validatedData = $request->validated();

        $location->update($validatedData);

        session()->flash('flash.banner', trans('crud.record_updated_success'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('locations.index');
    }

    public function destroy(Location $location): RedirectResponse
    {
        Gate::authorize('delete', $location);

        try {
            $location->delete();

            $message = trans('crud.record_deleted_success');

            $type = 'success';
        } catch (\Exception $exception) {
            $message = trans('crud.record_deleted_failure');

            $type = 'danger';
        }

        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $type);

        return redirect()->route('locations.index');
    }
}
