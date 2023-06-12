
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
                                <h3 class="card-title mx-0 my-0">Questions List<button type="button" class="float-end btn btn-success text-white" data-coreui-toggle="modal" data-coreui-target="#addQuestionModal">Add Question(s)</button></h3>
                            </div>
                            <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form id="addQuestionForm">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addQuestionLabel">Add Question</h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Question Text</label>
                                                        <textarea class="form-control" placeholder="Question" name="question_text" id="question_text" required></textarea>
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
                                    <table id="questions"></table>
                                    <div class="modal fade" id="deleteQuestionModal" tabindex="-1" aria-labelledby="deleteQuestionLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form id="deleteQuestionForm">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteQuestionLabel">Delete Question</h5>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="alert alert-danger">Are you sure to delete this question?</div>
                                                                <input type="hidden" name="question_id" id="question_id" required/>
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
                                    <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editQuestionModal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form id="editQuestionForm">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editQuestionModalLabel">Edit Question</h5>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Question Text</label>
                                                                <textarea class="form-control" placeholder="Question" name="question_text" id="question_text1" required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <input type="hidden" name="question_id" id="question_id1" required/>
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