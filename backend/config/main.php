<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name'=>'GC',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
         'dynagrid'=> [
        'class'=>'\kartik\dynagrid\Module',
        // other module settings
        ],
        'gridview'=> [
            'class'=>'\kartik\grid\Module',
            // other module settings
        ],
    ],
    'components' => [
         
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            
            // 'on afterLogin'=>function($event){
            //     $role = \Yii::$app->authManager->getRolesByUser(\Yii::$app->user->identity->id);
            //     foreach ($role as $key => $value) {
            //             $role = $key;
                  
            //             break;
            //     }
            //     $session = new \yii\web\Session;
            //     $session->open();
            //     $session->set('role',$role);
            //     $session->close();
            // }
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
            'class' => 'yii\web\Session',
            'timeout' => 60*60, // 3600 ms
            'cookieParams' => ['lifetime' => 60 * 60]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        
        // 'authManager'=>[
        //     'class'=>'yii\rbac\DbManager',
        //     'defaultRoles'=>['gest'],
        // ],


        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
