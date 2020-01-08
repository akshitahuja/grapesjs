<?php
//$conn = mysqli_connect('localhost', 'root', '', 'grapesjs');
$fn = $_GET['fn'];

call_user_func($fn);

function store() {
	echo file_get_contents("php://input");
}

function load() {
}
?>