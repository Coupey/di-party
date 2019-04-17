<?php
$emailTo = 'dianna.coupe@gmail.com';
$emailTo2 = 'paulcoupe@gmail.com';
$siteTitle = 'Party';

error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//echo 'hello\n';
//echo $_POST['name'].'\n';
//echo $_POST['extrapeople'].'\n';
//echo $_POST['coming'].'\n';
//echo $_POST['message'].'\n';

//If the form is submitted
if(isset($_POST['submit'])) {
//	echo 'in the whatnot';
    $extraPeople = $_POST['extrapeople'];
    $email = 'party@party.com';

	// require a name from user
	if(trim($_POST['name']) === '') {
		$nameError =  'Forgot your name!';
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}

	if(trim($_POST['coming']) === '')  {
		$emailError = 'Hey! Tell me if you\'re coming or not';
		$hasError = true;
	} else {
		$coming = trim($_POST['coming']);
	}

	// we need at least some content
    if(function_exists('stripslashes')) {
        $comments = stripslashes(trim($_POST['message']));
    } else {
        $comments = trim($_POST['message']);
    }

	// upon no failure errors let's email now!
	if(!isset($hasError)) {
        if($_POST['coming'] === 'yes') {
            $comeMessage = " - they're coming! :)";
        } else {
            $comeMessage = " - they can't come :(";
        }
		$subject = $name.' has RSVPed'.$comeMessage;
		$body = "Name: $name \n\nBringing this many other people: $extraPeople \n\nMessage: $comments";
		$headers = 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		mail($emailTo2, $subject, $body, $headers);
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
//echo 'out the whatnot';

header('Location: thanks.html');
?>
