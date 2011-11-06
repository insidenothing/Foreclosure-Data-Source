<?
mysql_connect();
mysql_select_db('mfg');
?>
<style>
td { font-size:10pt; }
</style>
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
<table>
	<tr>
		<td>Date Online</td>
		<td>Auction Held</td>
		<td>Property</td>
		<td>Auction Notes</td>
	</tr>
<?
$r=@mysql_query("select online,county, address, notes from tidewaterSales order by uid desc limit 0, 75");
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){
?>
	<tr>
		<td><?=substr($d['online'],0,10);?></td>
		<td><?=$d['county'];?></td>
		<td><?=$d['address'];?></td>
		<td><?=$d['notes'];?></td>
	</tr>
<? } ?>
</table>
