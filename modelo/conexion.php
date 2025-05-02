<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ecocashback";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>

<?php
	/*
	try {
		$host = 'localhost';
		$db = 'ecocashback';
		$user = 'root';
		$pass = '';
		$charset = 'utf8mb4';

		$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		];

		$pdo = new PDO($dsn, $user, $pass, $options);
	} catch (\PDOException $e) {
		error_log("Error al conectar a la base de datos: " . $e->getMessage());
		die("Error al conectar a la base de datos.");
	}
	*/
?>