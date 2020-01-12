<template>
     <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Inmuebles Personales</h3>
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
            <!-- /.card -->
          </div>
        </div>

        <div v-if="!$gate.isAdminOrAuthor()">
            <not-found></not-found>
        </div>

    <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Añadir</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Añadir tu inmueble</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="editmode ? updateUser() : createUser()">
                <div class="modal-body">
                     <div class="form-group">
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Nombre"
                            class="form-control">
                    </div>
                     <div class="form-group">
                        <input v-model="form.tipo" type="text" name="tipo"
                            placeholder="Tipo"
                            class="form-control"> 
                    </div>
                     <div class="form-group">
                        <input v-model="form.Ubic" type="text" name="tipo"
                            placeholder="Ubicación"
                            class="form-control">
                    </div>
                      <div class="form-group">
                        <input v-model="form.price" type="number" name="tipo"
                            placeholder="Precio"
                            class="form-control">
                    </div>
                      <div class="form-group">
                        <input v-model="form.photo" type="submit" name="Foto"
                            class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                    <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                </div>
                </form>
              </div>
            </div>
         </div>
      </div>
</template>
