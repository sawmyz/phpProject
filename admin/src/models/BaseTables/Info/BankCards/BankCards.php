<?php
namespace model;
use DATABASE\Model;
class BankCards  extends Model {
    public $_table = 'tblBankCards';
    public $_key = 'bank_card_id';
    public $_Entity =  \model\Entity\BankCardsEntity::class;
}