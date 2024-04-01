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

               <form  name="myform" method="post" class="form-horizontal" action="<?= base_url('PSR/Chauffeur_permis/update'); ?>" >

                <div class="row">
                    <input type="hidden" class="form-control" name="ID_PERMIS" value="<?=$data['ID_PERMIS']?>" >


                    <div class="col-md-6">
                      <label for="FName">NUMERO PERMIS</label>
                      <input type="text" name="NUMERO_PERMIS" value="<?=$data['NUMERO_PERMIS'] ?>"  id="NUMERO_PERMIS" class="form-control">

                      <?php echo form_error('NUMERO_PERMIS', '<div class="text-danger">', '</div>'); ?> 

                    </div>
                    <div class="col-md-6">
                      <label for="FName">NOM PROPRIETAIRE</label>
                      <input type="text" name="NOM_PROPRIETAIRE" value="<?=$data['NOM_PROPRIETAIRE'] ?>"  id="NOM_PROPRIETAIRE" class="form-control">

                      <?php echo form_error('NOM_PROPRIETAIRE', '<div class="text-danger">', '</div>'); ?> 

                    </div>
                        <div class="col-md-6">
                      <label for="FName">CATEGORIES</label>
                      <input type="text" name="CATEGORIES" value="<?=$data['CATEGORIES'] ?>"  id="CATEGORIES" class="form-control">

                      <?php echo form_error('CATEGORIES', '<div class="text-danger">', '</div>'); ?> 

                    </div>
                    <div class="col-md-6">
                      <label for="FName">DATE NAISSANCE</label>
                      <input type="text" name="DATE_NAISSANCE" value="<?=$data['DATE_NAISSANCE'] ?>"  id="DATE_NAISSANCE" class="form-control">

                      <?php echo form_error('DATE_NAISSANCE', '<div class="text-danger">', '</div>'); ?> 

                    </div>

                        <div class="col-md-6">
                      <label for="FName">DATE DELIVER</label>
                      <input type="text" name="DATE_DELIVER" value="<?=$data['DATE_DELIVER'] ?>"  id="DATE_DELIVER" class="form-control">

                      <?php echo form_error('DATE_DELIVER', '<div class="text-danger">', '</div>'); ?> 

                    </div>
                    <div class="col-md-6">
                      <label for="FName">DATE EXPIRATION</label>
                      <input type="text" name="DATE_EXPIRATION" value="<?=$data['DATE_EXPIRATION'] ?>"  id="DATE_EXPIRATION" class="form-control">

                      <?php echo form_error('DATE_EXPIRATION', '<div class="text-danger">', '</div>'); ?> 

                    </div>
                  </div>

                </div>  
                <div class="col-md-6" style="margin-top:31px;">
                  <button type="submit" style="float: right;" class="btn btn-primary"><span class="fas fa-save"></span> Modifier</button>

                </div>
              </div>

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


