<?php

class MysqlClass
{
    public function connectionMysql()
    {
        $user = "root";
        $pass = "";
        $db = new PDO('mysql:host=localhost; dbname=test', $user, $pass);
        return $db;
    }

    private function createTable(){
        $this->connectionMysql() -> query("CREATE TABLE IF NOT EXISTS messages (name text, email text, message text)");
        return;
    }
    private function prepareMysql($data)
    {
        $stmt = $this->connectionMysql() -> prepare ($data);
        return $stmt;
    }

    public function insertIntoTable($name,$email,$message)
    {
        $this->createTable();
        $stmt = $this->prepareMysql("INSERT INTO messages ( name, email, message) VALUES (?, ?, ?)");
        $stmt -> bindParam(1 , $name, PDO::PARAM_STR);
        $stmt -> bindParam(2, $email, PDO::PARAM_STR);
        $stmt -> bindParam(3, $message, PDO::PARAM_STR);
        $stmt -> execute();
    }

    public function resultTable()
    {
        $stmt = $this->prepareMysql("SELECT * FROM messages");
        $stmt -> execute();
        $result = $stmt->fetchAll();
        for ($i=0; $i<count($result); $i++)
        {
            $this->htmlResult($result["$i"]["name"],$result["$i"]["email"],$result["$i"]["message"]);
        }
    }

    private function htmlResult($name,$email,$message)
    {
        echo "
            <div class='col-lg-4 col-md-6 text-center message-content'>
                <div class='message-card'>
                    <div class='message-name'>$name</div>
                    <div class='message-email'>$email</div>
                    <div class='message-message'>$message</div>
                </div>
            </div>
            ";
        return;
    }
}