"use strict";
const loader = $("#loader");
var session;
var __publisher;
var __control = {
	"audio": true,
	"video": false,
	"fullscreen": false 
};

loader.toggle();
initializeSession();

function toggleFullScreen() {
	if (!document.fullscreenElement) {
		document.documentElement.requestFullscreen();
		$("#fullscreen").toggleClass("bi-fullscreen bi-fullscreen-exit");
	} else {
		if (document.exitFullscreen) {
			document.exitFullscreen();
			$("#fullscreen").toggleClass("bi-fullscreen bi-fullscreen-exit");
		}
	}
}

function initializeSession() {
	 session = OT.initSession(apiKey, sessionId);

	session.on('streamCreated', function(event) {
		session.subscribe(event.stream, 'sub', {
			width: "100%",
			height: "100%",
			insertMode: "append",
			preferredFrameRate: 20
		}, handleError);
	});

	session.on('streamPropertyChanged ', function(event) {
		$("#loader").hide();
	});

	const publisherOptions = { 
		mirror: false,
		width: "100px",
		height: "100px",
		publishAudio:true,
		publishVideo:false,
		showControls: false,
		insertMode: "append",
		resolution: '1280x720',
		preferredFrameRate: 20
	};
	__publisher = OT.initPublisher('publisher', publisherOptions, handleError);
	__publisher.on('streamCreated', () => loader.hide());

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

function toggleVideo() {
	$("#loader").toggle();
	__control.video = !__control.video;
	if (__control.video) {
		__publisher.element.style.width = "200px";
		__publisher.element.style.height = "200px";
	} else {
		__publisher.element.style.width = "100px";
		__publisher.element.style.height = "100px";
	}
	__publisher.publishVideo( __control.video ); 
}

function toggleAudio() {
	$("#loader").toggle();
	__control.audio = !__control.audio;
	__publisher.publishAudio( __control.audio ); 
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
