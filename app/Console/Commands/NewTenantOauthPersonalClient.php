<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Passport\ClientRepository;

class NewTenantOauthPersonalClient extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'passport:tenantClient {--tenants=* : The tenant(s) to run the command for. Default: all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gera um novo clinte de autenticacao para a api de integracao';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        tenancy()->runForMultiple($this->option('tenants'), function ($tenant) {
            $this->line("Tenant: {$tenant->getTenantKey()}");
            $clientRepository = new ClientRepository();
            $oAuthClient = $clientRepository->create(
                null,
                'Company Personal Access Client',
                "",
                'tenants',
                true
            );

            printf("Informações de autenticação para a api de integração:\n");
            printf("client_id: " . $oAuthClient->getKey() . "\n");
            printf("client_secret: " . $oAuthClient->getPlainSecretAttribute() . "\n");
            return 0;
        });


    }
}
