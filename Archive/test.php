<?php
// include('include/config.php');

// Execute the SQL query
// $query = "SELECT u.fname, u.lname, td.team_name, tp.role FROM users u, team_players tp, team_details td WHERE u.uid = tp.uid AND tp.team_id = td.team_id";

$con = mysqli_connect("localhost", "root", "", "quizfinalg3");

$query = "SELECT distinct e.EventName, s.SpeakerName, (SELECT COUNT(*) FROM attendees WHERE EventID = e.EventID) as attendees  FROM events e, eventspeakers s, attendees a WHERE e.EventID = s.EventID";
$result = mysqli_query($con, $query);

if (!$result) {
    // Display the error message and terminate the script
    die('Error executing the query: ' . mysqli_error($con));
}

// Fetch the column names
$columns = array();
while ($fieldInfo = mysqli_fetch_field($result)) {
    $columns[] = $fieldInfo->name;
}

// Fetch the result set as an associative array
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Generate the dynamic table
echo "<table>";
echo "<tr>";

// Generate table headers dynamically based on the column names
foreach ($columns as $column) {
    echo "<th>" . ucfirst(str_replace('_', ' ', $column)) . "</th>";
}

echo "</tr>";

// Generate table rows dynamically based on the fetched data
foreach ($data as $row) {
    echo "<tr>";

    foreach ($row as $value) {
        echo "<td>" . $value . "</td>";
    }

    echo "</tr>";
}

echo "</table>";

// Close the database connection
mysqli_close($con);
