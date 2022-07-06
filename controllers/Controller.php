<?php

require_once dirname(dirname(__FILE__)) . '/models/model.php';
$model = new Model();
$_POST = json_decode(file_get_contents('php://input'), true);
$res = '';

switch ($_POST['event']) {
    case 'player':
        foreach ($model->get_game_by_player($_POST['id']) as $value) {
            $res .= "<li>Дата: " . date( 'd.m.Y H:i', strtotime($value['date'])) . "; Стадион: " . $value['place'] . "; Счёт: " . $value['score'] . "; Команда первая: " . $model->get_command_by_id($value['id_team_first']) . "; Команда вторая: " . $model->get_command_by_id($value['id_team_sec']) . "</li>";
        }
        echo json_encode($res);
        break;
    case 'time':
        foreach ($model->get_game_by_date($_POST['from'], $_POST['to']) as $value) {
            $res .= "<li>Дата: " . date( 'd.m.Y H:i', strtotime($value['date'])) . "; Стадион: " . $value['place'] . "; Счёт: " . $value['score'] . "; Команда первая: " . $model->get_command_by_id($value['id_team_first']) . "; Команда вторая: " . $model->get_command_by_id($value['id_team_sec']) . "</li>";
        }
        $res = '<?xml version="1.0" encoding="UTF-8" ?>
        <document>' .
            $res
            . '</document>';
        echo $res;
        break;
    case 'league':
        foreach ($model->get_team_by_league($_POST['lg']) as $value) {
            $res .= "<li>Команда: " . $value['name'] . "; Лига: " . $value['league'] . "; Тренер: " . $value['coach'] . "</li>";
        }
        echo $res;
        break;
}