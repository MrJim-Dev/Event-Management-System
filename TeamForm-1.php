<?php

$con = mysqli_connect('localhost', 'root', '', 'event_database');

if (isset($_POST['submitBtn'])) {
    $team_name = $_POST['team_name'];
    $team_id = uniqid();
    $coaches = $_POST['coaches'];
    $players = $_POST['players'];

    foreach ($players as $player) {
        if (!empty($player)) {
          
            $sql = "INSERT INTO team_players (Team_ID, Player_ID) VALUES ('$team_id', '$player')";
            if (mysqli_query($con, $sql)) {
                
                echo "<script>alert('Player inserted successfully.');</script>";
            } else {
                echo "<script>alert('Error inserting Player.');</script>";
            }
        }
    }

    foreach ($coaches as $coach) {
        if (!empty($coach)) {
           
            $sql = "INSERT INTO team_coaches (Team_ID, Coach_ID) VALUES ('$team_id', '$coach')";
            if (mysqli_query($con, $sql)) {
                
                echo "<script>alert('Coach inserted successfully.');</script>";
            } else {
                echo "<script>alert('Error inserting Coach.');</script>";
            }
        }
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


        /*

        .card {
            background: white;
            width: 40em;
            padding: 20px;
            border-radius: .5em;
            box-shadow: 0px 0px 18px 5px rgba(0, 0, 0, 0.1);
            margin: 2em;
        }

        .card-header {
            margin-bottom: 20px;
        }

        .card-header p {
            margin-top: 5px;
            color: #4d4d4d;
            font-size: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin: 10px 0;
        }

        .form-group label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control {
            padding: 5px;
            border: 1px solid #ced4da;
            border-radius: 3px;
        }

        .btn {
            padding: 5px 10px;
            padding: 10px;
            background: #23272b;
            color: #f1fff2;
            border: 1px solid #1d2124;
            border-radius: 5px;
        }

        .w-auto {
            width: auto;
        }

        table {
            margin: 0 auto;
        }

        table {
            color: #333;
            background: white;
            border: 1px solid grey;
            font-size: 12pt;
            border-collapse: collapse;
        }

        table thead th,
        table tfoot th {
            color: #3a3a3a;
            background: rgba(0, 0, 0, .1);
        }

        table caption {
            padding: .5em;
        }

        table th,
        table td {
            padding: .5em;
            border: 1px solid lightgrey;
        } */
    </style>

</head>

<body>

    <div class="container">

        <div class="card col-md-6">
            <div class="card-body">
                <h4>Team Form</h4>
                <p>This form allows you to Create a Team.</p>
                <form method="POST">
                    <div class="form-group">
                        <label for="Team_name">Team Name</label>
                        <input type="text" name="team_name" id="team_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Coaches</label>
                        <select class="selectpicker w-100" multiple data-live-search="true" name="coaches[]">
                            <?php
                            $query = "SELECT * FROM coaches";
                            $result = mysqli_query($con, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['Coach_ID'] . '">' . $row['Fname'] . ' ' . $row['Mname'] . ' ' . $row['Lname'] . ' (' . $row['Email'] . ')</option>';
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
                                echo '<option value="' . $row['Player_ID'] . '">' . $row['Fname'] . ' ' . $row['Mname'] . ' ' . $row['Lname'] . ' (' . $row['Email'] . ')</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <button class="btn btn-dark" name="submitBtn">Submit</button>
                </form>
            </div>


        </div>

        <div class="card col-md-6">
            <div class="card-body">
                <h4>Teams</h4>
                <p>All teams will be listed here.</p>
                <table class="table table-bordered table-responsive">
                    <thead>
                        <th>Team Name</th>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM teams";
                        $result = mysqli_query($con, $sql);


                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                                    <td>' . $row['Team_Name'] . '</td>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

    </script>

</body>

</html>