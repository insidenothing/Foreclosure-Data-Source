<?
mysql_connect();
mysql_select_db('mfg');
require "Twitter.class.php";
$tweet = new Twitter("MDForeclosureGp", "zerohour");
//$success = $tweet->update("PHP rocks my socks!");
$success = $tweet->update("Tidewater Update brought to you by: #sponsor this tweet! #".time());
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

$html = getPage('http://client.tidewaterauctions.com/public/','anarchy.com','20','');
$cut = explode('<table cellspacing="0" rules="all" border="1" id="ctl00_ContentPlaceHolder1_gvstatus" height="157" width="711">',$html);
$cut = explode('</table>',$cut[1]);
$data = str_replace('<font face="Arial" size="2">','',$cut[0]);
$data = str_replace('</font>','',$data);
$data = str_replace('<th scope="col">','',$data);
$data = str_replace('<font face="Arial" color="Blue" size="2">','',$data);
$data = str_replace('<td>','',$data);
$data = str_replace('<a href="javascript:__doPostBack(\'ctl00$ContentPlaceHolder1$gvstatus\',\'Sort$Saledate\')">','',$data);
$data = str_replace('<a href="javascript:__doPostBack(\'ctl00$ContentPlaceHolder1$gvstatus\',\'Sort$Countyname\')">','',$data);
$data = str_replace('<span id="ctl00_ContentPlaceHolder1_gvstatus_ct','[WEBID',$data);
$data = str_replace('_lblsalid">',']',$data);
$data = str_replace('<font color="Blue">','',$data);
$data = str_replace('</span>','',$data);
$data = str_replace('</a>','',$data);
$data = str_replace('<a id="ctl00_ContentPlaceHolder1_gvstatus_ct','[WEBID',$data);
$data = str_replace('</tr>','',$data);
$data = str_replace('">Map','',$data);
$data = str_replace('_hypSale" href="http://maps.google.com/maps?daddr=','MAP]',$data);
$data = str_replace('<strike>','',$data);
$data = str_replace('</strike>','',$data);
$data = str_replace('<td nowrap="nowrap">','',$data);


$data = str_replace('</td>','[SPLIT]',$data);
$data = str_replace('<tr>','[LOOP]',$data);

function cleanString($id,$str){
	$remove1 = "[WEBID".trim($id)."]";
	$remove2 = "[WEBID".trim($id)."MAP]";
	$str2 = str_replace($remove1,'',$str);
	$str2 = str_replace($remove2,'',$str2);
return $str2;
}

$loop = explode('[LOOP]',$data);
$new=0;
$counter = 0;
$items = count($loop);
while ($counter < $items){
$counter++;
echo "<div style='border:solid 1px;'>";

$split = explode('[SPLIT]',$loop[$counter]);


$webID = $split[0];
$webIDMain = str_replace('[WEBID','',$webID);
$webIDSub = explode(']',$webIDMain);
$webID = $webIDSub[0];
$webClient = $webIDSub[1];

$key = cleanString($webID,$split[0]);
$county = cleanString($webID,$split[9]);
$address = cleanString($webID,$split[6]);
$notes =   cleanString($webID,$split[2])." ".cleanString($webID,$split[4]);



$r=@mysql_query("select address from tidewaterSales where address='$address' and notes = '$notes'");
if (!$d=mysql_fetch_array($r,MYSQL_ASSOC)){
if ($address){
$new++;

echo "Key: $key<br>";
echo "County: $county<br>";
echo "Address: $address<br>";
echo "Notes: $notes<br>";


@mysql_query("insert into tidewaterSales (id,online,county,address,notes) values ('$key',NOW(),'".addslashes($county)."','".addslashes($address)."','$notes') ");
$body .= "<div>".addslashes($county).", ".addslashes($address).", ".addslashes($notes)."</div>";
		//$success = $tweet->update("Tidewater: $address in $county");
		//if ($success) echo "Tweet successful!";
		//else mail('patrick@marylandforeclosuregroup.com','Twitter Error',$tweet->error);

echo mysql_error();	
}}

echo "</div>";
}

if ($new){
	$success = $tweet->update("Tidewater: $new auction updates released at http://bit.ly/9u9Reo");
	if ($success) echo "Tweet successful!";
	else mail('patrick@marylandforeclosuregroup.com','Twitter Error',$tweet->error);
	$attR = @mysql_query("select email, name from jos_users where activation = ''"); // this will only sent to activated accounts
	while ($attD = mysql_fetch_array($attR, MYSQL_ASSOC)){
		$to = "$attD[name] <$attD[email]>";
		$subject = "$new New Auctions Released by Tidewater Auctioneers on ".date('m/d/Y');
		$headers  = "MIME-Version: 1.0 \n";
		$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
		$headers .= "From: Maryland Foreclosure Group <no-reply@marylandforeclosuregroup.com> \n";
		mail($to,$subject,$body,$headers); 
	}
}

?>