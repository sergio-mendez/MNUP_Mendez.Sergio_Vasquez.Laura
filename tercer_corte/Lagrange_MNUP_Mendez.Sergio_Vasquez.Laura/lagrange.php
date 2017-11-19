<?php

$sub_x = $_POST['field1'];
$x = $_POST['field2'];
$funcion_in = $_POST['field3'];
$funcion = explode( chr( 1 ), str_replace( array('+','-'), chr( 1 ), $funcion_in ) );
$fx = array();
$xs = explode(",", $sub_x);
$count = count($xs);
$ls = array();
$signo_inicial = '+';
$signos = array();
$signos[0] = $signo_inicial;
$operaciones = str_split($funcion_in);
$ps = 0;

foreach ($operaciones as $key => $value) {	
	if($value == '+'){
		$signos[] = $value;
	}
	elseif($value == '-'){
		$signos[] = $value;
	}
}

//Interpreta la funcion ingresada por el usuario
function evaluo_funcion($funcion,$signos,$valor){
	$funcion_ev = 0;
	$cont = 0;
	foreach ($funcion as $key => $value) {
		try{
			if($value == 'sinx' || $value=='sin(x)'){
				if($signos[$cont] == '+'){
					$funcion_ev = $funcion_ev + sin(($valor));
				}
				else{
					$funcion_ev = $funcion_ev - sin(($valor));
				}
			}
			elseif($value == 'cosx' || $value=='cos(x)'){
				if($signos[$cont] == '+'){
					$funcion_ev = $funcion_ev + cos(($valor));			
				}
				else{
					$funcion_ev = $funcion_ev - cos(($valor));
				}
			}
			elseif($value == 'tanx' || $value=='tan(x)'){
				if($signos[$cont] == '+'){
					$funcion_ev = $funcion_ev + tan(($valor));
				}
				else{
					$funcion_ev = $funcion_ev - tan(($valor));
				}
			}
			elseif($value == '√x' || $value=='√(x)'){
				if($signos[$cont] == '+'){
					$funcion_ev = $funcion_ev + sqrt($valor);
				}
				else{
					$funcion_ev = $funcion_ev - sqrt($valor);
				}
			}		
			elseif(is_numeric($value)){
				if($signos[$cont] == '+'){
					$funcion_ev = $funcion_ev + $value;				
				}
				else{
					$funcion_ev = $funcion_ev - $value;				
				}
			}	
			elseif(is_numeric(substr($value, 0, -1))){
				if($signos[$cont] == '+'){
					$funcion_ev = $funcion_ev + $value*($valor);
				}
				else{
					$funcion_ev = $funcion_ev - $value*($valor);
				}
			}
			elseif($value == "1/x"){
				if($signos[$cont] == '+'){
					$funcion_ev = $funcion_ev + (1/$valor);
				}
				else{
					$funcion_ev = $funcion_ev - (1/$valor);
				}				
			}
			elseif($value == "ln(x)"){
				if($signos[$cont] == '+'){
					$funcion_ev = $funcion_ev + log($valor);
				}
				else{
					$funcion_ev = $funcion_ev - log($valor);
				}				
			}			
			else{
				$exponente = explode('^', $value);
				if($signos[$cont] == '+'){								
					$funcion_ev = $funcion_ev + pow( $valor , end($exponente))*$exponente[0];					
				}
				else{
					$funcion_ev = $funcion_ev - pow( $valor , end($exponente))*$exponente[0];
				}							
			}
		}
		catch(Exception $e){}
		$cont++;
	}
	return $funcion_ev;
}

//Construccion de los l
foreach ($xs as $key => $value) {
	$ls[$key] = 1;
	for ($i=0; $i < $count; $i++) {
		if($i != $key){
			$ls[$key] = $ls[$key] * (($x - $xs[$i])/($value - $xs[$i]));			
		}		
	}
	//Evaluacion de los valores de sub x en la funcion.
	$fx[] = evaluo_funcion($funcion,$signos,$value);
}


foreach ($ls as $key => $value) {
	$ps = $ps + ($value * $fx[$key]);
}

echo "Funcion ingresada : ".$funcion_in.'</br>';
echo "Valores de sub x </br>";
foreach ($xs as $key => $value) {
	echo "x".$key." = ".$value.", ";
}
echo "</br>";
echo "Valor de x ingresado: ".$x."</br>";

echo "Resultado de P".($count-1).": ".$ps;

?>