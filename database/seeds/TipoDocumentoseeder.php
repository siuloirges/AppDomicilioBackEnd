<?php

use Illuminate\Database\Seeder;
use   \App\TipoDocumento;
class TipoDocumentoseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoDocumento::insert(["nombre"=>"Cedula",]);
    }
}
