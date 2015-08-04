<?php

$app->get('/', 'GameController@index');
$app->get('finish', 'GameController@finish');
$app->get('game', 'GameController@game');
$app->get('records', 'GameController@records');

$app->post('start','GameController@start');
$app->post('ajax-call', 'GameController@ajaxCall');
$app->post('records', 'GameController@ajaxRecords');