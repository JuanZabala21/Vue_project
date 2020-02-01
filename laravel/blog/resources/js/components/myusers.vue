<style>
.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  border: 1px solid #ddd;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

.pagination a:first-child {
  border-top-left-radius: 5px;
  border-bottom-left-radius: 5px;
}

.pagination a:last-child {
  border-top-right-radius: 5px;
  border-bottom-right-radius: 5px;
}
button{
  color: black;
      width: 100px;
}
</style>
<template>
    <div class="container" style="width:992px">
        <div class="row mt-5" >
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Usuarios</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Registrado el</th>
                        <th>Modificar</th>
                  </tr>
                    </thead>
                  <tbody id='tbody'>
                  <tr id="tr1">
                    <td id="tr1id"> </td>
                    <td id="tr1name"></td>
                    <td id="tr1email"></td>
                    <td id="tr1release"></td>
                    <td >
                        <a id="activ1" @click='update("activ","tr1id")' >
                            <button id="act1" type="submit" class="btn btn-primary" style="color:black;background-color:green;display:none;">Activar</button>
                        </a>
                        <a @click='update("desact","tr1id")' >
                            <button id="alt1" type="submit" class="btn btn-primary" style="color:black;background-color:yellow;display:none;">Desactivar</button>
                        </a>
                        <a @click='delet("tr1id")' >
                            <button id="d1" type="submit" class="btn btn-primary" style="color:black;background-color:red;display:none;display:none;">Eliminar</button>
                        </a>

                    </td>
                  </tr>
                  <tr id="tr2">
                    <td id="tr2id"> </td>
                    <td id="tr2name"></td>
                    <td id="tr2email"></td>
                    <td id="tr2release"></td>
                    <td>
                        <a id="activ2" @click='update("activ","tr2id")' >
                            <button id="act2" type="submit" class="btn btn-primary" style="color:black;background-color:green;display:none;">Activar</button>
                        </a>
                        <a @click='update("desact","tr2id")' >
                            <button id="alt2" type="submit" class="btn btn-primary" style="color:black;background-color:yellow;display:none;">Desactivar</button>
                        </a>
                        <a @click='delet("tr2id")' >
                            <button id="d2" type="submit" class="btn btn-primary" style="color:black;background-color:red;display:none;">Eliminar</button>
                        </a>
                    </td>
                  </tr>
                  <tr id="tr3">
                    <td id="tr3id"> </td>
                    <td id="tr3name"></td>
                    <td id="tr3email"></td>
                    <td id="tr3release"></td>
                    <td>
                        <a id="activ3" @click='update("activ","tr3id")' >
                            <button id="act3" type="submit" class="btn btn-primary" style="color:black;background-color:green;display:none;">Activar</button>
                        </a>
                        <a @click='update("desact","tr3id")' >
                            <button id="alt3" type="submit" class="btn btn-primary" style="color:black;background-color:yellow;display:none;">Desactivar</button>
                        </a>
                        <a @click='delet("tr3id")' >
                            <button id="d3" type="submit" class="btn btn-primary" style="color:black;background-color:red;display:none;">Eliminar</button>
                        </a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer" style="text-align:center">
                  <div id="pag" class="pagination">
  <a id="btnprev" @click="test('prev')">&laquo;</a>
  <a id="btnprost" @click="test('post')">&raquo;</a>
</div>

              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>



    </div>



</template>
<script>
    export default {
        data(){
            return {
                    max:'',
                    current:'1',
            }
        },
        methods: {
            update(a,n){
                let act=0
                if(a=='activ'){
                    act=1
                }
                axios.post('/updateusers',
                {
                    id: document.getElementById(n).innerHTML,
                    activo: act,
                    })
                .then(function (response) {
                    if(response.data=="1"){
                      location.reload();
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            delet(n){
                axios.post('/updateusers',
                {
                    id: document.getElementById(n).innerHTML,
                    activo: 2,
                    })
                .then(function (response) {
                    if(response.data=="1"){
                      location.reload();
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            test(n){
                if(n=='prev'){
                    if(this._data.current>1){
                        this._data.current-=1
                    }
                }else{
                    if(this._data.current<this._data.max){
                        this._data.current=parseInt(this._data.current)+ 1
                    }
                }
                n=this._data.current
                axios
      .get("/getusers?page="+n)
      .then(data => {
                 for(let i=0;i<data.data.data.length;i++){
                    document.getElementById('tr'+(i+1)+'id').innerHTML=data.data.data[i].id
                    document.getElementById('tr'+(i+1)+'name').innerHTML=data.data.data[i].name
                    document.getElementById('tr'+(i+1)+'email').innerHTML=data.data.data[i].email
                    document.getElementById('tr'+(i+1)+'release').innerHTML=data.data.data[i].created_at
                    document.getElementById("d"+(i+1)).style.display="block"
                    if(data.data.data[i].activo==1){
                        document.getElementById("alt"+(i+1)).style.display="block"
                        document.getElementById("act"+(i+1)).style.display="none"
                    }else{
                      document.getElementById("alt"+(i+1)).style.display="none"
                        document.getElementById("act"+(i+1)).style.display="block"
                    }
            document.getElementById("tr"+(i+1)).style.display = "table-row";
            }
            if(data.data.data.length<3){
                console.log(data.data.data.length)
                for(let i=data.data.data.length;i<3;i++){
                    document.getElementById("tr"+(i+1)).style.display = "none";
                }
            }
            
      })
      .catch(e => {
        console.log(e);
      });
            },
            formSubmit(e) {
                e.preventDefault();
                
                axios.post('/formSubmit',
                {
                    id: document.getElementById('id').innerHTML,
                    name: document.getElementById('name').value,
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById("password_confirmation").value
                    })
                .then(function (response) {
                  console.log(response.data.response)
                    console.log(response.data)
                    if(response.data.response==""){
                      location.reload();
                    }else{
                      alert('Error en los datos suministrados')
                    }
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
      .get("/getusers")
      .then(data => {
        this._data.max=data.data.last_page
        for(let i=0;i<data.data.data.length;i++){
            console.log('tr'+(i+1)+'id')
                    document.getElementById('tr'+(i+1)+'id').innerHTML=data.data.data[i].id
                    document.getElementById('tr'+(i+1)+'name').innerHTML=data.data.data[i].name
                    document.getElementById('tr'+(i+1)+'email').innerHTML=data.data.data[i].email
                    document.getElementById('tr'+(i+1)+'release').innerHTML=data.data.data[i].created_at
                    document.getElementById("d"+(i+1)).style.display="block"
                    if(data.data.data[i].activo==1){
                        document.getElementById("alt"+(i+1)).style.display="block"
                        document.getElementById("act"+(i+1)).style.display="none"
                    }else{
                      document.getElementById("alt"+(i+1)).style.display="none"
                        document.getElementById("act"+(i+1)).style.display="block"
                    }
            document.getElementById("tr"+(i+1)).style.display = "table-row";
            }
            if(data.data.data.length<3){
                console.log(data.data.data.length)
                for(let i=data.data.data.length;i<3;i++){
                    document.getElementById("tr"+(i+1)).style.display = "none";
                }
            }
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