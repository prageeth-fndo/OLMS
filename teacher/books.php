<?php 
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: index.php");
}
$page = 'books';
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
                        <span class="disabled">books</span>
                    </div>
                </div>
            </div>
            <div class="books">
                <form action="" method="post" name="form1">
                    <table class="table ">
                        <tr>
                            <td>
                                <input type="text" name="search" class="form-control" placeholder="Enter book name">
                            </td>
                            <td>
                                 <input type="submit" name="submit1" class="btn btn-info" value="Search Book">
                            </td>
                        </tr>
                    </table>
                </form>

                <?php
                if (isset($_POST["submit1"])) {
                    $i = 0;
                    $search = $_POST["search"] . '%';
                    $stmt = $link->prepare("SELECT * FROM add_book WHERE books_name LIKE ?");
                    $stmt->bind_param("s", $search);
                    $stmt->execute();
                    $res = $stmt->get_result();

                    echo "<table class='table control-books'>";
                    echo "<tr>";
                    while ($row = $res->fetch_assoc()) {
                        $i++;
                        echo "<td>";
                        ?> 
                        <a href="../../<?php echo $row["books_file"]; ?>" target="_blank">
                            <img src="../../<?php echo $row["books_image"]; ?>" alt="">
                        </a> 
                        <br><br>
                        <b><?php echo $row["books_name"]; ?></b><br>
                        <b><?php echo "Available: " . $row["books_availability"]; ?></b>
                        <?php 
                        echo "</td>";

                        if ($i >= 4) {
                            echo "</tr><tr>";
                            $i = 0;
                        }
                    }
                    echo "</tr>";
                    echo "</table>";
                    $stmt->close();
                } else {
                    $i = 0;
                    $stmt = $link->prepare("SELECT * FROM add_book WHERE books_availability > 0");
                    $stmt->execute();
                    $res = $stmt->get_result();

                    echo "<table id='dtBasicExample' class='table control-books'>";
                    echo "<tr>";
                    while ($row = $res->fetch_assoc()) {
                        $i++;
                        echo "<td>";
                        ?> 
                        <a href="<?php echo $row["books_file"]; ?>" target="_blank">
                            <img src="<?php echo $row["books_image"]; ?>" alt="">
                        </a> 
                        <br><br>
                        <b><?php echo $row["books_name"]; ?></b><br>
                        <b><?php echo "Available: " . $row["books_availability"]; ?></b>
                        <?php 
                        echo "</td>";

                        if ($i >= 4) {
                            echo "</tr><tr>";
                            $i = 0;
                        }
                    }
                    echo "</tr>";
                    echo "</table>";
                    $stmt->close();
                }
                ?>
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
