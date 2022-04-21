<?php
require("db/database.php");
require("inc/user_functions.php");

$dbname = "matchdb";
$db = new Database("localhost", "root", "", $dbname);
$db->DB_connect;

if (in_array($db->getErrorCode(), array(1046, 1049))) {
	include("inc/install.php");
}

$q = $_REQUEST['q'];

if (isset($q)) {
	if ($q == "login" && !empty($_POST)) {
		$id = checkLogin($_POST["username"], $_POST["password"]);
		if ($id != null) {
			$_SESSION['user']['id'] = $id;
			$_SESSION['user']['username'] = $_POST["username"];
			$_SESSION['user']['userlevel'] = checkUserLevel($_SESSION['user']['username']);
			$q = "loggedmain";
		} else {
			if (empty($_POST["username"]) || empty($_POST["password"])) {
				$_POST = array();
				$q = "register";
			}
			else {		
				$q = "main";
				$_SESSION['user'] = array();
			}
		}
	}
	else if ($q == "exit") {
		$_SESSION['user'] = array();
		$q = "main";	
	}
	else if ($q == "unregister" && $_POST['no']) {
		$q = "profile";
	}
	else if ($q == "unregister" && $_POST['yes']) {
		unregisterUser($_SESSION['user']['id']);
		$_SESSION['user'] = array();
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>[ online delivery! ]</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
		<link rel="stylesheet" href="print.css" type="text/css" media="print" />	
</head>

<body>
	<div class="header">[ come with us and watch match! ]</div>	
	<div class="container">
		<div class="sidemenu">
			<div class="menubox">
			<div class="loginbox"<?php if (!empty($_SESSION["user"])) { print "style='visibility: hidden;'"; } ?> >
				<p class="head">Login</p>
				<form action="<?php print $_SERVER["PHP_SELF"];?>" method="post">
					<p><label for="loginname">Username:</label><br />
					<input type="text" name="username" id="loginname" maxlength="20" value="" /></p>
					<p style="display: block;"><label for="password">Password:</label><br />
					<input type="password" name="password" id="password" maxlength="20" value="" /></p>
					<p style="text-align: center"><input id="btn" type="submit" name="login_btn" value="Login/Registration"/></p>
					<p><input type="hidden" name="q" value="login" /></p>
				</form>
			</div>
				<p class="head">Menu</p>
				<ul>
				<li><a href="<?php print $_SERVER["PHP_SELF"]?>">Main page</a></li>
				<li><a <?php if ($q == "restaurants" || $q == "menus") print "class='current'" ?> href="<?php print $_SERVER["PHP_SELF"]?>?q=restaurants">Manage restaurants</a></li>
				<li><a <?php if ($q == "restaurants_orderfrom" || $q == "menus_orderfrom") print "class='current'" ?> href="<?php print $_SERVER["PHP_SELF"]?>?q=restaurants_orderfrom">Available restaurants</a></li>
				<li><a <?php if ($q == "orders") print "class='current'" ?> href="<?php print $_SERVER["PHP_SELF"]?>?q=orders">Orders</a></li>
				<li><a <?php if ($q == "stats" || $q == "stat1" || $q == "stat2") print "class='current'" ?> href="<?php print $_SERVER["PHP_SELF"]?>?q=stats">Statistics</a></li>
				<?php
					if ($_SESSION['user']['userlevel'] == 1) {
					print "<li><a "; 
						if ($q == "users") print "class='current'";
					print "href='".$_SERVER["PHP_SELF"]."?q=users'>Users</a></li>";
					}
					if (!empty($_SESSION["user"])) {
					print "<li><a "; 
						if ($q == "profile") print "class='current'";
					print "href='".$_SERVER["PHP_SELF"]."?q=profile'>Profile</a></li>";
					print "<li><a href='".$_SERVER["PHP_SELF"]."?q=exit'>Logout</a></li>";
					}
				?>
				</ul>
			</div>
		</div>
		<div class="content">

<?php
			switch($q) {
				case "register": include("inc/reg.php"); break;
				case "unregister": include("inc/profile.php"); break;
				case "profile": include("inc/profile.php"); break;
				case "loggedmain": include("inc/profile.php"); break;
				case "restaurants": include("inc/restaurants.php"); break;
				case "menus": include("inc/menus.php"); break;
				case "restaurants_orderfrom": include("inc/restaurants_orderfrom.php"); break;
				case "menus_orderfrom": include("inc/menus_orderfrom.php"); break;
				case "stats": include("inc/stats.php"); break;
				case "users": include("inc/users.php"); break;
				case "main":
				default: include("inc/evra.php"); break;
			}
?>			
		</div>
	</div>
	<div class="footer">
		<p>[ minimal design ] [ some rights reserved ]</p>
	</div>
</body>
</html>