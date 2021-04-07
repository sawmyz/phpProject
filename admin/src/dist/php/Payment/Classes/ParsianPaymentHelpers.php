<?php
namespace payment\helpers;
class ParsianPaymentHelpers {
    protected $errorStates = array(
        'Canceled By User'     => 'تراکنش بوسیله خریدار کنسل شده',
        'Invalid Amount'       => 'مبلغ سند برگشتی  از مبلغ تراکنش اصلی بیشتر است',
        'Invalid Transaction'  => 'درخواست برگشت تراکنش رسیده است در حالی که تراکنش اصلی پیدا نمی شود',
        'Invalid Card Number'  => 'شماره کارت اشتباه است',
        'No Such Issuer'       => 'چنین صادر کننده کارتی وجود ندارد',
        'Expired Card Pick Up' => 'از تاریخ انقضای کارت گذشته است',
        'Incorrect PIN'        => 'رمز کارت اشتباه است pin',
        'No Sufficient Funds'  => 'موجودی به اندازه کافی در حساب شما نیست',
        'Issuer Down Slm'      => 'سیستم کارت بنک صادر کننده فعال نیست',
        'TME Error'            => 'خطا در شبکه بانکی',
        'Exceeds Withdrawal Amount Limit'      => 'مبلغ بیش از سقف برداشت است',
        'Transaction Cannot Be Completed'      => 'امکان سند خوردن وجود ندارد',
        'Allowable PIN Tries Exceeded Pick Up' => 'رمز کارت 3 مرتبه اشتباه وارد شده کارت شما غیر فعال اخواهد شد',
        'Response Received Too Late'           => 'تراکنش در شبکه بانکی تایم اوت خورده',
        'Suspected Fraud Pick Up'              => 'اشتباه وارد شده cvv2 ویا ExpDate فیلدهای'
    );
    protected $pages = array(
        '-138'     => 'UserCancelled',
        '0'     =>  'PaymentDone'
    );
    protected $types = [
        'credit_pay' => 'افزایش اعتبار',
        'online_order' => 'سفارش آنلاین'
    ];
    public function getState($state){
        foreach ($this->errorStates as $errorState => $error){
            if ($errorState == $state){
                return $error;
            } elseif (str_replace(' ','',$errorState) == $state){
                return  $error;
            }
        }
        return 'undefined';
    }
    public function getPage($state){
        foreach ($this->pages as $index => $page){
            if ($index == $state){
                return $page;
            } elseif (str_replace(' ','',$index) == $state){
                return  $page;
            }
        }
        return '404';
    }

    public function getType($payment_type) {
        return $this->types[$payment_type];
    }
}
