<!DOCTYPE html>
<html lang="en">
<head>
  <?php include VIEWPATH.'includes/header.php'; ?>
</head>
<body>
  <?php include VIEWPATH.'includes/loadpage.php'; ?>  
  <div id="main-wrapper">
    <?php include VIEWPATH.'includes/navybar.php'; ?> 
    <?= include VIEWPATH.'includes/menu.php'; ?>
    <div class="content-body">
      <div class="container-fluid">
        <div class="row page-titles mx-0">
          <div class="col-sm-6 p-md-0">
            <div class="welcome-text">
              <h4 style='color:#007bac'><?=$title;?></h4>
            </div>
          </div>
          <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <button class="btn btn-primary"><a style="color: white;" href="<?php echo base_url() ?>administration/User_Profil_New"><span class="fa fa-plus"></span> Nouveau</a></button>
          </div>
        </div>

        <div class="row">

         <div class="col-xl-12 col-xxl-12">
          <div class="card">
            
            <div class="card-body">
              <div class="basic-form">
                
                <?= $this->session->flashdata('message') ?>

                <?= $this->table->generate($data); ?> 
                
              </div>
            </div>
          </div>
        </div>
      </div>


      <?php include VIEWPATH.'includes/scripts_js.php'; ?>
    </body>
    <?php include VIEWPATH.'includes/legende.php';?>
    </html>



    <script type="text/javascript">
      $('#message').delay('slow').fadeOut(3000);
      $(document).ready(function(){
        var row_count ="1000000";
        $("#mytable").DataTable({

          "processing":true,
          "serverSide":false,
          "order":[[0, "asc"]],
          
          lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
          pageLength: 10,
          "columnDefs":[{
            "targets":[],
            "orderable":false
          }],

          dom: 'Bfrtlip',
          buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
          ],
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
      });
    </script>