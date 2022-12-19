<div class="position-absolute bottom-0 mb-1 start-50 translate-middle-x bg-black overflow-hidden rounded d-flex" id="button-container" style="z-index: 1; gap: 2px;">
  <!-- Desconectar -->
  <button class="op-button p-2 px-3 rounded-0 border-0 bg-danger" onclick="disconnectSession()">
    <i class="bi bi-telephone-x-fill"></i>
  </button>
  
  <!-- Pantalla Completa -->
  <button class="op-button p-2 px-3 rounded-0 border-0" onclick="toggleFullScreen()">
    <i class="bi bi-fullscreen" id="fullscreen"></i>
  </button>
  
  <!-- Camara -->
  <button class="op-button p-2 px-3 rounded-0 border-0" onclick="toggleCamera()">
    <img height="20" width="20" src="<?= \App\Helpers\Assets::load('images/icons/flip-camera.png') ?>" style="filter: invert(1)">
  </button>
  
  <!-- Iniciar / Detener video -->
  <button x-data="{ active: __control.video }" 
  class="op-button p-2 px-3 rounded-0 border-0" 
  @click="() => { toggleVideo(); active = !active }" 
  :class="{'op-button-active': active}">
    <i class="bi" :class="{'bi-camera-video-off-fill': !active, 'bi-camera-video-fill': active }"></i>
  </button>
  
  <!-- Iniciar / Detener Audio -->
  <button x-data="{ active: __control.audio }" 
  class="op-button p-2 px-3 rounded-0 border-0" 
  @click="() => { toggleAudio(); active = !active }" 
  :class="{'op-button-active': active}">
    <i class="bi" :class="{'bi-mic-mute-fill': !active, 'bi-mic-fill': active }"></i>
  </button>
</div>
