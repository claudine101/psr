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

          <!--     <a hhref="<?php echo base_url() ?>administration/User_Profil" class='btn btn-success float-right'>
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
                 <form class="form-horizontal" action="<?=base_url('administration/User_Profil/update_profile');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

          <input type="hidden" name="PROFIL_ID" value="<?=$profilo['PROFIL_ID'];?>">


       <?php echo validation_errors(); ?> 


            <div class="form-row">
            <div class="form-group col-md-6">
                <label style="font-weight: 900; color:#454545">DESCRIPTION DU PROFIL</label>
                <input type="text" class="form-control" name="PROFIL_DESCR" id="PROFIL_DESCR" value="<?=$profilo['PROFIL_DESCR']?>">
            </div>
            <div class="form-group col-md-6">
                <label style="font-weight: 900; color:#454545">CODE DU PROFIL</label>
                <input type="text" class="form-control" name="PROFIL_CODE" id="PROFIL_CODE" value="<?=$profilo['PROFIL_CODE']?>" >
            </div>
          </div>


            
            <div class="form-row">
            <div class="form-group col-md-6">
                 <label for="" class="col-md-3 col-sm-6 col-xs-6 control-label">Droits des utilisateurs</label>
                  <div class="col-md-6 col-sm-4 col-xs-6">
                  <input type="checkbox" value="1" name="ADMINISTRATION" <?php echo ($profilo['ADMINISTRATION']==1)? 'checked':'' ?>> ADMINISTRATION<br>
                  <input type="checkbox" value="1" name="DASHBOARD" <?php echo ($profilo['DASHBOARD']==1)? 'checked':'' ?>> DASHBOARD<br>
                  <input type="checkbox" value="1" name="RAPPORT" <?php echo ($profilo['RAPPORT']==1)? 'checked':'' ?>> RAPPORT<br>
                  <input type="checkbox"  name="SIG" value="1" <?php echo ($profilo['SIG']==1)? 'checked':'' ?>> SIG<br>
                  <input type="checkbox"  name="DONNEES" value="1" <?php echo ($profilo['DONNEES']==1)? 'checked':'' ?>> DONNEES<br>
                  <input type="checkbox" value="1" name="IHM" <?php echo ($profilo['IHM']==1)? 'checked':'' ?>> IHM<br>
                  <input type="checkbox" value="1" name="COLLABORATEUR" <?php echo ($profilo['COLLABORATEUR']==1)? 'checked':'' ?>> COLLABORATEUR<br>
                  <input type="checkbox" value="1" name="SUIVI_EVALUATION" <?php echo ($profilo['SUIVI_EVALUATION']==1)? 'checked':'' ?>> SUIVI ET EVALUATION<br>
                  <input type="checkbox" value="1" name="CRA" <?php echo ($profilo['CRA']==1)? 'checked':'' ?>> CRA<br>
                  <input type="checkbox" value="1" name="E_COMMERCE" <?php echo ($profilo['E_COMMERCE']==1)? 'checked':'' ?>> E-COMMERCE<br>
                  <input type="checkbox" value="1" name="MESSAGERIE" <?php echo ($profilo['MESSAGERIE']==1)? 'checked':'' ?>> MESSAGERIE<br>
                  <input type="checkbox" value="1" name="NOTIFICATIONS" <?php echo ($profilo['NOTIFICATIONS']==1)? 'checked':'' ?>> NOTIFICATIONS<br>
                  <input type="checkbox" value="1" name="PROFILS" <?php echo ($profilo['PROFILS']==1)? 'checked':'' ?>> PROFILS<br>
                  <input type="checkbox" value="1" name="UTILISATEURS" <?php echo ($profilo['UTILISATEURS']==1)? 'checked':'' ?>> UTILISATEURS<br>
                  <input type="checkbox" value="1" name="BAILLEUR" <?php echo ($profilo['BAILLEUR']==1)? 'checked':'' ?>> BAILLEUR<br>
                  <input type="checkbox" value="1" name="BENEFICIAIRE" <?php echo ($profilo['BENEFICIAIRE']==1)? 'checked':'' ?>> BENEFICIAIRE<br>
                  <input type="checkbox" value="1" name="INDICATEUR" <?php echo ($profilo['INDICATEUR']==1)? 'checked':'' ?>> INDICATEUR<br>
                  <input type="checkbox" value="1" name="INTERVENANT" <?php echo ($profilo['INTERVENANT']==1)? 'checked':'' ?>> INTERVENANT<br>
                  <input type="checkbox" value="1" name="PILIER" <?php echo ($profilo['PILIER']==1)? 'checked':'' ?>> PILIER<br>

              
                   <div style="color: red"><?php echo $error; ?></div>
         
                </div>
            </div>

            <div class="form-group col-md-6">
                 <!-- <label for="" class="col-md-3 col-sm-6 col-xs-6 control-label">Droits des utilisateurs</label> -->
                  <!-- <div class="col-md-6 col-sm-4 col-xs-6"> -->
                  <input type="checkbox" value="1" name="PROJET" <?php echo ($profilo['PROJET']==1)? 'checked':'' ?>> PROJET<br>
                  <input type="checkbox" value="1" name="RESP_UNWOMAN" <?php echo ($profilo['RESP_UNWOMAN']==1)? 'checked':'' ?>> RESPONSABLE UNWOMAN<br>
                  <input type="checkbox" value="1" name="SOURCE_COLLECTE" <?php echo ($profilo['SOURCE_COLLECTE']==1)? 'checked':'' ?>> SOURCE DE COLLECTE<br>
                  <input type="checkbox" value="1" name="UNITE_MESURE" <?php echo ($profilo['UNITE_MESURE']==1)? 'checked':'' ?>> UNITE DE MESURE <br>
                  <input type="checkbox" value="1" name="AFFECTATIONS" <?php echo ($profilo['AFFECTATIONS']==1)? 'checked':'' ?>> AFFECTATIONS<br>
                  <input type="checkbox" value="1" name="ACTIVITES" <?php echo ($profilo['ACTIVITES']==1)? 'checked':'' ?>> ACTIVITES<br>
                  <input type="checkbox" value="1" name="TACHES" <?php echo ($profilo['TACHES']==1)? 'checked':'' ?>> TACHES<br>
                  <input type="checkbox" value="1" name="ENQUETEURS" <?php echo ($profilo['ENQUETEURS']==1)? 'checked':'' ?>> ENQUETEURS<br>
                  <input type="checkbox" value="1" name="SIG_BENEFICIAIRES" <?php echo ($profilo['SIG_BENEFICIAIRES']==1)? 'checked':'' ?>> BENEFICIAIRES(SIG)<br>
                  <input type="checkbox" value="1" name="SIG_PERIMETRE_INTERVENTION" <?php echo ($profilo['SIG_PERIMETRE_INTERVENTION']==1)? 'checked':'' ?>> PERIMETRE D'INTERVENTION<br>

                  <input type="checkbox" value="1" name="PRODUITS_DISPONIBLES" <?php echo ($profilo['PRODUITS_DISPONIBLES']==1)? 'checked':'' ?>> PRODUITS DISPONIBLES<br>

                  <input type="checkbox" value="1" name="E_ARTICLE" <?php echo ($profilo['E_ARTICLE']==1)? 'checked':'' ?>> ARTICLE<br>
                  <input type="checkbox" value="1" name="E_CLIENT" <?php echo ($profilo['E_CLIENT']==1)? 'checked':'' ?>> CLIENT<br>
                  <input type="checkbox" value="1" name="E_COMMANDE" <?php echo ($profilo['E_COMMANDE']==1)? 'checked':'' ?>> COMMANDE<br>
                  <input type="checkbox" value="1" name="TDB_BENEFICIAIRES" <?php echo ($profilo['TDB_BENEFICIAIRES']==1)? 'checked':'' ?>> BENEFICIAIRE<br>
                  <input type="checkbox" value="1" name="TDB_PROJETS" <?php echo ($profilo['TDB_PROJETS']==1)? 'checked':'' ?>> PROJET(TDB)<br>
                  <input type="checkbox" value="1" name="TDB_ACTIVITES" <?php echo ($profilo['TDB_ACTIVITES']==1)? 'checked':'' ?>> ACTIVITES<br>
                  <input type="checkbox" value="1" name="RA_EVOLUTION_JOURNALIERE" <?php echo ($profilo['RA_EVOLUTION_JOURNALIERE']==1)? 'checked':'' ?>> EVOLUTION JOURNALIERE(RAPPORT)<br>
                  <input type="checkbox" value="1" name="EMAIL" <?php echo ($profilo['EMAIL']==1)? 'checked':'' ?>> EMAIL<br>
                  <input type="checkbox" value="1" name="COMPTABILITE" <?php echo ($profilo['COMPTABILITE']==1)? 'checked':'' ?>> COMPTABILITE<br>
                  <input type="checkbox" value="1" name="ARCHIVAGE" <?php echo ($profilo['ARCHIVAGE']==1)? 'checked':'' ?>> ARCHIVAGE<br>
              
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

