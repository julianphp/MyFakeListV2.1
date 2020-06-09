<?php

use Illuminate\Database\Seeder;

class estudio extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "idEst" => 300,
            "NombreEstudio" => "Silver Link.",

        ];
        try {
            DB::table('estudio')->insert($data);
        } catch (Throwable $e){

        }

    }
}
