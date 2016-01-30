<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

//        // добавляем разрешение "createPost"
//        $createPost = $auth->createPermission('createPost');
//        $createPost->description = 'Create a post';
//        $auth->add($createPost);

        // добавляем разрешение "updatePost"
        $updateObjreservation = $auth->createPermission('updateObjreservation');
        $updateObjreservation->description = 'Update Objreservation';
        $auth->add($updateObjreservation);

        // добавляем роль "author" и даём роли разрешение "createPost"
        $customer = $auth->createRole('customer');
        $auth->add($customer);
        $auth->addChild($customer, $updateObjreservation);


        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($customer, 2);
    }
}