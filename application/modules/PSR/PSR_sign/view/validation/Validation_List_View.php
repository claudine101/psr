<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH . 'templates/header.php'; ?>
<style type="text/css">
  .mapbox-improve-map {
    display: none;
  }

  .leaflet-control-attribution {
    display: none !important;
  }

  .leaflet-control-attribution {
    display: none !important;
  }


  .mapbox-logo {
    display: none;
  }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include VIEWPATH . 'templates/navbar.php'; ?>

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include VIEWPATH . 'templates/sidebar.php'; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-8">
            </div><!-- /.col -->
              <div class="col-sm-8 text-left">
            <div class="row">
              <div class="col-md-6">
                 <h4 class="m-0"><?= $title ?></h4>
             </div>
           
              <div class="col-md-2">
               <a href="#" onclick='liste_nouveau()' id="1"  style="width: 100px;" class='btn btn-outline-primary'>
                  Nouveau 
                  <span class="badge badge-danger"><?=$Nbre_nouveau?></span>
                  
                </a>
             </div>
             <div class="col-md-2">
               <a href="#" id="2" onclick='liste_valide()' style="width:  80px;" class='btn btn-outline-primary'>
                 Valider
                  <span class="badge badge-danger"><?=$Nbre_valide?></span>
                </a>
             </div>
              <div class="col-md-2">
               <a href="#" id="3" onclick='liste_rejette()' style="width:   80px;" class='btn btn-outline-primary'>
                 Rejetter
                  <span class="badge badge-danger"><?=$Nbre_rejette?></span>
                </a>
             </div>
          </div>
        </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
          <div class="col-md-12 col-xl-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                
                <div class="col-md-12 table-responsive">
                <div id="signale_nouvau">
                  <table id='nouveau' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
                    <thead>
                      <tr>
                        <td>AUTEUR</td>
                        <td>CATEGORIE</td>
                        <td>PHOTO</td>
                        <td>STATUT</td>
                        <td>DATE_SIGNAL</td>
                        <td>OPTIONS</td>

                      </tr>
                    </thead>
                  </table>
                  </div>

                   <div id="signale_valide" style="display: none;">
                  <table id='valide' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
                    <thead>
                      <tr>
                        <td>AUTEUR</td>
                        <td>CATEGORIE</td>
                        <td>PHOTO</td>
                        <td>STATUT</td>
                        <td>DATE_SIGNAL</td>
                      </tr>
                    </thead>
                  </table>
                  </div>

                  <div id="signale_rejette" style="display: none;">
                  <table id='rejette' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
                    <thead>
                      <tr>
                        <td>AUTEUR</td>
                        <td>CATEGORIE</td>
                        <td>PHOTO</td>
                        <td>STATUT</td>
                        <td>DATE_SIGNAL</td>
                      </tr>
                    </thead>
                  </table>
                  </div>
                </div>
                <!--  VOS CODE ICI  -->
              </div>
            </div>
          </div>

      </div>

      <!-- PSR partie -->

      <!-- End PSR partie -->

    </div>
  </div>
  </div>
  </div>
  </section>
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
  <!-- /.content -->
</div>
</div>

  <!-- ./wrapper -->
  <?php include VIEWPATH . 'templates/footer.php'; ?>
</body>

</html>
<script type="text/javascript">
  $(document).ready(function() {
    liste_nouveau();
  });
  function subForm(id)
 {
    $('#myForm'+id).submit()
 }
 function subForm1(id)
 {
    $('#myForm1'+id).submit()
 }
  function liste_nouveau()
  {
    var btn1=document.getElementById("1")
    var btn2=document.getElementById("2")
    var btn3=document.getElementById("3")
 
    btn1.className = "btn btn-primary";
    btn2.className = "btn btn-outline-primary";
    btn3.className = "btn btn-outline-primary";

    $('#message').delay('slow').fadeOut(3000);
    $("#signale_nouvau").show()
    $("#signale_valide").hide()
    $("#signale_rejette").hide()

  $("#nouveau").DataTable(
  {
  "destroy" : true,
  "processing":true,
  "serverSide":true,
  "oreder":[],
  "ajax":{
  url: "<?php echo base_url('PSR/Validation_signalement/listing/'); ?>",
  type:"POST",
  data : { },
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
  buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ],
  language: {
  "sProcessing": "Traitement en cours...",
  "sSearch": "Rechercher&nbsp;:",
  "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
  "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
  "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
  "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
  "sInfoPostFix": "",
  "sLoadingRecords": "Chargement en cours...",
  "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
  "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
  "oPaginate": {
  "sFirst": "Premier",
  "sPrevious": "Pr&eacute;c&eacute;dent",
  "sNext": "Suivant",
  "sLast": "Dernier"
  },
  "oAria": {
  "sSortAscending": ": activer pour trier la colonne par ordre croissant",
  "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
  }
  }
  });
  }
  function liste_valide()
  {
    var btn1=document.getElementById("1")
    var btn2=document.getElementById("2")
    var btn3=document.getElementById("3")
 
    btn1.className = "btn btn-outline-primary";
    btn2.className = "btn btn-primary";
    btn3.className = "btn btn-outline-primary";

  $('#message').delay('slow').fadeOut(3000);
    $("#signale_nouvau").hide()
    $("#signale_valide").show()
    $("#signale_rejette").hide()
  $("#valide").DataTable(
  {
  "destroy" : true,
  "processing":true,
  "serverSide":true,
  "oreder":[],
  "ajax":{
  url: "<?php echo base_url('PSR/Validation_signalement/listing_valide/'); ?>",
  type:"POST",
  data : { },
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
  buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ],
  language: {
  "sProcessing": "Traitement en cours...",
  "sSearch": "Rechercher&nbsp;:",
  "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
  "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
  "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
  "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
  "sInfoPostFix": "",
  "sLoadingRecords": "Chargement en cours...",
  "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
  "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
  "oPaginate": {
  "sFirst": "Premier",
  "sPrevious": "Pr&eacute;c&eacute;dent",
  "sNext": "Suivant",
  "sLast": "Dernier"
  },
  "oAria": {
  "sSortAscending": ": activer pour trier la colonne par ordre croissant",
  "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
  }
  }
  });
  }
  function liste_rejette()
  {
    var btn1=document.getElementById("1")
    var btn2=document.getElementById("2")
    var btn3=document.getElementById("3")
 
    btn1.className = "btn btn-outline-primary";
    btn2.className = "btn btn-outline-primary";
    btn3.className = "btn btn-primary";

  $('#message').delay('slow').fadeOut(3000);
   $("#signale_nouvau").hide()
    $("#signale_valide").hide()
    $("#signale_rejette").show()
  $("#rejette").DataTable(
  {
  "destroy" : true,
  "processing":true,
  "serverSide":true,
  "oreder":[],
  "ajax":{
  url: "<?php echo base_url('PSR/Validation_signalement/listing_rejette/'); ?>",
  type:"POST",
  data : { },
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
  buttons: [ 'copy', 'csv', 'excel', 'pdf', 'print' ],
  language: {
  "sProcessing": "Traitement en cours...",
  "sSearch": "Rechercher&nbsp;:",
  "sLengthMenu": "Afficher _MENU_ &eacute;l&eacute;ments",
  "sInfo": "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
  "sInfoEmpty": "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
  "sInfoFiltered": "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
  "sInfoPostFix": "",
  "sLoadingRecords": "Chargement en cours...",
  "sZeroRecords": "Aucun &eacute;l&eacute;ment &agrave; afficher",
  "sEmptyTable": "Aucune donn&eacute;e disponible dans le tableau",
  "oPaginate": {
  "sFirst": "Premier",
  "sPrevious": "Pr&eacute;c&eacute;dent",
  "sNext": "Suivant",
  "sLast": "Dernier"
  },
  "oAria": {
  "sSortAscending": ": activer pour trier la colonne par ordre croissant",
  "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
  }
  }
  });
  }
  </script>