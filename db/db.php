<?php
   $mysqli = new mysqli($dbhost, $login, $pass, $db);
   $mysqli->query("set character_set_client='utf8'");
   $mysqli->query("set character_set_results='utf8'");
   $mysqli->query("set collation_connection='utf8_bin'");
?>
