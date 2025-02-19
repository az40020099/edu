<?php
// admin/delete_card.php
require_once '../functions.php';
redirect_if_not_logged_in();
$conn = db_connect();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Delete associated image file if exists
    $result = $conn->query("SELECT image FROM cards WHERE id = $id");
    if($result->num_rows > 0) {
        $card = $result->fetch_assoc();
        if($card['image'] && file_exists("../uploads/" . $card['image'])) {
            unlink("../uploads/" . $card['image']);
        }
    }
    $conn->query("DELETE FROM cards WHERE id = $id");
}
header("Location: cards.php");
exit;
?>
