<?php include('header.php'); ?>

<body>
    <?php include('sidebar.php'); ?>
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        <?php include('header_nav.php'); ?>
        <div class="body flex-grow-1 px-3 my-5">
            <div class="container-lg">
                <div class="row mb-3">
                    <h1>Welcome, Prof. <?=$_SESSION['name']?></h1>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card mb-5 text-black bg-white">
                            <div class="card-body pb-4 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fs-4 fw-semibold"><?=$_SESSION['department']?></div>
                                    <div>Department</div>
                                </div>
                                <div>
                                    <img class="icon mb-0" src="views/vendors/@coreui/icons/svg/free/cil-building.svg" style="width:50px;height:60px;"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>
                <!-- /.row-->
            </div>
        </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <?php include('footer.php'); ?>

</body>

</html>