<?php
  // redirect function to redirect to specified url
  function redirect($url){
    header('location: ' . URLROOT . '/' . $url);
  }
