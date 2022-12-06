<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use RealRashid\SweetAlert\Facades\Alert;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $tenants = Tenant::query()->get();
        return response()->json($tenants);
    }

    /**
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function impersonate(string $id)
    {
        // $this->authorize('updateAny', Company::class);

        /** @var Tenant $tenant */
        $tenant = Tenant::query()->find($id);
        if($tenant === null) {
            // Alert::error('Empresa não encontrada', 'A Empresa não foi encontrada no banco de dados.');
            return redirect()->route('companies.index');
        }

        $subDomainObj = $tenant->domains()->getQuery()->firstOrFail();
        $token = tenancy()->impersonate($tenant, 1, "/", "tenants");

        $url = route('login');
        $hostname = parse_url($url, PHP_URL_HOST);
        return redirect(tenant_route($subDomainObj->domain . "." . $hostname, "tenant.impersonate", ["{$token->token}"]));
    }
}
