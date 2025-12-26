<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserRepository
{
    public function findByHQIdOrCreate($osdUser)
    {
        return DB::transaction(function () use ($osdUser) {
            $user = User::firstOrCreate(
                [
                    'osd_hq_id' => $osdUser['id']
                ],
                [
                    'name' => $osdUser['name'],
                    'email' => $osdUser['email'],
                    'preferred_language' => config('app.locale'),
                ]
            );

            if ($user->wasRecentlyCreated) {
                // Profile photo
                $avatar = $osdUser['avatar'];

                $imageName = null;

                if (! empty($avatar)) {
                    try {
                        $imageContents = Http::get($avatar)->body();

                        $path = parse_url($avatar, PHP_URL_PATH);

                        $extension = pathinfo($path, PATHINFO_EXTENSION);

                        $imageName = 'profile-photos/'.Str::random(40).'.'.$extension;

                        Storage::disk('public')->put($imageName, $imageContents);
                    } catch (\Exception $e) {
                        //
                    }
                }

                // Assign roles
                $isAdmin = collect($osdUser['roles'])
                    ->contains(function ($role) {
                        return $role['name'] === 'Administrator';
                    });

                $user->assignRole($isAdmin ? 'admin' : 'employee');

                // Set additional non fillable data
                $user->forceFill([
                    'osd_hq_id' => $osdUser['id'],
                    'email_verified_at' => now(),
                    'profile_photo_path' => $imageName,
                    'active' => $osdUser['active'],
                ])->save();
            }

            return $user;
        });
    }
}
