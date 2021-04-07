<?php


namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class ProvidersEntity extends EntityScheme
{
    public $provider_id;
    public $name;
    public $image;
    public $manager;
    public $tel;
    public $caste_id;
    public $number;
    public $start_date;
    public $end_date;
    public $contracttype_id;
    public $discount;
    public $credit_discount;
    public $month_settlement;
    public $each_buy;
    public $score_per_buy;
    public $social_media_id;
    public $status;
    public $provider_status_desc;
    public $visitor_id;

    public function model()
    {
        return new \model\Providers();
    }


    protected function dictionary(): array
    {
        return [
            'provider_id' => 'provider_id',
            'name' => 'provider_name',
            'image' => 'provider_image',
            'manager' => 'provider_manager',
            'tel' => 'provider_tel',
            'number' => 'provider_number',
            'start_date' => 'provider_start_date',
            'end_date' => 'provider_end_date',
            'contracttype_id' => 'contracttype_id',
            'discount' => 'provider_discount',
            'credit_discount' => 'provider_credit_discount',
            'month_settlement' => 'provider_month_settlement',
            'each_buy' => 'provider_each_buy',
            'score_per_buy' => 'provider_score_per_buy',
            'caste_id' => 'caste_id',
            'social_media_id' => 'social_media_id',
            'status' => 'provider_status',
            'provider_status_desc' => 'provider_status_desc',
            'visitor_id' => 'visitor_id',
        ];
    }
}

