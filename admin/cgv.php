<?php session_start(); if(!isset($_SESSION['admin'])) header("location:index.php");

require_once '../inc/functions.php';
$db = db_connect();

if(isset($_POST['content'],$_POST['id'])){
  extract($_POST);
  $query = $db->prepare("UPDATE `contents` SET `content` = ?  WHERE id = $id");
  $query->execute( array($content) );
}

?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel='shortcut icon' href="../images/logo.png" type="image/x-icon" />
    <title>Admin - Jamulateur</title>
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
      @media (max-width: 990px) { 
      div .no-padding-990 {
          padding: 0 !important;
      }

      }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="./home.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>J</b>AM</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>JAMULATEUR</b></span>
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
         
          <!-- search form -->
      
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
         <?php $activePage = 'cgv' ?>
         <?php include 'menu.php'; ?>
         
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            CONDITIONS GENERALES DE VENTES
          </h1>
          <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> accueil</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content"> 
          <div class="row"> 

          <?php  
            $query = $db->query("SELECT * FROM contents where slug = 'conditions_generales' ");
            $result = $query->fetchAll(PDO::FETCH_ASSOC)[0];
          ?> 
          <div class="col-sm-12">
              <div class="box"> 
                <div class="box-body table-responsive ">
                   <form method="post" action="" class="form-horizontal  col-sm-12"">
                      <div class="form-group"> 
                        <div class="col-sm-12">
                          <textarea class="form-control" name="content"><?= $result['content'] ?></textarea>
                        </div> 
                      </div> 
                      
                      <div class="form-group">
                        <label class="col-sm-9"></label>
                        <div class="col-sm-3">
                          <input type="hidden" name="id" value="<?= $result['id'] ?>">
                          <button class="btn btn-block btn-warning">Mise à jour</button>
                        </div>
                      </div>
                  </form>
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
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: 'textarea',
        height: '100%',
        theme: 'modern',
        plugins: 'print preview table lists textcolor colorpicker ',
        menubar:false,
        fontsize_formats: '8pt 10pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 20pt 22pt 24pt 36pt',
        toolbar1: 'formatselect fontsizeselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist  |  preview',
        theme_advanced_fonts:"Arial=arial",
        templates: [
          { title: 'Test template 1', content: 'Test 1' },
          { title: 'Test template 2', content: 'Test 2' }
        ]
       });

    </script>
  </body>
</html>
