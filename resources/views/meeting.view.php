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
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
	</main>
	<script type="text/javascript">
	  let api;

	  const initIframeAPI = () => {
	    const domain = '8x8.vc';
	    const options = {
	      roomName: '<?= \App\App::config("jaas")["APP_ID"] ?>/test',
	      jwt: '<?= $token ?>',
	      width: "100%",
	      height: "100%",
	      parentNode: document.querySelector('#meet'),
	      lang: 'es',
	      configOverwrite: { 
	      	toolbarButtons: ['hangup', 'microphone', 'camera', "toggle-camera"], 
	      	disableLocalVideoFlip: false,
	      	doNotFlipLocalVideo: true,
    	    // Disables polls feature.
			    disablePolls: true,
			    // Disables self-view settings in UI
			    disableSelfViewSettings: true,
	      	disableSimulcast: true,
	      	resolution: 480,
	      	desktopSharingFrameRate: {
				    min: 15,
				    max: 20
					},
	      	participantsPane: {
					    hideModeratorSettingsTab: true,
					    hideMoreActionsButton: true,
					    hideMuteAllButton: true
					},
	      	prejoinConfig: {
	      		enabled: false,
	      	},
				  /**
			     * Default interval (milliseconds) for triggering mouseMoved iframe API event
			     */
			    mouseMoveCallbackInterval: 90000,
	      },
	      interfaceConfigOverwrite: {
	      	DISABLE_VIDEO_BACKGROUND: true,
	      	DISPLAY_WELCOME_FOOTER: false,
	      	LANG_DETECTION: false,
	      	SHOW_JITSI_WATERMARK: false, 
					RECENT_LIST_ENABLED: true,
					DISABLE_TRANSCRIPTION_SUBTITLES: true
	      }

	    };
	    api = new JitsiMeetExternalAPI(domain, options);
	  }

	  window.onload = () => {
	    initIframeAPI();
	  }
	</script>	
</body>
</html>