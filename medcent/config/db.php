<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'oci:dbname=//localhost:1521/MEDCENT;charset=AL32UTF8',
    'username' => 'system',
    'password' => '$Am0129$',
    'on afterOpen' => function($event) {
        $event->sender->createCommand("ALTER SESSION SET NLS_DATE_FORMAT='DD.MM.YYYY hh24:mi'")->execute();
    }

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
