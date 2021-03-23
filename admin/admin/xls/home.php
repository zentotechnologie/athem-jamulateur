<?php session_start();
  if(!isset($_SESSION['admin'])) header("location:index.php");

require_once '../configdb.php';


 ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Adrministration Damart</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .btn-remove img{
          height: 22px;
          margin-left: 24px;
          cursor: pointer;
      }
      .fa.fa-thumbs-o-up,
      .fa.fa-thumbs-o-down{
          margin-top: 22px;
      }
      .nbr-participants .small-box .icon{
        margin-top: 11px;
      }
      .nbr-participants p{
        margin: 0;
      }
      .nbr-participants .small-box h3 {
          font-size: 38px;
          font-weight: bold;
          margin: 0 0 7px 0;
          white-space: nowrap;
          padding: 0;
      }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
           
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="logout.php" class=""> 
                  <span class="hidden-xs">Déconnexion</span>
                </a>
                 
              </li>
              <!-- Control Sidebar Toggle Button --> 
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user8-128x128.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Damart</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
      
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
         <?php include 'menu.php'; ?>
         
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Liste des Participants
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> accueil</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                <?php 
                    $accepte_nwl = $db->prepare("SELECT count(nwl) as nwl FROM fleursusers where nwl = 1");
                    $accepte_nwl->execute();
                    $row1 = $accepte_nwl->fetch();
                    $nwlOui = $row1['nwl'];

                    $refuse_nwl = $db->prepare("SELECT count(nwl) as nwl FROM fleursusers where nwl = 0");
                    $refuse_nwl->execute();
                    $row2 = $refuse_nwl->fetch();
                    $nwlNon = $row2['nwl'];
                 ?> 
                  <div class="col-md-4  col-xs-12 nbr-participants"> 
                   <div class="small-box bg-yellow">
                      <div class="inner">
                        <h3><?= $nwlOui + $nwlNon ?></h3>
                        <p>Participants</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-person-add"></i>
                      </div> 
                    </div>
                  </div>

                  <div class="col-md-4  col-xs-12">
                    <div class="info-box bg-green">
                      <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Newsletter Oui</span>
                        <span class="info-box-number"><?= $nwlOui ?></span>
                        <div class="progress">
                          <div class="progress-bar" style="width: <?= ($nwlOui * 100)/($nwlOui + $nwlNon) ?>%"></div>
                        </div>
                        <span class="progress-description">
                          <?= number_format(($nwlOui * 100)/($nwlOui + $nwlNon),0) ?>%
                        </span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <div class="info-box bg-red">
                      <span class="info-box-icon"><i class="fa fa-thumbs-o-down"></i></span>
                      <div class="info-box-content">
                        <span class="info-box-text">Newsletter Non</span>
                        <span class="info-box-number"><?= $nwlNon ?></span>
                        <div class="progress">
                          <div class="progress-bar" style="width: <?= ($nwlNon * 100)/($nwlOui + $nwlNon) ?>%"></div>
                        </div>
                        <span class="progress-description">
                            <?= number_format(($nwlNon * 100)/($nwlOui + $nwlNon),0) ?>%
                        </span>
                      </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                  </div>

                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover list-inscription">
                    <tr>
                      <th>Date & Heure</th>
                      <th>Civilité</th>
                      <th>nom</th>
                      <th>prenom</th> 
                      <th>Téléphone</th> 
                      <th>email</th> 
                      <th>Newsletter</th> 
                      <th>supprimer</th> 
                    </tr>
                    <?php 
                        $users = $db->prepare("SELECT * FROM fleursusers order by id desc");
                        $users->execute();
                        while ($row = $users->fetch()):
                           
                     ?>

                    <tr> 
                      <td><?=  $row['timestamp'] ? date('d-m-Y',$row['timestamp']) : '' ?><?=  $row['timestamp'] ? ' à '.date('H:i',$row['timestamp']) : '' ?></td>
                      <td><?= $row['civilite'] ?></td> 
                      <td><?= $row['nom'] ?></td>
                      <td><?= $row['prenom'] ?></td> 
                      <td><?= $row['tel'] ?></td>
                      <td><?= $row['email'] ?></td>
                       <td><?= $row['nwl'] ? 'Oui' : 'Non' ?></td> 
                     <td><a class="btn-remove" data-id="<?= $row['id'] ?>"><img src="dist/img/delete.png"></a></td>
                    </tr>
                          <?php endwhile; ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      

      <!-- Control Sidebar -->
     
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
<script type="text/javascript"> 
   $( ".btn-remove" ).click(function() {
    var self = $(this);
     var dataId = $(this).attr('data-id');
     $.ajax({
              method: "POST",
              url: "remove-user.php",
              data: { id: dataId }
        })
        .done(function( data ) {
          self.parents('tr').fadeOut();
          setTimeout(function(){
             self.parents('tr').remove()
          },1000)
        })
        
   });
</script>
  </body>
</html>
