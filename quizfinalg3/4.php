<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question 4 Answer</title>
    <style>
        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "root", "", "quizfinalg3");

    $sql = "SELECT distinct e.EventName, s.SpeakerName, (SELECT COUNT(*) FROM attendees WHERE EventID = e.EventID) as attendees  FROM events e, eventspeakers s, attendees a WHERE e.EventID = s.EventID";

    $result = mysqli_query($con, $sql);

    ?>


    <h2>Seminar Info</h2>

    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Speaker Name</th>
                <th>Attendees</th>
            </tr>
        </thead>

        <tbody>

            <?php
            while ($data = mysqli_fetch_assoc($result)) {
                echo '
                <tr>
                    <td>' . $data['EventName'] . '</td>
                    <td>' . $data['SpeakerName'] . '</td>
                    <td>' . $data['attendees'] . '</td>
                </tr>
                ';
            }
            ?>

        </tbody>
    </table>

</body>

</html>