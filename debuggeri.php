<?php
function debuggeri_shutdown() {
    $error = error_get_last();
    if ($error !== null && $error['type'] === E_ERROR) {
        debuggeri($error);
    }
}
    
function debuggeri($arvo) {
    if (defined('DEBUG') and !DEBUG) return;
    $msg = is_array($arvo) ? var_export($arvo, true) : $arvo;
    $msg = date('Y-m-d H:i:s') . ' ' . $msg . "\n";
    file_put_contents("debug.log.txt", $msg."\n", FILE_APPEND);

    }
function debuggeri_filter($n){
    $args = implode(",", $n['args']);
    $m = basename($n['file']) . ",rivi".$n['line'].": ".$n['function']."($args)\n";
    return $m;
    }

function debuggeri_backtrace() {
    if (defined('DEBUG') and !DEBUG) return;
    $msg = date('Y-m-d H:i:s') . "\n";
    $msg .= implode("", array_map("debuggeri_filter", debug_backtrace()));
    file_put_contents("debug.log.txt", $msg."\n", FILE_APPEND);
    }

?>
