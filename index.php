<?
require_once dirname(__FILE__) . '/models/model.php';
$model = new Model();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Football</title>
</head>
<body>
<form id="form-league">
    <label for="league">Лига:</label>
    <select name="league" id="league">
        <option value="" selected disabled>Не выбрано</option>
        <? foreach ($model->get_leagues() as $league) { ?>
            <option value="<?= $league['league'] ?>"><?= $league['league'] ?></option>
        <? } ?>
    </select>
    <ul id="list"></ul>
</form>
<form id="form-time">
    <label for="from">Список игр: с</label>
    <input type="datetime-local" name="from" id="from">
    <label for="to">по</label>
    <input type="datetime-local" name="to" id="to">
    <button name="send">Показать</button>
    <ul id="list"></ul>
</form>
<form id="form-player">
    <label for="player">Футболист:</label>
    <select name="player" id="player">
        <option value="" selected disabled>Не выбрано</option>
        <? foreach ($model->get_players() as $player) { ?>
            <option value="<?= $player['id'] ?>"><?= $player['name'] ?></option>
        <? } ?>
    </select>
    <ul id="list"></ul>
</form>

<script src="script.js"></script>
</body>
</html>