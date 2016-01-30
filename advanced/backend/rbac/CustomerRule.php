<?php

namespace rbac;

use Yii;
use yii\rbac\Rule;
 
class CustomerRule extends Rule {
    
    public $name = 'isCustomer';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated width
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params) {
        return isset($params['customer_id']) ? $params['customer_id']->createdBy == $user : false;
    }
}


