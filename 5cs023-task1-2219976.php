<?php

// Connect to server/database
$mysqli = mysqli_connect("localhost", "2219976", "jj9nq4", "db2219976");
if ($mysqli->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
} else {
  echo "Connected to the database successfully.";
}

// Run SQL query
$res = mysqli_query($mysqli, "SELECT `Game Name`, `Developer`, `Age Rating`, `Release Date` FROM `Call Of Duty Games`");

// Are there any errors in my SQL statement?
if(!$res) {
  print("MySQL error: " . mysqli_error($mysqli));
  exit;
}

// How many rows were returned?
echo("<p>" . mysqli_num_rows($res) . " record(s) were returned...</p>");

// Output the table with a border
echo "<table border='1'>";

// Loop through resultset and display each field's value
while($row = mysqli_fetch_assoc($res)) {
    echo "<tr>";
    echo "<td>" . $row['Game Name'] . "</td>";
    echo "<td>" . $row['Developer'] . "</td>";
    echo "<td>" . $row['Age Rating'] . "</td>";
    echo "<td>" . $row['Release Date'] . "</td>";
    echo "</tr>";
}

?>