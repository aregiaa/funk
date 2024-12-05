document.addEventListener("DOMContentLoaded", function() {
    const radios = document.querySelectorAll('input[name="slider"]');
    const videos = [
        document.getElementById("video1"),
        document.getElementById("video2"),
        document.getElementById("video3")
    ];

    // Function to stop all videos
    function stopAllVideos() {
        videos.forEach((video) => {
            const player = new YT.Player(video.id);
            player.stopVideo();
        });
    }

    // Add event listener to radio buttons to control which video plays
    radios.forEach((radio, index) => {
        radio.addEventListener('change', () => {
            stopAllVideos();
            const player = new YT.Player(videos[index].id);
            player.playVideo();  // Play the selected video
        });
    });
});
