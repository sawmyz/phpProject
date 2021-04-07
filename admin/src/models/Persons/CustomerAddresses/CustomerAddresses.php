<?php
namespace model;
use DATABASE\Model;
class CustomerAddresses  extends Model {
    public $_table = 'tblCustomerAddresses';
    public $_key = 'customer_address_id';
    public $_Entity =  \model\Entity\CustomerAddressesEntity::class;
}