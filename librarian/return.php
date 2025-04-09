<?php 
	include 'inc/connection.php';

	if (!isset($_GET["id"])) {
		die("Invalid ID.");
	}

	$id = (int)$_GET["id"];
	$a  = date("d/m/Y");
    $fine = "50";

    $stmt = $link->prepare("SELECT * FROM issue_book WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res3 = $stmt->get_result();
    while($row3 = $res3->fetch_assoc()){
		$username = $row3["username"];
		$utype = $row3["utype"];
		$email = $row3["email"];
        $booksname = $row3["booksname"];
        $brdate = $row3["booksreturndate"];
	}
    $stmt->close();

    if ($a > $brdate) {
        $stmt = $link->prepare("INSERT INTO finezone VALUES('', ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $utype, $email, $booksname, $fine);
        $stmt->execute();
        $stmt->close();
    }

    $stmt = $link->prepare("SELECT * FROM t_issuebook WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res4 = $stmt->get_result();
    while($row4 = $res4->fetch_assoc()){
		$username = $row4["username"];
		$utype = $row4["utype"];
		$email = $row4["email"];
        $booksname = $row4["booksname"];
        $brdate = $row4["booksreturndate"];
	}
    $stmt->close();

    $stmt = $link->prepare("UPDATE t_issuebook SET booksreturndate = ? WHERE id = ?");
    $stmt->bind_param("si", $a, $id);
    $stmt->execute();
    $stmt->close();

    $stmt = $link->prepare("UPDATE issue_book SET booksreturndate = ? WHERE id = ?");
    $stmt->bind_param("si", $a, $id);
    $stmt->execute();
    $stmt->close();
	$books_name = "";

    $stmt = $link->prepare("SELECT * FROM t_issuebook WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
	while($row = $res->fetch_assoc()){
		$books_name = $row["booksname"];
	}
    $stmt->close();

    $stmt = $link->prepare("SELECT * FROM issue_book WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res2 = $stmt->get_result();
	while($row = $res2->fetch_assoc()){
		$books_name = $row["booksname"];
	}
    $stmt->close();

    $stmt = $link->prepare("UPDATE add_book SET books_availability = books_availability + 1 WHERE books_name = ?");
    $stmt->bind_param("s", $books_name);
    $stmt->execute();
    $stmt->close();
	 
	header("Location: issued-books.php");
?>
