<?php header('Content-Type: text/html; charset=utf-8');

require_once('database.php');

class Orders
{

    public static function fetch_all_orders()
    {
        global $database;
        $result_set = $database->query("select * from clients left join users on clients.user_id=users.user_id");
        $orders = $result_set->fetch_all(MYSQLI_ASSOC);

        return $orders;
    }

    public static function fetch_my_orders($userID)
    {
        global $database;
        $result_set = $database->query("select * from clients where user_id=$userID");
        $orders = $result_set->fetch_all(MYSQLI_ASSOC);

        return $orders;
    }

    public static function delete_order($order_id)
    {
        global $database;
        $sql = "delete from clients where order_id=$order_id";
        $result = $database->query($sql);
        return $result;
    }
}
