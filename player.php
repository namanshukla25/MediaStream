<?php
include 'db.php';

// Get video ID from URL
$video_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if($video_id <= 0) {
    header('Location: index.php');
    exit;
}

// Fetch video details from database
$query = "SELECT * FROM videos WHERE id = $video_id";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit;
}

$video = mysqli_fetch_assoc($result);
$title = htmlspecialchars($video['title']);
$filename = htmlspecialchars($video['filename']);
$video_path = "uploads/" . $filename;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title><?php echo $title; ?> - PrimeStream</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #000000;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Full screen video container */
        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 1;
        }

        /* Custom Video Player */
        .custom-player {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #000;
        }

        video {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #000;
            cursor: pointer;
        }

        /* Controls Overlay - Amazon Prime Style */
        .player-controls {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.95) 0%, rgba(0,0,0,0.7) 60%, transparent 100%);
            padding: 1.5rem 2rem 1.8rem;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            z-index: 20;
        }

        .player-controls.visible {
            transform: translateY(0);
        }

        /* Top bar with title and back button */
        .top-bar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 80%, transparent 100%);
            padding: 1.2rem 2rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            z-index: 20;
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }

        .top-bar.visible {
            transform: translateY(0);
        }

        .back-btn {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(8px);
            border: none;
            color: white;
            font-size: 1.2rem;
            padding: 0.7rem 1.2rem;
            border-radius: 40px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            font-weight: 500;
            text-decoration: none;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.25);
            transform: scale(1.02);
        }

        .video-title-bar {
            font-size: 1.2rem;
            font-weight: 600;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        }

        /* Control buttons layout */
        .control-buttons {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 0.8rem;
            flex-wrap: wrap;
        }

        .control-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.85);
            font-size: 1.3rem;
            cursor: pointer;
            padding: 0.4rem;
            transition: all 0.2s;
            border-radius: 50%;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .control-btn:hover {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: scale(1.05);
        }

        .play-pause-btn {
            font-size: 2rem;
            width: 56px;
            height: 56px;
            background: rgba(0,168,255,0.9);
            color: white;
            border-radius: 50%;
        }

        .play-pause-btn:hover {
            background: #00a8ff;
            transform: scale(1.05);
        }

        /* Progress bar */
        .progress-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 0.5rem 0;
            flex: 1;
        }

        .progress-bar {
            flex: 1;
            height: 5px;
            background: rgba(255,255,255,0.3);
            border-radius: 5px;
            cursor: pointer;
            position: relative;
            transition: height 0.1s;
        }

        .progress-bar:hover {
            height: 8px;
        }

        .progress-filled {
            width: 0%;
            height: 100%;
            background: #00a8ff;
            border-radius: 5px;
            position: relative;
            transition: width 0.1s linear;
        }

        .time-display {
            color: white;
            font-size: 0.85rem;
            font-family: monospace;
            min-width: 100px;
        }

        .volume-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .volume-slider {
            width: 80px;
            height: 4px;
            -webkit-appearance: none;
            background: rgba(255,255,255,0.3);
            border-radius: 5px;
            cursor: pointer;
        }

        .volume-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 12px;
            height: 12px;
            background: #00a8ff;
            border-radius: 50%;
            cursor: pointer;
        }

        .fullscreen-btn {
            font-size: 1.3rem;
        }

        /* Quality & settings */
        .settings-dropdown {
            position: relative;
        }

        .settings-menu {
            position: absolute;
            bottom: 50px;
            right: 0;
            background: rgba(20,20,30,0.95);
            backdrop-filter: blur(12px);
            border-radius: 12px;
            padding: 0.5rem 0;
            min-width: 140px;
            display: none;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .settings-menu.show {
            display: block;
        }

        .settings-menu button {
            width: 100%;
            padding: 0.7rem 1.2rem;
            background: none;
            border: none;
            color: white;
            text-align: left;
            cursor: pointer;
            transition: background 0.2s;
        }

        .settings-menu button:hover {
            background: rgba(0,168,255,0.3);
        }

        /* Loading indicator */
        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            border: 3px solid rgba(255,255,255,0.2);
            border-top-color: #00a8ff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: none;
            z-index: 25;
        }

        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .control-buttons { gap: 0.8rem; }
            .control-btn { width: 36px; height: 36px; font-size: 1rem; }
            .play-pause-btn { width: 48px; height: 48px; font-size: 1.6rem; }
            .top-bar { padding: 0.8rem 1rem; }
            .video-title-bar { font-size: 0.9rem; max-width: 180px; overflow: hidden; text-overflow: ellipsis; }
            .player-controls { padding: 1rem 1rem 1.2rem; }
            .volume-slider { width: 60px; }
        }

        /* Big play center button for initial */
        .big-play {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100px;
            height: 100px;
            background: rgba(0,168,255,0.85);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            cursor: pointer;
            transition: all 0.2s;
            z-index: 15;
            opacity: 0;
            pointer-events: none;
        }

        .big-play.show {
            opacity: 1;
            pointer-events: auto;
        }

        .big-play:hover {
            transform: translate(-50%, -50%) scale(1.1);
            background: #00a8ff;
        }

        /* Auto-play notification badge */
        .autoplay-badge {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgba(0,168,255,0.7);
            backdrop-filter: blur(8px);
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 0.7rem;
            color: white;
            z-index: 30;
            font-weight: 500;
            pointer-events: none;
            animation: fadeOut 3s ease forwards;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            70% { opacity: 1; }
            100% { opacity: 0; visibility: hidden; }
        }
    </style>
</head>
<body>

<div class="video-container">
    <div class="custom-player">
        <video id="mainVideo" src="<?php echo $video_path; ?>" preload="auto" autoplay></video>
        <div class="loading-spinner" id="loadingSpinner"></div>
        <div class="big-play" id="bigPlayBtn">
            <i class="fas fa-play"></i>
        </div>
    </div>
</div>

<!-- Top Bar -->
<div class="top-bar" id="topBar">
    <a href="index.php" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to Library
    </a>
    <div class="video-title-bar">
        <i class="fas fa-film"></i> <?php echo $title; ?>
    </div>
</div>

<!-- Custom Controls -->
<div class="player-controls" id="playerControls">
    <div class="control-buttons">
        <button class="control-btn play-pause-btn" id="playPauseBtn">
            <i class="fas fa-pause"></i>
        </button>
        <button class="control-btn" id="stopBtn">
            <i class="fas fa-stop"></i>
        </button>
        <div class="progress-container">
            <div class="progress-bar" id="progressBar">
                <div class="progress-filled" id="progressFilled"></div>
            </div>
            <div class="time-display" id="timeDisplay">0:00 / 0:00</div>
        </div>
        <div class="volume-container">
            <button class="control-btn" id="volumeBtn">
                <i class="fas fa-volume-up"></i>
            </button>
            <input type="range" class="volume-slider" id="volumeSlider" min="0" max="1" step="0.01" value="0.8">
        </div>
        <div class="settings-dropdown">
            <button class="control-btn" id="settingsBtn">
                <i class="fas fa-cog"></i>
            </button>
            <div class="settings-menu" id="settingsMenu">
                <button id="speed05">0.5x</button>
                <button id="speed075">0.75x</button>
                <button id="speed1">1x (Normal)</button>
                <button id="speed125">1.25x</button>
                <button id="speed15">1.5x</button>
                <button id="speed2">2x</button>
            </div>
        </div>
        <button class="control-btn fullscreen-btn" id="fullscreenBtn">
            <i class="fas fa-expand"></i>
        </button>
    </div>
</div>

<!-- Autoplay notification -->
<div class="autoplay-badge" id="autoplayBadge">
    <i class="fas fa-play-circle"></i> Now Playing • Auto-play
</div>

<script>
    (function() {
        const video = document.getElementById('mainVideo');
        const playPauseBtn = document.getElementById('playPauseBtn');
        const playIcon = playPauseBtn.querySelector('i');
        const stopBtn = document.getElementById('stopBtn');
        const progressBar = document.getElementById('progressBar');
        const progressFilled = document.getElementById('progressFilled');
        const timeDisplay = document.getElementById('timeDisplay');
        const volumeBtn = document.getElementById('volumeBtn');
        const volumeSlider = document.getElementById('volumeSlider');
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        const bigPlayBtn = document.getElementById('bigPlayBtn');
        const loadingSpinner = document.getElementById('loadingSpinner');
        const topBar = document.getElementById('topBar');
        const playerControls = document.getElementById('playerControls');
        const settingsBtn = document.getElementById('settingsBtn');
        const settingsMenu = document.getElementById('settingsMenu');

        let controlsTimeout;
        let isControlsVisible = true;

        function showControls() {
            topBar.classList.add('visible');
            playerControls.classList.add('visible');
            isControlsVisible = true;
            clearTimeout(controlsTimeout);
            controlsTimeout = setTimeout(() => {
                if(video.paused === false) {
                    topBar.classList.remove('visible');
                    playerControls.classList.remove('visible');
                    isControlsVisible = false;
                }
            }, 2500);
        }

        function toggleControls() {
            if(isControlsVisible) {
                topBar.classList.remove('visible');
                playerControls.classList.remove('visible');
                isControlsVisible = false;
            } else {
                showControls();
            }
        }

        // Event listeners for showing controls on mouse move
        document.addEventListener('mousemove', () => {
            if(video.paused === false) showControls();
        });
        video.addEventListener('click', toggleControls);
        
        // Play/Pause
        function updatePlayPauseIcon() {
            if(video.paused) {
                playIcon.className = 'fas fa-play';
                bigPlayBtn.classList.add('show');
            } else {
                playIcon.className = 'fas fa-pause';
                bigPlayBtn.classList.remove('show');
                showControls();
            }
        }
        
        playPauseBtn.addEventListener('click', () => {
            if(video.paused) {
                video.play();
            } else {
                video.pause();
            }
            updatePlayPauseIcon();
        });
        
        bigPlayBtn.addEventListener('click', () => {
            video.play();
            updatePlayPauseIcon();
        });
        
        stopBtn.addEventListener('click', () => {
            video.pause();
            video.currentTime = 0;
            updatePlayPauseIcon();
        });
        
        // Progress bar
        video.addEventListener('timeupdate', () => {
            const percent = (video.currentTime / video.duration) * 100;
            progressFilled.style.width = percent + '%';
            const currentMin = Math.floor(video.currentTime / 60);
            const currentSec = Math.floor(video.currentTime % 60);
            const totalMin = Math.floor(video.duration / 60);
            const totalSec = Math.floor(video.duration % 60);
            timeDisplay.textContent = `${currentMin}:${currentSec.toString().padStart(2,'0')} / ${totalMin}:${totalSec.toString().padStart(2,'0')}`;
        });
        
        progressBar.addEventListener('click', (e) => {
            const rect = progressBar.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width;
            video.currentTime = pos * video.duration;
        });
        
        // Volume
        volumeSlider.addEventListener('input', (e) => {
            video.volume = e.target.value;
            updateVolumeIcon();
        });
        
        function updateVolumeIcon() {
            const volIcon = volumeBtn.querySelector('i');
            if(video.volume === 0) volIcon.className = 'fas fa-volume-mute';
            else if(video.volume < 0.5) volIcon.className = 'fas fa-volume-down';
            else volIcon.className = 'fas fa-volume-up';
        }
        
        volumeBtn.addEventListener('click', () => {
            if(video.volume > 0) {
                video.volume = 0;
                volumeSlider.value = 0;
            } else {
                video.volume = 0.8;
                volumeSlider.value = 0.8;
            }
            updateVolumeIcon();
        });
        
        // Fullscreen
        fullscreenBtn.addEventListener('click', () => {
            if(document.fullscreenElement) {
                document.exitFullscreen();
                fullscreenBtn.querySelector('i').className = 'fas fa-expand';
            } else {
                document.documentElement.requestFullscreen();
                fullscreenBtn.querySelector('i').className = 'fas fa-compress';
            }
        });
        
        document.addEventListener('fullscreenchange', () => {
            if(document.fullscreenElement) {
                fullscreenBtn.querySelector('i').className = 'fas fa-compress';
            } else {
                fullscreenBtn.querySelector('i').className = 'fas fa-expand';
            }
        });
        
        // Playback speed
        const speeds = {
            speed05: 0.5,
            speed075: 0.75,
            speed1: 1,
            speed125: 1.25,
            speed15: 1.5,
            speed2: 2
        };
        
        for(const [id, rate] of Object.entries(speeds)) {
            document.getElementById(id).addEventListener('click', () => {
                video.playbackRate = rate;
                settingsMenu.classList.remove('show');
            });
        }
        
        settingsBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            settingsMenu.classList.toggle('show');
        });
        
        document.addEventListener('click', () => {
            settingsMenu.classList.remove('show');
        });
        
        // Loading indicator
        video.addEventListener('waiting', () => {
            loadingSpinner.style.display = 'block';
        });
        video.addEventListener('canplay', () => {
            loadingSpinner.style.display = 'none';
        });
        
        // Set initial volume
        video.volume = 0.8;
        volumeSlider.value = 0.8;
        updateVolumeIcon();
        
        // AUTO-PLAY: Force play the video as soon as metadata is loaded
        video.addEventListener('loadedmetadata', () => {
            showControls();
            updatePlayPauseIcon();
            // Auto-play promise handling
            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise.then(() => {
                    console.log('Auto-play started successfully');
                    // Auto-play badge will fade out
                }).catch(error => {
                    console.log('Auto-play was prevented:', error);
                    // Still show big play button if autoplay blocked
                    bigPlayBtn.classList.add('show');
                    playIcon.className = 'fas fa-play';
                });
            }
        });
        
        // If video is already loaded and ready (cached case)
        if(video.readyState >= 2) {
            video.play().catch(e => console.log('autoplay issue', e));
        }
        
        // Spacebar to play/pause
        document.addEventListener('keydown', (e) => {
            if(e.code === 'Space') {
                e.preventDefault();
                if(video.paused) video.play();
                else video.pause();
                updatePlayPauseIcon();
            } else if(e.code === 'ArrowLeft') {
                video.currentTime -= 5;
            } else if(e.code === 'ArrowRight') {
                video.currentTime += 5;
            } else if(e.code === 'KeyF') {
                e.preventDefault();
                fullscreenBtn.click();
            }
        });
        
        // Start loading and attempt autoplay immediately
        video.load();
        
        // Remove autoplay badge after animation
        setTimeout(() => {
            const badge = document.getElementById('autoplayBadge');
            if(badge) badge.style.display = 'none';
        }, 3500);
        
        // Add subtle hint that video is playing automatically
        console.log('PrimeStream Player - Auto-play enabled');
    })();
</script>
</body>
</html>