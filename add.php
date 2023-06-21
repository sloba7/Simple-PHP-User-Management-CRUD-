<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body id="add">
    <h2>Add User</h2>
    <?php 
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
        //Database connection

        $server = "localhost";
        $username = "your_username";
        $password = "your_password";
        $database = "your_database_name";

        $conn = mysqli_connect($server,$username, $password, $database);

        if(!$conn){
            die("Connection failed: " . mysqli_connect_error());
        }

        $table_check_query = "SHOW TABLES LIKE 'users'";
        $table_check_result = mysqli_query($conn, $table_check_query);
     
          if(mysqli_num_rows($table_check_result) == 0){
             echo "<br>Table need to be created so user can be added <br>";
             mysqli_close($conn);
             exit;
          }

      
     
        
        //Get form data

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

        //Insert user intro database

        $query = "INSERT INTO users (name, email, lastname, country, zipcode, city, occupation, gender, phone, website)
                  VALUES ('$name', '$email', '$lastname', '$country', '$zipcode', '$city', '$occupation', '$gender', '$phone', '$website')";

        if (mysqli_query($conn, $query)) {
            echo "<p class='message'>User added successfully.</p>";
            mysqli_close($conn);
            echo "<script>
            setTimeout(function(){
                window.location.href = 'index.php';
            },3000)
            </script>";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
            mysqli_close($conn);
        }

       
    }else{

    // Dropdown options
    $countries = ['Country 1', 'Country 2', 'Country 3'];
    $occupations = ['Occupation 1', 'Occupation 2', 'Occupation 3'];

    }
    
    ?>


<form action="" method="post">

<label for="name">Name:</label>
<input type="text" name="name" id="" require><br>

<label for="email">Email:</label>
<input type="email" name="email" id="" require><br>

<label for="lastname">Last Name:</label>
<input type="text" name="lastname" id="" require><br>

<label for="country">Country:</label>
<select name="country" id="" >

<option value="">Select Country</option>
<?php 

foreach($countries as $country){
echo "<option value='$country'>$country</option>";
}
?>
</select><br>

<label for="zipcode">Zip Code:</label>
<input type="text" name="zipcode" id="" require><br>

<label for="city">City</label>
<input type="text" name="city" require><br>

<label for="occupation">Occupation</label>
<select name="occupation" id="" >
<option value="">Select Occupation</option>
<?php 
foreach ($occupations as $occupation){
    echo "<option value='$occupation' >$occupation</option>";
}
?>
</select><br>

<label for="gender">Gender:</label>
<div class="radio-buttons">
<input type="radio" name="gender" value="male" id="" require>Male
<input type="radio" name="gender" value="female" require> Female <br>
</div>
<label for="phone">Phone: </label>
<input type="text" name="phone" require><br>

<label for="website">Website:</label>
<input type="text" name="website" require><br>

<input type="submit" value="Add User">

</form>



</body>
</html>