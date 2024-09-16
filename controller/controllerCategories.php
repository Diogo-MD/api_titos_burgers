<?php

class controllerCategories {

    //Criação de uma nova categoria
    public function save($data) {
        try {
            $modelCategories = new modelCategories();
            return $modelCategories->save($data);

        } catch (PDOException $_ENV) {
            return false;
        }
    }

    public function listAll() {
        try {
            $controllerCategories = new controllerCategories();
            return $controllerCategories>listAll();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function searchById($id) {
        try {
            $controllerCategories = new controllerCategories();
            return $controllerCategories->searchById($id);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function update($id, $data) {
        try {
            $controllerCategories = new controllerCategories();
            return $controllerCategories->update($id, $data);
        } catch (PDOException $e) {
            return false;
        }       
    }

    public function delete($id) {
        try {
            $controllerCategories = new controllerCategories();
            return $controllerCategories->delete($id);
        } catch (PDOException $e) {
            return false;
        }
    }
}