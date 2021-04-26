<template>
    <div id="curriculumPracticante" class="mt-5">
            <div class="container mx-auto tcert mb-5">
                <center>
                    <div class="container mt-5">
                        <button class="btn btn-success btnAgregar mt-5" @click="abrirModalCrear();" data-toggle="modal" data-target="#edit"><i class="fas fa-user-plus"></i> Agregar Curriculum</button>
                    </div>
                </center>
            <div class="table-responsive">
                    <table id="tablaCurriculum" class="table display table-bordered responsive" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#ID</th>
                        <th scope="col" class="text-center">Curriculum</th>
                        <th scope="col" class="text-center" data-priority="1">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <!--En esta table listamos las OFERTAS que se van
                    Agregando por cada Empresa.-->
                    <tr v-for="agregar in listarCertificados" :key="agregar.id">
                        <td class="text-dark text-center" scope="row">{{agregar.id}}</td>
                        <td class="text-dark text-center"><a id="descargar" :href="'/curriculumPracticantes/'+ agregar.rutaCurriculum">{{ agregar.rutaCurriculum }}</a></td>
                        <td class="text-dark text-center">
                            <button type="button" @click="abrirModalEditar(agregar)" data-toggle="modal" data-target="#edit" class="btn btn-warning btnEditar"><i class="fas fa-history"> Editar</i></button>
                            <button type="button" class="btn btn-danger" @click="eliminar(agregar)"><i class="fas fa-times-circle"> Eliminar</i></button>
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
                        <h5 class="modal-title mx-auto agregarOfertaTitulo">{{titulo}}</h5>
                    </div>
                    <div class="modal-body mx-auto">
                        <form action="">
                            <div class="form-group">
                                <label for="">Curriculum</label>
                                <input type="file" class="form-control" @change="select_file">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer mx-auto">
                        <button type="submit" class="btn btn-primary" @click.prevent="editarDatos();" v-if="btnEditar">Actualizar</button>
                        <button type="submit" class="btn btn-primary" @click.prevent="crear()" v-if="btnCrear">Registrar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    </div>
                </div>
            </div>
        <!--Fin modal EDITAR.-->
    </div>
</template>
<script>
/*Debemos importar las dependencias de DataTables*/
import datatable from 'datatables.net-bs4';
export default {
    data() {
        return {
            listarCertificados:[],
            obtrCertificados:[],
            editamos: [],
            btnCrear: false,
            btnEditar:false,
            titulo:null,
            api_token: localStorage.getItem('respuesta'),
            fields: {
                img:null,
                id: null,
            },
        };
    },
    mounted(){
        this.obtenerCertificados();
        //this.tablaListarCurriculum();
    },
    methods: {
        tablaListarCurriculum(){
            //var dt = $("#tablaCurriculum").DataTable();
            //dt.destroy();
            /*Así se debe inicilizar en Vuejs, this.$nextTick, 
            que vendría siendo como el document.ready. de JQUERY.*/
            this.$nextTick(()=>{
                    $('#tablaCurriculum').DataTable({
                        'destroy'     : true,
                        'paging'      : true,
                        'lengthChange': true,
                        'searching'   : true,
                        'ordering'    : true,
                        'order'       : [[ 5, 'desc' ]],
                        'info'        : true,
                        'autoWidth'   : false,
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
        obtenerCertificados(){
            axios.get("/api/practicantes/curriculumPracticantes",{headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${this.api_token}`
                }
            })
            .then(response => {
                this.listarCertificados = response.data;
                this.listarCertificados.length;
                this.tablaListarCurriculum();
                if (this.listarCertificados.length > 0) {
                    $('.btnAgregar').hide();
                }
            });
        },
        //Método para la descarga del Practicante.
        certificado(y){
            var carpeta = "curriculumPracticantes/" + y;
            console.log(carpeta);
            debugger;
            var images = y;
            //Funcionando correctamente la descarga de archivos.
            $("#descargar").attr("href", carpeta);
        },
        abrirModalCrear(){
            this.titulo = 'Agregar Curriculum';
            this.btnCrear = true;
            this.btnEditar=false;
            /*Desaparecer la etiqueta IMAGEN cuandp se va solo a agregar un Curso.*/
            $('#insertarOferta').modal('show');
            $('#cerrarModalInsertar').on('click', function(){
                $('#modalOfertas').modal('show');
            });   
        },
        abrirModalEditar(agregar){
            this.editamos = {id: agregar.id, rutaCurriculum: agregar.rutaCurriculum};
            this.titulo = 'Editar Curriculum';
            this.btnCrear = false;
            this.btnEditar=true;
        },
        select_file(e){
            this.fields.img = e.target.files[0];
        },
        editarDatos(){
            this.fields.img;
            this.fields.id = this.editamos.id;
            let fields = new FormData();
            for(let key in this.fields){
                fields.append(key, this.fields[key])
            }
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post('/api/practicantes/editarCurriculum', fields,{headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${this.api_token}`
                }
            },{
                headers: {
                  'Content-Type': 'multipart/form-data'
                }   
            })
            .then(response => {
                if (response.data.status === '1'){
                    Swal.fire({
                        title: "Actualización Correcta",
                        icon: "success",
                    });
                    $('#tablaCurriculum').DataTable().destroy();
                     this.obtenerCertificados();
                    $('#edit').modal('hide');
                }else if (response.data.status === '2'){
                    Swal.fire({
                        title: "El campo curriculum no puede estar vacío",
                        icon: "error",
                    });
                }
            });
        },
        crear(){
            this.fields.img;
            let fields = new FormData();
            for (let key in this.fields) {
                fields.append(key, this.fields[key])
            }
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post('/api/practicantes/crearCurriculum', fields,{headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${this.api_token}`
                }
            },{
                headers: {
                  'Content-Type': 'multipart/form-data'
                }   
            })
            .then(response => {
                if (response.data.status === '1'){
                    Swal.fire({
                        title: "Curriculum agregado con éxito",
                        text: "Tu curriculum está disponible",
                        icon: "success",
                    });
                    $('#tablaCurriculum').DataTable().destroy();
                    this.obtenerCertificados();
                    //$('#tablaCurriculum').DataTable().draw();
                    //$('#tablaCertificado').DataTable().draw();
                    $('#edit').modal('hide'); 
                }  
            });
        },
        //Método funcionando correctamente.
        eliminar(datos){
            let nombreCurso = datos.nombreCurso;
            let id = datos.id;
            Swal.fire({
                title: "¿ Estas seguro de Eliminar el Curriculum ?",
                text: "El curriculum se eliminará permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar Curriculum'
            })
            .then((willDelete) => {
                if (willDelete.isConfirmed == true) {
                    axios.delete('/api/practicantes/eliminar_curriculum/' + id,{headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${this.api_token}`
                }
            })
                    .then(resp => {
                        Swal.fire({
                            title: "Listo!",
                            text: "El Curriculum ha sido Eliminado correctamente!",
                            icon: "success",
                            button: "OK",
                        });
                        $('#tablaCurriculum').DataTable().destroy();
                        this.obtenerCertificados();
                        $('.btnAgregar').show();
                        $('#edit').modal('hide');   
                    }).catch(error=>{
                            let errorObject=JSON.parse(JSON.stringify(error));
                    })
                } 
            });
        },
    }
}
</script>
<style lang="scss">
.tcert{
    background-color:#F5ECCE;
}
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>