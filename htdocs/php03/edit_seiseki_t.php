<?php  // 成績テーブルの編集

$db = mysqli_connect('mysql', 'root', 'root', 'seiseki_db' );
if( $db == FALSE ) {
  exit( 'データベースに接続できませんでした。' );
}
mysqli_set_charset($db, 'utf8' );

//テーブル処理
if( isset( $_POST['add_kid'] ) 
    && isset( $_POST['add_gid'] )
    && isset( $_POST['add_s'] ) ) { // 追加
  $add_kid = htmlspecialchars( $_POST['add_kid'] );
  $add_gid = htmlspecialchars( $_POST['add_gid'] );
  $add_s = htmlspecialchars( $_POST['add_s'] );  
  $query = "insert into seiseki_t values ({$add_gid}, {$add_kid}, {$add_s})";
//  print( $query );
  mysqli_query( $db, $query );
} elseif ( isset( $_GET['del_gid'] ) && isset($_GET['del_kid'] ) ) {  // 削除
  $del_gid = htmlspecialchars( $_GET['del_gid'] );
  $del_kid = htmlspecialchars( $_GET['del_kid'] );
  $query = "delete from seiseki_t where gakusei_id = {$del_gid} and kamoku_id = {$del_kid}";
//  print( $query );
  mysqli_query( $db, $query );
} elseif ( isset( $_GET['up_gid'] ) 
      && isset( $_GET['up_kid'] )
      && isset( $_GET['up_s'] ) ) {  //変更
  $up_gid = htmlspecialchars( $_GET['up_gid'] );
  $up_kid = htmlspecialchars( $_GET['up_kid'] );
  $up_s = htmlspecialchars( $_GET['up_s'] );
  $query = "update seiseki_t set seiseki = {$up_s} where gakusei_id = {$up_gid} and kamoku_id = {$up_kid}";
//  print( $query );
  mysqli_query( $db, $query );
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="author" content="EbinaKai">
  <link rel="stylesheet" type="text/css" href="../CSSsample.css">
  <title>成績テーブルの編集</title>
</head>
<body>

  <h1>成績テーブルの編集</h1>

  <p>
    <form action="edit_seiseki_t.php" method="post">
      <label>
        学生：
        <select name="add_gid"> 
          <?php
            $recordSet = mysqli_query($db, 'select * from gakusei_t' );
            while( $data = mysqli_fetch_assoc( $recordSet ) ):
              $gakusei_id = $data['gakusei_id'];
              $gakusei_mei = $data['gakusei_mei']; 
          ?>
            <option value="<?= $gakusei_id ?>"><?= $gakusei_mei ?></option>
          <?php endwhile; ?>
        </select>
      </label>
      <label>
        科目：
        <select name="add_kid"> 
        <?php
          $recordSet = mysqli_query($db, 'select * from kamoku_t' );
          while( $data = mysqli_fetch_assoc( $recordSet ) ):
            $kamoku_id = $data['kamoku_id'];
            $kamoku_mei = $data['kamoku_mei']; 
          ?>
            <option value="<?= $kamoku_id ?>"><?= $kamoku_mei ?></option>
          <?php endwhile; ?>
        </select>
      </label>
      <label>成績：<input type="text" size="4" name="add_s"></label>
      <input type="submit" value="追加">
    </form>
  </p>

  <table>
  <tr><th>学生名</th><th>科目名</th><th>成績</th><th>削除</th><th>変更</th></tr>
  <?php
    $query = "select gt.gakusei_id as gid, gt.gakusei_mei as gmei, kt.kamoku_id as kid, kt.kamoku_mei as kmei, st.seiseki as s from seiseki_t as st inner join gakusei_t as gt on st.gakusei_id = gt.gakusei_id inner join kamoku_t as kt on st.kamoku_id = kt.kamoku_id";
    $recordSet = mysqli_query($db, $query );
    while( $data = mysqli_fetch_assoc( $recordSet ) ) {
      $gakusei_id = $data['gid'];
      $gakusei_mei = $data['gmei'];
      $kamoku_id = $data['kid']; 
      $kamoku_mei = $data['kmei']; 
      $seiseki = $data['s']; 
      $del_url = "edit_seiseki_t.php?del_gid={$gakusei_id}&del_kid={$kamoku_id}";
      $update_url = "update_seiseki_t.php?up_gid={$gakusei_id}&up_kid={$kamoku_id}&up_s={$seiseki}";
      printf( '<tr><td>%s</td><td>%s</td><td>%d</td><td><a href="%s">削除</a></td><td><a href="%s">変更</a></td></tr>', 
        $gakusei_mei, $kamoku_mei, $seiseki, $del_url, $update_url );
    }
  ?>
  </table>

  <p>
  <a href="index.php">トップページへ</a>
  </p>

</body>
</html>
