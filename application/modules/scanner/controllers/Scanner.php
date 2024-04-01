<?php


class Scanner extends CI_Controller
{

    function index(){


        $data['title']= "Archivage des dossiers";
        $this->load->view('scanners/Scanner_view',$data);



    }



     function test_getImatriculation($plaque = 0){



        $xml_data ='<COMMAND>
         <MSISDN>'.$donn['MSISDN'].'</MSISDN>
         <MSISDN2>'.$donn['MSISDN2'].'</MSISDN2>
         <AMOUNT>'.$donn['AMOUNT'].'</AMOUNT>
         <PIN>'.$donn['PIN'].'</PIN>
         <REFERENCE>'.$donn['REFERENCE'].'</REFERENCE>
         <LANGUAGE1>'.$donn['LANGUAGE1'].'</LANGUAGE1>
         <LANGUAGE2>'.$donn['LANGUAGE2'].'</LANGUAGE2>
         <TRID>'.$donn['TRID'].'</TRID>
</COMMAND>';

            $encodeText = '';

            $username = 'MediaBox';
            $password = 'mEd!@2021#bOxx';

            $URL = "http://192.168.100.213:9080/OnlinePayment/Ecocash/service/payment";

            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING , 1); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=utf-8','Accept: application/xml', 'Authorization: '.$encodeText, 'Accept-Encoding: deflate',"Authorization: Basic ".base64_encode($username.":".$password)));
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);

            $simpleXml = simplexml_load_string($output);
            $jsonUne = json_encode($simpleXml);
            $donne = json_decode($jsonUne,true);


       



    }



            

}


?>






