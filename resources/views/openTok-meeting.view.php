<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require __DIR__ . "/partials/favicons.php" ?>
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("libs/bootstrap/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("css/open-tok-meeting.css") ?>">
  <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
  <title>Reunion</title>
</head>
<body>
  <?php require __DIR__ . "/partials/loader.php" ?>

  <main class="bg-dark p-3 position-relative d-flex" style="min-height: 100vh;">
    <!-- Aqui debe ir incrustada la reunion -->
    <div class="rounded-1 flex flex-grow-1 position-relative overflow-auto" id="zoom-arenn">
      <div class="position-absolute start-0 top-0 h-auto d-flex bg-secondary border border-2 border-primary rounded overflow-hidden" style="z-index: 1;" id="publisher"></div>

      <div class="w-100 h-100 d-grid gap-2" id="sub"
      style="grid-template-columns: repeat(auto-fit, minmax(45%, 1fr)); grid-auto-rows: 1fr;"
      ></div> 

      <!-- Botones Cambiar camara | pantalla Completa -->
      <?php require __DIR__ . '/partials/buttons-opentok.php' ?>
    </div>

    <!-- Logo de asotrauma -->
    <div class="position-absolute bottom-0 end-0 p-2 w-100 d-flex justify-content-between" style="z-index: 1;">
      <div class="w-25 rounded bg-white border border-dark shadow m-auto px-2" style="height: 35px; min-width: 130px;">
        <img 
          style="object-fit: contain; object-position: center;"
          alt="logo"
          class="h-100 w-100"
          src="<?= \App\Helpers\Assets::load("images/aso/logo_1.png") ?>">
      </div>
    </div>
  </main>

  <?php require __DIR__ . "/components/meeting/show-pacientes.php" ?>
  <script type="text/javascript">
    var token        = "<?= $token ?>";
    var apiKey       = "<?= $apiKey ?>";
    var sessionId    = "<?= $sessionId ?>";
    var especialista = <?= $esp ? 'true' : 'false' ?>;
  </script>
  <script src="<?= \App\Helpers\Assets::load("libs/jquery/jquery.js") ?>"></script>  
  <script src="<?= \App\Helpers\Assets::load("js/scripts/meeting.js") ?>"></script>  
  <script type="module" src="<?= \App\Helpers\Assets::load("js/meeting.js") ?>"></script>
</body>
</html>