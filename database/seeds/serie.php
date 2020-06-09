<?php
set_time_limit(999);
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class serie extends Seeder
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
        $datosEstudio = 300;
      //fixme  $productor = file_get_contents("https://api.jikan.moe/v3/producer/$datosEstudio/1", false, stream_context_create($arrContextOptions));
        $productor = file_get_contents("http://localhost:9000/public/v3/producer/$datosEstudio/1", false, stream_context_create($arrContextOptions));

        $infoPro = json_decode($productor);
        //   echo "<pre>".print_r($infoPro, true)."</pre>" ;
        $tam = count($infoPro->anime);
        echo "EL TAMAÑO ES" . $tam;
        $count = 0;
        if ($productor) {
            //echo "<pre>" . print_r($productor, true) . "</pre>";
            foreach ($infoPro->anime as $anime) {
                sleep(1);
                $malId = $anime->mal_id; // ID UNICO DE CADA SERIE DE MAL
                $serie = file_get_contents("http://localhost:9000/public/v3/anime/$malId", false, stream_context_create($arrContextOptions));
                $ser = json_decode($serie);
                echo "MOSTRANDO SERIES";
                $idSeMal = $ser->mal_id;
                $titulo = $ser->title;
                if ($ser->airing) {
                    $emitiendo = 1;
                } else {
                    $emitiendo = 0;
                }
                $descripcion = $ser->synopsis;
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
                $pegi = $ser->rating;
                $foto = $ser->image_url;
                $tipo = $ser->type;
                $estado = $ser->status;
                if ($ser->duration == null) {
                    $duracion = "NULL";
                } else {
                    $duracion = $ser->duration;
                }
                if ($ser->trailer_url == null) {
                    $trailer = "NULL";
                } else {
                    $trailer = Str::replaceLast('autoplay=1','autoplay=0',$ser->trailer_url);
                }
                $tituloJap = $ser->title_japanese;
                $estudio = $ser->studios[0]->mal_id;
                $estudioName = $ser->studios[0]->name;
               // echo "INSERTADO DE SERIE:".$serie;
                $count++;
                echo "Numero:".$count;

                echo "Insertando serie: " . $tituloJap . "<br>";


                if ($fec_ini != 'NULL') {
                    $date = new DateTime($fec_ini);
                    $fec_ini =  $date->format('Y-m-d');
                } else {
                    $fec_ini = NULL;
                }
                if ($fec_fin != 'NULL') {
                    $date1 = new DateTime($fec_fin);
                    $fec_fin =  $date1->format('Y-m-d');
                } else {
                     $fec_fin = NULL;
                }


                /*  if ($fec_ini != NULL) {
                      $fec_ini = \Carbon\Carbon::parse($fec_ini)->format('Y-m-d');
                  }
                    if ($fec_fin != NULL) {
                        $fec_fin = \Carbon\Carbon::parse($fec_fin)->format('Y-m-d');
                    } else {
                        $fec_fin = '0000-00-00';
                    }
                */
             //   $fec_fin = NULL;


                $data = [];
                array_push($data, [
                    "idSe" => $idSeMal,
                    "descripcion" => $descripcion,
                    "duracion" => $duracion,
                    "emitiendo" => $emitiendo,
                    "episodios" => $episodios,
                    "estado" => $estado,
                    "fec_ini" => $fec_ini,
                    "fec_fin" => $fec_fin,
                    "img" => $foto,
                    "pegi" => $pegi,
                    "tipo" => $tipo,
                    "titulo" => $titulo,
                    "tituloJap" => $tituloJap,
                    "trailer" => $trailer,
                    "idEst" => $datosEstudio,
                ]);
                try {
                    DB::table('serie')->insert($data);
                } catch (Throwable $e) {
                    echo "Por x o por i no se inserto";
                }

            }
        }

    }
}
