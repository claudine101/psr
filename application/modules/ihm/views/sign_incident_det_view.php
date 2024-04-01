<section class="content" style="background-color: #f1f1f100;">
          <div class="col-md-12 col-xl-12 grid-margin stretch-card">
                    <div class="container-fluid">
                              <div class="row">
                                        <div class="col">
                                        </div>
                              </div>
                              <div class="row">
                                        <input type="hidden" name="id" id="id" value="<?= $alerte['ID_SIGN_INCIDENT'] ?>">
                                        <div class="col-md-6">
                                                  <label for="nom">Civil</label>

                                        </div>
                                        <div class="col-md-6">
                                                  <?= $alerte['NAME'] ?>
                                        </div>


                              </div>
                              <div class="row">
                                        <div class="col-md-6">
                                                  <label for="nom">Date</label>

                                        </div>
                                        <div class="col-md-6">
                                                  <?= $alerte['date'] ?>
                                        </div>


                              </div>
                              <div class="row">
                                        <div class="col-md-6">
                                                  <label>Confirmation</label>
                                        </div>
                                        <?php

                                        $valide = '';
                                        if ($alerte['VALIDATION'] == 1) {
                                                  $valide = "<span class ='btn-outline-info'>Validé</span>";
                                        } else {
                                                  $valide = "<span class ='btn-outline-danger'>Non validé</span>";
                                        }


                                        ?>
                                        <div class="col-md-6">
                                                  <?= $valide ?>
                                        </div>

                              </div>
                              <div class="row">
                                        <div class="col-md-6">
                                                  <label>Confirmé par</label>
                                        </div>
                                        <div class="col-md-6">
                                                  <?= $alerte['STATUT_TRAITEM'] ?>
                                        </div>

                              </div>

                              <div class="row">
                                        <div class="col-md-6">
                                                  <label for="nom">Commentaire</label>
                                                  <p>
                                                            <?= $alerte['DESCRIPTION'] ?>
                                                  </p>
                                        </div>

                              </div>
                              <div class="row">
                                        <div class="col-md-6">
                                                  <label>Images</label>
                                                  <div class="row">
                                                            <?php if ($alerte['IMAGE_1']) : ?>
                                                                      <div class="col-sm">
                                                                                <img style="height: 150px; width: 100%; max-width: 50%" src="<?= $alerte['IMAGE_1'] ?>">
                                                                      </div>
                                                            <?php endif ?>
                                                            <?php if ($alerte['IMAGE_2']) : ?>
                                                                      <div class="col-sm">
                                                                                <img style="height: 150px; width: 100%; max-width: 50%" src="<?= $alerte['IMAGE_2'] ?>">
                                                                      </div>
                                                            <?php endif ?>
                                                            <?php if ($alerte['IMAGE_3']) : ?>
                                                                      <div class="col-sm">
                                                                                <img style="height: 150px; width: 100%; max-width: 50%" src="<?= $alerte['IMAGE_3'] ?>">
                                                                      </div>
                                                            <?php endif ?>
                                                  </div>
                                        </div>

                              </div>

                              <div class="modal-footer">
                                        <button type="button" class="btn btn-success" onclick="confirmer()" id="conf" data-dismiss="modal">Confirmer</button>
                                        <button type="button" class="btn btn-secondary" onclick="rejet()" id="rej" data-dismiss="modal">Rejeter</button>

                              </div>










                    </div>
          </div>
          </div>
</section>

<!--  Script de validation -->

<script type="text/javascript">
          function confirmer() {

                    var id = $('#id').val();

                    $('#conf').text('Traiter');
                    $('#conf').attr('abled', true);


                    var url;
                    url = "<?php echo base_url('ihm/Sign_inciden_naturel/traiter_conf') ?>/" + id;


                    $.ajax({
                              url: url,
                              type: "POST",
                              contentType: false,
                              processData: false,
                              dataType: "JSON",
                              success: function(data) {

                                        alert_notify('success', 'Accident', 'Opération effectuée avec succès', '1');
                                        window.location.reload();

                              },
                              error: function(jqXHR, textStatus, errorThrown) {
                                        //alert('Erreur');
                                        $('#conf').text('Traiter');
                                        $('#conf').attr('disabled', false);

                              }
                    })

          }
</script>

<!-- Script pour rejetter -->

<script type="text/javascript">
          function rejet() {

                    var id = $('#id').val();

                    $('#rej').text('Traiter');
                    $('#rej').attr('abled', true);
                    var url;
                    url = "<?php echo base_url('ihm/Sign_inciden_naturel/traiter_rejet') ?>/" + id;


                    $.ajax({
                              url: url,
                              type: "POST",
                              contentType: false,
                              processData: false,
                              dataType: "JSON",
                              success: function(data) {

                                        alert_notify('success', 'Accident', 'Opération effectuée avec succès', '1');
                                        window.location.reload();

                              },
                              error: function(jqXHR, textStatus, errorThrown) {
                                        //alert('Erreur');
                                        $('#rej').text('Traiter');
                                        $('#rej').attr('disabled', false);

                              }
                    })

          }
</script>