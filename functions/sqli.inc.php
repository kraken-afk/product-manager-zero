<?php

$mysql = mysqli_connect("127.0.0.1", "root", "", "data_barang", 3308);

function getProduct(string $query): array
{
  GLOBAL $mysql;
  $data = array();
  $result = mysqli_query($mysql, $query);
  
  if (!$result) return array();
  while ($product = mysqli_fetch_assoc($result)) :
    $data[] = $product;
  endwhile;
  return $data;
}

function setProduct(string $query): mixed
{
  if (!$query) return false;

  GLOBAL $mysql;
  
   if (mysqli_query($mysql, $query)):
    return true;
   else:
    return mysqli_error($mysql);
   endif;
}

function createId(): string
{
  global $mysql;
  $result = mysqli_query($mysql, "SELECT id FROM product ORDER BY id DESC LIMIT 1;");
  [$latesId] = mysqli_fetch_array($result) ?? "p000";

  $newId = intval(array_filter(preg_split("/[\D0]+/", $latesId))[1]) + 1;

  switch (strlen("$newId")):
    case 1:
      return "p00" . $newId;
    case 2:
      return "p0" . $newId;
    default:
      return "p" . $newId;
  endswitch;
}
