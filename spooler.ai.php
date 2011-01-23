<?

function ai($str){
		error_log("[".date('r')."] [spooler] [".trim($str)."]\n", 3, '/logs/ai/craigslist.log');
}
mysql_connect();
mysql_select_db('mfg');
function getPage($url, $referer, $timeout, $header){
	ai("Loading: ".$url);
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

$r=@mysql_query("select * from craigslistPages where status = 'New' order by craw limit 0,500 "); // process a maximum of 500 at a time
while($d=mysql_fetch_array($r,MYSQL_ASSOC)){
	$html = getPage($d[page],'anarchy.com','2','');
	$html = str_replace('mailto:','[a]',$html);
	$html = str_replace('?subject','[b]',$html);
	$splat = $html;
	$splat = explode('[a]',$splat);
	$spot = explode('[b]',$splat[1]);
	$email = $spot[0];

	$bump = explode('"',$email);
	$test = count($bump);
	if ($test > 0){
		$email = $bump[0];

	}
	if (!$email){
		@mysql_query("update craigslistPages set status='404' where page = '$d[page]'");
		ai("404 (Set to Reproces): ".$d[page]);
	}else{
		$pos = strpos($email,'craigslist');
		
		if ($pos === false) {
		ai("Ready: ".$email);
			$test = 'ready';	
		} else {
			$test = 'stop';
		ai("Exclude Craigslist: ".$email);

			}
		
		if ($test == 'ready'){
			@mysql_query("update craigslistPages set status='Ready', email='$email' where page = '$d[page]'");
		}else{
			@mysql_query("update craigslistPages set status='Craigslist', email='$email' where page = '$d[page]'");
		}
	}
}


$r=@mysql_query("select * from craigslistPages where status = '404' order by craw limit 0,500 "); // process a maximum of 500 at a time
while($d=mysql_fetch_array($r,MYSQL_ASSOC)){
	$modPage = str_replace('/hhh','',$d[page]);
	$modPage = str_replace('/bbb','',$modPage);
	$modPage = str_replace('/sss','',$modPage);
	$modPage = str_replace('/jjj','',$modPage);
	$modPage = str_replace('/ccc','',$modPage);
	$modPage = str_replace('/ggg','',$modPage);
	$html = getPage($modPage,'anarchy.com','2','');
	$html = str_replace('mailto:','[a]',$html);
	$html = str_replace('?subject','[b]',$html);
	$splat = $html;
	$splat = explode('[a]',$splat);
	$spot = explode('[b]',$splat[1]);
	$email = $spot[0];
	ai("Raw E-Mail: ".$email);

	$bump = explode('"',$email);
	$test = count($bump);
	if ($test > 0){
		$email = $bump[0];
	ai("ModPage Clean Email: ".$email);

	}
	if (!$email){
		@mysql_query("update craigslistPages set status='Dead' where page = '$d[page]'");
		ai("ModPage Attempt to correct failed, marking link dead: ".$d[page]);
	}else{
		$pos = strpos($email,'craigslist');
		
		if ($pos === false) {
		ai("ModPage Ready: ".$email);
			$test = 'ready';	
		} else {
			$test = 'stop';
		ai("ModPage Exclude Craigslist: ".$email);

			}
		
		if ($test == 'ready'){
			@mysql_query("update craigslistPages set status='Ready', email='$email' where page = '$d[page]'");
		}else{
			@mysql_query("update craigslistPages set status='Craigslist', email='$email' where page = '$d[page]'");
		}
	}
}
?>
