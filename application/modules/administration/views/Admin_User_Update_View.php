F<!DOCTYPE html>
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
              <a href="<?php echo base_url() ?>administration/Admin_User/listing" class='btn btn-info float-right'>
                <i class="nav-icon fas fa-list ul"></i>
                Liste
              </a>

              <a href="<?php echo base_url() ?>administration/Admin_User" class='btn btn-success float-right'>
                <i class="nav-icon fas fa-plus ul"></i>
                Nouveau
              </a>
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
                  <form method="post" action="<?=base_url()?>administration/Admin_User/update">
                   <!-- <?php echo validation_errors(); ?> -->
                    
                    <div class="form-row">
                      <input type="hidden" name="USER_ID" value="<?=$user['USER_ID'];?>">
                      <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">Nom <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" name="NOM" id="NOM" placeholder="Nom de l'utilisateur" value="<?=$user['NOM_PRENOM'];?>">
                        <?php echo form_error('NOM', '<div class="text-danger">', '</div>'); ?>
                      </div>

                      <!-- <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">Prénom <span class="text-danger">*</span></label>
                        <input type="text" autocomplete="off" class="form-control" name="PRENOM" id="PRENOM" placeholder="Prénom de l'utilisateur" value="<?=$user['PRENOM'];?>">
                        <?php echo form_error('PRENOM', '<div class="text-danger">', '</div>'); ?>
                      </div>
 -->
                      <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">Restaurant <span class="text-danger">*</span></label>
                        <select class="form-control" name="ID_RESTAURANT">
                          <option value="">---Sélectionner---</option>
                          <?php
                            foreach ($restaurants as $restora)
                            {
                              if ($restora['ID_RESTAURANT']==$user['ID_RESTAURANT'])
                              {
                          ?>
                          <option value="<?=$restora['ID_RESTAURANT'] ?>" selected><?=$restora['NOM_RESTAURANT']; ?></option>
                    
                          <?php
                              }
                              else
                              {
                          ?>
                          <option value="<?= $restora['ID_RESTAURANT'] ?>"><?=$restora['NOM_RESTAURANT']; ?></option>
                          <?php
                              }
                            }
                          ?>
                        </select>
                        <?php echo form_error('ID_FONCTION', '<div class="text-danger">', '</div>'); ?>
                      </div>

                      <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">Profile <span class="text-danger">*</span></label>
                        <select class="form-control" name="PROFIL_ID">
                          <option value="">---Sélectionner---</option>
                          <?php
                            foreach ($profiles as $pro)
                            {
                              if ($pro['PROFIL_ID']==$user['PROFILE_ID'])
                              {
                          ?>
                          <option value="<?=$pro['PROFIL_ID'] ?>" selected><?=$pro['PROFIL_DESCR']; ?></option>
                          <?php 
                              }
                              else
                              {
                          ?>
                          <option value="<?=$pro['PROFIL_ID']?>"><?=$pro['PROFIL_DESCR']; ?></option>
                          <?php 
                              }
                            }
                          ?>
                        </select>
                        <?php echo form_error('PROFIL_ID', '<div class="text-danger">', '</div>'); ?>
                      </div>

                      <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">Téléphone 1 <span class="text-danger">*</span></label>
                        <input type="number" autocomplete="off" class="form-control"  name="TELEPHONE1" value="<?=$user['USER_TELEPHONE'];?>" id="TELEPHONE1" placeholder="Téléphone 1 de l'utilisateur">
                        <?php echo form_error('TELEPHONE1', '<div class="text-danger">', '</div>'); ?>
                      </div>




                    <!--   <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">Téléphone 2 </label>
                        <input type="number" autocomplete="off" class="form-control" name="TELEPHONE2" value="<?=$user['TELEPHONE2'];?>" id="TELEPHONE2" placeholder="Téléphone 2 de l'utilisateur">
                        <?php echo form_error('TELEPHONE2', '<div class="text-danger">', '</div>'); ?>
                      </div> -->

                      <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">Email <span class="text-danger">*</span></label>
                        <input type="email" autocomplete="off" class="form-control" name="EMAIL" value="<?=$user['USER_EMAIL'];?>" id="EMAIL" placeholder="example@gmail.com" value="<?=set_value('EMAIL');?>">
                        <?php echo form_error('EMAIL', '<div class="text-danger">', '</div>'); ?>
                      </div>
                  

                      <div class="form-group col-md-6">
                        <label style="font-weight: 900; color:#454545">Activer <span class="text-danger">*</span></label><br>
                         <?php $check_oui =  ($user['IS_ACTIVE'] == 1) ? 'checked' : '';
                                $check_non =  ($user['IS_ACTIVE'] == 0) ? 'checked' : ''; ?>
                        <label>Oui</label>
                        <input value="1" type="radio" name="IS_ACTIVE" <?=$check_oui?>>
                        <label>Non</label>
                        <input value="0" type="radio" name="IS_ACTIVE" <?=$check_non?>>
                       
                       </div>
                      </div>
                    <div class="form-group col-md-12">
                      <button type="submit" style="float: right;" class="btn btn-primary"><span class="fa fa-edit"></span> Modifier</button>
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
<?php if (!empty($this->session->flashdata('message'))) {
  # code...
 ?>
<script type="text/javascript">

  $( document ).ready(function() {
    setTimeout(function(){ window.location.href = "<?= base_url('Login/do_logout')?>"; }, 3001);
});
</script>
<?php }  ?>