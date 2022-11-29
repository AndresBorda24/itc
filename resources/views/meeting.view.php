<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require __DIR__ . "/partials/favicons.php" ?>
  <link rel="stylesheet" href="<?= \App\Helpers\Assets::load("libs/bootstrap/css/bootstrap.min.css") ?>">
	<script src='https://8x8.vc/external_api.js'></script>
  <title>Reunion</title>
</head>
<body>
	<main class="container-fluid d-grid vh-100 m-0 p-0 overflow-hidden" style="grid-template-columns: 9fr 3fr; gap: 0;">
		<div class="bg-dark">
			<div id="meet" class="h-100"></div>
		</div>
		<div class="bg-light p-3">
			<div class="w-100" style="height: 50px;">
				<img 
				src="<?= \App\Helpers\Assets::load("images/aso/logo_1.png") ?>" 
				class="h-100 w-100" 
				style="object-fit: contain; object-position: center;">
			</div>
		</div>
	</main>
	<script type="text/javascript">
		const jwt 		 = '<?= $token ?>';
		const roomName = '<?= \App\App::config("jaas")["APP_ID"] ?>/test';
	</script>	
	<script type="text/javascript" src="<?= \App\Helpers\Assets::load('js/meeting/jaasConfig.js')?>"></script>
</body>
</html>