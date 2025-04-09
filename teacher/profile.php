<?php 
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: index.php");
}
include 'inc/header.php';
include 'inc/connection.php';

// Upload photo logic
if (isset($_POST["submit"])) {
    $image_name = $_FILES['image']['name'];
    $temp = explode(".", $image_name);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $imagepath = "upload/" . $newfilename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $imagepath);

    $stmt = $link->prepare("UPDATE t_registration SET photo = ? WHERE username = ?");
    $stmt->bind_param("ss", $imagepath, $_SESSION["teacher"]);
    $stmt->execute();
    $stmt->close();

    header("Location: profile.php");
}

// Update profile info
if (isset($_POST["update"])) {
    $stmt = $link->prepare("UPDATE t_registration SET name = ?, phone = ?, address = ? WHERE username = ?");
    $stmt->bind_param("ssss", $_POST['name'], $_POST['phone'], $_POST['address'], $_SESSION['teacher']);
    $stmt->execute();
    $stmt->close();

    echo '<script>window.location="profile.php";</script>';
}

// Fetch user info
$stmt = $link->prepare("SELECT * FROM t_registration WHERE username = ?");
$stmt->bind_param("s", $_SESSION["teacher"]);
$stmt->execute();
$res = $stmt->get_result();

while ($row = $res->fetch_assoc()) {
    $idno = $row['idno'];
    $username = $row['username'];
    $name = $row['name'];
    $lecturer = $row['lecturer'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $utype = $row['utype'];
    $photo = $row['photo'];
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
                        <span class="disabled">profile</span>
                    </div>
                </div>
            </div>
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="photo">
                            <img src="<?php echo htmlspecialchars($photo); ?>" alt="something wrong">
                        </div>
                        <div class="uploadPhoto">
                            <div class="gap-30"></div>
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="file" name="image" class="modal-mt" id="image">
                                <div class="gap-30"></div>
                                <input type="submit" class="modal-mt btn btn-info" value="Upload Image" name="submit">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="details">
                            <form method="post">
                                <div class="form-group details-control">
                                    <label for="idno" class="text-right">Id No:</label>
                                    <input type="text" class="form-control custom" name="idno" value="<?php echo htmlspecialchars($idno); ?>" disabled />
                                </div>
                                <div class="form-group details-control">
                                    <label for="tusername">Username:</label>
                                    <input type="text" class="form-control custom" name="tusername" value="<?php echo htmlspecialchars($username); ?>" disabled />
                                </div>
                                <div class="form-group details-control">
                                    <label for="name" class="text-right">Name:</label>
                                    <input type="text" class="form-control custom" name="name" value="<?php echo htmlspecialchars($name); ?>" />
                                </div>
                                <div class="form-group details-control">
                                    <label for="lecturer" class="text-right">Lecturer:</label>
                                    <input type="text" class="form-control custom" name="lecturer" value="<?php echo htmlspecialchars($lecturer); ?>" />
                                </div>
                                <div class="form-group details-control">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control custom" name="email" value="<?php echo htmlspecialchars($email); ?>" disabled />
                                </div>
                                <div class="form-group details-control">
                                    <label for="phone">Phone No:</label>
                                    <input type="text" class="form-control custom" name="phone" value="<?php echo htmlspecialchars($phone); ?>" />
                                </div>
                                <div class="form-group details-control">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control custom" name="address" value="<?php echo htmlspecialchars($address); ?>" />
                                </div>
                                <div class="form-group details-control">
                                    <label for="utype">User Type:</label>
                                    <input type="text" class="form-control custom" name="utype" value="<?php echo htmlspecialchars($utype); ?>" disabled />
                                </div>
                                <div class="text-right mt-20">
                                    <input type="submit" value="Save" class="btn btn-info" name="update">
                                </div>
                            </form>
                        </div> 
                    </div>    
                </div>
            </div>					
        </div>
    </div>
</div>
<?php 
include 'inc/footer.php';
?>
