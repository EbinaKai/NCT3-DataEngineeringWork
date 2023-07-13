<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="EbinaKai">
    <title>学生テーブル</title>
    <link rel="icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../CSSsample.css">
</head>
<body>
  <?php
    $db = mysqli_connect('mysql', 'root', 'root', 'seiseki_db');
    if ($db == FALSE) {
      exit('データベースに接続できませんでした。');
    } else {
      print('データベースに接続しました。');
    }

    mysqli_set_charset($db, 'utf-8');

    $id = htmlspecialchars($_POST["id"]);
    $query = "DELETE FROM gakusei_t WHERE gakusei_id = {$id}";
    print("<p>{$query}</p>");

    $result = mysqli_query($db, $query);
    if ($result == FALSE) {
      exit("削除できませんでした。");
    }
    print("<p>{$id}を削除しました。</p>");
  ?>

  <p>
    <a href="index.html">戻る</a>
  </p>
</body>
</html>