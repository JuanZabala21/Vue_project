<template>
     <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card"> 
              <div class="card-header">
                <h3 class="card-title">Inmuebles Generales</h3>
                  <div class="card-tools">
                    <button class="btn btn-success" @click="newModal">Añadir <i class="fas fa-user-plus fa-fw"></i></button>
                </div>
              </div>
              
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>ID Inmueble</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Ubicación</th>
                        <th>Precio</th>
                        <th>Foto</th>
                        <th>Acción</th>   
                  </tr>
                   
                  <tr v-for="user in users.data" :key="user.id">

                    <td>{{Inmueble.id}}</td>
                    <td>{{Inmueble.name}}</td>
                    <td>{{Inmueble.type}}</td>
                    <td>{{Inmueble.Ubic | upText}}</td>
                    <td>{{Inmueble.price}}</td>
                    <td>{{Inmueble.photo}}</td>
                    <td>{{Inmueble.action}}</td>

                    <td>
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>
            </div>
          </div>
        </div>

        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>
     </div>
          
</template>
