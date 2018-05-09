<?php
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // GET is not allowed (Web browser can prefetch pages)
      session_start();
      unset($_SESSION["username"]);
      unset($_SESSION["password"]);
   }
   
   //echo 'You have cleaned session';
   header('Refresh: 0; URL = index.php');
?>