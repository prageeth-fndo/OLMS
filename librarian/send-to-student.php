<?php 
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
}
include 'inc/header.php';
include 'inc/connection.php';
?>
<!--dashboard area-->
<div class="dashboard-content">
    <div class="dashboard-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left">
                        <p><span>dashboard</span>Control panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                        <span class="disabled">send Message to student</span>
                    </div>
                </div>
            </div>
            <div class="sendMessage">
                <form action="" method="post" name="form1" class="col-lg-6" enctype="multipart/form-data">
                    <table class="table table-bordered table-striped">
                    <?php
                        date_default_timezone_set("Asia/Dhaka");
                        $time = date("Y-m-d h:i:sa");

                        if (isset($_POST["submit"])) {
                            $title  = $_POST["title"];
                            $msg    = $_POST["msg"]; 

                            if ($title == "" || $msg == "") {
                                echo "<span class='error-msg'><b>Error !</b> Field mustn't be empty</span>";
                            } else {
                                $stmt = $link->prepare("INSERT INTO message VALUES('', ?, ?, ?, ?, 'n', ?)");
                                $stmt->bind_param("sssss", 
                                    $_SESSION["username"], 
                                    $_POST["rusername"], 
                                    $title, 
                                    $msg, 
                                    $time
                                );

                                if ($stmt->execute()) {
                                    echo "<span class='successfull-msg'><b>Success !</b> Message sent successfully</span>";
                                } else {
                                    echo "<span class='error-msg'><b>Warning !</b> Message can't be sent</span>";
                                }

                                $stmt->close();
                            }
                        }
                    ?>
                        <tr>
                            <td>
                                <select name="rusername" class="form-control">
                                    <?php 
                                    $res = $link->query("SELECT username, regno FROM std_registration");
                                    while($row = $res->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo htmlspecialchars($row["username"]); ?>">
                                            <?php echo htmlspecialchars($row["username"] . " (" . $row["regno"] . ")"); ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" class="form-control" placeholder="Enter title" name="title">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <textarea name="msg" class="form-control" placeholder="Message here...."></textarea>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="submit" value="Send Message" class="btn btn-info">
                </form>
            </div>
        </div>					
    </div>
</div>

<?php 
include 'inc/footer.php';
?>
