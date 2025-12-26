<?php

namespace App\Livewire\Profile;

use App\Contracts\UpdatesClientLocalizationInformation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateLocalizationInformationForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];

    public function mount()
    {
        $user = Auth::user();

        $this->state = [
            'preferred_language' => $user->preferred_language,
        ];
    }

    public function updateLocalizationInformation(UpdatesClientLocalizationInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(Auth::user(), $this->state);

        $this->dispatch('saved');

        return redirect()->route('profile.show');
    }

    public function render()
    {
        return view('livewire.profile.update-localization-information-form');
    }

}
