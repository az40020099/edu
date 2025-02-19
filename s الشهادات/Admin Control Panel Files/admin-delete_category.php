<?php
// admin/delete_category.php
require_once '../functions.php';
redirect_if_not_logged_in();
$conn = db_connect();

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // Check if any cards belong to this category
    $result = $conn->query("SELECT COUNT(*) as count FROM cards WHERE category_id = $id");
    $data = $result->fetch_assoc();
    if ($data['count'] > 0) {
        die("لا يمكن حذف الفئة لأنها تحتوي على بطاقات.");
    } else {
        $conn->query("DELETE FROM categories WHERE id = $id");
    }
}
header("Location: categories.php");
exit;
?>
