<h3>Statistics</h3>

<h4>Top 5 active users</h4>
<?php
	$users = getUserStats();
	if (sizeof($users) > 0) {
		print "<table class='common' cellpadding='5'>";
		foreach($users as $i=> $user) {
			print "<tr>";
			print "<td>".(int)($i+1)."</td>";
			print "<td>".$user["username"]."</td>";
			print "<td>".$user["number"]."</td>";
			print "</tr>";
		}
		print "</table>";
	}	else print "<p align='center'>No statistics available!</p>";


?>