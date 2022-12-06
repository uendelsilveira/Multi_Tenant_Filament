<?php

namespace App\Http\Controllers;

use Stancl\Tenancy\Database\Models\ImpersonationToken;
use Stancl\Tenancy\Features\UserImpersonation;

class ImpersonateController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function impersonateAndRedirect(string $token)
    {
        $tokenModel = ImpersonationToken::findOrFail($token);
        $redirectResponse = UserImpersonation::makeResponse($tokenModel);
        // Auth::guard($tokenModel->auth_guard)->user()->createToken("impersonate-" . $token);
        return $redirectResponse;
    }
}
