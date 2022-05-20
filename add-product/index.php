<?php session_start();

if ($_SESSION["login"] === NULL) {
  header("Location: ../");
  exit();
}

if (isset($_POST["submit"])) :
  require_once "../functions/sqli.inc.php";
  [
    "name" => $name,
    "description" => $description,
    "category" => $category,
    "price" => $price,
    "stock" => $stock
  ] = $_POST;

  if (isExist($name)) :
    echo
    <<<JS
    <script>
      window.alert("Your product name is already exist");
    </script>
    JS;
  else :
    $id = createId();
    $values = "('$id', '$name', '$category', '$description', $price, $stock)";
    $query =
      <<<SQL
    INSERT INTO `product`
    VALUES $values;
  SQL;

    $result = setProduct($query);

    if (is_bool($result)) :
      echo
      <<<JS
    <script>
      window.alert("Your product has been submited!");
      document.location.href = "../index.php";
    </script>
    JS;
      die();
    else :
      echo
      <<<JS
    <script>
      window.alert("Sorry, something went wrong :(");
    </script>
    JS;
      echo $result;
    endif;
  endif;
endif;

function isExist(string $name): bool
{
  global $mysql;
  $res = mysqli_query($mysql, "SELECT name FROM `product`");
  $data = mysqli_fetch_array($res);

  foreach ($data as $d) :
    if ($d === $name) return true;
  endforeach;
  return false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add product</title>
  <style>
    <?php require_once "../styles/global.css"; ?>
    <?php require_once "../styles/form-style.css"; ?>
    <?php require_once "../lib/bootstrap/css/bootstrap.css"; ?>
  </style>
</head>

<body class="container">
  <?php require_once "../components/navbar.php";
  navBar("add-product"); ?>

  <main class="main">
    <h1 class="h1">Add Product</h1>

    <?php require_once "../components/form.php" ?>
  </main>
  <script src="../lib/bootstrap/js/bootstrap.js"></script>
  <script src="../js/_add-product.js" type="module"></script>
</body>

</html>