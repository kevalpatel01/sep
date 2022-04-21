<h2>Existing users</h2>
<?php
	$users = getUsers();
	print "<table style='margin: auto;' class='common' cellpadding='5'>";
	print "<thead>";
	print "<tr>";
	print "<th>&nbsp;</th>";
	print "<th>Username</th>";
	print "<th>Full name</th>";
	print "<th>Phone</th>";
	print "<th>Email</th>";
	if ($_SESSION['user']['userlevel'] == 1) {
		print "<th>User level</th>";
	}
	print "<th>Year of birth</th>";
	print "<th>Gender</th>";
	print "</tr>";	
	print "</thead>";
	print "<tbody>";
	foreach($users as $i => $user) {
		print "<tr>";
		print "<td>".(int)($i+1)."</td>";
		print "<td>".$user["username"]."</td>";
		print "<td>".$user["fullname"]."</td>";
		print "<td>".$user["phone"]."</td>";
		print "<td>".$user["email"]."</td>";
		if ($_SESSION['user']['userlevel'] == 1) {
			print "<td>";
			if ($user["userlevel"] == 1) {
				print "Administrator";
			}
			else print "User";
		}
		print "<td>".$user["year"]."</td>";
		print "<td>";
		if ($user["gender"] == "M") {
			print "Male";
		}
		else print "Female";
		print "</td>";
		print "</tr>";
	}
	print "</tbody>";
	print "</table>";
?>
