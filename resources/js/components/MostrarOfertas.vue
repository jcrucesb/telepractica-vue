<template>
    <div id="mostraroferta">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <!---->
                    <div id="registrarPracticante" style="display: none;">
                        <registroprac-component ref="modalShow"></registroprac-component>
                    </div>
                    <!---->
                    <!---->
                    <a type="button" href="#" class="" data-toggle="modal" data-target="#PractRegis">
                        <div class="card border-success mb-3"  v-for="prac in listarOferta" :key="prac.id" style="max-width: 18rem;">
                        <div class="card-header bg-transparent border-success mx-auto">{{prac.razon_social}}</div>
                        <div class="card-body text-success mx-auto">
                            <h5 class="card-title text-dark mr-2">Oferta: </h5> <p>{{prac.nombre_oferta}}</p>
                            <p class="card-text text-dark">Descripción: </p> <p class="" >{{prac.descripcion}}</p>
                            <p class="card-text text-dark">Remunerada: </p> <p class="" >{{prac.remunerada}}</p>
                            <p class="card-text text-dark">Cupos Disponibles: </p> <p class="" >{{prac.cupos_totales}}</p>
                            <p class="card-text text-dark">R. mínimos: </p> <p class="" >{{prac.requisitos_min}}</p>
                        </div>
                        <div class="card-footer bg-transparent border-success mx-auto">Postula ya desde tu dashboard</div>
                    </div>
                    </a>
                    <!---->
                </div>
            </div>
        </div>
        <!---->
            <!-- Modal -->
            <div class="modal fade" id="PractRegis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mx-auto">Registrarse</h5>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <label>Carrera</label>
                                        <select name="" id="" v-model="form.carrera">
                                            <option v-for="opcion in listarCarrera" :value="opcion.id" :key="opcion.id">
                                            {{ opcion.nombre }}
                                        </option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label>Usuario</label>
                                        <input
                                            v-model="form.usuario"
                                            type="text"
                                            name="usuario"
                                            id="usuario"
                                            placeholder="USUARIO"
                                            class="form-control"
                                        />
                                    </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input
                                                v-model="form.email"
                                                type="email"
                                                name="email"
                                                id="email"
                                                placeholder="EMAIL"
                                                class="form-control"
                                            />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label>Password</label>
                                        <input
                                            v-model="form.password"
                                            type="password"
                                            name="password"
                                            id="password"
                                            placeholder="password"
                                            class="form-control"
                                        />
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer mx-auto">
                    <button type="button" class="btn btn-success" @click.prevent="regisPracticante();">Registrarse</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
            </div>
        <!--Fin Modal.-->
    </div>
</template>
<style>
    
</style>
<script>
//Llamaremos al componente hijo.
import RegistrarPracticante from '../components/RegistrarPracticante.vue';

export default {
    name: 'RegistrarPracticante',
    components:{
        RegistrarPracticante
    },
    data() {
        return {
            listarOferta: [],
            oferta: [],
            listarCarrera: [],
            form: new Form({
                carrera: null,
                usuario:null,
                email: null,
                password: null,
            }),
        };
    },
    mounted(){
        this.obtenerOferta();
        this.carreras();
    },
    methods: {
        obtenerOferta(){
            axios.get("listarOfertas")
            .then(response => {
                console.log(response);
                console.log(this.listarOferta = response.data);
            })
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        carreras(){
            axios.get("listarCarreras")
            .then(response => {
                console.log(this.listarCarrera = response.data);
            })
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        regisPracticante(){
            this.form
            .post("registPrac")
            .then(() => {
                Swal.fire({
                    title: "Revisa tu correo y termina de registrarte",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Aceptar",
                });
            this.$toastr.s("Practicante Registrada Correctamente", "Registro");
            $("#PractRegis").modal("hide");
            $('#usuario').val('');
            $('#email').val('');
            $('#password').val('');
            })
            .catch(() => {
            this.$toastr.e("No se pudo guardar el registro", "Error");
            });
        },
    },
}
</script>