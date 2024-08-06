<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $hotline = $_POST['hotline'];
   $dept = $_POST['dept'];
   $id = $_POST['id'];

   $sql = "INSERT INTO `hotline`(`hotline`, `dept`,`id`) VALUES ('$hotline','$dept', '$id')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: hotline.php?msg=New record created successfully");
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
      <a href = "main.php"> Announcements </a> &nbsp;
    <a href = "hotline.php"> Hotlines </a>&nbsp;
    <a href = "register.php"> Register </a> &nbsp;
    <a href = "login.php"> Log In </a> &nbsp;
    <a href = "logout.php"> Log Out</a>
   </nav>

   <a href="newhot.php" class="btn btn-dark mb-3">Add New</a>

        <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr>
            <th scope="col">Department</th>
            <th scope="col">Hotlines</th>
            
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `hotline`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row["dept"] ?></td>
                <td><?php echo $row["hotline"] ?></td>
                
                <td>
                <a href="hotedit.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                <a href="hotdelete.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
        </table>
         </form>
      </div>
   </div>

   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>