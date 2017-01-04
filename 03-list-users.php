<?php
class MyUserClass
{
    public function getUserList()
    {
        $dbconn = new DatabaseConnection('localhost','user','password');
        $results = $dbconn->query('SELECT name FROM user ORDER BY name ASC');
        return $results;
    }
}