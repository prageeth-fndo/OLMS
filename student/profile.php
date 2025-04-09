<?php 
session_start();
if (!isset($_SESSION["student"])) {
    header("Location: index.php");
}
include 'inc/header.php';
include 'inc/connection.php';

// Update photo if submitted
if (isset($_POST["submit"])) {
    $image_name = $_FILES['image']['name'];
    $temp = explode(".", $image_name);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $imagepath = "upload/" . $newfilename;
    move_uploaded_file($_FILES["image"]["tmp_name"], $imagepath);

    $stmt = $link->prepare("UPDATE std_registration SET photo = ? WHERE username = ?");
    $stmt->bind_param("ss", $imagepath, $_SESSION['student']);
    $stmt->execute();
    $stmt->close();

    header("Location: profile.php");
}

// Update profile fields if submitted
if (isset($_POST["update"])) {
    $stmt = $link->prepare("UPDATE std_registration SET name = ?, phone = ?, address = ? WHERE username = ?");
    $stmt->bind_param("ssss", $_POST['name'], $_POST['phone'], $_POST['address'], $_SESSION['student']);
    $stmt->execute();
    $stmt->close();

    echo '<script type="text/javascript">window.location="profile.php";</script>';
}

// Fetch user data
$stmt = $link->prepare("SELECT * FROM std_registration WHERE username = ?");
$stmt->bind_param("s", $_SESSION['student']);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $regno = $row['regno'];
    $username = $row['username'];
    $name = $row['name'];
    $sem = $row['sem'];
    $session = $row['session'];
    $dept = $row['dept'];
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
                            <img src="<?php echo htmlspecialchars($photo); ?>" alt="Profile Photo">
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
                                    <label for="regno" class="text-right">Reg No:</label>
                                    <input type="text" class="form-control custom" name="regno" value="<?php echo htmlspecialchars($regno); ?>" disabled />
                                </div>
                                <div class="form-group details-control">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control custom" name="username" value="<?php echo htmlspecialchars($username); ?>" disabled />
                                </div>
                                <div class="form-group details-control">
                                    <label for="name" class="text-right">Name:</label>
                                    <input type="text" class="form-control custom" name="name" value="<?php echo htmlspecialchars($name); ?>" />
                                </div>
                                <div class="form-group details-control">
                                    <label for="sem" class="text-right">Semester:</label>
                                    <input type="text" class="form-control custom" name="sem" value="<?php echo htmlspecialchars($sem); ?>" />
                                </div>
                                <div class="form-group details-control">
                                    <label for="session" class="text-right">Session:</label>
                                    <input type="text" class="form-control custom" name="session" value="<?php echo htmlspecialchars($session); ?>" />
                                </div>
                                <div class="form-group details-control">
                                    <label for="dept" class="text-right">Departemt:</label>
                                    <input type="text" class="form-control custom" name="dept" value="<?php echo htmlspecialchars($dept); ?>" />
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
