<template>
  <div class="mt-3 mb-3 ml-3 mr-3">
    <div class="card">
      <div class="card-body">
        <h4>
          <i class="fas fa-user-tie fa-sm"></i> Instituciones
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

        <!-- Modal View-->
        <div
          class="modal fade"
          id="modalInstitucionView"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modalInstitucionViewTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                  <i class="fas fa-address-card"></i>
                  <strong>Institución</strong>
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
                        {{ institucion.nombre }}
                      </p>
                      <p>#{{ institucion.id }}</p>
                    </div>
                  </div>

                  <div class="col">
                    <strong><i class="fas fa-clock"></i> Creación</strong>
                    <p class="text-muted">
                      {{ institucion.created_at | date }}
                    </p>
                    <hr />

                    <strong
                      ><i class="fas fa-history"></i> Actualización</strong
                    >
                    <p class="text-muted">
                      {{ institucion.updated_at | date }}
                    </p>
                    <hr />

                    <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                    <p class="text-muted">{{ institucion.email }}</p>
                  </div>
                </div>
                <hr />
                  <div class="col">
                    <strong><i class="fas fa-map-marked-alt"></i> Rol</strong>
                    <p class="text-muted">{{ institucion.rol_nombre }}</p>
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
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Create Edit-->
        <div
          class="modal fade"
          id="modalInstitucionCreate"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modalInstitucionCreateTitle"
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

              <form
                @submit.prevent="!edit_mode ? createInstitucion() : updateInstitucion()"
              >
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
              <th>Estado</th>
              <th>Acciones</th>
              <th>Actualización</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="institucion in institucions" :key="institucion.id">
              <th scope="col">
                {{ institucion.id }}
              </th>
              <td>
                {{ institucion.run }}
              </td>
              <td>
                {{ institucion.nombre }}
              </td>
              <td>
                {{ institucion.email }}
              </td>
              <td>
                <span class="badge badge-warning" v-if="institucion.estado_usuario_id == 1">{{ institucion.estado_usuario_nombre }}</span>
                <span class="badge badge-success" v-if="institucion.estado_usuario_id == 2">{{ institucion.estado_usuario_nombre }}</span>
                <span class="badge badge-danger" v-if="institucion.estado_usuario_id == 3">{{ institucion.estado_usuario_nombre }}</span>
              </td>
              <td>
                <button
                  class="btn btn-sm btn-secondary"
                  @click="viewMode(institucion)"
                >
                  <i class="fa fa-eye"></i>
                </button>

                <button
                  class="btn btn-sm btn-warning"
                  @click="editMode(institucion)"
                >
                  <i class="fa fa-edit"></i>
                </button>

                <button
                  v-if="
                    institucion.estado_usuario_id == 1 ||
                    institucion.estado_usuario_id == 2
                  "
                  class="btn btn-sm btn-danger"
                  @click="downMode(institucion)"
                >
                  <i class="fas fa-times-circle"></i>
                </button>
              </td>
              <td>
                {{ institucion.updated_at | date }}
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
      edit_mode: false,

      institucion: {},

      estado_usuario: {},

      institucions: [],

      estado_usuarios: [],

      form: new Form({
        id: null,
        run: null,
        email: null,
        name: null,
        password: null,
        estado_usuario_id: null,
      }),

      total_users_hoy: "",
      total_users: "",
      porcentaje_validados: "",
      porcentaje_bajas: "",
    };
  },

  methods: {
    chargeStats() {
      axios.get("/admin/api/user/get-stats-institucion").then((response) => {
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
          order: [[6, "desc"]],
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          columns: [
            { width: "9%" },
            { width: "10%" },
            null,
            null,
            { width: "8%" },
            { width: "13%" },
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

    getInstituciones() {
      axios.get("/admin/api/institucion/get-all").then((response) => {
        this.institucions = response.data.institucions;
        this.chargeTabla();
      });
    },

    createInstitucion() {
      this.form
        .post("/admin/institucion/create")
        .then(() => {
          Fire.$emit("loadInstituciones");
          this.$toastr.s("Usuario guardado correctamente", "Registro");
          $("#modalInstitucionCreate").modal("hide");
        })
        .catch(() => {
          this.$toastr.e("No se pudo guardar el registro", "Error");
        });
    },

    updateInstitucion() {
      this.form
        .put("/admin/institucion/update/" + this.form.id)
        .then(() => {
          Fire.$emit("loadInstituciones");
          this.$toastr.s("Usuario actualizado correctamente", "Actualización");
          $("#modalInstitucionCreate").modal("hide");
        })
        .catch(() => {
          this.$toastr.e("No se pudo actualizar el registro", "Error");
        });
    },

    createMode() {
      this.edit_mode = false;
      this.form.reset();
      $("#modalInstitucionCreate").modal("show");
    },

    downMode(institucion) {
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
              .put("/admin/user/down/" + institucion.id)
              .then(() => {
                Fire.$emit("loadInstituciones");
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

    editMode(institucion) {
      this.edit_mode = true;
      this.form.reset();

      this.institucion = institucion;

      this.form.id = this.institucion.id;
      this.form.run = this.institucion.run;
      this.form.email = this.institucion.email;
      this.form.name = this.institucion.user.name;
      this.form.password = this.institucion.user.password;
      this.form.estado_usuario_id = this.institucion.estado_usuario_id;

      $("#modalInstitucionCreate").modal("show");
    },

    viewMode(institucion) {
      $("#modalInstitucionView").modal("show");
      this.institucion = institucion;
    },
  },

  created() {
    this.chargeStats();
    this.getEstadoUsuarios();
    this.getInstituciones();
    Fire.$on("loadInstituciones", () => {
      this.form.reset();
      this.getInstituciones();
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