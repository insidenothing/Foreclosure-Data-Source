<meta http-equiv="refresh" content="300" />

<?

mysql_connect();
mysql_select_db('mfg');

mysql_query("update craigslistPages set status = 'No E-Mail' WHERE status = 'Ready' and email = ''");
?><table align="center" style="font-size:20px;">	<tr>
		<td colspan="2"><?=date('r');?></td>
	</tr>

<?
$r = mysql_query("SELECT DISTINCT status FROM craigslistPages");
while ($d=mysql_fetch_array($r,MYSQL_ASSOC)){



$r2 = mysql_query("SELECT status FROM craigslistPages WHERE status = '$d[status]'");
$new = mysql_num_rows($r2);

?>
	<tr>
		<td><?=$d[status]?></td>
		<td><?=$new?></td>
	</tr>
<? } ?>	
</table>
<div align="center"><a href="craigslist.marketing.php" target="_Blank">Search for new leads</a> | <a href="spooler.ai.php" target="_Blank">Collect some email addresses</a> | <a href="invite.ai.php" target="_Blank">Send a batch of invites</a> | <a href="ai.status.php">A.I. Health</a></div>
