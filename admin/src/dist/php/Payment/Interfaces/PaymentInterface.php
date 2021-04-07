<?php
if (!interface_exists('PaymentInterface')) {
    interface PaymentInterface {
        public function save(int $customer_id, int $total_amount,string $resNum, \fwJson\Json $orderData, string $type) : bool;
        public function ResNumField() : string;
        public function RefNumField() : string;
    }
}
