<?php
session_start();
$_SESSION['user'];

function esc($ertek)
{
	// Stripslashes
#   if (get_magic_quotes_gpc()) {
#       $ertek = stripslashes($ertek);
#   }
   // Idézo~jelezés, ha nem egész érték
#   if (!is_numeric($ertek)) {
#       $ertek = mysqli_real_escape_string($ertek);
#   }
   return $ertek;
}

function registerUser($username, $password, $year, $fullname, $phone, $email, $gender) {
	global $db;
	$db->DB_connect;
	if (in_array($db->getErrorCode(), array(1046, 1049))) {
		include("inc/install.php");
	}
	$db->DB_query("INSERT INTO users (username, password, year, fullname, phone, email, gender, userlevel) VALUES ('$username', '".md5($password)."', '$year', '$fullname','$phone','$email','$gender', '0')");
	$id = $db->get_last_id();
}

function updateUser($userid, $username, $password, $year, $fullname, $phone, $email, $gender) {
	global $db;
	$db->DB_connect;
	if (empty($password)) {
		$db->DB_query("UPDATE users SET fullname = '$fullname', year = '$year', phone = '$phone', email = '$email', gender = '$gender' WHERE username = '$username'");
	}
	else {
		$db->DB_query("UPDATE users SET password = '$password', fullname = '$fullname', year = '$year', phone = '$phone', email = '$email', gender = '$gender' WHERE username = '$username'");
	}
	$id = $db->get_last_id();
}

function updateRestaurant($name, $cusine, $address, $phone, $email, $restaurant_id) {
	global $db;
	$db->DB_connect;
	$db->DB_query("UPDATE restaurants SET name = '$name', cusine = '$cusine', address = '$address', phone = '$phone', email = '$email' WHERE id = '$restaurant_id'");
	$id = $db->get_last_id();
}

function updateItem($item_id, $itemname, $ingredients, $price, $category) {
	global $db;
	$db->DB_connect;
	$db->DB_query("UPDATE menus SET itemname = '$itemname', ingredients = '$ingredients', price = '$price', category = '$category' WHERE id = '$item_id'");
	$id = $db->get_last_id();
}

function deleteRestaurant($id) {
	global $db;
	$db->DB_connect;
	$db->DB_query("DELETE FROM restaurants WHERE id = '$id'");
	$db->DB_query("DELETE FROM menus WHERE restaurant_id = '$id'");
}

function unregisterUser($id) {
	global $db;
	$db->DB_connect;
	$db->DB_query("DELETE FROM users WHERE id = '$id'");
}

function checkLogin( $username, $password )
{	
	global $db;
	$db->DB_connect;
	$query = $db->DB_query( sprintf("SELECT * FROM users WHERE username='%s' AND password='%s'",esc($username), md5(esc($password))) );
	if ($query && mysqli_num_rows($query) != 1) {
		//DB_disconnect();
		return null;
	} 
	$row = $db->DB_getnextrow();
	return $row["id"];
}

function checkUserLevel( $username ) {	
	$retVal = "";
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT userlevel FROM users WHERE username = '".$username."'");
	$row = $db->DB_getnextrow();
	return $row["userlevel"];
}

function checkUserExist( $username ) {	
	global $db;
	$db->DB_connect;
	$query = $db->DB_query( sprintf("SELECT * FROM users WHERE username='%s'",esc($username) ) );
	if ($query && mysqli_num_rows($query) > 0) {
		//DB_disconnect();
		return true;
	} 
	return false;
}

function azonositas() {
	$username = $_SESSION["user"]["username"];
	global $db;
	$db->DB_connect;
	$db->DB_query("SELECT * FROM users WHERE username='".$username."';");
	if (! $row = $db->DB_getnextrow() )
	{
		$_SESSSION["user"] = array();
		header ("Location: index.php");
		exit;
	} 
	$t["username"] = $username;
	$t["id"] = $row["id"];
	$t["email"] = $row["email"];
	$t["phone"] = $row["phone"];
	return $t;
}

function addPlace($name, $address, $phone, $email) {
	global $db;
	$db->DB_connect;
	$db->DB_query("INSERT INTO places (name, address, phone, email) VALUES ('$name', '$address', '$phone', '$email')");
}

function addMatch($home, $visitor, $date, $place) {
	global $db;
	$db->DB_connect;
	$db->DB_query("INSERT INTO matches (home, visitor, date, place_id) VALUES ('$home', '$visitor', '$date', '$place')");
}

function addRestaurant($name, $cusine, $address, $phone, $email, $user_id) {
	global $db;
	$db->DB_connect;
	$db->DB_query("INSERT INTO restaurants (name, cusine, address, phone, email, user_id) VALUES ('$name', '$cusine', '$address', '$phone', '$email', '$user_id')");
}

function addUserToMeeting($uid, $mid) {
	global $db;
	$db->DB_connect;
	$db->DB_query("INSERT INTO meetings (match_id, user_id) VALUES ('$mid', '$uid')");
}

function addItem($restaurant_id, $category, $itemname, $ingredients, $price) {
	global $db;
	$db->DB_connect;
	$db->DB_query("INSERT INTO menus (restaurant_id, category, itemname, ingredients, price) VALUES ('$restaurant_id', '$category', '$itemname', '$ingredients', '$price')");
}

function getActualMeetings() {
	$retVal = array();
	$query = "SELECT DISTINCT matches.*, places.name AS placename, places.address AS placeaddress ".
					 "FROM matches LEFT JOIN meetings ON matches.id = meetings.match_id, places ".
					 "WHERE places.id = matches.place_id ORDER BY matches.id;";
	global $db;					 
	$db->DB_connect;
	$db->DB_query($query);
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getUsersForMatch($mid) {
	$retVal = array();
	$query = "SELECT DISTINCT username FROM users, meetings WHERE users.id = meetings.user_id ".
				"AND meetings.match_id = '$mid'";
	global $db;
	$db->DB_connect;
	$db->DB_query($query);
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row["username"];
	}
	return $retVal;
}


function getPlaces() {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT * FROM places;");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getMatches() {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT home, visitor, date, places.name, places.address FROM matches, ".
							"places WHERE matches.place_id = places.id ORDER BY matches.id;");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getRestaurants($user_id) {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT * FROM restaurants WHERE restaurants.user_id = '".$user_id."'");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getRestaurant($restaurant_id) {
	$row = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT * FROM restaurants WHERE restaurants.id = '".$restaurant_id."'");
	$row = $db->DB_getnextrow();
	return $row;
}

function getRestaurantsAdmin() {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT restaurants.id, restaurants.name, restaurants.cusine, restaurants.address, restaurants.phone, restaurants.email, users.username ".
							"FROM restaurants LEFT JOIN users ON restaurants.user_id = users.id");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getMenu($restaurant_id) {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT * FROM menus WHERE menus.restaurant_id ='".$restaurant_id."'");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getItem($item_id) {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT * FROM menus WHERE menus.id ='".$item_id."'");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getCategories($restaurant_id) {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT DISTINCT category FROM menus WHERE menus.restaurant_id ='".$restaurant_id."'");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getUsers() {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT * FROM users");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getProfile($username) {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT * FROM users WHERE username = '".$username."'");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getProfileHobbies($username) {
	$retval = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT hobbies.id, hobbies.name FROM users LEFT JOIN users_hobbies ON users.id ".
						"= users_hobbies.user_id, hobbies WHERE users.username = '".$username."' AND ".
						"hobbies.id = users_hobbies.hobby_id");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getUserStats() {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query(" SELECT username, count(user_id) AS number FROM meetings, users WHERE users.id = meetings.user_id GROUP BY user_id ORDER BY count( user_id ) DESC LIMIT 5;");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getMatchStats() {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT home, visitor, count(match_id) AS number FROM meetings, matches WHERE matches.id = meetings.match_id GROUP BY match_id ORDER BY count(match_id) DESC LIMIT 10;");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function getHobbies() {
	$retVal = array();
	global $db;
	$db->DB_connect;
	$query = $db->DB_query("SELECT * FROM hobbies;");
	while ($row = $db->DB_getnextrow()) {
		$retVal[] = $row;
	}
	return $retVal;
}

function debug($array) {
	print "<pre>"; 
	print_r($array);
	print "</pre>";
}
?>