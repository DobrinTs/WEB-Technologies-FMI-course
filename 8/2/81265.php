<?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $rawData = file_get_contents("php://input");
      var_dump(json_decode($rawData));
  }
