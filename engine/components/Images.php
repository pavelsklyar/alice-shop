<?php

class Images
{
    private $connection;

    public function __construct()
    {
        $this->connection = get_connection();
    }

    function getById($id) {
        return mysqli_query($this->connection, "SELECT * FROM `images` WHERE `catalogue_id` LIKE $id");
    }
}