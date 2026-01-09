<?php

namespace App\View\Composers\Selectors;

use App\Models\Location;
use Illuminate\View\View;

class LocationsOptionsComposer
{
    public function compose(View $view): void
    {
        $locationsOptions = Location::pluck('name', 'id')->toArray();

        $view->with('locationsOptions', $locationsOptions);
    }
}
