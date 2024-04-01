<?php

/*Alphonse : API PHP ECOCASH*/

ini_set('max_execution_time', 0);
ini_set('memory_limit','2048M'); 

class Psr_permis extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

   

  function index($donne = 1)
  {
    

    $data = $this->Modele->getRequeteOne('SELECT MAX(ID_PERMIS) AS MAXID FROM `chauffeur_permis` WHERE 1 ');

    $num = !empty($data['MAXID']) ? $data['MAXID'] : 0;

    $Donne_num = $this->Modele->getRequeteOne("SELECT `NUMERO_PERMIS` FROM `chauffeur_permis` WHERE ID_PERMIS = ".$num);

    if (!empty($Donne_num)) {
      $datas = explode("NC", $Donne_num['NUMERO_PERMIS']);
      $datassss = $datas[1];
    }else{
      $datassss = 0;
    }


    $u = 1;

  	for ($i=0; $i < $donne; $i++) { 
      
      $datass = $datassss + $u++;

  		$numero = $this->strlen_cout($datass);

  		$permit = 'PNC'.$numero;

  	  $this->get_permis_Psr($permit);
  	 
      // print_r($donne."\n");

      //print_r($permit."<br>");

  	}
     
  }


  function strlen_cout($text){

  	$a = 0000000;
    $numero = strlen($text);

  	if ($numero == 1) {
  	 $a = '000000'.$text;

  	}elseif ($numero == 2) {
  	  $a = '00000'.$text;
  	
  	}elseif ($numero == 3) {
  	  $a = '0000'.$text;
  	
  	}elseif ($numero == 4) {
  	  $a = '000'.$text;
  	
  	}elseif ($numero == 5) {
  	  $a = '00'.$text;
  	
  	}elseif ($numero == 6) {
  	  $a = '0'.$text;
  	
  	}elseif ($numero == 7) {
  	  $a = $text;
  	
  	}elseif ($numero > 7) {
      $a = $text;
    
    }


  	return $a;


  }





   function get_permis_Psr($numero= 0)
   {

        $data_check = $this->Modele->getOne('chauffeur_permis', array('NUMERO_PERMIS' => $numero));
        
        $header = array();
        $header[] = 'Content-Type:application/json';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://41.79.226.130:493/api/values/'.$numero);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($curl);

        $donne = json_decode($result);

        if (curl_exec($curl) === false) {

          $reponse = array('statut' => 255 , 'donnees' => curl_error($curl), 'permis'=>$numero);
          //echo json_encode($reponse);
         
        }else{

            if (!empty($donne->DLNo)) {
               
            	$date_a =  date('Y',strtotime($donne->exp)) - 5;
            	$date_deliv = $date_a.'-'.date('m-d',strtotime($donne->exp));

            	$data_insert = array(
      				'NUMERO_PERMIS' => trim($donne->DLNo),
      				'NOM_PROPRIETAIRE' => $donne->Name.' '.$donne->suname,
      				'DATE_NAISSANCE' => date('Y-m-d',strtotime($donne->DOB)),
      				'CATEGORIES' => str_replace(" ", "", $donne->cat),
      				'SEXE'  => str_replace(" ", "", $donne->Sex),
      				'ADRESSE'  => $donne->Address,
      				'DATE_DELIVER' => $date_deliv,
      				'DATE_EXPIRATION' => date('Y-m-d',strtotime($donne->exp)),
      				'POINTS' => 100
    			    );

        			$tabl = 'chauffeur_permis';

                if(!empty($data_check['NUMERO_PERMIS'])){

                  $data_insert['IS_UPDATE'] = 1;

                  $this->Modele->update($tabl, array('NUMERO_PERMIS' => $numero), $data_insert);

                }else{

                  $this->Modele->create($tabl, $data_insert);
                }
        		
        			$reponse = array('statut' => 200 , 'donnees' => $donne);
              //echo json_encode($reponse);
            	
            }else{

            	$reponse = array('statut' => 250 , 'donnees' => $donne);
              // echo json_encode($reponse);
            }

            
        }


      
           echo json_encode($reponse);
         

           

   }







}