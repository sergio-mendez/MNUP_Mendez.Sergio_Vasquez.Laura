<?php 

//Variables Iniciales
$funcion_in = '230x^4+18x^3+9x^2-221x-9';
echo 'Funcion: f(x)='.$funcion_in.'</br>';
$intervalo = array(0,1);
echo 'Intervalo: ['.$intervalo[0].','.$intervalo[1].'] </br>';
$hasta_p=3;
echo 'Hasta: P'.($hasta_p+1).' </br>';
//signo inicial de la funcion
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

function calculo_pn($pn,$pn_less,$pn_evaluo,$pn_less_evaluo){
	$p_n_plus = $pn - (($pn_evaluo*($pn-$pn_less))/($pn_evaluo-$pn_less_evaluo));
	return $p_n_plus;
}
$cont_2 = 1;
$pn_less = $intervalo[0];
$pn = $intervalo[1];
while($cont_2<=$hasta_p){
	
	$pn_evaluo = evaluo_funcion($funcion,$signos,$pn);
	$pn_less_evaluo = evaluo_funcion($funcion,$signos,$pn_less);
	$p_n_plus = calculo_pn($pn,$pn_less,$pn_evaluo,$pn_less_evaluo);

	echo 'P'.($cont_2+1).'</br>';	
	echo 'p'.($cont_2-1).' = '.$pn_less.'</br>';
	echo 'p'.$cont_2.' = '.$pn.'</br>';	
	echo 'f('.$pn_less.') = '.$pn_less_evaluo.'</br>';
	echo 'f('.$pn.') = '.$pn_evaluo.'</br>';	
	echo 'p'.($cont_2+1).' = '.$p_n_plus.'</br>';
	$pn_less = $pn;
	$pn = $p_n_plus;

	$cont_2++;
}
