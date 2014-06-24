<?php

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'jason', 'letmein' );

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";

$query = 'CREATE TABLE national_parks (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	location VARCHAR(50) NOT NULL,
	date_established DATE NOT NULL,
	area_in_acres FLOAT NOT NULL,
    description TEXT NOT NULL,
	PRIMARY KEY (id)

)';



$dbc->exec($query);

?>