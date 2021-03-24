<template>
  <div class="mt-3 mb-3 ml-3 mr-3">
    <div class="card">
      <div class="card-body">
        <h4>
          <i class="fas fa-map-marker-alt"></i> Comunas
        </h4>

        <table id="tbl-component" class="table table-bordered dt-responsive small">
          <thead>
            <tr class="table-info">
              <th>#</th>
              <th>Comuna</th>
              <th># Región</th>
              <th>Región</th>
              <th>Creación</th>
              <th>Actualización</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="comuna in comunas" :key="comuna.id">
              <th scope="col">
                {{ comuna.id }}
              </th>
              <td>
                {{ comuna.nombre }}
              </td>
              <td>
                {{ comuna.region_id }}
              </td>
              <td>
                {{ comuna.region_nombre }}
              </td>
              <td>
                {{ comuna.created_at | date }}
              </td>
              <td>
                {{ comuna.updated_at | date }}
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
      comunas: []
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
          order: [[2, "desc"]],
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

    getComunas() {
      axios.get("/admin/api/comuna/get-all").then((response) => {
        this.comunas = response.data.comunas;
        this.chargeTabla();
      });
    },
  },

  created() {
    this.getComunas();
  },
};
</script>

<style lang="scss">
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>