<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
   <link rel="stylesheet" href="style.css">
</head>
<body id="index">
    <h2>Users Management</h2>
    <a href="add.php" class="add-btn" >Add User</a>

    <form method="GET" action="">
        <label for="search">Search:</label>
        <input type="text" name="search"  id="search" placeholder="Search any value from table" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" >
        <input type="submit" value="Search">
        <?php if (isset($_GET['search'])): ?>
        <button type="button" class="clear" onclick="clearSearch()">Clear</button>
    <?php endif; ?>
    </form>
 
    <?php 
    ///Database Connection
   
    $server = "localhost";
    $username = "your_username";
    $password = "your_password";
    $database = "your_database_name";
   
    $conn = mysqli_connect($server, $username, $password, $database);

    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $table_check_query = "SHOW TABLES LIKE 'users'";
    $table_check_result = mysqli_query($conn, $table_check_query);

    if (mysqli_num_rows($table_check_result) == 0) {
        echo "<br>Table is not created. <br>";
        mysqli_close($conn);
        exit;
    }

    // Pagination
    $results_per_page = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $results_per_page;

    // Sorting
    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'name';
    $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';

    // Fetch users from database with sorting and filtering
    $query = "SELECT * FROM users";
    $where = [];

    if (!empty($_GET['search'])) {
        $search = $_GET['search'];
        $where[] = "(name LIKE '%$search%' OR email LIKE '%$search%' OR lastname LIKE '%$search%' OR country LIKE '%$search%' OR zipcode LIKE '%$search%' OR city LIKE '%$search%' OR occupation LIKE '%$search%' OR gender LIKE '%$search%' OR phone LIKE '%$search%' OR website LIKE '%$search%')";
    }

    if (!empty($where)) {
        $query .= " WHERE " . implode(" AND ", $where);
    }

    $query .= " ORDER BY $sort_by $sort_order LIMIT $offset, $results_per_page ";

    $results = mysqli_query($conn, $query);

    // Count total number of records
    $total_records_query = "SELECT COUNT(*) AS count FROM users";
    $total_records_result = mysqli_query($conn, $total_records_query);
    $total_records = mysqli_fetch_assoc($total_records_result)['count'];
    $total_pages = ceil($total_records / $results_per_page);

    if (mysqli_num_rows($results) > 0) {
        echo "<table>
                <tr>
                    <th><a href='?sort_by=name&sort_order=" . ($sort_by === 'name' && $sort_order === 'asc' ? 'desc' : 'asc') . "'> Name </a></th>
                    <th><a href='?sort_by=email&sort_order=" . ($sort_by === 'email' && $sort_order === 'asc' ? 'desc' : 'asc') . "'>Email</a></th>
                    <th>Last Name</th>
                    <th>Country</th>
                    <th>Zipcode</th>
                    <th>City</th>
                    <th>Occupation</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Website</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($results)) {
            echo "<tr>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['lastname'] . "</td>
                    <td>" . $row['country'] . "</td>
                    <td>" . $row['zipcode'] . "</td>
                    <td>" . $row['city'] . "</td>
                    <td>" . $row['occupation'] . "</td>
                    <td>" . $row['gender'] . "</td>
                    <td>" . $row['phone'] . "</td>
                    <td>" . $row['website'] . "</td>
                    <td><a href='edit.php?id=" . $row['id'] . "'>Edit</a></td>
                    <td><a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>
                  </tr>";
        }
        echo "</table>";

// Pagination links
echo "<br> <div class='pagination'>";

if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "'>Previous</a>";
}

for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='?page=" . $i . "' ".($page == $i ? "class='active'" : "").">" . $i . "</a>";
}

if ($page < $total_pages) {
    echo "<a href='?page=" . ($page + 1) . "'></a>";
}

echo "</div>";

    } else {
        echo "No records found.";
    }

    mysqli_close($conn);
    ?>

<script>
    function clearSearch() {
        document.getElementById('search').value = '';
        window.location.href = window.location.pathname;
    }
</script>
</body>
</html>
