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
                                <h3 class="card-title mx-0 my-0">Section List<button type="button" class="float-end btn btn-success text-white" data-coreui-toggle="modal" data-coreui-target="#addSectionModal">Add Section</button></h3>
                            </div>
                            <div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form id="addSectionForm">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addSectionLabel">Add Section</h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label">Section Name</label>
                                                        <input type="text" class="form-control" placeholder="Section Name" name="section_name" id="section_name" required/>
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
                                    <table id="section"></table>
                                    <div class="modal fade" id="deleteSectionModal" tabindex="-1" aria-labelledby="deleteSectionLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form id="deleteSectionForm">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteSectionLabel">Delete Section</h5>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <div class="alert alert-danger">Are you sure to delete this section?</div>
                                                                <input type="hidden" name="section_id" id="section_id" required/>
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
                                    <div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form id="editSectionForm">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                                                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-3">
                                                            <div class="col-md-12">
                                                                <label class="form-label">Section Name</label>
                                                                <input type="text" class="form-control" placeholder="Section Name" name="section_name" id="section_name" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    <input type="hidden" name="section_id" id="section_id" required/>
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