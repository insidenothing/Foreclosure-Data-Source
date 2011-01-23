<?
function ai($str){
		error_log("[".date('r')."] [invite] [".trim($str)."]\n", 3, '/logs/ai/craigslist.log');
}

mysql_connect();
mysql_select_db('mfg');
require_once 'class.phpmailer.php';

function sendInvite($to){
	$r=@mysql_query("select email from optout where email = '$to'");
	$d=mysql_fetch_array($r,MYSQL_ASSOC);
	
	
	if($d[email]){
		@mysql_query("update craigslistPages set status='Opt-Out' where email='$to'");
		ai("Opt-Out: ".$to);
	}else{
	$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
	try {
	  $mail->AddReplyTo('patrick@mdwestserve.com', 'Patrick McGuire');
	  $mail->AddAddress($to, ''); // who we are sending to
	  $mail->AddAddress('marketing@marylandforeclosuregroup.com', 'MFG Marketing'); // since cc and bcc dont work let's try this
	  $mail->SetFrom('patrick@mdwestserve.com', 'Patrick McGuire');
	  //$mail->AddReplyTo('patrick@mdwestserve.com', 'Patrick McGuire');
	  $mail->Subject = 'Patrick Invites you to the Maryland Foreclosure Group';
	  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
	  $mail->MsgHTML(file_get_contents('/sandbox/patrick/MAP/invite.html'));
	  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
	  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
	  $mail->Send();
	  //echo "Message Sent OK</p>\n";
		@mysql_query("update craigslistPages set status='Sent' where email='$to'");
		ai("Invite Sent: ".$to);

	} catch (phpmailerException $e) {
	  echo $e->errorMessage(); //Pretty error messages from PHPMailer
	} catch (Exception $e) {
	  echo $e->getMessage(); //Boring error messages from anything else!
	}
	}
}
//sendInvite('insidenothing@gmail.com');

$r=@mysql_query("select * from craigslistPages where status = 'Ready' and email <> '' limit 0,25 "); // process a maximum of 25 at a time
while($d=mysql_fetch_array($r,MYSQL_ASSOC)){
	sendInvite($d['email']);
}

	?>