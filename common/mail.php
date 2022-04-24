<?php

function send_reset_link($destination,$message)
{
		$sendername="SRMS";
		$subject="Password Reset";

		$url="https://email-sender1.p.rapidapi.com/?"
			."txt_msg=".rawurlencode($message)
			."&to=".rawurlencode($destination)
			."&from=".rawurlencode($sendername)
			."&subject=".rawurlencode($subject);

		$curl = curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($curl,CURLOPT_ENCODING,"");
		curl_setopt($curl,CURLOPT_MAXREDIRS,10);
		curl_setopt($curl,CURLOPT_TIMEOUT,30);
		curl_setopt($curl,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
		curl_setopt($curl,CURLOPT_CUSTOMREQUEST,"POST");
		curl_setopt($curl,CURLOPT_POSTFIELDS,"{\r\n    \"key1\": \"value\",\r\n    \"key2\": \"value\"\r\n}");
		curl_setopt($curl,CURLOPT_HTTPHEADER,["content-type: application/json","x-rapidapi-host: email-sender1.p.rapidapi.com","x-rapidapi-key: adfb1d4a0fmsh2af7abe71756cc0p1c2da1jsn9de7d98d964e"]);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);	
		
		return $response;
		
}

?>