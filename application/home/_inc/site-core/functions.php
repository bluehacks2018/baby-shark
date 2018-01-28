<?php
	include "conn.php";

	require '/../twilio-core/Twilio/autoload.php';
	use Twilio\Rest\Client;

	function checkUserExist($check, $conn) {
		if($stmt = $conn->prepare("SELECT * FROM users WHERE contact = ?")) {
			$stmt->bind_param('s', $check);

			if($stmt->execute()) {
				$stmt->store_result();
				if($stmt->num_rows > 0) {
					return true;
				}else{
					return false;
				}
			}
		}
	}

	function sendCode($phone, $conn) {
		$rand = rand(1000, 9999);
		/*$sid = 'AC2f4c0ee47c0ddb0fdd4d24f1e466e8ec';
		$token = 'db593922c3a0886674a965b541ceaba2';
		$client = new Client($sid, $token);
		$client->messages->create(
		    $phone,
		    array(
		        'from' => '+17722915287',
		        'body' => $rand
		    )
		);*/

		if($stmt = $conn->prepare("UPDATE users SET code = ? WHERE contact = ?")) {
			$stmt->bind_param("is", $rand, $phone);
			if($stmt->execute()) {
				return true;
			}else{
				return false;
			}
		}
	}

	function checkCode($code, $phone, $conn) {
		$stmt = $conn->prepare("SELECT contact FROM users WHERE contact = ? LIMIT 1");
		$stmt->bind_param("s", $phone);
		$row = $stmt->fetch();
		if($code == $row['code'])
			return true;
		else
			return false;
	}

	function registerUser($fname, $mname, $lname, $gender, $street, $city, $brgy, $state, $phone, $picture, $conn) {
		if(!checkUserExist($phone, $conn)) {
			if($stmt = $conn->prepare("INSERT INTO users (first_name, middle_name, last_name, gender, street, barangay, city, state, contact, picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
				$stmt->bind_param("ssssssssss", $fname, $mname, $lname, $gender, $street, $city, $brgy, $state, $phone, $picture);

				$stmt->execute();

				return true;
			}
		}else{
			//Existing user
			return false;
		}
	}
?>