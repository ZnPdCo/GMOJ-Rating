<?php
	include("mysql_info.php");
	$pwd = $_GET["password"];
	if($pwd != PASSWORD) exit("");
	$conn = new mysqli("localhost",USERNAME,PASSWORD,"gmoj");
	$file = fopen("problems.txt","r");

	while(!feof($file)) {
		$line = fgets($file);
		$info = explode("|", $line);
		$stmt = $conn -> prepare("INSERT INTO problems (contest,name,url,type) VALUES (?,?,?,?)");
		$stmt -> bind_param("sssi",$info[0],$info[1],$info[2],$info[3]);
		$stmt -> execute();
		$stmt -> close();
	}

	fclose($file);
?>