<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OSDHQController extends Controller
{
    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function redirectToOSDHQ(): RedirectResponse
    {
        return Socialite::driver('osd-hq')->redirect();
    }

    public function handleOSDHQCallback(Request $request): RedirectResponse
    {
        if ($request->has('error')) {
            return redirect()->route('login');
        }

        $osdUser = Socialite::driver('osd-hq')->user();

        $clientId = config('services.osd-hq.client_id');

        if (in_array($clientId, $osdUser->oauth_clients)) {
            $user = $this->userRepository->findByHQIdOrCreate($osdUser);

            Auth::login($user, true);

            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->withErrors([
            trans('auth.failed')
        ]);
    }

}
