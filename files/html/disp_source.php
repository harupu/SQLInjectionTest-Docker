<hr>
<a href="javascript:void(0)" onclick="document.getElementById('source').style.visibility='visible';return false;">ソースコードを見る</a>
<plaintext id="source" style="visibility:hidden">
<?php
echo file_get_contents(basename($_SERVER['PHP_SELF']));
?>
