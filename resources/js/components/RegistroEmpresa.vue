<template>
    <div id="registroEmpresa">
       <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrarEmpresa">
  Registrar Empresa
</button>

<!-- Modal -->
<div class="modal fade" id="registrarEmpresa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header mx-auto">
        <h5 class="modal-title" id="staticBackdropLabel">Registra tu Empresa</h5>
      </div>
      <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <!---->
                        <div class="form-group">
                            <label>R.U.N.</label>
                            <input
                                v-model="form.run"
                                type="text"
                                name="run"
                                placeholder="R.U.N."
                                class="form-control"
                            />
                            <!--<has-error :form="form" field="run"></has-error>-->
                        </div>
                        <!---->
                    </div>
                    <div class="col">
                        <!---->
                        <div class="form-group">
                        <label>Email</label>
                        <input
                            v-model="form.email"
                            type="email"
                            name="email"
                            placeholder="Email"
                            class="form-control"
                        />
                        </div>
                        <!---->
                    </div>
                    <div class="col">
                        <!---->
                        <div class="form-group">
                        <label>Razon Social</label>
                        <input
                            v-model="form.razon_social"
                            type="text"
                            name="razon_social"
                            placeholder="Razon Social"
                            class="form-control"
                        />
                        </div>
                        <!---->
                    </div>
                    <div class="container">
                        <div class="row">
                        <div class="col">
                            <!---->
                            <div class="form-group">
                            <label>N. Ficticio</label>
                            <input
                                v-model="form.nombre_ficticio"
                                type="text"
                                name="nombre_ficticio"
                                placeholder="Nombre Ficticio"
                                class="form-control"
                            />
                            </div>
                            <!---->
                        </div>
                        <div class="col">
                            <!---->
                            <div class="form-group">
                            <label>Giro</label>
                            <input
                                v-model="form.giro"
                                type="text"
                                name="giro"
                                placeholder="giro"
                                class="form-control"
                            />
                            </div>
                            <!---->
                        </div>
                        <div class="col">
                            <!---->
                            <div class="form-group">
                            <label>Descripción</label>
                            <input
                                v-model="form.descripcion"
                                type="text"
                                name="descripcion"
                                placeholder="Descripción"
                                class="form-control"
                            />
                            </div>
                            <!---->
                        </div>
                        <!---->
                        <div class="col">
                            <!---->
                            <div class="form-group">
                            <label>Usuario</label>
                            <input
                                v-model="form.usuario"
                                type="text"
                                name="usuario"
                                placeholder="Usuario"
                                class="form-control"
                            />
                            </div>
                            <!---->
                        </div>
                        <!---->
                    </div>
                    </div>
                    <div class="container">
                        <div class="row">
                        <div class="col">
                            <!---->
                            <div class="form-group">
                            <label>WEB</label>
                            <input
                                v-model="form.web"
                                type="text"
                                name="web"
                                placeholder="WEB"
                                class="form-control"
                            />
                            </div>
                            <!---->
                        </div>
                        <div class="col">
                            <!---->
                            <div class="form-group">
                            <label>Teléfono</label>
                            <input
                                v-model="form.telefono"
                                type="text"
                                name="telefono"
                                placeholder="Teléfono"
                                class="form-control"
                            />
                            </div>
                            <!---->
                        </div>
                        <div class="col">
                            <!---->
                            <div class="form-group">
                            <label>Dirección</label>
                            <input
                                v-model="form.direccion"
                                type="text"
                                name="direccion"
                                placeholder="Dirección"
                                class="form-control"
                            />
                            </div>
                            <!---->
                        </div>
                        <!---->
                        <div class="col">
                            <!---->
                            <div class="form-group">
                            <label>Password</label>
                            <input
                                v-model="form.password"
                                type="password"
                                name="direccion"
                                placeholder="Password"
                                class="form-control"
                            />
                            </div>
                            <!---->
                        </div>
                        <!---->
                    </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="modal-footer mx-auto">
        <button type="submit" @click.prevent="registrarEmpresa()" class="btn btn-success">Registrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
    </div>
</template>
<style>

</style>
<script>
export default {
    data() {
    return {
     form: new Form({
        id: null,
        run: null,
        email: null,
        razon_social: null,
        nombre_ficticio: null,
        giro: null,
        descripcion: null,
        usuario:null,
        web: null,
        telefono:null,
        direccion:null,
        password:null,
      }),
    };
  },
    mounted(){
        
    },
    methods: {
        //Funcionando correctamente por Jair.
        registrarEmpresa(){
            this.form
            .post("regitEmpresa")
            .then(() => {
            Fire.$emit("loadEmpresas");
            this.$toastr.s("Empresa Registrada Correctamente", "Registro");
            $("#registrarEmpresa").modal("hide");
            })
            .catch(() => {
            this.$toastr.e("No se pudo guardar el registro", "Error");
            });
        }
    },
}
</script>