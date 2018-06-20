<!DOCTYPE html>
<html>
<?php
include('../utilities/connect.php');
if(isset($_POST['ajax']))
{
    if(isset($_POST['Id']))
    {
        $el=$_POST['Id'];
        $query="";
        $tipArtikull="";
        //shikojme se cilen buton ka klikuar perdoruesi
        switch($el) 
        {
            case 'leksione':
                $query="SELECT l.Id,l.Titull,l.Permbajtje,lnd.Emer as lenda,c.Emri as Kategoria,l.insertdate as InsertDate FROM `leksion` as l ";
                    $query.="inner join lenda as lnd on l.Id_lende=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id Where l.Statusi=1 ";
                    $query.="And lnd.Id IN(Select IdLende From subscribed where username=:username) Order By l.InsertDate Desc";
                $tipArtikull='leksion';
                break;
            case 'teze':
                $query="SELECT t.Id,t.Pershkrimi,t.Viti,lnd.Emer As lenda,c.Emri as Kategoria,t.insertdate as InsertDate FROM `teza` as t inner join lenda as lnd on t.Id_lenda=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id WHERE lnd.Id IN(Select IdLende From subscribed where username=:username) ORDER By t.insertdate desc";
                $tipArtikull='teze';
                break;
            default:
                $query="select * FROM ";
                $query.="((SELECT l.Id,l.Titull,l.Permbajtje,lnd.Emer as lenda,c.Emri as Kategoria,l.insertdate as InsertDate ";
                $query.="FROM `leksion` as l inner join lenda as lnd on l.Id_lende=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id ";
                $query.="Where l.Statusi=1 And lnd.Id IN(Select IdLende From subscribed where username=:username)ORDER by l.INSERTDate desc) ";
                $query.="UNION ";
                $query.="(SELECT t.Id,t.Pershkrimi,t.Viti,lnd.Emer As lenda,c.Emri as Kategoria,t.insertdate as InsertDate FROM `teza` as t ";
                $query.="inner join lenda as lnd on t.Id_lenda=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id WHERE ";
                $query.="lnd.Id IN(Select IdLende From subscribed where username=:username))) as tmp ORDER by INSERTDate desc ";
            
        }
            $username='test';//do zevendesohet me userin qe do ruhet ne session apo cookie

            if($tipArtikull == "leksion" || $tipArtikull== "teze")
            {
                //preparing the statement
                $sql=$conn->prepare($query);
                $sql->bindparam(':username',$username); 
                $sql->execute();

                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
                //print_r($result);
                if (is_array($result) || is_object($result))
                {
                    foreach($result as $value)
                    {
                        if($tipArtikull=='teze')
                        {
                            /*$div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                            $div.='<a href=\".\">';
                            $div.='<div class=\"card\">';
                            $div.='<div class=\"card-header\">';
                            $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Pershkrimi'].'</h4></a></div>';
                            $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                            $div.='<div class="card-footer">';
                            $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                            $div.='</div></div></div></a></div>';*/
                              $pershkrimi = '';
                        if(strlen($value['Pershkrimi']) > 40 ){
                            $pershkrimi= substr($value['Pershkrimi'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Pershkrimi'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=teze">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">Teze</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
                        }
                        else
                        {
                           /* $div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                            $div.='<a href=\"#\">';
                            $div.='<div class=\"card\">';
                            $div.='<div class=\"card-header\">';
                            $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Permbajtje'].'</h4></a></div>';
                            $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                            $div.='<div class="card-footer">';
                            $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                            $div.='</div></div></div></a></div>';*/
                             $pershkrimi = '';
                        if(strlen($value['Permbajtje']) > 40 ){
                            $pershkrimi= substr($value['Permbajtje'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Permbajtje'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=leksione">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">'.$tipArtikull.'</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>';
                        }
                        

                        echo($div);
                        //print_r($value);
                        
                    }
                }
            }
            else
            {
                //preparing the statement
                $sql=$conn->prepare($query);
                $sql->bindparam(':username',$username); 
                $sql->execute();

                $result = $sql->fetchAll(PDO::FETCH_ASSOC);

                foreach($result As $value)
                {
                    if(is_numeric($value['Permbajtje']))//esht teze
                    {
                        /*$div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                            $div.='<a href=\"#\">';
                            $div.='<div class=\"card\">';
                            $div.='<div class=\"card-header\">';
                            $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Titull'].'</h4></a></div>';
                            $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                            $div.='<div class="card-footer">';
                            $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                            $div.='</div></div></div></a></div>';*/
                             $pershkrimi = '';
                        if(strlen($value['Titull']) > 40 ){
                            $pershkrimi= substr($value['Titull'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Titull'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=teze">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">Teze</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
                    }
                    else
                    {
                       /* $div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                            $div.='<a href=\"#\">';
                            $div.='<div class=\"card\">';
                            $div.='<div class=\"card-header\">';
                            $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Permbajtje'].'</h4></a></div>';
                            $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                            $div.='<div class="card-footer">';
                            $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                            $div.='</div></div></div></a></div>';*/
                            $pershkrimi = '';
                        if(strlen($value['Titull']) > 40 ){
                            $pershkrimi= substr($value['Titull'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Titull'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=leksione">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">Leksion</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
                    }
                    echo ($div);
                }

            }


    }
    else
    {
        $query="select * FROM ";
                $query.="((SELECT l.Id,l.Titull,l.Permbajtje,lnd.Emer as lenda,c.Emri as Kategoria,l.insertdate as InsertDate ";
                $query.="FROM `leksion` as l inner join lenda as lnd on l.Id_lende=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id ";
                $query.="Where l.Statusi=1 And lnd.Id IN(Select IdLende From subscribed where username=:username)ORDER by l.INSERTDate desc) ";
                $query.="UNION ";
                $query.="(SELECT t.Id,t.Pershkrimi,t.Viti,lnd.Emer As lenda,c.Emri as Kategoria,t.insertdate as InsertDate FROM `teza` as t ";
                $query.="inner join lenda as lnd on t.Id_lenda=lnd.Id INNER JOIN category as c on lnd.Id_Categ=c.Id WHERE ";
                $query.="lnd.Id IN(Select IdLende From subscribed where username=:username))) as tmp ORDER by INSERTDate desc ";

        $username='test';//do zevendesohet me userin qe do ruhet ne session apo cookie

        $sql=$conn->prepare($query);
        $sql->bindparam(':username',$username); 
        $sql->execute();

        $result = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($result As $value)
        {
            if(is_numeric($value['Permbajtje']))//esht teze
            {
                $tipArtikull='teze';
                /*$div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                    $div.='<a href=\"#\">';
                    $div.='<div class=\"card\">';
                    $div.='<div class=\"card-header\">';
                    $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Titull'].'</h4></a></div>';
                    $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                    $div.='<div class="card-footer">';
                    $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                    $div.='</div></div></div></a></div>';*/
                    $pershkrimi = '';
                        if(strlen($value['Titull']) > 40 ){
                            $pershkrimi= substr($value['Titull'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Titull'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=teze">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">Teze</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
            }
            else
            {
                $tipArtikull='leksion';
                /*$div='<div id='.$value['Id'].' data-kategori='.$value['Kategoria'].' data-lende='.$value['lenda'].' data-lloj='.$tipArtikull.'>';
                    $div.='<a href=\"#\">';
                    $div.='<div class=\"card\">';
                    $div.='<div class=\"card-header\">';
                    $div.='<a href=\"#\"><h4 class=\"card-title\">'.$value['Permbajtje'].'</h4></a></div>';
                    $div.='<div class=\"card-body\">'.$value['lenda'].'</div>';
                    $div.='<div class="card-footer">';
                    $div.='<hr><div class=\"stats\"><i class=\"now-ui-icons location_bookmark\"></i>'.$value['Kategoria'];
                    $div.='</div></div></div></a></div>';*/
                    $pershkrimi = '';
                        if(strlen($value['Titull']) > 40 ){
                            $pershkrimi= substr($value['Titull'], 0, 40).'...';
                        }
                        else{
                            $pershkrimi = $value['Titull'];
                        }

                            $div='<div id="'.$value['Id'].'" class="single-card" data-kategori="'.$value['Kategoria'].'" data-lende="'.$value['lenda'].'" data-lloj="'.$tipArtikull.'">
                                          <a href="artikull.php?id='.$value['Id'].'&tipi=leksione">
                                            <div class="card ">
                                              <div class="card-header">
                                                <h6 class="card-category">'.$tipArtikull.'</h6>
                                                <h5 class="card-title">'.$pershkrimi.'</h5>
                                              </div>
                                              <div class="card-body">
                                                '.$value['lenda'].'
                                              </div>
                                              <div class="card-footer">
                                                <hr>
                                                <div class="stats">
                                                  <i class="now-ui-icons  location_bookmark "></i>'.$value['Kategoria'].'
                                                </div>
                                              </div>
                                            </div>
                                        </a>
                                      </div>';
            }
            echo ($div);
        }
    }
    $conn=null;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- CSS Just for demo purpose, don't include it in your project >
    <link href="assets/demo/demo.css" rel="stylesheet" /-->
<script>
   
   //merr id e  buttonit te klikuar
   $(document).ready(function() {
    $.ajax(
         {
             type:'POST',
             url:'index.php', 
             data:{ajax:1},
             success: function(data){
                 //$("#SecondContainer").reset();
                 $("#SecondContainer").html(data);
                 //alert((data));       
         }});
    
    $("#all,#leksione,#teze").click(function(event) {
        Id=event.target.id;
        //kerkesa per te marre content nga db
        $.ajax(
        {
            type:'POST',
            url:'index.php',
            data:{Id:Id,ajax:1}, 
            success: function(data){
                $("#SecondContainer").html(data);
        }});
    });
    
});
</script>
</head>

<body class="">
    <?php
    /**************************************
    *M E N A X H I M I  N A V I G I M I T
    *************************************/
        $Headeri="Dashboard";
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
                                  <div class="card-header text-center">
                                    
                                    <button class="btn btn-xs btn-info" onclick="window.location.href='kategorite.php'" >Eksploro</button>
                                    <h4 class="card-title">Postimet e Fundit</h4>
                                   <div id="FirstContainer">
                                        <button id="all" type="button" class="btn btn-default btn-sm" name="all">All</button>
                                        <button id="leksione" type="button" class="btn btn-default btn-sm" name="leksione">Leksione</button>
                                        <button id="teze" type="button" class="btn btn-default btn-sm" name="teze">Teza</button>
                                    </div>
                                  </div>
                                  <div  class="card-body">

                                    <div id="SecondContainer" class="card-columns">
                                        

                                    </div><!--End cards -->


                                  </div>
                                  <div class="card-footer">
                                    <hr>
                                    <div class="stats">
                                      <i class="now-ui-icons  location_bookmark "></i>
                                    </div>
                                  </div>
                              </div>
                     </div>   
                  <div id="kategorite" class="col-md-3 col-sm-4 col-xs-4">
                      <div class="card">
                        <div class="card-header">
                            <h5 class="card-category">Lista e kurseve që ndiqni</h5>
                            <!--h4 class="card-title"> Filtro<</h4>
                        </div>
                        <select>
                          <option selected=""></option>
                          <option value="Informatik">Informatik</option>
                          <option value="Matematik">Matematik</option>
                          <option value="Finance">Finance</option>
                        </select-->
                        <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-hover">
                                </thead>
                                <tbody>
                        <?php
                        /***************************************************
                        *G J E N E R I M   D I N A M I K  I   L E N D E V E 
                        ***************************************************/

                        $query_lendet = "SELECT IdLende,Emer FROM bitlab.subscribed INNER JOIN bitlab.lenda on bitlab.subscribed.idLende = bitlab.lenda.Id WHERE username = 'test'";

                        $username='test';//do zevendesohet me userin qe do ruhet ne session apo cookie

                        $sql1=$conn->prepare($query_lendet);
                        $sql1->bindparam(':username',$username); 
                        $sql1->execute();

                        $result = $sql1->fetchAll(PDO::FETCH_ASSOC);

                        foreach($result As $value)
                        {
                             echo "<tr><td><a href=\"lende.php?id=".$value["IdLende"]."\"><div>".$value["Emer"]."</div></a></td></tr>";
                        }
                        ?>
    
                                </tbody>
                              </table>
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            <?php 
            /******
            *FOOTER
            ******/
            include('footer.php');

            ?>