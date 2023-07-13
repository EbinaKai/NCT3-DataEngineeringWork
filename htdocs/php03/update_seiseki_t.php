<?php
// 成績テーブルの変更

// データベースへの接続
$db = mysqli_connect('mysql', 'root', 'root', 'seiseki_db' );
if( $db == FALSE ) {
  exit( 'データベースに接続できませんでした。' );
}
// 文字コードの設定
mysqli_set_charset($db, 'utf8' );

if( isset( $_GET['up_gid'] ) 
    && isset( $_GET['up_kid'] ) 
    && isset( $_GET['up_s'] ) ) {
  $up_gid = htmlspecialchars( $_GET['up_gid'] );
  $up_kid = htmlspecialchars( $_GET['up_kid'] );
  $up_s = htmlspecialchars( $_GET['up_s'] );

  $query = "select * from gakusei_t where gakusei_id = {$up_gid}";
  $recordSet = mysqli_query($db, $query );
  $data = mysqli_fetch_assoc( $recordSet );
  $up_gmei = $data['gakusei_mei'];

  $query = "select * from kamoku_t where kamoku_id = {$up_kid}";
  $recordSet = mysqli_query($db, $query );
  $data = mysqli_fetch_assoc( $recordSet );
  $up_kmei = $data['kamoku_mei'];

//  print( $up_gid . $up_gmei . $up_kid . $up_kmei . $up_s );
}

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../CSSsample.css">
  <title>成績の変更</title>
  </head>
<body>

  <h3>成績の変更</h3>

  <p>
    <form action = "edit_seiseki_t.php" method="get">
      <label>
      【学生】<?= $up_gmei; ?>
      <input type="hidden" name="up_gid" value="<?= $up_gid; ?>">
      【科目】<?= $up_kmei; ?>
      <input type="hidden" name="up_kid" value="<?= $up_kid; ?>">
      【成績】
      <input type="text" size="4" name="up_s" value="<?= $up_s; ?>" >
      <input type="submit" value="変更"> 
    </form>
  </p>

  <p>
  <a href="edit_seiseki_t.php">成績テーブルの編集へ</a>
  </p>

</body>
</html>
