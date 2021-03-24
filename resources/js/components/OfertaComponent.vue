<template>
  <div class="mt-3 mb-3 ml-3 mr-3">
    <div class="card">
      <div class="card-body">
        <h4>
          <i class="fas fa-graduation-cap"></i> Ofertas
        </h4>

        <table id="tbl-component" class="table table-bordered dt-responsive small">
          <thead>
            <tr class="table-info">
              <th>#</th>
              <th>Oferta</th>
              <th>Empresa</th>
              <th>Supervisor</th>
              <th>Carreras</th>
              <th>Estado</th>
              <th>Descripción</th>
              <th>Cupos</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="oferta in ofertas" :key="oferta.id">
              <th scope="col">
                {{ oferta.id }}
              </th>
              <td>
                {{ oferta.nombre_oferta }}
              </td>
              <td>
                {{ oferta.empresa_nombre }}
              </td>
              <td>
                {{ oferta.supervisor_nombre }}
              </td>
              <td>
                <p v-for="carrera in oferta.carreras" :key="carrera.id">{{ carrera.nombre }}</p>                
              </td>
              <td>
                <span class="badge badge-success" v-if="oferta.estado_oferta_id == 1">{{ oferta.estado_oferta_nombre }}</span>
                <span class="badge badge-warning" v-if="oferta.estado_oferta_id == 2">{{ oferta.estado_oferta_nombre }}</span>
                <span class="badge badge-danger" v-if="oferta.estado_oferta_id == 3">{{ oferta.estado_oferta_nombre }}</span>                
              </td>
              <td>
                {{ oferta.descripcion }}
              </td>
              <td>
                {{ oferta.cupos_totales }}
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
      ofertas: []
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
            null,
            null,
            null,
            { width: "14%" },
            { width: "14%" },
          ],
        });
      });
    },

    getOfertas() {
      axios.get("/admin/api/oferta/get-all").then((response) => {
        this.ofertas = response.data.ofertas;
        this.chargeTabla();
      });
    },
  },

  created() {
    this.getOfertas();
  },
};
</script>

<style lang="scss">
@import "~datatables.net-bs4/css/dataTables.bootstrap4.css";
@import "~datatables.net-select-bs4/css/select.bootstrap4.css";
</style>