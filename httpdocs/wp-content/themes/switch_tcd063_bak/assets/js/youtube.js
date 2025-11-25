'use strict';

var youtube = [];

var headerYouTubePlayer = document.getElementById('js-header-youtube__player');
var footerLinkYouTube = document.getElementById('js-footer-link__youtube');

if (headerYouTubePlayer) {
  youtube.push({
    id: headerYouTubePlayer.id,
    videoId: headerYouTubePlayer.dataset.videoId,
    player: ''
  });
}

if (footerLinkYouTube) {
  youtube.push({
    id: footerLinkYouTube.id,
    videoId: footerLinkYouTube.dataset.videoId,
    height: 500,
    player: ''
  });
}

if (youtube.length) {

  // This code loads the IFrame Player API code asynchronously
  var tag = document.createElement('script');
  tag.src = 'https://www.youtube.com/iframe_api';

  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}

// This function creates an <iframe> (and YouTube player)
// after the API code downloads
function onYouTubeIframeAPIReady() {

  youtube.forEach(function (element, index, array) {

    var settings = {
      videoId: element.videoId,
      playerVars: {
        controls: 0,
        loop: 1,
        playlist: element.videoId,
        rel: 0,
        showinfo: 0
      },
      events: {
        'onReady': onPlayerReady
      }
    };

    if (element.height) {
      settings.height = element.height + 'px';
    }

    element.player = new YT.Player(element.id, settings);
  });
}

// The API will call this function when the video player is ready.
function onPlayerReady(e) {
  e.target.mute();
  e.target.playVideo();
}