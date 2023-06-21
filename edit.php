<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit User</h2>

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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle form submission

        // Get form data
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $lastname = $_POST['lastname'];
        $country = $_POST['country'];
        $zipcode = $_POST['zipcode'];
        $city = $_POST['city'];
        $occupation = $_POST['occupation'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $website = $_POST['website'];

        // Update user in database
        $query = "UPDATE users SET
                    name = '$name',
                    email = '$email',
                    lastname = '$lastname',
                    country = '$country',
                    zipcode = '$zipcode',
                    city = '$city',
                    occupation = '$occupation',
                    gender = '$gender',
                    phone = '$phone',
                    website = '$website'
                  WHERE id = $id";

        if (mysqli_query($conn, $query)) {
            echo "<p class='message' >User updated successfully. </p>";
            echo "<script>
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 3000);
        </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        // mysqli_close($conn);
    } else {

// Dropdown options
$countries = ['Country 1', 'Country 2', 'Country 3'];
$occupations = ['Occupation 1', 'Occupation 2', 'Occupation 3'];

        // Display user form

        $id = $_GET['id'];

        // Fetch user from database
        $query = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            echo "<form method='POST'>
                    <input type='hidden' name='id' value='".$row['id']."'>
                    <label for='name'>Name:</label>
                    <input type='text' name='name' value='".$row['name']."' required><br>

                    <label for='email'>Email:</label>
                    <input type='email' name='email' value='".$row['email']."' required><br>

                    <label for='lastname'>Last Name:</label>
                    <input type='text' name='lastname' value='".$row['lastname']."' required><br>

                    <label for='country'>Country:</label>
                    <select name='country' required>
                        <option value=''>Select Country</option>";
                        foreach ($countries as $country) {
                            echo "<option value='$country'";
                            if ($row['country'] === $country) {
                                echo " selected";
                            }
                            echo ">$country</option>";
                        }
            echo "  </select><br>

                    <label for='zipcode'>Zipcode:</label>
                    <input type='text' name='zipcode' value='".$row['zipcode']."' required><br>

                    <label for='city'>City:</label>
                    <input type='text' name='city' value='".$row['city']."' required><br>

                    <label for='occupation'>Occupation:</label>
                    <select name='occupation' required>
                        <option value=''>Select Occupation</option>";
                        foreach ($occupations as $occupation) {
                            echo "<option value='$occupation'";
                            if ($row['occupation'] === $occupation) {
                                echo " selected";
                            }
                            echo ">$occupation</option>";
                        }
            echo "  </select><br>

                    <label for='gender'>Gender:</label>
                    <input type='radio' name='gender' value='male' required";
                    if ($row['gender'] === 'male') {
                        echo " checked";
                    }
            echo "> Male
                    <input type='radio' name='gender' value='female' required";
                    if ($row['gender'] === 'female') {
                        echo " checked";
                    }
            echo "> Female<br>

                    <label for='phone'>Phone:</label>
                    <input type='text' name='phone' value='".$row['phone']."' required><br>

                    <label for='website'>Website:</label>
                    <input type='text' name='website' value='".$row['website']."' required><br>

                    <input type='submit' value='Update User'>
                </form>";
        } else {
            echo "User not found.";
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>
