<?php
namespace payment;
use DATABASE\Model;
use fwJson\Json;
use PayingUserInterface;
use PaymentHelpers;
use PaymentInterface;
use stdClass;

abstract class BasePayment {

    /**
     * @var Json
     */
    protected $OrderData;
    public function OrderData(Json $json){
        $this->OrderData = $json;
    }
    public function __construct($PaymentHelper = null) {
        $this->Address = new Json([]);
        $this->OrderData = new Json([]);
        if (is_object($PaymentHelper)) $this->Helpers = $PaymentHelper;
    }

    protected $_amount = 0;
    protected $_user_id = 0;
    protected $isToman = true;
    /**
     * @var Model|PaymentInterface
     */
    public $PaymentModel = null;
    /**
     * @var Model|PayingUserInterface
     */
    public $UserModel = null;
    /**
     * @var stdClass
     */
    protected $UserData = null;
    /**
     * @var string
     */
    protected $ResNum = 0;
    protected $Address = null;

    public $Helpers;
    /**
     * @var string
     */
    protected $type = 'pay_for_cart';
    public function initPayment(PaymentInterface $paymentModel) {
        $this->PaymentModel = $paymentModel;
        return $this;
    }

    public function UserModel(PayingUserInterface $param, $user_data) {
        $this->UserModel = $param;
        $this->UserData = $user_data;
        return $this;
    }

    protected function CreateResNum() {
        $field = $this->PaymentModel->ResNumField();
        $res_num = UniqueOfClass($this->PaymentModel, $field,false,12,true);
        $this->ResNum = $res_num;
        return $this->ResNum;
    }
    public function Amount($full_price) {
        if ($this->isToman) $full_price = $full_price * 10;
        $this->_amount = $full_price;
    }

    public function Address($get) {
        $this->Address = $get;
        return $this;
    }

    public function Type(string $string) {
        $this->type = $string;
    }
}
