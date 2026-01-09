<?php

namespace App\Livewire\Ui;

use App\Models\Activity;
use App\Models\DeliveryReceipt;
use App\Models\Location;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class NavigationMenu extends Component
{
    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $menuItems = $this->getMenuItems()
            ->map(function ($menuItem) {
                if (isset($menuItem->items)) {
                    $menuItem->active = $menuItem->items->where('active', true)->count();

                    $menuItem->items = $menuItem->items->where('can', true);
                }

                return $menuItem;
            })
            ->filter(function ($menuItem) {
                if (isset($menuItem->items)) {
                    return $menuItem->items->count();
                }

                if (isset($menuItem->can)) {
                    return $menuItem->can === true;
                }

                return true;
            });

        return view('livewire.ui.navigation-menu')
            ->with([
                'menuItems' => $menuItems
            ]);
    }

    protected function getMenuItems(): Collection
    {
        return collect([
            (object) [
                'label' => trans('app.dashboard'),
                'icon' => 'icons.outline.home',
                'route' => route('dashboard'),
                'active' => request()->routeIs('dashboard'),
                'can' => true,
            ],
            (object) [
                'label' => trans_choice('app.delivery_receipts', 0),
                'icon' => 'icons.outline.truck',
                'route' => route('delivery-receipts.index'),
                'active' => request()->routeIs('delivery-receipts.*'),
                'can' => auth()->user()->can('viewAny', DeliveryReceipt::class),
            ],
            (object) [
                'label' => trans_choice('app.users', 0),
                'icon' => 'icons.outline.users',
                'route' => route('users.index'),
                'active' => request()->routeIs('users.*'),
                'can' => auth()->user()->can('viewAny', User::class),
            ],
            (object) [
                'label' => trans_choice('app.options', 0),
                'icon' => 'icons.outline.cog-6-tooth',
                'items' => collect([
                    (object) [
                        'label' => trans_choice('app.locations', 0),
                        'route' => route('locations.index'),
                        'active' => request()->routeIs('locations.*'),
                        'can' => auth()->user()->can('viewAny', Location::class),
                    ],
                ])
            ],
            (object) [
                'label' => trans_choice('app.system', 0),
                'icon' => 'icons.outline.shield-check',
                'items' => collect([
                    (object) [
                        'label' => trans_choice('app.roles', 0),
                        'route' => route('roles.index'),
                        'active' => request()->routeIs('roles.*'),
                        'can' => auth()->user()->can('viewAny', Role::class),
                    ],
                    (object) [
                        'label' => trans_choice('app.activity_logs', 0),
                        'route' => route('activity-logs.index'),
                        'active' => request()->routeIs('activity-logs.*'),
                        'can' => auth()->user()->can('viewAny', Activity::class),
                    ],
                ])
            ],
        ]);
    }
}
