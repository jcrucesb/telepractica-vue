<template>
  <div class="mt-3 mb-3 ml-3 mr-3">
    <div class="card">
      <div class="card-body">
        <h4>
          <i class="fas fa-users"></i> Cuentas
          <button class="btn btn-sm btn-primary" @click="createMode">
            Nuevo
            <i class="fa fa-plus"></i>
          </button>
        </h4>

        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h4>{{ total_users_hoy }}</h4>
                  <h6>Nuevos</h6>
                </div>

                <div class="icon fa-sm">
                  <i class="fas fa-user-plus"></i>
                </div>

                <a href="#" class="small-box-footer"
                  >Más información <i class="fas fa-arrow-circle-right"></i
                ></a>
              </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h4>{{ total_users }}</h4>
                  <h6>Total</h6>
                </div>

                <div class="icon fa-sm">
                  <i class="fas fa-user-friends"></i>
                </div>

                <a href="#" class="small-box-footer"
                  >Más información <i class="fas fa-arrow-circle-right"></i
                ></a>
              </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h4>
                    {{ porcentaje_validados
                    }}<sup style="font-size: 15px">%</sup>
                  </h4>
                  <h6>Verificados</h6>
                </div>

                <div class="icon fa-sm">
                  <i class="fas fa-user-check"></i>
                </div>

                <a href="#" class="small-box-footer"
                  >Más información <i class="fas fa-arrow-circle-right"></i
                ></a>
              </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h4>
                    {{ porcentaje_bajas }}<sup style="font-size: 15px">%</sup>
                  </h4>
                  <h6>Inactivos</h6>
                </div>

                <div class="icon fa-sm">
                  <i class="fas fa-user-slash"></i>
                </div>

                <a href="#" class="small-box-footer"
                  >Más información <i class="fas fa-arrow-circle-right"></i
                ></a>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div>

        <!-- Modal View User-->
        <div
          class="modal fade"
          id="modalUserView"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modalUserViewTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                  <i class="fas fa-address-card"></i>
                  <strong>Usuario</strong>
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body ml-5 mr-5 mt-3 mb-3">
                <div class="row">
                  <div class="col">
                    <div class="text-center mt-3 mr-3">
                      <img
                        class="profile-user-img img-fluid img-circle"
                        src="/img/user-128x128.png"
                        alt="User profile picture"
                      />
                      <p>
                        {{ user.name }}
                      </p>
                      <p>#{{ user.id }}</p>
                    </div>
                  </div>

                  <div class="col">
                    <strong><i class="fas fa-clock"></i> Creación</strong>
                    <p class="text-muted">{{ user.created_at | date }}</p>
                    <hr />

                    <strong
                      ><i class="fas fa-history"></i> Actualización</strong
                    >
                    <p class="text-muted">{{ user.updated_at | date }}</p>
                    <hr />

                    <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                    <p class="text-muted">{{ user.email }}</p>
                  </div>
                </div>
                <hr />

                <strong><i class="fas fa-shield-alt"></i> Rol</strong>
                <p class="text-muted">{{ rol.nombre }}</p>
                <hr />

                <strong><i class="fas fa-info-circle"></i> Estado</strong>
                <p class="text-muted">{{ estado_usuario.nombre }}</p>
              </div>

              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-dismiss="modal"
                >
                  Cerrar <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Create Edit User-->
        <div
          class="modal fade"
          id="modalUserCreate"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modalUserCreateTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5
                  class="modal-title"
                  id="exampleModalLongTitle"
                  v-show="!edit_mode"
                >
                  <i class="fas fa-address-card"></i> Registrar
                </h5>
                <h5
                  class="modal-title"
                  id="exampleModalLongTitle"
                  v-show="edit_mode"
                >
                  <i class="fas fa-address-card"></i> Editar
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <form @submit.prevent="!edit_mode ? createUser() : updateUser()">
                <div class="modal-body ml-5 mr-5 mt-3 mb-3">
                  <div class="form-group">
                    <label>R.U.N.</label>
                    <input
                      v-model="form.run"
                      type="text"
                      name="run"
                      placeholder="R.U.N."
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('run') }"
                    />
                    <has-error :form="form" field="run"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input
                      v-model="form.email"
                      type="email"
                      name="email"
                      placeholder="Email"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('email') }"
                    />
                    <has-error :form="form" field="email"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Nombre</label>
                    <input
                      v-model="form.name"
                      type="text"
                      name="name"
                      placeholder="Nombre"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('name') }"
                    />
                    <has-error :form="form" field="name"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Contraseña</label>
                    <input
                      v-model="form.password"
                      type="password"
                      name="password"
                      placeholder="Contraseña"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('password') }"
                    />
                    <has-error :form="form" field="password"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Confirmar contraseña</label>
                    <input
                      v-model="form.password_confirmation"
                      type="password"
                      name="password_confirmation"
                      placeholder="Contraseña"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('password_confirmation'),
                      }"
                    />
                    <has-error
                      :form="form"
                      field="password_confirmation"
                    ></has-error>
                  </div>

                  <div class="form-group">
                    <label>Estado</label>
                    <b-form-select
                      v-model="form.estado_usuario_id"
                      :options="estado_usuarios"
                      text-field="nombre"
                      value-field="id"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('estado_usuario_id'),
                      }"
                    >
                      <b-form-select-option :value="null"
                        >Seleccione una opción</b-form-select-option
                      >
                    </b-form-select>
                    <has-error
                      :form="form"
                      field="estado_usuario_id"
                    ></has-error>
                  </div>

                  <div class="form-group">
                    <label>Rol</label>
                    <b-form-select
                      v-show="!edit_mode"
                      v-model="form.rol_id"
                      :options="rols"
                      text-field="nombre"
                      value-field="id"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('rol_id') }"
                    >
                      <b-form-select-option :value="null"
                        >Seleccione una opción</b-form-select-option
                      >
                    </b-form-select>
                    <has-error :form="form" field="rol_id"></has-error>

                    <b-form-select
                      :disabled="true"
                      v-show="edit_mode"
                      v-model="form.rol_id"
                      :options="rols"
                      text-field="nombre"
                      value-field="id"
                      class="form-control"
                      :class="{ 'is-invalid': form.errors.has('rol_id') }"
                    >
                      <b-form-select-option :value="null"
                        >Seleccione una opción</b-form-select-option
                      >
                    </b-form-select>
                  </div>
                </div>

                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                  >
                    Cerrar <i class="fas fa-times"></i>
                  </button>
                  <button type="submit" class="btn btn-primary">
                    Guardar <i class="fas fa-save"></i>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <table id="tbl-users" class="table table-bordered dt-responsive small">
          <thead>
            <tr class="table-info">
              <th>#</th>
              <th>R.U.N.</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Acciones</th>
              <th>Actualización</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="user in users" :key="user.id">
              <th scope="col">
                {{ user.id }}
              </th>
              <td>
                {{ user.run }}
              </td>
              <td>
                {{ user.name }}
              </td>
              <td>
                {{ user.email }}
              </td>
              <td>
                {{ user.rol.nombre }}
              </td>
              <td>
                <span class="badge badge-warning" v-if="user.estado_usuario_id == 1">{{ user.estado_usuario.nombre }}</span>
                <span class="badge badge-success" v-if="user.estado_usuario_id == 2">{{ user.estado_usuario.nombre }}</span>
                <span class="badge badge-danger" v-if="user.estado_usuario_id == 3">{{ user.estado_usuario.nombre }}</span>
              </td>
              <td>
                <button
                  class="btn btn-sm btn-secondary"
                  @click="viewMode(user, user.rol, user.estado_usuario)"
                >
                  <i class="fa fa-eye"></i>
                </button>

                <button class="btn btn-sm btn-warning" @click="editMode(user)">
                  <i class="fa fa-edit"></i>
                </button>

                <button
                  v-if="user.rol_id == 2"
                  class="btn btn-sm btn-success"
                  @click="toPremiumMode(user)"
                >
                  <i class="fas fa-crown"></i>
                </button>

                <button
                  v-if="
                    user.estado_usuario_id == 1 || user.estado_usuario_id == 2
                  "
                  class="btn btn-sm btn-danger"
                  @click="downMode(user)"
                >
                  <i class="fas fa-times-circle"></i>
                </button>
              </td>
              <td>
                {{ user.updated_at | date }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import datatable from "datatables.net-bs4";

export default {
  data() {
    return {
      user: {},
      rol: {},
      estado_usuario: {},
      estado_usuarios: [],
      rols: [],
      users: [],
      edit_mode: false,
      form: new Form({
        id: "",
        run: "",
        email: "",
        name: "",
        password: "",
        estado_usuario_id: null,
        rol_id: null,
      }),

      total_users_hoy: "",
      total_users: "",
      porcentaje_validados: "",
      porcentaje_bajas: "",
    };
  },

  methods: {
    chargeStats() {
      axios.get("/admin/api/user/get-stats").then((response) => {
        this.total_users_hoy = response.data.total_users_hoy;
        this.total_users = response.data.total_users;
        this.porcentaje_validados = response.data.porcentaje_validados;
        this.porcentaje_bajas = response.data.porcentaje_bajas;
      });
    },

    chargeTabla() {
      var dt = $("#tbl-users").DataTable();
      dt.destroy();

      this.$nextTick(() => {
        $("#tbl-users").DataTable({
          responsive: true,
          autoWidth: false,
          lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100],
          ],
          order: [[7, "desc"]],
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          columns: [
            { width: "9%" },
            { width: "10%" },
            null,
            null,
            { width: "9%" },
            { width: "8%" },
            { width: "17%" },
            { width: "14%" },
          ],
        });
      });
    },

    getEstadoUsuarios() {
      axios.get("/admin/api/estado-usuario/get-all").then((response) => {
        this.estado_usuarios = response.data.estado_usuarios;
      });
    },

    getRols() {
      axios.get("/admin/api/rol/get-all").then((response) => {
        this.rols = response.data.rols;
      });
    },

    getUsers() {
      axios.get("/admin/api/user/get-all").then((response) => {
        this.users = response.data.users;
        this.chargeTabla();
      });
    },

    createUser() {
      this.form
        .post("/admin/user/create")
        .then(() => {
          Fire.$emit("loadUser");
          this.$toastr.s("Usuario guardado correctamente", "Registro");
          $("#modalUserCreate").modal("hide");
        })
        .catch(() => {
          this.$toastr.e("No se pudo guardar el registro", "Error");
        });
    },

    updateUser() {
      this.form
        .put("/admin/user/update/" + this.form.id)
        .then(() => {
          Fire.$emit("loadUser");
          this.$toastr.s("Usuario actualizado correctamente", "Actualización");
          $("#modalUserCreate").modal("hide");
        })
        .catch(() => {
          this.$toastr.e("No se pudo actualizar el registro", "Error");
        });
    },

    downMode(user) {
      Swal.fire({
        title: "¿Dar de baja?",
        text: "Esta acción puede ser revertida más tarde",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar",
      }).then((result) => {
        if (result.isConfirmed) {
          try {
            axios
              .put("/admin/user/down/" + user.id)
              .then(() => {
                Fire.$emit("loadUser");
                this.$toastr.s("Usuario dado de baja correctamente", "Baja");
              })
              .catch(() => {
                this.$toastr.e("No se pudo bajar usuario", "Error");
              });
          } catch (error) {
            this.$toastr.e("No se pudo bajar usuario", "Error");
          }
        }
      });
    },

    createMode() {
      this.edit_mode = false;
      this.form.reset();
      $("#modalUserCreate").modal("show");
    },

    editMode(user) {
      this.edit_mode = true;
      this.form.reset();
      this.form.fill(user);
      $("#modalUserCreate").modal("show");
    },

    toPremiumMode(user) {
      Swal.fire({
        title: "¿Convertir a premium?",
        text: "Esta acción puede ser revertida más tarde",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar",
      }).then((result) => {
        if (result.isConfirmed) {
          try {
            axios
              .put("/admin/user/to-premium/" + user.id)
              .then(() => {
                Fire.$emit("loadUser");
                this.$toastr.s(
                  "Usuario convertido a premium correctamente",
                  "Premium"
                );
              })
              .catch(() => {
                this.$toastr.e("No se pudo convertir a premium", "Error");
              });
          } catch (error) {
            this.$toastr.e("No se pudo convertir a premium", "Error");
          }
        }
      });
    },

    viewMode(user, rol, estado_usuario) {
      $("#modalUserView").modal("show");
      this.user = user;
      this.rol = rol;
      this.estado_usuario = estado_usuario;
    },
  },

  created() {
    this.chargeStats();
    this.getEstadoUsuarios();
    this.getRols();
    this.getUsers();
    Fire.$on("loadUser", () => {
      this.form.reset();
      this.getUsers();
      this.chargeTabla();
      this.chargeStats();
    });
  },
};
</script>

<style lang="scss">
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>