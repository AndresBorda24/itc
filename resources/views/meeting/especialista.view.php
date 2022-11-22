<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require __DIR__ . "/../partials/favicons.php" ?>
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("libs/bootstrap/css/bootstrap.min.css") ?>">
  <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
  <title>Reunion</title>
</head>
<body>
  <?php require __DIR__ . "/../partials/loader.php" ?>

  <main class="bg-dark p-3 position-relative d-flex" style="min-height: 100vh;">
    <!-- Aqui debe ir incrustada la reunion -->
    <div class="rounded-1 flex flex-grow-1 position-relative overflow-auto" id="zoom-arenn">
      <div class="d-grid h-100 flex-grow-1 bg-dark" style="grid-template-columns: repeat(auto-fit, minmax(40%, 1fr));">
        <div id="subscriber"></div>
      </div>
      <div id="publisher" class="position-absolute m-3 p-2 top-0 start-0 bg-dark" style="height: 60px; width: 60px;"></div>
    </div>
    <div class="position-absolute end-0 top-0 p-2 d-flex justify-content-around flex-column-reverse h-25 mt-5" id="button-container" style="width: 50px;">
      <button class="btn btn-sm btn-primary small p-2 pt-1" onclick="toggleFullScreen()">
        <!-- Fullscreen Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-fullscreen" id="fullscreen-i" viewBox="0 0 16 16"> 
          <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/> 
        </svg> 
        <!-- Exit Full screen Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fullscreen-exit d-none" id="e-fullscreen-i" viewBox="0 0 16 16">
          <path d="M5.5 0a.5.5 0 0 1 .5.5v4A1.5 1.5 0 0 1 4.5 6h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5zm5 0a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 10 4.5v-4a.5.5 0 0 1 .5-.5zM0 10.5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 6 11.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5zm10 1a1.5 1.5 0 0 1 1.5-1.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4z"/>
        </svg>
      </button>
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
  
  <?php require __DIR__ . "/../components/meeting/show-pacientes.php" ?>
  <script src="<?= \App\Helpers\Assets::load("libs/jquery/jquery.js") ?>"></script>  
  <script type="module" src="<?= \App\Helpers\Assets::load("js/meeting-esp.js") ?>"></script>
  <script>
    var token        = "<?= $token ?>";
    var apiKey       = "<?= \App\App::config("opentok")["API_KEY"] ?>";
    var sessionId    = "<?= $session_id ?>";
    var especialista = true;
  </script>
  <script src="<?= \App\Helpers\Assets::load("js/scripts/meeting.js") ?>"></script>
</body>
</html>