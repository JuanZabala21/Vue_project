<style>
img{
  max-height: 100px;
    max-width: 100px;
}
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
.col-lg-3{
  max-width:50%;
}
 
</style>
<template>
    <div class="container">
    <h1><span id="id" style="display: none"> </span>Editar perfil</h1>
  	<hr>
	<div class="row">
      <!-- left column -->
       <form @submit="submit" role="form" method="post" enctype="multipart/form-data" style="display:contents">
      <div class="col-md-3">
        <div class="text-center">
            <div class="form-group" style="width:100%;text-align:left;">
            <label class="col-md-3 control-label" style="white-space: nowrap;padding:0;max-width: 100%;margin-botton:0.5rem;">Imagen:</label>
            </div>
          <img src="/images/default.jpg" class="avatar img-circle" id="img" alt="avatar">
          
          <div class="file-drop-area" style="margin-top: 0.5rem;">
  <span class="fake-btn">Arrastre la imagen</span>
  <span class="file-msg" style="display:none"></span>
  <input class="file-input" id="image" name="image" type="file" accept="image/x-png,image/gif,image/jpeg" v-on:change="onImageChange" required>
  <input id="saveimage" type="submit" class="btn btn-primary" value="Guardar imagen" style="margin-top: 160px;margin-left: -75px;">
</div>
        </div>
      </div>
        </form>
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Informacion Personal</h3>
        <form class="form-horizontal" role="form" method="post" @submit="formSubmit" enctype="multipart/form-data">
        
          <div class="form-group">
            <label class="col-lg-3 control-label">Nombre: </label>
            <div class="col-lg-8">
              <input id="name" class="form-control" type="text" v-model="name" required autocomplete="name">
              
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Documento: </label>
            <div class="col-lg-8">
              <input id="document" class="form-control" type="text" v-model="document" required autocomplete="document">
              
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label" >Correo:</label>
            <div class="col-lg-8">
              <input class="form-control" id="email" type="email" v-model="email"   required autocomplete="email">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="white-space: nowrap;">Contraseña:</label>
            <div class="col-md-8">
              <input class="form-control" id="password" type="password" v-model="password"  required autocomplete="new-password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" style="white-space: nowrap;">Confirmar contraseña:</label>
            <div class="col-md-8">
              <input class="form-control" type="password" id="password_confirmation" v-model="password_confirmation"  required autocomplete="new-password" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label" ></label>
            <div class="col-md-8" style="white-space: nowrap;">
              <input type="submit" id="save" class="btn btn-primary" value="Guardar cambios">
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
                    id:'',
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation:'',
              image: '',
              success: ''
            }
        },
        methods: {
          onImageChange(e){
                this.image = e.target.files[0];
            },
          onFileSelected(event) {
  var selectedFile = event.target.files[0];
  var reader = new FileReader();

  var imgtag = document.getElementById("img-out");
  imgtag.title = selectedFile.name;

  reader.onload = function(event) {
    imgtag.src = event.target.result;
  };

  reader.readAsDataURL(selectedFile);
},
submit(e) {
  e.preventDefault();
        let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                let formData = new FormData();
                formData.append('image', this.image);
                formData.append('id', this.id);
                axios.post('/formimage', formData, config)
                .then(function (response) {
                  alert('Imagen guardada con exito')
                    currentObj.success = response.data.success;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });

            },
            formSubmit(e) {
                e.preventDefault();
                
                axios.post('/formSubmit',
                {
                    id: document.getElementById('id').innerHTML,
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    document: document.getElementById('document').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById("password_confirmation").value
                    })
                .then(function (response) {
                    if(response.data.response==""){
                      alert('Datos guardados con exito')
                    }else{
                      alert('Error en los datos suministrados')
                    }
                })
                .catch(function (error) {
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
        this.id=data.data.id
        document.getElementById('id').innerHTML=data.data.id
        if(data.data.img!=null){
          document.getElementById('img').src ="/images/"+ data.data.img
        }else{
          document.getElementById('img').src ="/images/default.jpeg"
        }

        document.getElementById('name').value=data.data.name
        document.getElementById('email').value=data.data.email
        document.getElementById('document').value=data.data.document
      })
      .catch(e => {
      });
      axios
      .get("/getusers")
      .then(data => {
      })
      .catch(e => {
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
$(function(){
  $('#image').change(function(){
    var input = this;
    var url = $(this).val();
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
     {
        var reader = new FileReader();

        reader.onload = function (e) {
           $('#img').attr('src', e.target.result);
        }
       reader.readAsDataURL(input.files[0]);
    }
    else
    {
      $('#img').attr('src', '/assets/no_preview.png');
    }
  });

});
        }
    }
</script>