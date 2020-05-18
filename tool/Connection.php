<?php

function getConnection() {
	$conn = new mysqli('localhost', 'root', 'NguyenVanNga1507');
	return $conn;
}
function getConnectionData(){
	$conn = new mysqli('localhost', 'root', 'NguyenVanNga1507', 'banhang');
	return $conn;
}
?> 