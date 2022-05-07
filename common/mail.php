<?php
function send_reset_link($destination,$reset_link)
{
	$subject = "Account Recovery - SRMS";
	$message = '<table  style="background-color:#efefef" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td valign="top" align="center">
	<table style="border:0;background-color:#efefef;padding-left:20px;padding-right:20px" width="640" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr><td><table style="border:0;background-color:#ffffff;margin-top:0" width="600" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr><td style="padding:10px 0 10px 30px;text-align:right" width="200" valign="middle" height="60" bgcolor="#efefef" align="left">
	<div style="font-size:14px;letter-spacing:1px;font-weight:bold;color:#787878"><span style="width:130px;height:auto" width="130" height="auto" border="0" align="bottom"> SRMS </span></div></td></tr></tbody></table>
	<table style="border:1px solid #dddddd;background-color:#ffffff" width="600" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr><td colspan="2" style="padding:30px 30px 0 30px;font-family:Arial;color:#444444;font-size:14px;line-height:1.5em" valign="top" align="left">
	<div style="font-size:14px;line-height:1.6em;color:#444444;text-align:left">
	<p>We have received a password reset request for <a href="mailto:'.$destination.'" target="_blank">'.$destination.'</a>.</p>
	<p>Please click the below button to reset your password.</p>
	<p><a style="box-sizing:border-box;padding:10px;border-radius:5px;background:gray;text-decoration:none;font-weight:bold;margin:25px auto;color:#fff" 
	href="'.$reset_link.'" target="_blank">Reset Password</a></p><br>
	<hr style="color:#efefef"><p>Thank you,</p><p>SRMS Technical Support</p></div></td></tr></tbody></table>
	<table style="background-color:#ffffff;border:0;border-bottom:0;margin-top:20px" width="600" cellspacing="0" cellpadding="0" border="0">
	<tbody><tr><td style="vertical-align:top;text-align:center;padding-bottom:20px;padding-top:0;padding-left:0;padding-right:0"></td></tr>
	<tr><td style="color:#808080;font-size:12px;line-height:150%;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;text-align:center">
	<div>You are receiving this email because <a href="mailto:'.$destination.'" target="_blank">'.$destination.'</a> is registered on SRMS.</div></td></tr><tr>
	<td style="color:#808080;font-size:12px;line-height:150%;padding-top:0;padding-right:0;padding-bottom:20px;padding-left:0;text-align:center">
	<div>Please do not reply directly to this email.</div></td></tr><tr>
	<td style="color:#808080;font-size:12px;line-height:150%;padding-top:0;padding-right:0;padding-bottom:20px;padding-left:0;text-align:center;background:#efefef;" valign="top">SRMS&nbsp;</td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>';
	
	$url = "https://email-sender1.p.rapidapi.com/?txt_msg=%20&to=".
			rawurlencode($destination)."&from=SRMS&subject=".
			rawurlencode($subject)."&html_msg=".
			rawurlencode($message)."";

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
	curl_setopt($curl,CURLOPT_HTTPHEADER,["X-RapidAPI-Host: email-sender1.p.rapidapi.com","X-RapidAPI-Key:<API-KEY>",
						  "content-type: application/json"]);
	curl_exec($curl);
	curl_close($curl);
}
?>
