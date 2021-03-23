<?php ob_start(); session_start(); if(!isset($_SESSION['admin'])) header("location:index.php");

require_once '../inc/functions.php';
$db = db_connect();

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
         <?php $activePage = 'home' ?>
         <?php include 'menu.php'; ?>
         
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Liste des devis&nbsp;&nbsp;&nbsp;&nbsp; 
          </h1>
          <ol class="breadcrumb">
            <li><a href="./"><i class="fa fa-dashboard"></i> accueil</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header"></div>
                  
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover list-inscription">
                    <tr>
                      <th>Date de la demande</th>
                      <th>Nom & Prénom</th>
                      <th>Société</th>
                      <th>Téléphone</th>
                      <th>E-mail</th> 
                      <th>Débus de préstation</th> 
                      <th>Fin de préstation</th> 
                      <th>Document téléchargés</th> 
                      <th>Voir le devis</th> 
                      <th>supprimer</th>   
                    </tr>
                    <?php 
                       
                        $queryDevis = $db->query("SELECT * FROM devis where deleted = 0 order by idDevis desc"); 
                        $result = $queryDevis->fetchAll(PDO::FETCH_ASSOC);     
                    ?>
                    <?php foreach ($result as $key => $devis):

                            $query = $db->query("SELECT * FROM `uploads` WHERE `idDevis`=".$devis['idDevis']); 
                            $files = $query->fetchAll(PDO::FETCH_ASSOC);  

                            ?> 
                            <tr> 
                              <td><?= date('d-m-Y', $devis['dateDevis']) ?></td> 
                              <td><?= $devis['fname'] ?> <?= $devis['lname'] ?></td>
                              <td><?= $devis['societe'] ?></td> 
                              <td><?= $devis['tel'] ?></td>
                              <td><?= $devis['email'] ?></td> 
                              <td><?= date('d-m-Y', $devis['dateDebut']) ?></td>   
                              <td><?= date('d-m-Y', $devis['dateFin']) ?></td>   
                              <td> 
                                <?php if( count($files) > 0 ): ?>
                                  <a href="#" class="docsUploaded" data-files='<?= json_encode($files); ?>'>
                                    <img src="dist/img/docs.png">
                                  </a>
                                <?php else: ?>
                                  Pas de documents
                                <?php endif; ?>
                              </td> 
                              <td>
                                <a href="devis.php?id=<?= $devis['idDevis'] ?>" target="_blank">
                                  <img src="dist/img/pdf.png">
                                </a>
                              </td> 
                             <td>
                                <a class="btn-remove" data-id="<?= $devis['idDevis'] ?>">
                                  <img src="dist/img/delete.png">
                                </a>
                              </td>
                            </tr>
                    <?php endforeach; ?>
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
    


    <div class="example-modal">
      <div class="modal modal-light" id="files">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Documents téléchargés</h4>
            </div>
             
            <div class="modal-body">
                  <div style="display: none;" class="blockModel">
                     <div class="row form-group">
                        <div class="col-xs-9">__REALNAME__</div>
                        <div class="col-xs-3">
                          <a class="btn btn-success btn-block" href="__URL__" target="_blanc">
                            Télécharger<br>
                            <i class="fa fa-download"></i>
                          </a>
                        </div>
                     </div>
                  </div>

                  <div class="apendedBlocks">
                    
                  </div>
            </div> 
             
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script> 
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script> 
    <script type="text/javascript"> 
       $( ".btn-remove" ).click(function() {
        var self = $(this);

        if( confirm( "Vouler vous vraiment supprimer ce devis ?" ) ){
            var dataId = $(this).attr('data-id');
            $.ajax({
                  method: "POST",
                  url: "remove-devis.php",
                  data: { id: dataId }
            })
            .done(function( data ) {
              self.parents('tr').fadeOut();
              setTimeout(function(){
                 self.parents('tr').remove()
              },1000)
            })
        }  
       });

       $('.docsUploaded').click(function(){
          var data = JSON.parse( $(this).attr('data-files') )
          $('#files .apendedBlocks').html('')
          $.each(data, function(index, file){
            var model = $('#files .blockModel').html();
            model = model.replace('__REALNAME__', file.realName);
            model = model.replace('__URL__', 'uploads/'+file.fileName);
            $('#files .apendedBlocks').append(model); 
          })

          $('#files').modal('show');

       })


























        
    </script>
  </body>
</html>
