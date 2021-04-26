<template>
    <div id="aceptaron">
        <div class="container">
            <div class="table-responsive">
            <table id="tablaConfirmacion" class="table table-responsive table-dark display table-bordered responsive" style="width:100%">
        <thead style="background-color:#A4A4A4">
            <tr>
                <th scope="col" class="text-center">#ID</th>
                <th scope="col" class="text-center">Run</th>
                <th scope="col" class="text-center">Nombre Completo</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Nombre Oferta</th>
                <th scope="col" class="text-center" data-priority="1">Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="prac in practicante" :key="prac.id">
                <td class="text-white text-center">{{prac.id}}</td>
                <td class="text-white text-center">{{prac.run}}</td>
                <td class="text-white text-center">{{prac.nombre_completo}}</td>
                <td class="text-white text-center">{{prac.email}}</td>
                <td class="text-white text-center">{{prac.nombre}}</td>
                <td class="text-dark text-center">
                    <button  type="button" @click.prevent="eliminar();" class="btn btn-danger btnPostulacion">Eliminar</button>
                </td>
            </tr>
        </tbody>
        </table>
        </div>
        </div>
    </div>
</template>
<script>
import datatable from 'datatables.net-bs4';
import Swal from 'sweetalert2';
export default {
    data(){
        return{
            practicante: [],
            api_token:localStorage.getItem('respuesta'),
        };
    },
    mounted(){
        this.obtenerPract();
        //this.tablaOferta();
    },
    methods:{
        tablaOferta(){
            /*Así se debe inicilizar en Vuejs, this.$nextTick, 
            que vendría siendo como el document.ready. de JQUERY.*/
            this.$nextTick(()=>{
                $('#tablaConfirmacion').DataTable({
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
                    columns: [
                        { width: "10%" },
                        { width: "17%" },
                        { width: "10%" },
                        { width: "10%" },
                        { width: "13%" },
                        { width: "13%" },
                    ],  
                });
            });
        },
        obtenerPract(){
            axios.get("/api/empresas/practicantesConfirmaron", {headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                Authorization: `Bearer ${this.api_token}`
            }
            })
            .then(response => {
                this.practicante = response.data;
                this.tablaOferta();
            });
        },
    }
}
</script>
<style lang="scss">
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>