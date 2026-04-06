<?php

class database {

    function opencon(): PDO {
        return new PDO(
            'mysql:host=localhost;dbname=detorres_db',
            'root',
            ''
        );
    }

    function insertUser($Username, $User_password_hash, $isActive) {
        $con = $this->opencon();

        try {
            $con->beginTransaction();
            $stmt = $con->prepare(
                'INSERT INTO users (Username, User_password_hash, isActive) VALUES (?, ?, ?)'
            );
            $stmt->execute([$Username, $User_password_hash, $isActive]);
            $User_id = $con->lastInsertId();
            $con->commit();
            return $User_id;

        } catch (PDOException $e) {
            if ($con->inTransaction()) {
                $con->rollback();
            }
            throw $e;
        }
    }

    function insertBorrowers($Borrower_firstname, $Borrower_lastname, $Borrower_email, $Borrower_phone, $isActive) {
        $con = $this->opencon();

        try {
            $con->beginTransaction();
            $stmt = $con->prepare(
                'INSERT INTO borrowers (Borrower_firstname, Borrower_lastname, Borrower_email, Borrower_phone, isActive) VALUES (?, ?, ?, ?, ?)'
            );
            $stmt->execute([$Borrower_firstname, $Borrower_lastname, $Borrower_email, $Borrower_phone, $isActive]);
            $Borrower_ID = $con->lastInsertId();
            $con->commit();
            return $Borrower_ID;

        } catch (PDOException $e) {
            if ($con->inTransaction()) {
                $con->rollback();
            }
            throw $e;
        }
    }
    

    function insertBorrowerUser($Borrowers_Id, $User_ID){
        $con = $this->opencon();

        try {
            $con->beginTransaction();
            $stmt = $con->prepare(
                'INSERT INTO borrower_user (Borrowers_Id, User_ID) VALUES (?, ?)'
            );
            $stmt->execute([$Borrowers_Id, $User_ID]);
            $ID = $con->lastInsertId();
            $con->commit();
            return $ID;

        } catch (PDOException $e) {
            if ($con->inTransaction()) {
                $con->rollback();
            }
            throw $e;
        }
    }
}

?>