<?php



function error_log_array(array $arr)
{
    error_log(json_encode($arr));
}

function error_log_die($message)
{
    if (is_string($message)) {
        error_log($message);
    } else {
        error_log(json_encode($message));
    }
    die;

}

function dd($item = '')
{
    if (php_sapi_name() != 'cli') {
        echo '<pre style="font-size: 9px">';
    }
    $d = debug_backtrace();
    echo "\n" . $d[0]['file'] . ' line ' . $d[0]['line'] . "\n";
    var_dump($item);
    die;
}

function dump($item = '')
{
    if (php_sapi_name() != 'cli') {
        echo '<pre style="font-size: 9px">';
    }
    $d = debug_backtrace();
    echo "\n" . $d[0]['file'] . ' line ' . $d[0]['line'] . "\n";
    var_dump($item);
    if (php_sapi_name() != 'cli') {
        echo '</pre>';
    }
}