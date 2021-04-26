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
                                id="run"
                                placeholder="R.U.N."
                                class="form-control"
                            />
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
                            id="email"
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
                            id="razon_social"
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
                                id="nombre_ficticio"
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
                                id="giro"
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
                                id="descripcion"
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
                                id="usuario"
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
                                id="web"
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
                                id="telefono"
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
                                id="direccion"
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
                                name="password"
                                id="password"
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
        rol_id: 2,
      }),
    };
  },
    mounted(){
        
    },
    methods: {
        //Funcionando correctamente por Jair.
        registrarEmpresa(){
            this.form
            .post("api/empresas/regitEmpresa")
            .then((resp) => {
                if (resp.data.status == '1') {
                    Swal.fire({
                        title: "El correo o el R.U.N ya se encuentran registrado",
                        text: 'Ingrese a su DASHBOARD para crear ofertas',
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Aceptar",
                    });
                }else if (resp.data.status == '3') {
                    Swal.fire({
                        title: "No pueden quedar los campos vacíos",
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Aceptar",
                    });
                }
                else if (resp.data.status == '2') {
                    Swal.fire({
                        title: "Empresa Registrada correctamente",
                        text: 'Revisa tu correo, luego ingrese a su DASHBOARD para crear ofertas',
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Aceptar",
                    });
                    Fire.$emit("loadEmpresas");
                    this.$toastr.s("Empresa Registrada Correctamente", "Registro");
                    $("#registrarEmpresa").modal("hide");
                    $("#run").val("");
                    $("#email").val("");
                    $("#razon_social").val("");
                    $("#nombre_ficticio").val("");
                    $("#giro").val("");
                    $("#descripcion").val("");
                    $("#usuario").val("");
                    $("#web").val("");
                    $("#telefono").val("");
                    $("#direccion").val("");
                    $("#password").val("");
                }
            })
            .catch(() => {
                this.$toastr.e("No pueden haber campos vacíos", "Error");
            });
        }
    },
}
</script>