<template>
    <div id="userLogin">
        <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Intranet</p>

                    <form action="">
                        <div class="input-group mb-3">
                            <input id="email" placeholder="Email" type="email"
                                class="input-group-append" name="email" v-model="email"
                                value="form-control" required autocomplete="email" autofocus>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input id="password" placeholder="Contraseña" type="password"
                                class="form-control" name="password"  v-model="password" required
                                autocomplete="current-password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Recordarme
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="button" @click.prevent="login()" class="btn btn-primary btn-block">Ingresar</button>
                            </div>
                            <!-- /.col -->

                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
    </div>
</template>
<script>
export default {
     data() {
        return {
            email: null,
            password: null,
            token: null,
            emailUsuario:null,
            id_usuario:null,
            rol_id: null,
            token_type:null,
            user: [],
        };
    },
    mounted(){
     usuario()
    },
    methods: {
        login(){
            let form = {
                'email': this.email,
                'password': this.password
            }
            axios.post('/api/users/logins', form,{
            }).then(res => {
                console.log(this.token = res.data.access_token);
                let token = this.token;
                //console.log(this.emailUsuario = res.data.email);
                //console.log(this.id_usuario = res.data.id_users);
                //console.log(this.token_type = res.data.token_type);
                //debugger; 
                if (res.data.rol_id == 2) {
                    localStorage.setItem('respuesta', res.data.access_token);
                    location.href ="http://telepractica-vue.test:8080/empresas/index";
                   
                }else if (res.data.rol_id == 1) {
                    console.log(localStorage.setItem('respuesta', res.data.access_token));
                    location.href ="http://telepractica-vue.test:8080/practicantes/index";
                }
            })              
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },
        /*usuario(){
            axios.get('/api/users/obtenerUsuraio',{
            }).then(res => {
                console.log(res.data);
            })              
            .catch(error=>{
                let errorObject=JSON.parse(JSON.stringify(error));
            })
        },*/
    }
}
</script>