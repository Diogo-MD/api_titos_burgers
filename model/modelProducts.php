<?php

require_once("../services/connectionDB.php");

class modelProducts {

    //Criar um novo produto
    public function save($data) {
        try {

            $product_name = htmlspecialchars($data["product_name"], ENT_NOQUOTES);
            $image = htmlspecialchars($data["image"], ENT_NOQUOTES);
            $price = filter_var($data["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $description = htmlspecialchars($data["description"], ENT_NOQUOTES);
            $id_category = filter_var($data["id_category"], FILTER_SANITIZE_NUMBER_INT);
            $id_status = filter_var($data["id_status"], FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();
            $save = $conn->prepare("INSERT INTO tblProducts (product_name, image, price, description, id_category, id_status, created_at) VALUES (:product_name, :image, :price, :description, :id_category, :id_status, NOW() )");
            $save->bindParam(":product_name", $product_name);
            $save->bindParam(":image", $image);
            $save->bindParam(":price", $price);
            $save->bindParam(":description", $description);
            $save->bindParam(":id_category", $id_category);
            $save->bindParam(":id_status", $id_status);
            $save->execute();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    //Listar todos os produtos
    public function listAll(){
        try {

            $conn = connectionDB::connect();

            $list = $conn->query("SELECT * FROM tblProducts");
            $result = $list->fetchAll(PDO::FETCH_ASSOC);

            return $result;
            
        } catch (PDOException $e) {
            return false;
        }
    }

    //Listar produto por ID
    public function searchById($id) {
        try {
            
            $conn = connectionDB::connect();

            $search = $conn->prepare("SELECT * FROM tblProducts WHERE id_product = :id");
            $search->bindParam(":id", $id);
            $search->execute();
            $result = $search->fetch(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    //Listar produtos por categoria
    public function listByCategory($id) {
        try {
            
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();
            $listByCategory = $conn->prepare("SELECT * FROM tblProducts WHERE id_category = :id");
            $listByCategory->bindParam(":id", $id);
            $listByCategory->execute();
            $result = $listByCategory->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    //Atualizar produto por ID
    public function update($id, $data) {
        try {
            
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $product_name = htmlspecialchars($data["product_name"], ENT_NOQUOTES);
            $image = htmlspecialchars($data["image"], ENT_NOQUOTES);
            $price = filter_var($data["price"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $id_category = filter_var($data["id_category"], FILTER_SANITIZE_NUMBER_INT);
            $id_status = filter_var($data["id_status"], FILTER_SANITIZE_NUMBER_INT);
            $description = htmlspecialchars($data["description"], ENT_NOQUOTES);

            $conn = connectionDB::connect();

            $update = $conn->prepare("UPDATE tblProducts SET product_name = :product_name, 
                                        image = :image, price = :price,
                                        description = :description, 
                                        id_category = :id_category, id_status = :id_status, 
                                        updated_at = NOW() WHERE id_product = :id ");
            $update->bindParam(":product_name", $product_name);
            $update->bindParam(":image", $image);
            $update->bindParam(":price", $price);
            $update->bindParam(":description", $description);
            $update->bindParam(":id_category", $id_category);
            $update->bindParam(":id_status", $id_status);
            $update->bindParam(":id", $id);
            $update->execute();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }

    //Deletar um produto por ID
    public function delete($id) {
        try {
            
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();

            $delete = $conn->prepare("DELETE FROM tblProducts WHERE id_product = :id");
            $delete->bindParam(":id", $id);
            $delete->execute();

            return true;

        } catch (PDOException $e) {
            return false;
        }
    }
}