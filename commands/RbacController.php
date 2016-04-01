<?php

namespace app\commands;

use yii\console\Controller;

/**
 * Role Based Access Control
 */
class RbacController extends Controller
{
    /**
     * Первичная инициализация ролей доступа
     *
     * Один permission: crudNotice
     * Одна роль: admin
     *
     * Используется захардкоженный id пользователя admin из basic шаблона
     */
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;

        $crudNotice = $auth->createPermission('crudNotice');
        $crudNotice->description = 'CREATE REMOVE UPDATE and DELETE permission for notice';
        $auth->add($crudNotice);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $crudNotice);

        $auth->assign($admin, 100);
    }
}
