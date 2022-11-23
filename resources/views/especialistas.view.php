<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require __DIR__ . "/partials/favicons.php" ?>
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("libs/bootstrap/css/bootstrap.min.css") ?>">
  <title>Solicitudes Interconsulta</title>
</head>
<body>
  <?php require __DIR__ . "/partials/header.php" ?>
  <?php require __DIR__ . "/partials/loader.php" ?>

  <main class="h-auto bg-light p-3" style="min-height: 80vh;">
    <h1 class="text-center text-secondary h3">Solicitudes Interconsulta</h1>
    <?php require __DIR__ . "/components/select-especialidad.php" ?>

    <div id="button-container" class="sticky-top">
      <a x-data 
        :href="'<?= \App\App::config("project_path") ?>' + `/esp/reunion/${$store.selectedEsp ? $store.selectedEsp.toLowerCase() : ''}`" 
        class="btn btn-sm btn-dark m-2">Ir a la reunion</a>
    </div>

    <div class="p-2 container m-auto">
      <div x-data="listIntercosultas">
        <template x-for="inter in sortInterconsultasByEstado($store._interconsultas)" :key="inter.id">
          <div class="mb-5" x-data="interconsulta( inter )" :id="state.id">
            <!--
              Radio Inputs de los estados 
            -->
            <div class="d-flex rounded border px-sm-4 justify-content-between p-2 flex-wrap small">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="REVISADO" x-model="state.estado" :name="`${state.id}`" :id="`rev-${state.id}`">
                <label class="form-check-label small" :for="`rev-${state.id}`">REVISADO</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="PENDIENTE" x-model="state.estado" :name="`${state.id}`" :id="`pen-${state.id}`">
                <label class="form-check-label small" :for="`pen-${state.id}`">PENDIENTE</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="CANCELADO" x-model="state.estado" :name="`${state.id}`" :id="`can-${state.id}`">
                <label class="form-check-label small" :for="`can-${state.id}`">CANCELADO</label>
              </div>
            </div>

            <!-- 
              Informacion de la interconsulta
            -->
            <div :class="getClass()" class="small rounded shadow-sm border">
              <!-- Paciente -->
              <div class="pb-1 p-3 mb-sm-0">
                <span class="small d-block">Paciente:</span>
                <span class="fw-semibold" x-text="state.paciente.nombre"></span> |
                <span x-text="state.paciente.documento"></span> |
                <span class="fw-semibold" x-text="state.paciente.edad"></span> A&ntilde;os
              </div>
              <hr class="d-sm-none">
              <!-- Interconsulta -->
              <div class="pt-1 p-3">
                <span class="small d-block">Fecha:</span>
                <span class="fw-semibold" x-text="new Date(state.fecha).toLocaleString()"></span>
                <hr class="my-2">
                <span class="fw-semibold">Observaci&oacute;n:</span><br>
                <span x-text="state.observacion" style="white-space:pre-line;"></span>
                <hr class="my-2">
                <span class="fw-semibold">Estado:</span>
                <span x-text="state.estado"></span>
                <template x-if="state.estado != 'PENDIENTE'">
                 <div>
                  <hr>
                  <span class="small d-block mt-2">Resuelto en:</span>
                  <span x-text="today" style="white-space: pre-line;"></span>
                 </div> 
                </template>
              </div>
            </div>
            <hr>
          </div>
        </template>
      </div>
    </div>
  </main>
  <?php require __DIR__ . "/partials/footer.php" ?>
  <script src="<?= \App\Helpers\Assets::load("libs/jquery/jquery.js") ?>"></script>
  <script type="module" src="<?= \App\Helpers\Assets::load("js/solicitudes-interconsultas.js") ?>"></script>
</body>
</html>