<?php

//php class cart
class Cart
{
    public $db = null; //access database

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null; //check connection
        $this->db = $db;
    }

    //insert into cart
    public function insertIntoCart($params = null, $table = "cart")
    {
        if ($this->db->con != null) {
            if ($params != null) {
                //insert into cart(user_id)values(0)
                //get table columns
                $columns = implode(',', array_keys($params));

                $values = implode(',', array_values($params));


                //create sql query
                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);

                //execute query
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    //to get user and item ID and insert into cart table
    public function addToCart($userid, $itemid)
    {
        if (isset($userid) && isset($itemid)) {
            $params = array(
                "user_id" => $userid,
                "item_id" => $itemid
            );

            //insert data into cart
            $result = $this->insertIntoCart($params);
            if ($result) {

                //reload page
                header("Location". $_SERVER['PHP_SELF']);
            }
        }
    }
}
