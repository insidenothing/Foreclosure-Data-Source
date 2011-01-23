<title>Maryland Auction Pulse</title>
<?
mysql_connect();
mysql_select_db('mfg');
?>
<div>Please note that this is public collected data, there is no censorship!</div> 
<div>Here is a taste of the last auction appearing online per source.</div>
<table>
	<tr>
		<td valign="top">
		<?
		$r=@mysql_query("select * from atlanticSales order by uid desc limit 0, 1");
		while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){
		?>
		<li>Mid-Atlantic: <?=$d[online]?> for <?=$d[county];?><br /><?=$d[address];?><br /><small><?=$d[notes];?></small></li>
		<? } ?>
				<?
		$r=@mysql_query("select * from cooperSales order by uid desc limit 0, 1");
		while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){
		?>
		<li>Alex Cooper: <?=$d[online]?> for <?=$d[county];?><br /><?=$d[address];?><br /><small><?=$d[notes];?></small></li>
		<? } ?>
		<?
		$r=@mysql_query("select * from tidewaterSales order by uid desc limit 0, 1");
		while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){
		?>
		<li>Tidewater: <?=$d[online]?> for <?=$d[county];?><br /><?=$d[address];?><br /><small><?=$d[notes];?></small></li>
		<? } ?>
	<?
		$r=@mysql_query("select * from hwaSales order by uid desc limit 0, 1");
		while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){
		?>
		<li>Harvey West: <?=$d[online]?> for <?=$d[county];?><br /><?=$d[address];?><br /><small><?=$d[notes];?></small></li>
		<? } ?>
</td>
	</tr>
</table>
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
		
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='http://www.google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-9542421-6");
pageTracker._trackPageview();
} catch(err) {}</script>