<?php

$sub_x = $_POST['field1'];
$x = $_POST['field2'];
$funcion_in = $_POST['field3'];
$funcion = explode( chr( 1 ), str_replace( array('+','-'), chr( 1 ), $funcion_in ) );
$fx = array();
$xs = explode(",", $sub_x);
$count = count($xs);
$bs = array();
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

function subx_evaluacion($a,$b,$funcion,$signos){
	$res = (evaluo_funcion($funcion,$signos,$a) - evaluo_funcion($funcion,$signos,$b)) / ($a - $b);
	return $res;
}

function sub_restas($a,$xs,$funcion,$signos){
	$res = (subx_evaluacion($xs[$a],$xs[($a-1)],$funcion,$signos) - subx_evaluacion($xs[($a-1)],$xs[($a-2)],$funcion,$signos))/($xs[$a] - $xs[($a-2)]);
	return $res;
}

//Construccion de los b
$funcion_final = array();
$funcion_final[5] = 0;
foreach ($xs as $key => $value) {
	switch ($key) {
		case 0:
			$bs[0] = evaluo_funcion($funcion,$signos,$value);
			break;
		case 1:
			$bs[1] = subx_evaluacion($xs[$key],$xs[$key-1],$funcion,$signos);
			break;
		case 2:
			$bs[2] = sub_restas($key,$xs,$funcion,$signos);
			break;
		case 3:
			$bs[3] = (sub_restas($key,$xs,$funcion,$signos) - sub_restas($key-1,$xs,$funcion,$signos))/($value - $xs[0]);
			break;			
		case 4:
			$bs[4] = ( ((sub_restas($key,$xs,$funcion,$signos) - sub_restas($key-1,$xs,$funcion,$signos))/($xs[$key] - $xs[$key-3])) - ((sub_restas($key-1,$xs,$funcion,$signos) - sub_restas($key-2,$xs,$funcion,$signos))/($xs[$key-1] - $xs[$key-4])) )/($xs[$key] - $xs[0]) ;
			break;		
	}
	$funcion_final[$key] = $bs[$key];
	for ($i=0; $i < $key; $i++) { 
		$funcion_final[$key] = $funcion_final[$key] * ($x - $xs[$i]);
	}
	$funcion_final[5] = $funcion_final[5] + $funcion_final[$key];
}

echo "Funcion ingresada : ".$funcion_in.'</br>';
echo "Valores de sub x </br>";
foreach ($xs as $key => $value) {
	echo "x".$key." = ".$value.", ";
}
echo "</br>";
echo "Valor de x ingresado: ".$x."</br>";

echo "Resultado de f".($count-1).": ".$funcion_final[5];

?>