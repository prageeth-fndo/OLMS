<?php 
session_start();
if (!isset($_SESSION["user"])) {
    echo "<h3>Unauthorized Access! Please <a href='login.php'>log in</a>.</h3>";
    exit();
}

$user = $_SESSION["user"];
$page = 'home';
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
                        <p><span>dashboard</span>User panel</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right text-right">
                        <a href="dashboard.php"><i class="fas fa-home"></i>home</a>
                        <span class="disabled">Dashboard</span>
                    </div>
                </div>
            </div>
        </div>	
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="st-issuedBook">
                        <table id="dtBasicExample" class="table table-dark table-striped text-center">
                            <thead>
                                <tr>
                                    <th>Reg No</th>
                                    <th>Username</th>
                                    <th>Books Name</th>
                                    <th>Books Issue Date</th>
                                    <th>Books Return Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $stmt = $link->prepare("SELECT * FROM t_issuebook WHERE username = ? ORDER BY id DESC");
                                $stmt->bind_param("s", $_SESSION['teacher']);
                                $stmt->execute();
                                $res = $stmt->get_result();

                                while ($row = $res->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["username"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["booksname"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["booksissuedate"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["booksreturndate"]) . "</td>";
                                    echo "</tr>";
                                }

                                $stmt->close();
                            ?>
                            </tbody>
                        </table>
                    </div>	
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
include 'inc/footer.php';
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="inc/js/book-tables.js"></script>
