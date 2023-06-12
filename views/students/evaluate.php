
<?php
include('header.php');
?>

<body>
    <?php include('sidebar.php'); ?>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <?php include('header_nav.php'); ?>
        <div class="body flex-grow-1 px-3 my-5">
            <div class="container-lg">
                <div class="row mb-3">
                    <h1>Evaluate Form</h1>
                </div>
                <form id="EvaluateForm">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h4 class="card-title text-center">Professor Name</h4>
                                </div>
                                <div class="card-body">
                                    <select class="form-select" id="professor_names" name="professor_id">
                                        <option disabled selected>Select a Professor</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h4 class="card-title text-center">Evaluation Questionnaire</h4>
                                </div>
                                <div class="card-body overflow-auto fs-4" style="max-height: 500px;" id="form_container">
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="student_id" id="student_id" value="'.$_SESSION['user_id'].'"/>
                                    <button type="submit" class="btn btn-success float-end text-white" id="submitForm">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <?php include('footer.php'); ?>

</body>

</html>