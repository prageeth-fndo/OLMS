<?php 
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: index.php");
}
include 'inc/header.php';
include 'inc/connection.php';

// SQLi fixed
$stmt = $link->prepare("UPDATE message SET read1='y' WHERE rusername = ?");
$stmt->bind_param("s", $_SESSION["student"]);
$stmt->execute();
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
                        <span class="disabled">notifications</span>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered text-center table-striped">
                        <tr>
                            <th>Librarian name</th>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Time</th>
                        </tr>
                        <?php 
                        // SQLi fixed
                        $stmt = $link->prepare("SELECT * FROM message WHERE rusername = ? ORDER BY id DESC");
                        $stmt->bind_param("s", $_SESSION["student"]);
                        $stmt->execute();
                        $res = $stmt->get_result();

                        while ($row = $res->fetch_assoc()) {
                            $name = "";

                            // SQLi fixed
                            $stmt2 = $link->prepare("SELECT name FROM lib_registration WHERE username = ?");
                            $stmt2->bind_param("s", $row["susername"]);
                            $stmt2->execute();
                            $res1 = $stmt2->get_result();

                            if ($row1 = $res1->fetch_assoc()) {
                                $name = $row1["name"];
                            }

                            $stmt2->close();

                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($name) . "</td>";
                            echo "<td>" . htmlspecialchars($row["title"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["msg"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
                            echo "</tr>";
                        }

                        $stmt->close();
                        ?>
                    </table>
                </div>
            </div>
        </div>					
    </div>
</div>

<?php 
include 'inc/footer.php';
?>
