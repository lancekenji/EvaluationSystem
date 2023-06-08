<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>
    <div class="sidebar sidebar-light sidebar-fixed bg-success" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <img class="sidebar-brand-full my-1" width="100" height="95" alt="CoreUI Logo" src="views/vendors/images/logo.png"/>
            <img class="sidebar-brand-narrow my-1" width="50" height="50" alt="CoreUI Logo" src="views/vendors/images/logo.png"/>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item">
                <a class="nav-link" href="/admin/dashboard" <?php if($currentUrl == '/admin/dashboard'){echo('style="background-color:yellow;color:black;"');} ?>>
                    <img class="nav-icon" src="views/vendors/@coreui/icons/svg/free/cil-speedometer.svg"/>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/department" <?php if($currentUrl == '/admin/department'){echo('style="background-color:yellow;color:black;"');} ?>>
                    <img class="nav-icon" src="views/vendors/@coreui/icons/svg/free/cil-building.svg"/>
                    Department
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/section" <?php if($currentUrl == '/admin/section'){echo('style="background-color:yellow;color:black;"');} ?>>
                    <img class="nav-icon" src="views/vendors/@coreui/icons/svg/free/cil-list.svg"/>
                    Section
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/professors" <?php if($currentUrl == '/admin/professors'){echo('style="background-color:yellow;color:black;"');} ?>>
                    <img class="nav-icon" src="views/vendors/@coreui/icons/svg/free/cil-school.svg"/>
                    Professors
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/students" <?php if($currentUrl == '/admin/students'){echo('style="background-color:yellow;color:black;"');} ?>>
                    <img class="nav-icon" src="views/vendors/@coreui/icons/svg/free/cil-school.svg"/>
                    Students
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/evaluation" <?php if($currentUrl == '/admin/evaluation'){echo('style="background-color:yellow;color:black;"');} ?>>
                    <img class="nav-icon" src="views/vendors/@coreui/icons/svg/free/cil-notes.svg"/>
                    Evaluation
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/users" <?php if($currentUrl == '/admin/users'){echo('style="background-color:yellow;color:black;"');} ?>>
                    <img class="nav-icon" src="views/vendors/@coreui/icons/svg/free/cil-group.svg"/>
                    Users
                </a>
            </li>
        </ul>
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>