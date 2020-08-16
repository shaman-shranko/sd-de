<?php

class Controller_Main extends Controller
{
  function __construct()
  {
    $this->model = new Model_Main();
    $this->view = new View();
  }

  function action_index()
  {
    $filters = [];
    if (isset($_POST)) {
      foreach ($_POST as $key => $value) {
        $_SESSION[$key] = $value;
      }
    }
    if (isset($_SESSION['order']))
      $filters['order'] = $_SESSION['order'];

    $this->model->save_data();
    $data = $this->model->get_data($filters);
    $this->view->generate('main_view.php', 'common.php', $data);
  }
}