<?php
namespace fwCli\Write;
abstract class UserCommands {
    protected function output($data = 'An error occurred', $color = 'red') {
        $command = $_POST['command'];
        $dir = ((isset($_SESSION['fw']['cli']['dir']) and $_SESSION['fw']['cli']['dir'] != '') ? $_SESSION['fw']['cli']['dir'] : '~/');
        $addr = endsWith($dir, '/') ? $dir : $dir . '/';
        $arr = explode('/', $addr);
        unset($arr[sizeof($arr) - 1]);
        $end = end($arr);
        return json_encode(array("dir" => $end, "data" => "<span class='last_command'>$command</span><br><div style='color: $color'>$data</div><br>"));
    }
    abstract public function proccess(array $args = array());
}
