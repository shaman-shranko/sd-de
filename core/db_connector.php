<?php

class DB_Connector
{

  private $host;
  private $db;
  private $port;
  private $user_name;
  private $user_pass;
  private $connector;

  function __construct()
  {
    $this->host = "db";
    $this->db = "test_db";
    $this->port = "3306";
    $this->user_name = "devuser";
    $this->user_pass = "devpass";

    $conn = new mysqli($this->host, $this->user_name, $this->user_pass, $this->db, $this->port);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } else {
      $this->connector = $conn;
    }
  }

  public function delete_by_lang($table = "", $language)
  {
    $this->connector->query("delete from `$table` where lang=\"$language\"");
  }

  public function insert($table, $data)
  {
    $query = "insert into $table VALUES (NULL, $data)";
    $this->connector->query($query);
  }

  public function get_data($table, $lang = "ru", $filters = null, $limit = 5, $offset = 0)
  {
    $query = "select * from $table where lang=\"$lang\" ";
    if (is_array($filters)) {
      if (isset($filters['order'])) {
        $query .= "order by " . $filters['order']['by'] . " " . ($filters['order']['direction'] ? $filters['order']['direction'] : "asc") . " ";
      }
    }
    $query .= " limit $limit";
    $query .= " offset $offset";
    return $this->connector->query($query);
  }

  public function get_count_pages($table, $lang = "ru", $limit = 5)
  {
    $query = "select count(*) as count_rows from $table where lang=\"$lang\"";
    $count = $this->connector->query($query)->fetch_array()['count_rows'];
    $pages = intval($count / $limit);
    $pages += $count % $limit > 0 ? 1 : 0;
    return $pages;
  }

}
