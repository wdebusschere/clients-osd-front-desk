<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryReceiptRequest;
use App\Models\DeliveryReceipt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class DeliveryReceiptController extends Controller
{
    public function index(): View
    {
        Gate::authorize('viewAny', DeliveryReceipt::class);

        return view('modules.delivery-receipts.index');
    }

    public function create(): View
    {
        Gate::authorize('create', DeliveryReceipt::class);

        return view('modules.delivery-receipts.create');
    }

    public function store(DeliveryReceiptRequest $request): RedirectResponse
    {
        Gate::authorize('create', DeliveryReceipt::class);

        $validatedData = $request->validated();

        $deliveryReceipt = auth()->user()->deliveryReceipts()->create($validatedData);

        if (isset($validatedData['photo'])) {
            $deliveryReceipt->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return to_route('delivery-receipts.index')->banner(trans('crud.record_created_success'));
    }

    public function show(DeliveryReceipt $deliveryReceipt): View
    {
        Gate::authorize('view', $deliveryReceipt);

        return view('modules.delivery-receipts.show', compact('deliveryReceipt'));
    }

    public function edit(DeliveryReceipt $deliveryReceipt): View
    {
        Gate::authorize('update', $deliveryReceipt);

        return view('modules.delivery-receipts.edit', compact('deliveryReceipt'));
    }

    public function update(DeliveryReceiptRequest $request, DeliveryReceipt $deliveryReceipt): RedirectResponse
    {
        Gate::authorize('update', $deliveryReceipt);

        $validatedData = $request->validated();

        $deliveryReceipt->update($validatedData);

        if (isset($validatedData['photo'])) {
            $deliveryReceipt->addMediaFromRequest('photo')->toMediaCollection('photo');
        }

        return to_route('delivery-receipts.index')->banner(trans('crud.record_updated_success'));
    }

    public function destroy(DeliveryReceipt $deliveryReceipt): RedirectResponse
    {
        Gate::authorize('delete', $deliveryReceipt);

        try {
            $deliveryReceipt->delete();

            $message = trans('crud.record_deleted_success');

            $type = 'success';
        } catch (\Exception $exception) {
            $message = trans('crud.record_deleted_failure');

            $type = 'danger';
        }

        session()->flash('flash.banner', $message);
        session()->flash('flash.bannerStyle', $type);

        return redirect()->route('delivery-receipts.index');
    }
}
