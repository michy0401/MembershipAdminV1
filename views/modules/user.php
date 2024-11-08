<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser">Add User</button>
            </div>

            <div class="card-body">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Foto</th>
                                <th>Perfil</th>
                                <th>Estado</th>
                                <th>Ultimo Login</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $item = null;
                                $value = null;

                                $users = UserController::ctrShowUser($item, $value);

                                foreach($users as $key => $value){
                                    echo '
                                    <tr>
                                        <td>'.$value["id"].'</td>
                                        <td>'.$value["nombre"].'</td>
                                        <td>'.$value["usuario"].'</td>';

                                        if ($value["foto"] != ""){
                                            echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';
                                        } else{
                                            echo '<td><img src="views/dist/img/user.jpg" class="img-thumbnail" width="40px"></td>';
                                        }

                                        echo '
                                            <td>'.$value["cargo"].'</td>
                                        ';

                                        echo '
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <select class="form-control form-control-sm selectEmployeeStatus" idEmployee="' . $value["id"] . '">
                                                        <option value="1" ' . ($value["id_estado"] == 1 ? 'selected' : '') . '>Active</option>
                                                        <option value="2" ' . ($value["id_estado"] == 2 ? 'selected' : '') . '>Inactive</option>
                                                    </select>
                                                </div>
                                            </td>

                                        ';
                                            
                                        
                                        echo '
                                            <td>'.$value["ultimo_login"].'</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-warning btnEditUser" idUser="'.$value["id"].'" data-toggle="modal" data-target="#modalEditUser"><i class="fas fa-solid fa-pen"></i></button>
                                                    <button class="btn btn-danger btnDeleteUser" idUser="'.$value["id"].'" photoUser="'.$value["foto"].'" username="'.$value["usuario"].'"><i class="fa fa-solid fa-trash"></i></button>
                                                </div>
                                            </td>
                                    </tr>';
                                }

                            ?>

                        </tbody>
                    </table>
            
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->


<!-- modal form -->
<!-- modal agregar usuario -->

<div class="modal fade" id="modalAddUser">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">

                <div class="modal-header" style="background: #17a2b8; color:white;">
                    <h4 class="modal-title">Add User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <!-- nombre del usuario --> 
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Name" name="newName" required>
                        </div>
                        <!-- user --> 
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" placeholder="Username" name="newUserName" id="newUserName" required>
                        </div>
                        <!-- password --> 
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="newPassword" required>
                        </div>
                        <!-- profile --> 
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-users"></span>
                                </div>
                            </div>
                            <select type="text" class="form-control" name="newProfile" required>
                                <option value="">Seleccionar perfil</option>
                                <option value="Manager">Manager</option>
                                <option value="Seller">Seller</option>
                            </select>
                        </div>
                        <!-- photo --> 
                        <div class="input-group mb-3">
                            <div class="panel">UPLOAD PHOTO</div>
                            <input type="file" class="newPhoto" name="newPhoto">                               
                            <p class="text-muted">Peso max de la foto 2MB</p>                                
                            <img src="views/dist/img/user.jpg" class="img-thumbnail preview" width="100px" style="margin-top:50px;">
                        </div>
                        

                    </div>
                    <!-- /.card-body -->    
                
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save user</button>
                </div>

                <?php
                    $createUser = new UserController();
                    $createUser -> ctrCreateUser();

                ?>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- modal editar usuario -->

<div class="modal fade" id="modalEditUser">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="post" enctype="multipart/form-data">

                <div class="modal-header" style="background: #17a2b8; color:white;">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="card-body">

                        <!-- nombre del usuario --> 
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" value="" id="editName" name="editName">
                        </div>
                        <!-- user --> 
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-key"></span>
                                </div>
                            </div>
                            <input type="text" class="form-control" value="" id="editUserName" name="editUserName" readonly>
                        </div>
                        <!-- password --> 
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                            <input type="password" class="form-control" placeholder="Write a new Password" name="editPassword">
                            <input type="hidden" id="currentPassword" name="currentPassword">
                        </div>
                        <!-- profile --> 
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-users"></span>
                                </div>
                            </div>
                            <select type="text" class="form-control" name="editProfile">
                                <option value="" id="editProfile"></option>
                                <option value="Manager">Manager</option>
                                <option value="Seller">Seller</option>
                            </select>
                        </div>
                        <!-- photo --> 
                        <div class="input-group mb-3">
                            <div class="panel">UPLOAD PHOTO</div>
                            <input type="file" class="editPhoto" name="editPhoto">                               
                            <p class="text-muted">Peso max de la foto 2MB</p>                                
                            <img src="views/dist/img/user.jpg" class="img-thumbnail preview" width="100px" style="margin-top:50px;">
                            <input type="hidden" name="currentPhoto" id="currentPhoto">
                        </div>
                        

                    </div>
                    <!-- /.card-body -->    
                
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save change</button>
                </div>

                <?php
                    $createUser = new UserController();
                    $createUser -> crtEditUser();
                
                ?>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
    $deleteUser = new UserController();
    $deleteUser -> crtDeleteUser();
?>