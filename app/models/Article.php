<?php
/*
article Model
*/
class Article extends Illuminate\Database\Eloquent\Model
{
  public $timestamps = false;

/*
  public static function first()
  {
    $connection = mysql_connect("127.0.0.1","root","mysql");
    if (!$connection) {
      die('Could not connect: ' . mysql_error());
    }

    mysql_set_charset("UTF8", $connection);

    mysql_select_db("test", $connection);

    $result = mysql_query("SELECT * FROM articles limit 0,1");

    if ($row = mysql_fetch_array($result)) {
      return $row;
    }

    mysql_close($connection);
  }
*/
}
