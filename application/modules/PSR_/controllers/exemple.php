<?=

if($get_rdv['STATUT_RDV_ID']==12 || $get_rdv['STATUT_RDV_ID']=="12"){

	if(empty($get_rdv['PATH_CONSENTEMENT_SIGNE'])){

		$this->Model->update('vacc_rdv',array('RDV_ID'=>$get_rdv['RDV_ID']),
			array(
				'PATH_CONSENTEMENT_SIGNE'=>$photo_name,
				'STATUT_RDV_ID'=>10,
				'LATITUDE_LIEU_SCAN_CONSANTEMA'=>$LATITUDE,
				'LONGITUDE_LIEU_SCAN_CONSANTEMA'=>$LONGITUDE,
				'DEVICEID'=>$deviceid

			));


		$array_histo=array(
			'RDV_ID'=>$get_rdv['RDV_ID'],
			'STATUT_RDV_ID'=>10,
			'DATE_TRAITEMENT'=>date('Y-m-d H:i:s'),
			'USER_ID'=>-1,
			'CDV_ID'=>$get_rdv['CDV_ID'],
			'DATE_RDV'=>$get_rdv['DATE_RDV']
		);
		$this->Model->create('vacc_rdv_historique',$array_histo);

	?>