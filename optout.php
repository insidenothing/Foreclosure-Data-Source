<? 
mysql_connect();
mysql_select_db('mfg');
if ($_GET[email]){
	@mysql_query("insert into optout (email) values ('$_GET[email]')");
	mail('marketing@marylandforeclosuregroup.com','OPT-OUT','Opt-Out Notice: '.$_GET[email]);
	echo "Confirmed, $_GET[email] is now opt-out.";
}
?>
<form>
<table align="center">
	<tr>
		<td>1) Please do not send any emails to:</td>
		<td><input name="email"></td>
	</tr>	
	<tr>
		<td>2) Confirm</td>
		<td><input type="submit" value="Opt-Out"></td>
	</tr>	
</table>
</form>