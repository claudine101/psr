
<?php
 /// EDMOND :dashboard des permis
class Dashboard_Chauffeur_permis extends CI_Controller
      {
function index(){

$dattes=$this->Model->getRequete("SELECT DISTINCT date_format(chauffeur_permis.DATE_DELIVER,'%Y') AS mois FROM chauffeur_permis ORDER BY  mois ASC");
 
$data['dattes']=$dattes;
$this->load->view('Dashboard_Chauffeur_Permis_View',$data);
     }

    function detail()
    {
    
  $mois=$this->input->post('mois');
  $jour=$this->input->post('jour');
 $KEY=$this->input->post('key');
 $KEY2=$this->input->post('key2');
$break=explode(".",$KEY2);
$ID=$KEY2;
        
$criteres_date="";
      
if(!empty($mois)){

$criteres_date.=" AND date_format(chauffeur_permis.DATE_DELIVER,'%Y')='".$mois."'"; 
        }

if(!empty($jour)){

$criteres_date.=" AND date_format(chauffeur_permis.DATE_DELIVER,'%Y-%m')='".$jour."'";
        }

if(!empty($heure)){
$criteres_date.=" AND date_format(chauffeur_permis.DATE_DELIVER,'%Y-%m-%d')= '".$heure."'  ";
    
}



$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;     


$query_principal=" SELECT  `NUMERO_PERMIS`, `NOM_PROPRIETAIRE`, `CATEGORIES`, `DATE_NAISSANCE`, `DATE_DELIVER`, `DATE_EXPIRATION`, `POINTS` FROM `chauffeur_permis` WHERE 1 ".$criteres_date." ";

        $limit='LIMIT 0,10';
        if($_POST['length'] != -1)
        {
            $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
        }
        $order_by='';
        if($_POST['order']['0']['column']!=0)
        {
            $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NOM_PROPRIETAIRE  ASC'; 
        }

        $search = !empty($_POST['search']['value']) ? ("AND (NUMERO_PERMIS LIKE '%$var_search%'  OR CATEGORIES LIKE '%$var_search%' OR DATE_NAISSANCE LIKE '%$var_search%' OR DATE_EXPIRATION LIKE '%$var_search%' OR DATE_DELIVER LIKE '%$var_search%' OR NOM_PROPRIETAIRE LIKE '%$var_search%' ) ") : '';   


 $critaire='';

        if($ID==1){  

        $critaire="  AND DATE_EXPIRATION >=NOW() AND CATEGORIES='".$KEY."'";


        }elseif ($ID==2) { 

          $critaire=" AND `DATE_EXPIRATION` < NOW() AND CATEGORIES='".$KEY."'";
        }
        elseif ($ID==3) {

            $critaire=" AND `POINTS` <=0 AND CATEGORIES='".$KEY."'";
        }
          elseif ($ID==4) {

            $critaire=" AND NUMERO_PERMIS NOT IN (SELECT `NUMERO_PERMIS` FROM `historiques` WHERE 1) AND CATEGORIES='".$KEY."'";
        }
      elseif ($ID==5) {

            $critaire=" AND NUMERO_PERMIS  IN (SELECT `NUMERO_PERMIS` FROM `historiques` WHERE 1) AND CATEGORIES='".$KEY."'";
        }
        elseif ($ID==6) {

            $critaire="  AND CATEGORIES='".$KEY."'";
        }

       
        
        $query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
        $query_filter=$query_principal.'  '.$critaire.' '.$search;

        $fetch_data = $this->Model->datatable($query_secondaire);
        $u=0;
        $data = array();
        foreach ($fetch_data as $row) 
        {
         $u++;
         
         $intrant=array();
         $intrant[] = $u;
        $intrant[] =$row->NOM_PROPRIETAIRE;
         $intrant[] =$row->DATE_NAISSANCE;
          $intrant[] =$row->NUMERO_PERMIS;
         $intrant[] =$row->CATEGORIES;
         $intrant[] =$row->DATE_DELIVER;
         $intrant[] =$row->DATE_EXPIRATION;
          $intrant[] =$row->POINTS;
         $data[] = $intrant;
          }

        $output = array(
            "draw" => intval($_POST['draw']),
            "recordsTotal" =>$this->Model->all_data($query_principal),
            "recordsFiltered" => $this->Model->filtrer($query_filter),
            "data" => $data
        );

        echo json_encode($output);
    }


public function get_rapport(){ 

$mois=$this->input->post('mois');
$jour=$this->input->post('jour');
$heure=$this->input->post('heure');


$datte="";
$criteres1="";
$criteres2="";
$titre=date('Y-m-d');








$titre="du  ".strftime('%d-%m-%Y',strtotime(date('Y-m-d')));
if
(!empty($mois)){

$titre="en  ".strftime('%Y',strtotime($mois));
$criteres1.=" AND date_format(chauffeur_permis.DATE_DELIVER,'%Y')='".$mois."'";



  }

  if(!empty($jour)){
     $criteres1.=" AND date_format(chauffeur_permis.DATE_DELIVER,'%Y-%m')= '".$jour."'  ";
   $titre="en  ".strftime('%m-%Y',strtotime($jour));
         }
         if(!empty($heure)){
     $criteres1.=" AND date_format(chauffeur_permis.DATE_DELIVER,'%Y-%m-%d')= '".$heure."'  ";
    $titre="du  ".strftime('%d-%m-%Y',strtotime($heure));
         }

  $datte=$this->Model->getRequete('SELECT DISTINCT DATE_FORMAT(chauffeur_permis.DATE_DELIVER, "%Y-%m") as mois from chauffeur_permis where DATE_FORMAT(chauffeur_permis.DATE_DELIVER, "%Y")="'.$mois.'" ORDER BY mois DESC');

  $mois_select="<option selected='' disabled=''>séléctionner</option>";

    foreach ($datte as $value)
         {

        if ($jour==$value['mois'])
              {
      $mois_select.="<option value='".$value['mois']."' selected>".$value['mois']."</option>";
                                } else{ 
    $mois_select.="<option value='".$value['mois']."'>".$value['mois']."</option>";
      } 
      } 

          ////
$datjour=$this->Model->getRequete('SELECT DISTINCT DATE_FORMAT(chauffeur_permis.DATE_DELIVER, "%Y-%m-%d") as mois from chauffeur_permis where DATE_FORMAT(chauffeur_permis.DATE_DELIVER, "%Y-%m")="'.$jour.'" ORDER BY mois DESC');

  $selectjour="<option selected='' disabled=''>séléctionner</option>";

    foreach ($datjour as $value)
         {

        if ($heure==$value['mois'])
              {
      $selectjour.="<option value='".$value['mois']."' selected>".$value['mois']."</option>";
                                } else{ 
    $selectjour.="<option value='".$value['mois']."'>".$value['mois']."</option>";
      } 
      } 


$immacat=$this->Model->getRequete("SELECT DISTINCT `CATEGORIES` AS NAME,COUNT(`ID_PERMIS`) AS tout,(SELECT COUNT(`ID_PERMIS`) FROM chauffeur_permis WHERE `DATE_EXPIRATION` >=NOW() AND `CATEGORIES`=NAME ".$criteres1.") valide,(SELECT COUNT(`ID_PERMIS`) FROM chauffeur_permis WHERE `DATE_EXPIRATION` < NOW() AND `CATEGORIES`=NAME  ".$criteres1.") invalide,(SELECT COUNT(`ID_PERMIS`) FROM chauffeur_permis WHERE `POINTS` <=0 AND `CATEGORIES`=NAME ".$criteres1." ) annule,(SELECT COUNT(ID_PERMIS) FROM chauffeur_permis WHERE NUMERO_PERMIS NOT IN (SELECT `NUMERO_PERMIS` FROM `historiques` WHERE 1) AND `CATEGORIES`=NAME ".$criteres1." ) AS non_controle,(SELECT COUNT(ID_PERMIS) FROM chauffeur_permis WHERE NUMERO_PERMIS  IN (SELECT `NUMERO_PERMIS` FROM `historiques` WHERE 1) AND `CATEGORIES`=NAME ".$criteres1." ) AS controle  FROM `chauffeur_permis` WHERE 1 ".$criteres1."  GROUP BY NAME ORDER BY NAME DESC");



$immavalide_categorie=" ";
$immaexpire_categorie=" ";
$immaannule_categorie=" ";
$immanoncontro_categorie=" ";
$immacontro_categorie=" ";
$immacontro_categorietout=" ";
$immacat_valide=0;
$immacat_expire=0;
$immacat_annule=0;
$immacat_controle=0;
$immacat_controlev=0;
$immacat_controletout=0;
 foreach ($immacat as  $value) {  
      
      
$key_id1=(!empty($value['NAME'])) ? $value['NAME'] : "null" ;
$sommevalide=($value['valide']>0) ? $value['valide'] : "0" ;
$sommeexpire=($value['invalide']>0) ? $value['invalide'] : "0" ;
$sommeannule=($value['annule']>0) ? $value['annule'] : "0" ;
$sommecontrole=($value['non_controle']>0) ? $value['non_controle'] : "0" ;
$sommecontrotout=($value['tout']>0) ? $value['tout'] : "0" ;
$sommecontrolev=($value['controle']>0) ? $value['controle'] : "0" ;
$immavalide_categorie.="{name:'".str_replace("'","\'", $value['NAME'])."', y:". $sommevalide.",key2:1,key:'". $key_id1."'},";
$immaexpire_categorie.="{name:'".str_replace("'","\'", $value['NAME'])."', y:". $sommeexpire.",key2:2,key:'". $key_id1."'},";
$immaannule_categorie.="{name:'".str_replace("'","\'", $value['NAME'])."', y:". $sommeannule.",key2:3,key:'". $key_id1."'},";
$immanoncontro_categorie.="{name:'".str_replace("'","\'", $value['NAME'])."', y:". $sommecontrole.",key2:4,key:'". $key_id1."'},";
$immacat_valide=$immacat_valide+$value['valide'];
$immacontro_categorie.="{name:'".str_replace("'","\'", $value['NAME'])."', y:". $sommecontrolev.",key2:5,key:'". $key_id1."'},";
$immacontro_categorietout.="{name:'".str_replace("'","\'", $value['NAME'])."', y:". $sommecontrotout.",key2:6,key:'". $key_id1."'},";

$immacat_expire=$immacat_expire+$value['invalide'];
$immacat_annule=$immacat_annule+$value['annule'];
$immacat_controle=$immacat_controle+$value['non_controle'];
$immacat_controlev=$immacat_controlev+$value['controle'];
$immacat_controletout=$immacat_controletout+$value['tout'];


     
     }




   

     $rapp="<script type=\"text/javascript\">

     Highcharts.chart('container', {
    chart: {
        type: 'columnpyramid'
    },
    title: {
        text: '<b> Rapport  </b>  ".$titre."'
    },
    colors: ['#C79D6D', '#B5927B', '#CE9B84', '#B7A58C', '#C7A58C'],
    xAxis: {
        crosshair: true,
        labels: {
            style: {
                fontSize: '14px'
            }
        },
        type: 'category'
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        valueSuffix: ' '
    },plotOptions: {
        columnpyramid: {
       cursor:'pointer',
                        point:{
                            events: {
                  click: function()
{
$(\"#titre\").html(\"Détail \");
$(\"#myModal\").modal();
var row_count ='1000000';
$(\"#mytable\").DataTable({
\"processing\":true,
\"serverSide\":true,
\"bDestroy\": true,
\"oreder\":[],
\"ajax\":{
url:\"".base_url('dashboard/Dashboard_Chauffeur_permis/detail')."\",
type:\"POST\",
data:{
key:this.key,
key2:this.key2,
 mois:$('#mois').val(),
jour:$('#jour').val(),
heure:$('#heure').val(),

}
},
lengthMenu: [[10,50, 100, row_count], [10,50, 100, \"All\"]],
pageLength: 10,
\"columnDefs\":[{
\"targets\":[],
\"orderable\":false
}],
dom: 'Bfrtlip',
buttons: [
'excel', 'print','pdf'
],
language: {
\"sProcessing\":     \"Traitement en cours...\",
\"sSearch\":         \"Rechercher&nbsp;:\",
\"sLengthMenu\":     \"Afficher _MENU_ &eacute;l&eacute;ments\",
\"sInfo\":           \"Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments\",
\"sInfoEmpty\":      \"Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment\",
\"sInfoFiltered\":   \"(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)\",
 \"sInfoPostFix\":    \"\",
\"sLoadingRecords\": \"Chargement en cours...\",
\"sZeroRecords\":    \"Aucun &eacute;l&eacute;ment &agrave; afficher\",
\"sEmptyTable\":     \"Aucune donn&eacute;e disponible dans le tableau\",
\"oPaginate\": {
\"sFirst\":      \"Premier\",
\"sPrevious\":   \"Pr&eacute;c&eacute;dent\",
\"sNext\":       \"Suivant\",
\"sLast\":       \"Dernier\"
},
 \"oAria\": {
\"sSortAscending\":  \": activer pour trier la colonne par ordre croissant\",
 \"sSortDescending\": \": activer pour trier la colonne par ordre d&eacute;croissant\"
}
}
                              
});


                           

                   }
                           }
                        },
           dataLabels: {
              enabled: true,
               format: '{point.y:,f}'
            },
            showInLegend: true
        }
    }, 
     
 credits: {
              enabled: true,
              href: \"\",
              text: \"Mediabox\"
      },

 series: [
 {
        color: 'pink',
        name:'Permis donnés : (".number_format($immacat_controletout,0,',',' ').")',
        data: [".$immacontro_categorietout."]
    },
 {
        color: 'green',
        name:'Permis validé : (".number_format($immacat_valide,0,',',' ').")',
        data: [".$immavalide_categorie."]
    },
     {
        color: 'yellow',
        name:'Permis expiré : (".number_format($immacat_expire,0,',',' ').")',
        data: [".$immaexpire_categorie."]
    },
     {
        color: 'red',
        name:'Permis annulé : (".number_format($immacat_annule,0,',',' ').")',
        data: [".$immaannule_categorie."]
    }
    ,
    {
        color: '#582900',
        name:'Permis controlé : (".number_format($immacat_controlev,0,',',' ').")',
        data: [".$immacontro_categorie."]
    }
    ,
     {
        color: '#000000',
        name:'Permis non encore controlé : (".number_format($immacat_controle,0,',',' ').")',
        data: [".$immanoncontro_categorie."]
    }
    ]
});
  
   
</script>
     ";
 


echo json_encode(array('rapp'=>$rapp,'select_month'=>$mois_select,'selectjour'=>$selectjour));
    }


}
?>






