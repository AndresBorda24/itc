<div 
  id="mostrar-pacientes"
  x-data="pacientes('<?= strtoupper($especialidad ) ?>')"
  class="fixed-top bg-black bg-opacity-50 vh-100 vw-100" style="display: none;">
  <template x-teleport="#button-container">
    <button class="btn btn-sm p-2 pt-1 btn-warning" @click="manageShow()">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
        <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
      </svg>
    </button>
  </template>

  <button class="btn btn-sm btn-close position-fixed fs-4 bg-light top-0 start-0 m-3" @click="manageShow()"></button>
  <div class="d-block h-100 bg-light p-3 ms-auto overflow-auto" style="width: 95%; max-width: 500px">
    <div class="p-2 mb-4 rounded text-light bg-dark shadow sticky-top">
      <h3 class="text-center">Listado de Pacientes</h3>
      <div class="form-check">
        <input class="form-check-input" x-model="onlyPend" type="checkbox" id="show-solo-pendientes">
        <label class="form-check-label small fst-italic" for="show-solo-pendientes">Solo Pendientes</label>
      </div>
    </div>

    <template x-for="int in manageSort($store._interconsultas)" :key="int.id">
      <div x-data="{ state: int, _estado: int.estado+'' }">
        <!--
         Radio Inputs de los estados 
        -->
        <div class="d-flex rounded border px-sm-4 justify-content-between p-2 flex-wrap small">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" value="REVISADO" @input="_estado = $el.value" x-model.debounce.400ms="state.estado" :name="`${state.id}`" :id="`rev-${state.id}`">
            <label class="form-check-label small" :for="`rev-${state.id}`">REVISADO</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" value="PENDIENTE" @input="_estado = $el.value" x-model.debounce.400ms="state.estado" :name="`${state.id}`" :id="`pen-${state.id}`">
            <label class="form-check-label small" :for="`pen-${state.id}`">PENDIENTE</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" value="CANCELADO" @input="_estado = $el.value" x-model.debounce.400ms="state.estado" :name="`${state.id}`" :id="`can-${state.id}`">
            <label class="form-check-label small" :for="`can-${state.id}`">CANCELADO</label>
          </div>
        </div>
        <div :class="{ 'text-muted bg-secondary text-decoration-line-through bg-opacity-10': _estado != 'PENDIENTE' }"
          class="border rounded mt-1 small mb-4 shadow user-select-none p-3" >
          <span class="small d-block">Paciente:</span>
          <span class="fw-semibold" x-text="int.paciente.nombre"></span>
          <span class="small d-block mt-2">Edad:</span>
          <span class="fw-semibold" x-text="int.paciente.edad"></span> A&ntilde;os
          <hr class="my-2">
          <span class="fw-semibold">Observaci&oacute;n:</span><br>
          <span x-text="int.observacion" style="white-space: pre-line;"></span>
          <template x-if="state.estado != 'PENDIENTE'">
           <div>
            <hr>
            <span class="small d-block mt-2">Resuelto en:</span>
            <span x-text="today" style="white-space: pre-line;"></span>
           </div> 
          </template>
        </div>
      </div>
    </template>
  </div>
</div>