<template>
  <div class="mt-3 mb-3 ml-3 mr-3">
    <div class="card">
      <div class="card-body">
        <h4>
          <i class="fas fa-graduation-cap"></i> Carreras
        </h4>

        <table id="tbl-component" class="table table-bordered dt-responsive small">
          <thead>
            <tr class="table-info">
              <th>#</th>
              <th>Carrera</th>
              <th># Escuela</th>
              <th>Escuela</th>
              <th>Creación</th>
              <th>Actualización</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="carrera in carreras" :key="carrera.id">
              <th scope="col">
                {{ carrera.id }}
              </th>
              <td>
                {{ carrera.nombre }}
              </td>
              <td>
                {{ carrera.escuela_id }}
              </td>
              <td>
                {{ carrera.escuela_nombre }}
              </td>
              <td>
                {{ carrera.created_at | date }}
              </td>
              <td>
                {{ carrera.updated_at | date }}
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
      carreras: []
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
            { width: "12%" },
            null,
            { width: "14%" },
            { width: "14%" },
          ],
        });
      });
    },

    getCarreras() {
      axios.get("/admin/api/carrera/get-all").then((response) => {
        this.carreras = response.data.carreras;
        this.chargeTabla();
      });
    },
  },

  created() {
    this.getCarreras();
  },
};
</script>

<style lang="scss">
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>