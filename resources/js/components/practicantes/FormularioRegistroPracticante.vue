<template>
    <div id="formRegistroPrac">
        <form action="" enctype="multipart/form-data" onsubmit="comprobarChecks(event);">
                <div class="container">
                    <h1>Inscripción Telepracticantes</h1>
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nombre_completo">nombre Completo</label>
                            <input type="text" v-model="form.nombre_completo" class="form-control-sm" style="display: block" name="nombre_completo" id="nombre_completo">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="rut">Rut</label>
                            <input type="text" v-model="form.rut" class="form-control-sm" style="display: block" name="rut" id="rut">
                            <small class="text-danger">Por su seguridad, verificaremos su R.U.T</small>
                        </div>

                    </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label for="nombre_completo">Email</label>
                            <input type="email" v-model="form.email" class="form-control-sm" style="display: block" name="email" id="email">
                            <small class="text-danger">Por su seguridad, verificaremos su email</small>

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input type="text" v-model="form.telefono" class="form-control-sm" style="display: block" name="telefono" id="telefono">

                            </div>
                        </div>
                    </div>
               
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label>Región</label>
                            <select name="" id="" v-model="form.region">
                                <option v-for="opcion in region" :value="opcion.id" :key="opcion.id">
                                    {{ opcion.nombre }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Comuna</label>
                                <select name="" id="" v-model="form.comuna">
                                    <option v-for="opcion in comuna" :value="opcion.id" :key="opcion.id">
                                    {{ opcion.nombre }}
                                </option>
                                </select>
                            </div>
                        </div>
                </div> 
                    
                    <div class="row">
                        <div class="col habilidadBlanda">
                            <label for="">Habilidades Blandas (escoger 3)</label>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input hab_blandas" v-model="form.habilidades_blandas" name="habilidades_blandas[]" id="habilidades_blandas" value="comunicacion">
                            <label class="form-check-label" for="habilidades_blandas">Comunicación</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input hab_blandas" v-model="form.habilidades_blandas" name="habilidades_blandas[]" id="habilidades_blandas" value="tolerancia">
                            <label class="form-check-label" for="habilidades_blandas">Tolerancia</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input hab_blandas" v-model="form.habilidades_blandas" name="habilidades_blandas[]" id="habilidades_blandas" value="respeto">
                            <label class="form-check-label" for="habilidades_blandas">Respeto</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input hab_blandas" v-model="form.habilidades_blandas" name="habilidades_blandas[]" id="habilidades_blandas" value="amabilidad">
                            <label class="form-check-label" for="habilidades_blandas">Amabilidad</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input hab_blandas" v-model="form.habilidades_blandas" name="habilidades_blandas[]" id="habilidades_blandas" value="creatividad">
                            <label class="form-check-label" for="habilidades_blandas">Creatividad</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input hab_blandas" v-model="form.habilidades_blandas" name="habilidades_blandas[]" id="habilidades_blandas" value="responsabilidad">
                            <label class="form-check-label" for="habilidades_blandas">Responsabilidad</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input hab_blandas" v-model="form.habilidades_blandas" name="habilidades_blandas[]" id="habilidades_blandas" value="confianza">
                            <label class="form-check-label" for="habilidades_blandas">Confianza</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="form-check-input hab_blandas" v-model="form.habilidades_blandas" name="habilidades_blandas[]" id="habilidades_blandas" value="otro">
                            <label class="form-check-label" for="habilidades_blandas">Otro</label>
                            </div>
                    </div>   
             
                    <div class="col">
                        <label for="">Habilidades Profesionales (escoger 3)</label>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="proactividad">
                        <label class="form-check-label" for="habilidades_profesionales">Proactividad</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="trabajoEquipo">
                        <label class="form-check-label" for="habilidades_profesionales">Trabajo en Equipo</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="adaptacionCambio">
                        <label class="form-check-label" for="habilidades_profesionales">Adaptación al Cambio</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="trabajoBajoPresion">
                        <label class="form-check-label" for="habilidades_profesionales">Trabajo Bajo Presión</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="estableceMetasConcretas">
                        <label class="form-check-label" for="habilidades_profesionales">Establece Metas Concretas</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="responsabilidad">
                        <label class="form-check-label" for="habilidades_profesionales">Responsabilidad</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="productividad">
                        <label class="form-check-label" for="habilidades_profesionales">Productividad</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="eficacia">
                        <label class="form-check-label" for="habilidades_profesionales">Eficacia</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="resolucionConflictos">
                        <label class="form-check-label" for="habilidades_profesionales">Resolución de Conflictos</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input hab_prof" v-model="form.habilidades_profesionales" name="habilidades_profesionales[]" id="habilidades_profesionales" value="otra">
                        <label class="form-check-label" for="habilidades_profesionales">Otra</label>
                        </div>
                    </div>
                </div>
               
                    <div class="container mt-5">
                            <h1>Antecedentes Educacionales</h1>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="institucionEducativa">institución Educativa</label>
                                    <select name="" id="" v-model="form.institucion">
                                    <option v-for="opcion in instituciones" :value="opcion.id" :key="opcion.id">
                                        {{ opcion.nombre }}
                                    </option>
                                </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="mencion">Mención</label>
                                    <input type="text" v-model="form.mencion" class="form-control-sm" style="display: block" name="mencion" id="mencion">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="institucionEducativa">Nivel Educacional</label>
                                    <select name="" id="" v-model="form.educacion">
                                    <option v-for="opcion in educacion" :value="opcion.id" :key="opcion.id">
                                        {{ opcion.nombre }}
                                    </option>
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                
                <div class="container mt-5">
                    <h1>Antecedentes de la Telepráctica</h1>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="tipoPractica">Tipo de Práctica</label>
                                <select name="" id="" v-model="form.practica">
                                    <option v-for="opcion in practica" :value="opcion.id" :key="opcion.id">
                                        {{ opcion.nombre }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="cantidadHora">Cantidad de Horas</label>
                                <input type="number" v-model="form.cantidadHora" class="form-control-sm" style="display: block" name="cantidadHora" id="cantidadHora">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="cantidadMeses">Cantidad de Meses</label>
                                <input type="number" v-model="form.cantidadMeses" class="form-control-sm" style="display: block" name="cantidadMeses" id="cantidadMeses">

                            </div>
                        </div>
                    </div>
                </div>
                
                    <div class="container">
                        <label for="EquipoPropio">Equipo Computacional Propio</label>
                        <div class="row">
                            <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" v-model="form.equipoComputacional" type="radio" name="equipoComputacional" id="equipoComputacional" value="Si">
                                <label class="form-check-label">Si</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" v-model="form.equipoComputacional" name="equipoComputacional" id="equipoComputacional" value="No">
                                <label class="form-check-label">No</label>
                            </div>
                        </div>                        
                        </div>                     
                    </div>
                    
                    <div class="container">
                    <label for="" class="mt-3">Internet Fijo</label>
                        <div class="row">
                        <div class="col">
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" v-model="form.internetFijo" name="internetFijo" id="internetFijo" value="Si">
                            <label class="form-check-label">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" v-model="form.internetFijo" name="internetFijo" id="internetFijo" value="No">
                            <label class="form-check-label">No</label>
                        </div>
                        </div> 
                        </div>
                    </div>
                
                <div class="container mt-5">
                <h1>Cursos y Especificaciones</h1>
                    <div class="row">
                    <div class="col">
                        <div class="form-group">
                        <label for="nombreCurso">Nombre</label>
                        <input type="text" class="form-control-sm" v-model="form.nombreCurso" style="display: block" name="nombreCurso" id="nombreCurso">

                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="profesionalCargo">Profesional a cargo</label>
                            <input type="text" class="form-control-sm" v-model="form.profesionalCargo" style="display: block" name="profesionalCargo" id="profesionalCargo">

                        </div>
                    </div>
                </div>  
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <label for="duracionCurso">Duración de curso</label>
                            <input type="number" class="form-control-sm" v-model="form.duracionCurso" style="display: block" name="duracionCurso" id="duracionCurso">

                            </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                            <label for="horasCurso">Horas</label>
                            <input type="number" class="form-control-sm" v-model="form.horasCurso" style="display: block" name="horasCurso" id="horasCurso">

                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container">
                    <label for="">Certificación</label>
                    <div class="row">
                    <div class="col">
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" v-model="form.certificacion" name="certificacion" id="certificacion" value="Si">
                        <label class="form-check-label">Si</label>
                        </div>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" v-model="form.certificacion" name="certificacion" id="certificacion" value="No">
                        <label class="form-check-label">No</label>
                        </div>           
                    </div>
                        <div class="col">
                        <div class="form-group">
                            <label for="archivoCurso">Adjuntar archivos de Cursos (Opcional)</label>
                            <input type="file" accept='image/' @change="obtenerImagen" class="form-control-file" id="archivoCurso" name="archivoCurso">
                        </div>
                        </div>
                    </div>
                </div>
                
                <div class="container">
                    <div class="form-group">
                    <h1>Experiencias</h1>
                    <p>Descripción de Experiencia (Nombre, Actividad, Duración, Experiencia, Descripción de funciones y Link)</p>
                    <textarea class="form-control" v-model="form.experiencia" id="experiencia" name="experiencia" rows="3"></textarea>
                    </div>
                    <button type="submit" @click.prevent="registrarPracticante();" class="text-white" name="enviar" id="enviar" style="background-color: #E65131;">Enviar</button>
                </div>
                </div>
        </form>
    </div>
</template>

<style>
</style>
<script>
export default {
    data() {
    return {
        instituciones: [],
        comuna:[],
        region:[],
        educacion:[],
        practica:[],
        id:null,
        nombre_completo:null,
        rut: null,
        email: null,
        telefono:null,
        region: null,
        comuna: null,
        institucion:null,
            mencion:null,
            educacion:null,
            practica:null,
            cantidadHora:null,
            cantidadMeses:null,
            equipoComputacional:null,
            internetFijo:null,
            nombreCurso:null,
            profesionalCargo:null,
            duracionCurso:null,
            horasCurso:null,
            certificacion:null,
            imagen:'',
            imagensita:null,
            tipoImagen: null,
            experiencia: null,
            img:null,
            habilidad:null,
        form: new Form({
            habilidades_blandas:[],
            habilidades_profesionales:[],
        }),
    };
  },
    mounted(){
        this.obtenerRegion();
        this.obtenerComuna();
        this.obtenerInstitucion();
        this.educacional();
        this.tipoPractica();
        this.habilidadBlandas();
        this.habilidadesProf();
    },
    methods: {
        //Funcionando correctamente.
        obtenerRegion(){
            axios.get("listarRegion")
            .then(response => {
                console.log(this.region = response.data);
            })
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        //Funcionando correctamente.
        obtenerComuna(){
            axios.get("listarComunas")
            .then(response => {
                console.log(this.comuna = response.data);
            })
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        //Funcionando correctamente.
        obtenerInstitucion(){
            axios.get("insti")
            .then(response => {
                console.log(this.instituciones = response.data);
            })
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        //Funcionando correctamente.
        educacional(){
            axios.get("nivelEduc")
            .then(response => {
                console.log(this.educacion = response.data);
            })
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        //Funcionando correctamente.
        tipoPractica(){
            axios.get("prac")
            .then(response => {
                console.log(this.practica = response.data);
            })
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        habilidadBlandas(){
            $('.hab_blandas').on('change', function(){
                var checkbox = document.getElementsByName('habilidades_blandas[]');
                var contador = 0;
                var max = 3;
                for(var i=0; i< checkbox.length; i++) {
                    if(checkbox[i].checked){
                        contador++;
                        console.log('mas');
                        if(contador > max){
                                Swal.fire({
                                title: "Solo pueden ser 3 habilidades!",
                                icon: "warning",
                            });
                            event.preventDefault();
                        }
                    }     
                }
            });
        },
        habilidadesProf(){
            $('.hab_prof').on('change', function(){
                    var checkbox = document.getElementsByName('habilidades_profesionales[]');
                    var contador = 0;
                    var max = 3;
                    for(var i=0; i< checkbox.length; i++) {
                        if(checkbox[i].checked){
                            contador++;
                            console.log('mas');
                            if(contador > max){
                                 Swal.fire({
                                    title: "Solo pueden ser 3 habilidades!",
                                    icon: "warning",
                                });
                                event.preventDefault();
                            }
                        }     
                    }
                });
        },
        obtenerImagen(event){
            let selectedFile = event.target.files[0];
            this.form.img = selectedFile;
        },
        //Funcionando correctamente por Jair.
        //Me faltan las validaciones.
        registrarPracticante(){
            var formDa = new FormData();
            formDa.append('cantidadHora',this.form.cantidadHora);
            formDa.append('cantidadMeses',this.form.cantidadMeses);
            formDa.append('certificacion',this.form.certificacion);
            formDa.append('comuna',this.form.comuna);
            formDa.append('duracionCurso',this.form.duracionCurso);
            formDa.append('educacion',this.form.educacion);
            formDa.append('email',this.form.email);
            formDa.append('equipoComputacional',this.form.equipoComputacional);
            formDa.append('experiencia',this.form.experiencia);
            formDa.append('hab',this.form.habilidades_blandas);
            formDa.append('hab_profs',this.form.habilidades_profesionales);
            formDa.append('horasCurso',this.form.horasCurso);
            formDa.append('img',this.form.img);
            formDa.append('institucion',this.form.institucion);
            formDa.append('internetFijo',this.form.internetFijo);
            formDa.append('mencion',this.form.mencion);
            formDa.append('nombreCurso',this.form.nombreCurso);
            formDa.append('nombre_completo',this.form.nombre_completo);
            formDa.append('practica',this.form.practica);
            formDa.append('profesionalCargo',this.form.profesionalCargo);
            formDa.append('region',this.form.region);
            formDa.append('rut',this.form.rut);
            formDa.append('telefono',this.form.telefono);
            
            /*Es necesaria para los files.*/
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post('/formPrac', formDa,{
                headers: {
                  'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                console.log(response);
                 if (response.data.status == '1') {
                    Swal.fire({
                        title:'Éxito al registrarte!',
                        text: "Recuerda, estos campos pueden ser editados desde tu DASHBOARD",
                        icon: "success",
                    });
                    location.href = "http://telepractica-vue.test:8080/login";
                 }else if (response.data.status == '2') {
                    Swal.fire({
                        title:'El email o el rut son incorrectos',
                        text: "Verifica tu email",
                        icon: "warning",
                    });
                 }else if (response.data.status == '3') {
                    Swal.fire({
                        title: "Deben ser 3 habilidades",
                        icon: "warning",
                    });
                 }
            })
            .catch(e => {
                 Swal.fire({
                        title: "No pueden quedar campos vacíos",
                        icon: "warning",
                    });
                //this.$toastr.e("No se pudo bajar usuario", "Error");
            });
        },
    },
}
</script>