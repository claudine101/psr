<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'templates/header.php'; ?>


<style type="text/css">
 .mapbox-improve-map{
  display: none;
}

.leaflet-control-attribution{
  display: none !important;
}
.leaflet-control-attribution{
  display: none !important;
}


.mapbox-logo {
  display: none;
}
</style>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include VIEWPATH.'templates/navbar.php'; ?>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include VIEWPATH.'templates/sidebar.php'; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
         <div class="col-sm-6 p-md-0">
 <div class="welcome-text">
    

     </div>
    </div>
       </div><!-- /.container-fluid -->
     </div>
     <!-- /.content-header -->
<div class="col-md-12 col-xl-12 grid-margin stretch-card">
<div class="row column1">
  <div class="col-md-12">
   <div class="white_shd full margin_bottom_10">
    <div class="full graph_head">
      <div class="row" style="margin-top: 0px">
<div class="form-group col-md-5"><h4 style='color:#FFFFFF'>Tableau de bord des assurances</h4></div>
<div class="form-group col-md-2">
 
<label style='color:#FFFFFF'>Assurance</label>
<select class="form-control"  onchange="get_rapport()" name="ID_ASSUREUR" id="ID_ASSUREUR">
       <option value="">Sélectionner</option>
<?php

foreach ($assurence as $value){
if ($value['ID_ASSUREUR'] == set_value('ID_ASSUREUR'))
{?>
<option value="<?=$value['ID_ASSUREUR']?>" selected><?=$value['ASSURANCE']?></option>
<?php } else{ 
 ?>
<option value="<?=$value['ID_ASSUREUR']?>" ><?=$value['ASSURANCE']?></option>
<?php } } ?>
      </select>
    </div>
    <div class="form-group col-md-1">
<label style='color:#FFFFFF'>Année</label>
<select class="form-control"  onchange="get_i()" name="mois" id="mois">
       <option value="">Sélectionner</option>
<?php

foreach ($dattes as $value){
if ($value['mois'] == set_value('mois'))
{?>
<option value="<?=$value['mois']?>" selected><?=$value['mois']?></option>
<?php } else{ 
 ?>
<option value="<?=$value['mois']?>" ><?=$value['mois']?></option>
<?php } } ?>
      </select>
    </div>

<div class="form-group col-md-2">
<label style='color:#FFFFFF'>Mois</label> 
<select class="form-control"  onchange="get_rapport()" name="jour" id="jour">
 <option value=""> Sélectionner </option> 
<?php

foreach ($datte as $value){
if ($value['jour'] == set_value('jour'))
{?>
<option value="<?=$value['jour']?>" selected><?=$value['jour']?></option>
<?php } else{ 
 ?>
<option value="<?=$value['jour']?>" ><?=$value['jour']?></option>
<?php } } ?>
      </select>
    </div>
<div class="form-group col-md-2"> 
    
    <label style='color:#FFFFFF'>Jours</label>
<select class="form-control"  onchange="get_rapport()" name="heure" id="heure">
 <option value=""> Sélectionner </option> 
<?php

foreach ($datte as $value){
if ($value['jour'] == set_value('jour'))
{?>
<option value="<?=$value['jour']?>" selected><?=$value['jour']?></option>
<?php } else{ 
 ?>
<option value="<?=$value['jour']?>" ><?=$value['jour']?></option>
<?php } } ?>
      </select>
    </div>
     </div>
   </div>
  </div>
 </div>
</div>

<div class="row">
 
      <div class="col-md-12" style="margin-bottom: 20px"></div>       
  <div id="container"  class="col-md-12" ></div>
  <div id="container1"  class="col-md-6" ></div>
  <div class="col-md-12" style="margin-bottom: 20px"></div>
  <div id="container2"  class="col-md-12" ></div>
  <div class="col-md-12" style="margin-bottom: 20px"></div>
  
</div>
</div>
</div>


<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg" style ="width:1000px">
          <div class="modal-content  modal-lg">
            <div class="modal-header">
              <h4 class="modal-title"><span id="titre"></span></h4>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table id='mytable' class='table table-bordered table-striped table-hover table-condensed' style="width:1000px">
                  <thead>
                  <th>#</th>
               <th>PROPRIETAIRE</th>
               <th>TELEPHONE</th>
               <th>NUMERO_PLAQUE</th>
               <th>NUMERO_CARTE_ROSE</th>
               <th>MODELE_VOITURE</th>
               <th>DATTE_DEBUT</th>
               <th>DATTE_FIN</th>
               <th>PROVINCE</th>
                  </thead>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Quitter</button>
            </div>
          </div>
        </div>
      </div>
       





</div>
</div></div></div>
<div id="nouveau">
</div>
<div id="nouveau1">
</div>
<div id="nouveau2">
</div>


</div>



    

<?php include VIEWPATH.'templates/footer.php'; ?>
</body>
</html>



 <script type="text/javascript">
 $( document ).ready(function() {
    get_rapport();
    // alert();
});   
function get_i() {

 $('#jour').html('');
$('#heure').html('');
 get_rapport();
   
}
</script>
<script type="text/javascript">
function get_m() {

    $('#heure').html('');
    get_rapport();
   
}
</script>

<script> 
function get_rapport(){

var mois=$('#mois').val();
var jour=$('#jour').val();
var heure=$('#heure').val();
var ID_ASSUREUR=$('#ID_ASSUREUR').val();
$.ajax({
url : "<?=base_url()?>dashboard/Dashboard_Vehecule_Assure/get_rapport",
type : "POST",
dataType: "JSON",
cache:false,
data:{
mois:mois,
jour:jour,
heure:heure,
ID_ASSUREUR:ID_ASSUREUR,
 
},
success:function(data){   
$('#container').html("");             
$('#nouveau').html(data.rapp );
$('#jour').html(data.select_month);
$('#heure').html(data.selectjour);
},            

});  
}

</script> 


