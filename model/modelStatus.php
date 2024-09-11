<?php

require_once("../services/connectionDB.php");

class modelStatus {

    //Listar todos os status
    public function getAll() {
        try {

            $conn = connectionDB::connect();
            $list = $conn->query("SELECT * FROM tblStatus");
            $result = $list->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch(PDOException $e) {
            return false;
        }
    }

    //Listar um status por ID
    public function getById($idStatus) {
        try {

            $conn = connectionDB::connect();
            $conn->prepare("SELECT * FROM tblStatus WHERE id_status = :id_status");
            $conn->bindParam(':id_status', filter_var($idStatus, FILTER_SANITIZE_NUMBER_INT));
            $conn->execute();
            $result = $conn->fetch(PDO::FETCH_ASSOC);

            return $result;

        } catch(PDOException $e) {
            return false;
        }
    }

    //Inserir um novo status
    public function save($data) {
        try {

            $status_name = htmlspecialchars($data["status"], ENT_QUOTES);

            $conn = connectionDB::connect();
            $save = $conn->prepare("INSERT INTO tblStatus (status, created_at) VALUES (:status, NOW())");
            $save->bindParam(":status",$status_name);
            $save->execute();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    //Atualizar um status por ID
    public function update($idStatus, $data) {
        try {

            $conn = connectionDB::connect();
            $conn->prepare("UPDATE tblStatus SET status = :status, updated_at = NOW()
                             WHERE id_status = :id_status ");
            $conn->bindParam(":status", htmlspecialchars($data->status, ENT_NOQUOTES));
            $conn->bindParam(":id_status", filter_var($idStatus, FILTER_SANITIZE_NUMBER_INT));
            $conn->execute();

            return true;

        } catch(PDOException $e) {
            return false;
        }
    }

    //Deletar um status por ID
    public function delete($idStatus) {
        try {

            $conn = connectionDB::connect();
            $conn->prepare("DELETE FROM tblStatus WHERE id_status = :id_status");
            $conn->bindParam(":id_status", filter_var($idStatus, FILTER_SANITIZE_NUMBER_INT));
            $conn->execute();

            return true;

        } catch(PDOException $e) {
            return false;
        }
    }
}