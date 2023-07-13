<?php
require('../functions.php');
$db = mysqli_connect('mysql', 'root', 'root', 'seiseki_db' );
if( $db == FALSE ) {
  exit( 'データベースに接続できませんでした。' );
}
mysqli_set_charset($db, 'utf8' );
?>
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
  <h1>成績管理システム</h1>
  <h2>成績表示</h2>
  <form action="kamoku_seiseki.php" method="get">
    <p>
      科目別：
      <select name="kamoku_id" id="kamoku_id">
        <?php 
          $stmt = $db->prepare("SELECT * FROM kamoku_t");
          $stmt->execute();
          $result = $stmt->get_result();
          while( $data = $result->fetch_assoc()):
        ?>
          <option value="<?= h($data['kamoku_id'])?>"><?= h($data['kamoku_mei'])?></option>
        <?php endwhile; ?>
      </select>
      <input type="submit" value="表示">
    </p>
  </form>
  <form action="gakusei_seiseki.php" method="get">
    <p>
      学生別：
      <select name="gakusei_id" id="gakusei_id">
        <?php 
          $stmt = $db->prepare("SELECT * FROM gakusei_t");
          $stmt->execute();
          $result = $stmt->get_result();
          while( $data = $result->fetch_assoc()):
        ?>
          <option value="<?= h($data['gakusei_id'])?>"><?= h($data['gakusei_mei'])?></option>
        <?php endwhile; ?>
      </select>
      <input type="submit" value="表示">
    </p>
  </form>
  <h2>データ編集</h2>
  <ul>
    <li><a href="edit_gakusei_t.php">学生データ</a></li>
    <li><a href="edit_kamoku_t.php">科目データ</a></li>
    <li><a href="edit_seiseki_t.php">成績データ</a></li>
  </ul>
</body>
</html>