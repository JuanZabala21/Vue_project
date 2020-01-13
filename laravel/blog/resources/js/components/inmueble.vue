<style>
td{
  font-weight: bold;
}
</style>
<template>
     <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div>
</div>
            <div class="card" style="width:800px">
              <div class="card-header">
                <h3 class="card-title">Inmuebles Personales</h3>
                  <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Añadir <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <td>ID Inmueble</td>
                        <td>Nombre</td>
                        <td>Tipo</td>
                        <td>Ubicación</td>
                        <td>Precio</td>
                        <td>Foto</td> 
                        <td>Acciones(eliminar/editar)</td> 
                  </tr>
                  </thead>
                  <tbody>
                    <tr id="tr1" style="display:none">
                      <td id="id1"></td>
                      <td id="name1"></td>
                      <td id="tipo1"></td>
                      <td id="ubic1"></td>
                      <td id="precio1"></td>
                      <td id="img1"></td>
                      <td id="acc1">
                        <a @click="updt(1)" >
                            <button id="upd1" type="submit" class="btn btn-primary" style="color:black;background-color:green;display:none;">Editar</button>
                        </a>
                        <a @click='delet(1)' >
                            <button id="alt1" type="submit" class="btn btn-primary" style="color:black;background-color:red;display:none;">Eliminar</button>
                        </a>
                      </td>
                    </tr>
                    <tr id="tr2" style="display:none">
                      <td id="id2"></td>
                      <td id="name2"></td>
                      <td id="tipo2"></td>
                      <td id="ubic2"></td>
                      <td id="precio2"></td>
                      <td id="img2"></td>
                      <td id="acc2">
                        <a @click="updt(2)" >
                            <button id="upd2" type="submit" class="btn btn-primary" style="color:black;background-color:green;display:none;">Editar</button>
                        </a>
                        <a @click='delet(2)' >
                            <button id="alt2" type="submit" class="btn btn-primary" style="color:black;background-color:red;display:none;">Eliminar</button>
                        </a>
                      </td>
                    </tr>
                    <tr id="tr3" style="display:none">
                      <td id="id3"></td>
                      <td id="name3"></td>
                      <td id="tipo3"></td>
                      <td id="ubic3"></td>
                      <td id="precio3"></td>
                      <td id="img3"></td>
                      <td id="acc3">
                        <a @click="updt(3)" >
                            <button id="upd3" type="submit" class="btn btn-primary" style="color:black;background-color:green;display:none;">Editar</button>
                        </a>
                        <a @click='delet(3)' >
                            <button id="alt3" type="submit" class="btn btn-primary" style="color:black;background-color:red;display:none;">Eliminar</button>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              
              <!-- /.card-body -->
              <div class="card-footer" style="text-align:center">
                  <div id="pag" class="pagination">
  <a @click="test('prev')">&laquo;</a>
  <a @click="test('post')">&raquo;</a>
</div>

              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
<!-- Modal delete-->
          <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Eliminar tu inmueble</h5>
                    <button type="button" class="close"  aria-label="Close"  data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit="submitDelete" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                  <h5 class="modal-title" id="addNewLabel">¿Eliminar tu inmueble?</h5>
                      <input id="d-id" type="text" name="e-id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Eliminar</button>
                </div>
                </form>
              </div>
            </div>
         </div>
    <!-- Modal edit-->
          <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Editar tu inmueble</h5>
                    <button type="button" class="close"  aria-label="Close"  data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit="submitUpdate" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                     <div class="form-group">
                       <input id="e-id" type="text" name="e-id" style="display:none;">
                        <input id="e-name" type="text" name="name"
                            placeholder="Nombre"
                            class="form-control" style="margin-bottom: 1rem;" required>
                    </div>
                     <div class="form-group">
                       <select id="e-tipo" type="text" name="tipo" class="form-control" style="margin-bottom: 1rem;">
                         <option value="0">Terreno</option>
                         <option value="1">Apartamento</option>
                         <option value="2">Casa</option>
                         <option value="3">Fábrica</option>
                         <option value="4">Local</option>
                         <option value="5">Parcela</option>
                       </select>
                    </div>
                     <div class="form-group">
                       <select id="e-ubic" type="text" name="tipo" class="form-control" style="margin-bottom: 1rem;">
                         <option value="Bejuma">Bejuma</option>
                         <option value="Carlos Arvelo">Carlos Arvelo</option>
                         <option value="Diego Ibarra">Diego Ibarra</option>
                         <option value="Guacara">Guacara</option>
                         <option value="Juan José Mora">Juan José Mora</option>
                         <option value="Libertador">Libertador</option>
                         <option value="Los Guayos">Los Guayos</option>
                         <option value="Miranda">Miranda</option>
                         <option value="Montalbán">Montalbán</option>
                         <option value="Naguanagua">Naguanagua</option>
                         <option value="Puerto Cabello">Puerto Cabello</option>
                         <option value="San Diego">San Diego</option>
                         <option value="San Joaquín">San Joaquín</option>
                         <option value="Valencia">Valencia</option>
                       </select>
                    </div>
                      <div class="form-group">
                        <input id="e-precio" type="number" name="tipo"
                            placeholder="Precio"
                            class="form-control" style="margin-bottom: 1rem;" min="1" value="1">
                    </div>
                      <div class="form-group">
                        <input id="e-image" name="Foto" class="form-control"
                        type="file" accept="image/x-png,image/gif,image/jpeg" v-on:change="onImageChange" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
                </form>
              </div>
            </div>
         </div>
    <!-- Modal new -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewLabel">Añadir tu inmueble</h5>
                    <button type="button" class="close"  aria-label="Close"  data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit="submitCreate" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                     <div class="form-group">
                        <input id="n-name" type="text" name="name"
                            placeholder="Nombre"
                            class="form-control" style="margin-bottom: 1rem;" required>
                    </div>
                     <div class="form-group">
                       <select id="n-tipo" type="text" name="tipo" class="form-control" style="margin-bottom: 1rem;">
                         <option value="Terreno">Terreno</option>
                         <option value="Apartamento">Apartamento</option>
                         <option value="Casa">Casa</option>
                         <option value="Fábrica">Fábrica</option>
                         <option value="Local">Local</option>
                         <option value="Parcela">Parcela</option>
                       </select>
                    </div>
                     <div class="form-group">
                       <select id="n-ubic" type="text" name="tipo" class="form-control" style="margin-bottom: 1rem;">
                         <option value="Bejuma">Bejuma</option>
                         <option value="Carlos Arvelo">Carlos Arvelo</option>
                         <option value="Diego Ibarra">Diego Ibarra</option>
                         <option value="Guacara">Guacara</option>
                         <option value="Juan José Mora">Juan José Mora</option>
                         <option value="Libertador">Libertador</option>
                         <option value="Los Guayos">Los Guayos</option>
                         <option value="Miranda">Miranda</option>
                         <option value="Montalbán">Montalbán</option>
                         <option value="Naguanagua">Naguanagua</option>
                         <option value="Puerto Cabello">Puerto Cabello</option>
                         <option value="San Diego">San Diego</option>
                         <option value="San Joaquín">San Joaquín</option>
                         <option value="Valencia">Valencia</option>
                       </select>
                    </div>
                      <div class="form-group">
                        <input id="n-precio" type="number" name="tipo"
                            placeholder="Precio"
                            class="form-control" style="margin-bottom: 1rem;" min="1" value="1">
                    </div>
                      <div class="form-group">
                        <input id="image" name="Foto" class="form-control"
                        type="file" accept="image/x-png,image/gif,image/jpeg" v-on:change="onImageChange" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
                </form>
              </div>
            </div>
         </div>
      </div>
</template>
<script>
    export default {
       data() {
            return {
                id: '',
                image: '',
                max:'',
                current:'1',
                id1:'',
                id2:'',
                id3:'',
            }
        },
      methods: 
      {
        delet(n){
          let dat
          if(n==1){
            dat=this.id1
          }else if(n==2){
            dat=this.id2
          }else{
            dat=this.id3
          }
          document.getElementById('d-id').value=dat;
          $('#delete').modal('show');
            },
        updt(n){
          let dat
          if(n==1){
            dat=this.id1
          }else if(n==2){
            dat=this.id2
          }else{
            dat=this.id3
          }
          const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
                let formData = new FormData();
                formData.append('id', dat);
                axios.post('/get1inm', formData, config)
                .then(function (response) {
                                    let band=0,ti,ub
                for(let i=0;i<document.getElementById("e-tipo").options.length;i++){
                  if(document.getElementById("e-tipo").options[i].value==response.data.data[0].tipo){
                    band=1
                    ti= i
                    }
                  }
                  if(band==0){
                    ti= 0
                  }
                  for(let i=0;i<document.getElementById("e-ubic").options.length;i++){
                  if(document.getElementById("e-ubic").options[i].value==response.data.data[0].ubicacion){
                    band=1
                    ub= i
                    }
                  }
                  if(band==0){
                    ub= 0
                  }
                  document.getElementById('e-id').value=response.data.data[0].id;
                  document.getElementById('e-name').value=response.data.data[0].name;
                  document.getElementById('e-precio').value=response.data.data[0].precio;
                  document.getElementById("e-tipo").selectedIndex = ti;
                  document.getElementById("e-ubic").selectedIndex = ub;
                  $('#edit').modal('show');
                })
                .catch(function (error) {
                  console.log(error)
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
      .get("/getpinm?page="+n)
      .then(data => {
        this._data.max=data.data.last_page
        document.getElementById("tr1").style.display="none"
        document.getElementById("tr2").style.display="none"
        document.getElementById("tr3").style.display="none"
        for(let i=0;i<data.data.data.length;i++){
            if(i==0){
              this.id1=data.data.data[i].id
            }else if(i==1){
              this.id2=data.data.data[i].id
            }else{
              this.id3=data.data.data[i].id
            }
                    document.getElementById('tr'+(i+1)).style.display="block"
                    if(this._data.current==1){
                      document.getElementById('id'+(i+1)).innerHTML=i+1
                    }else if(this._data.current==2){
                      document.getElementById('id'+(i+1)).innerHTML=i+4
                    }else{
                      document.getElementById('id'+(i+1)).innerHTML=i+4+(3*(this._data.current-2))
                    }
                    
                    document.getElementById('name'+(i+1)).innerHTML=data.data.data[i].name
                    document.getElementById('tipo'+(i+1)).innerHTML=data.data.data[i].tipo
                    document.getElementById('ubic'+(i+1)).innerHTML=data.data.data[i].ubicacion
                    document.getElementById('precio'+(i+1)).innerHTML=data.data.data[i].precio
                    document.getElementById('img'+(i+1)).innerHTML=data.data.data[i].img
                    document.getElementById("acc"+(i+1)).style.display="flex"
                    document.getElementById("alt"+(i+1)).style.display="block"
                    document.getElementById("upd"+(i+1)).style.display="block"
            document.getElementById("tr"+(i+1)).style.display = "table-row";
            }
            if(data.data.data.length<3){
                for(let i=data.data.data.length;i<3;i++){
                    document.getElementById("tr"+(i+1)).style.display = "none";
                }
            }
      })
      .catch(e => {
        console.log(e);
      });
            },
        onImageChange(e){
                this.image = e.target.files[0];
            },
            submitDelete(e) {
          e.preventDefault();
          let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();
                formData.append('id', document.getElementById('d-id').value);
               axios.post('/deleteInm', formData, config)
                .then(function (response) {
                  alert('Inmueble eliminado con exito')
                  location.reload();
                })
                .catch(function (error) {
                    currentObj.output = error;
                });

            },
            submitUpdate(e) {
          e.preventDefault();
          let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                let formData = new FormData();
                formData.append('id', document.getElementById('e-id').value);
                formData.append('name', document.getElementById('e-name').value);
                formData.append('tipo', document.getElementById('e-tipo').value);
                formData.append('ubic', document.getElementById('e-ubic').value);
                formData.append('precio', document.getElementById('e-precio').value);
                formData.append('image', this.image);
               axios.post('/updateInm', formData, config)
                .then(function (response) {
                  alert('Inmueble actualizado con exito')
                  location.reload();
                })
                .catch(function (error) {
                    currentObj.output = error;
                });

            },
        submitCreate(e) {
          e.preventDefault();
          let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
 
                let formData = new FormData();
                formData.append('id', this.id);
                formData.append('name', document.getElementById('n-name').value);
                formData.append('tipo', document.getElementById('n-tipo').value);
                formData.append('ubic', document.getElementById('n-ubic').value);
                formData.append('precio', document.getElementById('n-precio').value);
                formData.append('image', this.image);
               axios.post('/createInm', formData, config)
                .then(function (response) {
                  alert('Inmueble guardado con exito')
                  location.reload();
                    currentObj.success = response.data.success;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });

            },
        newModal(){
                document.getElementById('n-name').value="";
                document.getElementById('n-precio').value=1;
                document.getElementById('image').value="";
                document.getElementById("n-tipo").selectedIndex = 0;
                document.getElementById("n-ubic").selectedIndex = 0;
                $('#addNew').modal('show');
            }
      },
      created() {
        axios
      .get("/getpinm")
      .then(data => {
        this._data.max=data.data.last_page
        document.getElementById("tr1").style.display="none"
        document.getElementById("tr2").style.display="none"
        document.getElementById("tr3").style.display="none"
        for(let i=0;i<data.data.data.length;i++){
            if(i==0){
              this.id1=data.data.data[i].id
            }else if(i==1){
              this.id2=data.data.data[i].id
            }else{
              this.id3=data.data.data[i].id
            }
                    document.getElementById('tr'+(i+1)).style.display="block"
                    document.getElementById('id'+(i+1)).innerHTML=i+1
                    document.getElementById('name'+(i+1)).innerHTML=data.data.data[i].name
                    document.getElementById('tipo'+(i+1)).innerHTML=data.data.data[i].tipo
                    document.getElementById('ubic'+(i+1)).innerHTML=data.data.data[i].ubicacion
                    document.getElementById('precio'+(i+1)).innerHTML=data.data.data[i].precio
                    document.getElementById('img'+(i+1)).innerHTML='<img src="/images/inmueble/'+data.data.data[i].img+'" style="max-height: 65px;" class="avatar img-circle" id="img" alt="avatar">'
                    document.getElementById("acc"+(i+1)).style.display="flex"
                    document.getElementById("alt"+(i+1)).style.display="block"
                    document.getElementById("upd"+(i+1)).style.display="block"
            document.getElementById("tr"+(i+1)).style.display = "table-row";
            }
            if(data.data.data.length<3){
                for(let i=data.data.data.length;i<3;i++){
                    document.getElementById("tr"+(i+1)).style.display = "none";
                }
            }
      })
      .catch(e => {
        console.log(e);
      });
  window.axios.defaults.headers.common = {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                };
      axios
      .get("profiles")
      .then(data => {
        this.id=data.data.id
      })
      .catch(e => {
      });
  },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>