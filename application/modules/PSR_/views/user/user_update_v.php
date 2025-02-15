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
            <div class="col-sm-9">

              <h4 class="m-0"><?=$title?></h4>
            </div><!-- /.col -->
            <div class="col-sm-3">
              <a href="<?=base_url('PSR/Profil/index')?>" class='btn btn-primary float-right'>
                <i class="nav-icon fas fa-list ul"></i>
                Liste
              </a>
            </div><!-- /.col -->
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="col-md-12 col-xl-12 grid-margin stretch-card">

          <div class="card">
            <div class="card-body">

              <div class="col-md-12">

               <form  name="myform" method="post" class="form-horizontal" action="<?= base_url('PSR/Utilisateur/update'); ?>" >

                <div class="row">
                  <div class="col-md-6">

                    <input type="hidden" class="form-control" name="ID_UTILISATEUR" value="<?=$user['ID_UTILISATEUR']?>" >
                    <label for="FName">Statut</label>
                    <input type="text" name="NOM_UTILISATEUR" value="<?=$user['NOM_UTILISATEUR'] ?>"  id="NOM_UTILISATEUR" class="form-control">

                    <?php echo form_error('NOM_UTILISATEUR', '<div class="text-danger">', '</div>'); ?> 

                  </div>

                  <div class="col-md-6">
                    <label for="FName">Mot de passe</label>
                    <input type="text" name="MOT_DE_PASSE" value="<?=$user['MOT_DE_PASSE'] ?>"  id="MOT_DE_PASSE" class="form-control">

                    <?php echo form_error('MOT_DE_PASSE', '<div class="text-danger">', '</div>'); ?> 

                  </div>
                  <div class="col-md-6">
                    <label for="Ftype">Profil</label>
                    <select class="form-control" name="PROFIL_ID" id="PROFIL_ID" >
                      <!-- <option value="">---Sélectionner---</option> -->
                      <?php

                      foreach ($profil as $value)
                      {

                        $selected="";
                        if($value['PROFIL_ID']==$user['PROFIL_ID'])
                        {
                          $selected="selected";
                        }
                        ?>
                        <option value="<?=$value['PROFIL_ID']?>" <?=$selected?>><?=$value['STATUT']?></option>
                        <?php
                      }
                      ?>
                    </select>
                    <div><font color="red" id="error_province"></font></div> 
                  </div>
                  




                </div>  
                <div class="col-md-6" style="margin-top:31px;">
                  <button type="submit" style="float: right;" class="btn btn-primary"><span class="fas fa-save"></span> Modifier</button>

                </div>
              </form>
            </div>

          </div>
        </div>

      </div>

    </div>
  </section>
</div>
</div>
</body>

<?php include VIEWPATH.'templates/footer.php'; ?>


