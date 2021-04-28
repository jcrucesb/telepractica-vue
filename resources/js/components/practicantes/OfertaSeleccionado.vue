<template>
    <div id="ofertaSeleccionado">
        <div class="container">
            <div class="table-responsive">
                <table id="tablaPostulaciones" class="table table-responsive table-dark display table-bordered responsive" style="width:100%">
                    <thead style="background-color:#A4A4A4">
                        <tr>
                            <th scope="col" class="text-center">#ID</th>
                            <th scope="col" class="text-center">Nombre Empresa</th>
                            <th scope="col" class="text-center">Nombre Oferta</th>
                            <th scope="col" class="text-center" data-priority="1">Seleccionado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="prac in practicante" :key="prac.id">
                            <td class="text-white text-center">{{prac.id}}</td>
                            <td class="text-white text-center">{{prac.nombre_ficticio}}</td>
                            <td class="text-white text-center">{{prac.nombre}}</td>
                            <td class="text-white text-center">{{prac.seleccionado}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
import datatable from 'datatables.net-bs4';
//Llamaremos al componente que registramos.
import misPostulaciones from '../practicantes/MisOfertas.vue';
import ofertaSeleccionado from '../practicantes/OfertaSeleccionado.vue';
import Swal from 'sweetalert2';
export default {
    data(){
        return{
            practicante: [],
            api_token:localStorage.getItem('respuesta'),
        };
    },
    mounted(){
        this.postulaciones();
        //this.tablaOferta();
    },
    methods:{
        tablaOferta(){
            var dt = $("#tablaPostulaciones").DataTable();
            dt.destroy();
            /*Así se debe inicilizar en Vuejs, this.$nextTick, 
            que vendría siendo como el document.ready. de JQUERY.*/
            this.$nextTick(()=>{
                $('#tablaPostulaciones').DataTable({
                    responsive: true,
                    autoWidth: false,    
                    lengthMenu: [
                        [5, 10, 25, 50, 100],
                        [5, 10, 25, 50, 100],
                    ],
                    order: [[0, "desc"]],
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                        },
                    /*columns: [
                        { width: "10%" },
                        { width: "17%" },
                        { width: "10%" },
                        { width: "10%" },
                    ],*/
                });
            });
            
        },
        postulaciones(){
            axios.get('/api/practicantes/obtenerPostulaciones',{headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                Authorization: `Bearer ${this.api_token}`
            }
            }).then(res => {
                this.practicante = res.data;
                this.tablaOferta();
            })              
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },  
    },
}
</script>
<style lang="scss">
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>