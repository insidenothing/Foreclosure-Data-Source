<?
mysql_connect();
mysql_select_db('mfg');
function highlight($search,$str){
$final = str_replace(strtoupper($search),'<a style="background-color:#FFFF00 !important;">'.strtoupper($search).'</a>',strtoupper($str));
return $final;
}

?>
<style>
body { background-color:#FFF; }
td { font-size:10pt; }
</style>
<div><b>Please note that this is public collected data, there is no censorship!</b></div> 
<table>
	<tr>
		<td colspan="4"
<form><div><input name="q"><input type="submit" value="Search Database"></div>
<? if ($_GET['q']){ $i=0; ?>
		</td>
	</tr>
<tr>
	<td colspan="4">
		<div align="center">
			<script type="text/javascript"><!--
			google_ad_client = "pub-2410355655106377";
			/* Large Wrapper Ad&#39;s */
			google_ad_slot = "6132590112";
			google_ad_width = 468;
			google_ad_height = 60;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
	</td>
</tr>
	<tr>
		<td>Auctioneers</td>
		<td>Date Online</td>
		<td>Auction Held</td>
		<td>Property</td>
		<td>Auction Notes</td>
	</tr>
<?
$r=@mysql_query("select * from tidewaterSales where county like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Tidewater</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from hwaSales where county like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Harvey West</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from cooperSales where county like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Alex Cooper</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from atlanticSales where county like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Mid-Atlantic</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from tidewaterSales where address like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Tidewater</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from cooperSales where address like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Alex Cooper</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from hwaSales where address like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Harvey West</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from atlanticSales where address like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Mid-Atlantic</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from hwaSales where notes like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Harvey West</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from tidewaterSales where notes like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Tidewater</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from cooperSales where notes like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Alex Cooper</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<?
$r=@mysql_query("select * from atlanticSales where notes like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Mid-Atlantic</td>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=highlight($_GET['q'],$d[county]);?></td>
		<td><?=highlight($_GET['q'],$d[address]);?></td>
		<td><?=highlight($_GET['q'],$d[notes]);?></td>
	</tr>
<? } ?>
<tr>
	<td colspan="4">
		<div align="center">
			<script type="text/javascript"><!--
			google_ad_client = "pub-2410355655106377";
			/* Large Wrapper Ad&#39;s */
			google_ad_slot = "6132590112";
			google_ad_width = 468;
			google_ad_height = 60;
			//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
	</td>
</tr>
Searching for <b><?=$_GET['q'];?></b>, <em><?=$i?> auctions found</em>
</table>



<? } ?>