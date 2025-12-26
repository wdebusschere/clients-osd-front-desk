<?php

namespace App\Console\Commands\Users;

use App\Repositories\HQ\ClientApplicationRepository;
use App\Repositories\UserRepository;
use Illuminate\Console\Command;

class ImportFromHQ extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:import-from-hq';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from OSD HQ';

    /**
     * Execute the console command.
     */
    public function handle(
        ClientApplicationRepository $clientApplicationRepository,
        UserRepository $userRepository
    ) {
        $users = $clientApplicationRepository->users();

        foreach ($users as $user) {
            $userRepository->findByHQIdOrCreate($user);
        }
    }
}
