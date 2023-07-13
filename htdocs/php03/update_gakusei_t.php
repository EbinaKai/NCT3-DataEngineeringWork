<?php
  $db = mysqli_connect('mysql', 'root', 'root', 'seiseki_db');
  if ($db == FALSE) {
    exit('データベースに接続できませんでした。');
  }

  if (isset($_POST["up_gid"])) {
    $up_gid = htmlspecialchars($_POST['up_gid']);
    $up_gmei = htmlspecialchars($_POST['up_gmei']);
  } else if (isset($_GET['up_gid']) && isset($_GET['up_gmei'])) {
    $up_gid = htmlspecialchars($_GET['up_gid']);
    $up_gmei = htmlspecialchars($_GET['up_gmei']);
    $query = "UPDATE gakusei_t SET gakusei_mei = '{$up_gmei}' WHERE gakusei_id = {$up_gid}";
    mysqli_query($db, $query);
  }

  mysqli_set_charset($db, 'utf-8');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="EbinaKai">
    <title>学生名の変更</title>
    <link rel="icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../CSSsample.css">
</head>
<body>
  <h3>学生名の変更</h3>
  <p>
    <form action="update_gakusei_t.php" method="get">
      <input type="hidden" name="up_gid" value="<?=$up_gid; ?>">
      <label>
        変更名：
        <input type="text" size="20" name="up_gmei" value="<?= $up_gmei?>">
      </label>
      <input type="submit" value="変更">
    </form>
  </p>
  <p>
    <a href="edit_gakusei_t.php">学生テーブルの編集へ</a>
  </p>
</body>
</html>