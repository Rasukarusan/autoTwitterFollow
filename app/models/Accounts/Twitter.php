<?php 
require_once dirname(__FILE__) . '/Base.php';

class Models_Account_Twitter extends Models_Account_Base {

    function __construct() {
        $account = $this->getAccount('Twitter');
        parent::__construct($account['user_id'], $account['password']);
    }
}

