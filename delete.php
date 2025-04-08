<?php
	session_start();
	if (!isset($_SESSION["username"])) {
		header("Location: login.php");
		exit();
	}
         
	include 'inc/connection.php';
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		mysqli_query($link, "delete from t_issuebook where id=$id");
        mysqli_query($link, "delete from issue_book where id=$id");
		?>
		<script type="text/javascript">
			window.location="issued-books.php";
		</script>
		<?php
	}
	else {
		header("Location: issued-books.php");
		exit();
	}


 ?>