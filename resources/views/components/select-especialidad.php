<div x-data="selectEspecialidad(<?= htmlspecialchars(json_encode($especialidades)) ?>)">
  <template x-teleport="#button-container">
    <a :href="'<?= \App\App::config("project_path") ?>' + `/esp/reunion/${esp.toLowerCase()}`" class="btn btn-sm btn-dark m-2">Ir a la reunion</a>
  </template>
  <div class="mb-3 small">
    <label for="select-especialidad" class="form-label">Especialidad</label>
    <select x-model="esp"
      class="form-select form-select-sm text-muted" name="select-especialidad" id="select-especialidad">
      <?php foreach($especialidades as $cod => $nombre): ?>
        <option value="<?= $cod ?>"><?= $nombre ?></option>
      <?php endforeach; ?>
    </select>
  </div>
</div>