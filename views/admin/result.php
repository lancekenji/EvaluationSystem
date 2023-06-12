
<?php include('header.php'); ?>

<body>
    <?php include('sidebar.php'); ?>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <?php include('header_nav.php'); ?>
        <div class="body flex-grow-1 px-3 my-5">
            <div class="container-lg">
                <div class="row">
                    <h1>Result <button class="btn btn-success text-white float-end" type="button" id="printBtn">Print</button></h1>
                    <h4>Total Student Evaluated: <span id="total"></span></h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-5">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Department</label>
                                        <select class="form-select" id="department">
                                            <option selected disabled>Select a department</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Professor</label>
                                        <select class="form-select" id="professor">
                                            <option selected disabled>Select a professor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body overflow-auto" style="max-height: 600px;">
                                <div class="table-responsive">
                                    <table id="result"></table>
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