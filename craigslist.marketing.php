<?
function ai($str){
		error_log("[".date('r')."] [marketing] [".trim($str)."]\n", 3, '/logs/ai/craigslist.log');
}

mysql_connect();
mysql_select_db('mfg');
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
function craw($page){
	$list = getPage($page,'anarchy.com','20','');
	$cut = explode('</table>',$list);
	$start = $cut[2];
	$cut = explode('<p align="center">',$start);
	$list = $cut[0];
	$list = str_replace('<p><a href="','[a]',$list);
	$list = str_replace('html">','html[b]',$list);
	$list = str_replace('</a></i></p>','[loop]',$list);
	$data = explode('[loop]',$list);
	$loops = count($data);
	$i=0;
	while($i<$loops){$i++;
		$splat = $data[$i];
		$splat = explode('[a]',$splat);
		$spot = explode('[b]',$splat[1]);
		$spot = $spot[0];
		if ($spot){
			$seek = substr($page, 0, -1).$spot;
			if(mysql_query("insert into craigslistPages (page, status, craw) values ('$seek', 'New', NOW())")){
				ai("New Lead: ".$seek);
			}else{
				//ai("Existing Lead: ".$seek);
			}
		}
	}
}

function locationCraw($city){
	ai("Craw: http://$city.craigslist.org/hhh/");
	craw('http://'.$city.'.craigslist.org/hhh/');
	ai("Craw: http://$city.craigslist.org/bbb/");
	craw('http://'.$city.'.craigslist.org/bbb/');
	//ai("Craw: http://$city.craigslist.org/sss/");// throwing 404 errors on the sub folders
	//craw('http://'.$city.'.craigslist.org/sss/');
	//ai("Craw: http://$city.craigslist.org/jjj/");
	//craw('http://'.$city.'.craigslist.org/jjj/');
	ai("Craw: http://$city.craigslist.org/ccc/");
	craw('http://'.$city.'.craigslist.org/ccc/');
	ai("Craw: http://$city.craigslist.org/ggg/");
	craw('http://'.$city.'.craigslist.org/ggg/');
}
locationCraw('baltimore');
locationCraw('annapolis');
locationCraw('chambersburg');
locationCraw('easternshore');
locationCraw('frederick');
locationCraw('smd');
locationCraw('westmd');


	?>
