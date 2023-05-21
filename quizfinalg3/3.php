<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Displays Speakers in Each Seminar</title>
    <style>
        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "root", "", "quizfinalg3");

    $sql = "SELECT e.EventName, e.EventDate, s.SpeakerName, s.Topic FROM events e, eventspeakers s WHERE e.EventID = s.EventID";

    $result = mysqli_query($con, $sql);

    ?>


    <h2>Speakers In Each Seminar</h2>

    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Speaker Name</th>
                <th>Topic</th>
            </tr>
        </thead>

        <tbody>

            <?php
            while ($data = mysqli_fetch_assoc($result)) {
                echo '
                <tr>
                    <td>' . $data['EventName'] . '</td>
                    <td>' . $data['EventDate'] . '</td>
                    <td>' . $data['SpeakerName'] . '</td>
                    <td>' . $data['Topic'] . '</td>
                </tr>
                ';
            }
            ?>

        </tbody>
    </table>

</body>

</html>