<?php

require_once("../services/connectionDB.php");

class modelProducts
{
    public function save($data)
    {
        try {

            $name = htmlspecialchars($data["product_name"], ENT_NOQUOTES);
            $image = htmlspecialchars($data["image"], ENT_NOQUOTES);
            $price = filter_var($data["price"], FILTER_SANITIZE_NUMBER_FLOAT);
            $description = htmlspecialchars($data["description"], ENT_NOQUOTES);
            $id_category = filter_var($data['id_category'], FILTER_SANITIZE_NUMBER_INT);
            $id_status = filter_var($data["id_status"], FILTER_SANITIZE_NUMBER_INT);

            $sql = "INSERT INTO tbl_product (product_name, image, price, description, id_category, id_status, creted_at) VALUES
            (':product_name, :image, :price, :description, :id_category, :id_status', now())";
            $conn = ConnectionDB::connect();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':product_name', $name);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id_category', $id_category);
            $stmt->bindParam(':id_status', $id_status);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listAll() {
        try {

            $conn = connectionDB::connect();
            $list = $conn->query("SELECT * FROM tbl_product");
            $result = $list->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function searchById($id) {
        try {

            $conn = connectionDB::connect();
            $product = $conn->prepare("SELECT * FROM tbl_product WHERE id = :id");
            $product->bindParam(':id', $id);
            $product->execute();

            $result = $product->fetch(PDO::FETCH_ASSOC);

            return $result;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function listByCategory($id_category) {
        try {

            $conn = connectionDB::connect();
            $product = $conn->prepare("SELECT * FROM tbl_product WHERE id_category = :id_category");
            $product->bindParam(':id_category', $id_category);
            $product->execute();

            $result = $product->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            $product_name = htmlspecialchars($data["product_name"], ENT_NOQUOTES);
            $image = htmlspecialchars($data["image"], ENT_NOQUOTES);
            $price = filter_var($data["price"], FILTER_SANITIZE_NUMBER_FLOAT);
            $id_category = filter_var($data["id_category"], FILTER_SANITIZE_NUMBER_INT);
            $id_status = filter_var($data["id_status"], FILTER_SANITIZE_NUMBER_INT);
            $description = htmlspecialchars($data["description"], ENT_NOQUOTES);

            $conn = connectionDB::connect();

            $update = $conn->prepare("UPDATE tblProducts SET 
            product_name = :product_name, 
            image = :image, 
            price = :price, 
            description = :description,
            id_category = :id_category,
            id_status = :id_status, updated_at = NOW() WHERE id_product = :id");

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



    // Deletar um produto por  ID
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
