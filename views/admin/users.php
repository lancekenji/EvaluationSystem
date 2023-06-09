<?php include('header.php'); ?>

<body>
    <?php include('sidebar.php'); ?>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <?php include('header_nav.php'); ?>
        <div class="body flex-grow-1 px-3 my-5">
            <div class="container-lg">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-5">
                            <div class="card-header p-4">
                                <h3 class="card-title mx-0 my-0">User List<button type="button" class="float-end btn btn-success text-white" data-coreui-toggle="modal" data-coreui-target="#addUserModal">Add User</button></h3>
                            </div>
                            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form id="addUserForm">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addUserLabel">Add User</h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" class="form-control" placeholder="Name" name="name" id="name" required/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Email Address</label>
                                                        <input type="email" class="form-control" placeholder="Username" name="username" id="username" required/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary text-white" data-coreui-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success text-white">Create</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="users"></table>
                                    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form id="deleteUserForm">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteUserLabel">Delete User</h5>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="alert alert-danger">Are you sure to delete this user?</div>
                                                                <input type="hidden" name="user_id" id="user_id1" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary text-white" data-coreui-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success text-white">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form id="editUserForm">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editUserLabel">Edit User</h5>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" class="form-control" placeholder="Name" name="name" id="name1" required/>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Email Address</label>
                                                                <input type="email" class="form-control" placeholder="Username" name="username" id="username1" required/>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Password <small>(Leave blank to retain current password.)</small></label>
                                                                <input type="password" class="form-control" placeholder="Password" name="password" id="password1" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="user_id" id="user_id2"/>
                                                        <button type="button" class="btn btn-secondary text-white" data-coreui-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success text-white">Modify</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <?php include('footer.php'); ?>

</body>

</html>