<?php
if(isset($_REQUEST["query"])) {
  $db = new PDO('mysql:dbname=sql_injection;host=localhost', 'sql_injection', 'sql_injection');
  $stmt = $db->prepare("select * from item where (name like '%".$_REQUEST["query"]."%')");
  $stmt->execute();
  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<form action="?">
<input name="query" value="<?php echo htmlspecialchars($_REQUEST["query"]) ?>" size=50>
<input type="submit" value="検索">
</form>
<?php
if(isset($rows) && count($rows) > 0) {
?>
<table>
<tr><th>名前</th><th>値段</th></tr>
<?php
foreach ($rows as $row) {
  echo "<tr><td>".$row["name"]."</td><td>".$row["cost"]."</td></tr>";
}
?>
</table>
<?php
}else{
?>
アイテムが見つかりませんでした
<?php
}
require("disp_source.php");
