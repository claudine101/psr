<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'templates/header.php';?>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include VIEWPATH.'templates/navbar.php'; ?>
    <!-- Main Sidebar Container -->
    <?php include VIEWPATH.'templates/sidebar.php'; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-8">
              <h4 class="m-0"><?=$title?></h4>
            </div><!-- /.col -->

            <div class="col-sm-4">
              <a href="<?php echo base_url() ?>administration/User_Profil/listing" class='btn btn-info float-right'>
                <i class="nav-icon fas fa-list ul"></i>
                Liste
              </a>

             <!--  <a href="<?php echo base_url() ?>administration/Admin_User" class='btn btn-success float-right'>
                <i class="nav-icon fas fa-plus ul"></i>
                Nouveau
              </a> -->
            </div>

          </div>
        </div><!-- /.container-fluid -->
      </section>




      <!-- Main content -->
      <section class="content">
        <div class="col-md-12 col-xl-12 grid-margin stretch-card">

          <div class="card">
            <div class="card-body">

              <div class="col-md-12">
               
                <?= $this->session->flashdata('message').$this->session->flashdata('message1') ?>
              </div>



              <div class="card-body">
                <div class="basic-form">
                  <form class="form-horizontal" action="<?=base_url('administration/User_Profil/add_profil');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
       
          <div class="form-row">
            <div class="form-group col-md-6">
                <label style="font-weight: 900; color:#454545">DESCRIPTION DU PROFIL</label>
                <input type="text" class="form-control" name="PROFIL_DESCR" id="PROFIL_DESCR"><?=set_value('PROFIL_DESCR')?> 
            </div>
            <div class="form-group col-md-6">
                <label style="font-weight: 900; color:#454545">CODE DU PROFIL</label>
                <input type="text" class="form-control" name="PROFIL_CODE" id="PROFIL_CODE"><?=set_value('PROFIL_CODE')?>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
                 <label for="" class="col-md-3 col-sm-6 col-xs-6 control-label">Droits des utilisateurs</label>
                  <div class="col-md-6 col-sm-4 col-xs-6">
                  <input type="checkbox" value="1" name="ADMINISTRATION"> ADMINISTRATION<br>
                  <input type="checkbox" value="1" name="DASHBOARD"> DASHBOARD<br>
                  <input type="checkbox" value="1" name="RAPPORT"> RAPPORT<br>
                  <input type="checkbox"  name="SIG" value="1"> CARTOGRAPHIE<br>
                  <input type="checkbox"  name="DONNEES" value="1"> DONNEES<br>
                  <input type="checkbox" value="1" name="IHM"> IHM<br>
                  <input type="checkbox" value="1" name="COLLABORATEUR"> COLLABORATEUR<br>
                  <input type="checkbox" value="1" name="SUIVI_EVALUATION"> SUIVI ET EVALUATION<br>
                  <input type="checkbox" value="1" name="CRA"> CRA<br>
                  <input type="checkbox" value="1" name="E_COMMERCE"> E-COMMERCE<br>
                  <input type="checkbox" value="1" name="MESSAGERIE"> MESSAGERIE<br>
                  <input type="checkbox" value="1" name="NOTIFICATIONS"> NOTIFICATIONS<br>
                  <input type="checkbox" value="1" name="PROFILS"> PROFILS<br>
                  <input type="checkbox" value="1" name="UTILISATEURS"> UTILISATEURS<br>
                  <input type="checkbox" value="1" name="BAILLEUR"> BAILLEUR<br>
                  <input type="checkbox" value="1" name="BENEFICIAIRE"> BENEFICIAIRE<br>
                  <input type="checkbox" value="1" name="INDICATEUR"> INDICATEUR<br>
                  <input type="checkbox" value="1" name="INTERVENANT"> INTERVENANT<br>
                  <input type="checkbox" value="1" name="PILIER"> PILIER<br>

              
                   <div style="color: red"><?php echo $error; ?></div>
         
                </div>
            </div>

            <div class="form-group col-md-6">
                 <!-- <label for="" class="col-md-3 col-sm-6 col-xs-6 control-label">Droits des utilisateurs</label> -->
                  <!-- <div class="col-md-6 col-sm-4 col-xs-6"> -->
                  <input type="checkbox" value="1" name="PROJET"> PROJET<br>
                  <input type="checkbox" value="1" name="RESP_UNWOMAN"> RESPONSABLE UNWOMAN<br>
                  <input type="checkbox" value="1" name="SOURCE_COLLECTE"> SOURCE DE COLLECTE<br>
                  <input type="checkbox" value="1" name="UNITE_MESURE"> UNITE DE MESURE <br>
                  <input type="checkbox" value="1" name="AFFECTATIONS"> AFFECTATIONS<br>
                  <input type="checkbox" value="1" name="ACTIVITES"> ACTIVITES<br>
                  <input type="checkbox" value="1" name="TACHES"> TACHES<br>
                  <input type="checkbox" value="1" name="ENQUETEURS"> ENQUETEURS<br>
                  <input type="checkbox" value="1" name="SIG_BENEFICIAIRES"> BENEFICIAIRES(SIG)<br>
                  <input type="checkbox" value="1" name="SIG_PERIMETRE_INTERVENTION"> PERIMETRE D'INTERVENTION<br>
                  <input type="checkbox" value="1" name="PRODUITS_DISPONIBLES"> PRODUITS DISPONIBLES<br>
                  <input type="checkbox" value="1" name="E_ARTICLE"> ARTICLE<br>
                  <input type="checkbox" value="1" name="E_CLIENT"> CLIENT<br>
                  <input type="checkbox" value="1" name="E_COMMANDE"> COMMANDE<br>
                  <input type="checkbox" value="1" name="TDB_BENEFICIAIRES"> BENEFICIAIRE<br>
                  <input type="checkbox" value="1" name="TDB_PROJETS"> PROJET(TDB)<br>
                  <input type="checkbox" value="1" name="TDB_ACTIVITES"> ACTIVITES<br>
                  <input type="checkbox" value="1" name="RA_EVOLUTION_JOURNALIERE"> EVOLUTION JOURNALIERE(RAPPORT)<br>
                  <input type="checkbox" value="1" name="EMAIL"> EMAIL<br>
                  <input type="checkbox" value="1" name="COMPTABILITE"> COMPTABILITE<br>
                  <input type="checkbox" value="1" name="ARCHIVAGE"> ARCHIVAGE<br>
              
                   <div style="color: red"><?php echo $error; ?></div>
         
                <!-- </div> -->
            </div>
          </div>
        
                    <div class="form-group">   
                   <label class="col-md-12 col-sm-12 col-xs-12 control-label"></label>
            <div class="col-md-6 col-sm-12 col-xs-12 col-md-push-3">
            <input type="submit" class="btn btn-primary btn-block" value="VALIDER"/>
             </div>
             </div>
                  </form>
               
                </div>
              </div>

              

            <!--  VOS CODE ICI  -->



          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</body>

<?php include VIEWPATH.'templates/footer.php'; ?>


<script type="text/javascript">
   $('#message').delay('slow').fadeOut(3000);
  // $('#message').delay('slow').fadeOut(2000);
</script>


