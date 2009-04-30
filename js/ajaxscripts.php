<?php
Header("Expires: ".date("D, j M Y H:i:s",time()+(86400 *30))." UTC");
Header("Cache-Control: Public");
Header("Pragma: Public");

readfile('ajax.js');
readfile('ajax-dynamic-list.js');
readfile('ajax-tooltip.js');
readfile('ajax-dynamic-content.js');
readfile('drop-menu.js');
?>