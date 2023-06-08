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
                                <h3 class="card-title mx-0 my-0">Student List<button type="button" class="float-end btn btn-success text-white" data-coreui-toggle="modal" data-coreui-target="#addStudentModal">Add Student</button></h3>
                            </div>
                            <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form id="addStudentForm">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addStudentLabel">Add Student</h5>
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
                                                    <div class="col-md-6">
                                                        <label class="form-label">Year Level</label>
                                                        <select class="form-select" name="year_level" id="year_level">
                                                            <option value="1st year">1st year</option>
                                                            <option value="2nd year">2nd year</option>
                                                            <option value="3rd year">3rd year</option>
                                                            <option value="4th year">4th year</option>
                                                        </select> 
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">Section</label>
                                                        <select class="form-select" name="section" id="section">
                                                            <option selected disabled>Select a section</option>
                                                        </select>
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
                                    <table id="students"></table>
                                </div>
                                <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <form id="editStudentForm">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editStudentLabel">Edit Student</h5>
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
                                                            <label class="form-label">Password <small>(Leave blank to retain current password.)</small></label>
                                                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" required/>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Year Level</label>
                                                            <select class="form-select" name="year_level" id="year_level1">
                                                                <option value="1st year">1st year</option>
                                                                <option value="2nd year">2nd year</option>
                                                                <option value="3rd year">3rd year</option>
                                                                <option value="4th year">4th year</option>
                                                            </select> 
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Section</label>
                                                            <select class="form-select" name="section" id="section1">
                                                                <option selected disabled>Select a section</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Department</label>
                                                            <select class="form-select" name="department_id" id="department_id1" required>
                                                                <option disabled selected>Select an option</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="student_id" id="student_id" required/>
                                                    <button type="button" class="btn btn-secondary text-white" data-coreui-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success text-white">Modify</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="deleteStudentLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form id="deleteStudentForm">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteStudentLabel">Delete Student</h5>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <div class="alert alert-danger">Are you sure to delete this student?</div>
                                                            <input type="hidden" name="student_id" id="student_id1" required/>
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