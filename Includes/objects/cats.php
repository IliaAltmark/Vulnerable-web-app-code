<?php header('Content-Type: text/html; charset=utf-8');

require_once('database.php');

class Cats
{
    public static function check_breed($breed)
    {
        global $database;
        $Breed = strtolower($breed);
        $result_set = $database->query("select * from cats where breed='$Breed'");
        $found_breed = $result_set->fetch_assoc();

        if ($found_breed) {
          return true;
        }
        else {
          return false;
        }
    }
}
