<?php

$con = mysqli_connect('localhost', 'root', '', 'event_database');

if (isset($_POST['submitBtn'])) {
    $team_name = $_POST['team_name'];
    $coaches = $_POST['coaches'];
    $players = $_POST['players'];

    if (empty($team_name)) {
        echo "<script language='javascript'>
        alert('Please enter a team name.');
        </script>";
    } else {

        $check_sql = "SELECT * FROM teams WHERE Team_Name = '$team_name'";
        $check_result = mysqli_query($con, $check_sql);
        if ($check_result && mysqli_num_rows($check_result) > 0) {
            echo "<script language='javascript'>
            alert('Team name already exists. Please choose a different name.');
            </script>";
        } else {
            $team_id = uniqid();

            $sql = "INSERT INTO teams VALUES ('$team_id', '$team_name')";
            if (mysqli_query($con, $sql)) {
                echo "<script language='javascript'>
                alert('Team created successfully.');
                </script>";

                foreach ($players as $player) {
                    if (!empty($player)) {
                        $sql = "INSERT INTO team_players VALUES ('$team_id', '$player')";
                        mysqli_query($con, $sql);
                    }
                }

                foreach ($coaches as $coach) {
                    if (!empty($coach)) {
                        $sql = "INSERT INTO team_coaches VALUES ('$team_id', '$coach')";
                        mysqli_query($con, $sql);
                    }
                }

                echo "<script language='javascript'>
                alert('Players and coaches inserted successfully.');
                </script>";
            } else {
                echo "<script language='javascript'>
                alert('Error creating team.');
                </script>";
            }
        }
    }
}

$team_name = '';

if (isset($_POST['updateBtn'])) {

    $team_id = $_GET['tid'];

    $team_name = $_POST['team_name'];
    $coaches = $_POST['coaches'];
    $players = $_POST['players'];


    $query = "SELECT * FROM teams WHERE Team_Name = '$team_name' AND Team_ID != '$team_id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 0) {

        $sql = "UPDATE teams SET Team_Name = '$team_name' WHERE Team_ID = '$team_id'";

        if (mysqli_query($con, $sql)) {
            foreach ($coaches as $coach) {
                // Check if already in the database, if not, insert.
                $check = 0;
                $query2 = "SELECT * FROM team_coaches WHERE Team_ID = '$team_id' AND Coach_ID = '$coach'";
                $result2 = mysqli_query($con, $query2);

                $check = mysqli_num_rows($result2);

                // Check if check == 0, if so, insert
                if ($check == 0) {
                    $sql = "INSERT INTO team_coaches VALUES('$team_id', '$coach')";
                    mysqli_query($con, $sql);
                }
            }

            foreach ($players as $player) {
                // Check if already in the database, if not, insert.
                $check = 0;
                $query2 = "SELECT * FROM team_players WHERE Team_ID = '$team_id' AND Player_ID = '$player'";
                $result2 = mysqli_query($con, $query2);

                $check = mysqli_num_rows($result2);
                // Check if check == 0, if so, insert

                if ($check == 0) {
                    $sql = "INSERT INTO team_players VALUES('$team_id', '$player')";
                    mysqli_query($con, $sql);
                }
            }
            echo "<script language='javascript'>
                alert ('The team was successfully edited.');
            </script>";
        } else {
            echo "<script language='javascript'>
                    alert ('There was a problem editing the team.');
                </script>";
        }
    } else {
        echo "Error: " . mysqli_error($con);

        echo "<script language='javascript'>
                    alert ('The team name is already taken, please choose another name.');
                </script>";
    }
}

if (isset($_GET['tid'])) {
    $tid = $_GET['tid'];

    $query = "SELECT * FROM teams WHERE Team_ID = '$tid'";
    $result = mysqli_query($con, $query);

    $team = mysqli_fetch_assoc($result);
    $team_name = $team['Team_Name'];
}

if (isset($_GET['del'])) {
    $team_id = $_GET['del'];

    $query1 = "DELETE FROM teams WHERE Team_ID = '$team_id'";
    $query2 = "DELETE FROM team_coaches WHERE Team_ID = '$team_id'";
    $query3 = "DELETE FROM team_players WHERE Team_ID = '$team_id'";

    if (mysqli_query($con, $query1) && mysqli_query($con, $query2) && mysqli_query($con, $query3)) {
        echo "<script language='javascript'>
            alert('The record has been deleted.');
        </script>";
        header("Location: TeamForm.php");
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Form</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

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

        <div class="card col-md-6 m-5">
            <div class="card-body">
                <h4>Team Form</h4>
                <p>This form allows you to Create a Team.</p>
                <form method="POST">
                    <div class="form-group">
                        <label for="Team_name">Team Name</label>
                        <input type="text" name="team_name" id="team_name" class="form-control" value="<?php echo $team_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Coaches</label>
                        <select class="selectpicker w-100" multiple data-live-search="true" name="coaches[]">
                            <?php
                            $query = "SELECT * FROM coaches";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $coach_id = $row['Coach_ID'];
                                $check = 0;

                                if (isset($_GET['tid'])) {

                                    $query2 = "SELECT * FROM team_coaches WHERE Team_ID = '$tid' AND Coach_ID = '$coach_id'";
                                    $result2 = mysqli_query($con, $query2);
                                    $check = mysqli_num_rows($result2);
                                }

                                echo '<option value="' . $row['Coach_ID'] . '"';
                                if ($check > 0) {
                                    echo ' selected';
                                }
                                echo '>' . $row['Fname'] . ' ' . $row['Mname'] . ' ' . $row['Lname'] . ' (' . $row['Email'] . ')</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Players</label>
                        <select class="selectpicker w-100" multiple data-live-search="true" name="players[]">
                            <?php
                            $query = "SELECT * FROM players";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $player_id = $row['Player_ID'];
                                $check = 0;
                                if (isset($_GET['tid'])) {
                                    $query3 = "SELECT * FROM team_players WHERE Team_ID = '$tid' AND Player_ID = '$player_id'";
                                    $result3 = mysqli_query($con, $query3);
                                    $check = mysqli_num_rows($result3);
                                }
                                echo '<option value="' . $row['Player_ID'] . '"';
                                if ($check > 0) {
                                    echo ' selected';
                                }
                                echo '>' . $row['Fname'] . ' ' . $row['Mname'] . ' ' . $row['Lname'] . ' (' . $row['Email'] . ')</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                    if (isset($_GET['tid'])) {
                        echo '<button class="btn btn-dark" type="submit" name="updateBtn">Update</button>';
                        echo '<a class="btn btn-secondary ml-2" href="RegistrationForm.php">Back</a>';
                    } else {
                        echo '<button class="btn btn-dark" type="submit" name="submitBtn">Register</button>';
                    }

                    ?>
                </form>
            </div>


        </div>

        <div class="card col-md-12 m-5">
            <div class="card-body">
                <h4>Teams</h4>
                <p>All teams will be listed here.</p>
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <th>Team Name</th>
                        <th>Coaches</th>
                        <th>Players</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM teams";
                        $result = mysqli_query($con, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($team = mysqli_fetch_assoc($result)) {
                                $team_id = $team['Team_ID'];

                                // Select all team coaches
                                $query2 = "SELECT * FROM team_coaches WHERE Team_ID = '$team_id'";
                                $result2 = mysqli_query($con, $query2);

                                $arrayCoaches = [];
                                while ($data = mysqli_fetch_assoc($result2)) {
                                    $coach_id = $data['Coach_ID'];
                                    $query3 = "SELECT * FROM coaches WHERE Coach_ID = '$coach_id'";
                                    $result3 = mysqli_query($con, $query3);
                                    $coach = mysqli_fetch_assoc($result3);
                                    $arrayCoaches[] = $coach['Fname'] . ' ' . $coach['Mname'] . ' ' . $coach['Lname'];
                                }

                                // Select all team players
                                $query2 = "SELECT * FROM team_players WHERE Team_ID = '$team_id'";
                                $result2 = mysqli_query($con, $query2);

                                $arrayPlayers = [];
                                while ($data = mysqli_fetch_assoc($result2)) {
                                    $player_id = $data['Player_ID'];
                                    $query3 = "SELECT * FROM players WHERE Player_ID = '$player_id'";
                                    $result3 = mysqli_query($con, $query3);
                                    $player = mysqli_fetch_assoc($result3);
                                    $arrayPlayers[] = $player['Fname'] . ' ' . $player['Mname'] . ' ' . $player['Lname'];
                                }

                                //Converts array to String with a separator
                                $playerList = implode(", ", $arrayPlayers);
                                $coachList = implode(", ", $arrayCoaches);

                                echo '<tr>
            <td>' . $team['Team_Name'] . '</td>
            <td>' . $coachList . '</td>
            <td>' . $playerList . '</td>
            <td>
                <a href="?tid=' . $team_id . '">Edit</a>
                <a href="?del=' . $team_id . '">Delete</a>
            </td>
        </tr>';
                            }
                        } else {
                            echo '<tr><td colspan=4 style="text-align: center;">No result found.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

    </script>

</body>

</html>