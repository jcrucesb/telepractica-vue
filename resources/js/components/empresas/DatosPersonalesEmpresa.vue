<template>
<div id="datosPersonalesEmpresa">
    <div class="container">
            <table id="tablaDatosEmpresa" class="table table-responsive table-dark display table-bordered responsive" style="width:100%">
        <thead style="background-color:#56B1B5;">
            <tr>
                <th scope="col" class="text-center">#ID</th>
                <th scope="col" class="text-center">Run</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Razón Social</th>
                <th scope="col" class="text-center">Nombre ficticio</th>
                <th scope="col" class="text-center">Giro</th>
                <th scope="col" class="text-center">Descripción</th>
                <th scope="col" class="text-center">Web</th>
                <th scope="col" class="text-center">Teléfono</th>
                <th scope="col" class="text-center">Dirección</th>
                <th scope="col" class="text-center" data-priority="1">Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="emp in empresa" :key="emp.id" if="emp.id">
                <td class="text-white text-center">{{emp.id}}</td>
                <td class="text-white text-center">{{emp.run}}</td>
                <td class="text-white text-center">{{emp.email}}</td>
                <td class="text-white text-center">{{emp.razon_social}}</td>
                <td class="text-white text-center">{{emp.nombre_ficticio}}</td>
                <td class="text-white text-center">{{emp.giro}}</td>
                <td class="text-white text-center">{{emp.descripcion}}</td>
                <td class="text-white text-center">{{emp.web}}</td>
                <td class="text-white text-center">{{emp.telefono}}</td>
                <td class="text-white text-center">{{emp.direccion}}</td>
                <td class="text-dark text-center">
                    <button type="button" class="btn btn-warning" @click="abrirModalEditar(emp);">Editar</button>
                </td>
            </tr>
        </tbody>
        </table>
    </div>
    <!--Modal para EDITAR.-->
                <!-- Modal -->
            <div class="modal fade" id="edit" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content modal-sm">
                    <div class="modal-header">
                        <h5 class="modal-title mx-auto">Actualizar Datos</h5>
                    </div>
                    <div class="modal-body mx-auto">
                        <form action="">
                            <!--<input type="hidden" name="id" id="id" v-model="editarDatos.id">-->
                            <div class="form-group">
                                <label for="">R.U.N</label>
                                <input type="text" class="form-control" id="run" name="run" v-model="editarDatos.run">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" id="email" name="email" v-model="editarDatos.email">
                            </div>
                            <div class="form-group">
                                <label for="">Razón Social</label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social" v-model="editarDatos.razon_social">
                            </div>
                            <div class="form-group">
                                <label for="">Nombre Ficticio</label>
                                <input type="text" class="form-control" id="nombre_ficticio" name="nombre_ficticio" v-model="editarDatos.nombre_ficticio">
                            </div>
                            <div class="form-group">
                                <label for="">Giro</label>
                                <input type="text" class="form-control" id="giro" name="giro" v-model="editarDatos.giro">
                            </div>
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" v-model="editarDatos.descripcion">
                            </div>
                            <div class="form-group">
                                <label for="">Web</label>
                                <input type="text" class="form-control" id="web" name="web" v-model="editarDatos.web">
                            </div>
                            <div class="form-group">
                                <label for="">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" v-model="editarDatos.telefono">
                            </div>
                            <div class="form-group">
                                <label for="">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" v-model="editarDatos.direccion">
                            </div>
                            <div class="modal-footer mx-auto">
                                <button type="submit" class="btn btn-primary" @click.prevent="editar();">Actualizar</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                    
                    </div>
                </div>
            </div>
        <!--Fin modal EDITAR.-->
</div>
</template>
<style>
    @import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
    @import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>
<script>
/*Debemos importar las dependencias de DataTables*/
import datatable from 'datatables.net-bs4';
import Swal from 'sweetalert2';

export default {
    data(){
        return{
            empresa: [],
            id: null,
            run:null,
            email:null,
            titulo:null,
            btnEditar:null,
            editarDatos: [],
        };
    },
    mounted(){
       this.obtenerEmp();
    },
    methods:{
        //
        tabla(){
            //this.login();
            /*Así se debe inicilizar en Vuejs, this.$nextTick, 
            que vendría siendo como el document.ready. de JQUERY.*/
            this.$nextTick(()=>{
            $('#tablaDatosEmpresa').DataTable({
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
                   
                });
            });
        },
        //
        obtenerEmp(){
            axios.get("/empresa/datEmp")
            .then(response => {
                this.empresa = response.data;
                this.tabla();
            })          
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        //Abrir el MODAL de EDITAR los datos de la EMPRESA.
        abrirModalEditar(emp){
            this.editarDatos = {id: emp.id, run: emp.run, email: emp.email, razon_social: emp.razon_social,
                                nombre_ficticio: emp.nombre_ficticio, giro: emp.giro, descripcion: emp.descripcion, 
                                web: emp.web, telefono: emp.telefono, direccion: emp.direccion};
            this.id = emp.id;
            $('#edit').modal('show');
        },
        editar(){
            axios.put('/admin/empresa/editarDatosEmp/'+this.id, this.editarDatos)
            .then(resp => {
                Swal.fire({
                    title: "Listo!",
                    text: "La Oferta ha sido Editada!",
                    icon: "success",
                    button: "OK",
                });
                $('#tablaDatosEmpresa').DataTable().destroy();
                this.obtenerEmp();
                $('#edit').modal('hide');
            }).catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
    }
}
</script>