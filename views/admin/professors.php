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
                                <h3 class="card-title mx-0 my-0">Professor List<button type="button" class="float-end btn btn-success text-white" data-coreui-toggle="modal" data-coreui-target="#addProfessorModal">Add Professor</button></h3>
                            </div>
                            <div class="modal fade" id="addProfessorModal" tabindex="-1" aria-labelledby="addProfessorLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form id="addProfessorForm">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addProfessorLabel">Add Professor</h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control" placeholder="First Name" name="fname" id="fname" required/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" placeholder="Last Name" name="lname" id="lname" required/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Email Address</label>
                                                        <input type="text" class="form-control" placeholder="Email Address" name="email" id="email" required/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Department</label>
                                                        <select class="form-select" name="department_id" id="department_id" required>
                                                            <option disabled selected>Select an option</option>
                                                        </select>
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
                                    <table id="professors"></table>
                                </div>
                                <div class="modal fade" id="editProfessorModal" tabindex="-1" aria-labelledby="editProfessorModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <form id="editProfessorForm">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editProfessorModalLabel">Edit Professor</h5>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">First Name</label>
                                                            <input type="text" class="form-control" placeholder="First Name" name="fname" id="fname1" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" placeholder="Last Name" name="lname" id="lname1" required/>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Email Address</label>
                                                            <input type="text" class="form-control" placeholder="Email Address" name="email" id="email1" required/>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">New Password <small>(Leave blank to retain current password.)</small></label>
                                                            <input type="password" class="form-control" placeholder="Password" name="password" id="password1"/>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Department</label>
                                                            <select class="form-select" name="department_id" id="department_id1" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <input type="hidden" name="professor_id" id="professor_id" required/>
                                                    <button type="button" class="btn btn-secondary text-white" data-coreui-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success text-white">Modify</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="deleteProfessorModal" tabindex="-1" aria-labelledby="deleteProfessorLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form id="deleteProfessorForm">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteProfessorLabel">Delete Professor</h5>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-danger">Are you sure to delete this professor?</div>
                                                            <input type="hidden" name="professor_id" id="professor_id1" required/>
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