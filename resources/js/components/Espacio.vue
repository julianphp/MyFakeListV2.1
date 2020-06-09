<template>
    <div class="card-group">

        <div class="card" v-for="item in serie">
            <img v-bind:src="item.img" class="card-img-top img-fluid rounded mx-auto w-100 d-block" alt="...">
            <div class="card-body"><a :href="route('serie.ver',{idSe: item.idSe, titulo: item.titulo})">
                <h5 class="card-title"> {{ item.titulo }}</h5></a>

            </div>
        </div>


    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "Espacio",
        data() {
            return {
                serie: [],
            }
        },
        created() {
            this.getSerie()
        },
        methods: {
            getSerie: function () {
                axios.get('api/series/random').then(response => {
                    //var old = JSON.stringify(response.data); //convert to JSON string
                   // console.log(old)
                    var json = response.data;
                    for (var clave in json){
                       json[clave].titulo = json[clave].titulo.replaceAll("/","-")
                      // var newj = json[clave].titulo.replaceAll(" ","-");
                    }
                    // var newArray = JSON.parse(old); //convert back to array
                    this.serie = json
                });

            }
        }
    }

</script>

<style scoped>

</style>
