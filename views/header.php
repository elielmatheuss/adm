  <?php
  @$pagina = $_GET['a'];

  if (isset($pagina)) {
    include($pagina);
  }
  ?>

  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">TBJAU</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo "index.php?a=audiencia.php"; ?>">Audiência</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo "index.php?a=oracao.php"; ?>">Oração</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo "index.php?a=hinos.php"; ?>">Hinos Especiais</a>
            </li>
          </ul>
          <!-- <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form> -->
        </div>
      </div>
    </nav>
  </header>