<!DOCTYPE html>
<html>
<head>
    <title>Users CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="delete">
    <h2>Delete User</h2>

    <?php
    // Database connection
    $server = "localhost";
    $username = "your_username";
    $password = "your_password";
    $database = "your_database_name";

    $conn = mysqli_connect($server, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch user details
        $query = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        // Delete user from database
        $deleteQuery = "DELETE FROM users WHERE id = $id";

        if (mysqli_query($conn, $deleteQuery)) {
            $name = $user['name'];
            $lastname = $user['lastname'];
            $email = $user['email'];
            $city = $user['city'];

            echo "<p class='message' >User $name $lastname ($email) from $city deleted successfully.</p>";

            mysqli_close($conn);
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 3000);
            </script>";
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
            mysqli_close($conn);
        }
    }
    ?>
</body>
</html>
