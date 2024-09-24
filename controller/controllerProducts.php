<?php

class controllerProducts {

    //Criar novo produto
    public function save($data) {
        try {

            $modelProducts = new modelProducts();
            return $modelProducts->save($data);

        } catch(PDOException $e) {
            return false;
        }
    }

    //Litar todos os produtos
    public function listAll(){
        try {

            $modelProducts = new modelProducts();
            return $modelProducts->listAll();

        } catch(PDOException $e) {
            return false;
        }
    }

    //Listar um produto por ID
    public function searchById($id) {
        try {

            $modelProducts = new modelProducts();
            return $modelProducts->searchById($id);

        } catch (PDOException $e) {
            return false;
        }
    }

    //Listar os produtos de uma categoria
    public function listByCategory($id) {
        try {

            $modelProducts = new modelProducts();
            return $modelProducts->listByCategory($id);

        } catch (PDOException $e) {
            return false;
        }
    }

    //Atualizar um produto por ID
    public function update($id, $data) {
        try {

            $modelProducts = new modelProducts();
            return $modelProducts->update($id, $data);

        } catch (PDOException $e) {
            return false;
        }
    }

    //Deletar um produto por ID
    public function delete($id) {
        try {

            $modelProducts = new modelProducts();
            return $modelProducts->delete($id);

        } catch (PDOException $e) {
            return false;
        }
    }
}