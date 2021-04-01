<template>
<div class="lado mt-3">
    <div id="listOfertaPract">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <!---->
                        <div class="card border-success mb-3"  v-for="prac in listarOferta" :key="prac.id" style="max-width: 18rem;">
                        <a type="submit" href="#" class="" @click.prevent="oferta(prac.id);">
                            <div class="card-header bg-transparent border-success mx-auto">{{prac.razon_social}}</div>
                            <div class="card-body text-success mx-auto">
                                <h5 class="card-title text-dark mr-2">Oferta: </h5> <p>{{prac.nombre_oferta}}</p>
                                <p class="card-text text-dark">Descripción: </p> <p class="" >{{prac.descripcion}}</p>
                                <p class="card-text text-dark">Remunerada: </p> <p class="" >{{prac.remunerada}}</p>
                                <p class="card-text text-dark">Cupos Disponibles: </p> <p class="" >{{prac.cupos_totales}}</p>
                                <p class="card-text text-dark">R. mínimos: </p> <p class="" >{{prac.requisitos_min}}</p>
                            </div>
                            <div class="card-footer bg-transparent border-success mx-auto">{{prac.web}}</div>
                        </a>
                        </div>
                    <!---->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
</style>
<script>
export default {
    data() {
    return {
        listarOferta: [],
        valor:null,
    };
  },
    mounted(){
        this.obtenerOferta();
    },
    methods: {
        obtenerOferta(){
            axios.get("/admin/api/oferta/listarOfertaPracticante")
            .then(response => {
                //console.log(response);
                this.listarOferta = response.data;
            })
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        oferta(contenedor){
            let a = {
                'id_oferta': contenedor
            };
            var _token = $('input[name=_token]').val();
            Swal.fire({
                title: '¿Seguro que desas postular a, ' + contenedor + '?',
                icon: 'question',
                iconHtml: '?',
                confirmButtonText: 'Ok',
                cancelButtonText: 'Cancelar',
                showCancelButton: true,
                showCloseButton: true
                }).then((willDelete) => {
                    console.log(willDelete);
                    debugger;
                    //console.log(willDelete.isDismissed == true);
                    //debugger;
                if (willDelete.isConfirmed == true) {
                    axios.post('/store', a)
                    .then(resp => {
                        if(resp.data.msg == '1'){
                            Swal.fire({
                                title: "Ya postulaste a esta Oferta!",
                                icon: "warning",
                            });
                        }else if(resp.data.msg == '0'){
                            Swal.fire({
                                title: "Postulacion Éxitosa!",
                                icon: "success",
                            });
                        }
                    }).catch(error=>{
                        let errorObject=JSON.parse(JSON.stringify(error));
                    });
                }
            });
        },
    },
}
</script>