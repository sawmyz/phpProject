<?php

namespace fwCli\UserCommands;

use fwCli\Write\UserCommands;
use UserCommand;

class TestCommand extends UserCommands implements UserCommand {
    public function proccess(array $args = array()) {
        return$this->output('test command');
    }
}
