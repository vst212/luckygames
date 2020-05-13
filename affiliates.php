<?php
	$userAdmin = 'YOUR NICK';

	require_once('referrals.php');

	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');

	function xss_protect(&$key) {
	    $key = htmlspecialchars($key);
	}
	array_walk($_POST, 'xss_protect');
	extract($_POST);

	if(isset($newReffer)){
		if(!in_array($newReffer, $referrals)){
			array_push($referrals, $newReffer);
			$data = fopen('referrals.php', 'w');
			fwrite($data, "<?php\n\$referrals = " . json_encode($referrals) . ";");
			fclose($data);
			echo '{"msg":"New referral '.$newReffer.' registered"}';
		} else {
			echo '{"msg":"Referral '.$newReffer.' already registered"}';
		}
		exit();
	}

	if(isset($isReffer)){
		echo '{"msg":"'.(in_array($isReffer, $referrals) || $userAdmin === $isReffer ? '$.getScript(\"https://'.$_SERVER['HTTP_HOST'].'/yourscript.js\")' : 'alert(\"You need to be referred from '.$userAdmin.' to use this script\")').'"}';
		exit();
	}

	if(isset($myReffer)){
		echo json_encode($referrals);
	}
