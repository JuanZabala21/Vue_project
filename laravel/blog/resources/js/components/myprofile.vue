<style>
.form-group {
    margin-bottom: 0;
}
label{
    margin-bottom: 0.25rem;
    margin-top: 0.25rem;
}
body {
	 display: flex;
	 flex-direction: column;
	 align-items: center;
	 justify-content: space-between;
	 font-family: "Lato", sans-serif;
}
 h2 {
	 margin: 50px 0;
}
 section {
	 flex-grow: 1;
}
 .file-drop-area {
         margin-left: auto;
    margin-right: auto;
	 position: relative;
	 display: flex;
	 align-items: center;
     width: 40vw;
     height: 15vh;
	 max-width: 100%;
	 border: 1px dashed black;
	 border-radius: 3px;
	 transition: 0.2s;
}
 .file-drop-area.is-active {
	 background-color: rgba(255, 255, 255, 0.05);
}
 .fake-btn {
         margin-left: auto;
    margin-right: auto;
    color: black;
	 border-radius: 3px;
	 font-size: 12px;
	 text-transform: uppercase;
}
 .file-msg {
	 font-size: small;
	 font-weight: 300;
	 line-height: 1.4;
	 white-space: nowrap;
	 overflow: hidden;
	 text-overflow: ellipsis;
}
 .file-input {
	 position: absolute;
	 left: 0;
	 top: 0;
	 height: 100%;
	 width: 100%;
	 cursor: pointer;
	 opacity: 0;
}
 .file-input:focus {
	 outline: none;
}
 footer {
	 margin-top: 50px;
}
 footer a {
	 color: rgba(255, 255, 255, 0.4);
	 font-weight: 300;
	 font-size: 14px;
	 text-decoration: none;
}
 footer a:hover {
	 color: white;
}
 
</style>
<template>
    <div class="container">
    <h1>Editar perfil</h1>
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
            <div class="form-group" style="width:100%;text-align:left;">
            <label class="col-md-3 control-label" style="white-space: nowrap;padding:0;max-width: 100%;margin-botton:0.5rem;">Imagen:</label>
            </div>
          <img src="//placehold.it/100" class="avatar img-circle" id="img-out" alt="avatar">
          
          <div class="file-drop-area" style="margin-top: 0.5rem;">
  <span class="fake-btn">Arrastre la imagen</span>
  <span class="file-msg" style="display:none"></span>
  <input class="file-input" id="img-in" type="file" accept="image/x-png,image/gif,image/jpeg" onchange="document.getElementById('img-out').src=document.getElementById('img-in').value">
</div>
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Informacion Personal</h3>
        
        <form class="form-horizontal" role="form" method="post" @submit="formSubmit">
          <div class="form-group">
            <label class="col-lg-3 control-label">Nombre: </label>
            <div class="col-lg-8">
              <input id="name" class="form-control" type="text" v-model="name">
              
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label" >Correo:</label>
            <div class="col-lg-8">
              <input class="form-control" id="email" type="email" v-model="email"  >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="white-space: nowrap;">Contraseña:</label>
            <div class="col-md-8">
              <input class="form-control" id="password" type="password" v-model="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="white-space: nowrap;">Confirmar contraseña:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" id="password_confirmation" v-model="password_confirmation" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" ></label>
            <div class="col-md-8" style="white-space: nowrap;">
              <input type="submit" class="btn btn-primary" value="Guardar cambios">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancelar">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
</template>

<script>
    export default {
        data(){
            return {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation:''
            }
        },
        methods: {
            formSubmit(e) {
                e.preventDefault();
                
                axios.post('/formSubmit/'+document.getElementById('id').innerHTML+"-"+document.getElementById('name').value+"-"+document.getElementById('email').value+"-"+document.getElementById('password').value+"-"+document.getElementById("password_confirmation").value)
                .then(function (response) {
                  console.log("Respone")
                    console.log(response.data)
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },created() {
  window.axios.defaults.headers.common = {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                };
      axios
      .get("profiles")
      .then(data => {
        document.getElementById('name').value=data.data.name
        document.getElementById('email').value=data.data.email
      })
      .catch(e => {
        console.log(e);
      });
  },
        mounted() {
            console.log('Component mounted.')
            const $ = require('jquery')
var $fileInput = $('.file-input');
var $droparea = $('.file-drop-area');

// highlight drag area
$fileInput.on('dragenter focus click', function() {
  $droparea.addClass('is-active');
});

// back to normal state
$fileInput.on('dragleave blur drop', function() {
  $droparea.removeClass('is-active');
});

// change inner text
$fileInput.on('change', function() {
  var filesCount = $(this)[0].files.length;
  var $textContainer = $(this).prev();

  if (filesCount === 1) {
    // if single file is selected, show file name
    var fileName = $(this).val().split('\\').pop();
    $textContainer.text(fileName);
  } else {
    // otherwise show number of files
    $textContainer.text(filesCount + ' files selected');
  }
});
        }
    }
</script>
