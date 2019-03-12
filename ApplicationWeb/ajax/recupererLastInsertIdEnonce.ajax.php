<?php

if(!isset($_SESSION)){
  session_start();
}

echo json_encode($_SESSION['lastInsertIdEnonce']);

?>
