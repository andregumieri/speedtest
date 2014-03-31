#!/usr/bin/php
<?php
	date_default_timezone_set('america/sao_paulo');

	// Initialize cURL with given url
	function speedtest($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		 
		// set_time_limit(65);
		 
		$execute = curl_exec($ch);
		$info = curl_getinfo($ch);	
		// curl_close($ch);

		return $info['speed_download']/1024/1024; // MBps
	}


	$testes = array(
		'http://186.225.127.178/speedtest/random350x350.jpg?x=' . time() . '&y=1',
		'http://186.225.127.178/speedtest/random350x350.jpg?x=' . time() . '&y=2',
		'http://186.225.127.178/speedtest/random1500x1500.jpg?x=' . time() . '&y=1',
		'http://186.225.127.178/speedtest/random1500x1500.jpg?x=' . time() . '&y=2',
		'http://186.225.127.178/speedtest/random1500x1500.jpg?x=' . time() . '&y=3',
		'http://186.225.127.178/speedtest/random1500x1500.jpg?x=' . time() . '&y=4',
		'http://186.225.127.178/speedtest/random3500x3500.jpg?x=' . time() . '&y=1',
		'http://186.225.127.178/speedtest/random3500x3500.jpg?x=' . time() . '&y=2',
		'http://186.225.127.178/speedtest/random3500x3500.jpg?x=' . time() . '&y=3',
		'http://186.225.127.178/speedtest/random3500x3500.jpg?x=' . time() . '&y=4'
	);


	$soma = 0;
	foreach($testes as $url) {
		$resultado = speedtest($url);
		$soma += $resultado;
	}

	$velocidade = 'DW ' . round(($soma/count($testes))*8) . ' Mbps' . "\n";

	file_put_contents(__DIR__.'/reports.txt', date('d/m/Y H:i:s') . ' ' . $velocidade, FILE_APPEND);
	echo $velocidade;
?>