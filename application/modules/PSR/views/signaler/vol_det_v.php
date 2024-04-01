<section class="content" style="background-color: #f1f1f100;">
  <div class="col-md-12 col-xl-12 grid-margin stretch-card">
  <div class="container-fluid">
    <div class="row">
      <input type="hidden" name="id" id="id" value="<?= $alerte['ID_TAMPO_PJ']?>">
      <div class="col">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
          <label for="nom">Civil</label>
            
         </div>    
      <div class="col-md-6">
      <?= $alerte['NOM_PROPRIETAIRE']?>
      </div>
      

    </div>
    <div class="row">
      <div class="col-md-6">
          <label for="nom">Date du vol</label>
            
      </div>    
      <div class="col-md-6">
        <?= $alerte['dat']?>
      </div>
      

    </div>

    <div class="row">
      <div class="col-md-6">
          <label for="nom">Permis</label>
            
      </div>    
      <div class="col-md-6">
          <?= $alerte['NUMERO_PERMIS']?>
      </div>

    </div>
    <div class="row">
      <div class="col-md-6">
          <label for="nom">Plaque</label>
            
      </div>    
      <div class="col-md-6">
          <?= $alerte['NUMERO_PLAQUE']?>
      </div>

    </div>
    <div class="row">
      <div class="col-md-6">
          <label for="nom">N° de Série</label>
            
      </div>    
      <div class="col-md-6">
          <?= $alerte['NUMERO_SERIE']?>
      </div>

    </div>
    <div class="row">
      <div class="col-md-6">
          <label for="nom">Marque</label>
            
      </div>    
      <div class="col-md-6">
          <?= $alerte['MARQUE_VOITURE']?>
      </div>

    </div>
    <div class="row">
      <div class="col-md-6">
          <label for="nom">Date de déclaration</label>
            
      </div>    
      <div class="col-md-6">
          <?= $alerte['date']?>
      </div>

    </div>
    <div class="row">
      <div class="col-md-6">
        <label>Confirmation</label>
      </div>
      <?php 

      $valide = '';
    if($alerte['VALIDATION'] == 1){
      $valide = "<span class ='btn-outline-info'>Validé</span>";
    }
    else{
      $valide = "<span class ='btn-outline-danger'>Non validé</span>";

    }


       ?>
      <div class="col-md-6">
        <?= $valide?>
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-6">
        <label>Statut</label>
      </div>
      <?php 

      $trouve = '';
      if($alerte['STATUT'] == 1){
          $trouve = "<span class ='btn-outline-info'>Trouvée</span>";
      }
      else{
         $trouve = "<span class ='btn-outline-danger'>Non trouvée</span>";

      }


       ?>
      <div class="col-md-6">
        <?= $trouve?>
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-6">
        <label>Confirmé par</label>
      </div>
      <div class="col-md-6">
        <?= $alerte['STATUT_TRAITEM']?>
      </div>
      
    </div>
    <div class="row">
      <div class="col-md-6">
        <label>Image</label>
      </div>
      <div class="col-md-6">
        <img style="height: 70px;width: 70px;" src="<?= $alerte['IMAGE_1']?>">
        <img style="height: 70px;width: 70px;"src="<?= $alerte['IMAGE_2']?>">

      </div>
      
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-success" onclick="confirmer()" id="conf" data-dismiss="modal">Confirmer</button>
      <button type="button" class="btn btn-secondary"onclick="rejet()" id="rej" data-dismiss="modal">Rejetter</button>
      
    </div>

    </div>
  </div>
</div>
</section>

 <!--  Script de validation -->

  <script type="text/javascript">

  function confirmer()
  {

     var id= $('#id').val();
    
    $('#conf').text('Traiter');
    $('#conf').attr('abled',true);

    alert(id);
    var url;  
    url = "<?php echo base_url('PSR/Vol_Controller/traiter_conf')?>/"+id;
   

    $.ajax({
      url:url,
      type:"POST",
      contentType:false,
      processData:false,
      dataType:"JSON",
      success:function(data)
      {

        alert_notify('success','Accident','Opération effectuée avec succès','1');
        window.location.reload();
 
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        //alert('Erreur');
        $('#conf').text('Traiter');
        $('#conf').attr('disabled',false);

      }
    })
    
  }
  
</script>

<!-- Script pour rejetter -->

 <script type="text/javascript">

  function rejet()
  {

     var id= $('#id').val();
    
    $('#rej').text('Traiter');
    $('#rej').attr('abled',true);

    alert(id);
    var url;  
    url = "<?php echo base_url('PSR/Vol_Controller/traiter_rejet')?>/"+id;
   

    $.ajax({
      url:url,
      type:"POST",
      contentType:false,
      processData:false,
      dataType:"JSON",
      success:function(data)
      {

        alert_notify('success','Accident','Opération effectuée avec succès','1');
        window.location.reload();
 
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        //alert('Erreur');
        $('#rej').text('Traiter');
        $('#rej').attr('disabled',false);

      }
    })
    
  }

</script>

<!-- script marque comme terminé -->



 

