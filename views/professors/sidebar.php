<?php $currentUrl = $_SERVER['REQUEST_URI']; ?>
    <div class="sidebar sidebar-light sidebar-fixed bg-success" id="sidebar">
        <div class="sidebar-brand d-none d-md-flex">
            <img class="sidebar-brand-full my-1" width="100" height="95" alt="CoreUI Logo" src="views/vendors/images/logo.png"/>
            <img class="sidebar-brand-narrow my-1" width="50" height="50" alt="CoreUI Logo" src="views/vendors/images/logo.png"/>
        </div>
        <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item">
                <a class="nav-link" href="/professor/dashboard" <?php if($currentUrl == '/professor/dashboard'){echo('style="background-color:yellow;color:black;"');} ?>>
                    <img class="nav-icon" src="views/vendors/@coreui/icons/svg/free/cil-speedometer.svg"/>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/professor/result" <?php if($currentUrl == '/professor/result'){echo('style="background-color:yellow;color:black;"');} ?>>
                    <img class="nav-icon" src="views/vendors/@coreui/icons/svg/free/cil-chart-pie.svg"/>
                    Evaluation Result
                </a>
            </li>
        </ul>
        <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>