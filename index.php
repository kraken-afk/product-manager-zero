<?php session_start();

if ($_SESSION["login"] === NULL) {
  header("Location: ./login.php");
  exit();
}

require_once "./functions/sqli.inc.php";

$products = getProduct("SELECT * FROM `product`;");

if (isset($_POST["submit"])) :
  [
    "name" => $name,
    "category" => $category,
    "description" => $description,
    "price" => $price,
    "stock" => $stock,
  ] = $_POST;

  $query = <<<SQL
  UPDATE product
  SET category = "$category", description = "$description", price = $price, stock = $stock
  WHERE name = "$name";
  SQL;

  $res = setProduct($query);

  if (!is_string($res)) {
    echo
    <<<JS
      <script id="temp">
      window.alert("The Product has been updated!");
      document.getElementById("temp").remove();
      </script>
    JS;
    header("Location: ./");
    exit();
  } else {
    echo
    <<<JS
      <script id="temp">
      window.alert("Sorry, Something went worng");
      document.getElementById("temp").remove();
      </script>
    JS;
  }

endif;

if (isset($_GET["truncate"])) :
  $rowName = $_GET["truncate"];
  $query = "DELETE FROM `product` WHERE name = '$rowName'";
  setProduct($query);
  header("Location: ./");
  die();
endif;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product manager</title>
  <style>
    <?php
    require_once "./styles/global.css";
    require_once "./styles/index.css";
    require_once "./styles/form-style.css";
    ?>
  </style>
</head>

<body>

  <?php require_once "./components/navbar.php";
  navBar("home"); ?>

  <main class="main">
    <h1 class="directories">Home</h1>
    <span class="greet">Hello <?= explode(" ", $_SESSION["login"])[1] ?>, Have a good day 👋</span>
    <a href="./functions/logout.php" class="logout">Logout</a>

    <div class="table-container">
      <table class="table">
        <thead class="thead">
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>category</th>
            <th>description</th>
            <th>price</th>
            <th>stock</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody class="tbody">
          <?php
          $esc = fn ($str) => htmlspecialchars($str);
          foreach ($products as $product) :
            static $counter = 1;
            echo
            <<<HTML
          <tr>
            <td>$counter</td>
            <td>{$esc($product["name"])}</td>
            <td>{$esc($product["category"])}</td>
            <td class="desc">{$esc($product["description"])}</td>
            <td>{$esc($product["price"])}</td>
            <td>{$esc($product["stock"])}</td>
            <td class="action">
              <span id="edit-btn" title="Edit">🔧</span>
              <span id="delete-btn" title="Delete">❌</span>
            </td>
          </tr>
          HTML;
            $counter++;
          endforeach;
          unset($esc);
          ?>
        </tbody>
      </table>
    </div>

  </main>

  <div id="edit-modal" class="edit-modal disable">
    <?php require_once "./components/form.php" ?>
  </div>

  <script src="./js/_add-product.js" type="module"></script>
  <script src="./js/_index.js" type="module"></script>
</body>

</html>