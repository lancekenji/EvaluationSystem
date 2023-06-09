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
                    <a class="dropdown-item" href="#">
                        <img class="icon me-2" src="views/vendors/@coreui/icons/svg/free/cil-cog.svg"/> Manage Profile</a>
                    <a class="dropdown-item" href="/logout">
                        <img class="icon me-2" src="views/vendors/@coreui/icons/svg/free/cil-exit-to-app.svg"/> Logout</a>
                </div>
            </li>
        </ul>
    </div>
</header>