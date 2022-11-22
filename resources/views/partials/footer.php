<footer class="container-fluid bg-dark p-2 d-flex">
    <div class="m-auto">
        <div style="max-height:50px; max-width:150px" class="mx-3">
            <img style="object-fit: contain; object-position: center;" class="w-100 h-100" 
            src="<?= \App\Helpers\Assets::load("images/aso/logo_2.png") ?>" alt="logo-header">
        </div>
        <hr class="border-secondary my-2">
        <span class="d-block small fst-italic" style="color: var(--bs-gray-500);"><?= date("Y") ?> - Modulo Interconsultas</span>
    </div>
</footer>