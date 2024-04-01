<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	function ussd_paf(){

		  $flux = file_get_contents('php://input');

		  $flux = str_replace("<:para6>", "", $flux);

		    $array_cas = array('DATA'=>$flux);
		    
		    if (!empty($flux)) {

		    $this->Model->create('ussd_data_flux',$array_cas);

		    $donn = $this->traitement_flux_getId($flux);
		    
		    $data_xml = $this->reponse_ussd($donn);

		    print($data_xml);
		    
		    }else{
		    
		     echo json_encode('Mediabox API ussd code');

		    }

	}









    function traitement_flux_getId($data_xml){

		if (!empty($data_xml)) {

		$flux = str_replace("<:para6>", "", $data_xml);
		$simpleXml = simplexml_load_string($flux);
		$jsonUne = json_encode($simpleXml);
		$donne = json_decode($jsonUne,true);

		$TransactionId = $donne['params']['param']['value']['struct']['member'][0]['value']['string'];

		$dateTimes = $donne['params']['param']['value']['struct']['member'][1]['value']['dateTime.iso8601'];

		$Numero_phone = $donne['params']['param']['value']['struct']['member'][2]['value']['string'];

		$USSDServiceCode = $donne['params']['param']['value']['struct']['member'][3]['value']['string'];

		$USSDRequestString = $donne['params']['param']['value']['struct']['member'][4]['value']['string'];

		$datas = $donne['params']['param']['value']['struct']['member'][5]['value']['string'];


		$donnes_back =  array(
		                      'TransactionId'=>$TransactionId, 
		                      'dateTimes'=>$dateTimes, 
		                      'Numero_phone'=>$Numero_phone,
		                      'USSDServiceCode'=>$USSDServiceCode,
		                      'USSDRequest_reponse'=>$USSDRequestString,
		                      'donnees'=>$datas,

		                    );

		  /*print_r($donnes_back);*/

		  return $donnes_back;

		  }else{


		  $donnes_back =  array(
		                      'TransactionId'=>Null, 
		                      'dateTimes'=>Null, 
		                      'Numero_phone'=>Null,
		                      'USSDServiceCode'=>Null,
		                      'USSDRequest_reponse'=>Null,
		                      'donnees'=>Null,
		                    );

		  return $donnes_back;

		  }


}






function reponse_ussd($data){

$TransactionId = $data['TransactionId'];

$donne = $data['USSDRequest_reponse'];

$donne_text = $this->get_menu($data);


$data_heur = date('H') + 2;
$donne ='<?xml version="1.0" encoding="utf-8" standalone="yes"?>
<methodResponse>
  <params>
    <param>
      <value>
        <struct>
          <member>
            <name>TransactionId</name>
            <value>
              <string>'.$TransactionId.'</string>
            </value>
          </member>
          <member>
            <name>TransactionTime</name>
            <value>
              <dateTime.iso8601>'.date('Ymd').'T'.$data_heur.''.date(':i:s').'</dateTime.iso8601>
            </value>
          </member>
          <member xml:space="preserve">
            <name>USSDResponseString</name>
            <value>
              <string>'.utf8_encode($donne_text['texte']).'</string>
            </value>
          </member>
          <member>
            <name>action</name>
            <value>
              <string>'.$donne_text['suite_etap'].'</string>
            </value>
          </member>
        </struct>
      </value>
    </param>
  </params>
</methodResponse>';

return $donne;


}



function get_menu($data){


	$texte = 'Bienvenue sur la plateforme de la PSR Burundi :
	';
	$texte .= '1.Informations
	';
	$texte .= '2.Mise a jours carte rose
	'; 
	$texte .= '4.Paiement des amendes
	';
	$texte .= '3.Plaintes
	';
	$suite_etap = 'request';
	// $suite_etap = 'end';
	return array('texte' =>$texte , 'suite_etap'=>$suite_etap);


}


























	public function test_ssl()
	{
		$url = "http://220.225.104.132/GLPAAPI/API/GetPABalance";
		$orignal_parse = parse_url($url, PHP_URL_HOST);
		$get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
		$read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
		$cert = stream_context_get_params($read);
		$certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
		print_r($certinfo);
	}


	function check_permit($permit = ""){


		    $header = array();
        $header[] = 'Content-Type:application/json';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://41.79.226.130:493/api/values/'.$permit);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($curl);

        print_r($result);



	}



	function test_Contec(){


		$data = '{"NAME": "Mediabox test",
		          "suname": "Visa",
		          "dob": "04/04/2022" ,
		          "PlaceBirth": "placeofbirthh",
		          "sex":"M",
		          "Province":"TESt",
		          "Commune": "Commune" ,
		          "Colline": "Colline" ,
		          "EtatCivil": "EtatCivil",
		          "Nationality":"Burundian",
		          "Profession": "Profession",
		          "Telephone1": "Telephone1",
		          "Telephone2": "Telephone2",
		          "Address1": "Address1",
		          "Address2": "Address2",
		          "RefrencePerson": "RefrencePerson",
		          "RefrenceTelephone": "RefrenceTelephone",
		          "MotherName" : "MotherName",
		          "MotherSurname" : "MotherSurname",
		          "FatherName" : "FatherName",
		          "FatherSurname" : "FatherSurname",
		          "IDNumber" : "IDNumber" ,
		          "DateOfDelivery" : "DateOfDelivery",
		          "PlaceOfDelivery" : "PlaceOfDelivery",
		          "appointmentid" : "12323231",
		          "email" : "TEST@TEST.COM",
		          "paymentstatus" : "PAID",
		          "paymentmade" : "235000"}';

        $header = array();
        $header[] = 'Content-Type:application/json';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://41.79.226.130:493/api/values/PNC0000500');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $result = curl_exec($curl);
        $result = json_decode($result);

       print_r(json_decode($result));


	}

	
    function send_chatApi(){


    	$data = '{"phone":' . $string_tel . ',"txt_message":"' . $this->remplace_lettre($string_msg) . '"}';

        $header = array();
        $header[1] = 'Content-Type:application/json';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://51.83.236.148:3030/sms');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($curl);
        // $result = json_decode($result);

        return $result;


    }



	public function index()
	{
		$this->load->view('welcome_message');
	}

	function checEconet($donne = 0){

		$numeros = substr($donne['TELEPHONE'], 4, -6);

		if ($numeros == "71" || $numeros == "72" || $numeros == "76" || $numeros == "79") {

			$this->Model->update('passangers',array('ID'=>$donne['ID']),array('IS_ECONET'=>1));
			
		}

		// $newNumber = str_replace("+257", "", $numeros);


	}

    
    function getData(){

    	$donne =  $this->Model->getRequete('SELECT id as ID,name as NOM, phone as TELEPHONE ,email as EMAIL FROM passangers where IS_ECONET=1 AND `HAVE_SEND` = 0 limit 100');

    	foreach ($donne as $key => $value) {


    		$data = array(
    			'ID' => $value['ID'],
    			'NOM' => $value['NOM'],
    			'TELEPHONE' => $value['TELEPHONE'],
    			'EMAIL' => $value['EMAIL'],
    			 );

    		print_r($data);

    		//$this->checEconet($data);
    		$this->sendImage($data);
    	}

    	


    }



      public function send_sms_smpp($string_tel = NULL, $string_msg)
    {

        $data = '{"phone":' . $string_tel . ',"txt_message":"' . $this->remplace_lettre($string_msg) . '"}';

        $header = array();
        $header[1] = 'Content-Type:application/json';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://51.83.236.148:3030/sms');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($curl);
        // $result = json_decode($result);

        return $result;
    }





	function sendImage($donne = array()){

		    $phone = str_replace(" ", "", $donne['TELEPHONE']);
            
            $fichier = "https://app.mediabox.bi/psr/assets/imageWasili.jpeg";
            $titre = "Wasili informe ses fidèles clients l'ouverture de nouvelles lignes d'appel.79135135, 79137137 et 79138138.Les lignes WhatsApp restent 75135135, 75136136 et 75137137.";

            $instance = "instance15459";
            $token = "8a37ojygt4uaf2yd";

			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api.ultramsg.com/".$instance."/messages/image",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "token=".$token."&to=%2B".$phone."&image=".$fichier."&caption=".$titre."&referenceId=&nocache=",
			  CURLOPT_HTTPHEADER => array(
			    "content-type: application/x-www-form-urlencoded"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;

			} else {

			  $respo =  json_decode($response);
			  ($respo->sent =="true") ? $this->Model->update('passangers',array('ID'=>$donne['ID']),array('IS_WHATSAPP'=>1,'HAVE_SEND'=>1)) : $this->Model->update('passangers',array('ID'=>$donne['ID']),array('HAVE_SEND'=>1));
			  echo $response;
			}


			if (str_replace("-", "", $donne['EMAIL']) != "") {

				$email = $donne['EMAIL'];
				//$email = 'wabengaalphonse@gmail.com';

				$titre = "<img src='".$fichier."'><br><br>Wasili informe ses fidèles clients l'ouverture de nouvelles lignes d'appel.79135135, 79137137 et 79138138.Les lignes WhatsApp restent 75135135, 75136136 et 75137137.";
				$this->notifications->send_mail($email, 'Information Wasili burundi', $cc_emails = array(), $titre , $attach = array());
			}

			// $this->Model->update('passangers',array('ID'=>$donne['ID']),array('HAVE_SEND'=>1));





		
	}





	function sendMessage($phone = 0){

	    $request = new HttpRequest();
		$request->setUrl('https://api.ultramsg.com/instance15419/messages/chat');
		$request->setMethod(HTTP_METH_POST);

		$request->setHeaders(array(
		  'content-type' => 'application/x-www-form-urlencoded'
		));

		$request->setContentType('application/x-www-form-urlencoded');
		$request->setPostFields(array(
		  'token' => 'p295uvtyc38qhh80',
		  'to' => '25761395170',
		  'body' => 'WhatsApp API on UltraMsg.com works good',
		  'priority' => '10',
		  'referenceId' => ''
		));

		try {
		  $response = $request->send();

		  echo $response->getBody();
		} catch (HttpException $ex) {
		  echo $ex;
		}

		
	}





	function checkNumber($phone = 0){


	}






}
