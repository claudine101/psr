<?php




class Elements_Pnb extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }



  function index()
  {

    if (empty($this->session->userdata('USER_NAME'))) {
      redirect(base_url());
    } else {
      $this->load->view('Elements_Pnb_view');
    }
  }


  function sendMessage(){

    $IdAgents = $this->input->post('IdAgents');
    //$IdAgents = 16;
    $phoneNumber = $this->input->post('phoneNumber');
    $MessageText = $this->input->post('MessageText');

    $police =  !empty($IdAgents) ? $IdAgents : 0;

    $tokens =  $this->Model->getRequete('SELECT n.TOKEN,e.NOM,e.PRENOM,e.NUMERO_MATRICULE,e.TELEPHONE FROM notification_tokens n JOIN utilisateurs u on n.ID_UTILISATEUR=u.ID_UTILISATEUR JOIN psr_elements e ON e.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID WHERE u.PSR_ELEMENT_ID='.$police);
     
    if (!empty($tokens)) {
      
      $tokns = array();

      $nom = "";

        foreach ($tokens as $key => $value) {

        $tokns[] = $value['TOKEN'];

        $phoneNumber = str_replace(' ','',$value['TELEPHONE']);

        $nom =  str_replace(' ','',$value['NOM']).' '.str_replace(' ','',$value['PRENOM']).' ('.str_replace(' ','',$value['NUMERO_MATRICULE']).")";

        
        }

        $titre =  "Centre de contrôle";

        $messageAgent =  $nom.",\n".$MessageText;

        $donnes = array(
         'TITRE'=>$titre,
         'CONTENU'=>$messageAgent,
         'tokens'=>$tokns
        );

        $this->notifications->notificationApk($donnes);

        $data = array(
          'USER_ID'=>$this->session->userdata('USER_ID'),
          'MESSAGE'=> $messageAgent,
          'TELEPHONE'=>$phoneNumber,
          'NUMERO_PLAQUE'=>'PSR',
          'IS_AGENT_PSR'=>1,
          'STATUT'=>1,
          'ID_PSR_ELEMENT'=>$IdAgents
        );

        //$this->notifications->send_sms_smpp($phoneNumber, $messageAgent);


        $test = $this->Model->create('notifications',$data);



        if ($test) {
          echo '1';
        }else{
          echo '0';
        }
        
        exit();


    }
    
  

   echo '0';

  }





  function get_carte($value = ''){

    $zoom = 12;
    $coord = '-3.3752982,29.2843385';
    $PROVINCE_ID = $this->input->post('PROVINCE_ID');
    $ID = $this->input->post('ID');
    $crit = '';

    if (!empty($PROVINCE_ID)) {
      $crit = ' AND incident_declaration.PROVINCE_ID=' . $PROVINCE_ID . '';
    }


    $data_donne = '';

  

    $requete = $this->Model->getRequete('SELECT e.TELEPHONE,e.PHOTO, u.IS_ACTIF,NOM_UTILISATEUR,e.NOM,e.PRENOM,e.NUMERO_MATRICULE,a.LATITUDE,a.LONGITUDE,u.PSR_ELEMENT_ID,ea.DATE_DEBUT,ea.DATE_FIN,a.LIEU_EXACTE FROM utilisateurs u LEFT JOIN psr_elements e ON u.PSR_ELEMENT_ID=e.ID_PSR_ELEMENT LEFT JOIN psr_element_affectation ea ON ea.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID JOIN psr_affectatations a on a.PSR_AFFECTATION_ID=ea.PSR_AFFECTATION_ID WHERE 1 AND `PROFIL_ID` IN(6,12,1) AND ea.IS_ACTIVE=1');

    
    $actif = 0;
    $nonActif = 0;

    $i = 0;

    $totalPnb = 0;

    foreach ($requete as $key => $value) {

      $i++;
      
      $lat = $value['LATITUDE'];
      $long = $value['LONGITUDE'];

      $color = '';
      $marker = '';

      if ($value['IS_ACTIF'] == 1) {
        $color = 'FF8000';
        $marker = '';
        $actif++;
      }

      if ($value['IS_ACTIF'] == 0) {
        $color = '3e9ceb';
        $marker = 'amusement';
        $nonActif++;
      }
     
      $total = $actif + $nonActif;
      $totalPnb = number_format($total, 0, ',', ' ');

      $nom = $this->remplace_lettre($value['NOM']);
      $Prenom = $this->remplace_lettre($value['PRENOM']);
      $matricule = $this->remplace_lettre($value['NUMERO_MATRICULE']);

      $statut = $this->remplace_lettre($value['IS_ACTIF']);
      $email = $this->remplace_lettre($value['NOM_UTILISATEUR']);
      $dateA = $this->remplace_lettre($value['DATE_DEBUT']);
      $dateB = $this->remplace_lettre($value['DATE_FIN']);
      $lieu = $this->remplace_lettre($value['LIEU_EXACTE']);

      $phone = $this->remplace_lettre($value['TELEPHONE']);

      $photo = !empty($value['PHOTO']) ? $value['PHOTO'] : base_url("upload/personne.png");

      $idpolice = $value['PSR_ELEMENT_ID'];

      

      $data_donne .= $lat . '<>' . $long . '<>' . $nom . '<>' . $Prenom. '<>' . $matricule . '<>' . $statut . '<>' . $photo . '<>' . $idpolice . '<>' . $email . '<>' . $dateA . '<>' . $dateB . '<>' . $lieu . '<>' . $phone . '<>' . '$';
    }



    $data_poste = "";
      
    $affectation = $this->Model->getRequete('SELECT `PSR_AFFECTATION_ID` as id,p.PROVINCE_NAME,c.COMMUNE_NAME,z.ZONE_NAME,co.COLLINE_NAME,a.LIEU_EXACTE,a.LATITUDE,a.LONGITUDE, (SELECT COUNT(e.PSR_AFFECTATION_ID) FROM psr_element_affectation e WHERE e.PSR_AFFECTATION_ID=id GROUP BY e.PSR_AFFECTATION_ID) as nmbrePNB FROM psr_affectatations a LEFT JOIN syst_provinces p on p.PROVINCE_ID=a.PROVINCE_ID LEFT JOIN syst_communes c on c.COMMUNE_ID=a.COMMUNE_ID LEFT JOIN syst_zones z on z.ZONE_ID=a.ZONE_ID LEFT JOIN syst_collines co ON co.COLLINE_ID=a.COLLINE_ID  WHERE a.LIEU_EXACTE !="" and a.LATITUDE !=""');
      
      $lieu = 0;
    
      foreach ($affectation as $key => $value) {

      $lieu++;

      $lat=floatval(trim($value['LATITUDE']));
      $long=floatval(trim($value['LONGITUDE']));

      $color = 'green';
      $royon = 0.5;

      $lieux = $this->remplace_lettre($value['LIEU_EXACTE']);
      //$lieux = 'test';
      $provice = $this->remplace_lettre($value['PROVINCE_NAME']);
      $commune = $this->remplace_lettre($value['COMMUNE_NAME']);
      $zone = $this->remplace_lettre($value['ZONE_NAME']);
      $colline = $this->remplace_lettre($value['COLLINE_NAME']);

      $id = $value['id'];

      $nmbrePNB = !empty($value['nmbrePNB']) ? $value['nmbrePNB'] : 0;

      $data_poste .= $lat.'<>'.$long.'<>'.$lieux.'<>'.$provice.'<>'.$commune . '<>' . $zone . '<>'.$colline.'<>'.$nmbrePNB.'<>'.$id .'<>'.$royon .'<>'. '$';
      
      }
  

   $data['gernier'] = $this->Model->getRequeteOne('SELECT `LATITUDE`,`LONGITUDE` FROM `psr_affectatations` WHERE 1 ORDER BY `PSR_AFFECTATION_ID` DESC LIMIT 1 ');
    
    
    $data['data_poste'] = $data_poste;
   

    $data['data_donne'] = $data_donne;
 

    $data['actif'] = $actif;
    $data['lieux'] = $lieu;
    $data['nonActif'] = $nonActif;
    $data['totalPnb'] = $totalPnb;

    $data['PROVINCE_ID'] = 3;

    $data['provinces'] = $this->Model->getRequete('SELECT * FROM syst_provinces WHERE 1 ');

    $data['zoom'] = $zoom;
    $data['coord'] = $coord;


    $map = $this->load->view('Get_Element_pnb', $data, TRUE);
    $output = array('cartes' => $map, 'id' => $ID);


     //print_r($data_donne);die();


    echo json_encode($output);
  }



  public function getincident($id, $type = null)
  {
    $crito = '';
    $PROVINCE_ID = $this->input->post('PROVINCE_ID');


    if (!empty($PROVINCE_ID)) {
      $crito = ' and incident_declaration.PROVINCE_ID=' . $PROVINCE_ID . '';
    }


    $query_principal = 'SELECT MONTANT, IF(IS_PAID=1,"Paié","Non Paié") as PAID,`ID_HISTORIQUE`,h.LATITUDE,h.LONGITUDE,ID_HISTORIQUE_CATEGORIE,c.DESCRIPTION,h.DATE_INSERTION,e.NUMERO_MATRICULE,IF(`NUMERO_PERMIS` is NULL,`NUMERO_PLAQUE`, NUMERO_PERMIS) as NUMERO FROM historiques h JOIN historiques_categories c on h.ID_HISTORIQUE_CATEGORIE=c.ID_CATEGORIE LEFT JOIN utilisateurs u on u.ID_UTILISATEUR=h.ID_UTILISATEUR LEFT JOIN psr_elements e on e.ID_PSR_ELEMENT=u.PSR_ELEMENT_ID WHERE 1 AND h.ID_HISTORIQUE_CATEGORIE=' . $id;


    $var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

    $limit = 'LIMIT 0,10';


    if ($_POST['length'] != -1) {
      $limit = 'LIMIT ' . $_POST["start"] . ',' . $_POST["length"];
    }

    $order_by = '';

    $order_column = array('ID_HISTORIQUE', 'DATE_INSERTION');

    $order_by = isset($_POST['order']) ? ' ORDER BY ' . $order_column[$_POST['order']['0']['column']] . '  ' . $_POST['order']['0']['dir'] : ' ORDER BY ID_HISTORIQUE   DESC';

    $search = !empty($_POST['search']['value']) ? (" AND  (NOM LIKE '%$var_search%' OR DATE_INSERTION LIKE '%$var_search%' OR NUMERO_MATRICULE LIKE '%$var_search%' OR DESCRIPTION LIKE '%$var_search%')  ") : '';

    $critaire = '';

    $query_secondaire = $query_principal . ' ' . $critaire . ' ' . $search . ' ' . $order_by . '   ' . $limit;
    $query_filter = $query_principal . ' ' . $critaire . ' ' . $search;


    $fetch_op = $this->Modele->datatable($query_secondaire);
    $data = array();
    foreach ($fetch_op as $row) {



      $sexe = 'Homme';


      $sub_array = array();
      $sub_array[] = $row->NUMERO;
      $sub_array[] = $row->DESCRIPTION;
      $sub_array[] = "<span style='float:right'>" . number_format($row->MONTANT, 0, '.', ' ') . " FBU</span>";
      $sub_array[] = $row->PAID;
      $sub_array[] = $row->DATE_INSERTION;



      $data[] = $sub_array;
    }
    $output = array(
      "draw" => intval($_POST['draw']),
      "recordsTotal" => $this->Modele->all_data($query_principal),
      "recordsFiltered" => $this->Modele->filtrer($query_filter),
      "data" => $data
    );
    echo json_encode($output);
  }




  public function check_new()
  {

    $get = $this->Model->getRequeteOne('SELECT COUNT(*) AS Nbr FROM historiques WHERE NEW=0');
    $send = 0;
    if ($get['Nbr'] > 0) {
      $send = 1;
      $this->Model->update('historiques', array('NEW' => 0), array('NEW' => 1));
    }


    $output = array('nbr' => $send);
    echo json_encode($output);
  }






  function remplace_lettre($message = "")
  {

      $message = str_replace('é', 'e', $message);
      $message = str_replace('è', 'e', $message);
      $message = str_replace('ê', 'e', $message);
      $message = str_replace('â', 'a', $message);
      $message = str_replace('û', 'u', $message);

      $message = str_replace('ô', 'o', $message);
      $message = str_replace('ù', 'u', $message);
      $message = str_replace('ç', 'c', $message);
      $message = str_replace('à', 'a', $message);
     
      $message = trim(str_replace("'"," ", $message));
      $message = str_replace("\n", "", $message);
      $message = str_replace("\r", "", $message);
      $message = str_replace("\t", "", $message);


    return  $message;
  }



  //  FONCTION POUR CALCULER LA DISTANCE
         function calcule_distance($point1,$point2,$unite="km",$precision=2)
         {
            //recuperation de l'instance de codeigniter
              $ci = & get_instance();



              $degrees = rad2deg(acos((sin(deg2rad($point1["lat"]))*sin(deg2rad($point2["lat"]))) + (cos(deg2rad($point1["lat"]))*cos(deg2rad($point2["lat"]))*cos(deg2rad($point1["long"]-$point2["long"])))));
              // Conversion de la distance en degrés à l'unité choisie (kilomètres, milles ou milles nautiques)
              switch($unite) {
              case 'km':
              $distance = $degrees * 111.13384; // 1 degré = 111,13384 km, sur base du diamètre moyen de la Terre (12735 km)
              break;
              case 'mi':
              $distance = $degrees * 69.05482; // 1 degré = 69,05482 milles, sur base du diamètre moyen de la Terre (7913,1 milles)
              break;
              case 'nmi':
              $distance =  $degrees * 59.97662; // 1 degré = 59.97662 milles nautiques, sur base du diamètre moyen de la Terre (6,876.3 milles nautiques)
              }
              return array(round($distance, $precision)." ".$unite);     

        }











}
