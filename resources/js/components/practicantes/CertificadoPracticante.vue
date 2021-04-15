<template>
    <div id="certificadoPracticante" class="mt-5">
            <div class="container mx-auto tcert mb-5">
                <center>
                    <div class="container mt-5">
                        <button class="btn btn-success btnAgregar mt-5" @click="abrirModalCrear();" data-toggle="modal" data-target="#edit"><i class="fas fa-user-plus"></i> Agregar Curso</button>
                    </div>
                </center>
            <div class="table-responsive">
                    <table id="tablaCertificado" class="table display table-bordered responsive" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#ID</th>
                        <th scope="col" class="text-center">Nombre del Curso</th>
                        <th scope="col" class="text-center">Profesional a cargo del Curso</th>
                        <th scope="col" class="text-center">Duración Meses del Curso</th>
                        <th scope="col" class="text-center">Horas del Curso</th>
                        <th scope="col" class="text-center">Certificación</th>
                        <th scope="col" class="text-center">Certificado</th>
                        <th scope="col" class="text-center" data-priority="1">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <!--En esta table listamos las OFERTAS que se van
                    Agregando por cada Empresa.-->
                    <tr v-for="agregar in listarCertificados" :key="agregar.id">
                        <td class="text-dark text-center" scope="row">{{agregar.id}}</td>
                        <td class="text-dark text-center">{{agregar.nombreCurso}}</td>
                        <td class="text-dark text-center">{{agregar.nombreProfesionalCurso}}</td>
                        <td class="text-dark text-center">{{agregar.duracionMesesCurso}}</td>
                        <td class="text-dark text-center">{{agregar.duracionHorasCurso}}</td>
                        <td class="text-dark text-center">{{agregar.certificacion}}</td>
                        <td class="text-dark text-center"><a id="descargar" :href="'/certificacion/'+ agregar.rutaArchivo">{{ agregar.rutaArchivo }}</a></td>
                        <td class="text-dark text-center">
                            <button type="button" @click="abrirModalEditar(agregar)" data-toggle="modal" data-target="#edit" class="btn btn-warning btnEditar">Editar</button>
                            <button type="button" class="btn btn-danger mt-2" @click="eliminar(agregar)">Eliminar</button>
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
                        <div class="imagen">
                        <h3>Certificado Actual</h3>
                            <center>
                                <img :src="'/certificacion/'+ editamos.rutaArchivo" class="img-responsive mt-3" 
                                height="120" width="200">
                            </center>
                        </div> 
                        <form action="" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" v-model="editamos.id">
                            <div class="form-group mt-5">
                                <label for="">Nombre del Curso</label>
                                <input type="text" class="form-control" id="nombreCurso" name="nombreCurso" v-model="editamos.nombreCurso">
                            </div>
                            <div class="form-group">
                                <label for="">Profesional a cargo del Curso</label>
                                <input type="text" class="form-control" id="nombreProfesionalCurso" name="nombreProfesionalCurso" v-model="editamos.nombreProfesionalCurso">
                            </div>
                            <div class="form-group">
                                <label for="">Duración en Meses del Curso</label>
                                <input type="number" class="form-control" id="duracionMesesCurso" name="duracionMesesCurso" v-model="editamos.duracionMesesCurso">
                            </div>
                            <div class="form-group">
                                <label for="">Duración en Horas del Curso</label>
                                <input type="number" class="form-control" id="duracionHorasCurso" name="duracionHorasCurso" v-model="editamos.duracionHorasCurso">
                            </div>
                            <div class="form-group">
                                <label for="">Certificación</label>
                                <input type="text" class="form-control" id="certificacion" name="certificacion" v-model="editamos.certificacion">
                            </div>
                            <div class="form-group">
                                <label for="">Certificado</label>
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
export default {
    data() {
        return {
            listarCertificados:[],
            obtrCertificados:[],
            editamos: [],
            btnCrear: false,
            btnEditar:false,
            titulo:null,
            fields: {
                nombreCurso:null,
                nombreProfesionalCurso:null,
                duracionMesesCurso:null,
                duracionHorasCurso:null,
                certificacion:null,
                nombreCurso:null,
                img:null,
                id: null,
            },
        };
    },
    mounted(){
        this.obtenerCertificados();
        //this.tablaOferta();
    },
    methods: {
        tablaOferta(){
            /*Así se debe inicilizar en Vuejs, this.$nextTick, 
            que vendría siendo como el document.ready. de JQUERY.*/
            this.$nextTick(()=>{
            $('#tablaCertificado').DataTable({
                'responsive': true,
                'autoWidth': false,
                'destroy':true,
                'stateSave': true,
                lengthMenu: [
                [5, 10, 25, 50, 100],
                [5, 10, 25, 50, 100],
            ],
          order: [[0, "desc"]],
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },  
                }).draw();
            });
        },
        obtenerCertificados(){
            axios.get("/api/practicante/certificadosPracticantes")
            .then(response => {
                this.listarCertificados = response.data;
                this.tablaOferta();
            });
        },
        //Método para la descarga del Practicante.
        certificado(y){
            var carpeta = "certificacion/" + y;
            console.log(carpeta);
            debugger;
            var images = y;
            //Funcionando correctamente la descarga de archivos.
            $("#descargar").attr("href", carpeta);
        },
        abrirModalCrear(){
            $('.imagen').hide();
            this.editamos = {nombreCurso: this.nombreCurso, nombreProfesionalCurso: this.nombreProfesionalCurso,
                                duracionMesesCurso: this.duracionMesesCurso, duracionHorasCurso: this.duracionHorasCurso,
                                certificacion: this.certificacion, rutaArchivo: this.rutaArchivo};
            console.log(this.editamos);
            debugger;
            this.titulo = 'Agregar Cursos';
            this.btnCrear = true;
            this.btnEditar=false;
            /*Desaparecer la etiqueta IMAGEN cuandp se va solo a agregar un Curso.*/
            $('#insertarOferta').modal('show');

            $('#cerrarModalInsertar').on('click', function(){
                $('#modalOfertas').modal('show');
            });   
        },
        abrirModalEditar(agregar){
            $('.imagen').show();
            this.editamos = {id: agregar.id,  nombreCurso: agregar.nombreCurso, nombreProfesionalCurso: agregar.nombreProfesionalCurso,
                                duracionMesesCurso: agregar.duracionMesesCurso, duracionHorasCurso: agregar.duracionHorasCurso,
                                certificacion: agregar.certificacion, rutaArchivo: agregar.rutaArchivo};
            this.titulo = 'Editar Cursos';
            this.btnCrear = false;
            this.btnEditar=true;
        },
        select_file(e){
            this.fields.img = e.target.files[0];
            console.log(this.fields.img);
        },
        editarDatos(){
            this.fields.id = this.editamos.id;
            let id = this.fields.id;
            this.fields.nombreCurso = this.editamos.nombreCurso;
            this.fields.nombreProfesionalCurso = this.editamos.nombreProfesionalCurso;
            this.fields.duracionMesesCurso = this.editamos.duracionMesesCurso;
            this.fields.duracionHorasCurso = this.editamos.duracionHorasCurso ;     
            this.fields.certificacion = this.editamos.certificacion;  

            let id_certificado = {
                'id': this.fields.id,
            }
            let fields = new FormData();
            for (let key in this.fields) {
                fields.append(key, this.fields[key])
            }
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post('/admin/practicante/editarCertificado', fields,{
                headers: {
                  'Content-Type': 'multipart/form-data'
                }   
            })
            .then(response => {
                if (response.data.status === '1'){
                    Swal.fire({
                        title: "Actualización Correcta",
                        text: "Esta acción puede ser revertida más tarde",
                        icon: "success",
                    });
                    $('#tablaCertificado').DataTable().destroy();
                    
                    this.obtenerCertificados();
                    
                    $('#edit').modal('hide');
                }
            });
        },
        crear(){
            this.fields.id = this.editamos.id;
            let id = this.fields.id;
            this.fields.nombreCurso = this.editamos.nombreCurso;
            this.fields.nombreProfesionalCurso = this.editamos.nombreProfesionalCurso;
            this.fields.duracionMesesCurso = this.editamos.duracionMesesCurso;
            this.fields.duracionHorasCurso = this.editamos.duracionHorasCurso ;     
            this.fields.certificacion = this.editamos.certificacion;  

            let fields = new FormData();
            for (let key in this.fields) {
                fields.append(key, this.fields[key])
            }
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post('/admin/practicante/crearCurso', fields,{
                headers: {
                  'Content-Type': 'multipart/form-data'
                }   
            })
            .then(response => {
                if (response.data.status === '1'){
                    Swal.fire({
                        title: "Curso Creado con éxito",
                        text: "Tu curso nuevo se mostrará en la lista",
                        icon: "success",
                    });
                    //$('#tablaDatosPersonales').DataTable().destroy();
                    //this.tablaOferta();
                    $('#tablaCertificado').DataTable().destroy();               
                    console.log(this.obtenerCertificados());
                    $('#edit').modal('hide');
                }
            });
        },
        //Método funcionando correctamente.
        eliminar(datos){
            let nombreCurso = datos.nombreCurso;
            let id = datos.id;
            //console.log(id);
            //debugger;
            Swal.fire({
                title: "¡Estas seguro de Eliminar el Curso: " + nombreCurso + "?",
                text: "La Oferta se eliminará permanentemente",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/admin/practicante/eliminar_curso/' + id)
                    .then(resp => {
                        Swal.fire({
                            title: "Listo!",
                            text: "La Oferta ha sido Eliminada correctamente!",
                            icon: "success",
                            button: "OK",
                        });
                        $('#tablaCertificado').DataTable().destroy();               
                        this.obtenerCertificados();
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
    background-color:#BDBDBD;
}
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>