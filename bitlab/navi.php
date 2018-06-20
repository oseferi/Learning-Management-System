<div class="wrapper ">
        <div class="sidebar" data-color="orange">
            <div class="logo" style="background: #ffffff">
                <img src="BitLAB.png" alt="">
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li >
                        <a href="zona_didaktike/index.php">
                            <i class="now-ui-icons design_app"></i>
                            <p>Zona Didaktike</p>
                        </a>
                    </li>
                    <li class="disabled">
                        <a href="#">
                            <i class="now-ui-icons education_atom"></i>
                            <p>Formim Personal</p>
                        </a>
                    </li>
                   <li>
                        <a href="forumi/">
                            <i class="now-ui-icons design_bullet-list-67"></i>
                            <p>Forumi</p>
                        </a>
                    </li>
                </ul>
            
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#pablo"><?php echo $Headeri; ?></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <form>
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <span id="srch" class="input-group-addon">
                                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                                </span>
                            </div>
                        </form>
                        <ul class="navbar-nav">
                            <!--li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons media-2_sound-wave"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Stats</span>
                                    </p>
                                </a>
                            </li-->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="now-ui-icons loader_gear"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="profile.php"><i class="now-ui-icons users_single-02"></i>Profile</a>
                                    <a class="dropdown-item" href="#"><i class="now-ui-icons media-1_button-power"></i> Log Out</a>
                                </div>
                            </li>
                            <!--li class="nav-item">
                                <a class="nav-link" href="#pablo">
                                    <i class="now-ui-icons users_single-02"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                            </li-->
                        </ul>
                    </div>
                </div>
            </nav>

