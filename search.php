<?
mysql_connect();
mysql_select_db('mfg');
function highlight($search,$str){
	$final = str_replace(strtoupper($search),'<a style="background-color:#FFFF00 !important;">'.strtoupper($search).'</a>',strtoupper($str));
	return $final;
}

?>
<style>
body {
	background-color: #FFF;
}

td {
	font-size: 10pt;
}
</style>
<div>
	<b>Database Search</b>
</div>
<table>
	<tr>
		<td colspan="4"
			<form><div><input name="q"><input type="submit" value="Search Database"></div>
<?php  if ($_GET['q']){ $i=0; ?>
		</td>
	</tr>
<tr>
	<td colspan="4">
		<div align="center">
			<script type="text/javascript"><!--
google_ad_client = "ca-pub-2410355655106377";
/* mfg page */
google_ad_slot = "8350166361";
google_ad_width = 728;
google_ad_height = 90;
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
$r=@mysql_query("select online, county, address, notes from tidewaterSales where county like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Tidewater</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from hwaSales where county like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Harvey West</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from cooperSales where county like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Alex Cooper</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from atlanticSales where county like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Mid-Atlantic</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from tidewaterSales where address like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Tidewater</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from cooperSales where address like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Alex Cooper</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from hwaSales where address like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Harvey West</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from atlanticSales where address like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Mid-Atlantic</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from hwaSales where notes like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Harvey West</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from tidewaterSales where notes like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Tidewater</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from cooperSales where notes like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Alex Cooper</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<?
$r=@mysql_query("select  online, county, address, notes from atlanticSales where notes like '%".$_GET['q']."%' order by uid desc limit 0, 500") or die(mysql_error());
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){ $i++;
?>
	<tr>
		<td>Mid-Atlantic</td>
		<td><?php  echo substr($d['online'],0,10);?></td>
		<td><?php  echo highlight($_GET['q'],$d['county']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['address']);?></td>
		<td><?php  echo highlight($_GET['q'],$d['notes']);?></td>
	</tr>
<?php  } ?>
<tr>
	<td colspan="4">
		<div align="center">
			
			<script type="text/javascript"><!--
google_ad_client = "ca-pub-2410355655106377";
/* mfg page */
google_ad_slot = "8350166361";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>



		</div>
	</td>
</tr>
Searching for <b><?php  echo $_GET['q'];?></b>, <em><?php  echo $i?> auctions found</em>
</table>



<?php  } ?>