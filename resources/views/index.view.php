<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require __DIR__ . "/partials/favicons.php" ?>
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("libs/bootstrap/css/bootstrap.min.css") ?>">
  <!-- Alpine Plugins -->
  <script defer src="https://unpkg.com/@alpinejs/collapse@3.10.3/dist/cdn.min.js"></script>
  <title>Listado de Interconsultas</title>
</head>
<body>
  <?php require __DIR__ . "/partials/header.php" ?>
  <?php require __DIR__ . "/partials/loader.php" ?>

  <main class="h-auto bg-light p-3" style="min-height: 90vh;">
    <h1 class="text-center text-secondary h3">Listado de Interconsultas</h1>
    <?php require __DIR__ . "/components/select-especialidad.php" ?>

    <div id="button-container" class="sticky-top">
      <a x-data 
        :href="'<?= \App\App::config("project_path") ?>' + `/urg/reunion/${$store.selectedEsp ? $store.selectedEsp.toLowerCase() : ''}`" 
        class="btn btn-sm btn-dark m-2">Reunion</a>
    </div>

    <div class="p-2 container m-auto">
      <div x-data="listInterconsultas" class="d-grid" style="grid-template-columns: repeat(auto-fill, minmax(450px, 1fr)); grid-gap: 2rem;">
        <template x-for="int in sortInterconsultasByEstado($store._interconsultas)" :key="int.id">
          <!-- Listado de interconsultas -->
          <div 
            class="small rounded border-bottom border-5" :class="getClass(int.estado)" style="background-color: white;">
            <!-- Paciente -->
            <div class="d-grid p-1 border-bottom border-secondary border-1 mb-2" style="grid-template-columns: 1fr 1fr;">
              <div class="p-2 border-end border-1 border-secondary">
                <span class="small d-block">Paciente:</span >
                <span class="fw-semibold d-block" x-text="int.paciente.nombre"></span> 
                <span class="d-block py-2" x-text="int.paciente.documento"></span> 
                <span class="fw-semibold" x-text="int.paciente.edad"></span> A&ntilde;os
              </div>
              <div class="p-2">
                <span class="small d-block">Solicitado por:</span>
                <span class="fw-semibold" x-text="int.nombre_medico"></span>
                <template x-if="int.estado != 'PENDIENTE'">
                  <div class="pt-2">
                    <span class="small d-block">Atendida el:</span>
                    <span class="fw-semibold" x-text="today"></span>
                  </div>
                </template>
              </div>
            </div>
            <!-- Interconsulta -->
            <div class="pt-1 p-3">
              <span class="small">Fecha:</span>
              <span class="fw-semibold" x-text="new Date(int.fecha).toLocaleString()"></span>
              &emsp; - &emsp;
              <span class="small">Estado:</span>
              <span class="fw-semibold" x-text="int.estado"></span>

              <hr class="my-2">
              <span class="fw-semibold">Observaci&oacute;n:</span><br>
              <span x-text="int.observacion" style="white-space:pre-line;"></span>
            </div>
          </div>
        </template>
      </div>
    </div>
  </main>
  <?php require __DIR__ . "/partials/footer.php" ?>
  <script src="<?= \App\Helpers\Assets::load("libs/jquery/jquery.js") ?>"></script>
  <script type="module" src="<?= \App\Helpers\Assets::load("js/solicitar-interconsulta.js") ?>"></script>
</body>
</html>