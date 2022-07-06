<?php
require_once dirname(dirname(__FILE__)) . '/components/Database.php';

class Model {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }
    public function get_players() {
        $query = "SELECT id, `name` FROM player";
        $result = $this->db->prepare($query);
        $result->execute();

        return $result->fetchAll();
    }
    public function get_leagues() {
        $query = "SELECT DISTINCT league FROM team";
        $result = $this->db->prepare($query);
        $result->execute();

        return $result->fetchAll();
    }
    public function get_game_by_player($id) {
        $query = "SELECT date, place, score, id_team_first, id_team_sec FROM game JOIN player AS p ON id_team WHERE p.id = :id AND (id_team_sec = p.id_team OR id_team_first = p.id_team)";
        $result = $this->db->prepare($query);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_command_by_id($id) {
        $query = "SELECT name FROM team WHERE id = :id";
        $result = $this->db->prepare($query);
        $result->bindParam('id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch()['name'];
    }
    public function get_game_by_date($from, $to) {
        $query = "SELECT `date`, `place`, `score`, `id_team_first`, `id_team_sec` FROM `game` WHERE date BETWEEN :from AND :to";
        $result = $this->db->prepare($query);
        $result->bindParam('from', $from);
        $result->bindParam('to', $to);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_team_by_league($lg) {
        $query = "SELECT `name`, `league`, `coach` FROM `team` WHERE league = :lg";
        $result = $this->db->prepare($query);
        $result->bindParam('lg', $lg);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}