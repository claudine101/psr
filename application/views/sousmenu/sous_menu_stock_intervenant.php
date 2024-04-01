   <?php if ($this->session->userdata('iccm_PROFIL_CODE')=="CAM" /*|| $this->session->userdata('iccm_PROFIL_CODE')=="DODS" || $this->session->userdata('iccm_PROFIL_CODE')=="PNLIP"*/ || $this->session->userdata('iccm_PROFIL_CODE')=="DSNIS") {
   	# code...
    ?>


<ul class="nav nav-pills">

	<li class="nav-item">
		<a class="<?php echo $menu_cam_1 ?> btn-sm" href="<?=base_url('stock/Stock_Global')?>">Stock - <?= $this->session->userdata('iccm_INTERVENANT_STRUCTURE_DESCR')?></a>
	</li>
	<li class="nav-item">
		<a class="<?php echo $menu_cam_2 ?> btn-sm" href="<?=base_url('stock/Stock_Intervenant/get_bds_stock')?>">Stock BDS</a>
	</li>
	<li class="nav-item">
		<a class="<?php echo $menu_cam_3 ?> btn-sm" href="<?=base_url('stock/Stock_Intervenant/get_stock_cds')?>">Stock CDS</a>
	</li>
	<li class="nav-item">
		<a class="<?php echo $menu_cam_4 ?> btn-sm" href="<?=base_url('stock/Stock_Intervenant/get_stock_asc')?>">Stock ASC</a>
	</li>

</ul>
<?php }  ?>
   <?php if ($this->session->userdata('iccm_PROFIL_CODE')=="DODS" || $this->session->userdata('iccm_PROFIL_CODE')=="PNLIP" ) {
   	# code...
    ?>


<ul class="nav nav-pills">

	<li class="nav-item">
		<a class="<?php echo $menu_cam_1 ?> btn-sm" href="<?=base_url('stock/Stock_Global/indexdp')?>">Stock - <?= $this->session->userdata('iccm_INTERVENANT_STRUCTURE_DESCR')?></a>
	</li>
	<li class="nav-item">
		<a class="<?php echo $menu_cam_2 ?> btn-sm" href="<?=base_url('stock/Stock_Intervenant/get_bds_stock')?>">Stock BDS</a>
	</li>
	<li class="nav-item">
		<a class="<?php echo $menu_cam_3 ?> btn-sm" href="<?=base_url('stock/Stock_Intervenant/get_stock_cds')?>">Stock CDS</a>
	</li>
	<li class="nav-item">
		<a class="<?php echo $menu_cam_4 ?> btn-sm" href="<?=base_url('stock/Stock_Intervenant/get_stock_asc')?>">Stock ASC</a>
	</li>

</ul>
<?php }  ?>


<!-- si CDS connecte -->

   <?php if ($this->session->userdata('iccm_PROFIL_CODE')=="BDS" ) {
   	# code...
    ?>


<ul class="nav nav-pills">

	<li class="nav-item">
		<a class="<?php echo $menu_bds_1 ?> btn-sm" href="<?=base_url('stock/Stock_Global/indexintev')?>">Stock - <?= $this->session->userdata('iccm_INTERVENANT_STRUCTURE_DESCR')?></a>
	</li>

	<li class="nav-item">
		<a class="<?php echo $menu_bds_2 ?> btn-sm" href="<?=base_url('stock/Stock_Intervenant/get_stock_cds')?>">Stock CDS</a>
	</li>
	<li class="nav-item">
		<a class="<?php echo $menu_bds_3 ?> btn-sm" href="<?=base_url('stock/Stock_Intervenant/get_stock_asc')?>">Stock ASC</a>
	</li>

</ul>
<?php }  ?>

<!-- si CDS connecte -->
   <?php if ($this->session->userdata('iccm_PROFIL_CODE')=="CDS" ) {
   	# code...
    ?>


<ul class="nav nav-pills">

	<li class="nav-item">
		<a class="<?php echo $menu_cds_1 ?> btn-sm" href="<?=base_url('stock/Stock_Global/indexintev')?>">Stock - <?= $this->session->userdata('iccm_INTERVENANT_STRUCTURE_DESCR')?></a>
	</li>


	<li class="nav-item">
		<a class="<?php echo $menu_cds_2 ?> btn-sm" href="<?=base_url('stock/Stock_Intervenant/get_stock_asc')?>">Stock ASC</a>
	</li>

</ul>
<?php }  ?>
<br>
