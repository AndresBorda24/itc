import __url from "../extra/api-url.js";

let api;
const loader = $("#loader");

const initIframeAPI = () => {
	const domain = '8x8.vc';
	const options = {
		jwt: jwt,
		lang: 'es',
		width: "100%",
		height: "100%",
		roomName: roomName,
		parentNode: document.querySelector('#meet'),
		configOverwrite: { 
			resolution: 360,
			disablePolls: true,
			disableSelfView: false,
			doNotFlipLocalVideo: true,
			startWithAudioMuted: false,
			hideDominantSpeakerBadge: true,
			prejoinConfig: { enabled: false },
			mouseMoveCallbackInterval: 90000,
			desktopSharingFrameRate: { min: 10, max: 15 },
			toolbarButtons: ['hangup', 'microphone', 'camera', "toggle-camera"], 
			participantsPane: {
				// hideMuteAllButton: true,
				hideMoreActionsButton: true,
			},
		},
		interfaceConfigOverwrite: {
			LANG_DETECTION: false,
			RECENT_LIST_ENABLED: false,
			SHOW_JITSI_WATERMARK: false, 
			DISPLAY_WELCOME_FOOTER: false,
			DISABLE_VIDEO_BACKGROUND: true,
			DISABLE_TRANSCRIPTION_SUBTITLES: true
		}
	};
	api = new JitsiMeetExternalAPI(domain, options);

	api.addListener('videoConferenceLeft', () => {
		loader.show();
		setTimeout(() => {
			const url =  `${__url.substring(0, __url.length - 4)}/${ especialista ? 'esp' : 'urg'}`;
			window.location.replace(url);
		}, 1000);	
	});

	api.addListener('videoConferenceJoined', () => {
		loader.toggle();
	});
}

$(() => {
	loader.toggle();
	initIframeAPI();
});
