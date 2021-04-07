<?php
if (!interface_exists('PayingUserInterface')) {
    interface PayingUserInterface {
        public function UserMobile(int $user_id) : string;
    }
}
