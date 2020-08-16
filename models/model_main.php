<?php

class Model_Main extends Model
{
  private $table;
  private $db;

  function __construct()
  {
    $this->table = "articles";
    $this->db = new DB_Connector();
  }

  public function save_data()
  {
    try {
      $lang = $_SESSION['lang'] ? $_SESSION['lang'] : "ru";


      $this->db->delete_by_lang($this->table, $lang);
      $content = file_get_contents("http://k.img.com.ua/rss/$lang/ukraine.xml");
      $rss = new SimpleXMLElement($content);
      $count = 0;
      foreach ($rss->channel->item as $item) {
        if ($count < 10) {
          preg_match('(http[a-z0-9.:/]{1,})', $item->image, $m);
          $image = $m[0];
          $title = $item->title;//+
          $link = $item->link;//+
          $description = strip_tags($item->description);//+
          $pubdate = strtotime($item->pubDate);//+
          $input = "\"" . $lang . "\",\"" . $title . "\",\"" . $link . "\",\"" . $description . "\",'" . date('Y-m-d h:i:s', $pubdate) . "',\"" . $image . "\"";
          $this->db->insert($this->table, $input);
          $count++;
        } else
          break;
      }
    } catch (Exception $exception) {
      echo "Error happened: " . $exception;
    }
  }

  public function get_data($filters = null)
  {
    $data = [];
    $lang = $_SESSION['lang'] ? $_SESSION['lang'] : "ru";
    $offset = $_SESSION['page'] ? ($_SESSION['page'] - 1) * 5 : 0;
    $selected = $this->db->get_data($this->table, $lang, $filters, 5,$offset);
    while ($item = $selected->fetch_array())
      $data['news'][] = $item;

    $data['pages'] = $this->db->get_count_pages($this->table);
    return $data;
  }
}