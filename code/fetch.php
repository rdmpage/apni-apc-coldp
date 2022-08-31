<?php

//----------------------------------------------------------------------------------------
function get($url)
{
	$data = '';
	
	$ch = curl_init(); 
	curl_setopt ($ch, CURLOPT_URL, $url); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION,	1); 
	curl_setopt ($ch, CURLOPT_HEADER,		  1);  
	
	// timeout (seconds)
	curl_setopt ($ch, CURLOPT_TIMEOUT, 120);

	curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
	
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST,		  0);  
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER,		  0);  
	
	$curl_result = curl_exec ($ch); 
	
	if (curl_errno ($ch) != 0 )
	{
		echo "CURL error: ", curl_errno ($ch), " ", curl_error($ch);
	}
	else
	{
		$info = curl_getinfo($ch);
		
		// print_r($info);		
		 
		$header = substr($curl_result, 0, $info['header_size']);
		
		// echo $header;
		
		//exit();
		
		$data = substr($curl_result, $info['header_size']);
		
	}
	return $data;
}

//----------------------------------------------------------------------------------------


$filename = 'refids.txt';

$count = 1;

$file_handle = fopen($filename, "r");
while (!feof($file_handle)) 
{
	
	$id = trim(fgets($file_handle));
	
	echo $id;
	
	$output_filename = 'json/' . $id . '.json';	
	
	if (!file_exists($output_filename)
	{
	
		$url = 'https://biodiversity.org.au/nsl/services/rest/reference/apni/' . $id . '.json';
	
		$json = get($url);
	
		if ($json)
		{	
			echo " ok";
			file_put_contents($output_filename, $json);	
		}
		else
		{
			echo " failed";
		}
	}
	else
	{
		echo " have already";
	}
	echo "\n";

	// Give server a break every 10 items
	if (($count++ % 10) == 0)
	{
		$rand = rand(1000000, 3000000);
		echo "\n...sleeping for " . round(($rand / 1000000),2) . ' seconds' . "\n\n";
		usleep($rand);
	}
	
}

?>
