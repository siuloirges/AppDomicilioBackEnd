<?php

use Illuminate\Database\Seeder;
use \App\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuariosSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Usuario::insert(["rol" => "cliente", "nombre" => "Sergio Cliente", "tipo_documento_id" => "1", "numero_documento" => "123123123", "url_foto_perfil" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "telefono" => "12312312312", "email" => "c@c.c", "password" =>  Hash::make("12341234")]);
        Usuario::insert(["rol" => "aliado", "nombre" => "Sergio aliado", "tipo_documento_id" => "1", "numero_documento" => "123123123", "url_foto_perfil" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "telefono" => "12312312312", "email" => "a@a.a", "password" => Hash::make("12341234"), "id_aliado" => "1" ]);
        Usuario::insert(["rol" => "administrador", "nombre" => "Sergio admin", "tipo_documento_id" => "1", "numero_documento" => "123123123", "url_foto_perfil" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "telefono" => "12312312312", "email" => "ad@a.a", "password" =>  Hash::make("12341234")]);
        Usuario::insert(["rol" => "repartidor", "nombre" => "Repartidor 1", "tipo_documento_id" => "1", "numero_documento" => "101010101", "telefono" => "101010101", "url_foto_perfil" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "email" => "r@r.r", "password" =>  Hash::make("12341234"), "tipo_vehiculo_id" => "1", "placa_vehiculo" => "123iud", "foto_documento_identidad_1" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_documento_identidad_2" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_targeta_propiedad_1" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_targeta_propiedad_2" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_soat_1" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_soat_2" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_vehiculo_1" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_vehiculo_2" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "id_aliado" => "1", "id_sucursal" => "1"]);
        Usuario::insert(["rol" => "repartidor", "nombre" => "Repartidor 2", "tipo_documento_id" => "1", "numero_documento" => "202020202", "telefono" => "202020202", "url_foto_perfil" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "email" => "r2@r2.r2", "password" =>  Hash::make("12341234"), "tipo_vehiculo_id" => "1", "placa_vehiculo" => "123abc", "foto_documento_identidad_1" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_documento_identidad_2" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_targeta_propiedad_1" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_targeta_propiedad_2" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_soat_1" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_soat_2" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_vehiculo_1" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "foto_vehiculo_2" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "id_aliado" => "1", "id_sucursal" => "1"]);
        Usuario::insert(["rol" => "asistente", "nombre" => "Sergio asistente", "tipo_documento_id" => "1", "numero_documento" => "123123123", "url_foto_perfil" => "/storage/imagenes/usuarios//doc-/601adc1e210ea.jpg", "telefono" => "12312312312", "email" => "as@a.a", "password" =>  Hash::make("12341234")]);
    }
}
