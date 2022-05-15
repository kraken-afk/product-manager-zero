<?php
function navBar(string $path): void
{
  switch (strtolower($path)):
    case "home":
      $attr = array("#", "./add-product");
      break;
    case "add-product":
      $attr = array("../", "#");
      break;
    default: break;
  endswitch;
  
  echo 
  <<<HTML
    <header class="header">
    <span class="logo">
      CRUD APP
    </span>
    <nav class="nav">
      <a href="{$attr[0]}" class="nav-item">Home</a>
      <a href="{$attr[1]}" class="nav-item">Add Product</a>
      <script id="temp">
        document.querySelectorAll(".nav a").forEach(e => {
          if (e.getAttribute("href") === "#") e.classList.add("active");
          if (e.classList.contains("active"))
            document.getElementById("temp").remove();
        })
      </script>
    </nav>
  </header>
  HTML;
}