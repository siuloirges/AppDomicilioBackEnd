<?php

use App\Aliado;
use Illuminate\Database\Seeder;

class AliadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Aliado::insert([
            "nombre" => "Comidas S.A.S",
            "razon_social" => "Mc Donalds",
            "nit" => "78245961",
            "url_foto_perfil" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg",
            "url_foto_portada" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg",
            "visible" => "1",
        ]);
    }
}
