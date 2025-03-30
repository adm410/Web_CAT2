<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<h1>NSFF Registered Users</h1>
<button><a href='login.php'>Register New User</a></button>
<table>
    <tr class="firstRow">
        <th>User Id</th>
        <th>Student Name</th>
        <th>Age</th>
		<th>Email</th>
    </tr>
    <!-- Display students from our db -->

    <?php
    // Connect to db (groupbmar)
    include "connectdb.php";

    // Write our query
    $query = "SELECT * FROM user";
    // Execute Query
    $execute = mysqli_query($connect, $query);

    // Check if successful
    if ($execute) {
        // Display data in the db
        while ($record = mysqli_fetch_assoc($execute)) {
            // Display records
            $user_id = $record['user_id'];
            $user_name = $record['user_name'];
            $age = $record['age'];
			$email = $record['email'];

            echo "<tr>
            <td>$user_id</td> <!-- Changed from $student_id -->
            <td>$user_name</td>
            <td>$age</td>
			<td>$email</td>
            </tr>";
        }
    } else {
        die(mysqli_error($connect));
    }
    ?>
</table>

<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    table {
        margin: auto;
        width: 70%;
    }
    .firstRow {
        background-color: darkblue;
        color: white;
    }
</style>

</body>
</html>
