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
              <a href="<?=base_url('PSR/questionnaire_categories/index')?>" class='btn btn-primary float-right'>
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

                <form  name="myform" method="post" class="form-horizontal" action="<?= base_url('ihm/questionnaire_categories/add'); ?>" >



                 <div class="row">
                    <div class="col-md-6">
                    <label for="Ftype">Province</label>
                    <select required class="form-control" name="ID_CONTAGE" id="ID_CONTAGE" onchange="get_communes();">
                      <option value="">---Sélectionner---</option>
                      <?php
                      foreach ($provinces as $value)
                      {
                        ?>
                        <option value="<?=$value['ID_CONTAGE']?>"><?=$value['DESCRIPTION']?></option>
                        <?php
                      }
                      ?>
                    </select>
                    <!-- <div><font color="red" id="error_province"></font></div>  -->
                    <?php echo form_error('ID_CONTAGE', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="col-md-6">
                    <label for="FName">CATEGORIES</label>
                    <input type="text" name="CATEGORIES" autocomplete="off" id="CATEGORIES" value="<?= set_value('CATEGORIES') ?>"  class="form-control">
                    
                    <?php echo form_error('CATEGORIES', '<div class="text-danger">', '</div>'); ?> 
                  </div>


                </div>

                <div class="col-md-6" style="margin-top:31px;">
                  <button type="submit" style="float: right;" class="btn btn-primary"><span class="fas fa-save"></span> Enregistrer</button>
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


