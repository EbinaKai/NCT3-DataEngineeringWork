<?php
  require("../functions.php");
  if (isset($_GET['kamoku_id'])) {
    $kamoku_id = $_GET['kamoku_id'];
  } else {
    header('Location: index.php');
    exit;
  }
  $db = mysqli_connect('mysql', 'root', 'root', 'seiseki_db');
  if ($db == FALSE) {
    exit('データベースに接続できませんでした。');
  }
  mysqli_set_charset($db, 'utf-8');
  $stmt = $db->prepare("SELECT kamoku_mei FROM kamoku_t WHERE kamoku_id = ?");

  $stmt->bind_param('i', $kamoku_id);
  $stmt->execute();

  $result = $stmt->get_result();
  $data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="author" content="EbinaKai">
    <title>科目別成績</title>
    <link rel="icon" href="favicon.ico">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="../CSSsample.css">
</head>
<body>
  <h1>科目別成績</h1>
  <h3><?= $data['kamoku_mei']; ?></h3>
  <table>
    <tr>
      <th>学生名</th>
      <th>成績</th>
    </tr>

    <?php 
      $stmt = $db->prepare("
        SELECT g.gakusei_mei as g, s.seiseki as s
        FROM seiseki_t AS s
        INNER JOIN gakusei_t AS g ON g.gakusei_id = s.gakusei_id
        WHERE s.kamoku_id = ?;
      ");

      $stmt->bind_param('i', $kamoku_id);
      $stmt->execute();

      $result = $stmt->get_result();

      while ($data = $result->fetch_assoc()): 
    ?>
    <tr>
      <td><?= $data['g']; ?></td>
      <td><?= $data['s']; ?></td>
    </tr>
    <?php 
      endwhile; 
      $stmt = $db->prepare("SELECT avg(seiseki) AS a FROM seiseki_t WHERE kamoku_id = ?");
      if ($stmt === false) {
        die('prepare() failed: ' . $db->error);
      }

      $stmt->bind_param('i', $kamoku_id);
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