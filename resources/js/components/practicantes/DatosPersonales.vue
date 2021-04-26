<template>
    <div id="datosPersonales">
        <div class="container">
            <div class="table-responsive">
            <table id="tablaDatosPersonales" class="table table-responsive table-dark display table-bordered responsive" style="width:100%">
        <thead style="background-color:green;">
            <tr>
                <th scope="col" class="text-center">#ID</th>
                <th scope="col" class="text-center">Run</th>
                <th scope="col" class="text-center">Nombre Completo</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Teléfono</th>
                <th scope="col" class="text-center">Cant. Horas</th>
                <th scope="col" class="text-center">Cant. Meses</th>
                <th scope="col" class="text-center">Habilidades Blandas</th>
                <th scope="col" class="text-center">Habilidades Profesionales</th>
                <th scope="col" class="text-center">Editar Registro Completo</th>
                <th scope="col" class="text-center" data-priority="1">Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="prac in practicante" :key="prac.id">
                <td class="text-white text-center">{{prac.id}}</td>
                <td class="text-white text-center">{{prac.run}}</td>
                <td class="text-white text-center">{{prac.nombre_completo}}</td>
                <td class="text-white text-center">{{prac.email}}</td>
                <td class="text-white text-center">{{prac.telefono}}</td>
                <td class="text-white text-center">{{prac.cantidad_horas}}</td>
                <td class="text-white text-center">{{prac.cantidad_meses}}</td>
                <td class="text-white text-center">{{prac.hab_blandas}}</td>
                <td class="text-white text-center">{{prac.hab_profesionals}}</td>
                <td class="text-white text-center"><a :href="'http://telepractica-vue.test:8080/registroPracticanteDashboard/'">Formulario Editar</a></td>
                <td class="text-dark text-center">
                    <button  type="button" @click.prevent="editar(prac);" data-toggle="modal" data-target="#edit" class="btn btn-warning btnEditar">Editar</button>
                </td>
            </tr>
        </tbody>
        </table>
        </div>
    </div>
    <!--Modal para EDITAR.-->
                <!-- Modal -->
            <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content modal-sm">
                    <div class="modal-header">
                        <h5 class="modal-title mx-auto">Actualizar Datos</h5>
                    </div>
                    <div class="modal-body mx-auto">
                        <form action="">
                            <input type="hidden" name="id" id="id" v-model="editamos.id">
                            <div class="form-group">
                                <label for="">R.U.N</label>
                                <input type="text" class="form-control" id="run" name="run" v-model="editamos.run">
                            </div>
                            <div class="form-group">
                                <label for="">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" v-model="editamos.nombre_completo">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" id="email" name="email" v-model="editamos.email">
                            </div>
                            <div class="form-group">
                                <label for="">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" v-model="editamos.telefono">
                            </div>
                            <div class="form-group">
                                <label for="">Cant Horas</label>
                                <input type="number" class="form-control" id="cantidad_horas" name="cantidad_horas" v-model="editamos.cantidad_horas">
                            </div>
                            <div class="form-group">
                                <label for="">Cant Meses</label>
                                <input type="number" class="form-control" id="cantidad_meses" name="cantidad_meses" v-model="editamos.cantidad_meses">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer mx-auto">
                        <button type="submit" class="btn btn-primary" @click.prevent="editarDatos();">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
        <!--Fin modal EDITAR.-->
</div>
</template>

<script>
import datatable from 'datatables.net-bs4';
import Swal from 'sweetalert2';
export default {
    data(){
        return{
            practicante: [],
            id: null,
            editamos: [],
            api_token: localStorage.getItem('respuesta'),
        };
    },
    mounted(){
        //this.tablaOferta();
        this.obtenerPract();
    },
    methods:{
        tablaOferta(){
            /*Así se debe inicilizar en Vuejs, this.$nextTick, 
            que vendría siendo como el document.ready. de JQUERY.*/
            var dt = $("#tablaDatosPersonales").DataTable();
            dt.destroy();
            this.$nextTick(()=>{
                $('#tablaDatosPersonales').DataTable({
                    'responsive': true,
                    'autoWidth': false,    
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
                        { width: "15%" },
                        { width: "15%" },
                        { width: "15%" },
                        { width: "15%" },
                        { width: "15%" },
                        { width: "15%" },
                        { width: "15%" },
                        { width: "15%" },
                        { width: "15%" },
                    ],  
                });
            });
        },
        obtenerPract(){
            axios.get("/api/practicantes/datPract",{headers: {
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
        editar(prac){
            this.editamos = {id: prac.id, run: prac.run, nombre_completo: prac.nombre_completo,
                                email: prac.email, telefono: prac.telefono, cantidad_horas:prac.cantidad_horas,
                                cantidad_meses: prac.cantidad_meses};
            this.id = prac.id;
        },
        editarDatos(){
            axios.put('/api/empresas/editarDatosPrac/'+ this.id,this.editamos,{headers: {
                Accept: 'application/json',
                'Content-Type': 'application/json',
                Authorization: `Bearer ${this.api_token}`
            }
            })
            .then(response => {
                if (response.data.msg == '1'){
                    
                    Swal.fire({
                        title: "Actualización Correcta",
                        text: "Esta acción puede ser revertida más tarde",
                        icon: "success",
                    });
                    $('#tablaDatosPersonales').DataTable().destroy();
                    this.obtenerPract();
                    $('#edit').modal('hide');
                }
            });
        },
    }
}
</script>
<style lang="scss">
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>