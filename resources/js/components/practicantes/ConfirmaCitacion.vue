<template>
    <div id="confirmacion">
        <div class="container mx-auto principal">
            <h1 class="mt-5 text-center">Confirma tu asistencia a la entrevista</h1>
            <br>
            <div class="container mx-auto col-sm-3 col-md-6">
                <div class="col">
                    <div class="row">
                    <form>
                    <div class="form-group">
                        <label for="run" class="text-center">R.U.N</label>
                        <input type="text" class="form-control-sm" v-model="run" id="run" name="run">
                    </div>
                    <div class="container">
                        <button type="submit" @click.prevent="confirmacion();" class="btn btn-success">Confirmar</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.principal{
    position: fixed;
}
</style>
<script>
export default {
    data() {
    return {
     run: null,
     api_token:null,
    };
  },
  methods: {
    confirmacion(){
        //llega el dato correctamente.
        let run = {
            'run': this.run 
        };
        this.api_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZWVmYzgyOGE3NDU0ZjRjMTMyY2Q5ZjI3NjRkZGEwZDhmZGM3MWViMzQzYTIyODFmZDM5MThjNTk1YmJlYjNmNDVlODMyM2VhNTNlODRmMmYiLCJpYXQiOjE2MTkwNDY3NzEuMzI3NDA0LCJuYmYiOjE2MTkwNDY3NzEuMzI3NDA4LCJleHAiOjE2NTA1ODI3NzAuNTQxOTg4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.UbAhA4rbgq5k0_7mkpyUg8uwh1hxxn5PQTDj29tcqAXnG-mFzo0QK_p7qc3I4PADKizzgdqMVAeJYv-wmLj7ijHDVpD3RCqSLB2BvdaDn9qeAVmThg5NJSQPDjEIgRd2AmVv6xJ0oq5goPCBo3BT3JxjHFLFniZRp0s245tfbuuY5thh4FtaNAS_o-b1eArqt5qYBifdt1l_xs0ZTwl89qLEMKbaTo6Xm8iODu107kpWYxPLjeNghSzI__Il4PFTuRwSNaMZDGat6Dtt56loUoHsF-blu9K3lDBnurB0wlAp98xkobep9yez7gfGVki13OAymSK0vvDGdjiewWmEyFX7bdloFL-yvr2J8biaCnjIIc6tOEnb4ijoFF8l79fd0cc-_EgdAYs7ra2B2KH_htAC6q4XkLldudq2jFy6d96FXEKkKpRH3eVkTRyvdPtqReZW_0OtKte3WHcwCvEL-ZZyL3ZH8kicoep8QiE8UCOuCR7UrMX9EL9wi8HkRh3U3nqZxvLHSLA4uqm-HODgT4RdVrKwh5N4D4IroWBlal4Tm5-BbsYSeSQz9Fhjb4RwfyIfBckjEY3GlVPBY2EXw0ztnEBpK-NbuzmcRY8s7PYWlmr__Eqy7N0NQMOksWVj8DdWsGRpCSPNcWKmVZrI81ea6F_ysQu9y5hup3KecXs";
        axios.post('/api/practicantes/confirmacionPracticante', run, {headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${this.api_token}`
                }
            })
            .then(resp => {
                //console.log(resp);
                if(resp.data.msg == '0'){
                    Swal.fire({
                        title: "Fecha confirmada con Éxito!",
                        icon: "success",
                    });
                    //window.location.href = 'http://telepractica-vue.test:8080' +'/login';
                }else if(resp.data.msg == '1'){
                    Swal.fire({
                        title: "Error en el R.U.N!",    
                        icon: "error",
                    });
                }
            }).catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            });
        }
    }
}
</script>