<template>
  <div class="mt-3 mb-3 ml-3 mr-3">
    <div class="card">
      <div class="card-body">
        <h4>
          <i class="fas fa-tasks"></i> Postulaciones
        </h4>

        <table id="tbl-component" class="table table-bordered dt-responsive small">
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
                <span class="badge badge-info" v-if="postulacion.estado_post_id == 1">{{ postulacion.estado_post_nombre }}</span>
                <span class="badge badge-warning" v-if="postulacion.estado_post_id == 2">{{ postulacion.estado_post_nombre }}</span>
                <span class="badge badge-success" v-if="postulacion.estado_post_id == 3">{{ postulacion.estado_post_nombre }}</span>  
                <span class="badge badge-danger" v-if="postulacion.estado_post_id == 4">{{ postulacion.estado_post_nombre }}</span>                 
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
      </div>
    </div>
  </div>
</template>

<script>
import datatable from "datatables.net-bs4";

export default {
  data() {
    return {
      postulacions: []
    };
  },

  methods: {

    chargeTabla() {
      var dt = $("#tbl-component").DataTable();
      dt.destroy();

      this.$nextTick(() => {
        $("#tbl-component").DataTable({
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

    getPostulacions() {
      axios.get("/admin/api/postulacion/get-all").then((response) => {
        this.postulacions = response.data.postulacions;
        this.chargeTabla();
      });
    },
  },

  created() {
    this.getPostulacions();
  },
};
</script>

<style lang="scss">
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>