<?php

if(isset($_POST["login_id"])) {
  $db = new PDO('mysql:dbname=sql_injection;host=localhost', 'sql_injection', 'sql_injection');
  $stmt = $db->prepare("select * from user where (login_id='".$_POST["login_id"]."' and password='".md5($_POST["password"])."')");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if(is_bool($row)) {
      header("Location: ?message=Incorrect ID or Password.");
      exit;
    }
?>
ようこそ！ <?php echo $row["login_id"] ?> さん<br>
sql injectionに成功しました。
<?php
}else {
if(isset($_REQUEST["message"])) {
  echo "<font color='red'>".$_REQUEST["message"]."</font><br>";
}
?>

<form action="?" method="POST">
Login ID: <input name="login_id" ><br>
Password: <input type="password" name="password"><br>
<input type="submit" value="送信">
</form>

<?php
}
require("disp_source.php");
