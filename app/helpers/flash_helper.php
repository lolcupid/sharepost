<?php
session_start();

function flash($name = '', $message = '', $class = 'alert alert-success') {
  if(!empty($name)) {
    if(empty($_SESSION[$name]) && !empty($message)) {
      if(!empty($_SESSION[$name])) {
        unset($_SESSION[$name]);
      }

      if(!empty($_SESSION[$name . '_class'])) {
        unset($_SESSION[$name . '_class']);
      }

      $_SESSION[$name] = $message;
      $_SESSION[$name . '_class'] = $class;
    } elseif(!empty($_SESSION[$name]) && empty($message)) {
      $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
      echo "<div class='" . $class . "'>" . $_SESSION[$name] . "</div>";
      unset($_SESSION[$name]);
      unset($_SESSION[$name . '_class']);
    } 
  }
}


?>