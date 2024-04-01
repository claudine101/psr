<ul class="nav nav-pills">
<?php

if ($this->session->userdata('iccm_PROFIL_CODE')=="CAM" || $this->session->userdata('iccm_PROFIL_CODE')=="DODS" || $this->session->userdata('iccm_PROFIL_CODE')=="PNLIP" ) { ?>
 <li class="nav-item">
    <a class="<?php echo $menu1 ?> btn-sm" href="<?=base_url('demande/Demande')?>">INTRANTS-Traitement des demandes</a>
  </li>

<?php } if ($this->session->userdata('iccm_PROFIL_CODE')=="BDS" ) { ?>

 <li class="nav-item">
    <a class="<?php echo $menu1 ?> btn-sm" href="<?=base_url('stock_distribution/DistributionBdsCds/mes_demande')?>">INTRANTS-Traitement des demandes</a>
  </li>

<?php } if ($this->session->userdata('iccm_PROFIL_CODE')=="CDS" ) { ?>
 <li class="nav-item">
    <a class="<?php echo $menu1 ?> btn-sm" href="<?=base_url('stock_distribution/DistributionCdsAsc/mes_demande')?>">INTRANTS-Traitement des demandes</a>
  </li>
<?php } ?>
  <li class="nav-item">
    <a class="<?php echo $menu2 ?> btn-sm" href="<?=base_url('demande/Demandes_list')?>">Historique des Demandes</a>
  </li>

</ul><br>