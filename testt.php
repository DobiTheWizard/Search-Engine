<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="" method="GET">
	

<input type="text" name="search" >
<input type="submit" name="submit" >

</form>

<?php 

$but = !isset($_GET['submit']);
$search = isset($_GET['search']);

if ($but)
	echo "no keyword";
else{
	if (strlen($search) <= 1) {
		echo "too short";
	}
	else{
		if (isset($_GET["search"])) {
			# code...
			echo "do something";
		}
	}
}

?>
</body>
</html>



<!-- if (isset($_GET['submit'])) {
$search = $_GET['search'];
if (strlen($search) ) {
	echo "too long";
}else{
	echo "papa";
}

}else{ -->
<!-- 	echo "field empty";
}
 -->