<?php

use Illuminate\Database\Seeder;

class genero extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = array(
            0 => "0",
            1 => "Action",
            2 => "Adventure",
            3 => "Cars",
            4 => "Comedy",
            5 => "Dementia",
            6 => "Demons",
            7 => "Mystery",
            8 => "Drama",
            9 => "Ecchi",
            10 => "Fantasy",
            11 => "Game",
            12 => "Hentai",
            13 => "Historical",
            14 => "Horror",
            15 => "Kids",
            16 => "Magic",
            17 => "Martial Arts",
            18 => "Mecha",
            19 => "Music",
            20 => "Parody",
            21 => "Samurai",
            22 => "Romance",
            23 => "School",
            24 => "Sci Fi",
            25 => "Shoujo",
            26 => "Shoujo Ai",
            27 => "Shounen",
            28 => "Shounen Ai",
            29 => "Space",
            30 => "Sport",
            31 => "Super Power",
            32 => "Vampire",
            33 => "Yaoi",
            34 => "Yuri",
            35 => "Harem",
            36 => "Slice Of Life",
            37 => "Supernatural",
            38 => "Military",
            39 => "Police",
            40 => "Pyschological",
            41 => "Thriller",
            42 => "Seinen",
            43 => "Josei",
        );
        $count = 0;
        foreach ($array as $item) {
            $data = [
                "idGen" => $count,
                "genero" => $item,

            ];
            echo "numero".$count;
            echo $item;
            try {
                DB::table('genero')->insert($data);
            } catch (Throwable $e){

            }

            $count++;

        }
    }
}
