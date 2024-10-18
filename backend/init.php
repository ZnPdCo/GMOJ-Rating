<?php
	include("mysql_info.php");
	$pwd = $_GET["password"];
	if($pwd != PASSWORD2) exit("");
	$conn = new mysqli("localhost",USERNAME,PASSWORD,"gmoj");

	// init table
	$stmt = $conn -> prepare(<<<END
CREATE TABLE IF NOT EXISTS problems (
	id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    contest VARCHAR(255), 
    name VARCHAR(255), 
    url VARCHAR(255), 
    type INTEGER, 
    rating FLOAT DEFAULT null,
    quality FLOAT DEFAULT null,
    rating2 FLOAT DEFAULT null,
    quality2 FLOAT DEFAULT null,
    cnt1 INTEGER DEFAULT 0,
    cnt2 INTEGER DEFAULT 0
    ); 
END);
	$stmt -> execute();
	$stmt -> close();
    
	$stmt = $conn -> prepare(<<<END
CREATE TABLE IF NOT EXISTS users (
	id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    name VARCHAR(255), 
    cf VARCHAR(255)
    ); 
END);
	$stmt -> execute();
	$stmt -> close();
    
	$stmt = $conn -> prepare(<<<END
CREATE TABLE IF NOT EXISTS rating (
	id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    pid INTEGER, 
    val FLOAT
    ); 
END);
	$stmt -> execute();
	$stmt -> close();
    
	$stmt = $conn -> prepare(<<<END
CREATE TABLE IF NOT EXISTS quality (
	id INTEGER PRIMARY KEY AUTO_INCREMENT, 
    pid INTEGER, 
    val FLOAT
    ); 
END);
	$stmt -> execute();
	$stmt -> close();

?>