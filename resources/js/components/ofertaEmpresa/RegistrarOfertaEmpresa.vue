<template>
    <div id="consultar">
    <!--...................................................................................-->
        <div id="listarOfertas">
        <!-- Button trigger modal -->
            <button type="button" @click="listarOfertas()" class="btn btn-warning mb-2 text-white" data-toggle="modal" data-target="#modalOfertas">
            Listar Ofertas Creadas
            </button>   
            <!-- Modal -->
        <div class="modal fade" id="modalOfertas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header header mx-auto">
                    <h5 class="modal-title tituloMostrarOfertas">Ofertas de Prácticas</h5>
                </div>
                <!---->
                <button type="button" @click="abrirModalCrear();" class="btn btnAgregar mt-3" data-toggle="modal" data-target="#insertarOferta">
                    Insertar Oferta +
                </button> 
                <!---->
                <div class="modal-body listar">
                    <div class="table-responsive">
                        <table id="tablaOferta" class="table table-dark display table-bordered responsive" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#ID</th>
                        <th scope="col" class="text-center">Nombre de la Oferta</th>
                        <th scope="col" class="text-center">Descripción de la Oferta</th>
                        <th scope="col" class="text-center">Remunerada</th>
                        <th scope="col" class="text-center">Valor remuneración</th>
                        <th scope="col" class="text-center">Cupos</th>
                        <th scope="col" class="text-center">Inicio Oferta</th>
                        <th scope="col" class="text-center">Termino Oferta</th>
                        <th scope="col" class="text-center">Fecha Creación</th>
                        <th scope="col" class="text-center">Requisitos Min.</th>
                        <th scope="col" class="text-center" data-priority="1">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <!--En esta table listamos las OFERTAS que se van
                    Agregando por cada Empresa.-->
                    <tr v-for="agregar in listarOfertazos" :key="agregar.id">
                        <td class="text-white text-center" scope="row">{{agregar.id}}</td>
                        <td class="text-white text-center">{{agregar.nombre_oferta}}</td>
                        <td class="text-white text-center">{{agregar.descripcion}}</td>
                        <td class="text-white text-center">{{agregar.remunerada}}</td>
                        <td class="text-white text-center">{{agregar.valor_remuneracion}}</td>
                        <td class="text-white text-center">{{agregar.cupos_totales}}</td>
                        <td class="text-white text-center">{{agregar.fecha_inicio}}</td>
                        <td class="text-white text-center">{{agregar.fecha_termino}}</td>
                        <td class="text-white text-center">{{agregar.created_at}}</td>
                        <td class="text-white text-center">{{agregar.requisitos_min}}</td>
                        <td class="text-white text-center">
                            <button type="button" class="btn btn-warning" @click="abrirModalEditar(agregar)">Editar</button>
                            <button type="button" class="btn btn-danger mt-2" @click="eliminar(agregar)">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
                    </div>
                </div>
                <div class="modal-footer footer">
                    <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>
        <!--Modal Insertar Oferta.-->
        <!-- Modal -->
            <div class="modal fade insertarOferta" id="insertarOferta" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-sm">
                <div class="modal-header mx-auto">
                    <h5 class="modal-title agregarOfertaTitulo">{{titulo}}</h5>
                </div>
                <div class="modal-body agregarOferta">
                    <center>
                    <form id="registroOfertas">
                        <!---->
                        <label for="">Area de la Oferta</label>
                        <br>
                        <select v-model="editarOferta.carrera" @click="seleccionCarrera()">
                            <option v-for="opcion in listarCarrera" :value="opcion.nombre" :key="opcion.id">
                                {{ opcion.nombre }}
                            </option>
                        </select>
                        <!---->
                        <br>
                        <div class="form-group">
                            <label for="">nombre de la Oferta</label>
                            <input type="text" v-model="editarOferta.nombre_oferta" name="nombre_oferta" id="nombre_oferta">
                        </div>
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea v-model="editarOferta.descripcion" class="form-control" id="descripcion" name="descripcion" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Remunerada</label>
                            <!---->
                            <select v-model="editarOferta.remunerada" @click="seleccion()">
                                <option v-for="opcion in opciones" :value="opcion.canal" :key="opcion.text">
                                    {{ opcion.text }}
                                </option>
                            </select>
                            <!---->
                            <div class="alert alert-warning" role="alert">
                                Si su Oferta NO cuenta con remuneración, debe completar el campo de abajo, llamado
                                'Valor Remuneración', solo con 0.
                            </div>
                        </div>
                        <div id="valorRem" v-show="show">
                            <div class="form-group">
                                <label for="">Valor Remuneración</label>
                                <input type="number" v-model="editarOferta.valor_remuneracion" name="valor_remuneracion" id="valor_remuneracion">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Fecha Inicio</label>
                            <br>
                            <input type="date" v-model="editarOferta.fecha_inicio" name="fecha_inicio" @click="fechaInicioOferta();" id="fecha_inicio">
                        </div>
                        <div class="form-group">
                            <label for="">Fecha Término</label>
                            <br>
                            <input type="date" v-model="editarOferta.fecha_termino" name="fecha_termino" id="fecha_termino">
                        </div>
                        <div class="form-group">
                            <label for="">Cupos</label>
                            <br>
                            <input type="number" v-model="editarOferta.cupos_totales" name="cupos" id="cupos">
                        </div>
                        <div class="form-group">
                            <label for="">Requisitos</label>
                            <br>
                            <input type="text" v-model="editarOferta.requisitos" name="requisitos" id="requisitos">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" @click.prevent="crear()" v-if="btnCrear">Registrar</button>
                            <button type="submit" class="btn btn-warning" @click.prevent="editar()" v-if="btnEditar">Editar</button>
                            <button type="button" class="btn btn-secondary" id="cerrarModalInsertar" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                    </center>
                </div>
                </div>
            </div>
        </div>
        <!--Fin Modal Insertar Oferta.-->
        </div>
    <!--...................................................................................-->
        <div class="table-responsive">
            <table id="tabla" class="table table-responsive table-dark display table-bordered responsive" style="width:100%">
        <thead>
            <tr>
                <th scope="col" class="text-center">#ID</th>
                <th scope="col" class="text-center">Nombre Completo</th>
                <th scope="col" class="text-center">Run</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" class="text-center">Cant. Horas</th>
                <th scope="col" class="text-center">Cant. Meses</th>
                <th scope="col" class="text-center">Nombre Oferta</th>
                <th scope="col" class="text-center" data-priority="1">Citar Prac</th>
                <th scope="col" class="text-center" data-priority="1">Hora citación</th>
                <th scope="col" class="text-center" data-priority="1">Acción</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="prac in practicante" :key="prac.id">
                <td class="text-white text-center">{{prac.id}}</td>
                <td class="text-white text-center">{{prac.nombre_completo}}</td>
                <td class="text-white text-center">{{prac.run}}</td>
                <td class="text-white text-center">{{prac.email}}</td>
                <td class="text-white text-center">{{prac.cantidad_horas}}</td>
                <td class="text-white text-center">{{prac.cantidad_meses}}</td>
                <td class="text-white text-center">{{prac.nombre_oferta}}</td>
                <td class="text-white text-center">
                    <input type="date" name="fechaCitacion" id="fechaCitacion" @click="fecha();">
                </td>
                <td class="text-white text-center">
                    <input type="time" name="horaCitacion" id="horaCitacion">
                </td>
                <td class="text-dark text-center">
                    <button  type="button" @click.prevent="postulacion();" class="btn btn-success btnPostulacion">Enviar</button>
                </td>
            </tr>
        </tbody>
        </table>
        </div>
    </div>
</template>
<style>
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
.listar{
    background-color: #FAAC58;
}
.tituloMostrarOfertas{
    font-family: 'Akaya Telivigala', cursive;
    font-size: 35px;
    color: #FAAC58;;
}
.btnAgregar{
    background-color: #CAFF33;  
}
/**Body del modal agregar Oferta.*/
.agregarOferta{
    background-color: #BFFF00;
}
.agregarOfertaTitulo{
    font-family: 'Akaya Telivigala', cursive;
    font-size: 35px;
    color: #BFFF00;
}
.modal-body{
    height: 350px;
    overflow-y: auto;
}
</style>
<script>
/*Debemos importar las dependencias de DataTables*/
import datatable from 'datatables.net-bs4';
import Swal from 'sweetalert2';

export default {
    data(){
        return{
            practicante: [],
            curriculum: null,
            empresas_id:'',
            opciones: [
                {text: 'Si', canal: 'Si'},
                {text: 'No', canal: 'No'}
            ],
            show: true,
            agregarOferta: [],
            nombre_oferta:'',
            descripcion:'',
            remunerada: '',
            valor_remuneracion: '',
            fecha_inicio:'',
            fecha_termino:'',
            cupos_totales: '',
            listarOfertazos: [],
            listarCarrera: [],
            carrera:null,
            titulo: '',
            created_at:null,
            requisitos:null,
            editarOferta: [],
            btnCrear: false,
            btnEditar:false,
        };
    },
    mounted(){
        //this.tabla();
        //this.tablaOferta();
        this.getUser();
        this.seleccionCarrera();
    },
    methods:{
        //
        tabla(){
            //this.login();
            /*Así se debe inicilizar en Vuejs, this.$nextTick, 
            que vendría siendo como el document.ready. de JQUERY.*/
            this.$nextTick(()=>{
            $('#tabla').DataTable({
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
            { width: "10%" },
            { width: "8%" },
            { width: "13%" },
            { width: "13%" },
            { width: "13%" },
            { width: "13%" },
            { width: "13%" },
          ],
                });
            });
        },
        //
        tablaOferta(){
            /*Así se debe inicilizar en Vuejs, this.$nextTick, 
            que vendría siendo como el document.ready. de JQUERY.*/
            this.$nextTick(()=>{
            $('#tablaOferta').DataTable({
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
            { width: "9%" },
            { width: "10%" },
            { width: "10%" },
            { width: "10%" },
            { width: "8%" },
            { width: "13%" },
            { width: "13%" },
            { width: "13%" },
            { width: "13%" },
            { width: "13%" },
            { width: "13%" },
          ],  
                });
            });
        },
        fechaInicioOferta(){
            /*Funcionando correctamente, las fechas anteriores a la fecha actual, 
            aparecen deshabilitadas.*/
            let fecha_inicio = document.getElementById("fecha_inicio");
            fecha_inicio.min = new Date().toISOString().split("T")[0];
        },
        fechaTerminoOferta(){
            /*Funcionando correctamente, las fechas anteriores a la fecha actual, 
            aparecen deshabilitadas.*/
            let fecha_termino = document.getElementById("fecha_termino");
            fecha_termino.min = new Date().toISOString().split("T")[0];
        },
        //
        getUser(){
            /**Enviar por axios.*/
            axios.get("/api/practicante/listarPracticantes")
            .then(res => {
                this.practicante = res.data;
                this.tabla();
            })              
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        fecha(){
            /*Funcionando correctamente, las fechas anteriores a la fecha actual, 
            aparecen deshabilitadas.*/
            let fechaCitacion = document.getElementById("fechaCitacion");
            fechaCitacion.min = new Date().toISOString().split("T")[0];
        },
        //Método para la descarga de archivo del CV del Practicante.
        cv(y){
            var carpeta = "curriculum/" + y;
            console.log(carpeta);
            debugger;
            var images = y;
            //Funcionando correctamente la descarga de archivos.
            $("#descargar").attr("href", carpeta);
        },
        /*Botón dinámico si tiene remuneración.*/
        seleccion(){
            if(this.select == 'Si'){
                this.show = this.show;
            } 
            if(this.select == 'No'){
                this.show = !this.show;
            }
        },
        //Este es para listar las carreras disponibles.
        seleccionCarrera(){
            axios.get("/admin/api/carrera/listCarreras")
            .then(res => {
                //
                this.listarCarrera = res.data;
                //debugger;
                $('#tablaOferta').DataTable().destroy();
                this.tablaOferta();
                datatable.rows.add(res.data);
                datatable.draw();
            })              
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        //
        listarOfertas(){
            /**Enviar por axios.*/
            axios.get("/admin/api/oferta/listarOfertas")
            .then(res => {
                //
                this.listarOfertazos = res.data;
                $('#tablaOferta').DataTable().destroy();
                this.tablaOferta();
                datatable.rows.add(res.data);
                datatable.draw();
                /**ACÁ HACEMOS QUE FUNCIONE CORRECTAMENTE CON LOS BOTONES QUE TIENE
                swal({
                    title: "Bienvenido a todas tus ofertas!",
                    button: "Muchas Gracias",
                    icon: "warning",
                });*/
            })              
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        //
        abrirModalCrear(){
            this.editarOferta = {carrera:this.carrera, id: this.id, nombre_oferta: this.nombre_oferta,descripcion: this.descripcion,
                                 remunerada: this.remunerada,valor_remuneracion: this.valor_remuneracion,
                                 cupos: this.cupos, requisitos: this.requisitos ,fecha_inicio:this.fecha_inicio, fecha_termino: this.fecha_termino};
            this.titulo = 'Crear Oferta';
            this.btnCrear = true;
            this.btnEditar=false;

            $('#insertarOferta').modal('show');

            $('#cerrarModalInsertar').on('click', function(){
                $('#modalOfertas').modal('show');
            });   
        },
        crear(){
            let fechaInic = this.editarOferta.fecha_inicio;
            
            let fechaTermino = this.editarOferta.fecha_termino;
            
            if (fechaTermino >= fechaInic) {
                let gu = {
                'carrera': this.editarOferta.carrera,
                'nombre_oferta': this.editarOferta.nombre_oferta,
                'descripcion': this.editarOferta.descripcion,
                'remunerada': this.editarOferta.remunerada,
                'valor_remuneracion': this.editarOferta.valor_remuneracion,
                'fecha_inicio': this.editarOferta.fecha_inicio,
                'fecha_termino': this.editarOferta.fecha_termino,
                'cupos_totales': this.editarOferta.cupos_totales,
                'requisitos': this.editarOferta.requisitos,
                }
                /**Enviar por axios.*/
                axios.post("/admin/empresa/registrarOfer",gu)
                .then(res => {           
                    /*Todo funcionando correctamente.*/
                    if (res.data.status == 'Muy bien!') {
                        /*SweetAlert2.*/
                        Swal.fire({
                        title: 'Oferta Registrada!',
                        text: 'Tu Oferta fue registrada correctamente',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                        });
                        /*Fin al SweetAlert2.*/    
                        this.$toastr.s("Oferta registrada correctamente", "Registro");
                        $('#tablaOferta').DataTable().destroy();               
                        this.listarOfertas();
                        $('#insertarOferta').modal('hide');
                        $("registroOfertas").trigger('reset');
                    }else if(res.data.status == '2'){
                        Swal.fire({
                            title: "Error!",
                            text: "La fecha de inicio de la oferta, no pueder ser menor a la fecha actual",
                            icon: "error",
                            button: "OK",
                        });
                    }else if(res.data.status == '1'){
                        Swal.fire({
                            title: "Error!",
                            text: "La oferta ya se encuentra disponible.",
                            icon: "error",
                            button: "OK",
                        });
                    }else if(res.data.status == '3'){
                        Swal.fire({
                            title: "Error!",
                            text: "Debe seleccionar una carrera.",
                            icon: "error",
                            button: "OK",
                        });
                    }
                    else{
                        Swal.fire({
                            title: "Error!",
                            text: "La Oferta ya existe",
                            icon: "error",
                            button: "OK",
                        });
                    }
                })              
                .catch(error=>{
                    Swal.fire({
                        title: "Precaución!",
                        text: "Error al Crear la Oferta, faltan campos por completar!",
                        icon: "warning",
                        button: "OK",
                        });
                    let errorObject=JSON.parse(JSON.stringify(error));
                })
            }else{
                Swal.fire({
                    title: 'Error!',
                    text: 'La fecha de Término no puede ser inferior a la fecha de Inicio de la Oferta',
                    icon: 'warning',
                });
            }
        },
        //
        abrirModalEditar(agregar){
            this.editarOferta = {carrera: agregar.carrera, id: agregar.id, nombre_oferta: agregar.nombre_oferta,descripcion: agregar.descripcion,
                                remunerada: agregar.remunerada,valor_remuneracion: agregar.valor_remuneracion,
                                cupos_totales: agregar.cupos_totales, requisitos: agregar.requisitos_min ,fecha_inicio:agregar.fecha_inicio, fecha_termino: agregar.fecha_termino};
            this.titulo = 'Editar Oferta';
            this.btnCrear = false;
            this.btnEditar=true;
            this.id = agregar.id;

            $('#insertarOferta').modal('show');

            $('#modalEditarOferta').on('click', function(){
                $('#modalOfertas').modal('hide');
            });
            $('#cerrarModalInsertar').on('click', function(){
                $('#modalOfertas').modal('show');
            });
        },
        editar(){
            axios.put('/admin/empresa/editar_oferta/'+this.id, this.editarOferta)
            .then(resp => {
                Swal.fire({
                    title: "Listo!",
                    text: "La Oferta ha sido Editada!",
                    icon: "success",
                    button: "OK",
                });
                $('#tablaOferta').DataTable().destroy();
                this.listarOfertas();
            }).catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        //Método funcionando correctamente.
        eliminar(datos){
            let nombreOferta = datos.nombre_oferta;
            Swal.fire({
                title: "¡Estas seguro de Eliminar la Oferta: " + nombreOferta + "?",
                text: "La Oferta se eliminará permanentemente",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    axios.delete('/admin/api/oferta/eliminar_oferta/' + datos.id)
                    .then(resp => {
                        Swal.fire({
                        title: "Listo!",
                        text: "La Oferta ha sido Eliminada correctamente!",
                        icon: "success",
                        button: "OK",
                        });
                        $('#tablaOferta').DataTable().destroy();               
                        this.listarOfertas();
                    }).catch(error=>{
                            let errorObject=JSON.parse(JSON.stringify(error));
                    })
                } 
            });
        },
        //Este método es para enviar la fecha de postulación al practicante.
        /*Funcionando correctamente.*/
        postulacion(){
            $(document).on('click', ".btnPostulacion", function (){
                var fila;
                var id_practicante;
                var email_practicante;
                var nombreOferta;
                var fechaCitacion;
                var horaCitacion;
                var nombrePracticante;
                //Nos dirigimos al tr para Obtener los datos.
                fila = $(this).closest("tr");
                //Capturamos el primer elemento, que sería el ID_Producto.
                id_practicante = parseInt(fila.find('td:eq(0)').text());

                nombrePracticante = fila.find('td:eq(1)').text();
                //console.log(id_practicante);
                //Ahora capturamos la 3era posición que es el email del practicante.
                email_practicante = fila.find('td:eq(3)').text();
                //console.log(email_practicante);
                //Editar la imagen.
                nombreOferta = fila.find('td:eq(6)').text();
                //console.log(nombreOferta);
                //fechaCitacion = fila.find('td:eq(12)').text();
                fechaCitacion = fila.find('input[type="date"]').val();
                //
                horaCitacion = fila.find('input[type="time"]').val();

                //Eviaremos los valores por Axios.
                let val = {
                    'id_practicante': id_practicante,
                    'nombrePracticante': nombrePracticante,
                    'email_practicante': email_practicante,
                    'nombreOferta': nombreOferta,
                    'fechaCitacion': fechaCitacion,
                    'horaCitacion': horaCitacion
                }
                console.log(val);
                debugger;
                axios.post('/admin/empresa/enviarPostulacionPracticante',val)
                    .then(resp => {
                       console.log(resp);
                    }).catch(error=>{
                            let errorObject=JSON.parse(JSON.stringify(error));
                    })
            });
            //--------------------------------------
        },
    }
}
</script>