<?php

$con = mysqli_connect('localhost', 'root', '', 'event_database');

if (isset($_POST['submitBtn'])) {

    $event_id = uniqid();

    $event_name = $_POST['event_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $address = $_POST['address'];

    $convenors = $_POST['convenors'];

    $teams = $_POST['teams'];


    $query = "SELECT * FROM events WHERE Event_Name = '$event_name'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {
        $sql = "INSERT INTO events VALUES('$event_id', '$event_name', '$start_date', '$end_date', '$address')";

        if (mysqli_query($con, $sql)) {
            if (mysqli_affected_rows($con) > 0) {
                foreach ($convenors as $convenor) {
                    $sql = "INSERT INTO event_convenors VALUES('$event_id', '$convenor')";
                    mysqli_query($con, $sql);
                }
                foreach ($teams as $team) {
                    $sql = "INSERT INTO event_teams VALUES('$event_id', '$team')";
                    mysqli_query($con, $sql);
                }
                echo "<script language='javascript'>
                    alert ('The event was successfully created.');
                </script>";
            } else {
                echo "<script language='javascript'>
                        alert ('There was a problem creating the event.');
                    </script>";
            }
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "<script language='javascript'>
                    alert ('The event name is already taken, please choose another name.');
                </script>";
    }
}

$event_name = '';
$start_date = '';
$end_date = '';
$address = '';

if (isset($_POST['updateBtn'])) {

    $event_id = $_GET['eid'];

    $event_name = $_POST['event_name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $address = $_POST['address'];

    $convenors = $_POST['convenors'];

    $teams = $_POST['teams'];



    $query = "SELECT * FROM events WHERE Event_Name = '$event_name' AND Event_ID != '$event_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {

        $sql = "UPDATE events SET Event_Name= '$event_name', `Start_Date`= '$start_date', End_Date= '$end_date', `Location`= '$address' WHERE Event_ID = '$event_id'";

        if (mysqli_query($con, $sql)) {
            foreach ($convenors as $convenor) {
                //Check if already in the database, if not, insert.
                $check = 0;
                $query2 = "SELECT * FROM event_convenors WHERE Event_ID = '$event_id' AND Convenor_ID = '$convenor'";
                $result2 = mysqli_query($con, $query2);

                $check = mysqli_num_rows($result2);

                // Check if check == 0, if so, insert
                if ($check == 0) {
                    $sql = "INSERT INTO event_convenors VALUES('$event_id', '$convenor')";
                    mysqli_query($con, $sql);
                }
            }

            foreach ($teams as $team) {
                //Check if already in the database, if not, insert.
                $check = 0;
                $query2 = "SELECT * FROM event_teams WHERE Event_ID = '$event_id' AND Team_ID = '$team'";
                $result2 = mysqli_query($con, $query2);

                $check = mysqli_num_rows($result2);
                // Check if check == 0, if so, insert

                if ($check == 0) {
                    $sql = "INSERT INTO event_teams VALUES('$event_id', '$team')";
                    mysqli_query($con, $sql);
                }
            }
            echo "<script language='javascript'>
                alert ('The event was successfully edited.');
            </script>";
        } else {
            echo "<script language='javascript'>
                    alert ('There was a problem editing the event.');
                </script>";
        }
    } else {
        echo "Error: " . mysqli_error($con);

        echo "<script language='javascript'>
                    alert ('The event name is already taken, please choose another name.');
                </script>";
    }
}


if (isset($_GET['eid'])) {

    $eid = $_GET['eid'];

    $query = "SELECT * FROM events WHERE Event_ID = '$eid'";
    $result = mysqli_query($con, $query);

    $event = mysqli_fetch_assoc($result);

    $event_name = $event['Event_Name'];
    $start_date = $event['Start_Date'];
    $end_date = $event['End_Date'];
    $address = $event['Location'];
}

if (isset($_GET['del'])) {

    $eid = $_GET['del'];

    $query1 = "DELETE FROM events WHERE Event_ID = '$eid'";
    $query2 = "DELETE FROM event_teams WHERE Event_ID = '$eid'";
    $query3 = "DELETE FROM event_convenors WHERE Event_ID = '$eid'";

    if (mysqli_query($con, $query1) && mysqli_query($con, $query2) && mysqli_query($con, $query3)) {
        echo "<script language='javascript'>
            The record has been deleted.
        </script";
        header("Location: EventForm.php");
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Form</title>


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-select.css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/multiselect.js"></script>


    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #efefef;
        }

        .container {
            min-height: 100vh;
            background: #efefef;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-direction: column;

        }
    </style>
</head>

<body>

    <?php include("navbar.php"); ?>

    <div class="container">
        <div class="card col-md-12 col-lg-6 m-5">
            <div class="card-body">
                <h4>Event Form</h4>
                <p>This form allows you to create an event.</p>
                <form method="POST">

                    <div class="form-group">
                        <label for="event_name">Event Name</label>
                        <input type="text" name="event_name" id="event_name" class="form-control" value="<?php echo $event_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo $start_date; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo $end_date ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" value="<?php echo $address; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Convenors</label>
                        <select class="selectpicker w-100" multiple data-live-search="true" name="convenors[]" required>
                            <?php
                            $query = "SELECT * FROM convenors";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {

                                // If there's a get request, check if convenor is an event convenor
                                $convenor_id = $row['Convenor_ID'];

                                $check = 0;
                                if (isset($_GET['eid'])) {
                                    $query2 = "SELECT * FROM event_convenors WHERE Event_ID = '$eid' AND Convenor_ID = '$convenor_id'";
                                    $result2 = mysqli_query($con, $query2);

                                    $check = mysqli_num_rows($result2);
                                    // Check if check > 0, then echo selected in the options
                                }

                                echo "<option value='" . $row['Convenor_ID'] . "'";
                                if ($check > 0) {
                                    echo 'selected';
                                }
                                echo ">" . $row['Fname'] . " " . $row['Mname'] . " " . $row['Lname'] . " (" . $row['Email'] . ")</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Teams</label>
                        <select class="selectpicker w-100" multiple data-live-search="true" name="teams[]" required>
                            <?php

                            $query = "SELECT * FROM teams";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {

                                // If there's a get request, check if convenor is an event convenor
                                $team_id = $row['Team_ID'];

                                $check = 0;
                                if (isset($_GET['eid'])) {
                                    $query2 = "SELECT * FROM event_teams WHERE Event_ID = '$eid' AND Team_ID = '$team_id'";
                                    $result2 = mysqli_query($con, $query2);

                                    $check = mysqli_num_rows($result2);
                                    // Check if check > 0, then echo selected in the options
                                }

                                echo "<option value='" . $row['Team_ID'] .
                                    "' ";
                                if ($check > 0) {
                                    echo 'selected';
                                }
                                echo ">" . $row['Team_Name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                    if (isset($_GET['eid'])) {
                        echo '<button class="btn btn-dark" type="submit" name="updateBtn">Update</button>';
                        echo '<a class="btn btn-secondary ml-2" href="EventForm.php">Back</a>';
                    } else {
                        echo '<button class="btn btn-dark" type="submit" name="submitBtn">Submit</button>';
                    }
                    ?>

                </form>
            </div>
        </div>

        <div class="card col-md-12 m-5">
            <div class="card-body">
                <h4>Events</h4>
                <p>All events will be listed here.</p>

                <table class="table table-striped ">
                    <thead class="thead-dark">
                        <th>Event Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Location</th>
                        <th>Convenors</th>
                        <th>Teams</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM events ";
                        $result = mysqli_query($con, $sql);


                        if (mysqli_num_rows($result) > 0) {

                            while ($event = mysqli_fetch_assoc($result)) {
                                $event_id = $event['Event_ID'];

                                // Select all convenor_id in event_convenors and fetch their names, and insert in array
                                $query2 = "SELECT * FROM event_convenors WHERE Event_ID = '$event_id'";
                                $result2 = mysqli_query($con, $query2);


                                $arrayConvenors = [];
                                while ($data = mysqli_fetch_assoc($result2)) {
                                    $convenor_id = $data['Convenor_ID'];
                                    $query3 = "SELECT * FROM convenors WHERE Convenor_ID = '$convenor_id'";
                                    $result3 = mysqli_query($con, $query3);
                                    $convenor = mysqli_fetch_assoc($result3);
                                    $arrayConvenors[] = $convenor['Fname'] . ' ' . $convenor['Mname'] . ' ' . $convenor['Lname'];
                                }


                                // Select Teams and insert in an array
                                $query2 = "SELECT * FROM event_teams WHERE Event_ID = '$event_id'";
                                $result2 = mysqli_query($con, $query2);

                                $arrayTeams = [];
                                while ($data = mysqli_fetch_assoc($result2)) {
                                    $team_id = $data['Team_ID'];
                                    $query3 = "SELECT * FROM teams WHERE Team_ID = '$team_id'";
                                    $result3 = mysqli_query($con, $query3);
                                    $team = mysqli_fetch_assoc($result3);
                                    $arrayTeams[] = $team['Team_Name'];
                                }

                                //Converts array to String with a separator
                                $convenorList = implode(", ", $arrayConvenors);

                                $teamList = implode(", ", $arrayTeams);


                                echo '<tr>
                                    <td>' . $event['Event_Name'] . '</td>
                                    <td>' . $event['Start_Date'] . '</td>
                                    <td>' . $event['End_Date'] . '</td>
                                    <td>' . $event['Location'] . '</td>
                                    <td>' . $convenorList . '</td>
                                    <td>' . $teamList . '</td>
                                    <td>
                                        <a href="?eid=' . $event_id . '">Edit</a>
                                        <a href="?del=' . $event_id . '">Delete</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '<tr><td colspan=10 style="text-align: center;">No result found.</td></tr>';
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>