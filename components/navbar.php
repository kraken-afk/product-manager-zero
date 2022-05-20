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
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="$attr[0]">CRUD APP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="$attr[0]">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="$attr[1]">Add Product</a>
            </li>
          </ul>
        </div>
      </div>
      <script id="temp">
        document.querySelectorAll(".navbar-nav a").forEach(e => {
          if (e.getAttribute("href") === "#") e.classList.add("active");
          if (e.classList.contains("active"))
            document.getElementById("temp").remove();
        })
      </script>
    </nav>
  HTML;
}


