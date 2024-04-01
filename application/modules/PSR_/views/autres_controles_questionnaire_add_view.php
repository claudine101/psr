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
              <a href="<?=base_url('PSR/Autres_controles_questionnaires/index')?>" class='btn btn-primary float-right'>
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

                <form  name="myform" method="post" class="form-horizontal" action="<?= base_url('PSR/Autres_controles_questionnaires/add'); ?>" >



                 <div class="row">
                  <div class="col-md-6">
                    <label for="FName">Infranctions</label>
                    <input type="text" name="INFRACTION" autocomplete="off" id="INFRACTION" value="<?= set_value('INFRACTION') ?>"  class="form-control">
                    
                    <?php echo form_error('INFRACTION', '<div class="text-danger">', '</div>'); ?> 

                  </div>
                  <div class="col-md-6">
                    <label for="FName">Montant</label>
                    <input type="text" name="MONTANT" autocomplete="off" id="MONTANT" value="<?= set_value('MONTANT') ?>"  class="form-control">
                    
                    <?php echo form_error('MONTANT', '<div class="text-danger">', '</div>'); ?> 

                  </div>
                  <div class="col-md-6">
                    <label for="FName">Pourcentage</label>
                    <input type="text" name="POURCENTAGE" autocomplete="off" id="POURCENTAGE" value="<?= set_value('POURCENTAGE') ?>"  class="form-control">
                    
                    <?php echo form_error('POURCENTAGE', '<div class="text-danger">', '</div>'); ?> 

                  </div>
                  <div class="col-md-6">
                    <label for="Ftype">Categorie</label>
                    <select required class="form-control" name="ID_QUESTIONNAIRE_CATEGORIES" id="ID_QUESTIONNAIRE_CATEGORIES" >
                      <option value="">---Sélectionner---</option>
                      <?php
                      foreach ($categorie_g as $value)
                      {
                        ?>
                        <option value="<?=$value['ID_QUESTIONNAIRE_CATEGORIES']?>"><?=$value['CATEGORIES']?></option>
                        <?php
                      }
                      ?>
                    </select>
                    <!-- <div><font color="red" id="error_province"></font></div>  -->
                    <?php echo form_error('ID_QUESTIONNAIRE_CATEGORIES', '<div class="text-danger">', '</div>'); ?>
                  </div>
        
                    <div class="col-md-6" style="margin-top:31px;">
                      <button type="submit" style="float: right;" class="btn btn-primary"><span class="fas fa-save"></span> Enregistrer</button>
                    </div>

                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>
</div>
</body>

<?php include VIEWPATH.'templates/footer.php'; ?>


