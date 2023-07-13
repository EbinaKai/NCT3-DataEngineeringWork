<?php
  require("../functions.php");
  if (isset($_GET['gakusei_id'])) {
    $gakusei_id = $_GET['gakusei_id'];
  } else {
    header('Location: index.php');
    exit;
  }
  $db = mysqli_connect('mysql', 'root', 'root', 'seiseki_db');
  if ($db == FALSE) {
    exit('データベースに接続できませんでした。');
  }
  mysqli_set_charset($db, 'utf-8');
  $stmt = $db->prepare("SELECT gakusei_mei FROM gakusei_t WHERE gakusei_id = ?");

  $stmt->bind_param('i', $gakusei_id);
  $stmt->execute();

  $result = $stmt->get_result();
  $data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="EbinaKai">
    <title>学生別成績</title>
    <link rel="icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../CSSsample.css">
</head>
<body>
  <h1>学生別成績</h1>
  <h3><?= $data['gakusei_mei']; ?></h3>
  <table>
    <tr>
      <th>科目</th>
      <th>成績</th>
    </tr>

    <?php 
      $stmt = $db->prepare("
        SELECT k.kamoku_mei as k, s.seiseki as s
        FROM seiseki_t AS s
        INNER JOIN kamoku_t AS k ON k.kamoku_id = s.kamoku_id
        WHERE s.gakusei_id = ?;
      ");

      $stmt->bind_param('i', $gakusei_id);
      $stmt->execute();

      $result = $stmt->get_result();

      while ($data = $result->fetch_assoc()): 
    ?>
    <tr>
      <td><?= $data['k']; ?></td>
      <td><?= $data['s']; ?></td>
    </tr>
    <?php 
      endwhile;  
      $stmt = $db->prepare("SELECT avg(seiseki) AS a FROM seiseki_t WHERE gakusei_id = ?");

      $stmt->bind_param('i', $gakusei_id);
      $stmt->execute();

      $result = $stmt->get_result();
      $data = $result->fetch_assoc();
    ?>

    <tr>
      <td>（平均）</td>
      <td><?php printf("%.1f", h($data['a']))?></td>
    </tr>
  </table>

  <p>
    <a href="index.php">戻る</a>
  </p>
</body>
</html>