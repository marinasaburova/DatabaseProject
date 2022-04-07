<?php
session_start();
// get variables
$email = $_POST['email'];
$pwd = $_POST['pwd'];

include '../functions/db.php'
?>

<?php
$title = "Products";

require '../functions/db.php';
include '../view/header.php';

?>
<h1 style="padding-top: 40px">Login Results:</h1>

<div id="log-in">
    <?php
    // finds matching credentials
    $query = "SELECT * FROM CUSTOMER WHERE CEmail = '" . $email . "'";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $epwd = $row['CPassword'];

    if ((mysqli_num_rows($result) == 0) || !(password_verify($pwd, $epwd)) || $row['isActive'] == '0') {
        echo '<p>Incorrect credentials.</p></br>';
        echo '<a class = "link" href=login.html>Try again.</a>';
    } else {
        $_SESSION['email'] = $email;
        $_SESSION['epwd'] = $epwd;
        $_SESSION['cfname'] = $row['CFName'];
        $_SESSION['cart'] = '';
        $_SESSION['loggedin'] = TRUE;
        header('Location: ../main/index.php');
    }

    $result->free();
    $db->close();

    ?>
</div>
</body>

</html>