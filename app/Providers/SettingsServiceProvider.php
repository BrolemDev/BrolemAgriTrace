<?php

namespace App\Providers;

use App\Models\Settings;
use App\Models\sunatCodeUbigeo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;

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
        try {
            // Verificar si la tabla settings existe antes de intentar obtener datos
            if (Schema::hasTable('settings')) {
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

                    // Verificar si la tabla ubigeo existe antes de intentar obtener datos
                    if (Schema::hasTable('sunat_codigoubigeo')) {
                        $ubigeo = sunatCodeUbigeo::find($settings->ubigeo);

                        if ($ubigeo) {
                            Session::put('ubigeo_data', $ubigeo);
                        }
                    }
                }
            }
        } catch (QueryException $e) {
            // Manejar el error de consulta aquí (opcionalmente registrar el error)
            // Puedes usar Log::error($e) para registrar el error en un archivo de log
        }
    }
}
