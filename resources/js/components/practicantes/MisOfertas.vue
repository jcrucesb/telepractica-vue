<template>
    <div id="misPostulaciones">
        <div class="modal-body modalBody">
            <div class="table-responsive">
                <table id="tablaMisPostulaciones" class="table display table-bordered responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">#ID</th>
                            <th scope="col" class="text-center">Nombre de la Oferta</th>
                            <th scope="col" class="text-center">Nombre Empresa</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <!--En esta table listamos las OFERTAS que se van
                        Agregando por cada Empresa.-->
                        <tr v-for="agregar in listarPostulaciones" :key="agregar.id">
                            <td class="text-dark text-center" scope="row">{{agregar.id}}</td>
                            <td class="text-dark text-center">{{agregar.nombre_oferta}}</td>
                            <td class="text-dark text-center">{{agregar.nombre_ficticio}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
//Llamaremos al componente que registramos.
import misPostulaciones from '../practicantes/MisOfertas.vue';
export default {
    data() {
    return {
        listarPostulaciones: [],
        valor:null,
        api_token: localStorage.getItem('respuesta'),
    };
  },
    mounted(){
        this.misPostulaciones();
    },
    methods: {
        tabla(){
            //this.login();
            /*Así se debe inicilizar en Vuejs, this.$nextTick, 
            que vendría siendo como el document.ready. de JQUERY.*/
            this.$nextTick(()=>{
            $('#tablaMisPostulaciones').DataTable({
                'responsive': true,
                autoWidth: false,
                lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100],
            ],
          order: [[0, "desc"]],
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          columns: [
            { width: "9%" },
            { width: "10%" },
            { width: "10%" },
          ],
                });
            });
        },
        misPostulaciones(){
            axios.get('/api/practicantes/misPostulaciones',{headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        Authorization: `Bearer ${this.api_token}`
                    }
                }).then(resp => {
                    this.listarPostulaciones = resp.data;
                    this.tabla();
                }).catch(error=>{
                    let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
    },
}
</script>
<style>
.modalBody{
        background-color: cadetblue;
    }
</style>