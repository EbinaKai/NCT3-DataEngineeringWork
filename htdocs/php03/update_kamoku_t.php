<?php
  $db = mysqli_connect('mysql', 'root', 'root', 'seiseki_db');
  if ($db == FALSE) {
    exit('データベースに接続できませんでした。');
  }

  if (isset($_POST["up_kid"])) {
    $up_kid = htmlspecialchars($_POST['up_kid']);
    $up_kmei = htmlspecialchars($_POST['up_kmei']);
  } else if (isset($_GET['up_kid']) && isset($_GET['up_kmei'])) {
    $up_kid = htmlspecialchars($_GET['up_kid']);
    $up_kmei = htmlspecialchars($_GET['up_kmei']);
    $query = "UPDATE kamoku_t SET kamoku_mei = '{$up_kmei}' WHERE kamoku_id = {$up_kid}";
    mysqli_query($db, $query);
  }

  mysqli_set_charset($db, 'utf-8');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="EbinaKai">
    <title>科目名の変更</title>
    <link rel="icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../CSSsample.css">
</head>
<body>
  <h3>科目名の変更</h3>
  <p>
    <form action="update_kamoku_t.php" method="get">
      <input type="hidden" name="up_kid" value="<?=$up_kid; ?>">
      <label>
        変更名：
        <input type="text" size="20" name="up_kmei" value="<?= $up_kmei?>">
      </label>
      <input type="submit" value="変更">
    </form>
  </p>
  <p>
    <a href="edit_kamoku_t.php">科目テーブルの編集へ</a>
  </p>
</body>
</html>