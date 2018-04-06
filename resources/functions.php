<?php

//helper functions

function set_message($msg){

  if(!empty($msg)) {
    $_SESSION['message'] = $msg;
  }
  else{
    $msg = "";
  }
}

function display_message() {

  if(isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
  }

}

function redirect($location){
  header("Location: $location");
}

function query($sql){
  global $connection;

  return mysqli_query($connection, $sql);

}

function confirm($result){
  global $connection;

  if(!$result){
    die("QUERY FAILED " . mysqli_error($connection));
  }
}

function escape_string($string){
  global $connection;

  return mysqli_real_escape_string($connection, $string);

}

function fetch_array($result){
  return mysqli_fetch_array($result);
}

/************** Begin Front end functions **********************/
// get products

function get_products(){
  $query = query(" SELECT * FROM products");

  confirm($query);

  while($row = fetch_array($query)){

$product = <<<DELIMETER
  <div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
      <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
      <div class="caption">
        <h4 class="pull-right">&#36;{$row['product_price']}</h4>
        <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
        </h4>
        <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>
      </div>

    </div>
  </div>      
DELIMETER;

echo $product;

  }
}

function get_category_products($cat_id){
  $query = query(" SELECT * FROM products WHERE product_category_id=" . $cat_id . " ");

  confirm($query);

  while($row = fetch_array($query)){

$product = <<<DELIMETER

<div class="col-md-3 col-sm-6 hero-feature">
<div class="thumbnail">
    <img src="{$row['product_image']}" alt="">
    <div class="caption">
      <h3>{$row['product_title']}</h3>
      <p>ult</p> 
      <p>
        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
      </p>
    </div>
</div>
</div>

DELIMETER;

echo $product;

  }
}

function get_products_in_shop_page(){

  $query = query(" SELECT * FROM products");

  confirm($query);

  while($row = fetch_array($query)){

$product = <<<DELIMETER

<div class="col-md-3 col-sm-6 hero-feature">
<div class="thumbnail">
    <img src="{$row['product_image']}" alt="">
    <div class="caption">
      <h3>{$row['product_title']}</h3>
      <p>ult</p> 
      <p>
        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
      </p>
    </div>
</div>
</div>

DELIMETER;

echo $product;

  }
}

// get categories
function get_categories(){

  $query = query(" SELECT * FROM categories");
  confirm($query);
  
  while($row = fetch_array($query)) {

$category_link = <<<DELIMETER
  <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;

  echo $category_link;  

  }
}

//login function
function login_user(){
  if(isset($_POST['submit'])){
    $username = escape_string($_POST['username']);
    $password = escape_string($_POST['password']);

    $query = query("SELECT * FROM users WHERE username ='{$username}' AND password ='{$password}' ");
    confirm($query);

    if(mysqli_num_rows($query) == 0 ) {
      set_message("Your Password or Username is wrong!");
      redirect("login.php");
    }
    else {
      //set_message("Welcome to Admin {$username} ");
      redirect("admin");
    } 
  }
}

//send message
function send_message(){
  if(isset($_POST['submit'])){
    $to = "antonius.vanhaeren.av@gmail.com";
    $from_name = $_POST['name'];
    $email     = $_POST['email'];
    $subject   = $_POST['subject'];
    $message   = $_POST['message'];


    $headers = "From: {$from_name}";

    $result = mail($to, $subject, $message, $headers);

    if(!$result) {
      set_message("Sorry something went wrong!");
      redirect("contact.php");
    }else {
      set_message("Your message has been send");
      redirect("contact.php");
    }


  }



}

/************** End Front end functions **********************/

/************** Begin Back end functions **********************/

/************** End Back end functions **********************/
?>