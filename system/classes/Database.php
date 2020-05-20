<?php
Class Database{
	private $connection;
	
	public function __construct(){
		if (!$this->connection = mysqli_connect(DB_HOSTNAME . ':' . DB_PORT, DB_USERNAME, DB_PASSWORD)) {
			echo("Ошибка подключения к базе данных");
			exit();
		}
		if (!mysqli_select_db($this->connection, DB_DATABASE)) {
			echo("Ошибка подключения к базе данных");
			exit();
		}
	}
	
	public function __destruct() {
		if ($this->connection) {
			mysqli_close($this->connection);
		}
	}
	
	public function prepare($value) {
		return $this->connection->real_escape_string(htmlspecialchars(stripslashes(trim($value))));
	}
	
	public function query($query_string){
		return $this->connection->query($query_string);
	}
	
}
?>