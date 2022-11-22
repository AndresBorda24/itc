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

    <div id="button-container"></div>
    <div class="p-2 container m-auto">
      <div x-data="listInterconsultas">
        <template x-for="[cod, int] in Object.entries($store.interconsultas)" :key="cod">
          <div class="mb-3" x-data="{ show: false }">
            <div class="position-relative">
              <h4 @click="show = !show" class="w-100 m-0" style="height: 60px;">
                <span x-text="int.nombre"></span>
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" 
                  height="16" :style="show && { transform: 'rotate(180deg)' }" 
                  fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                  </svg>
                </span>
              </h4>
              <a class="btn btn-sm btn-dark d-block position-absolute bottom-0 start-0" style="z-index: 5;" 
                :href="'<?= \App\App::config('project_path') ?>/urg/reunion/'+int.esp_cod">Reuni&oacute;n</a>
            </div>
            <!-- Listado de interconsultas para la especialidad [cod] -->
            <div x-collapse.duration.300ms x-show="show" style="display: none;">
              <template x-for="i in sortInterconsultasByEstado(int.i)" :key="i.id">
                <!-- 
                  Informacion de la interconsulta
                -->
                <div 
                  :class="{ 'text-decoration-line-through text-muted bg-secondary bg-opacity-25': (i.estado != 'PENDIENTE') }"
                  class="small rounded shadow-sm border my-3" style="background-color: white;">
                  <!-- Paciente -->
                  <div class="pb-1 p-3 mb-sm-0">
                    <span class="small d-block">Paciente:</span>
                    <span class="fw-semibold" x-text="i.paciente.nombre"></span> |
                    <span x-text="i.paciente.documento"></span> |
                    <span class="fw-semibold" x-text="i.paciente.edad"></span> A&ntilde;os
                  </div>
                  <hr class="d-sm-none">
                  <!-- Interconsulta -->
                  <div class="pt-1 p-3">
                    <span class="small d-block">Fecha:</span>
                    <span class="fw-semibold" x-text="new Date(i.fecha).toLocaleString()"></span>
                    <hr class="my-2">
                    <span class="fw-semibold">Observaci&oacute;n:</span><br>
                    <span x-text="i.observacion" style="white-space:pre-line;"></span>
                    <hr class="my-2">
                    <span class="small d-block">Estado:</span>
                    <span class="fw-semibold" x-text="i.estado"></span>
                    <span class="small d-block pt-2">Solicitado por:</span>
                    <span class="fw-semibold" x-text="i.nombre_medico"></span>
                    <template x-if="i.estado != 'PENDIENTE'">
                      <div class="pt-2">
                        <span class="small d-block">Atendida el:</span>
                        <span class="fw-semibold" x-text="$data.today"></span>
                      </div>
                    </template>
                  </div>
                </div>
              </template>
            </div>
            <hr>
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