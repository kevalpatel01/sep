<?php
	if (isset($_REQUEST['uid']) && isset($_REQUEST['mid'])) {
		addUserToMeeting($_REQUEST['uid'],$_REQUEST['mid']);
	}
?>

<h3>Organized meetings</h3>
<?php
	$meetings = getActualMeetings();
	if (sizeof($meetings) > 0) {
		print "<table class='common' border='0' cellpadding='5' style='align: center; width: 100%'>";
		print "<thead><tr>";
		print "<th id='id'>&nbsp;</th>";
		print "<th id='match'>Match</th>";
		print "<th id='date'>Date</th>";
		print "<th id='place'>Place</th>";
		print "<th id='visitor'>Members coming</th>";
		print "<th id='book'>&nbsp;</th>";
		print "</tr></thead>";
		print "<tbody>";
		$i = 0;
		foreach ($meetings as $i => $occasion) {
			print "<tr>";
			print "<td headers='id'>".(int)($i+1)."</td>";
			print "<td headers='match'>".$occasion["home"]." - ".$occasion["visitor"]."</td>";
			print "<td headers='date'>".$occasion["date"]."</td>";
			print "<td headers='place'>".$occasion["placename"]." (".$occasion["placeaddress"].")</td>";
			print "<td headers='visitor'> &nbsp;";
				$users = getUsersForMatch($occasion["id"]);
				foreach($users as $user) {
					print $user;
					if ($user != end($users)) print ", ";
				}
			print "</td>";
			if (!empty($_SESSION['user']['username'])) {
				$loggedUser = $_SESSION['user']['username'];
			}
			else $loggedUser = "";
			if ($loggedUser != "") {
				print "<td headers='book'>"; 
				if (!in_array($loggedUser, $users)) {
					print "<a href='".$_SERVER["PHP_SELF"]."?q=meetings&amp;uid=".$_SESSION["user"]["id"]."&amp;mid=".$occasion["id"]."'>I come too!</a>";
				}
				else print "<span style='color: #ccc'>I come too!</span>";
				print "</td>";				
			}
			print "</tr>";
		}
		print "</tbody>";
		print "</table>";
	}	else print "<p align='center'>No matches, come back later!</p>";
?>