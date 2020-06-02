
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/player_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var player;
function onYouTubePlayerAPIReady() {
  player = new YT.Player('ytplayer', {
    height: '100%',
    width: '100%',
    videoId: 'jcg3gezdwbo',
    playerVars: { 'start': 5, 'autoplay': 1, 'controls': 1, 'showinfo': 0, 'rel': 0 },
    events: {
      'onReady': onPlayerReady,
      'onStateChange': onPlayerStateChange,
    }
  });
}