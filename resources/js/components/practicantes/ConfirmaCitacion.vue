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
        //api_token:localStorage.getItem('respuesta'),
    };
  },
  methods: {
    confirmacion(){
        //llega el dato correctamente.
        let run = {
            'run': this.run 
        };
        axios.post('/api/practicantes/confirmacionPracticante', run,{
            })
            .then(resp => {
                //console.log(resp);
                if(resp.data.status == '1'){
                    Swal.fire({
                        title: "Fecha confirmada con Éxito!",
                        icon: "success",
                    });
                    window.location.href = 'http://telepractica-vue.test:8080';
                }else if(resp.data.status == '2'){
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