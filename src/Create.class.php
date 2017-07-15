<?php

/**
* This class made with free time and for FUN? only
* Saya tidak bertanggung jawab atas sehala kerugian yang ditimbulkan
* atas yang terjadi dikarenakan class ini
*
* This code is in no way affiliated with, authorized, maintained,
* sponsored or endorsed by INSTAGRAM (Company) or any of its
* affiliates or subsidiaries. Use at your own risk.
*
* Email : ?? :)
* Automation Script - Askaeks Technology (2017)
**/

class InstagramWebCreate {
  public $edomail = array('gmail.com', 'yahoo.co.id'), $passwordLength = 10;
  function __construct() { $this->init(); }
  public function create($username = null, $email = null, $password = null, $name = null, callable $callback) {
    $username = ($username) ? $username : $this->parse($this->_unameFile[0]) . mt_rand(1,99999);
    $email = ($email) ? $email : $username . '@' . $this->edomail[mt_rand(0, count($this->edomail) - 1)];
    $password = ($password) ? $password : $this->generateRandomString($this->passwordLength);
    $name = ($name) ? $name : ucfirst($this->parse($this->_nameFile[0])) . ' ' . ucfirst($this->parse($this->_nameFile[1]));
    # CURL Case
    $proxy = '213.238.242.55:45454';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.instagram.com/accounts/web_create_ajax/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "email=".rawurlencode($email)."&password={$password}&username={$username}&first_name=" . rawurlencode($name));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $headers = array();
    $headers[] = "Cookie: mid=WScGWwALAAHFVcPh-_2-bxrolFvU; ig_vw=1366; ig_pr=1; csrftoken=kWwwZNxDmGAdiS4qZoLq0MZiDcztnd7E; rur=FRC";
    $headers[] = "Origin: https://www.instagram.com";
    $headers[] = "Accept-Encoding: gzip, deflate, br";
    $headers[] = "Accept-Language: en,id;q=0.8,ja;q=0.6";
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36";
    $headers[] = "X-Requested-With: XMLHttpRequest";
    $headers[] = "X-Csrftoken: kWwwZNxDmGAdiS4qZoLq0MZiDcztnd7E";
    $headers[] = "X-Instagram-Ajax: 1";
    $headers[] = "Content-Type: application/x-www-form-urlencoded";
    $headers[] = "Accept: */*";
    $headers[] = "Referer: https://www.instagram.com/";
    $headers[] = "Authority: www.instagram.com";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    if (curl_errno($ch)) $callback(true, curl_error($ch));
    curl_close ($ch);
    $result = json_decode($result);
    if(!empty($result->account_created) && $result->account_created == true){
      $callback(false, array('email' => $email, 'username' => $username, 'password' => $password, 'name' => $name));
    } else $callback(true, "Failed to craete a account!");
  }
  public function shuffle() {
    shuffle($this->_nameFile); shuffle($this->_unameFile);
    return $this;
  }
  private function parse($string) {
    return str_replace(array("\n", "\r", "\r\n"), '', $string);
  }
  # googleing :)
  private function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
  private function init() {
    $this->_nameFile = file('../database/nama.list');
    $this->_unameFile = file('../database/username.list');
  }
}
