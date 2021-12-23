<?php
$cookie_alive_hours = 8;
setcookie('admin_rights', '1', time() + 3600 * $cookie_alive_hours);
header("Location: ../index.php");
?>