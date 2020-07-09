<?php 
	//json_encode($_POST);
	$error = '';
	$return['dummy'] = '';
	if (!isset($_POST['userName']) || !isset($_POST['userEmail']) || !isset($_POST['userMessage'])) {
		$error = 'Please enter data correctly.';
	}

	if($error){
		$return["text"] = $error;
		$return["type"] = 'error';
	}else{

		$to = "info@treehouses.co.in";
		$subject = "A new query posted on info@treehouses.co.in";

		$message = "
		<html>
		<head>
		</head>
		<body>
		<p>New query</p>
		<table>
		<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Message</th>
		</tr>
		<tr>
		<td>".$_POST['userName']."</td>
		<td>".$_POST['userEmail']."</td>
		<td>".$_POST['userMessage']."</td>
		</tr>
		</table>
		</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <info@treehouses.co.in>' . "\r\n";

		try {
			if(mail($to,$subject,$message,$headers)){
				$return["text"] = 'Email Sent Successfully. We will contact you soon!';
				$return["type"] = 'success';
			}
		}
		catch(Exception $e) {
		  	$return["text"] = 'Some error occurred. Please try again!';
			$return["type"] = 'error';
		}
	}
	
  	echo json_encode($return);
?>