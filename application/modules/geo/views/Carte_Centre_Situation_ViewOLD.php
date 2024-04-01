<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'templates/header.php'; ?>

<!-- 
<script src='https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.2.0/mapbox.css' rel='stylesheet' />
 <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.css' rel='stylesheet' />
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/MarkerCluster.Default.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' /> 


<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-zoomslider/v0.7.0/L.Control.Zoomslider.js'></script>
<link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-zoomslider/v0.7.0/L.Control.Zoomslider.css' rel='stylesheet'/> -->

<style>
/* Adjustments to account for mapbox.css box-sizing rules */
.leaflet-control-zoomslider-knob { width:7px; height:2px; }
.leaflet-container .leaflet-control-zoomslider-body {
  -webkit-box-sizing:content-box;
     -moz-box-sizing:content-box;
          box-sizing:content-box;
  }
</style>


<style type="text/css">
  .card{
  border-width: 0px;
  font-size: 14px;
  margin: 0px;
  padding: 0px;
}

#divImage{

  top: 10.4%;
  width: 50.4%;
  height: 100%;
  background: #fff;
  position: fixed;
  z-index: 1060;
  right: 20%;
  right: 20%;
  visibility: hidden;
  overflow-x: auto;

  top: 0;
  left: 0;
  display: none;
  width: 100%;
  height: 100%;
  overflow: hidden;
  outline: 0;
  outline-color: currentcolor;
  outline-style: none;
  outline-width: 0px;

  overflow-x: hidden;
  overflow-y: auto;

}


  #allImage {
  position: relative;
  width: auto;
  margin: .5rem;
  pointer-events: none;

}


#donnIdentite {
  position: relative;
  width: auto;
  margin: .5rem;
  /*pointer-events: none;*/

}


#divIdentite{

  width: 500px;
  max-height: 80%;
  overflow-x: hidden;
  overflow-y: auto;
  background: #fff;
  position: fixed;
  z-index: 1060;
  right: 20%;
  left: 18.3%;
  visibility: hidden;
}


    

.card-header{
  margin-top: -11px;
  margin-left: -11px;
  margin-right: -11px;
  text-align: center;
  background-color: black;
  color: white;
}
.card-footer{
  margin-bottom: -12px;
  margin-left: -11px;
  margin-right: -11px;
  padding-right: -8px
  padding-left: -8px
}

.card-body{
  margin-left: -13px;
  margin-right: -13px;
  margin-bottom: -13px;
}
.ui-coordinates {
  background:rgba(0,0,0,0.5);
  position:absolute;
  top:280px;right:15px;
  z-index:1;
  bottom:10px;
  right:20px;
  padding:5px 10px;
  color:#fff;
  font-size:12px;
  border-radius:3px;
  max-height:220px;
 
  width:250px;
  }
</style>
<style>
.legend label,
.legend span {
  display:block;
  float:left;
  height:15px;
  width:20%;
  text-align:center;
  font-size:9px;
  color:#808080;
  }
</style>

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

 .animated-icon{
  width: 25px;
  height: 25px;
  background-color: rgba(255,255,255,0.5);
  border-radius: 50%;
  box-shadow: 0px 0px 20px red;
  transition: all 1s;
}
</style>
<style>
  
  .css-icon {

  }

  .gps_ringu { 
    border: 7px solid #F30707;
     -webkit-border-radius: 30px;
     height: 38px;
     width: 38px;   
     margin-left: -10px;
     margin-top: -15px;
      -webkit-animation: pulsate 1s ease-out;
      -webkit-animation-iteration-count: infinite; 
      /*opacity: 0.0*/
  }


  .gps_ringss { 
    border: 7px solid #848484;
     -webkit-border-radius: 30px;
     height: 38px;
     width: 38px;   
     margin-left: -10px;
     margin-top: -15px;
      -webkit-animation: pulsate 1s ease-out;
      -webkit-animation-iteration-count: infinite; 
      /*opacity: 0.0*/
  }
  
  
  @-webkit-keyframes pulsate {
        0% {-webkit-transform: scale(0.1, 0.1); opacity: 0.0;}
        50% {opacity: 1.0;}
        100% {-webkit-transform: scale(1.2, 1.2); opacity: 0.0;}
  }
  </style>

 
<style>
/* Adjustments to account for mapbox.css box-sizing rules */
.leaflet-control-zoomslider-knob { width:7px; height:2px; }
.leaflet-container .leaflet-control-zoomslider-body {
  -webkit-box-sizing:content-box;
     -moz-box-sizing:content-box;
          box-sizing:content-box;
  }
</style>


<style type="text/css">
  .card{
  border-width: 0px;
  font-size: 14px;
  margin: 0px;
  padding: 0px;
}



.card-header{
  margin-top: -11px;
  margin-left: -11px;
  margin-right: -11px;
  text-align: center;
  background-color: black;
  color: white;
}
.card-footer{
  margin-bottom: -12px;
  margin-left: -11px;
  margin-right: -11px;
  padding-right: -8px
  padding-left: -8px
}

.card-body{
  margin-left: -13px;
  margin-right: -13px;
  margin-bottom: -13px;
}
.ui-coordinates {
  background:rgba(0,0,0,0.5);
  position:absolute;
  top:280px;right:15px;
  z-index:1;
  bottom:10px;
  right:20px;
  padding:5px 10px;
  color:#fff;
  font-size:12px;
  border-radius:3px;
  max-height:220px;
 
  width:250px;
  }
</style>
<style>
.legend label,
.legend span {
  display:block;
  float:left;
  height:15px;
  width:20%;
  text-align:center;
  font-size:9px;
  color:#808080;
  }
</style>

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

 .animated-icon{
  width: 25px;
  height: 25px;
  background-color: rgba(255,255,255,0.5);
  border-radius: 50%;
  box-shadow: 0px 0px 20px red;
  transition: all 1s;
}
</style>
<style>
  
  .css-icon {

  }

  .gps_ring { 
    border: 7px solid #F30707;
     -webkit-border-radius: 30px;
     height: 48px;
     width: 48px;   
     margin-left: -10px;
     margin-top: -15px;
      -webkit-animation: pulsate 1s ease-out;
      -webkit-animation-iteration-count: infinite; 
      /*opacity: 0.0*/
  }
  
  @-webkit-keyframes pulsate {
        0% {-webkit-transform: scale(0.1, 0.1); opacity: 0.0;}
        50% {opacity: 1.0;}
        100% {-webkit-transform: scale(1.2, 1.2); opacity: 0.0;}
  }


  #divImage{

  top: 10.4%;
  width: 50.4%;
  height: 100%;
  background: #fff;
  position: fixed;
  z-index: 1060;
  right: 20%;
  right: 20%;
  visibility: hidden;
  overflow-x: auto;

  top: 0;
  left: 0;
  display: none;
  width: 100%;
  height: 100%;
  overflow: hidden;
  outline: 0;
  outline-color: currentcolor;
  outline-style: none;
  outline-width: 0px;

  overflow-x: hidden;
  overflow-y: auto;

}


  #allImage {
  position: relative;
  width: auto;
  margin: .5rem;
  pointer-events: none;

}
  </style>

 
<body class="hold-transition sidebar-mini layout-fixed">



   <div>

               <div class="card w-80" id="divIdentite">
                  <div class="card-header">
                     <span>PSR <a style="float: right" href="#" onclick="viewIdentite()"><i class="fa fa-times"></i></a></span> <br>
                  </div>
                  <div class="card-body" id="donnIdentite">
              
                  </div>
                </div>
              </div>




   <div class="card" id="divImage">
                  <div class="card-header">
                     <span>PSR <a style="float: right" href="#" onclick="viewImage()"><i class="fa fa-times"></i></a></span> <br>
                  </div>
                  <div class="card-body" id="allImage">
                  </div>
                </div>
              </div>
  


 <audio style="display: none;" id="xhhh"  controls src="<?=base_url('uploads/sons.mpga')?>"  >
            <code>audio</code>
</audio>
  <div class="wrapper">

    <!-- Navbar -->
    <?php include VIEWPATH.'templates/navbar.php'; ?>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include VIEWPATH.'templates/sidebar.php'; ?>



       <div class="card" id="divImage">
                  <div class="card-header">
                     <span>PSR <a style="float: right; color: #fff;font-size: 20px;" href="#" onclick="viewImage()"><i class="fa fa-times"></i></a></span> <br>
                  </div>
                  <div class="card-body" id="allImage">
                  </div>
                </div>
              </div>
  <script type="text/javascript">
                function viewImage(){
                  $('#divImage').delay(100).hide('show')
                }

                function showviewImage(src){
                  $('#allImage').html("");
                  var img=src.split('#')
                  var imgsrc=""
                  for (var i = 0; i < img.length; i++) {
                   // alert(img[i]);
                   imgsrc+='<img   class="card-img-top" src="'+img[i]+'">'
                 }
                 imgsrc+=""
                 $("#divImage").css("visibility", "visible");
                 $('#divImage').delay(100).show('hide')

                 $('#allImage').html(imgsrc);
                  //document.getElementById('imgesss').src = src
                  console.log(imgsrc)
                }


              </script>


               <script type="text/javascript">

                  function viewIdentite(){
                  //$('#divIdentite').delay(100).hide('show')
                  $("#divIdentite").css("visibility", "hidden")
                }
                  function getIdentite(id){
                  // alert(id)
                    $('#divIdentite').delay(100).show('hide')
                  $("#divIdentite").css("visibility", "visible")

                  $.ajax({
                    url : "<?=base_url()?>PSR/Historique/getIdentite/"+id,
                    type : "GET",
                    dataType: "JSON",
                    success:function(data) {
                     $('#donnIdentite').html(data.views_detail)
                   },
                   error:function() {

                    $('#divIdentite').html('<div class="alert alert-danger">Erreur : Impossible d\'afficher cette page! Veuillez réessayer</div>');
                       
                   $('#divIdentite').delay(100).hide('show')
                  }
                });

                }
              </script>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-8">
             <h4 class="m-0">Centre de situation</h4>
           </div><!-- /.col -->

           
           <div class="col-sm-4 text-right">


            <span style="margin-right: 15px">
              <div class="row">
              <div class="col-sm-6" style="float:right;">
              </div>

              </div>
            </span>

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">

        <div class="col-md-12 col-xl-12 grid-margin stretch-card">

          <div class="card">
        
            <div class="card-body">
      

                <?= $this->session->flashdata('message');?>

                <div id="reload_page">
              <div class="row">
              <div class="col-md-12">
                <center>

                  <img height="50" src="<?php echo base_url() ?>upload/reload.gif">
               
                </center>
              </div>
            </div>


            </div>

             
           
          <div id="mapview">

         </div>

         

                
              </div>


              <!--  VOS CODE ICI  -->



            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>          
</div>


</section>


<!-- /.content -->
</div>

</div>
</div>







<!-- MODAL POUR LE DETAIL -->
<div class="modal fade" id="detailControl">
 <div class="modal-dialog modal-lg" >
   <div class="modal-content">
     <div class="modal-header" style="background: black;">
      <div id="title"><b><h4 id="donneTitre" style="color:#fff;font-size: 18px;">Détails</h4></b></div>

      <div class="close" style="color:#fff" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </div>
   </div>
   <div class="modal-body" id="donneDeatail">
    
  
   
  </div>
  <div class="modal-footer"> 
   <!--  <button id="btn_quiter" type="button" class="btn btn-primary" class='close' data-dismiss='modal'>Quitter</button> -->
  </div>
</div>
</div>
</div>
















<!-- ./wrapper -->
<?php include VIEWPATH.'templates/footer.php'; ?>
</body>
</html>



<script type="text/javascript">


    function getDetailControl(id = 0) {


      $('#detailControl').modal()



        $.ajax({
          url : "<?=base_url()?>PSR/Historique/gethistoControl/"+id,
          type : "POST",
          dataType: "JSON",
          cache:false,
          data: {ID:id},
          beforeSend:function () { 
            $('#donneDeatail').html("");
          },
          success:function(data) {
           $('#donneDeatail').html(data.views_detail);
           $('#donneTitre').html(data.titres);
          
          },
          error:function() {
            $('#donneDeatail').html('<div class="alert alert-danger">Erreur : Impossible d\'afficher cette page! Veuillez réessayer</div>');
          }
      });
      
    }







  $(document).ready(function(){
    getMaps();
     
  
    setInterval(function() {
        check_new();

      },1000);
    });

    function getMaps(ID=null){

      
      

    var PROVINCE_ID =$('#PROVINCE_ID').val();

    var ID =ID;
   
 

        $.ajax({
          url : "<?=base_url()?>geo/Carte_Centre_Situation/get_carte/",
          type : "POST",
          dataType: "JSON",
          cache:false,
         
         data: {PROVINCE_ID:PROVINCE_ID,ID:ID},
          beforeSend:function () { 

            $('#reload_page').show();
            $('#mapview').hide();
          },
          success:function(data) {

            
            $('#mapview').show();
            var x = document.getElementById("myAudio"); 

            if (data.id==1) 
            {
              xhhh.play(); 
            }

            // alert(data.id)
           
           $('#mapview').html(data.cartes);
           // $("#d_table1").DataTable();
            $('#reload_page').hide();
          },
          error:function() {
            $('#carte_').html('<div class="alert alert-danger">Erreur : Impossible d\'afficher la carte! Veuillez réessayer</div>');
          }
      });
    }

     


  </script>

  <script type="text/javascript">


  function getincident(id) { 

   $('#title').text('Liste des incidents');

   var PROVINCE_ID=$('#PROVINCE_ID').val();


   $('#incident').modal();
   
   $("#reponse").DataTable({
    "destroy" : true,
    "processing":true,
    "serverSide":true,
    "oreder":[],
    "ajax":{
      url: "<?php echo base_url('geo/Carte_Centre_Situation/getincident/');?>"+id, 
      type:"POST",
      data : {PROVINCE_ID:PROVINCE_ID},
      beforeSend : function() {
      }
    },
    lengthMenu: [[10,50, 100, -1], [10,50, 100, "All"]],
    pageLength: 10,
    "columnDefs":[{
      "targets":[],
      "orderable":false
    }],
    dom: 'Bfrtlip',
    buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print'  ],
    language: {
      "sProcessing":     "Traitement en cours...",
      "sSearch":         "Rechercher&nbsp;:",
      "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
      "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
      "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
      "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
      "sInfoPostFix":    "",
      "sLoadingRecords": "Chargement en cours...",
      "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
      "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
      "oPaginate": {
        "sFirst":      "Premier",
        "sPrevious":   "Pr&eacute;c&eacute;dent",
        "sNext":       "Suivant",
        "sLast":       "Dernier"
      },
      "oAria": {
        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
      }
    }
  });


 }

</script>

<script type="text/javascript">
   function check_new() 
      {
        $.ajax({
          url : "<?=base_url()?>geo/Carte_Centre_Situation/check_new",
          type : "GET",
          dataType: "JSON",
          cache:false,
          success:function(data) {
           

            if (data.nbr==1) {
             
      
     
              getMaps(data.nbr);
              
            }
          }
        });
      }

</script>

    
   

<script>
    function submit_f(){
    
    myform.submit();
  }
  
</script>
   