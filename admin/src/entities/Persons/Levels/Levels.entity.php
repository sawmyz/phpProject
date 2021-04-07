<?php

namespace model\Entity;

use DATABASE\ORM\Interact\Entities\EntityScheme;

class LevelsEntity extends EntityScheme
{
    public $level_id;
    public $title;
    public $discount_percent;
    public $credit_return_percent;
    public $min_score_join;
    public $unit_score_to_credit;
    public $unit_credit;
    public $card_issuance;
    public $description;
    public $register_site;
    public $login_once_day;
    public $basic_profile_information;
    public $additional_information;
    public $score_buy;
    public $score_buy_amount;
    public $introduce_new_user;
    public $record_comment;
    public $record_score;
    public $score_wallet;
    public $min_score;
    public $min_credit;

    public function model()
    {
        return new \model\Levels();
    }


    protected function dictionary(): array
    {
        return [
            'level_id' => 'level_id',
            'title' => 'level_title',
            'discount_percent' => 'level_discount_percent',
            'credit_return_percent' => 'level_credit_return_percent',
            'min_score_join' => 'level_min_score_join',
            'unit_score_to_credit' => 'level_unit_score_to_credit',
            'unit_credit' => 'level_unit_credit',
            'card_issuance' => 'level_card_issuance',
            'description' => 'level_description',
            'register_site' => 'level_register_site',
            'login_once_day' => 'level_login_once_day',
            'basic_profile_information' => 'level_basic_profile_information',
            'additional_information' => 'level_additional_information',
            'score_buy' => 'level_score_buy',
            'score_buy_amount' => 'level_score_buy_amount',
            'introduce_new_user' => 'level_introduce_new_user',
            'record_comment' => 'level_record_comment',
            'record_score' => 'level_record_score',
            'score_wallet' => 'level_score_wallet',
            'min_score' => 'level_min_score',
            'min_credit' => 'level_min_credit',
        ];
    }
}
