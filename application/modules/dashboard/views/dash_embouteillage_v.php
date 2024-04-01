<!DOCTYPE html>
<html lang="en">
<?php include VIEWPATH.'templates/header_reporting.php'; ?> 


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
            <div class="col-sm-6">
              <h1 class="m-0"><?=$title?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6 text-right">


              <span style="margin-right: 15px"> </span>

            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->


      <section class="content">

        <div class="col-md-12 col-xl-12 grid-margin stretch-card">

          <div class="card">
            <div class="card-body">
             <form action="<?=base_url('dashboard/Dashboard_embouteillage/index')?>" method='post' id="myform">
              <div class="row"> 
               <div class="form-group col-md-3">
                <label>Date</label>

                <select class="form-control" onchange="get_rapport()" name="date" id="date" >
                  <option value="">Sélectionner</option>
                  <?php

                  foreach ($date as $value){
                    if ($value['date'] == set_value('date'))
                      {?>
                        <option value="<?=$value['date']?>" selected><?=$value['date']?></option>
                      <?php } else{ ?>
                        <option value="<?=$value['date']?>"><?=$value['date']?></option>
                      <?php } 
                    } ?>
                  </select>
                </div> 

                <div class="form-group col-md-3">
                  <label>Validité</label>

                  <select class="form-control" onchange="get_rapport()" name="VALIDATION" id="VALIDATION" >
                    <option value="">Sélectionner</option>
                    <?php

                    foreach ($validate as $value){
                      if ($value['VALIDATION'] == set_value('VALIDATION'))
                        {?>
                          <option value="<?=$value['VALIDATION']?>" selected><?=$value['VALi']?></option>
                        <?php } else{ ?>
                          <option value="<?=$value['VALIDATION']?>"><?=$value['VALi']?></option>
                        <?php } 
                      } ?>
                    </select>
                  </div> 
                </div>
              </form>
              <div class="modal fade" id="myModal2" role="dialog">
                <div class="modal-dialog modal-lg" style ="width:100%">
                  <div class="modal-content  modal-lg">
                    <div class="modal-header">
                      <h4 class="modal-title"><span id="titre"></span></h4>
                    </div>
                    <div class="modal-body">
                      <div class="table-responsive">
                        <table id='mytable2' class='table table-bordered table-striped table-hover table-condensed' style="width:100%">
                          <thead>

                           <th>#</th>
                           <th>NOM_CHAUSSE</th>
                           <th>VALIDATION</th>
                           <th>CAUSE</th>
                           <th>DATEV</th>
                         </thead>
                       </table>
                     </div>

                   </div>
                   <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>



            <div class="card-body">
              <div class="row">

                <div class="col-md-12" id="container" style="border: 1px solid #d2d7db;"></div>


              </div>
            </div>
          </div>





        </div>
      </div>
    </div>

  </div>



</div>
</div>
</div>          
</div>


</section>

</div>

</div>
<!-- ./wrapper -->
<?php include VIEWPATH.'templates/footer.php'; ?>
</body>


<script type="text/javascript">
 function get_rapport(){
  myform.submit()
   // PROVINCE_ID:$('#PROVINCE_ID').val(),
 }

</script>

<script>


// Set up the chart
Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
    text: '<b> <?=$nombre;?> </b> Embouteillages signalés'
  },
  subtitle: {
    text: ''
  },
  credits: {
    enabled: true,
    href: "",
    text: "MEDIABOX"
  },

  xAxis: {
    type: 'category',
    labels: {
      rotation: -15,
      style: {
        fontSize: '13px',
        fontFamily: 'Verdana, sans-serif'
      }
    }
  },
  yAxis: {
    min: 0,
    title: {
      text: 'Nbre des embouteillages'
    }
  },
  legend: {
    enabled: true
  },
  tooltip: {
    pointFormat: 'embouteillage'
  },

  credits: {
    enabled: true,
    href: "",
    text: "MEDIABOX"
  },
  plotOptions: {  
    column: {
     cursor:'pointer',
     depth: 25,
     point:{
      events: {
        click: function(e)
        {

         $("#titre").html("Liste d'immatriculation");

         $("#myModal2").modal();


         var row_count ="1000000";
         $("#mytable2").DataTable({
          "processing":true,
          "serverSide":true,
          "bDestroy": true,
          "oreder":[],
          "ajax":{
            url: "<?=base_url('dashboard/Dashboard_embouteillage/detailChausse')?>",
            type:"POST",
            data:{
              key:this.key,
            }
          },
          lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
          pageLength: 10,
          "columnDefs":[{
            "targets":[],
            "orderable":false
          }],

          dom: 'Bfrtlip',
          buttons: [
          'excel', 'print','pdf'
          ],
          language: {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher&nbsp;:",
            "sLengthMenu":     "Afficher MENU &eacute;l&eacute;ments",
            "sInfo":           "Affichage de l'&eacute;l&eacute;ment START &agrave; END sur TOTAL &eacute;l&eacute;ments",
            "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
            "sInfoFiltered":   "(filtr&eacute; de MAX &eacute;l&eacute;ments au total)",
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
     }
   },
   dataLabels: {
     enabled: true
   },
   showInLegend: true
 }
},

series: [{
  name: 'Embouteillages',
  color: '#333',
  data: [<?=$donne?>],


}]
});

</script>

</html>