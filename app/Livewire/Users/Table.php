<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Repositories\HQ\ClientApplicationRepository;
use App\Repositories\UserRepository;
use App\Traits\Livewire\TableFeatures;
use Livewire\Attributes\Url;
use Livewire\Component;

class Table extends Component
{
    use TableFeatures;

    #[Url]
    public $roleId = '';

    #[Url]
    public $active = 1;

    public int $importedUsersCount;

    public function updated()
    {
        $this->resetPage();
    }

    public function importFromHQ(
        ClientApplicationRepository $clientApplicationRepository,
        UserRepository $userRepository
    ) {
        $this->authorize('importFromHQ', User::class);

        $this->reset('importedUsersCount');

        $users = $clientApplicationRepository->users();

        $beforeImportUsersCount = User::count();

        foreach ($users as $user) {
            $userRepository->findByHQIdOrCreate($user);
        }

        $afterImportUsersCount = User::count();

        $this->importedUsersCount = $afterImportUsersCount - $beforeImportUsersCount;
    }

    public function toggleActiveState(User $user)
    {
        $this->authorize('update', $user);

        $user->active = ! $user->active;
        $user->save();
    }

    public function render()
    {
        $users = User::with('roles')
            ->search($this->search);

        if (in_array($this->active, [0, 1])) {
            $users->whereActive($this->active);
        }

        if (! empty($this->roleId)) {
            $users->whereHas('roles', function ($query) {
                $query->where('id', $this->roleId);
            });
        }

        foreach ($this->order as $attribute => $direction) {
            $users->orderBy($attribute, $direction);
        }

        return view(
            'livewire.users.table',
            [
                'users' => $users->paginate($this->perPage)
            ]
        );
    }
}
