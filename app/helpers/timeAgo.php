<?php

// Configurando o fuso horário
// Definindo o fuso horário para o Brasil
define('TIMEZONE', 'America/Sao_Paulo');
date_default_timezone_set(TIMEZONE);

function ultimo_acesso($data_hora){

   $timestamp = strtotime($data_hora);	
   
   $strTempo = array("segundo", "minuto", "hora", "dia", "mês", "ano");
   $duracao = array("60","60","24","30","12","10");

   $horaAtual = time();
   if($horaAtual >= $timestamp) {
		$diferenca     = time() - $timestamp;
		for($i = 0; $diferenca >= $duracao[$i] && $i < count($duracao)-1; $i++) {
			$diferenca = $diferenca / $duracao[$i];
		}

		$diferenca = round($diferenca);
		if ($diferenca < 59 && $strTempo[$i] == "segundo") {
			return 'Ativo';
		} else {
			return $diferenca . " " . $strTempo[$i] . "(s) atrás ";
		}
		
   }
}
