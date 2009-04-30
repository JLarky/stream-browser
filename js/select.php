<?php
Header("Expires: ".date("D, j M Y H:i:s",time()+(86400 *30))." UTC");
Header("Cache-Control: Public");
Header("Pragma: Public");

readfile('select.js');
?>
