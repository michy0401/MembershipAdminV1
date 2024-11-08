<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Customer Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Customer</li>
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
            <!-- <div class="card-header">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser">Add Customer</button>
            </div>-->

            <div class="card-body">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped" id="example1">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Membership</th>
                                <th>Membership Status</th>
                                <th>Payment Record</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $item = null;
                                $value = null;

                                $customers = CustomerController::ctrShowCustomer($item, $value);

                                foreach($customers as $key => $value){
                                    echo '
                                    <tr>
                                        <td>'.$value["id"].'</td>
                                        <td>'.$value["nombre"].'</td>
                                        <td>'.$value["correo"].'</td>
                                        <td>'.$value["telefono"].'</td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <select class="form-control form-control-sm selectCustomerStatus" idCustomer="'.$value["id"].'">
                                                    <option value="5" '.($value["id_estado"] == 5 ? 'selected' : '').'>Activate</option>
                                                    <option value="6" '.($value["id_estado"] == 6 ? 'selected' : '').'>Canceled</option>
                                                    <option value="7" '.($value["id_estado"] == 7 ? 'selected' : '').'>Pending</option>
                                                    <option value="8" '.($value["id_estado"] == 8 ? 'selected' : '').'>Inactive</option>
                                                </select>
                                            </div>
                                        </td>';
                                    

                                        // Mostrar nombre de membresía
                                        echo '<td>'.$value["nombre_membresia"].'</td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <select class="form-control form-control-sm selectMembershipStatus" idCustomer="'.$value["id"].'">
                                                        <option value="3" '.($value["id_estado_membresia"] == 3 ? "selected" : "").'>Activate</option>
                                                        <option value="4" '.($value["id_estado_membresia"] == 4 ? "selected" : "").'>Inactivate</option>
                                                        <!-- Agrega más opciones si hay más estados de membresía -->
                                                    </select>
                                                </div>
                                            </td>
                                        ';

                                        // Botón de 'Payment Record' para mostrar transacciones
                                        echo '
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a href="customerPayments?id=' . $value['id'] . '" class="btn btn-info btnInfoPago">
                                                        <i class="fas fa-solid fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>';

                                        echo '<td>'.$value["fecha_inicio_membresia"].'</td>';
                                        echo '<td>'.$value["fecha_fin_membresia"].'</td>';

                                        // Botones de editar y eliminar
                                        echo '
                                            <td>
                                                <div class="btn-group d-flex justify-content-center">
                                                    <button class="btn btn-danger btnDeleteCustomer" idCustomer="'.$value["id"].'"><i class="fa fa-solid fa-trash"></i></button>
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
<!-- modal payment customer -->

<div class="modal fade" id="modalPaymentCustomer">

    <div class="modal-dialog">

        <div class="modal-content">

        
            <div class="modal-header" style="background: #17a2b8; color:white;">
                <h4 class="modal-title">Payment Record</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Amount Paid</th>
                                <th>Transaction Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                
                </div>
                <!-- /.card-body -->    
            
            </div>
            <div class="modal-footer justify-content-between">
                <!--<button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>-->
                <button type="submit" class="btn btn-info"data-dismiss="modal">Close</button>
            </div>        
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
                    <h4 class="modal-title">Edit Customer</h4>
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
    $deleteCustomer = new CustomerController();
    $deleteCustomer -> crtDeleteCustomer();
?>