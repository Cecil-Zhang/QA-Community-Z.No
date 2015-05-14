<?php
	session_start();
	setcookie('user_id', '', time() - (60 * 60 * 24 * 30));    // expires in 30 days
	setcookie('username', '', time() - (60 * 60 * 24 * 30));  // expires in 30 days
	unset($_SESSION['user_id']);
?>