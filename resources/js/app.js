/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// BootstrapVue
window.Vue = require('vue');
import Vue from 'vue';
window.Fire = new Vue();
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

// Toastr
import VueToastr from "vue-toastr";

Vue.use(VueToastr, {
  defaultTimeout: 3000,
  defaultPosition: "toast-bottom-right",
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Datatables 
// Include jquery
const jQuery = require('jquery');
window.jQuery = jQuery;

// Include datatables and plugins
require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-responsive-bs4');
require('datatables.net-responsive');
require('datatables.net-select');
require('datatables.net-select-bs4');

// Components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
/*Coponente Login para enviar el email y el password, Jair*/
Vue.component('userlogin-component', require('./components/userLogin/UserLogin.vue').default);

Vue.component('user-component', require('./components/UserComponent.vue').default);

Vue.component('empresa-component', require('./components/EmpresaComponent.vue').default);
Vue.component('institucion-component', require('./components/InstitucionComponent.vue').default);
Vue.component('practicante-component', require('./components/PracticanteComponent.vue').default);

Vue.component('carrera-component', require('./components/CarreraComponent.vue').default);
Vue.component('comuna-component', require('./components/ComunaComponent.vue').default);
Vue.component('oferta-component', require('./components/OfertaComponent.vue').default);
Vue.component('postulacion-component', require('./components/PostulacionComponent.vue').default);

/*Este es el registro del aempresa de la vista welcome, Jair*/
Vue.component('registroemp-component', require('./components/RegistroEmpresa.vue').default);

/*Este es el Mostrar las Ofertas de las Empresas de la vista welcome, Jair*/
Vue.component('mostraroferta-component', require('./components/MostrarOfertas.vue').default);

/*Este es el registrar PRACTICANTES de la vista welcome, Jair*/
Vue.component('registroprac-component', require('./components/RegistrarPracticante.vue').default);

/*Este es el registrar PRACTICANTES de la vista welcome, Jair*/
Vue.component('formregistroprac-component', require('./components/practicantes/FormularioRegistroPracticante.vue').default);

/*Este es el registrar OFERTAS de la vista empresas.index, Jair*/
Vue.component('ofertaemp-component', require('./components/ofertaEmpresa/RegistrarOfertaEmpresa.vue').default);

/*Este es el registrar OFERTAS de la vista empresas.index, Jair*/
Vue.component('oferpractic-component', require('./components/practicantes/OfertaPracticante.vue').default);

/*Este es el correo para confirmar la fecha de citación, Jair*/
Vue.component('confirmacion-component', require('./components/practicantes/ConfirmaCitacion.vue').default);

/*Este es el DATATABLES para listar los datos del PRACTICANTE desde su DASHBOARD, Jair*/
Vue.component('datosper-component', require('./components/practicantes/DatosPersonales.vue').default);

/*Este es el DATATABLES para listar los PRACTICANTE que aceptaron la ENTREVISTA, Jair*/
Vue.component('aceptar-component', require('./components/empresas/PracticantesConfirmacionEntrevista.vue').default);

/*Este es el DATATABLES para listar los PRACTICANTE que aceptaron la ENTREVISTA, Jair*/
Vue.component('datosempresa-component', require('./components/empresas/DatosPersonalesEmpresa.vue').default);

/*Este es el DATATABLES para listar los CERTIFICADOS del PRACTICANTE, Jair*/
Vue.component('certificadopracticante-component', require('./components/practicantes/CertificadoPracticante.vue').default);

/*Este es el DATATABLES para listar los CERTIFICADOS del PRACTICANTE, Jair*/
Vue.component('curriculumpracticante-component', require('./components/practicantes/CurriculumPracticante.vue').default);

/*Este es el DATATABLES para listar los CERTIFICADOS del PRACTICANTE, Jair*/
Vue.component('editarregistropracticante-component', require('./components/practicantes/EditarRegistroPracticante.vue').default);
userLogin
// MomentsJS
var moment = require('moment');

Vue.filter("date", function (created) {
  return moment(created).format('YYYY-MM-DD HH:mm:ss');
});

// SweetAlert2
// const Swal = require('sweetalert2');
import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

window.Toast = Toast;

// VForm
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//require('./component');

const app = new Vue({
  el: '#app',
});
/**Jair, Certificado Practicante.*/
const userLogin = new Vue({
  el: '#userLogin',
});
/**Jair, Agregar EMPRESA vista welcome.*/
const emp = new Vue({
  el: '#registroEmpresa',
});
/**Jair, Mostrar las Ofertas de las EMPRESA vista welcome.*/
const mostraroferta = new Vue({
  el: '#mostraroferta',
});
/**Jair, Registrar PRACTICANTES de la vista welcome.*/
const registrarPracticante = new Vue({
  el: '#registrarPracticante',
});
/**Jair, Formulario Registro PRACTICANTES de la vista registroTelepracticante.*/
const formRegistroPrac = new Vue({
  el: '#formRegistroPrac',
});
/**Jair, componente para registrar una OFERTA por la EMPRESA.*/
const registrarOferta = new Vue({
  el: '#registrarOfertaEmpresa',
});
/**Jair, componente para Mostrar las OFERTAS en el DASHBOARD del PRACTICANTE.*/
const ofertaPrac = new Vue({
  el: '#listOfertaPract',
});
/**Jair, componente para mostrar el botón de confirmación de la fecha de citación.*/
const confirmacion = new Vue({
  el: '#confirmacion',
});
/**Jair, componente para mostrar los datos del PRACTICANTE desde su DASHBOARD.*/
const datosPersonales = new Vue({
  el: '#datosPersonales',
});
/**Jair, PRACTICANTES que aceptaron entrevista.*/
const aceptaron = new Vue({
  el: '#aceptaron',
});
/**Jair, DATOS de la EMPRESA.*/
const datosPersonalesEmpresa = new Vue({
  el: '#datosPersonalesEmpresa',
});

/**Jair, Certificado Practicante.*/
const certificadoPracticante = new Vue({
  el: '#certificadoPracticante',
});

/**Jair, Certificado Practicante.*/
const curriculumPracticante = new Vue({
  el: '#curriculumPracticante',
});

/**Jair, Certificado Practicante.*/
const editarRegistroPracticante = new Vue({
  el: '#editarRegistroPracticante',
});