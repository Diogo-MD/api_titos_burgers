<?php

include_once("../services/connectionDB.php");

class modelOrders
{
    public function listOrderByClient($id_user)
    {
        try {
            $conn = connectionDB::connect();
            $list = $conn->query("SELECT * FROM tblOrders WHERE id_user = :id_user");
            $list->bindParam(":id_user", $id_user);
            $list->execute();

            $result = $list->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listAllOrders()
    {
        try {
            $conn = connectionDB::connect();

            $listAll = $conn->query("SELECT * FROM tblOrders");
            $result = $listAll->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function listorderbyStatus($id_status)
    {
        try {
            $conn = connectionDB::connect();

            $list = $conn->prepare("SELECT * FROM tblOrders WHERE id_status = :id_status");
            $list->bindParam(":id_status", $id_status);
            $list->execute();

            $result = $list->fetchAll((PDO::FETCH_ASSOC));

            return $result;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function insertItenCart($data)
    {
        try {
            $id_cart = filter_var($data["id_cart"], FILTER_SANITIZE_NUMBER_INT);
            $id_product = filter_var($data["id_prouct"], FILTER_SANITIZE_NUMBER_INT);
            $price_product = filter_var($data["price"], FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $qtd = filter_var($data["qtd"], FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();

            $insert = $conn->prepare("INSERT INTO tblItensCart (id_cart, id_product, price_product, qtd, created_at) VALUES (:id_cart, :id_product, :price_product, :qtd");
            $insert->bindParam(":id_cart", $id_cart);
            $insert->bindParam(":id_product", $id_product);
            $insert->bindParam(":price_product", $price_product);
            $insert->bindParam(":qtd", $qtd);
            $insert->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function createCart($data)
    {
        try {
            $id_user = filter_var($data["id_user"], FILTER_SANITIZE_NUMBER_INT);

            //Expirar o carrinho em 24h
            $fuso = new DateTimeZone('America/Sao_Paulo');
            $dataHoraAtual = new DateTime();
            $dataHoraAtual->setTimezone($fuso);

            //Adiciona 24h
            $dataHoraAtual->modify('+1 days');
            $expired_at = $dataHoraAtual->format('Y-m-d H:i:s');

            $conn = connectionDB::connect();
            $create = $conn->prepare("INSERT INTO tblCart (id_user, expired_at, created_at) VALUES (:id_user, :expired_at, : NOW()");
            $create->bindParam(":id_user", $id_user);
            $create->bindParam(":expired_at", $expired_at);
            $create->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteCart($id_cart)
    {
        try {
            $id_cart = filter_var($id_cart, FILTER_SANITIZE_NUMBER_INT);

            $conn = connectionDB::connect();
            $delete = $conn->prepare("DELETE FROM tblItensCart WHERE id_cart = :id_cart");
            $delete->bindParam(":id_cart", $id_cart);
            $delete->execute();

            if ($delete) {
                $deleteCart = $conn->prepare("DELETE FROM tblCart id_cart = :id_cart");
                $deleteCart->bindParam(":id_cart", $id_cart);
                $deleteCart->execute();

                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    
}
