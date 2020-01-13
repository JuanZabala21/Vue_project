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
      .get("/getginm?page="+n)
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
      })
            }
  }
    }
</script>