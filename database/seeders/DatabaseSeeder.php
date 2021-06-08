<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user

        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $estadoretiro = \App\Models\Estadoretiro::create(['glosa' => 'SIN ASIGNAR']);
        $estadoretiro = \App\Models\Estadoretiro::create(['glosa' => 'ASIGNADO']);
        $estadoretiro = \App\Models\Estadoretiro::create(['glosa' => 'SIN RESPUESTA']);
        $estadoretiro = \App\Models\Estadoretiro::create(['glosa' => 'AGENDADO']);
        $estadoretiro = \App\Models\Estadoretiro::create(['glosa' => 'VISITA FALLIDA']);
        $estadoretiro = \App\Models\Estadoretiro::create(['glosa' => 'RETIRADO']);
        $estadoretiro = \App\Models\Estadoretiro::create(['glosa' => 'BODEGA ROCKTRUCK']);
        $estadoretiro = \App\Models\Estadoretiro::create(['glosa' => 'ENTREGADO']);

        $estadoagenda = \App\Models\Estadoagenda::create(['glosa' => 'ACTIVA']);
        $estadoagenda = \App\Models\Estadoagenda::create(['glosa' => 'CANCELADA']);
        $estadoagenda = \App\Models\Estadoagenda::create(['glosa' => 'FINALIZADA']);

        $atributos = \App\Models\Atributo::create(['glosa' => 'USUARIO']);
        $atributos = \App\Models\Atributo::create(['glosa' => 'DIRECCION']);
        $atributos = \App\Models\Atributo::create(['glosa' => 'TELEFONO']);
        $atributos = \App\Models\Atributo::create(['glosa' => 'EMAIL']);
        $atributos = \App\Models\Atributo::create(['glosa' => 'SERIE']);

        $tipoevidencia = \App\Models\Tipoevidencia::create(['glosa' => 'AUDIO TELEFONICO']);
        $tipoevidencia = \App\Models\Tipoevidencia::create(['glosa' => 'ARCHIVO']);
        $tipoevidencia = \App\Models\Tipoevidencia::create(['glosa' => 'IMAGEN']);

        $bloquehorario = \App\Models\Bloquehorario::create(['horainicio' => '09:00', 'horafin' => '13:00']);
        $bloquehorario = \App\Models\Bloquehorario::create(['horainicio' => '13:00', 'horafin' => '17:00']);
        $bloquehorario = \App\Models\Bloquehorario::create(['horainicio' => '17:00', 'horafin' => '21:00']);

        $tipollamada = \App\Models\Estadollamado::create(['glosa' => 'SIN RESPUESTA']);
        $tipollamada = \App\Models\Estadollamado::create(['glosa' => 'INDICA NO SER CLIENTE']);
        $tipollamada = \App\Models\Estadollamado::create(['glosa' => 'LLAMADO EXITOSO']);

        $this->call(PermissionsSeeder::class);

        /*
        $this->call(UserSeeder::class);
        $this->call(EstadoretiroSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(AtributoSeeder::class);
        $this->call(TipoevidenciaSeeder::class);
        $this->call(BloquehorarioSeeder::class);
        $this->call(BitacoraSeeder::class);
        $this->call(ModificacioneSeeder::class);
        $this->call(EvidenciaSeeder::class);
        $this->call(RetiroSeeder::class);
        $this->call(EstadoagendaSeeder::class);
        $this->call(AgendaSeeder::class);
        */
    }
}
