<?php

namespace App\View\Composers\Selectors;

use App\Models\RecipientType;
use Illuminate\View\View;

class RecipientTypesOptionsComposer
{
    public function compose(View $view): void
    {
        $recipientTypesOptions = RecipientType::pluck('name', 'id')->toArray();

        $view->with('recipientTypesOptions', $recipientTypesOptions);
    }
}
