/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 // require('./bootstrap');
$.fn.editable.defaults.mode = 'inline';
$.fn.editable.defaults.ajaxOptions = {type:'PUT'};

 $(function(){
   $(".set-guide-number").editable();

   $(".select-status").editable({
     source: [
       {value:"creado",text:"Creado"},
       {value:"enviado",text:"Enviado"},
       {value:"recibido",text:"Recibido"}
     ]
   });
 });


 $(".add-to-cart").on("submit",function(e){
   e.preventDefault();

   var $form = $(this);
   var $button = $form.find("[type='submit']");

   //peticion ajax
   $.ajax({
     url:$form.attr("action"),
     method:$form.attr("method"),
     data: $form.serialize(),
     dataType:"JSON",
     beforeSend: function(){
       $button.val("Cargando..");
     },
     success: function(data){
       $button.css("background-color","#00c853").val("Agregado");
       console.log(data);

       $(".circle-shopping-cart").html(data.products_count);
       setTimeout(function(){
         restartButton($button);
       },2000);
     },
     error: function(err){
       console.log(err);
       $button.css("background-color","#d50000").val("Hubo error");
       setTimeout(function(){
         restartButton($button);
       },2000);
     }
   });

   return false;
 });

 function restartButton($button){
   $button.val("Agregar al carrito").attr("style","");
 }


// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
//     data: {
//       message: 'Hello Vue!'
//     }
// });
