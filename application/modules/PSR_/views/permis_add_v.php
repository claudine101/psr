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
              <a href="<?=base_url('PSR/Chauffeur_permis/index')?>" class='btn btn-primary float-right'>
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

                <form  name="myform" method="post" class="form-horizontal" action="<?= base_url('PSR/Chauffeur_permis/add'); ?>" >

                 <div class="row">
                   <div class="col-md-6">
                    <label for="FName"> NUMERO de PERMIS</label>
                    <input type="text" name="NUMERO_PERMIS" autocomplete="off" id="NUMERO_PERMIS" value="<?= set_value('NUMERO_PERMIS') ?>"  class="form-control">
                    
                    <?php echo form_error('NUMERO_PERMIS', '<div class="text-danger">', '</div>'); ?> 
                  </div>
                  <div class="col-md-6">
                    <label for="FName">PROPRIETAIRE</label>
                    <input type="text" name="NOM_PROPRIETAIRE" autocomplete="off" id="NOM_PROPRIETAIRE" value="<?= set_value('NOM_PROPRIETAIRE') ?>"  class="form-control">
                    
                    <?php echo form_error('NOM_PROPRIETAIRE', '<div class="text-danger">', '</div>'); ?> 
                  </div>
                  <div class="col-md-6">
                    <label for="FName"> CATEGORIES</label>
                    <input type="text" name="CATEGORIES" autocomplete="off" id="CATEGORIES" value="<?= set_value('CATEGORIES') ?>"  class="form-control">
                    
                    <?php echo form_error('CATEGORIES', '<div class="text-danger">', '</div>'); ?> 
                  </div>
                  <div class="col-md-6">
                    <label for="FName">  DATE_NAISSANCE</label>
                    <input type="date" name="DATE_NAISSANCE" autocomplete="off" id="DATE_NAISSANCE" value="<?= set_value('DATE_NAISSANCE') ?>"  class="form-control">
                    
                    <?php echo form_error('DATE_NAISSANCE', '<div class="text-danger">', '</div>'); ?> 
                  </div>

                  <div class="col-md-6">
                    <label for="FName"> DATE_DELIVER</label>
                    <input type="date" name="DATE_DELIVER" autocomplete="off" id="DATE_DELIVER" value="<?= set_value('DATE_DELIVER') ?>"  class="form-control">
                    
                    <?php echo form_error('DATE_DELIVER', '<div class="text-danger">', '</div>'); ?> 
                  </div>
                  <div class="col-md-6">
                    <label for="FName"> DATE_EXPIRATION</label>
                    <input type="date" name="DATE_EXPIRATION" autocomplete="off" id="DATE_EXPIRATION" value="<?= set_value('DATE_EXPIRATION') ?>"  class="form-control">
                    
                    <?php echo form_error('DATE_EXPIRATION', '<div class="text-danger">', '</div>'); ?> 
                  </div>
                </div>

                <div class="col-md-6" style="margin-top:31px;">
                  <button type="submit" style="float: right;" class="btn btn-primary"><span class="fas fa-save"></span> Enregistrer</button>
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


