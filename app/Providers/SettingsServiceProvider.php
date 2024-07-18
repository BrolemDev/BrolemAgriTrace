<?php

namespace App\Providers;

use App\Models\Settings;
use App\Models\sunatCodeUbigeo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Registrar servicios si es necesario
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        self::updateSessionData();
    }

    /**
     * Update session data with settings information.
     *
     * @return void
     */
    public static function updateSessionData()
    {
        // Obtener el primer registro de la tabla settings
        $settings = Settings::first();

        // Agregar los datos de configuración a la sesión
        if ($settings) {
            Session::put('ruc', $settings->ruc);
            Session::put('reason', $settings->reason);
            Session::put('ecommerce', $settings->ecommerce);
            Session::put('phone', $settings->phone);
            Session::put('email', $settings->email);
            Session::put('ubigeo', $settings->ubigeo);
            Session::put('urbanization', $settings->urbanization);
            Session::put('address', $settings->address);

            // Obtener los datos relacionados de la tabla ubigeo
            $ubigeo = sunatCodeUbigeo::find($settings->ubigeo);

            if ($ubigeo) {
                Session::put('ubigeo_data', $ubigeo);
            }
        }
    }
}
