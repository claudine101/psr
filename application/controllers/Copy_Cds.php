<?php
defined('BASEPATH') OR exit('No direct script access allowed');


 class Copy_Cds extends MY_Controller {

 	public function index()
 	{

    $resultat=$this->Model->getRequete('SELECT intervenants_rh.INTERVENANT_RH_ID,intervenants_rh.CDS FROM `intervenants_rh` WHERE `INTERVENANT_STRUCTURE_ID`=914 AND `INTERVENANT_RH_ID` NOT IN(100,101) AND EST_TROUVE=0 LIMIT 200');
    foreach ($resultat as $key => $value)
     {
      $INTERVENANT_STRUCTURE_ID=$this->Model->getRequeteOne('SELECT * FROM `intervenants_structure` WHERE `INTERVENANT_STRUCTURE_DESCR` LIKE "'.$value['CDS'].'"');

        $data=array(
            'CDS_ID'=>-1,
            'INTERVENANT_RH_ID'=>$value['INTERVENANT_RH_ID'],
            'CDS'=>$value['CDS']
        );
        $this->Model->create('cds_asc',$data);
        $this->Model->update('intervenants_rh',array('INTERVENANT_RH_ID'=>$value['INTERVENANT_RH_ID']),array('EST_TROUVE'=>2));
 
   

     }

 	}

    public function nontrouver()
    {

    $resultat=$this->Model->getRequete('SELECT intervenants_rh.INTERVENANT_RH_ID,intervenants_rh.CDS FROM `intervenants_rh` WHERE `INTERVENANT_STRUCTURE_ID`=914 AND `INTERVENANT_RH_ID` NOT IN(100,101) AND EST_TROUVE=0');
    foreach ($resultat as $key => $value)
     {
      $INTERVENANT_STRUCTURE_ID=$this->Model->getRequeteOne('SELECT * FROM `intervenants_structure` WHERE `INTERVENANT_STRUCTURE_DESCR` LIKE "'.$value['CDS'].'"');


      if ($INTERVENANT_STRUCTURE_ID)
       {
        $data=array(
            'CDS_ID'=>$INTERVENANT_STRUCTURE_ID['INTERVENANT_STRUCTURE_ID'],
            'INTERVENANT_RH_ID'=>$value['INTERVENANT_RH_ID'],
            'CDS'=>$value['CDS']
        );
        $this->Model->create('cds_asc',$data);
        $this->Model->update('intervenants_rh',array('INTERVENANT_RH_ID'=>$value['INTERVENANT_RH_ID']),array('EST_TROUVE'=>1));
       }
   

     }

    }


 }
