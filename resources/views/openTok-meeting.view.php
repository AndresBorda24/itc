<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require __DIR__ . "/partials/favicons.php" ?>
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("libs/bootstrap/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
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
      <div class="position-absolute end-0 top-0 p-2 d-flex justify-content-around flex-column-reverse h-100 bg-dark bg-opacity-75" id="button-container" style="width: 50px; z-index: 1;">
        <!-- Desconectar -->
        <button class="btn btn-danger btn-sm p-2 pt-1" onclick="disconnectSession()">
          <i class="bi bi-telephone-x-fill"></i>
        </button>

        <!-- Pantalla completa -->
        <button class="btn btn-sm btn-primary p-2 pt-1" onclick="toggleFullScreen()">
          <i class="bi bi-fullscreen" id="fullscreen"></i>
        </button>

        <!-- Camara -->
        <button class="btn btn-light btn-sm p-0 py-1" onclick="toggleCamera()">
          <img src="<?= \App\Helpers\Assets::load("images/icons/flip-camera.png") ?>" height="25" width="25">
        </button>

        <!-- Iniciar / Detener video -->
        <button x-data="{ active: __control.video }" 
        :class="{ 'btn-outline-warning': !active, 'btn-success': active  }"
        class="btn btn-sm p-2 pt-1" 
        @click="() => { toggleVideo(); active = !active }">
          <i class="bi" :class="{'bi-camera-video-off-fill': !active, 'bi-camera-video-fill': active }"></i>
        </button>

        <!-- Iniciar / Detener Audio -->
        <button x-data="{ active: __control.audio }" 
        :class="{ 'btn-outline-warning': !active, 'btn-success': active }" 
        class="btn btn-sm p-2 pt-1" 
        @click="() => { toggleAudio(); active = !active }">
          <i class="bi" :class="{'bi-mic-mute-fill': !active, 'bi-mic-fill': active }"></i>
        </button>
      </div>
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
    var especialista = false;
  </script>
  <script src="<?= \App\Helpers\Assets::load("libs/jquery/jquery.js") ?>"></script>  
  <script src="<?= \App\Helpers\Assets::load("js/scripts/meeting.js") ?>"></script>  
  <script type="module" src="<?= \App\Helpers\Assets::load("js/meeting.js") ?>"></script>
</body>
</html>