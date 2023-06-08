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
                                <h3 class="card-title mx-0 my-0">Department List<button type="button" data-coreui-toggle="modal" data-coreui-target="#addDepartmentModal" class="float-end btn btn-success text-white">Add Department</button></h3>
                            </div>
                            <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form id="addDepartmentForm">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addDepartmentLabel">Add Department</h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Department Name</label>
                                                        <input type="text" class="form-control" placeholder="Department Name" name="department_name" id="department_name" required/>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Department Description</label>
                                                        <textarea class="form-control" placeholder="Description" name="description" id="description" required></textarea>
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
                                    <table id="department"></table>
                                    <div class="modal fade" id="deleteDepartmentModal" tabindex="-1" aria-labelledby="deleteDepartmentLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form id="deleteDepartmentForm">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteDepartmentLabel">Delete Department</h5>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="alert alert-danger">Are you sure to delete this department?</div>
                                                                <input type="hidden" name="department_id" id="department_id" required/>
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
                                    <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form id="editDepartmentForm">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Department Name</label>
                                                                <input type="text" class="form-control" placeholder="Department Name" name="department_name" id="department_name" required/>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Department Description</label>
                                                                <textarea class="form-control" placeholder="Description" name="description" id="description" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <input type="hidden" name="department_id" id="department_id" required/>
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