<?php session_start();
  if(!isset($_SESSION['admin'])) header("location:index.php"); 
  require_once '../configdb.php';



 ?>
<html>
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
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
        .colorcode{
          position: relative;
        }
        .colorcode span{
          content: '';
          position: absolute;
          width: 70px;
          height: 32px;
          right: 1px;
          top: 1px; 
          border:1px solid #000;
        }
        .colorcode input{
          text-transform: uppercase;
        }
        .paddleftright{
          padding-left: 0;
          padding-right: 0;
        }
        .center{
          text-align: center;
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
            Gestion d'Emailing d'inscription
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> accueil</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php  
            $emailing = $db->prepare("SELECT * FROM fleurscontent where page='emailing' ");
            $emailing->execute(); 
            $content = $emailing->fetch(); 

            
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="box box-warning  box-solid">
                <div class="box-header"> 
                Administration de contenu
                </div><!-- /.box-header -->
                <div class="box-body table-responsive paddleftright"> 
                  <form action="manage-emailing.php" method="post" enctype="multipart/form-data">
                  <div class="col-md-12">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">Objet de l'Email</h3>
                          <div class="box-tools pull-right"> 
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <input class="form-control" name="objet" value="<?= $content['champ1'] ?>">
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                    <div class="col-md-12">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">Image 1</h3>
                          <div class="box-tools pull-right"> 
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                         <input name="image1" type="file">  
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div> 
                    <div class="col-md-12">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">Texte 1</h3>
                          <div class="box-tools pull-right"> 
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                         <textarea rows="8" name="texte1"  class="form-control" ><?= $content['champ3'] ?></textarea>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                    <div class="col-md-12">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">Image 2</h3>
                          <div class="box-tools pull-right"> 
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                         <input name="image2" type="file">  
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                    <div class="col-md-12">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">CTA</h3>
                          <div class="box-tools pull-right"> 
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <label class="label-control">Texte</label>
                          <input class="form-control" name="textecta" placeholder="Texte de CTA" value="<?= $content['champ8'] ?>">
                          <br>
                          <label class="label-control">Couleur de texte</label>
                          <p class="colorcode">
                            <input class="form-control colorcode" maxlength="7" name="textcolor" placeholder="#ffffff" value="<?= $content['champ9'] ?>">
                            <span></span>
                          </p>
                          <br>
                          <label class="label-control">Couleur d'arrière plan</label>
                          <p class="colorcode">
                            <input class="form-control colorcode" maxlength="7" name="bgcolor" placeholder="#000000" value="<?= $content['champ5'] ?>">
                            <span></span>
                          </p>
                          <br>
                          <label class="label-control">Lien du CTA</label>
                          <input class="form-control" name="url" placeholder="http://damart.fr" value="<?= $content['champ6'] ?>">
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div>
                    <div class="col-md-12">
                      <div class="box box-success">
                        <div class="box-header with-border">
                          <h3 class="box-title">Mentions légales</h3>
                          <div class="box-tools pull-right"> 
                          </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                         <textarea rows="8" name="texte2"  class="form-control" ><?= $content['champ7'] ?></textarea>
                        </div><!-- /.box-body -->
                      </div><!-- /.box -->
                    </div> 
                    <div class="col-md-12">
                       <button  type="submit"   class="btn btn-warning">Enregister les modifications</button>
                    </div>
                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <div class="col-md-6">
              <div class="box">
                <div class="box-header center"> 
                Aperçu de l'Emailing
                </div><!-- /.box-header -->
                <?php $content = nltobr_($content); ?>
                <div class="box-body table-responsive no-padding">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:0px;">
                      <tr>
                        <td align="center"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="center"><img border="0" style="display:block" src="../email/images/logo_damart.jpg" width="177" height="103" alt="" /></td>
                          </tr>
                          <tr>
                            <td><img border="0" style="display:block" src="../email/images/<?= $content['champ2'] ?>" width="100%" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="25">&nbsp;</td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="32">&nbsp;</td>
                                <td align="center"><strong><font face="Arial, Helvetica, sans-serif" size="3" style="font-size:16px;" color="#4a4a44">Bonjour PersoNom PersoPr&eacute;nom,</font></strong></td>
                                <td width="32">&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="center" height="15" style="line-height:0px;font-size:0px;"></td>
                                <td align="center" height="15" style="line-height:0px;font-size:0px;"></td>
                                <td align="center" height="15" style="line-height:0px;font-size:0px;"></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td align="center"><font face="Arial, Helvetica, sans-serif" size="3" style="font-size:14px;" color="#4a4a44"><?= $content['champ3'] ?></font></td>
                                <td>&nbsp;</td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="22">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center"><img border="0" style="display:block" src="../email/images/<?= $content['champ4'] ?>" width="513" alt="" /></td>
                          </tr>
                          <tr>
                            <td height="32">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" style="background: <?= $content['champ5'] ?>" bgcolor="<?= $content['champ5'] ?>" align="center">
                              <tr>
                                <td width="15"></td>
                                <td height="50" align="center" valign="middle"><strong><a href="<?= $content['champ6'] ?>" target="_blank" style="text-decoration:none"><font face="Arial, Helvetica, sans-serif" size="3" style="font-size:16px;" color="<?= $content['champ9'] ?>"><?= $content['champ8'] ?></font></a></strong></td>
                                <td width="15"></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="51">&nbsp;</td>
                          </tr>
                          <tr>
                            <td><img border="0" style="display:block" src="../email/images/1-template-email-jeu_14.jpg" width="100%" alt="" /></td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td width="32">&nbsp;</td>
                                <td align="center"><font face="Arial, Helvetica, sans-serif" size="3" style="font-size:11px;" color="#4a4a44"><?= $content['champ7'] ?> </font></td>
                                <td width="32">&nbsp;</td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td height="30">&nbsp;</td>
                          </tr>
                        
                        </table></td>
                      </tr>
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
     $('p.colorcode').each(function () {
        $(this).find('span').css('background',$(this).find('input').val());
     })

     $('input.colorcode').keyup(function () {
       $(this).parent().find('span').css('background',$(this).val());
     })
     $('input.colorcode').blur(function () {
       $(this).parent().find('span').css('background',$(this).val());
     })
</script>
  </body>
</html>
