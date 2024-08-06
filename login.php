<?php
session_start();
include 'db_conn.php';
?>

<html>
    <body>
        <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            Email: 
            <input type="text" name="email" autocomplete="off" placeholder="admin/public">
            Password: 
            <input type="password" name="password" autocomplete="new-password">
            <input type="submit" value="login">
        </form>
    </body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if email and password are set
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1");
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
    
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['email'] = $user['email'];
            $_SESSION['type'] = $user['type'];

            if ($_SESSION['type'] == 0) {
                header('Location: main.php');
            } else {
                header('Location: publicmain.php');
            }
            
            exit();
        } else {
            echo "Invalid username or password";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Please enter both email and password";
    }
}
?>
