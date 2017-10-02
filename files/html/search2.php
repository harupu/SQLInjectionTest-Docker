<?php
$db = new PDO('mysql:dbname=sql_injection;host=localhost', 'sql_injection', 'sql_injection');
$sql = "select * from item where (name like :query)";
if(isset($_REQUEST["order"])) {
  $sql .= " order by ".$_REQUEST["order"];
}
$sql .= " limit 10";
if(isset($_REQUEST["page"])) {
  $sql .= " offset ".($_REQUEST["page"]*10);
}
$query = "%".$_REQUEST["query"]."%";
$stmt = $db->prepare($sql);
$stmt->bindParam(':query', $query, PDO::PARAM_STR);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<form action="?">
<input name="query" value="<?php echo htmlspecialchars($_REQUEST["query"]) ?>" size=50><br>
表示順：<select name="order">
<option value="name">名前</option>
<option value="cost">価格</option>
</select><br>
<input type="submit" value="検索">
</form>
<?php
if(isset($rows) && count($rows) > 0) {
  if($_REQUEST["page"] > 0) {
    print "<a href='?query=".htmlspecialchars($_REQUEST["query"],ENT_QUOTES)."&order=".htmlspecialchars($_REQUEST["order"],ENT_QUOTES)."&page=".($_REQUEST["page"]-1)."'> &lt;前ページへ </a>&nbsp; ";
  }
  if(count($rows) > ($_REQUEST["page"]-1)*10) {
    print "<a href='?query=".htmlspecialchars($_REQUEST["query"],ENT_QUOTES)."&order=".htmlspecialchars($_REQUEST["order"],ENT_QUOTES)."&page=".($_REQUEST["page"]+1)."'> 次ページへ&gt; </a>";
  }
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
