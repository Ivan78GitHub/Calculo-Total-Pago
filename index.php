<?php

{
	
//define('STDIN',fopen("php://stdin","r"));
$dias=array("MO","TU","WE","TH","FR","SA","SU");
echo "En cuantos rangos o periodos de dias dividira la semana: ";
fscanf(STDIN, '%d\n', $numeropd);

$arrperiodosdias=array();
$arrhoraslaborables=array();
$arrvalorhora=array();

for($i=1;$i<=$numeropd;$i++){
	echo "Ingrese el periodo " .$i." o rango de dias(EJEMPLO (MO-TH;FR;SA-SU)):";
	fscanf(STDIN, "%s", $periodod);
	//$arrperiodosdias[]=$periodod;
	$arrperiodosdias[$i-1]=array();
	
	echo "Cuantas horarios laborables para el periodo ".$periodod.":";
	fscanf(STDIN, "%s", $njornadas);
	for($j=1;$j<=$njornadas;$j++){
		echo "Ingrese el horario ".$j." para el periodo ".$periodod.":(ejemplo: 09:01-18:00):";
		fscanf(STDIN, "%s", $horas);

		echo "Ingrese el valor(hora) de la jornada ".$horas." para el periodo ".$periodod.":";
		fscanf(STDIN, "%s", $valhor);		

		$arrperiodosdias[$i-1][$j-1]=array();
		$arrperiodosdias[$i-1][$j-1][0]=$periodod;
		$arrperiodosdias[$i-1][$j-1][1]=$horas;
		$arrperiodosdias[$i-1][$j-1][2]=$valhor;
	}
}

//IMPRESION

	echo count($arrperiodosdias)."\n";
	for($contador=0;$contador<count($arrperiodosdias);$contador++){
		echo count($arrperiodosdias[$contador])."\n";
		for($x=0;$x<count($arrperiodosdias[$contador]);$x++){
				//echo count($arrperiodosdias[$contador][$x])."\n";
				echo $arrperiodosdias[$contador][$x][0]." ".$arrperiodosdias[$contador][$x][1]." ".$arrperiodosdias[$contador][$x][2]."\n";
		}
	}




$fp = fopen("miarchivo.txt", "r","true");

while (!feof($fp))
{
  $linea = fgets($fp);
  echo $linea."\n";

 $nombre_horarios = explode("=",$linea); 
 $horarios = explode(",",$nombre_horarios[1]);

$dd=array(); 
$hh=array(); 

//echo $nombre_horarios[0]."\n";
$total=0;

for ($z=0;$z<count($horarios);$z++){ 
//echo $horarios[$z]."\n"; 
$dd=substr($horarios[$z],0,2); 
$hh=substr($horarios[$z],2,strlen($horarios[$z])); 
//echo $dd."\n"; echo $hh."\n";

for($contador=0;$contador<count($arrperiodosdias);$contador++){

   //echo count($arrperiodosdias[$contador])."\n";
	for($x=0;$x<count($arrperiodosdias[$contador]);$x++){
		//echo $arrperiodosdias[$contador][$x][0]." ".$dd."\n"; //echo $hh."\n";		
		//echo $arrperiodosdias[$contador][$x][1]." ".$hh."\n"; //echo $hh."\n";		

		for($i=0;$i<count($dias);$i++){
 			if(substr($arrperiodosdias[$contador][$x][0],0,2)==$dias[$i]){ $idp=$i; }
 			if(substr($arrperiodosdias[$contador][$x][0],3,2)==$dias[$i]){ $fdp=$i; }
 			if($dd==$dias[$i]){ $dtrabajo=$i;}
 		}
 		$hi=substr($arrperiodosdias[$contador][$x][1],0,2) . substr($arrperiodosdias[$contador][$x][1],3,2);
 		$hf=substr($arrperiodosdias[$contador][$x][1],6,2) . substr($arrperiodosdias[$contador][$x][1],9,2);

 		$hie=substr($hh,0,2) . substr($hh,3,2);
 		$hfe=substr($hh,6,2) . substr($hh,9,2);

 		$vhi=(int)$hi;
 		if($hf==0) { $hf=2400;}
 		$vhf=(int)$hf;
 		

 		$vhie=(int)$hie;
 		$vhfe=(int)$hfe;
 		$totalhorase=($vhfe-$vhie)/100;

		if (($vhie>=$vhi && $vhfe<=$vhf) && ($dtrabajo>=$idp && $dtrabajo<=$fdp))
		{
		  $total=$total+ ((INT)$arrperiodosdias[$contador][$x][2]*$totalhorase);
		//	echo $arrperiodosdias[$contador][$x][2]." ";
		}
	}
					  //echo $arrperiodosdias[$i][$j+1]."\n"; //" valor/hora ".$arrvalorhora[$j]
}
}
	echo "The amount to pay ". $nombre_horarios[0] ." is: ".$total."\n";
}
}

fclose($fp);  


?>

		/*
		$arrhoraslaborables[]=$horas;
		$arrvalorhora[]=$valhor; */ 