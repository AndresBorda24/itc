"use strict";
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

function handleError(error) {
	if (error) {
		alert(error.message);
	}
}

function initializeSession() {
	var session = OT.initSession(apiKey, sessionId);

	// Subscribe to a newly created stream
	session.on('streamCreated', function(event) {
		session.subscribe(event.stream, 'subscriber', {
			insertMode: especialista ? "replace" : "append",
			height: "100%",
			width: "100%",
			preferredFrameRate: 20
		}, handleError);
	});

	// Create a publisher
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
	var publisher = OT.initPublisher('publisher', publisherOptions, handleError);

	// Connect to the session
	session.connect(token, function(error) {
		// If the connection is successful, initialize a publisher and publish to the session
		if (error) {
		  	handleError(error);
		} else {
		  	__publisher = session.publish(publisher, handleError);
		}

	});
}

function toggleCamera() 
{
	__publisher.cycleVideo();
}

