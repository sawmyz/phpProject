<?php

namespace site\helpers;

use fwJson\Json;
use nusoap_client;
use payment\BasePayment;
use PaymentHelpers;
use SoapClient;

class ParsianPayment extends BasePayment {
    const LoginAccount = 'yh3hkMi1Mq8I6Hv40CoJ';
    const Action_url = 'https://pec.shaparak.ir/NewIPG/?Token=';
    const CallBack_url = 'https://new.neganoon.ir/app/Callback';
    const Confirm_url = 'https://pec.shaparak.ir/NewIPGServices/Confirm/ConfirmService.asmx?WSDL';

    public function Confirm($Token) {
        $client = new SoapClient($this::Confirm_url);

        return $client->__soapCall('ConfirmPayment',[
                array(
                    'requestData' => [
                        'LoginAccount' => $this::LoginAccount,
                        'Token' => $Token
                    ]
                )]
        );
    }

    public static function CallBack() {
        return '/app/Callback';
    }


    public function goToPayment() {
        $this->CreateResNum();
        $user_data = $this->UserModel->get($this->UserData->{$this->UserModel->_key});
        $this->PaymentModel->save($user_data->{$this->UserModel->_key}, $this->_amount, $this->ResNum, $this->OrderData, $this->type);
        $client = new \SoapClient('https://pec.shaparak.ir/NewIPGServices/Sale/SaleService.asmx?wsdl');
        $client->soap_defencoding = 'UTF-8';

        $result = $client->__soapCall('SalePaymentRequest', [array("requestData" => array('LoginAccount' => self::LoginAccount, 'Amount' => $this->_amount, 'OrderId' => $this->ResNum, 'CallBackUrl' => self::CallBack_url, 'AdditionalData' => ''),)]);
        if (isset($result->SalePaymentRequestResult) && $result->SalePaymentRequestResult != "") {
            $result = $result->SalePaymentRequestResult;

            if (isset($result->Status) && $result->Status == 0 && isset($result->Token) && $result->Token != "") {
                return self::Action_url . $result->Token;
            } else {
                return "{$result->Message}";
            }
        } else {
            return "پاسخی از بانک دریافت نشد";
        }
    }


    public function update($resnum, $refnum) {
        $resField = $this->PaymentModel->ResNumField();
        $refField = $this->PaymentModel->RefNumField();
        //payment_type
            //didPay
        //payment_state
        return $this->PaymentModel::Db()->where($resField,$resnum)->update([
        	$refField => $refnum,
			'payment_status' => 1,
		]);
    }

}
