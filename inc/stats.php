<h3>Statistics</h3>

<h4>Top 10 watched matches</h4>
<?php
	$matches = getMatchStats();
	if (sizeof($matches) > 0) {
		print "<table class='common' cellpadding='5'>";
		print "<thead><tr>";
		print "<th id='id'>&nbsp;</th>";
		print "<th id='home'>Home</th>";
		print "<th id='away'>Visitor</th>";
		print "<th id='visitor'>Number of visitors</th>";
		print "</tr></thead>";
		print "<tbody>";
		foreach($matches as $i => $match) {
			if ($count == $match["number"]) {
				$rowspan[$i-$j] = $rowspan[$i-$j] + 1;
				$j = $j + 1;
			}
			else {
				$rowspan[$i] = 1;
				$count = $match["number"];
				$j = 1;
			}
		}
		foreach($matches as $i => $match) {
			print "<tr>";
			if ($rowspan[$i] != 0) print "<td headers='id'";
			if ($rowspan[$i] > 1) print " rowspan='".$rowspan[$i]."'";
			if ($rowspan[$i] != 0) print ">".(int)($i+1)."</td>";
			print "<td  headers='home' colspan='2'>".$match["home"]." - ".$match["visitor"]."</td>";
			if ($rowspan[$i] != 0) print "<td";
			if ($rowspan[$i] > 1) print " rowspan='".$rowspan[$i]."'";
			if ($rowspan[$i] != 0) print ">".$match["number"]."</td>";
			print "</tr>";
		}
		print "</tbody>";
		print "</table>";
	}	else print "<p align='center'>No statistics available!</p>";
?>
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