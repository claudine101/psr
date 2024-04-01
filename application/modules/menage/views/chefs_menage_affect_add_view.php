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
          <a href="<?=base_url('menage/Chefs_menage_affectation/index')?>" class='btn btn-primary float-right'>
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

<form  name="myform" method="post" class="form-horizontal" action="<?= base_url('menage/Chefs_menage_affectation/add'); ?>" >



                

               <div class="row">

                   <div class="col-md-6">
                    <label for="Ftype">Autorite des manages</label>
          <!-- <select class="form-control "   name="ID_CHEF[]" id="ID_CHEF"  multiple="multiple" required>
                      <option value="">---Sélectionner---</option> -->
                      <select required class="form-control" name="ID_CHEF" id="ID_CHEF" required  >
                      <option value="">---Sélectionner---</option>
                      <?php
                      foreach ($polices as $value)
                      {
                        ?>
                   <option value="<?=$value['ID_CHEF']?>"><?=$value['PNB']?></option>
                        <?php
                      }
                      ?>
                    </select>

                  </div>
                  <div class="col-md-6">
                      <label for="Ftype">Profil</label>
                      <select onchange="get_lieux(); " required class="form-control" name="PROFIL_ID" id="PROFIL_ID">
                        <option value="">---Sélectionner---</option>
                        <?php
                        foreach ($profils as $value) {
                        ?>
                          <option value="<?= $value['PROFIL_ID'] ?>"><?= $value['STATUT'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                      <!-- <div><font color="red" id="error_province"></font></div>  -->
                      <?php echo form_error('PROFIL_ID', '<div class="text-danger">', '</div>'); ?>
                    </div>  
                    <div class="col-md-6">
                    <label for="FName">DATE DEBUT</label>
                    <input type="date" name="DATE_DEBUT" autocomplete="off" id="DATE_DEBUT" value="<?= set_value('DATE_DEBUT') ?>"  class="form-control" required>
                    
                   

                  </div>

                

                 
                    <div class="col-md-6">
                    <label for="FName">DATE FIN</label>
                    <input type="date" name="DATE_FIN" autocomplete="off" id="DATE_FIN" value="<?= set_value('DATE_FIN') ?>"  class="form-control" required>
                    
                    <?php echo form_error('CNI', '<div class="text-danger">', '</div>'); ?> 

                  </div>

                 <div class="col-md-6">
                      <label for="Ftype">Province</label>
                      <select required class="form-control" name="ID_PROVINCE" id="ID_PROVINCE" onchange="get_communes();">
                        <option value="">---Sélectionner---</option>
                        <?php
                        foreach ($provinces as $value) {
                        ?>
                          <option value="<?= $value['PROVINCE_ID'] ?>"><?= $value['PROVINCE_NAME'] ?></option>
                        <?php
                        }
                        ?>
                      </select>
                      <!-- <div><font color="red" id="error_province"></font></div>  -->
                      <?php echo form_error('ID_PROVINCE', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="col-md-6">
                      <label for="Ftype">Commune</label>
                      <select required class="form-control" name="ID_COMMUNE" id="ID_COMMUNE" onchange="get_zones();">
                        <option value="">---Sélectionner---</option>
                      </select>
                      <!-- <div><font color="red" id="error_commune"></font></div> -->
                      <?php echo form_error('ID_COMMUNE', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div id="zone" style="display: none;" class="col-md-6">
                      <label for="Ftype">Zone</label>
                      <select class="form-control" name="ID_ZONE" id="ID_ZONE" onchange="get_collines();">
                        <option value="">---Sélectionner---</option>
                      </select>
                      <!-- <div><font color="red" id="error_zone"></font></div> -->
                      <?php echo form_error('ID_ZONE', '<div class="text-danger">', '</div>'); ?>
                    </div>
                     <div id="colline" style="display: none;" class="col-md-6">
                      <label for="Ftype">Colline</label>
                      <select class="form-control" name="ID_COLLINE" id="ID_COLLINE" onchange="get_avenues();">
                        <option value="">---Sélectionner---</option>
                      </select>
                      <!-- <div><font color="red" id="error_zone"></font></div> -->
                      <?php echo form_error('ID_COLLINE', '<div class="text-danger">', '</div>'); ?>
                    </div>
                     <div id="avenue" style="display: none;" class="col-md-6">
                      <label for="Ftype">Avenues</label>
                      <select class="form-control" name="ID_AVENUE" id="ID_AVENUE" onchange="autre();">
                        <option value="">---Sélectionner---</option>
                      </select>
                      <!-- <div><font color="red" id="error_zone"></font></div> -->
                      <?php echo form_error('ID_COLLINE', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div id="autre_avenue" class="col-md-6" style="display:none">
                      <label for="FName"> AUTRE AVENUE</label>
                      <input type="text" name="AUTRE" autocomplete="off" id="AUTRE" value="<?= set_value('AUTRE') ?>" class="form-control">
                    </div>
                </div>

                  <div class="col-md-6" style="margin-top:31px;">
                    <button type="submit" style="float: right;" class="btn btn-primary"><span class="fas fa-save"></span> Enregistrer</button>
                  </div>
                </div>
                           
                </div>
                </div>

                        <!-- <div class="row">
                          
                        </div> -->
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div><script>
  function get_communes() {
    var ID_PROVINCE = $('#ID_PROVINCE').val();
    if (ID_PROVINCE == '') {
      $('#ID_COMMUNE').html('<option value="">---Sélectionner---</option>');
      $('#ID_ZONE').html('<option value="">---Sélectionner---</option>');
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
    } else {
      $('#ID_ZONE').html('<option value="">---Sélectionner---</option>');
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
      $.ajax({
        url: "<?= base_url() ?>menage/Chefs_menage/get_communes/" + ID_PROVINCE,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#ID_COMMUNE').html(data);
        }
      });

    }
  }

  function get_zones() {
    var ID_COMMUNE = $('#ID_COMMUNE').val();
    if (ID_COMMUNE == '') {
      $('#ID_ZONE').html('<option value="">---Sélectionner---</option>');
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
    } else {
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
      $.ajax({
        url: "<?= base_url() ?>menage/Chefs_menage/get_zones/" + ID_COMMUNE,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#ID_ZONE').html(data);
        }
      });

    }
  }


  function get_lieux() {
   var PROFIL_ID = Number($('#PROFIL_ID').val());
    
    //CHEF DE ZONE
    if(PROFIL_ID==21)
    {
       $('#zone').show()
       $('#colline').hide()
       $('#avenue').hide()
    }
    //CHEF DE QUARTIER
    else if(PROFIL_ID==22)
    {
       $('#zone').show()
       $('#colline').show()
       $('#avenue').hide()
    }
    //CHEF DE SECTEUR
    else if(PROFIL_ID==20)
    {
      $('#zone').show()
       $('#colline').show()
       $('#avenue').show()
    }
  }
   function get_avenues(){
    var ID_COLLINE = $('#ID_COLLINE').val();
    if (ID_COLLINE == '') {
      $('#ID_AVENUE').html('<option value="">---Sélectionner---</option>');
    } else {
      $.ajax({
        url: "<?= base_url() ?>menage/Chefs_menage/get_avenues/" + ID_COLLINE,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#ID_AVENUE').html(data);
        }
      });

    }
  }
  function autre(){
   var ID_AVENUE = $('#ID_AVENUE').val();
   if(ID_AVENUE=='Autre'){
   $('#autre_avenue').show()
   }
   else{
   $('#autre_avenue').hide()
   }
  }
</script>
      </body>

  <script>
  function get_communes() {
    var ID_PROVINCE = $('#ID_PROVINCE').val();
    if (ID_PROVINCE == '') {
      $('#ID_COMMUNE').html('<option value="">---Sélectionner---</option>');
      $('#ID_ZONE').html('<option value="">---Sélectionner---</option>');
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
    } else {
      $('#ID_ZONE').html('<option value="">---Sélectionner---</option>');
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
      $.ajax({
        url: "<?= base_url() ?>menage/Chefs_menage/get_communes/" + ID_PROVINCE,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#ID_COMMUNE').html(data);
        }
      });

    }
  }

  function get_zones() {
    var ID_COMMUNE = $('#ID_COMMUNE').val();
    if (ID_COMMUNE == '') {
      $('#ID_ZONE').html('<option value="">---Sélectionner---</option>');
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
    } else {
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
      $.ajax({
        url: "<?= base_url() ?>menage/Chefs_menage/get_zones/" + ID_COMMUNE,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#ID_ZONE').html(data);
        }
      });

    }
  }


  function get_collines() {
    var ID_ZONE = $('#ID_ZONE').val();
    if (ID_ZONE == '') {
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
    } else {
      $.ajax({
        url: "<?= base_url() ?>menage/Chefs_menage/get_collines/" + ID_ZONE,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#ID_COLLINE').html(data);
        }
      });

    }
  }
  function get_collines() {
    var ID_ZONE = $('#ID_ZONE').val();
    if (ID_ZONE == '') {
      $('#ID_COLLINE').html('<option value="">---Sélectionner---</option>');
    } else {
      $.ajax({
        url: "<?= base_url() ?>menage/Chefs_menage/get_collines/" + ID_ZONE,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
          $('#ID_COLLINE').html(data);
        }
      });

    }
  }
</script>

      <?php include VIEWPATH.'templates/footer.php'; ?>


    