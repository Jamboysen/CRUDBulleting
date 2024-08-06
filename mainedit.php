<?php
include "db_conn.php";

// Sanitize and validate `id`
$id = intval($_GET["id"]);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["submit"])) {
    // Sanitize and validate `announcement`
    $announcement = mysqli_real_escape_string($conn, $_POST['announcement']);

    // Prepare the SQL statement
    $sql = "UPDATE `announcements` SET `announcement`='$announcement' WHERE id = $id";
    echo "SQL Query: $sql<br>";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: main.php?msg=Data updated successfully");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>PHP CRUD Application</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
    PHP Complete CRUD Application
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Announcement Information</h3>
      <p class="text-muted">Click UPDATE after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `announcements` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "SQL Error: " . mysqli_error($conn);
        exit();
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "<p class='text-danger'>Announcement not found.</p>";
        exit();
    }
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Announcement:</label>
            <input type="text" class="form-control" name="announcement" value="<?php echo htmlspecialchars($row['announcement']); ?>">
          </div>
        </div>
        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="main.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
