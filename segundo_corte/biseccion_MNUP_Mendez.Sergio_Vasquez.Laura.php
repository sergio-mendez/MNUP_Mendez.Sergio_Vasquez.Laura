<?php

//Variables Iniciales
$funcion_in = '√x-cosx';
echo 'Funcion: f(x)='.$funcion_in.'</br>';
$intervalo = array(0,1);
echo 'Intervalo: ['.$intervalo[0].','.$intervalo[1].'] </br>';
$hasta_p=3;
echo 'Hasta: P'.$hasta_p.' </br>';
$signo_inicial = '+';

//Metodo Biseccion.
$funcion = explode( chr( 1 ), str_replace( array('+','-'), chr( 1 ), $funcion_in ) );
$operaciones = str_split($funcion_in);
$signos = array();
$signos[0] = $signo_inicial;

foreach ($operaciones as $key => $value) {	
	if($value == '+'){
		$signos[] = $value;
	}
	elseif($value == '-'){
		$signos[] = $value;
	}
}

function evaluo_funcion($funcion,$signos,$valor){
	$funcion_ev = '';
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

function calculo_pn($a,$b){
	$pn = ($a+$b)/2;
	return $pn;
}
$cont_2 = 1;
$an = $intervalo[0];
$bn = $intervalo[1];
while($cont_2<=$hasta_p){
	$p_n = calculo_pn($an,$bn);
	$pn_evaluo = evaluo_funcion($funcion,$signos,$p_n);
	$an_evaluo = evaluo_funcion($funcion,$signos,$an);
	$pn_an = $pn_evaluo*$an_evaluo;

	echo 'P'.$cont_2.'</br>';	
	echo 'a'.$cont_2.' = '.$an.'</br>';
	echo 'b'.$cont_2.' = '.$bn.'</br>';	
	echo 'f('.$p_n.') = '.$pn_evaluo.'</br>';
	echo 'f('.$an.') = '.$an_evaluo.'</br>';	
	echo 'p'.$cont_2.' = '.$p_n.'</br>';

	if($pn_an<0){
		$bn = $p_n;
	}
	else{
		$an = $p_n;
	}
	$cont_2++;
}
