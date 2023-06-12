<header class="header header-sticky mb-0 bg-success">
    <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <img class="nav-icon icon icon-lg" src="views/vendors/@coreui/icons/svg/free/cil-menu.svg"/>
        </button>
        <h5>KLD Faculty Evaluation System</h5>
        <ul class="header-nav ms-3">
            <li class="nav-item dropdown">
                <a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <?=$_SESSION['name']?> <img class="icon me-2" src="views/vendors/@coreui/icons/svg/free/cil-caret-bottom.svg"/>
                </a>
                <div class="dropdown-menu dropdown-menu-end pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <div class="fw-semibold">Account</div>
                    </div>
                    <a class="dropdown-item" href="#" data-coreui-toggle="modal" data-coreui-target="#manageProfile">
                        <img class="icon me-2" src="views/vendors/@coreui/icons/svg/free/cil-cog.svg"/> Manage Profile</a>
                    <a class="dropdown-item" href="/logout">
                        <img class="icon me-2" src="views/vendors/@coreui/icons/svg/free/cil-exit-to-app.svg"/> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</header>
<div class="modal fade" id="manageProfile" tabindex="-1" aria-labelledby="manageProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="manageProfileForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageProfileLabel">Manage Profile</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" value="<?=$_SESSION['name']?>" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="Email Address" name="username" id="username" value="<?=$_SESSION['username']?>" required/>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Password <small>(Leave blank if you don't want to change the password)</small></label>
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id" id="user_id" value="<?=$_SESSION['user_id']?>"/>
                    <button type="button" class="btn btn-secondary text-white" data-coreui-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>