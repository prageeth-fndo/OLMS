<?php 
session_start();
if (!isset($_SESSION["teacher"])) {
    header("Location: index.php");
}
$page = 'rbook';
include 'inc/header.php';
include 'inc/connection.php';

// Fetch student info securely
$stmt = $link->prepare("SELECT * FROM t_registration WHERE username = ?");
$stmt->bind_param("s", $_SESSION["teacher"]);
$stmt->execute();
$res5 = $stmt->get_result();

while ($row5 = $res5->fetch_assoc()) {
    $name = $row5['name'];
    $username = $row5['username'];
    $email = $row5['email'];
    $phone = $row5['phone'];
    $utype = $row5['utype'];
}
$stmt->close();
?>

<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <p><span>dashboard</span>User panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                        <span class="disabled">request book</span>
                    </div>
                </div>
            </div>
            <div class="st-issuedBook">
                <form action="" method="post" class="issue-content">
                    <table class="table table-bordered table-striped">
                        <?php 
                        if (isset($_POST["submit"])) {
                            $bname = $_POST['bname'];
                            $burl = $_POST['burl'];

                            if ($bname == "" || $burl == "") {
                                echo "<span class='error-msg'><b>Error !</b> Field mustn't be empty</span>";
                            } else {
                                // Insert using prepared statement
                                $stmt = $link->prepare("INSERT INTO request_books VALUES('', ?, ?, ?, ?, ?, ?, 'no')");
                                $stmt->bind_param("ssssss", $name, $username, $email, $utype, $bname, $burl);
                                if ($stmt->execute()) {
                                    echo "<span class='successfull-msg'><b>Success !</b> Book request sent successfully.</span>";
                                }
                                $stmt->close();
                            }
                        }
                        ?>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($username); ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control bdr" name="bname" value="" placeholder="Request book name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" value="student" name="<?php echo htmlspecialchars($utype); ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="email" value="<?php echo htmlspecialchars($email); ?>" disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control bdr" name="burl" value="" placeholder="Books url">
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="submit" value="Send Request" class="btn">
                </form>
            </div>
        </div>					
    </div>
</div>
<?php 
include 'inc/footer.php';
?>
