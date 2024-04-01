
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
              <h4 style='color:#007bac'>Modification des droits et profils</h4>
              
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
                 <form class="form-horizontal" action="<?=base_url('administration/User_Profil_New/update_profile');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  <input type="hidden" name="PROFIL_ID" value="<?=$profilo['PROFIL_ID'];?>">
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label style="font-weight: 900; color:#454545">DESCRIPTION DU PROFIL</label>
                      <input type="text" class="form-control" name="PROFIL_DESCR" id="PROFIL_DESCR" value="<?=$profilo['PROFIL_DESCR']?>">
                      <font color="red"><?php echo form_error('PROFIL_DESCR'); ?></font>
                    </div>
                    <div class="form-group col-md-6">
                      <label style="font-weight: 900; color:#454545">CODE DU PROFIL</label>
                      <input type="text" class="form-control" name="PROFIL_CODE" id="PROFIL_CODE" value="<?=$profilo['PROFIL_CODE']?>" >
                      <font color="red"><?php echo form_error('PROFIL_CODE'); ?></font>
                    </div>
                  </div>


                  <div class="form-row">
                    <h4 for="" class="col-md-3 col-sm-6 col-xs-6 control-label">Droits des utilisateurs</h4>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <div class="col-md-6 col-sm-4 col-xs-6">
                        <input type="checkbox" value="1" name="TACHES" <?php echo ($profilo['TACHES']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> TACHES<br>
                        <input type="checkbox" value="1" name="PILIER" <?php echo ($profilo['PILIER']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> PILIER<br>
                        <input type="checkbox" value="1" name="PROJET" <?php echo ($profilo['PROJET']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> PROJET<br>
                        <input type="checkbox" value="1" name="PROFILS" <?php echo ($profilo['PROFILS']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> PROFILS<br>
                        <input type="checkbox" value="1" name="INCIDENT" <?php echo ($profilo['INCIDENT']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> INCIDENT<br>
                        <input type="checkbox" value="1" name="ACTIVITES" <?php echo ($profilo['ACTIVITES']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> ACTIVITES<br>
                        <input type="checkbox" value="1" name="ENQUETEURS" <?php echo ($profilo['ENQUETEURS']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> ENQUETEURS<br>
                        <input type="checkbox" value="1" name="LOGISTIQUE" <?php echo ($profilo['LOGISTIQUE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> LOGISTIQUE<br>
                        <input type="checkbox" value="1" name="INTERVENANT" <?php echo ($profilo['INTERVENANT']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> INTERVENANT<br>
                        <input type="checkbox" value="1" name="AFFECTATIONS" <?php echo ($profilo['AFFECTATIONS']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> AFFECTATIONS<br>
                        <input type="checkbox" value="1" name="BENEFICIAIRE" <?php echo ($profilo['BENEFICIAIRE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> BENEFICIAIRE<br>
                        <input type="checkbox" value="1" name="UTILISATEURS" <?php echo ($profilo['UTILISATEURS']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> UTILISATEURS<br>
                        <input type="checkbox" value="1" name="COLLABORATEUR" <?php echo ($profilo['COLLABORATEUR']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> COLLABORATEUR<br>
                        <input type="checkbox" value="1" name="UNITE_MESURE" <?php echo ($profilo['UNITE_MESURE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> UNITE DE MESURE<br>
                        <input type="checkbox" value="1" name="SOURCE_COLLECTE" <?php echo ($profilo['SOURCE_COLLECTE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> SOURCE DE COLLECTE<br>

                        <div style="color: red"><?php echo $error; ?></div>

                      </div>
                    </div>

                    <div class="form-group col-md-6">
                      <input type="checkbox" value="1" name="ARCHIVAGE" <?php echo ($profilo['ARCHIVAGE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> ARCHIVAGE<br>
                      <input type="checkbox" value="1" name="MESSAGERIE" <?php echo ($profilo['MESSAGERIE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> MESSAGERIE<br>
                      <input type="checkbox" value="1" name="COMPTABILITE" <?php echo ($profilo['COMPTABILITE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> COMPTABILITE<br>
                      <input type="checkbox" value="1" name="NOTIFICATIONS" <?php echo ($profilo['NOTIFICATIONS']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> NOTIFICATIONS<br>
                      <input type="checkbox" value="1" name="TDB_PROJETS" <?php echo ($profilo['TDB_PROJETS']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> TABLEAU DE BORD PROJET<br>
                      <input type="checkbox" value="1" name="CENTRE_SITUATION" <?php echo ($profilo['CENTRE_SITUATION']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> CENTRE DE SITUATION<br>
                      <input type="checkbox" value="1" name="TDB_INCIDENTS" <?php echo ($profilo['TDB_INCIDENTS']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> TABLEAU DE BORD INCIDENTS<br>
                      <input type="checkbox" value="1" name="TDB_ACTIVITES" <?php echo ($profilo['TDB_ACTIVITES']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> TABLEAU DE BORD ACTIVITES<br>
                      <input type="checkbox" value="1" name="TDB_FORMATIONS" <?php echo ($profilo['TDB_FORMATIONS']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> TABLEAU DE BORD FORMATIONS<br>
                      <input type="checkbox" value="1" name="PRODUITS_DISPONIBLES" <?php echo ($profilo['PRODUITS_DISPONIBLES']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> PRODUITS DISPONIBLES<br>
                      <input type="checkbox" value="1" name="CARTE_BENEFICIAIRE" <?php echo ($profilo['CARTE_BENEFICIAIRE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> CARTE DES BENEFICIAIRES<br>
                      <input type="checkbox" value="1" name="TDB_COOPERATIVES" <?php echo ($profilo['TDB_COOPERATIVES']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> TABLEAU DE BORD COOPERATIVES<br>
                      <input type="checkbox" value="1" name="TDB_BENEFICIAIRES" <?php echo ($profilo['SOURCE_COLLECTE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> TABLEAU DE BORD BENEFICIAIRES<br>
                      <input type="checkbox" value="1" name="RA_EVOLUTION_JOURNALIERE" <?php echo ($profilo['SOURCE_COLLECTE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> EVOLUTION JOURNALIERE<br>
                      <input type="checkbox" value="1" name="CARTE_PERIMETRE_INTERVENTION" <?php echo ($profilo['SOURCE_COLLECTE']==1)? 'checked':'' ?>> <span style="margin-left:5px;"></span> CARTE PERIMETRE D'INTERVATION<br>

                      <div style="color: red"><?php echo $error; ?></div>

                      <!-- </div> -->
                    </div>
                  </div>


                  <div class="form-group">  
                   <label class="col-md-12 col-sm-12 col-xs-12 control-label"></label>
                   <div class="col-md-6 col-sm-12 col-xs-12 col-md-push-3">
                     <input type="submit" class="btn btn-primary btn-block" value="MODIFIER LE DROIT"/>
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