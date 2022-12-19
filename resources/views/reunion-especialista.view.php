<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require __DIR__ . "/partials/favicons.php" ?>
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("libs/bootstrap/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("css/open-tok-meeting.css") ?>">
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("css/bootstrap-icons.css") ?>">
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("css/alpinejs-breakpoints.css") ?>">
  <script src="<?= \App\Helpers\Assets::load("libs/alpinejs/alpinejs-breakpoints.js") ?>"></script>
  <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
  <title>Reunion | Especialista</title>
</head>
<body>
  <?php require __DIR__ . "/partials/loader.php" ?>

  <main class="bg-dark p-2 position-relative d-grid d-lg-flex vh-100 vw-100" style="grid-template-rows: 5fr 4fr;">
    <!-- Aqui debe ir incrustada la reunion -->
    <div class="bg-secondary d-flex flex-grow-1 position-relative overflow-auto" id="zoom-arenn">
      <div class="position-absolute start-0 top-0 h-auto d-flex bg-secondary border border-2 border-primary rounded overflow-hidden" 
      style="z-index: 1;" 
      id="publisher"></div>

      <div class="w-100 h-100 d-grid gap-2" 
      id="sub"
      style="grid-template-columns: repeat(auto-fit, minmax(45%, 1fr)); grid-auto-rows: 1fr;"></div> 
    </div>

    <!-- Panel de itc no mobile | mobilen't -->
    <div class="text-bg-dark col-lg-3" x-data="pacientes" x-breakpoint="mobile = $isBreakpoint('md-')">
      <template x-if="! mobile">
        <div class="d-none d-lg-grid h-100" style="grid-template-rows: 7fr 4fr;">
          <!-- Notas -->
          <template x-if="pac">
            <div class="p-2">
              <div class="d-flex mb-2 align-items-center">
                <h4 class="d-block" x-text="pac.paciente.nombre" :class="{'text-success': (getEstado() == 'R') }"></h4>
                <!-- Check Revisado -->
                <button class="btn btn-sm btn-success d-block ms-3"  @click="cambiarEstado()">
                  <i class="bi bi-check2"></i>
                </button>
              </div>
              <!-- "Nav" -->
              <div class="btn-group small mb-3" role="group" aria-label="Basic example">
                <button type="button" @click="tab = 0" class="btn btn-outline-primary btn-sm d-none" :class="{'active': (tab == 0)}">Dejar Nota</button>
                <button type="button" @click="tab = 1" class="btn btn-outline-primary btn-sm" :class="{'active': (tab == 1)}">Observacion</button>
              </div>
              <!-- Contenedor -> Observacion y notas -->
              <div class="small" style="height: 70%;">
                <textarea x-model="pac.nota" class="form-control bg-secondary bg-opacity-25 text-light text-opacity-75 border-secondary form-control-sm h-100" id="nota-itc" x-show="(tab == 0)"></textarea>
                <textarea x-model="pac.itc.observacion" readonly class="form-control bg-transparent text-light text-opacity-75 border-secondary form-control-sm h-100" x-show="(tab == 1)"></textarea>
              </div>
            </div>
          </template>
          <!-- Listado de pacientes -->
          <div class="list-group rounded-0 overflow-auto small" style="max-height: 400px;">
            <template x-for="p in $store._pacientes" :key="p.id">
              <button 
                :class="{
                  'pacientes-hover': (pac.id != p.id), 
                  'list-group-item-action list-group-item-info': (pac.id == p.id),
                  'bg-secondary bg-opacity-25': (p.itc.estado == 'R' && pac.id != p.id)
                }"
                @click="setPaciente(p)" class="list-group-item">
                  <span x-text="p.paciente.nombre"></span>
                  <div class="d-inline-block border border-primary p-1 rounded" :class="{'bg-primary': (p.itc.estado == 'R')}"></div>
                </button>
            </template>
          </div>
        </div> 
      </template>
      <template x-if="mobile">
        <div class="d-block d-lg-none h-100">
          <template x-if="pac">
            <div class="p-2 h-100">
              <!-- nav -->
              <div class="d-flex p-1 gap-1 small justify-content-between">
                <button class="btn btn-light btn-sm" @click="previous()"><</button>
                <div class="d-flex gap-1 align-items-center px-4" style="overflow-x: auto; max-width: 220px;">
                  <template x-for="p in Alpine.store('_pacientes')">
                    <div class="p-1 rounded-circle border" :class="{'bg-light': (p.id == pac.id)}"></div>
                  </template>
                </div>
                <button class="btn btn-light btn-sm" @click="next()">></button>
              </div>

              <!-- Info -->
              <div class="d-flex mb-2 align-items-center gap-2 justify-content-center">
                <!-- Añadir Nota -->
                <button class="btn btn-sm p-1 btn-outline-primary d-none" @click="cambiarEstado()">
                  <i class="bi bi-pencil"></i>
                </button>
                <!-- Nombre -->
                <h5 class="d-block text-center" x-text="pac.paciente.nombre" :class="{'text-success': (getEstado() == 'R') }"></h5>
                <!-- Check Revisado -->
                <button class="btn btn-sm p-1 btn-success d-block"  @click="cambiarEstado()">
                  <i class="bi bi-check2"></i>
                </button>
              </div>
              <textarea x-model="pac.itc.observacion" readonly class="form-control bg-transparent text-light text-opacity-75 border-secondary form-control-sm h-50"></textarea>
            </div>
          </template>
        </div>
      </template>
    </div>
    <!-- Botones -->
    <?php require __DIR__ . '/partials/buttons-opentok.php' ?>
    <!-- Logo de asotrauma -->
    <div 
      class="position-absolute top-0 start-50 translate-middle-x w-25 rounded bg-white border border-dark shadow m-auto px-2" 
      style="height: 28px; min-width: 120px;">
      <img 
        style="object-fit: contain; object-position: center;"
        alt="logo"
        class="h-100 w-100"
        src="<?= \App\Helpers\Assets::load("images/aso/logo_1.png") ?>">
    </div>
  </main>

  <script type="text/javascript">
    var token        = "<?= $token ?? '' ?>";
    var apiKey       = "<?= $apiKey ?? '' ?>";
    var sessionId    = "<?= $sessionId ?? '' ?>";
    var especialista = true;
  </script>
  <script src="<?= \App\Helpers\Assets::load("libs/jquery/jquery.js") ?>"></script>  
  <script src="<?= \App\Helpers\Assets::load("js/scripts/meeting.js") ?>"></script>  
  <script type="module" src="<?= \App\Helpers\Assets::load("js/pacientes-especialista.js") ?>"></script>
</body>
</html>
