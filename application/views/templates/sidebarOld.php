<style type="text/css">
  .bordersolid {
    border-style: solid;
    border-color: gray;
    border-width: 1px;
  }

  .tooltipp {
    display: inline-block;
    position: relative;
    border-bottom: 1px dotted #666;
    text-align: left;
  }

  .tooltipp .topp {
    min-width: 200px;
    top: -20px;
    left: 50%;
    transform: translate(-50%, -100%);
    padding: 10px 20px;
    color: #111111;
    background-color: #EEEEEE;
    font-weight: normal;
    font-size: 13px;
    border-radius: 8px;
    position: absolute;
    z-index: 99999999;
    box-sizing: border-box;
    box-shadow: 0 1px 8px #FFFFFF;
    display: none;
  }

  .tooltipp:hover .topp {
    display: block;
  }

  .tooltipp .topp i {
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -12px;
    width: 24px;
    height: 12px;
    overflow: hidden;
  }

  .tooltipp .topp i::after {
    content: '';
    position: absolute;
    width: 12px;
    height: 12px;
    left: 50%;
    transform: translate(-50%, -50%) rotate(45deg);
    background-color: #EEEEEE;
    box-shadow: 0 1px 8px #FFFFFF;
  }

  .content-wrapper {
    /*background-color: #312f568f;*/
    background-image: url('<?= base_url() ?>/upload/policeTrois.png');
    background-size: cover;
    background-repeat: no-repeat;
    height: 100%;
    margin: 0;
    padding: 0;
  }

  #title {
    color: #fff;
  }

  h1 {
    color: #fff;
  }

  h4 {
    color: #fff;
  }

  h5 {
    color: #000;
  }

  h3 {
    color: #fff;
  }

  h2 {
    color: #fff;
  }

  .list-group-item-heading {
    color: #000;
  }

  strong {
    color: #000;
  }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <img height="13.5%" width="100%" src="<?= base_url() ?>upload/bannerUne.png" alt="" class="brand-image">
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <a href="#" class="d-block"><i class="fa fa-user"></i> <?= $this->session->userdata('USER_NAME') ?></a>
      </div>
      <!--  <div class="info">
       
      </div> -->
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">


      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if ($this->router->class == 'Utilisateur' || $this->router->class == 'Citoyen' || $this->router->class == 'Profil') echo 'active'; ?>">
              <i class="nav-icon fa fa-user-md"></i>
              <p>
                Administration
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url('PSR/Utilisateur/index') ?>" class="nav-link <?php if ($this->router->class == 'Utilisateur') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Utilisateur </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('ihm/Citoyen/index') ?>" class="nav-link <?php if ($this->router->class == 'Citoyen') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Citoyens </p>
                </a>
              </li>


              <li class="nav-item">
                <a href="<?= base_url('PSR/Profil/index') ?>" class="nav-link <?php if ($this->router->class == 'Profil') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profiles</p>
                </a>
              </li>

              <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
                <li class="nav-item">
                  <a href="<?= base_url('PSR/Droit/index') ?>" class="nav-link <?php if ($this->router->class == 'Droit') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Droits</p>
                  </a>
                </li>
              <?php } ?>

            </ul>

          </li>

        <?php } ?>


















        <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>


          <li class="nav-item">
            <a href="#" class="nav-link <?php if ($this->router->class == 'Otraco_Dash' || $this->router->class == 'Montant_Payer_Par_Date' || $this->router->class == 'Dashboard_Otraco') echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="#" class="nav-link <?php if ($this->router->class == 'Otraco_Dash') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Obr </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('dashboard/Dashboard_Otraco/index') ?>" class="nav-link <?php if ($this->router->class == 'Dashboard_Otraco') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assurances & controle</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('rapport/Montant_Payer_Par_Date/index') ?>" class="nav-link <?php if ($this->router->class == 'Montant_Payer_Par_Date') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Revenu PNB</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('dashboard/Dash_alert_Police/index') ?>" class="nav-link <?php if ($this->router->class == 'Dash_alert_Police') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Plaintes des citoyens</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('dashboard/Otraco_Dash/index') ?>" class="nav-link <?php if ($this->router->class == 'Otraco_Dash') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Otraco</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('rapport/NBRE_DE_VOL/index') ?>" class="nav-link <?php if ($this->router->class == 'NBRE_DE_VOL') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nbre de vol</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('dashboard/User_Policier_Dash/index') ?>" class="nav-link <?php if ($this->router->class == 'User_Policier_Dash') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PNB Dashboard</p>
                </a>
              </li>

            </ul>

          </li>
        <?php } ?>

        <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if ($this->router->class == 'Carte_Centre_Situation' || $this->router->class == 'Elements_Pnb' || $this->router->class == 'Carte_affectation_psr' || $this->router->class == 'Signalement') echo 'active'; ?>">
              <i class="nav-icon fas fa-globe-africa"></i>
              <p>
                SIG
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="<?= base_url('geo/Carte_Centre_Situation/index') ?>" class="nav-link <?php if ($this->router->class == 'Carte_Centre_Situation') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Centre de situation </p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?= base_url('geo/Elements_Pnb/index') ?>" class="nav-link <?php if ($this->router->class == 'Elements_Pnb') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Element de La PNB </p>
                  </a>
                </li>


                 <li class="nav-item">
                  <a href="<?= base_url('geo/Signalement/index') ?>" class="nav-link <?php if ($this->router->class == 'Signalement') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Signalement  </p>
                  </a>
                </li>

             

             <!--    <li class="nav-item">
                  <a href="<?= base_url('geo/Carte_affectation_psr/index') ?>" class="nav-link <?php if ($this->router->class == 'Carte_affectation_psr') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Poste PNB</p>
                  </a>
                </li> -->

              </ul>

            <?php } ?>
          </li>
        <?php } ?>

        <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>

          <li class="nav-item">
            <a href="#" class="nav-link <?php if ($this->router->class == 'Rapport') echo 'active'; ?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Rapports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?= base_url('rapport/Immatriculation/index') ?>" class="nav-link <?php if ($this->router->class == 'Immatriculation') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Immatriculation </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('rapport/Permis/index') ?>" class="nav-link <?php if ($this->router->class == 'Permis') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permis </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('rapport/Controle_technique/index') ?>" class="nav-link <?php if ($this->router->class == 'Controle_technique') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contrôle technique</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('rapport/Autres_controles_plaques/index') ?>" class="nav-link <?php if ($this->router->class == 'autres_controles_plaques') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vérification Plaques</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('rapport/Verification_journaliaire/index') ?>" class="nav-link <?php if ($this->router->class == 'Verification_journaliaire') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vérification Journaliaire</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('dashboard/Pj_declarations/index') ?>" class="nav-link <?php if ($this->router->class == 'pj_declarations') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Voiture volées</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('dashboard/Acc_Par_Chaussee/index') ?>" class="nav-link <?php if ($this->router->class == 'Acc_Par_Chaussee') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Accident par Chaussée</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('dashboard/Dashboard_embouteillage/index') ?>" class="nav-link <?php if ($this->router->class == 'Dashboard_embouteillage') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Embouteillage par Chaussée</p>
                </a>
              </li>




            </ul>

          </li>
        <?php } ?>


        <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
          <li class="nav-item">

            <a href="#" class="nav-link <?php if ($this->router->class == 'Couleur' || $this->router->class == 'Grade' || $this->router->class == 'Profil' || $this->router->class == 'Infra_infractions' ||  $this->router->class == 'Infra_peines' ||  $this->router->class == 'Autres_controles_questionnaires') echo 'active'; ?>">

              <i class="nav-icon fas fa-database"></i>
              <p>
                Données
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">


              <?php if ($this->session->userdata('INFRACTION') == 1) { ?>
                <li class="nav-item">
                  <a href="<?= base_url('PSR/Infra_infractions/index') ?>" class="nav-link <?php if ($this->router->class == 'Infra_infractions') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Infractions </p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($this->session->userdata('PEINES') == 1) { ?>
                <li class="nav-item">
                  <a href="<?= base_url('PSR/Infra_peines/index') ?>" class="nav-link <?php if ($this->router->class == 'Infra_peines') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Peines</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($this->session->userdata('QUESTIONNAIRE') == 1 && $this->session->userdata('PSR_ELEMENT') == 1) { ?>
                <li class="nav-item">
                  <a href="<?= base_url('PSR/Autres_controles_questionnaires/index') ?>" class="nav-link <?php if ($this->router->class == 'Autres_controles_questionnaires') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Autres Infractions</p>
                  </a>
                </li>
              <?php  } ?>



              <li class="nav-item">
                <a href="<?= base_url('ihm/Couleur/index') ?>" class="nav-link <?php if ($this->router->class == 'Couleur') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Couleur Voiture</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('ihm/Grade/index') ?>" class="nav-link <?php if ($this->router->class == 'Grade') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Grade PNB</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="<?= base_url('ihm/Gravite/index') ?>" class="nav-link <?php if ($this->router->class == 'Gravite') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gravité d'Accident</p>
                </a>
              </li>


            </ul>

          </li>

        <?php } ?>



        <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
          <li class="nav-item">
            <a href="<?= base_url('PSR/Historique/index') ?>" class="nav-link <?php if ($this->router->class == 'Historique') echo 'active'; ?>">
              <i class="nav-icon fa fa-history" aria-hidden="true"></i>
              <p>Vérification PNB</p>
            </a>
          </li>
        <?php } ?>



        <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>

          <li class="nav-item">
            <a href="#" class="nav-link <?php if ($this->router->class == 'Civil_alert' || $this->router->class == 'Signalement_embouteillage' || $this->router->class == 'Vol_Controller' || $this->router->class == 'Signalement_accident') echo 'active'; ?>">
              <i class="nav-icon fas fa-skull-crossbones"></i>
              <p>
                Signalement
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>


            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?= base_url('PSR/Civil_alert/index') ?>" class="nav-link <?php if ($this->router->class == 'Civil_alert') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Alert Civil</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('PSR/Signalement_embouteillage/index') ?>" class="nav-link <?php if ($this->router->class == 'Signalement_embouteillage') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Embouteillage </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?= base_url('PSR/Vol_Controller/index') ?>" class="nav-link <?php if ($this->router->class == 'Vol_Controller') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vol </p>
                </a>
              </li>


              <li class="nav-item">
                <a href="<?= base_url('PSR/Signalement_accident/index') ?>" class="nav-link <?php if ($this->router->class == 'Signalement_accident') echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Accident </p>
                </a>
              </li>

            </ul>

          </li>
        <?php } ?>











        <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
          <li class="nav-item">
            <a href="#" class="nav-link <?php if ($this->router->class == 'Assureur'  ||  $this->router->class == 'Psr_elements'  ||  $this->router->class == 'Poste_Pnb' ||  $this->router->class == 'Psr_element_affectation' || $this->router->class == 'Chaussee') echo 'active'; ?>">
              <i class="nav-icon fa fa-desktop"></i>
              <p>
                IHM
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">



              <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
                <li class="nav-item">
                  <a href="<?= base_url('PSR/Assureur/index') ?>" class="nav-link <?php if ($this->router->class == 'Assureur') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Assureur</p>
                  </a>
                </li>
              <?php } ?>
              <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
                <li class="nav-item">
                  <a href="<?= base_url('ihm/Chaussee/index') ?>" class="nav-link <?php if ($this->router->class == 'Chaussee') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Chaussée</p>
                  </a>
                </li>
              <?php } ?>


              <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
                <li class="nav-item">
                  <a href="<?= base_url('ihm/Verif_Permis/index') ?>" class="nav-link <?php if ($this->router->class == 'Verif_Permis') echo 'active'; ?>">
                    <i class="nav-icon far fa-circle"></i>
                    <p>Chauffeur</p>
                  </a>
                </li>
              <?php } ?>


              <?php if ($this->session->userdata('PSR_ELEMENT') == 1) { ?>
                <li class="nav-item">
                  <a href="<?= base_url('PSR/Psr_elements/index') ?>" class="nav-link <?php if ($this->router->class == 'Psr_elements') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>PNB ELements</p>
                  </a>
                </li>
              <?php } ?>



              <?php if ($this->session->userdata('AFFECTATION') == 1) { ?>
                <li class="nav-item">
                  <a href="<?= base_url('PSR/Poste_Pnb/index') ?>" class="nav-link <?php if ($this->router->class == 'Poste_Pnb') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>PNB Poste</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="<?= base_url('ihm/Psr_element_affectation/index') ?>" class="nav-link <?php if ($this->router->class == 'Psr_element_affectation') echo 'active'; ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>PNB Affectations</p>
                  </a>
                </li>

              <?php } ?>



            </ul>
          </li>
        <?php } ?>
        <?php if ($this->session->userdata('PERMIS') == 1) { ?>
          <li class="nav-item" style="">
            <a href="<?= base_url('PSR/Chauffeur_permis/index') ?>" class="nav-link <?php if ($this->router->class == 'Chauffeur_permis') echo 'active'; ?>">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                PSR (Permis)
                <!--  <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>
          </li>
        <?php } ?>

        <?php if ($this->session->userdata('IMMATRICULATION') == 1) { ?>

          <li class="nav-item" style="">
            <a href="<?= base_url('PSR/Obr_Immatriculation/index') ?>" class="nav-link <?php if ($this->router->class == 'Obr_Immatriculation') echo 'active'; ?>">
              <i class="nav-icon fas fa-car-alt"></i>
              <p>
                OBR (Plaque)
              </p>
            </a>
          </li>
        <?php } ?>

        <?php if ($this->session->userdata('CONTROLE_TECHNIQUE') == 1) { ?>
          <li class="nav-item">
            <a href="<?= base_url('PSR/Controle/index') ?>" class="nav-link <?php if ($this->router->class == 'Controle') echo 'active'; ?>">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                OTRACO (ctr Tech)
                <!--  <i class="right fas fa-plane-left"></i> -->
              </p>
            </a>
          </li>

        <?php } ?>

        <?php if ($this->session->userdata('ASSURANCE') == 1) { ?>
          <li class="nav-item">
            <a href="<?= base_url('PSR/Assurances/index') ?>" class="nav-link <?php if ($this->router->class == 'Assurances') echo 'active'; ?>">
              <i class="nav-icon fas fa-american-sign-language-interpreting"></i>
              <p>
                ASSURANCE
                <!-- <i class="right fas fa-angle-left"></i> -->
              </p>
            </a>

          </li>
        <?php } ?>

        <?php if ($this->session->userdata('DECLARATION') == 1) { ?>
          <li class="nav-item">
            <a href="<?= base_url('PSR/Declaration_Vol/index') ?>" class="nav-link <?php if ($this->router->class == 'Declaration_Vol') echo 'active'; ?>">
              <i class="nav-icon fas fa-user-circle"></i>
              <p>
                POLICE (PJ)
                <!-- <i class="right fas fa-angle-rigth"></i> -->
              </p>
            </a>

          </li>

        <?php } ?>


      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>