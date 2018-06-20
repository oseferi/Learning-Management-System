<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Bitlab |Progressing Bit by Bit </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
     <!--link rel="stylesheet" href="plugin/netflix-style-carousel/css/style.css"-->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- CSS Just for demo purpose, don't include it in your project >
    <link href="assets/demo/demo.css" rel="stylesheet" /-->

<body class="">
          <?php
    /**************************************
    *M E N A X H I M I  N A V I G I M I T
    *************************************/
        $Headeri="Dashboard Zona Didaktike";
        include("navi.php");
     ?>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
                <!-- <canvas id="bigDashboardChart"></canvas> -->
            </div>

            <div class="content">
                <div class="row">
                    <div class="col-md-9 col-sm-8 col-xs-8">
                           <div class="card ">
                                  <div class="card-header">
                                    <h5 class="card-category">#</h5>
                                    <h4 class="card-title">Postimet e Fundit</h4>
<!--                                     <ul>
                                        <li><a href="#" onclick="shfaqtegjitha()">Te gjitha</a></li>
                                        <li><a href="#" onclick="shfaqartikuj()">Artikuj</a></li>
                                        <li><a href="#" onclick="shfaqleksione()">Leksione</a></li>
                                        <li><a href="#" onclick="shfaqteze()">Teza</a></li>
                                    </ul> -->
                                    <ul>
                                        <li><button id="all" type="button" name="all">Te gjitha</button></li>
                                        <li><button id="leksione" type="button" name="leksione">Leksione</button></li>
                                        <li><button id="teze" type="button" name="teze">Teza</button></li>
                                    </ul>
                                  </div>
                                  <div  class="card-body">

                                    <div id="SecondContainer" class="card-columns">
                                        
                                        <div id="1" class="single-card" data-kategori="Informatik" data-lende="administrim & siguri sistemesh" data-lloj="teze">
                                        <a href="#">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h5 class="card-category">Teze</h5>
                                             <h4 class="card-title">Hyrje ne POO</h4> 
                                              </div>
                                              <div class="card-body">
                                                Algoritmik
                                            </br>
                                               <span style="float: right"><button type="">Lexo</button></span> 
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>Informatik
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                        </div>

                                         <div id="2" class="single-card" data-kategori="Informatik" data-lende="administrim & siguri sistemesh" data-lloj="teze">
                                            <a href="" title="">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h5 class="card-category">Teze</h5>
                                                <a href="#"><h4 class="card-title">Hyrje ne POO</h4></a>
                                              </div>
                                              <div class="card-body">
                                                Algoritmik
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>Informatik
                                                </div>
                                              </div>
                                            </div>
                                            </a>
                                        </div>

                                         <div id="2" class="single-card" data-kategori="Informatik" data-lende="administrim & siguri sistemesh" data-lloj="teze">
                                            <a href="#">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h5 class="card-category">Teze</h5>
                                                <a href="#1"><h4 class="card-title">Hyrje ne POO</h4></a>
                                              </div>
                                              <div class="card-body">
                                                Algoritmik
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>Informatik
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                        </div>

                                         <div id="3" class="single-card"  data-kategori="Informatik" data-lende="GIS" data-lloj="leksion">
                                          <a href="#">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h5 class="card-category">Leksion</h5>
                                                <a href="#"><h4 class="card-title">Markerat, infowindow dhe lidhja me harten..</h4></a>
                                              </div>
                                              <div class="card-body">
                                                GIS
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>Informatik
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                        </div>

                                         <div id="4" class="single-card" data-kategori="Informatik" data-lende="Administrim & Siguri Sistemesh" data-lloj="Artikull">
                                            <a href="#">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h5 class="card-category">Artikull</h5>
                                                <a href="#"><h4 class="card-title">Algoritme shtese per rritje sigurie</h4></a>
                                              </div>
                                              <div class="card-body">
                                                Administrim & Siguri Sistemesh
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>Informatik
                                                </div>
                                              </div>
                                            </div>
                                            </a>
                                        </div>

                                         <div id="5" class="single-card" data-kategori="Matematike" data-lende="Algjeber" data-lloj="teze">
                                          <a href="#">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h5 class="card-category">Teze</h5>
                                                <a href="#"><h4 class="card-title">Bashkesite</h4></a>
                                              </div>
                                              <div class="card-body">
                                                Algjeber</br>
                                                <span style="float: right"><button type="">Lexo</button></span> 
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>Matematike
                                                </div>
                                              </div>
                                            </div>
                                          </a>
                                        </div>

                                         <div id="6" class="single-card" data-kategori="Matematike" data-lende="Algjeber" data-lloj="Leksion">
                                          <a href="#">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h5 class="card-category">Leksion</h5>
                                                <h4 class="card-title">Bashkesite</h4>
                                              </div>
                                              <div class="card-body">
                                                Algjeber
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>Matematike
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div-->
                                    
                                    </div><!--End cards -->


                                  </div>
                                  <div class="card-footer">
                                    <hr>
                                    <div class="stats">
                                      <i class="now-ui-icons  location_bookmark "></i>Matematik
                                    </div>
                                  </div>
                              </div>
                     </div>   
                  <div id="kategorite" class="col-md-3 col-sm-4 col-xs-4">
                      <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">Lista e kurseve që ndiqni</h5>
                            <h4 class="card-title"> Filtro<</h4>
                        </div>
                        <select>
                          <option selected=""></option>
                          <option value="Informatik">Informatik</option>
                          <option value="Matematik">Matematik</option>
                          <option value="Finance">Finance</option>
                        </select>
                        <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-hover">
                                </thead>
                                <tbody>
                                    <tr><td><a href="#"><div>Algoritmik</div></a></td></tr>
                                    <tr><td><a href="#"><div>GIS</div></a></td></tr>
                                    <tr><td><a href="#"><div>Inxhinieri Softi</div></a></td></tr>
                                    <tr><td><a href="#"><div>Administrim & Siguri Sistemesh</div></a></td></tr>
                                    <tr><td><a href="#"><div>Kontabilitet</div></a></td></tr>
                                    <tr><td><a href="#"><div>Algjeber</div></a></td></tr>
                                </tbody>
                              </table>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul>
                            <li>
                                <a href="https://www.creative-tim.com">
                                    Creative Tim
                                </a>
                            </li>
                            <li>
                                <a href="http://presentation.creative-tim.com">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="http://blog.creative-tim.com">
                                    Blog
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, Designed by
                        <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
                        <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script type="text/javascript">
        
    </script>
</body>
<!--   Core JS Files   >
<script src="assets/js/core/jquery.min.js"></script-->

<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<!-- <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script> -->
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chart JS -->
<script src="assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="assets/js/now-ui-dashboard.js?v=1.0.1"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/demo/demo.js"></script>
<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>
