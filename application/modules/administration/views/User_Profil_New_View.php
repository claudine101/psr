
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include VIEWPATH.'includes/header.php'; ?>
</head>
<body>
  <!--******************* Preloader start ********************-->
  <?php include VIEWPATH.'includes/loadpage.php'; ?>  
  <!--******************* Preloader end ********************-->
  <!--********************************** Main wrapper start ***********************************-->
  <div id="main-wrapper">
    <!--********************************** Nav header start ***********************************-->
    <?php include VIEWPATH.'includes/navybar.php'; ?> 
    <!--********************************** Header end ti-comment-alt ***********************************-->
    <!--********************************** Sidebar start ***********************************-->
    <?php include VIEWPATH.'includes/menu.php'; ?> 
    <!--********************************** Sidebar end ***********************************-->
    <!--********************************** Content body start ***********************************-->
    <div class="content-body">
      <div class="container-fluid">
        <div class="row page-titles mx-0">
          <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
              <h4 style='color:#007bac'>Ajout des droits et profils</h4>
            </div>
          </div>
          <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <button class="btn btn-primary"><a style="color: white;" href="<?php echo base_url() ?>administration/User_Profil_New/listing"><span class="fa fa-list"></span> Liste</a></button>
          </div>
        </div>
        <!-- row -->
        <div class="row">
          <div class="col-xl-12 col-xxl-12">
            <div class="card">
              <div class="card-body">
                <div class="basic-form">
                  <form class="form-horizontal" action="<?=base_url('administration/User_Profil_New/add_profil');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">DESCRIPTION DU PROFIL</label>
                        <input type="text" class="form-control" name="PROFIL_DESCR" id="PROFIL_DESCR" value="<?=set_value('PROFIL_DESCR')?>"> 
                        <font color="red"><?php echo form_error('PROFIL_DESCR'); ?></font>
                      </div>
                      <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">CODE DU PROFIL</label>
                        <input type="text" class="form-control" name="PROFIL_CODE" id="PROFIL_CODE" value="<?=set_value('PROFIL_CODE')?>">
                        <font color="red"><?php echo form_error('PROFIL_CODE'); ?></font>
                      </div>
                    </div>
                    <div class="form-row">
                      <h4 for="" class="col-md-3 col-sm-6 col-xs-6 control-label">Droits des utilisateurs</h4>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <div class="col-md-6 col-sm-4 col-xs-6">
                          <input type="checkbox" value="1" name="TACHES"> <span style="margin-left:5px;"></span> TACHES<br>
                          <input type="checkbox" value="1" name="PILIER"> <span style="margin-left:5px;"></span> PILIER<br>
                          <input type="checkbox" value="1" name="PROJET"> <span style="margin-left:5px;"></span> PROJET<br>
                          <input type="checkbox" value="1" name="PROFILS"> <span style="margin-left:5px;"></span> PROFILS<br>
                          <input type="checkbox" value="1" name="INCIDENT"> <span style="margin-left:5px;"></span> INCIDENT<br>
                          <input type="checkbox" value="1" name="ACTIVITES"> <span style="margin-left:5px;"></span> ACTIVITES<br>
                          <input type="checkbox" value="1" name="ENQUETEURS"> <span style="margin-left:5px;"></span> ENQUETEURS<br>
                          <input type="checkbox" value="1" name="LOGISTIQUE"> <span style="margin-left:5px;"></span> LOGISTIQUE<br>
                          <input type="checkbox" value="1" name="INTERVENANT"> <span style="margin-left:5px;"></span> INTERVENANT<br>
                          <input type="checkbox" value="1" name="AFFECTATIONS"> <span style="margin-left:5px;"></span> AFFECTATIONS<br>
                          <input type="checkbox" value="1" name="BENEFICIAIRE"> <span style="margin-left:5px;"></span> BENEFICIAIRE<br>
                          <input type="checkbox" value="1" name="UTILISATEURS"> <span style="margin-left:5px;"></span> UTILISATEURS<br>
                          <input type="checkbox" value="1" name="COLLABORATEUR"> <span style="margin-left:5px;"></span> COLLABORATEUR<br>
                          <input type="checkbox" value="1" name="UNITE_MESURE"> <span style="margin-left:5px;"></span> UNITE DE MESURE<br>
                          <input type="checkbox" value="1" name="SOURCE_COLLECTE"> <span style="margin-left:5px;"></span> SOURCE DE COLLECTE<br>
                          <div style="color: red"><?php echo $error; ?></div>
                        </div>
                      </div>

                      <div class="form-group col-md-6">
                        <input type="checkbox" value="1" name="ARCHIVAGE"> <span style="margin-left:5px;"></span> ARCHIVAGE<br>
                        <input type="checkbox" value="1" name="MESSAGERIE"> <span style="margin-left:5px;"></span> MESSAGERIE<br>
                        <input type="checkbox" value="1" name="COMPTABILITE"> <span style="margin-left:5px;"></span> COMPTABILITE<br>
                        <input type="checkbox" value="1" name="NOTIFICATIONS"> <span style="margin-left:5px;"></span> NOTIFICATIONS<br>
                        <input type="checkbox" value="1" name="TDB_PROJETS"> <span style="margin-left:5px;"></span> TABLEAU DE BORD PROJET<br>
                        <input type="checkbox" value="1" name="CENTRE_SITUATION"> <span style="margin-left:5px;"></span> CENTRE DE SITUATION<br>
                        <input type="checkbox" value="1" name="TDB_INCIDENTS"> <span style="margin-left:5px;"></span> TABLEAU DE BORD INCIDENTS<br>
                        <input type="checkbox" value="1" name="TDB_ACTIVITES"> <span style="margin-left:5px;"></span> TABLEAU DE BORD ACTIVITES<br>
                        <input type="checkbox" value="1" name="TDB_FORMATIONS"> <span style="margin-left:5px;"></span> TABLEAU DE BORD FORMATIONS<br>
                        <input type="checkbox" value="1" name="PRODUITS_DISPONIBLES"> <span style="margin-left:5px;"></span> PRODUITS DISPONIBLES<br>
                        <input type="checkbox" value="1" name="CARTE_BENEFICIAIRE"> <span style="margin-left:5px;"></span> CARTE DES BENEFICIAIRES<br>
                        <input type="checkbox" value="1" name="TDB_COOPERATIVES"> <span style="margin-left:5px;"></span> TABLEAU DE BORD COOPERATIVES<br>
                        <input type="checkbox" value="1" name="TDB_BENEFICIAIRES"> <span style="margin-left:5px;"></span> TABLEAU DE BORD BENEFICIAIRES<br>
                        <input type="checkbox" value="1" name="RA_EVOLUTION_JOURNALIERE"> <span style="margin-left:5px;"></span> EVOLUTION JOURNALIERE<br>
                        <input type="checkbox" value="1" name="CARTE_PERIMETRE_INTERVENTION"> <span style="margin-left:5px;"></span> CARTE PERIMETRE D'INTERVATION<br>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include VIEWPATH.'includes/scripts_js.php'; ?>
</body>
<?php include VIEWPATH.'includes/legende.php' ?>
</html>
<script>
  $(document).ready(function(){ 
    $('#message').delay(6000).hide('slow');
  });
</script>