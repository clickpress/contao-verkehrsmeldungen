<?php

use Contao\ArrayUtil;

ArrayUtil::arrayInsert($GLOBALS['BE_MOD'], 1, [
    'revg' => [
        'verkehrsmeldungen' => [
            'tables' => ['tl_verkehrsmeldungen_category','tl_verkehrsmeldungen_detail'],
        ]
    ]
]);
