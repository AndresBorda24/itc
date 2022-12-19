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
  <style>[x-cloak] { display: none !important; }</style>
</head>
<body>
  <?php require __DIR__ . "/partials/header.php" ?>
  <?php require __DIR__ . "/partials/loader.php" ?>

  <main class="h-auto bg-light p-3" style="min-height: 90vh;">
    <h1 class="text-center text-secondary h3">Listado de Interconsultas</h1>
    <?php require __DIR__ . "/components/select-especialidad.php" ?>

    <div id="button-container">
      <a x-data 
        :href="'<?= \App\App::config("project_path") . "/{$role}" ?>' + `/reunion/${$store.selectedEsp ? $store.selectedEsp.toLowerCase() : ''}`" 
        class="btn btn-sm btn-dark m-2">Reuni&oacute;n</a>
    </div>

    <div class="p-2 px-md-3 px-lg-5 container m-auto">
      <div x-data="listInterconsultas">
        <!-- Filtros por Estado -->
        <template x-teleport="#button-container">
          <ul class="nav nav-tabs small d-inline-flex">
            <li class="nav-item small">
              <button class="nav-link" @click="type = 'P'" :class="{'active': (type == 'P')}">Pendientes</button>
            </li>
            <li class="nav-item small">
              <button class="nav-link" @click="type = 'R'" :class="{'active': (type == 'R')}">Revisados</button>
            </li>
          </ul>
        </template>

        <template x-for="int in sortInterconsultasByEstado($store._interconsultas)" :key="int.id">
          <!-- Listado de interconsultas -->
          <div class="small rounded mb-4 d-md-grid gap-2 overflow-hidden" style="grid-template-columns: 3fr 9fr;">
            <!-- Paciente -->
            <div class="p-2 small d-flex" :class="getClass(int.itc.estado)">
              <div class="p-2 m-auto w-100">
                <span class="small d-block text-opacity-50 text-light">Paciente:</span >
                <span class="fw-semibold d-block" x-text="int.paciente.nombre"></span> 
                <span class="d-block pt-2">
                  <span class="text-opacity-50 text-light">DI: </span>
                  <span class="pt-2" x-text="int.paciente.documento"></span> 
                </span>
                <span class="pt-2 d-block">
                  <span class="fw-semibold"x-text="new Date().getFullYear() - new Date(int.paciente.fechaNac).getFullYear()"></span> <span class="text-opacity-50 text-light">A&ntilde;os</span>
                </span>
                <hr>
                <span class="small d-block text-opacity-50 text-light">Solicitado a:</span>
                <span class="fw-semibold" x-text="int.especialista.nombre"></span>
                <hr>
                <span class="small d-block text-opacity-50 text-light">Solicitado por:</span>
                <span class="fw-semibold" x-text="int.medico.nombre"></span>
              </div>
            </div>

            <!-- Interconsulta -->
            <div class="p-3 bg-white border position-relative overflow-auto">
              <div class="small">
                <span class="small text-opacity-50">Fecha:</span>
                <span class="fw-semibold" x-text="df.format(new Date(int.itc.fecha))"></span><br>
                <span class="small text-opacity-50">Estado:</span>
                <span class="fw-semibold" x-text="getEstadoText( int.itc.estado )"></span>
                <template x-if="int.itc.estado == 'R'">
                  <div>
                    <span class="small text-opacity-50">Atendida el:</span>
                    <span class="fw-semibold" x-text="df.format(new Date(int.itc.fechaRes))"></span>
                  </div>
                </template>
              </div>
              <span class="fw-semibold d-block pt-3">Observaci&oacute;n:</span>
              <span x-text="int.itc.observacion" style="white-space:pre-line;"></span>
              <button
                @click="$dispatch('show-nota', { nota: int.nota })"
                class="btn btn-sm small btn-outline-dark position-absolute p-1 top-0 end-0 m-2" 
                x-show="(int.itc.estado == 'R')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation" viewBox="0 0 16 16">
                  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
              </button>
            </div>
          </div>
        </template>
      </div>
    </div>
  </main>
  <?php require __DIR__ . "/partials/footer.php" ?>
  <?php require __DIR__ . "/partials/show-nota-itc.php" ?>
  <script src="<?= \App\Helpers\Assets::load("libs/jquery/jquery.js") ?>"></script>
  <script type="module" src="<?= \App\Helpers\Assets::load("js/index.js") ?>"></script>
</body>
</html>