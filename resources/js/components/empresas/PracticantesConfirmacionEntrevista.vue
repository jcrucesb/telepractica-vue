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
                <th scope="col" class="text-center">Correo Enviado</th>
                <th scope="col" class="text-center">Día de la Citación</th>
                <th scope="col" class="text-center">Hora de la Citación</th>
                <th scope="col" class="text-center" data-priority="1">Seleccionar</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="prac in practicante" :key="prac.id">
                <td class="text-white text-center">{{prac.id}}</td>
                <td class="text-white text-center">{{prac.run}}</td>
                <td class="text-white text-center">{{prac.nombre_completo}}</td>
                <td class="text-white text-center">{{prac.email}}</td>
                <td class="text-white text-center">{{prac.nombre}}</td>
                <td class="text-white text-center">{{prac.correo_enviado}}</td>
                <td class="text-white text-center">{{prac.fecha_citacion | fecha}}</td>
                <td class="text-white text-center">{{prac.hora_citacion}}</td>
                <td class="text-dark text-center">
                   <button type="button" class="btn" @click="seleccionar(prac.id,prac.nombre_completo,prac.run,prac.nombre)">
                        <img :src="'../img/email.png'" alt="">
                    </button>
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
                        { width: "3%" },
                        { width: "3%" },
                        { width: "13%" },
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
        seleccionar(id, nombrePract,runPract,nombreOferta){
            let datosPrac = {
                'id_prac': id,
                'nombrePract': nombrePract,
                'runPract': runPract,
                'nombreOferta': nombreOferta,
            }
            Swal.fire({
                title: '¿ Seleccionar al Practicante ' + nombrePract +'?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, seleccionar!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/api/empresas/practicanteSeleccionado', datosPrac,{headers: {
                        Accept: 'application/json',
                        'Content-Type': 'application/json',
                        Authorization: `Bearer ${this.api_token}`
                    }
                    }).then(resp => {
                        if (resp.data.status == 1) {
                            Swal.fire(
                                'Seleccionado!',
                                'Se ha enviado un correo al Practicante',
                                'success'
                            )
                        }else if (resp.data.status == 1) {
                            Swal.fire(
                                'Error!',
                                'No se pudo enviar el correo',
                                'error'
                            )
                        }
                    }).catch(error=>{
                            let errorObject=JSON.parse(JSON.stringify(error));
                    })
                    
                }
            })
        },
    }
}
</script>
<style lang="scss">
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>