<?php

// Connect to server/database
$mysqli = mysqli_connect("localhost", "2219976", "jj9nq4", "db2219976");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}

// Build custom SQL query
$sql = "SELECT `Game name`, `Developer`, `Age Rating`, `Release Date` FROM `Call Of Duty Games`";

// Add search criteria, if provided
$searchName = isset($_POST['searchName']) ? $_POST['searchName'] : '';

if ($searchName != "") {
  $sql .= " WHERE `Game name` LIKE '%" . $searchName . "%'";
}
  
// Run SQL query
$res = mysqli_query($mysqli, $sql);

// How many rows were returned?
$num_call = mysqli_num_rows($res);

if ($num_call == 0)
  print("<p>No Call Of Duty with that name, sorry...</p>");
else {
  print("<p>We found $num_call CoD(s) matching that name...</p>");
  
  // Loop through resultset and display each field's value
  while ($row = mysqli_fetch_assoc($res)) {
    echo $row['Game name'] . " - " . $row['Developer'] . " - " . $row['Age Rating'] . " - " . $row['Release Date'] . "<br>";
  }
}

?>
