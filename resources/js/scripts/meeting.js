"use strict";
var session;
var __publisher;
initializeSession();

function toggleFullScreen() {
	if (!document.fullscreenElement) {
		document.documentElement.requestFullscreen();
		$("#e-fullscreen-i, #fullscreen-i").toggleClass("d-none")
	} else {
		if (document.exitFullscreen) {
			document.exitFullscreen();
			$("#e-fullscreen-i, #fullscreen-i").toggleClass("d-none")
		}
	}
}

function initializeSession() {
	 session = OT.initSession(apiKey, sessionId);

	session.on('streamCreated', function(event) {
		session.subscribe(event.stream, 'subscriber', {
			insertMode: especialista ? "replace" : "append",
			height: "100%",
			width: "100%",
			preferredFrameRate: 20
		}, handleError);
	});

	const publisherOptions = especialista ? {
		publishVideo:false,
		publishAudio:true,
		height: 100,
		width: 100,
	} : { 
		resolution: '1280x720',
		height: "100%",
		width: "100%",
	};
	__publisher = OT.initPublisher('publisher', publisherOptions, handleError);

	session.connect(token, function(error) {
		if (error) {
			handleError(error); 
		} else {
		  	 session.publish(__publisher, handleError);
		}

	});
} 

function toggleCamera() {
	__publisher.cycleVideo();
}

function disconnectSession() {
	$("#loader").toggle();
	setTimeout(() => {
		if (session) {
 			session.disconnect();
 		}
		const url =  `${Alpine.store('__url')}/${ especialista ? 'esp' : 'urg'}`;
		window.location.replace(url);
	}, 1000);	
}

function handleError(error) {
	if (error) {
		alert(error.message);
	}
}
