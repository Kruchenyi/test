<?php

require dirname(__DIR__) . '/config/config.php';
require_once CONFIG . '/funcs.php';
require CORE . '/classes/Db.php';
require CORE . '/classes/Validator.php';

$db = (Db::getInstance())->getConnection();

$fillable = ['code', 'number'];
$data = load($fillable);
$rules = [
    'code' => [
        'required' => true,
        'min' => 1,
        'max' => 4,
        'num' => true
    ],
    'number' => [
        'required' => true,
        'min' => 7,
        'max' => 8,
        'num' => true
    ],

];
$validator = new Validator($data, $rules);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!$validator->hasError()) {
        $country = $db->query("SELECT * FROM countries WHERE num = ?", [$data['code']])->find();
        if (!$country) {
            require_once VIEWS . '/errors/404.tpl.php';
            die;
        }
    }
}
require_once VIEWS . '/index.tpl.php';
