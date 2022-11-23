<div x-data="selectEspecialidad(<?= htmlspecialchars(json_encode($especialidades)) ?>)">
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