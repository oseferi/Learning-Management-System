<?php
function test_input($data) {
    $data = trim($data); //Strip unnecessary characters (extra space, tab, newline) from the user input data
    $data = stripslashes($data); //Remove backslashes (\) from the user input data
    $data = htmlspecialchars($data); //konverton char speciale ne ato html shembull: &gt per >
    return $data;
  }

  ?>