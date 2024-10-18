<?php
	include("mysql_info.php");
	$pwd = $_GET["password"];
	if($pwd != PASSWORD) exit("");
	$conn = new mysqli("localhost",USERNAME,PASSWORD,"gmoj");

	// delete old table
	$stmt = $conn -> prepare(<<<END
DROP TABLE IF EXISTS problems;
END);
	$stmt -> execute();
	$stmt -> close();
    
	$stmt = $conn -> prepare(<<<END
DROP TABLE IF EXISTS users;
END);
	$stmt -> execute();
	$stmt -> close();
    
	$stmt = $conn -> prepare(<<<END
DROP TABLE IF EXISTS rating;
END);
	$stmt -> execute();
	$stmt -> close();
    
	$stmt = $conn -> prepare(<<<END
DROP TABLE IF EXISTS quality;
END);
	$stmt -> execute();
	$stmt -> close();

	// init table
	$stmt = $conn -> prepare(<<<END
CREATE TABLE IF NOT EXISTS problems (
	id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    contest VARCHAR(255), 
    name VARCHAR(255), 
    url VARCHAR(255), 
    type INTEGER, 
    rating DOUBLE DEFAULT null,
    quality DOUBLE DEFAULT null,
    rating2 DOUBLE DEFAULT null,
    quality2 DOUBLE DEFAULT null,
    cnt1 INTEGER DEFAULT 0,
    cnt2 INTEGER DEFAULT 0
    ); 
END);
	$stmt -> execute();
	$stmt -> close();
    
	$stmt = $conn -> prepare(<<<END
CREATE TABLE IF NOT EXISTS users (
	id VARCHAR(255), 
    name VARCHAR(255), 
    cf VARCHAR(255)
    ); 
END);
	$stmt -> execute();
	$stmt -> close();
    
	$stmt = $conn -> prepare(<<<END
CREATE TABLE IF NOT EXISTS rating (
	id VARCHAR(255), 
    pid INTEGER, 
    val DOUBLE
    ); 
END);
	$stmt -> execute();
	$stmt -> close();
    
	$stmt = $conn -> prepare(<<<END
CREATE TABLE IF NOT EXISTS quality (
	id VARCHAR(255), 
    pid INTEGER, 
    val DOUBLE
    ); 
END);
	$stmt -> execute();
	$stmt -> close();

?>