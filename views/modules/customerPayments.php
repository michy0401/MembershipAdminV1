<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?php
                        // Obtener el id del cliente desde la URL
                        if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            
                            // Realizar la consulta para obtener el nombre del cliente
                            $query = "SELECT nombre FROM cliente WHERE id = :id";
                            $stmt = $pdo->prepare($query); // Asumiendo que $pdo es la conexión a la base de datos
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

                            // Mostrar el nombre del cliente si existe
                            if ($cliente) {
                                echo "Customer Admin - " . $cliente['nombre'];
                            } else {
                                echo "Customer Admin";
                            }
                        } else {
                            echo "Customer Admin";
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="customer">Customer</a></li>
                        <li class="breadcrumb-item active">Payments Customer</li>
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
            <div class="card-body">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Amount Paid</th>
                                <th>Transaction Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if (isset($id)) {
                                    // Obtener pagos del cliente con el id de la URL
                                    $payments = PaymentRecordController::ctrShowPaymentRecordsByClient($id);

                                    if ($payments) {
                                        foreach($payments as $payment) {
                                            echo '
                                            <tr>
                                                <td>' . $payment["id"] . '</td>
                                                <td>' . $payment["monto"] . '</td>
                                                <td>' . $payment["id_estado"] . '</td>
                                                <td>' . $payment["payday"] . '</td> <!-- Asegúrate de que este campo exista en tu base de datos -->
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-warning btnEditCustomer" idCustomer="' . $payment["id"] . '" data-toggle="modal" data-target="#modalEditCustomer">
                                                            <i class="fas fa-solid fa-pen"></i>
                                                        </button>
                                                        <button class="btn btn-danger btnDeleteCustomer" idCustomer="' . $payment["id"] . '">
                                                            <i class="fa fa-solid fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="5">No payments found for this customer.</td></tr>';
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>





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