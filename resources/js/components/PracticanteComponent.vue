<template>
  <div class="mt-3 mb-3 ml-3 mr-3">
    <div class="card">
      <div class="card-body">
        <h4>
          <i class="fas fa-user-graduate"></i> Practicantes
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
          id="modalPracticanteView"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modalPracticanteViewTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">
                  <i class="fas fa-address-card"></i>
                  <strong>Practicante</strong>
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
                        {{ practicante.nombre_completo }}
                      </p>
                      <p>#{{ practicante.id }}</p>
                    </div>
                  </div>

                  <div class="col">
                    <strong><i class="fas fa-clock"></i> Creación</strong>
                    <p class="text-muted">
                      {{ practicante.created_at | date }}
                    </p>
                    <hr />

                    <strong
                      ><i class="fas fa-history"></i> Actualización</strong
                    >
                    <p class="text-muted">
                      {{ practicante.updated_at | date }}
                    </p>
                    <hr />

                    <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                    <p class="text-muted">{{ practicante.email }}</p>
                  </div>
                </div>
                <hr />

                <div class="row">
                  <div class="col">
                    <strong
                      ><i class="fas fa-map-marked-alt"></i> Región</strong
                    >
                    <p class="text-muted">{{ practicante.region_nombre }}</p>
                  </div>

                  <div class="col">
                    <strong
                      ><i class="fas fa-map-marker-alt"></i> Comuna</strong
                    >
                    <p class="text-muted">{{ practicante.comuna_nombre }}</p>
                  </div>
                </div>
                <hr />

                <div class="row">
                  <div class="col">
                    <strong
                      ><i class="fas fa-graduation-cap"></i> Nivel
                      Educacional</strong
                    >
                    <p class="text-muted">
                      {{ practicante.nivel_educacional_nombre }}
                    </p>
                  </div>

                  <div class="col">
                    <strong
                      ><i class="fas fa-briefcase"></i> Tipo de Práctica</strong
                    >
                    <p class="text-muted">
                      {{ practicante.tipo_practica_nombre }}
                    </p>
                  </div>
                </div>
                <hr />

                <div class="row">
                  <div class="col">
                    <strong
                      ><i class="fas fa-graduation-cap"></i> Institución</strong
                    >
                    <p class="text-muted">
                      {{ practicante.institucion_nombre }}
                    </p>
                  </div>

                  <div class="col">
                    <strong><i class="fas fa-briefcase"></i> Carrera</strong>
                    <p class="text-muted">{{ practicante.carrera_nombre }}</p>
                  </div>
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
          id="modalPracticanteCreate"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modalPracticanteCreateTitle"
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
                @submit.prevent="
                  !edit_mode ? createPracticante() : updatePracticante()
                "
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

                  <div class="form-group">
                    <label>Nivel Educacional</label>
                    <b-form-select
                      v-model="form.nivel_educacional_id"
                      :options="nivel_educacionals"
                      text-field="nombre"
                      value-field="id"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('nivel_educacional_id'),
                      }"
                    >
                      <b-form-select-option :value="null"
                        >Seleccione una opción</b-form-select-option
                      >
                    </b-form-select>
                    <has-error
                      :form="form"
                      field="nivel_educacional_id"
                    ></has-error>
                  </div>

                  <div class="form-group">
                    <label>Tipo de Práctica</label>
                    <b-form-select
                      v-model="form.tipo_practica_id"
                      :options="tipo_practicas"
                      text-field="nombre"
                      value-field="id"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('tipo_practica_id'),
                      }"
                    >
                      <b-form-select-option :value="null"
                        >Seleccione una opción</b-form-select-option
                      >
                    </b-form-select>
                    <has-error
                      :form="form"
                      field="tipo_practica_id"
                    ></has-error>
                  </div>

                  <div class="form-group">
                    <label>Región</label>
                    <b-form-select
                      @change="getComunasByRegion"
                      v-model="form.region_id"
                      :options="regions"
                      text-field="nombre"
                      value-field="id"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('region_id'),
                      }"
                    >
                      <b-form-select-option :value="null"
                        >Seleccione una opción</b-form-select-option
                      >
                    </b-form-select>
                    <has-error :form="form" field="region_id"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Comuna</label>
                    <b-form-select
                      id="select-comuna-id"
                      v-model="form.comuna_id"
                      :options="comunas"
                      text-field="nombre"
                      value-field="id"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('comuna_id'),
                      }"
                    >
                      <b-form-select-option :value="null"
                        >Seleccione una opción</b-form-select-option
                      >
                    </b-form-select>
                    <has-error :form="form" field="comuna_id"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Institución</label>
                    <b-form-select
                      @change="getCarrerasByInstitucion"
                      v-model="form.institucion_id"
                      :options="institucions"
                      text-field="nombre"
                      value-field="id"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('institucion_id'),
                      }"
                    >
                      <b-form-select-option :value="null"
                        >Seleccione una opción</b-form-select-option
                      >
                    </b-form-select>
                    <has-error :form="form" field="institucion_id"></has-error>
                  </div>

                  <div class="form-group">
                    <label>Carrera</label>
                    <b-form-select
                      id="select-carrera-id"
                      v-model="form.carrera_id"
                      :options="carreras"
                      text-field="nombre"
                      value-field="id"
                      class="form-control"
                      :class="{
                        'is-invalid': form.errors.has('carrera_id'),
                      }"
                    >
                      <b-form-select-option :value="null"
                        >Seleccione una opción</b-form-select-option
                      >
                    </b-form-select>
                    <has-error :form="form" field="carrera_id"></has-error>
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

        <!-- B-Modal View Postulacions-->
        <div>
          <b-modal id="modalPostulacionsView" size="xl" title="Postulaciones">
            <table
              id="tbl-postulacions"
              class="table table-bordered dt-responsive small"
            >
              <thead>
                <tr class="table-info">
                  <th>#</th>
                  <th>Postulacion</th>
                  <th>Practicante</th>
                  <th>Estado</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="postulacion in postulacions" :key="postulacion.id">
                  <th scope="col">
                    {{ postulacion.id }}
                  </th>
                  <td>
                    {{ postulacion.nombre }}
                  </td>
                  <td>
                    {{ postulacion.practicante_nombre }}
                  </td>
                  <td>
                    <span
                      class="badge badge-info"
                      v-if="postulacion.estado_post_id == 1"
                      >{{ postulacion.estado_post_nombre }}</span
                    >
                    <span
                      class="badge badge-warning"
                      v-if="postulacion.estado_post_id == 2"
                      >{{ postulacion.estado_post_nombre }}</span
                    >
                    <span
                      class="badge badge-success"
                      v-if="postulacion.estado_post_id == 3"
                      >{{ postulacion.estado_post_nombre }}</span
                    >
                    <span
                      class="badge badge-danger"
                      v-if="postulacion.estado_post_id == 4"
                      >{{ postulacion.estado_post_nombre }}</span
                    >
                  </td>
                  <td>
                    {{ postulacion.fecha }}
                  </td>
                  <td>
                    {{ postulacion.hora }}
                  </td>
                </tr>
              </tbody>
            </table>
          </b-modal>
        </div>

        <!-- Modal View Postulacions-->
        <!-- <div
          class="modal fade"
          id="modalPostulacionsView"
          tabindex="-1"
          role="dialog"
          aria-labelledby="modalPostulacionsViewTitle"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                  <i class="fas fa-address-card"></i> Postulaciones
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

              <div class="modal-body ml-1 mr-1 mt-3 mb-3">
                
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
        </div> -->

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
            <tr v-for="practicante in practicantes" :key="practicante.id">
              <th scope="col">
                {{ practicante.id }}
              </th>
              <td>
                {{ practicante.run }}
              </td>
              <td>
                {{ practicante.nombre_completo }}
              </td>
              <td>
                {{ practicante.email }}
              </td>
              <td>
                <span
                  class="badge badge-warning"
                  v-if="practicante.estado_usuario_id == 1"
                  >{{ practicante.estado_usuario_nombre }}</span
                >
                <span
                  class="badge badge-success"
                  v-if="practicante.estado_usuario_id == 2"
                  >{{ practicante.estado_usuario_nombre }}</span
                >
                <span
                  class="badge badge-danger"
                  v-if="practicante.estado_usuario_id == 3"
                  >{{ practicante.estado_usuario_nombre }}</span
                >
              </td>
              <td>
                <button
                  class="btn btn-sm btn-secondary"
                  @click="viewMode(practicante)"
                >
                  <i class="fa fa-eye"></i>
                </button>

                <button
                  class="btn btn-sm btn-warning"
                  @click="editMode(practicante)"
                >
                  <i class="fa fa-edit"></i>
                </button>

                <button
                  v-if="
                    practicante.estado_usuario_id == 1 ||
                    practicante.estado_usuario_id == 2
                  "
                  class="btn btn-sm btn-danger"
                  @click="downMode(practicante)"
                >
                  <i class="fas fa-times-circle"></i>
                </button>

                <button
                  v-if="practicante.cantidad_postulaciones > 0"
                  class="btn btn-sm btn-info"
                  @click="viewPostulacionsMode(practicante)"
                >
                  <i class="fas fa-tasks"></i>
                </button>
              </td>
              <td>
                {{ practicante.updated_at | date }}
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

      practicante: {},

      carrera: {},
      comuna: {},
      institucion: {},
      nivel_educacional: {},
      region: {},
      tipo_practica: {},

      estado_usuario: {},

      practicantes: [],

      carreras: [],
      comunas: [],
      institucions: [],
      nivel_educacionals: [],
      regions: [],
      tipo_practicas: [],

      estado_usuarios: [],

      postulacions: [],

      form: new Form({
        id: null,
        run: null,
        email: null,
        name: null,
        password: null,
        carrera_id: null,
        comuna_id: null,
        estado_usuario_id: null,
        institucion_id: null,
        nivel_educacional_id: null,
        region_id: null,
        tipo_practica_id: null,
      }),

      total_users_hoy: "",
      total_users: "",
      porcentaje_validados: "",
      porcentaje_bajas: "",

      data_carrera_id: null,
      data_comuna_id: null,
    };
  },

  methods: {
    chargeStats() {
      axios.get("/admin/api/user/get-stats-practicante").then((response) => {
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
            { width: "17%" },
            { width: "14%" },
          ],
        });
      });
    },

    chargeTablaPostulacions() {
      var dt = $("#tbl-postulacions").DataTable();
      dt.destroy();

      this.$nextTick(() => {
        $("#tbl-postulacions").DataTable({
          responsive: true,
          autoWidth: false,
          lengthMenu: [
            [5, 10, 25, 50, 100],
            [5, 10, 25, 50, 100],
          ],
          order: [[1, "asc"]],
          language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          },
          columns: [
            { width: "12%" },
            null,
            null,
            { width: "14%" },
            { width: "14%" },
            { width: "14%" },
          ],
        });
      });
    },

    getCarreras() {
      axios.get("/admin/api/carrera/get-all").then((response) => {
        this.carreras = response.data.carreras;
      });
    },

    getCarrerasByInstitucion() {
      document.getElementById("select-carrera-id").disabled = true;
      this.form.carrera_id = null;

      if (this.form.institucion_id != null) {
        axios
          .get(
            "/admin/api/carrera/get-all-by-institucion/" +
              this.form.institucion_id
          )
          .then((response) => {
            this.carreras = response.data.carreras;

            document.getElementById("select-carrera-id").disabled = false;
          });
      }
    },

    getComunas() {
      axios.get("/admin/api/comuna/get-all").then((response) => {
        this.comunas = response.data.comunas;
      });
    },

    getComunasByRegion() {
      document.getElementById("select-comuna-id").disabled = true;
      this.form.comuna_id = null;

      if (this.form.region_id != null) {
        axios
          .get("/admin/api/comuna/get-all-by-region/" + this.form.region_id)
          .then((response) => {
            this.comunas = response.data.comunas;

            document.getElementById("select-comuna-id").disabled = false;
          });
      }
    },

    getEstadoUsuarios() {
      axios.get("/admin/api/estado-usuario/get-all").then((response) => {
        this.estado_usuarios = response.data.estado_usuarios;
      });
    },

    getInstitucions() {
      axios.get("/admin/api/institucion/get-all").then((response) => {
        this.institucions = response.data.institucions;
      });
    },

    getNivelEducacionals() {
      axios.get("/admin/api/nivel-educacional/get-all").then((response) => {
        this.nivel_educacionals = response.data.nivel_educacionals;
      });
    },

    getRegions() {
      axios.get("/admin/api/region/get-all").then((response) => {
        this.regions = response.data.regions;
      });
    },

    getTipoPracticas() {
      axios.get("/admin/api/tipo-practica/get-all").then((response) => {
        this.tipo_practicas = response.data.tipo_practicas;
      });
    },

    getPostulacionsByPracticante() {
      axios
        .get(
          "/admin/api/postulacion/get-all-by-practicante/" + this.practicante.id
        )
        .then((response) => {
          this.postulacions = response.data.postulacions;
        });
    },

    getPracticantes() {
      axios.get("/admin/api/practicante/get-all").then((response) => {
        this.practicantes = response.data.practicantes;
        this.chargeTabla();
      });
    },

    createPracticante() {
      this.form
        .post("/admin/practicante/create")
        .then(() => {
          Fire.$emit("loadPracticantes");
          this.$toastr.s("Usuario guardado correctamente", "Registro");
          $("#modalPracticanteCreate").modal("hide");
        })
        .catch(() => {
          this.$toastr.e("No se pudo guardar el registro", "Error");
        });
    },

    updatePracticante() {
      this.form
        .put("/admin/practicante/update/" + this.form.id)
        .then(() => {
          Fire.$emit("loadPracticantes");
          this.$toastr.s("Usuario actualizado correctamente", "Actualización");
          $("#modalPracticanteCreate").modal("hide");
        })
        .catch(() => {
          this.$toastr.e("No se pudo actualizar el registro", "Error");
        });
    },

    createMode() {
      this.edit_mode = false;
      this.form.reset();

      this.data_carrera_id = null;
      this.data_comuna_id = null;

      $("#modalPracticanteCreate").modal("show");
    },

    editMode(practicante) {
      this.edit_mode = true;
      this.form.reset();

      this.practicante = practicante;

      this.form.id = this.practicante.id;
      this.form.run = this.practicante.run;
      this.form.email = this.practicante.email;
      this.form.name = this.practicante.user.name;
      this.form.password = this.practicante.user.password;
      this.form.estado_usuario_id = this.practicante.estado_usuario_id;
      this.form.institucion_id = this.practicante.institucion_id;
      this.form.nivel_educacional_id = this.practicante.nivel_educacional_id;
      this.form.region_id = this.practicante.region_id;
      this.form.rol_id = this.practicante.rol_id;
      this.form.tipo_practica_id = this.practicante.tipo_practica_id;

      this.form.carrera_id = this.practicante.carrera_id;
      this.form.comuna_id = this.practicante.comuna_id;

      $("#modalPracticanteCreate").modal("show");
    },

    downMode(practicante) {
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
              .put("/admin/user/down/" + practicante.id)
              .then(() => {
                Fire.$emit("loadPracticantes");
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

    viewMode(practicante) {
      $("#modalPracticanteView").modal("show");
      this.practicante = practicante;
    },

    viewPostulacionsMode(practicante) {
      //$("#modalPostulacionsView").modal("show");
      this.$bvModal.show("modalPostulacionsView");
      this.practicante = practicante;
      this.getPostulacionsByPracticante();
    },
  },

  created() {
    this.chargeStats();
    this.getCarreras();
    this.getComunas();
    this.getEstadoUsuarios();
    this.getInstitucions();
    this.getNivelEducacionals();
    //this.getPostulacionsByPracticante();
    this.getRegions();
    this.getTipoPracticas();
    this.getPracticantes();
    Fire.$on("loadPracticantes", () => {
      this.form.reset();
      this.getPracticantes();
      this.chargeTabla();
      this.chargeStats();
    });
  },

  mounted() {
    document.getElementById("select-comuna-id").disabled = true;
    document.getElementById("select-carrera-id").disabled = true;

    if (this.form.region_id != null) {
      this.getComunasByRegion();
    }

    if (this.form.institucion_id != null) {
      this.getCarrerasByInstitucion();
    }
  },
};
</script>

<style lang="scss">
.modal-backdrop {
  display: none;
}

@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>