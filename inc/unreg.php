<?php

if (isset($_POST['yes'])) {
	unregisterUser($_SESSION['user']['id']);
	$_SESSION['user'] = array();
	print "<p style='text-align: center;'>Account iunregistered!</p>";
}

if (!empty($_POST['unregister'])) {

?>

<form action="<?php print $_SERVER["PHP_SELF"]; ?>" method="post">
	<table>
		<tr>
			<td align="center">Are you sure you want to unregister?</td>
		</tr>
		<tr>
		<td align="center">
			<input class="btn" type="submit" name="yes" value="Yes"/>
			<input class="btn" type="submit" name="no" value="No"/>
			<input type="hidden" name="q" value="unregister"/>
		</td>
		</tr>
	</table>
</form>

<?php
}
?>