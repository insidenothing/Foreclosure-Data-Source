<?
mysql_connect();
mysql_select_db('mfg');
require "Twitter.class.php";
$tweet = new Twitter("MDForeclosureGp", "zerohour");
//$success = $tweet->update("PHP rocks my socks!");
$success = $tweet->update("Harvey West Update brought to you by: #sponsor this tweet! #".time());
if ($success) echo "Tweet successful!";
else mail('patrick@marylandforeclosuregroup.com','Twitter Error',$tweet->error);



function getPage($url, $referer, $timeout, $header){
	if(!isset($timeout))
        $timeout=30;
    $curl = curl_init();
    if(strstr($referer,"://")){
        curl_setopt ($curl, CURLOPT_REFERER, $referer);
    }
    curl_setopt ($curl, CURLOPT_URL, $url);
    curl_setopt ($curl, CURLOPT_TIMEOUT, $timeout);
    curl_setopt ($curl, CURLOPT_USERAGENT, sprintf("Mozilla/%d.0",rand(4,5)));
    curl_setopt ($curl, CURLOPT_HEADER, (int)$header);
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $html = curl_exec ($curl);
    curl_close ($curl);
    return $html;
}

$html = getPage('http://hwestauctions.com/v1/schedule.v2.php','anarchy.com','20','');
$cut = explode('<table align="center" cellpadding="0" cellspacing="0">
',$html);
$cut = explode('<center>',$cut[1]);
$data=str_replace("<table width='100%' cellspacing='0'><tr><td colspan='2'><div style='text-align:left'>",'[LOOP1]',$cut[0]);
$data=str_replace('<tr>','[LOOP2]',$data);
$data=str_replace('</tr>','',$data);
$data=str_replace('<img src=\'http://download.oracle.com/docs/cd/E10316_01/SiteStudio/10gr4/WebHelp-Contributor/img/line_break.gif\'>','',$data);
$data=str_replace('<td nowrap>','[SPLIT]',$data);
$data=str_replace('</td>','',$data);
$data=str_replace('<br>','',$data);
$data=str_replace('<hr>','',$data);

$loop1 = explode('[LOOP1]',$data);




$new=0;
$counter2 = 0;
$items = count($loop1);
while ($counter < $items){$counter++;
	$loop2 = explode('[LOOP2]',$loop1[$counter]);
	$items2 = count($loop2);
	$date=explode('</div>',$loop1[$counter]);
	$date=str_replace("[LOOP1]","",$date[0]);
	//if ($date != ''){echo "<div>$date</div>";}
	//echo "<div style='background-color:#FFFF00;'>".$loop1[$counter]."</div>";
	$counter2=0;
	while ($counter2 < $items2){$counter2++;
		//echo "<div style='background-color:#00FF00;'>$counter2</div>";
		//echo "<div>";
		$data2=explode('[SPLIT]',$loop2[$counter2]);
		$time=$data2[1];
		$deposit=$data2[2];
		$address=$data2[3].', '.$data2[4];
		$county=str_replace(' CHS','',$data2[5]);
		$adDate=$data2[6];
		$notes=$date.' '.$time.' - '.$deposit.' Ad Start: '.$adDate;
		$notes=str_replace('</table>','',$notes);
		//echo $loop2[$counter2]."<br>";
		$address=addslashes($address);
		$notes=addslashes($notes);
		$r=@mysql_query("select address from hwaSales where address='$address' and notes LIKE '%$notes%'");
		if (!$d=mysql_fetch_array($r,MYSQL_ASSOC)){
		if (trim($address) != '' && trim($address) != ','){
		
		//echo "<li>Time: ".$data2[1]."</li>";
		//echo "<li>Deposit: ".$data2[2]."</li>";
		//echo "<li>Address: ".$data2[3]."</li>";
		//echo "<li>City: ".$data2[4]."</li>";
		//echo "<li>County: ".str_replace(' CHS','',$data2[5])."</li>";
		//echo "<li>Date: ".$data2[6]."</li>";
		if ($county){
		//echo "Key: $key<br>";
		//echo "County: $county<br>";
		//echo "Address: $address<br>";
		//echo "Notes: $notes<br>";
		$new++;
		@mysql_query("insert into hwaSales (id,online,county,address,notes) values ('$key',NOW(),'".addslashes($county)."','$address','$notes') ");
		$body .= "<div>".addslashes($county).", ".addslashes($address).", ".addslashes($notes)."</div>";
		//$success = $tweet->update("Harvey West: $address in $county");
		//if ($success) echo "Tweet successful!";
		//else mail('patrick@marylandforeclosuregroup.com','Twitter Error',$tweet->error);

		}
		//echo mysql_error();	
		}}		
		
		//echo "</div>";
	}
}
if ($new){
	$success = $tweet->update("Harvey West: $new auction updates released at http://bit.ly/bL3TL3");
	if ($success) echo "Tweet successful!";
	else mail('patrick@marylandforeclosuregroup.com','Twitter Error',$tweet->error);
	$attR = @mysql_query("select email, name from jos_users where activation = ''"); // this will only sent to activated accounts
	while ($attD = mysql_fetch_array($attR, MYSQL_ASSOC)){
		$to = "$attD[name] <$attD[email]>";
		$subject = "$new New Auctions Released by Harvey West Auctioneers on ".date('m/d/Y');
		$headers  = "MIME-Version: 1.0 \n";
		$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
		$headers .= "From: Maryland Foreclosure Group <no-reply@marylandforeclosuregroup.com> \n";
		mail($to,$subject,$body,$headers); 
	}
}

//$return=$data;
//echo "<pre>".htmlspecialchars($data)."</pre><hr>";
echo $body;
?>