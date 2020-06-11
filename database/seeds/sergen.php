<?php
set_time_limit(999);
use Illuminate\Database\Seeder;

class sergen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $datosEstudio = 2;
       //fixme $productor = file_get_contents("https://api.jikan.moe/v3/producer/$datosEstudio/1", false, stream_context_create($arrContextOptions));
        $productor = file_get_contents("http://localhost:9000/public/v3/producer/$datosEstudio/1", false, stream_context_create($arrContextOptions));

        $infoPro = json_decode($productor);
        //   echo "<pre>".print_r($infoPro, true)."</pre>" ;
        $tam = count($infoPro->anime);
        echo "EL TAMAÑO ES" . $tam;
        $count = 0;
        if ($productor) {
            echo "<pre>" . print_r($productor, true) . "</pre>";
            foreach ($infoPro->anime as $anime) {
                sleep(2);
                $malId = $anime->mal_id; // ID UNICO DE CADA SERIE DE MAL
                $serie = file_get_contents("http://localhost:9000/public/v3/anime/$malId", false, stream_context_create($arrContextOptions));
                $ser = json_decode($serie);
                echo "MOSTRANDO SERIES";
                $idSeMal = $ser->mal_id;
                $titulo = addslashes($ser->title);
                if ($ser->airing) {
                    $emitiendo = 1;
                } else {
                    $emitiendo = 0;
                }
                $descripcion = addslashes($ser->synopsis);
                if ($ser->episodes == null) {
                    $episodios = "NULL";
                } else {
                    $episodios = $ser->episodes;
                }
                if ($ser->aired->from == null) {
                    $fec_ini = "NULL";
                } else {
                    $fec_ini = $ser->aired->from;
                }
                if ($ser->aired->to == null) {
                    $fec_fin = "NULL";
                } else {
                    $fec_fin = $ser->aired->to;
                }
                $pegi = addslashes($ser->rating);
                $foto = $ser->image_url;
                $tipo = $ser->type;
                $estado = addslashes($ser->status);
                if ($ser->duration == null) {
                    $duracion = "NULL";
                } else {
                    $duracion = addslashes($ser->duration);
                }
                if ($ser->trailer_url == null) {
                    $trailer = "NULL";
                } else {
                    $trailer = $ser->trailer_url;
                }
                $tituloJap = addslashes($ser->title_japanese);
                $estudio = $ser->studios[0]->mal_id;
                $estudioName = $ser->studios[0]->name;
                echo "INSERTADO DE SERIE:".$serie;
                $count++;
                echo "Numero:".$count;


                echo "SERIEE: " . $titulo . "<br>";





                $x = count($ser->genres);
                //  echo "<br> NUMERO DE GENEROS:".$x;
                for (; $x > 0; $x-- ) {
                    $genero = $ser->genres[$x-1]->mal_id;
                    //    echo "INSERTADO DE GENEROS: <br>";
                    $ge = "INSERT INTO  sergen ";
                    $ge.="VALUES ('$malId','$genero') ;";
                    $data = [];
                    array_push($data, [
                        "idSe" => $malId,
                        "idGen" => $genero

                    ]);
                    try {
                        DB::table('sergen')->insert($data);
                    } catch (Throwable $e){

                    }

                }


            }


        }


    }
}
