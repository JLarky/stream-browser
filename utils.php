<?php
function servers_get() {
 return unserialize(file_get_contents("serverlist.db"));
}
function servers_set($servers) {
 return file_put_contents("serverlist.db", serialize($servers));
}



function print_td($i, $key, $val, $editable) {
 $val=$val ? $val : "N/A";
 echo " <td class=\"$key\"><span ".($editable ? 'class="edit" ': '')."id=\"$key-$i\">$val</span></td>\n";
}

function filds_get() {
 return array('url' => is_admin(), 'owner' => is_admin(), 'retrans' => is_admin(), 'desc' => true);
}

function is_admin() {
 return $_SERVER["SERVER_ADDR"] == $_SERVER["REMOTE_ADDR"];
}