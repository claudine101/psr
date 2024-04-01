<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'templates/header.php'; ?>


            <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
           <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>



    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

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
  </style>

 
<body class="hold-transition sidebar-mini layout-fixed">


 <audio style="display: none;" id="xhhh"  controls src="<?=base_url('uploads/sons.mpga')?>"  >
            <code>audio</code>
</audio>
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
          <div class="row mb-2">
            <div class="col-sm-8">
             <h4 class="m-0"><b>Postes d'affectation des fonctionnaires de la PNB</b></h4>
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
   <div class="modal-content modal-lg">
     <div class="modal-header" style="background: black;">
      <div id="title"><b><h4 id="donneTitre" style="color:#fff;font-size: 18px;">Détails</h4></b></div>

      <div class="close" style="color:#fff" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </div>
   </div>
   <div class="modal-body" id="donnePerformance">
    
    </div>
  <div class="modal-footer"> 
   <!--  <button id="btn_quiter" type="button" class="btn btn-primary" class='close' data-dismiss='modal'>Quitter</button> -->
  </div>
</div>
</div>
</div>




<!-- MODAL POUR LE DETAIL -->
<div class="modal fade" id="MessagePolice">
 <div class="modal-dialog" >
    <div class="modal-content">
     <div class="modal-header" style="background: black;">
      <div id="title"><b><h4 id="donneTitre" style="color:#fff;font-size: 18px;">Nouveau message</h4></b></div>

      <div class="close" style="color:#fff" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </div>
   </div>
   <div class="modal-body" id="donneDeatail">

  <form>
    <input type="hidden" class="form-control" id="IdAgents">
    <div class="form-group">
      <label for="exampleFormControlInput1">Contact</label>
      <input type="number" class="form-control" id="phoneNumber" placeholder="71586523" readonly>
    </div>
   
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Message</label>
      <textarea class="form-control" id="MessageText" rows="3" placeholder="Message..."></textarea>
    </div>
  </form>
  

  </div>
  <div class="modal-footer"> 
     <button id="btn_quiter" type="button" class="btn btn-primary" onclick="sendMessage()">Envoyer</button>
    <!-- <button id="btn_quiter" type="button" class="btn btn-primary" class='close' data-dismiss='modal'></button> -->
  </div>
</div>
</div>
</div>
















<!-- ./wrapper -->
<?php include VIEWPATH.'templates/footer.php'; ?>
</body>
</html>



<script type="text/javascript">
  




  function sendMessage(){
    
    if ($('#MessageText').val() == ''){

      $('#MessageText').focus()

    }else{

      $.ajax({
          url : "<?=base_url()?>geo/Elements_Pnb/sendMessage/",
          type : "POST",
          dataType: "JSON",
          cache:false,
          data: {IdAgents:$('#IdAgents').val(),phoneNumber:$('#phoneNumber').val(),MessageText:$('#MessageText').val()},

          beforeSend:function () { 
            alert_encours()

          },
          success:function(data) {
            if (Number(data) == 1) {
              alert_succes("Message envoyé avec succès")
              $('#MessageText').val("")
              $('#MessagePolice').modal('hide')
            }else{
              alert_erro("Message non envoyer problème soit de connexion")
             
            }
            
           
          
          },
          error:function() {
            alert_erro("Message non envoyer problème soit de connexion")
          }
      });

    }

 
  }





  function alert_succes_chec(message){

         Swal.fire("Vérification de la facture avec succès!", message, "success");
 }


 function alert_succes(message){

         Swal.fire(message, '', "success");
 }



 function alert_erro(message){

         Swal.fire({
                   icon: 'error',
                   title: message,
                   text: 'Veillez réessayer plus tard merci!',
                   //footer: '<a href="<?=base_url()?>?</a>'
                 })
 }


  function alert_encours(message = ""){

         Swal.fire({
                 title: 'Connexion encours !',
                 html: 'Veillez patienter <b></b>  sécondes prés ...',
                 timer: 6000,
                 timerProgressBar: true,
                 didOpen: () => {
                   Swal.showLoading()
                   const b = Swal.getHtmlContainer().querySelector('b')
                   timerInterval = setInterval(() => {
                     b.textContent = Swal.getTimerLeft()
                   }, 100)
                 },
                 willClose: () => {
                   clearInterval(timerInterval)
                 }
               }).then((result) => {
               /* Read more about handling dismissals below */
                 if (result.dismiss === Swal.DismissReason.timer) {
                  console.log('I was closed by the timer')
                 }
               })
 }



  function get_detail_performance(id){

        $('#detailControl').modal()


        $.ajax({
          url : "<?=base_url()?>ihm/Performance_Police/getperformance/"+id,
          type : "POST",
          dataType: "JSON",
          cache:false,
          data: {ID:id},
          beforeSend:function () { 
            $('#donnePerformance').html('<center><font color="#000"><i class="fas fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span></font></center>');
          },
          success:function(data) {
           $('#donnePerformance').html(data.cartes);
           //$('#perdoTitre').html(data.titres);
          
          },
          error:function() {
            $('#donnePerformance').html('<div class="alert alert-danger">Erreur : Impossible d\'afficher cette page! Veuillez réessayer</div>');
          }
      });
   }


   function get_detail_Pdl(id = 0,phone = 0){

        // alert();

         $('#MessagePolice').modal()
        
         $('#phoneNumber').val(phone)

         $('#IdAgents').val(id)

      
     
    
    //window.location.href = '<?=base_url("ihm/Performance_Police/index/")?>'+id;
  }

  $(document).ready(function(){
    getMaps();
     
  
     setInterval(function() {
       $('#MessageText').focus()

      },1000);


     });

    function getMaps(ID=null){

      
      

    var PROVINCE_ID =$('#PROVINCE_ID').val();

    var ID =ID;
   
 

        $.ajax({
          url : "<?=base_url()?>geo/Elements_Pnb/get_carte/",
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
      url: "<?php echo base_url('geo/Elements_Pnb/getincident/');?>"+id, 
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
          url : "<?=base_url()?>geo/Elements_Pnb/check_new",
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
   