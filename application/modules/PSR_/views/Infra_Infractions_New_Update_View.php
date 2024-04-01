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
              <a href="<?=base_url('Rapport/Infra_Infractions_New/index')?>" class='btn btn-primary float-right'>
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

               <form  name="myform" method="post" class="form-horizontal" action="<?= base_url('Rapport/Infra_Infractions_New/update'); ?>" >

                <div class="row">
                    <input type="hidden" class="form-control" name="ID_INFRA_INFRACTION" value="<?=$questions['ID_INFRA_INFRACTION']?>" >
                    


                      <div class="col-md-6">
                      <label for="Ftype">VERIFICATION</label>
                      <select class="form-control" name="ID_TYPE_VERIFICATION " id="ID_TYPE_VERIFICATION ">
                        
                        <?php

                        foreach ($categorie_g as $value)
                        {

                          $selected="";
                          if($value['ID_TYPE_VERIFICATION ']==$questions['ID_TYPE_VERIFICATION'])
                          {
                            $selected="selected";
                          }
                          ?>
                          <option value="<?=$value['ID_TYPE_VERIFICATION']?>" <?=$selected?>><?=$value['VERIFICATION']?></option>
                          <?php
                        }
                        ?>
                      </select>
                      <?php echo form_error('ID_TYPE_VERIFICATION', '<div class="text-danger">', '</div>'); ?> 

                    </div>
                    <div class="col-md-6">
                      <label for="FName">NIVEAU_ALERTE</label>
                      <input type="text" name="NIVEAU_ALERTE" value="<?=$questions['NIVEAU_ALERTE'] ?>"  id="NIVEAU_ALERTE" class="form-control">

                      <?php echo form_error('NIVEAU_ALERTE', '<div class="text-danger">', '</div>'); ?> 

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


