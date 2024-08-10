<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Personal;
use App\Models\Rol;
use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Settings::create([
            'ruc' => '12345678901',
            'reason' => 'My Company',
            'ecommerce' => 'My Ecommerce',
            'phone' => '123456789',
            'email' => 'example@example.com',
            'ubigeo' => '010101',
            'urbanization' => 'Urbanization Name',
            'address' => '123 Main St',
        ]);

        Office::create([
            'id_office' => 1,
            'name_office' => 'Gerencia',
            'text_office' => '<p>gerencia</p>',
            'color_office' => null,
            'status_office' => 1,
            'created_at' => '2024-02-23 02:10:00',
            'updated_at' => '2024-03-22 06:02:49',
        ]);

        // Seeding Roles table
        Rol::insert([
            [
                'id_rol' => 1,
                'name_rol' => 'GERENTE GENERAL',
                'descr_rol' => '<p>-----------</p>',
                'office_id' => 1,
                'text_rol' => null,
                'color_rol' => null,
                'status_rol' => 1,
                'created_at' => '2024-02-23 02:13:44',
                'updated_at' => '2024-02-24 01:17:18',
            ],
            [
                'id_rol' => 2,
                'name_rol' => 'SUB GERENTE',
                'descr_rol' => '<p>-----------</p>',
                'office_id' => 1,
                'text_rol' => null,
                'color_rol' => null,
                'status_rol' => 1,
                'created_at' => '2024-02-24 01:04:30',
                'updated_at' => '2024-02-24 01:17:15',
            ],
        ]);

        // Seeding Personal table
        Personal::insert([
            [
                'id_personal' => 1,
                'firstname' => 'Marlon Emerson',
                'lastname' => 'Valenzuela Estrada',
                'email' => 'valenestradam1@gmail.com',
                'phone' => '926730944',
                'role_id' => 1,
                'office_id' => 1,
                'dni' => '75214038',
                'status' => 1,
                'avatar' => '',
                'created_at' => '2024-02-24 07:44:49',
                'updated_at' => '2024-03-12 03:41:36',
            ],
            [
                'id_personal' => 2,
                'firstname' => 'Diego',
                'lastname' => 'Mendoza',
                'email' => 'diego@gmail.com',
                'phone' => '52634178',
                'role_id' => 2,
                'office_id' => 1,
                'dni' => '12345678',
                'status' => 2,
                'avatar' => '',
                'created_at' => '2024-02-24 07:46:57',
                'updated_at' => '2024-03-12 03:42:04',
            ],
        ]);
    }
}
