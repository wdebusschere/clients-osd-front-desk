<?php

namespace App\View\Composers\Selectors;

use App\Models\User;
use Illuminate\View\View;

class UsersOptionsComposer
{
    public function compose(View $view): void
    {
        $usersOptions = User::pluck('name', 'id')->toArray();

        $view->with('usersOptions', $usersOptions);
    }
}
