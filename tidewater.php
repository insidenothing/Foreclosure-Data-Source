<?
mysql_connect();
mysql_select_db('mfg');
?>
<style>
td { font-size:10pt; }
</style>
<table>
	<tr>
		<td>Date Online</td>
		<td>Auction Held</td>
		<td>Property</td>
		<td>Auction Notes</td>
	</tr>
<?
$r=@mysql_query("select * from tidewaterSales order by uid desc limit 0, 1000");
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){
?>
	<tr>
		<td><?=substr($d[online],0,10);?></td>
		<td><?=$d[county];?></td>
		<td><?=$d[address];?></td>
		<td><?=$d[notes];?></td>
	</tr>
<? } ?>
</table>
