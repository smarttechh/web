<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        main {
            max-width: 600px;
            margin: 20px auto;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
            margin: 10px 0;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }

        form {
            margin-top: 20px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Your Profile</h1>
    </header>

    <main>
        <?php
        session_start();

        // Assuming you have a database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "smarttech";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve the current user from the session or authentication mechanism
        $current_user = isset($_SESSION['current_user']) ? $_SESSION['current_user'] : null;

        if ($current_user) {
            // Retrieve username and email for the current user from the users table
            $sql = "SELECT username, email FROM register WHERE username = '$current_user'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data for the current user
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card">';
                    echo '<p>Name: ' . $row["username"] . '</p>';
                    echo '<p>Email: ' . $row["email"] . '</p>';
                    
                }
            } else {
                echo '<div class="card">';
                echo '<p>No user found for the current session</p>';
                echo '</div>';
            }
        } else {
            echo '<div class="card">';
            echo '<p>User not logged in</p>';
            echo '</div>';
        }

        $conn->close();
        ?>

        <form action="update_email.php" method="post">
            <label for="newEmail">Change Email?</label>
            <input type="email" id="newEmail" name="newEmail" placeholder="Enter your new email" required>
            <button type="submit">Update Email</button>
        </form>

        <p><a href="home.php">Back</a></p>

    </main>

</body>
</html>
