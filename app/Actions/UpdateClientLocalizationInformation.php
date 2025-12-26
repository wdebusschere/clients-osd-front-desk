<?php

namespace App\Actions;

use App\Contracts\UpdatesClientLocalizationInformation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdateClientLocalizationInformation implements UpdatesClientLocalizationInformation
{
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'preferred_language' => ['required', Rule::in(config('app.available_locales')),],
        ])->validateWithBag('updateLocalizationInformation');

        $user->forceFill([
            'preferred_language' => $input['preferred_language'],
        ])->save();
    }
}
