<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipientTypeRequest;
use App\Models\RecipientType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class RecipientTypeController extends Controller
{
    public function index(): View
    {
        Gate::authorize('viewAny', RecipientType::class);

        return view('modules.recipient-types.index');
    }

    public function create(): View
    {
        Gate::authorize('create', RecipientType::class);

        return view('modules.recipient-types.create');
    }

    public function store(RecipientTypeRequest $request): RedirectResponse
    {
        Gate::authorize('create', RecipientType::class);

        $validatedData = $request->validated();

        RecipientType::create($validatedData);

        session()->flash('flash.banner', trans('crud.record_created_success'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('recipient-types.index');
    }

    public function edit(RecipientType $recipientType): View
    {
        Gate::authorize('update', $recipientType);

        return view('modules.recipient-types.edit', compact('recipientType'));
    }

    public function update(RecipientTypeRequest $request, RecipientType $recipientType): RedirectResponse
    {
        Gate::authorize('update', $recipientType);

        $validatedData = $request->validated();

        $recipientType->update($validatedData);

        session()->flash('flash.banner', trans('crud.record_updated_success'));
        session()->flash('flash.bannerStyle', 'success');

        return redirect()->route('recipient-types.index');
    }

    public function destroy(RecipientType $recipientType): RedirectResponse
    {
        Gate::authorize('delete', $recipientType);

        try {
            $recipientType->delete();

            $message = trans('crud.record_deleted_success');

            $type = 'success';
        } catch (\Exception $exception) {
            $message = trans('crud.record_deleted_failure');

            $type = 'danger';
        }

        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $type);

        return redirect()->route('recipient-types.index');
    }
}
