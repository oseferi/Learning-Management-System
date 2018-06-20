<!DOCTYPE html>
<?php
include('../utilities/connect.php');
if(isset($_POST['ajax']))
{
    $query="Select * From Category";
    $sql=$conn->prepare($query);
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($result as $category) // zgjedh kategorite dhe percdo kategori do zgjedhe lendet qe bejne pjese
    {
      
        $queryCourses="Select Id,Emer From Lenda Where Id_Categ=?";
        $sqlCourses=$conn->prepare($queryCourses);
        $sqlCourses->bindparam(1,$category['Id'],PDO::PARAM_INT);
        $sqlCourses->execute();

        $resultCourses = $sqlCourses->fetchAll(PDO::FETCH_ASSOC);
        
        if($sqlCourses->rowCount()>0){
             //echo "<div class=\"row row-eq-height\">";
        $span="<span id=".$category['Id']."><h4 class=\"title\">".$category['Emri']."</h4></span>";
        echo $span."<br><br>";
            echo "<div class=\"row  row-eq-height cards\">";
        foreach($resultCourses as $course)//i vendos lendet ne div
        {
            
                 /* $div='<a href="#">
                                            <div class="card col-md-3" style="max-width: 20%;height:100px;">
                                              <div class="card-body">
                                                
                                                <h6 class="card-title">'.$course['Emer'].'</h6>
                                              </div>
                                            </div>
                                        </a>';
                                            */
                    $div='<div id="'.$course['Id'].'" class=" card col-md-3" >
                                          <a href="lende.php?id='.$course['Id'].'">
                                            
                                              <div class="card-header" >
                                                <h6 class="card-category">#'.$course['Id'].'</h6>
                                                <h5 class="card-title">'.$course['Emer'].'</h5>
                                            
                                           
                                            </div>
                                        </a>
                                      </div>';
           
            echo $div;
        }

        echo "</div>";
        //echo "<br><br>";
        }
    }


    exit;
}
?>
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

    <script>
     $( document ).ready(function() {
             $.ajax(
            {
                 type:'POST',
                //url:'kategorite.php',
                 data:{ajax:1}, 
                 success: function(response){
                     $("#SecondContainer").html(response);

             }});
             });
    </script>
</head>

<body class="">
        <?php
    /**************************************
    *M E N A X H I M I  N A V I G I M I T
    *************************************/
        $Headeri="Të gjitha kategoritë";
        include("navi.php");
     ?>
            <!-- End Navbar -->
            <div class="panel-header panel-header-sm">
                <!-- <canvas id="bigDashboardChart"></canvas> -->
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 ">
                               <div class="card">
                                    <div class="card-header">
                                       <button class="btn btn-xs btn-info" onclick="goBack()">Ktheu Mbrapa</button>
                                 
                                        <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                        </script> 
                                    </div>
                                    <div  class="card-body text-center" >

                                             
                                              <div id="SecondContainer" class="module-section clearfix">
                                                <!-- <button class="btn arrow-guides fa-chevron-left"></button> -->
                                           
                                          
                                              </div><!--end of module-section-->
                                              
                                            
                                            <!-- <button class="btn arrow-guides-right fa-chevron-right"></button> -->
              

                                    </div>
                                    <!--div class="card-footer">
                                        <hr>
                                        <div class="stats">
                                          <i class="now-ui-icons  location_bookmark "></i>Matematik
                                        </div>
                                    </div-->
                                </div>
                         </div>
                     </div>   
                </div>
            </div>
            
            <?php 
                include 'footer.php';
            ?>