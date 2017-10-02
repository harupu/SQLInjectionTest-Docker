<?php
if(isset($_POST["mail"])) {
  $db = new PDO('mysql:dbname=sql_injection;host=localhost', 'sql_injection', 'sql_injection');
  $stmt = $db->prepare("select * from user where (mail='".$_POST["mail"]."')");
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if(!is_bool($row)) {
    //トークン発行したりメール送信する処理
  }
?>
指定されたメールアドレスにメールを送信しました。時間が経ってもメールが届かない場合は、再度メールアドレスを入力してください。
(実際にメールは飛びません)
<?php
} else{
?>
登録に利用したメールアドレスを入力してください。
<form action="?" method="POST">
<input name="mail" size=50>
<input type="submit" value="送信">
</form>
<?php
}
require("disp_source.php");
