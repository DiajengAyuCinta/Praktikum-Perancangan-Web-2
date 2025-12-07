<?php
function paginate($conn, $query, $per_page = 5) {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $start = ($page - 1) * $per_page;

    $result = mysqli_query($conn, $query . " LIMIT $start, $per_page");

    $total_records = mysqli_num_rows(mysqli_query($conn, $query));
    $total_pages = ceil($total_records / $per_page);

    return [
        "result" => $result,
        "page" => $page,
        "total_pages" => $total_pages
    ];
}
?>
