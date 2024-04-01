
<?php
 /// EDMOND :dashboard des Immatriculation
class Dashboard_declare_vole extends CI_Controller
      {
function index(){

$dattes=$this->Model->getRequete("SELECT DISTINCT date_format(pj_declarations.`DATE_VOLER`,'%Y') AS mois FROM pj_declarations ORDER BY  mois ASC");
  

$data['dattes']=$dattes;

$this->load->view('Dashboard_declare_vole_View',$data);
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

$criteres_date.=" AND date_format(pj_declarations.`DATE_VOLER`,'%Y')='".$mois."'"; 
        }

if(!empty($jour)){

$criteres_date.=" AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m')='".$jour."'";
        }



$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;     


$query_principal=" SELECT  `NUMERO_PLAQUE`, `NOM_DECLARANT`, `PRENOM_DECLARANT`, `COULEUR_VOITURE`, `MARQUE_VOITURE`, `DATE_VOLER`, `STATUT` FROM `pj_declarations` WHERE 1 ".$criteres_date." ";

        $limit='LIMIT 0,10';
        if($_POST['length'] != -1)
        {
            $limit='LIMIT '.$_POST["start"].','.$_POST["length"];
        }
        $order_by='';
        if($_POST['order']['0']['column']!=0)
        {
            $order_by = isset($_POST['order']) ? ' ORDER BY '.$_POST['order']['0']['column'] .'  '.$_POST['order']['0']['dir'] : ' ORDER BY NUMERO_PLAQUE  ASC'; 
        }

        $search = !empty($_POST['search']['value']) ? ("AND (NUMERO_PLAQUE LIKE '%$var_search%'  OR NOM_DECLARANT LIKE '%$var_search%' OR MARQUE_VOITURE LIKE '%$var_search%' OR PRENOM_DECLARANT LIKE '%$var_search%'  ) ") : '';


        $critaire='';
        if(!empty($mois) && empty($jour)){
        if($ID==1){  

        $critaire=" AND  `STATUT`=1 AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m')='".$KEY."'";


        }elseif ($ID==2) { 

          $critaire=" AND  `STATUT` !=1 AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m')='".$KEY."'";
        }
        elseif ($ID==3) { 

          $critaire=" AND  `NUMERO_PLAQUE`  IN (SELECT NUMERO_PLAQUE from historiques WHERE 1) AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m')='".$KEY."'";
        }
        elseif ($ID==4) { 

          $critaire=" AND  `NUMERO_PLAQUE` NOT IN (SELECT NUMERO_PLAQUE from historiques WHERE 1) AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m')='".$KEY."'";
        }
        elseif ($ID==5) { 

          $critaire=" AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m')='".$KEY."'";
        }
       }elseif(!empty($mois) && !empty($jour)){
        if($ID==1){  

        $critaire=" AND  `STATUT`=1 AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m-%d')='".$KEY."'";


        }elseif ($ID==2) { 

          $critaire=" AND  `STATUT` !=1 AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m-%d')='".$KEY."'";
        }
        elseif ($ID==3) { 

          $critaire=" AND  `NUMERO_PLAQUE` IN (SELECT NUMERO_PLAQUE from historiques WHERE 1) AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m-%d')='".$KEY."'";
        }
        elseif ($ID==4) { 

          $critaire=" AND  `NUMERO_PLAQUE` NOT IN (SELECT NUMERO_PLAQUE from historiques WHERE 1) AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m-%d')='".$KEY."'";
        }
        elseif ($ID==5) { 

          $critaire=" AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m-%d')='".$KEY."'";
        }
        
        }else{
            if($ID==1){  

        $critaire=" AND  `STATUT`=1 AND date_format(pj_declarations.`DATE_VOLER`,'%Y')='".$KEY."'";


        }elseif ($ID==2) { 

          $critaire=" AND  `STATUT` !=1 AND date_format(pj_declarations.`DATE_VOLER`,'%Y')='".$KEY."'";
        }
        elseif ($ID==3) { 

          $critaire=" AND  `NUMERO_PLAQUE` IN (SELECT NUMERO_PLAQUE from historiques WHERE 1) AND date_format(pj_declarations.`DATE_VOLER`,'%Y')='".$KEY."'";
        }
        elseif ($ID==4) { 

          $critaire=" AND  `NUMERO_PLAQUE` NOT IN (SELECT NUMERO_PLAQUE from historiques WHERE 1) AND date_format(pj_declarations.`DATE_VOLER`,'%Y')='".$KEY."'";
        }
         elseif ($ID==5) { 

          $critaire="  AND date_format(pj_declarations.`DATE_VOLER`,'%Y')='".$KEY."'";
        }

        }
        
        $query_secondaire=$query_principal.'  '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
        $query_filter=$query_principal.'  '.$critaire.' '.$search;

        $fetch_data = $this->Model->datatable($query_secondaire);
        $u=0;
        $data = array();
        foreach ($fetch_data as $row) 
        {  
            
        $exite=$this->Model->getOne('obr_immatriculations_voitures',array('NUMERO_PLAQUE'=>$row->NUMERO_PLAQUE));
        $retVal = (!empty($exite['NUMERO_PLAQUE'])) ? '<div ><a href="'. base_url('PSR/Obr_Immatriculation/show_vehicule/0/'. $row->NUMERO_PLAQUE) .'" style="color:green">'.$exite['NUMERO_PLAQUE'].'</font></a></div>' :'<div style="color:red">'.$row->NUMERO_PLAQUE.'</div>';
         $u++;
         $intrant=array();
         $intrant[] = $u;
        $intrant[] =$row->NOM_DECLARANT."  ".$row->PRENOM_DECLARANT;
         $intrant[] =$retVal;
         $intrant[] =$row->COULEUR_VOITURE;
         $intrant[] =$row->MARQUE_VOITURE;
         $intrant[] =$row->DATE_VOLER;
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

$categorie="";

if
(empty($mois)){

$categorie="date_format(pj_declarations.`DATE_VOLER`,'%Y')";
$criteres1.="";
}
if
(!empty($mois)){


$criteres1.=" AND date_format(pj_declarations.`DATE_VOLER`,'%Y')='".$mois."'";

$categorie="date_format(pj_declarations.`DATE_VOLER`,'%Y-%m')";


  }

  if(!empty($jour)){
     $criteres1.=" AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m')= '".$jour."'  ";


    $categorie="date_format(pj_declarations.`DATE_VOLER`,'%Y-%m-%d')";
    
         }
if(!empty($heure)){
     $criteres1.=" AND date_format(pj_declarations.`DATE_VOLER`,'%Y-%m-%d')= '".$heure."'  ";

$categorie="date_format(pj_declarations.`DATE_VOLER`,'%Y-%m-%d')";
    
         }

  $datte=$this->Model->getRequete('SELECT DISTINCT DATE_FORMAT(pj_declarations.DATE_VOLER, "%Y-%m") as mois from pj_declarations where DATE_FORMAT(pj_declarations.`DATE_VOLER`, "%Y")="'.$mois.'" ORDER BY mois DESC');

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
$datjour=$this->Model->getRequete('SELECT DISTINCT DATE_FORMAT(pj_declarations.DATE_VOLER, "%Y-%m-%d") as mois from pj_declarations where DATE_FORMAT(pj_declarations.DATE_VOLER, "%Y-%m")="'.$jour.'" ORDER BY mois DESC');

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

$control=$this->Model->getRequete("SELECT DISTINCT ".$categorie." AS mois,COUNT(`ID_DECLARATION`) AS tout,(SELECT COUNT(`ID_DECLARATION`) FROM pj_declarations WHERE `STATUT`=1 AND ".$categorie."=mois ) as trouve,(SELECT COUNT(`ID_DECLARATION`) FROM pj_declarations WHERE `STATUT`!=1 AND ".$categorie."=mois ) as pas_trouve,(SELECT COUNT(ID_DECLARATION) FROM pj_declarations WHERE `NUMERO_PLAQUE` IN (SELECT NUMERO_PLAQUE from historiques WHERE 1) AND ".$categorie." = mois) AS controle,(SELECT COUNT(ID_DECLARATION) FROM pj_declarations WHERE `NUMERO_PLAQUE` NOT IN (SELECT NUMERO_PLAQUE from historiques WHERE 1) AND ".$categorie." = mois) AS non_controle FROM pj_declarations where 1 ".$criteres1." GROUP BY mois ORDER BY mois ASC");


$immatraite_categorie=" ";
$immaassure_categorie=" ";
$immacontrole_categorie=" ";
$immadeclare_categorie=" ";
$immadeclare_categoriev=" ";
$immadeclare_categorief=" ";
$immadeclare_categoriet=" ";
$immacat_traite=0;
$immacat_controle=0;
$immacat_controlev=0;
$immacat_controlef=0;
$immacat_controlet=0;

 foreach ($control as  $value) {
      
      
$key_id1=($value['mois']>0) ? $value['mois'] : "0" ;
$sommetrouve=($value['trouve']>0) ? $value['trouve'] : "0" ;
$sommeexp=($value['pas_trouve']>0) ? $value['pas_trouve'] : "0" ;
$sommeexpv=($value['controle']>0) ? $value['controle'] : "0" ;
$sommeexpf=($value['non_controle']>0) ? $value['non_controle'] : "0" ;
$sommeexpt=($value['tout']>0) ? $value['tout'] : "0" ;
$immatraite_categorie.="{name:'".str_replace("'","\'", $value['mois'])."', y:". $sommetrouve.",key2:1,key:'". $key_id1."'},";
$immaassure_categorie.="{name:'".str_replace("'","\'", $value['mois'])."', y:". $sommeexp.",key2:2,key:'". $key_id1."'},";
$immadeclare_categoriev.="{name:'".str_replace("'","\'", $value['mois'])."', y:". $sommeexpv.",key2:3,key:'". $key_id1."'},";
$immadeclare_categorief.="{name:'".str_replace("'","\'", $value['mois'])."', y:". $sommeexpf.",key2:4,key:'". $key_id1."'},";
$immadeclare_categoriet.="{name:'".str_replace("'","\'", $value['mois'])."', y:". $sommeexpt.",key2:5,key:'". $key_id1."'},";
$immacat_traite=$immacat_traite+$value['trouve'];
$immacat_controle=$immacat_controle+$value['pas_trouve'];
$immacat_controlev=$immacat_controlev+$value['controle'];
$immacat_controlef=$immacat_controlef+$value['non_controle'];
$immacat_controlet=$immacat_controlet+$value['tout'];
    
     }
   
     $rapp="<script type=\"text/javascript\">
    Highcharts.chart('container', {
   
chart: {
        type: 'column'
    },
    title: {
        text: '<b> Rapport  </b> du ".date('d-m-Y')." '
    },
    subtitle: {
        text: ''
    },
    xAxis: {
          type: 'category',
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
        pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
            '<td style=\"padding:0\"><b>{point.y:.f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
             pointPadding: 0.2,
            borderWidth: 0,
            depth: 40,
             cursor:'pointer',
             point:{
                events: {
                  click: function()
{
$(\"#titre\").html(\"Véhicules déclarées volées \");
$(\"#myModal\").modal();
var row_count ='1000000';
$(\"#mytable\").DataTable({
\"processing\":true,
\"serverSide\":true,
\"bDestroy\": true,
\"oreder\":[],
\"ajax\":{
url:\"".base_url('dashboard/Dashboard_declare_vole/detail')."\",
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
             format: '{point.y:f}'
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
        color: '#90EE90',
        name:'Total declaré : (".number_format($immacat_controlet,0,',',' ').")',
        borderColor:\"#90EE90\", 
        data: [".$immadeclare_categoriet."]  
    },
    {
        color: 'green',
        name:'trouvé : (".number_format($immacat_traite,0,',',' ').")',
        data: [".$immatraite_categorie."]
    },
     {
        color: 'red',
         name:'Non  trouvé : (".number_format($immacat_controle,0,',',' ').")',
        data: [".$immaassure_categorie."]
    }
    ,
    {
        color: '#582900',
        name:'Deja controlé : (".number_format($immacat_controlev,0,',',' ').")',
        borderColor:\"#90EE90\", 
        data: [".$immadeclare_categoriev."]
    }
    ,
    {
        color: '#000000',
        name:'Non encore controlé : (".number_format($immacat_controlef,0,',',' ').")',
        borderColor:\"#90EE90\", 
        data: [".$immadeclare_categorief."]  
    }
    ]

});
</script>
     ";



echo json_encode(array('rapp'=>$rapp,'select_month'=>$mois_select,'selectjour'=>$selectjour));
    }


}
?>