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
          <div class="row mb-2">
            <div class="col-sm-9">
              <h4 class="m-0"><?=$title?></h4>
            </div><!-- /.col -->

             <div class="col-sm-3">
              <a href="<?= base_url('voiture/Voiture_reparation') ?>" class="btn btn-primary  float-right">
              <span class="fa fa-plus"></span>
              <span  id="hidden_nouveau">Nouvelle réparation</span>
            </a>
          </div>
            
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="col-md-12 col-xl-12 grid-margin stretch-card">

          <div class="card">
            <div class="card-body">

              <div class="col-md-12">
                <?=  $this->session->flashdata('message');?>
                <div class="table-responsive">
                        <table id='mytable' class="table table-bordered table-striped table-hover table-condensed" style="width: 100%;">
                            <thead>
                                <tr> 
                                    <th>PHOTO </th>
                                    <th>PLAQUE </th>
                                    <th>INDEX/KM</th>
                                    <th>NUMERO CHASIE</th>
                                    <th>PROPRIETAIRE</th>
                                    <th>OPTIONS</th>     
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

      <!-- Rapport partie -->
      <!-- End Rapport partie -->

    </div>
  </div>
</div>          
</div>


</section>


<!-- /.content -->
</div>

</div>
<!-- ./wrapper -->
<?php include VIEWPATH.'templates/footer.php'; ?>
</body>
</html>



<script type="text/javascript">
  function get_liste() { 
 
    var row_count=1000000; 
    var link='<?= base_url(); ?>voiture/Voiture_reparation/list_voiture_repare/';

    var table = $('#mytable').DataTable({ 
     'ajax': {
       'url': link
     }, 
     "destroy" : true, 
     'columnDefs': [{
       'stateSave': true,
       'bDestroy': true,
       'processing':true,
       'serverSide':true,
       'searchable': false,
       'orderable': false,
       'className': 'dt-body-center', 
       

     }],
     
      dom: 'Bfrtlip',
     lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
     exportOptions: { columns: [ 0, 1,2,3]  },
     pageLength: 10,
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
    },
    'order': [[1, 'asc']]
  });


    $('#mytable').on('processing.dt', function (e, settings, processing) {
      if (processing) {

      } else {
      //  $("#test").modal('hide');

    }
  });
  }
</script>

<script>
  $(document).ready(function(){ 
   
    get_liste();
  });
</script>

<script>
$(document).ready(function(){ 
    $('#message').delay(5000).hide('slow');
    });
</script>
