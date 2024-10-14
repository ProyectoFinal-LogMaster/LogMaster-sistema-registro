<?php

session_start();

unset($_SESSION["cedula"]);
unset($_SESSION["nombre"]);
unset($_SESSION["apellido"]);
unset($_SESSION["email"]);
unset($_SESSION["rol"]);

session_destroy();
header("Location: login/login.php");