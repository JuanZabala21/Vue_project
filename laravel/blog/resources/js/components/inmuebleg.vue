<style>
td{
  font-weight: bold;
}
</style>
<template>
     <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card" style="width:800px">
              <div class="card-header">
                <h3 class="card-title">Inmuebles Generales</h3>
                <div class="card-tools" style="text-align:center">
                    
                <br>
                <label>Filtro de busqueda</label>
                <br>
                <div style="text-align:left">
                <label>Ubicacion</label>
                <select id="f-ubic" @change="filtro" type="text" name="ub" class="form-control" style="width:auto;display: inline-flex;">
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
                         <option value="0" selected>Ninguno</option>
                       </select>
                       </div>
                </div>
              </div>
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                        <td>ID Inmueble</td>
                        <td>Usuario</td>
                        <td>Nombre</td>
                        <td>Ubicación</td>
                        <td>Precio</td>
                        <td>Foto</td> 
                  </tr>
                  </thead>
                  <tbody>
                    <tr id="tr1" style="display:none">
                      <td id="id1"></td>
                      <td id="user1"></td>
                      <td id="name1"></td>
                      <td id="ubic1"></td>
                      <td id="precio1"></td>
                      <td id="img1"></td>
                    </tr>
                    <tr id="tr2" style="display:none">
                      <td id="id2"></td>
                      <td id="user2"></td>
                      <td id="name2"></td>
                      <td id="ubic2"></td>
                      <td id="precio2"></td>
                      <td id="img2"></td>
                    </tr>
                    <tr id="tr3" style="display:none">
                      <td id="id3"></td>
                      <td id="user3"></td>
                      <td id="name3"></td>
                      <td id="ubic3"></td>
                      <td id="precio3"></td>
                      <td id="img3"></td>
                    </tr>
                </tbody></table>
                <h2 id="msg" style="display:none;">No hay registros disponibles...</h2>
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
      </div>
</template>
<script>
    export default {
      data() {
            return {
                id: '',
                max:'',
                current:'1',
                users:{}
              }
            },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
          axios
      .get("/getalluser")
      .then(data => {
        this.users=data.data
      })
      .catch(e => {
        console.log(e);
      });
        axios
      .get("/getginm")
      .then(data => {
        this._data.max=data.data.last_page
        document.getElementById("tr1").style.display="none"
        document.getElementById("tr2").style.display="none"
        document.getElementById("tr3").style.display="none"
        for(let i=0;i<data.data.data.length;i++){
                    document.getElementById('id'+(i+1)).innerHTML=data.data.data[i].id
                    for(let j=0;j<this.users.length;j++){
                      if(this.users[j].id==data.data.data[i].id_usuario){
                        document.getElementById('user'+(i+1)).innerHTML=this.users[j].name
                      }
                    }
                    
                    document.getElementById('name'+(i+1)).innerHTML=data.data.data[i].name
                    document.getElementById('ubic'+(i+1)).innerHTML=data.data.data[i].ubicacion
                    document.getElementById('precio'+(i+1)).innerHTML=data.data.data[i].precio
                    document.getElementById('img'+(i+1)).innerHTML='<img src="/images/inmueble/'+data.data.data[i].img+'" style="max-height: 65px;" class="avatar img-circle" id="img" alt="avatar">'
                    document.getElementById("tr"+(i+1)).style.display = "table-row";
            }
            if(data.data.data.length<3){
                for(let i=data.data.data.length;i<3;i++){
                    document.getElementById("tr"+(i+1)).style.display = "none";
                }
            }
            document.getElementById("msg").style.display="none"
            if(document.getElementById("tr1").style.display=="none"){
              if(document.getElementById("tr2").style.display=="none"){
                if(document.getElementById("tr3").style.display=="none"){
                  document.getElementById("msg").style.display="block"
                }
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
  methods:{
    filtro(){
let currentObj = this;
      const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();
                this._data.current=1
                formData.append('filtro', document.getElementById('f-ubic').value);
               axios.post("/getginm?page="+this._data.current, formData, config)
                .then(function (data) {
currentObj._data.max=data.data.last_page
        document.getElementById("tr1").style.display="none"
        document.getElementById("tr2").style.display="none"
        document.getElementById("tr3").style.display="none"
        for(let i=0;i<data.data.data.length;i++){
                    document.getElementById('id'+(i+1)).innerHTML=data.data.data[i].id
                    for(let j=0;j<currentObj.users.length;j++){
                      if(currentObj.users[j].id==data.data.data[i].id_usuario){
                        document.getElementById('user'+(i+1)).innerHTML=currentObj.users[j].name
                      }
                    }
                    
                    document.getElementById('name'+(i+1)).innerHTML=data.data.data[i].name
                    document.getElementById('ubic'+(i+1)).innerHTML=data.data.data[i].ubicacion
                    document.getElementById('precio'+(i+1)).innerHTML=data.data.data[i].precio
                    document.getElementById('img'+(i+1)).innerHTML='<img src="/images/inmueble/'+data.data.data[i].img+'" style="max-height: 65px;" class="avatar img-circle" id="img" alt="avatar">'
                    document.getElementById("tr"+(i+1)).style.display = "table-row";
            }
            if(data.data.data.length<3){
                for(let i=data.data.data.length;i<3;i++){
                    document.getElementById("tr"+(i+1)).style.display = "none";
                }
            }
            document.getElementById("msg").style.display="none"
            if(document.getElementById("tr1").style.display=="none"){
              if(document.getElementById("tr2").style.display=="none"){
                if(document.getElementById("tr3").style.display=="none"){
                  document.getElementById("msg").style.display="block"
                }
              }
            }
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
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();
                formData.append('filtro', document.getElementById('f-ubic').value);
               axios.post("/getginm?page="+this._data.current, formData, config)
      .then(data => {
        this._data.max=data.data.last_page
        document.getElementById("tr1").style.display="none"
        document.getElementById("tr2").style.display="none"
        document.getElementById("tr3").style.display="none"
        for(let i=0;i<data.data.data.length;i++){
                    document.getElementById('id'+(i+1)).innerHTML=data.data.data[i].id
                    for(let j=0;j<this.users.length;j++){
                      if(this.users[j].id==data.data.data[i].id_usuario){
                        document.getElementById('user'+(i+1)).innerHTML=this.users[j].name
                      }
                    }
                    
                    document.getElementById('name'+(i+1)).innerHTML=data.data.data[i].name
                    document.getElementById('ubic'+(i+1)).innerHTML=data.data.data[i].ubicacion
                    document.getElementById('precio'+(i+1)).innerHTML=data.data.data[i].precio
                    document.getElementById('img'+(i+1)).innerHTML='<img src="/images/inmueble/'+data.data.data[i].img+'" style="max-height: 65px;" class="avatar img-circle" id="img" alt="avatar">'
                    document.getElementById("tr"+(i+1)).style.display = "table-row";
            }
            if(data.data.data.length<3){
                for(let i=data.data.data.length;i<3;i++){
                    document.getElementById("tr"+(i+1)).style.display = "none";
                }
            }
            document.getElementById("msg").style.display="none"
            if(document.getElementById("tr1").style.display=="none"){
              if(document.getElementById("tr2").style.display=="none"){
                if(document.getElementById("tr3").style.display=="none"){
                  document.getElementById("msg").style.display="block"
                }
              }
            }
      })
            }
  }
    }
</script>