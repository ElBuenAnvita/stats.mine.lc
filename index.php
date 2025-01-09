<?php
session_start();
if(isset($_SESSION['logueado']) || $_SESSION['logueado'] == TRUE) {
	header("Location: /sign-in/");
} else {
    header("Location: /dashboard/");
}
?>

Redirigiendo...