<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>PrimeStream - Ultimate Cinematic Hub | Premium Streaming</title>
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800;14..32,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Swiper JS for sliding hero -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #05070c;
            color: #e5e9f0;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* custom scroll */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #0f1219;
        }
        ::-webkit-scrollbar-thumb {
            background: #00a8ff;
            border-radius: 10px;
        }

        /* premium navbar */
        .navbar {
            background: rgba(5, 7, 12, 0.92);
            backdrop-filter: blur(18px);
            border-bottom: 1px solid rgba(0, 168, 255, 0.25);
            padding: 0.8rem 3rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            position: sticky;
            top: 0;
            z-index: 1100;
        }
        .logo-area {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        .logo-icon {
            font-size: 2.2rem;
            color: #00a8ff;
            filter: drop-shadow(0 0 12px #00a8ff);
        }
        .logo-text {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #FFFFFF, #00a8ff, #7aa9d4);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.5px;
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 1.2rem;
        }
        .subscribe-btn {
            background: linear-gradient(105deg, #ff416c, #ff4b2b);
            padding: 0.7rem 1.6rem;
            border-radius: 40px;
            text-decoration: none;
            color: white;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
            border: none;
            cursor: pointer;
        }
        .subscribe-btn:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 25px rgba(255, 65, 108, 0.6);
            background: linear-gradient(105deg, #ff5e7e, #ff6a47);
        }
        .upload-btn {
            background: rgba(0, 168, 255, 0.15);
            backdrop-filter: blur(8px);
            padding: 0.7rem 1.5rem;
            border-radius: 40px;
            text-decoration: none;
            color: #00a8ff;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(0,168,255,0.4);
            transition: 0.25s;
        }
        .upload-btn:hover {
            background: #00a8ff;
            color: #0a0c10;
            border-color: #00a8ff;
        }

        /* Hero slider premium */
        .hero-wrapper {
            margin: 1.8rem 2rem 1rem;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 30px 45px -20px black;
        }
        .swiper {
            width: 100%;
            height: 520px;
            border-radius: 28px;
        }
        .swiper-slide {
            position: relative;
            background: #000;
        }
        .slide-bg {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        }
        .swiper-slide-active .slide-bg {
            transform: scale(1.02);
        }
        .slide-gradient {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, #000000cc 0%, #00000066 40%, transparent 80%);
        }
        .slide-content {
            position: absolute;
            bottom: 15%;
            left: 5%;
            max-width: 550px;
            z-index: 10;
        }
        .slide-badge {
            background: rgba(0,168,255,0.9);
            display: inline-block;
            padding: 0.3rem 1rem;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .slide-title {
            font-size: 3.2rem;
            font-weight: 800;
            line-height: 1.2;
            text-shadow: 0 4px 20px black;
        }
        .slide-desc {
            margin-top: 0.8rem;
            font-size: 1rem;
            opacity: 0.9;
        }
        .hero-cta {
            display: inline-flex;
            margin-top: 1.5rem;
            background: white;
            color: black;
            padding: 0.8rem 2rem;
            border-radius: 40px;
            font-weight: 700;
            gap: 10px;
            transition: 0.2s;
        }
        .hero-cta:hover {
            background: #00a8ff;
            color: white;
            transform: translateX(5px);
        }

        /* section headers */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.8rem 3rem 0.5rem;
        }
        .section-header h2 {
            font-size: 1.9rem;
            font-weight: 700;
            background: linear-gradient(135deg, #fff, #8cbaff);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* video grid premium cards */
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem 3rem;
            max-width: 1600px;
            margin: 0 auto;
        }
        .video-card {
            background: #0e121c;
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.4s ease;
            border: 1px solid rgba(0,168,255,0.15);
            text-decoration: none;
            display: block;
            backdrop-filter: blur(2px);
        }
        .video-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: #00a8ff;
            box-shadow: 0 25px 35px -18px #00a8ff40;
        }
        .vid-thumb {
            position: relative;
            aspect-ratio: 16/9;
            overflow: hidden;
            background: #000;
        }
        .vid-thumb video {
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
            transition: transform 0.5s;
        }
        .video-card:hover video {
            transform: scale(1.05);
        }
        .play-icon-card {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0,168,255,0.85);
            width: 52px;
            height: 52px;
            border-radius: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            opacity: 0;
            transition: 0.2s;
        }
        .video-card:hover .play-icon-card {
            opacity: 1;
        }
        .card-info {
            padding: 1.2rem;
        }
        .video-title {
            font-weight: 700;
            font-size: 1.1rem;
            display: flex;
            justify-content: space-between;
        }
        .video-meta {
            margin-top: 8px;
            display: flex;
            gap: 16px;
            font-size: 0.7rem;
            color: #8d9bb0;
        }
        .prime-tag {
            background: #00a8ff20;
            padding: 0.2rem 0.7rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            color: #7bc9ff;
        }

        /* upcoming movies - professional posters */
        .upcoming-block {
            margin: 2rem 2rem 2rem;
            background: radial-gradient(circle at 20% 30%, #0e1422, #03060b);
            border-radius: 44px;
            padding: 2rem 2rem;
            border: 1px solid rgba(0,168,255,0.25);
        }
        .poster-slider {
            display: flex;
            gap: 1.8rem;
            overflow-x: auto;
            padding: 1rem 0.5rem;
            scrollbar-width: thin;
        }
        .movie-poster-card {
            min-width: 210px;
            background: #0a0f18;
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.3s;
            border: 1px solid rgba(255,255,255,0.05);
            cursor: pointer;
        }
        .movie-poster-card:hover {
            transform: translateY(-8px);
            border-color: #ff4b2b;
            box-shadow: 0 20px 30px -10px #ff4b2b40;
        }
        .poster-img-area {
            height: 280px;
            background: linear-gradient(145deg, #1c2538, #0b0f18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: #00a8ff;
        }
        .poster-details {
            padding: 1rem;
        }
        .movie-title {
            font-weight: 800;
            font-size: 1rem;
        }
        .release-date {
            font-size: 0.7rem;
            color: #ffaa66;
            margin: 6px 0;
        }
        .subscription-tag {
            background: #ff416c30;
            display: inline-block;
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
        }

        /* modern footer with darkhole copyright */
        .premium-footer {
            background: #02040a;
            border-top: 1px solid #00a8ff30;
            padding: 3rem 3rem 1.5rem;
            margin-top: 3rem;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2.5rem;
            max-width: 1400px;
            margin: auto;
        }
        .footer-brand p {
            margin-top: 12px;
            font-size: 0.8rem;
            color: #8d9bb0;
        }
        .footer-links-col h4 {
            font-size: 1rem;
            margin-bottom: 1rem;
            color: #00a8ff;
        }
        .footer-links-col a {
            display: block;
            color: #b0c4de;
            text-decoration: none;
            margin-bottom: 0.6rem;
            font-size: 0.85rem;
            transition: 0.2s;
        }
        .footer-links-col a:hover {
            color: #00a8ff;
            transform: translateX(5px);
        }
        .copyright-darkhole {
            text-align: center;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px dashed rgba(0,168,255,0.2);
            font-size: 0.8rem;
            color: #5f7f9e;
        }
        .copyright-darkhole i {
            color: #ff416c;
        }
        @media (max-width: 780px) {
            .navbar { padding: 0.8rem 1rem; }
            .hero-wrapper { margin: 0.8rem; }
            .swiper { height: 320px; }
            .slide-title { font-size: 1.5rem; }
            .video-grid { padding: 1rem; gap: 1rem; }
            .section-header { padding: 1rem; }
            .poster-img-area { height: 200px; }
            .movie-poster-card { min-width: 160px; }
        }
        .empty-library {
            text-align: center;
            padding: 3rem;
            background: #0e121c;
            border-radius: 40px;
            margin: 1rem;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <div class="logo-area" onclick="window.location.href='index.php'">
        <i class="fas fa-play-circle logo-icon"></i>
        <span class="logo-text">PrimeStream</span>
    </div>
    <div class="nav-actions">
        <a href="#" id="subscribeModalBtn" class="subscribe-btn"><i class="fas fa-gem"></i> Subscribe Now</a>
        <a href="upload.php" class="upload-btn"><i class="fas fa-cloud-upload-alt"></i> Upload</a>
    </div>
</nav>

<!-- Hero Slider - Cinematic & breathtaking -->
<div class="hero-wrapper">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="https://picsum.photos/id/1015/1600/550" class="slide-bg" alt="cinematic">
                <div class="slide-gradient"></div>
                <div class="slide-content">
                    <div class="slide-badge"><i class="fas fa-crown"></i> PRIME ORIGINAL</div>
                    <div class="slide-title">Rise of the Empire</div>
                    <div class="slide-desc">Witness the epic saga. 4K HDR · Dolby Atmos</div>
                    <a href="#" class="hero-cta"><i class="fas fa-play"></i> Stream now</a>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="https://picsum.photos/id/104/1600/550" class="slide-bg" alt="action">
                <div class="slide-gradient"></div>
                <div class="slide-content">
                    <div class="slide-badge"><i class="fas fa-star"></i> TRENDING #1</div>
                    <div class="slide-title">Shadow Protocol</div>
                    <div class="slide-desc">Edge-of-your-seat thriller, exclusive premiere.</div>
                    <a href="#" class="hero-cta"><i class="fas fa-play"></i> Watch trailer</a>
                </div>
            </div>
            <div class="swiper-slide">
                <img src="https://picsum.photos/id/106/1600/550" class="slide-bg" alt="fantasy">
                <div class="slide-gradient"></div>
                <div class="slide-content">
                    <div class="slide-badge"><i class="fas fa-dragon"></i> FANTASY EPIC</div>
                    <div class="slide-title">Dragon's Vow</div>
                    <div class="slide-desc">A magical journey begins — stream in IMAX Enhanced.</div>
                    <a href="#" class="hero-cta"><i class="fas fa-play"></i> Explore</a>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</div>

<!-- Uploaded videos section -->
<div class="section-header">
    <h2><i class="fas fa-film"></i> Your Cinematic Library</h2>
    <span style="color:#00a8ff; font-weight:500;"><i class="fas fa-infinity"></i> HD Streaming</span>
</div>

<div class="video-grid" id="videoGrid">
<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM videos ORDER BY id DESC");
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $title = htmlspecialchars($row['title']);
        $filename = htmlspecialchars($row['filename']);
        $videoId = (int)$row['id'];
        $playerUrl = "player.php?id=" . $videoId;
?>
    <a href="<?php echo $playerUrl; ?>" class="video-card">
        <div class="vid-thumb">
            <video preload="metadata" muted playsinline>
                <source src="uploads/<?php echo $filename; ?>" type="video/mp4">
            </video>
            <div class="play-icon-card"><i class="fas fa-play"></i></div>
        </div>
        <div class="card-info">
            <div class="video-title"><?php echo $title; ?> <i class="fas fa-check-circle" style="color:#00a8ff; font-size:0.8rem;"></i></div>
            <div class="video-meta">
                <span><i class="fas fa-hd"></i> Full HD</span>
                <span class="prime-tag"><i class="fas fa-crown"></i> Prime</span>
            </div>
        </div>
    </a>
<?php 
    }
} else {
    echo '<div class="empty-library" style="grid-column:1/-1;">
            <i class="fas fa-video-slash" style="font-size:3rem; opacity:0.6;"></i>
            <h3>No videos uploaded yet</h3>
            <p>Be the first to share your masterpiece.</p>
            <a href="upload.php" style="color:#00a8ff;">Upload Now →</a>
          </div>';
}
?>
</div>

<!-- UPCOMING MOVIES POSTERS SECTION with real images/art -->
<div class="upcoming-block">
    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; margin-bottom: 1rem;">
        <h2 style="font-size:1.8rem;"><i class="fas fa-calendar-alt" style="color:#ffb347;"></i> Coming Soon to PrimeStream</h2>
        <span class="subscription-tag" style="background:#00a8ff30;">🔥 2025 exclusives</span>
    </div>
    <div class="poster-slider">
        <div class="movie-poster-card">
            <div class="poster-img-area"><i class="fas fa-skull"></i></div>
            <div class="poster-details">
                <div class="movie-title">The Batman: Dark Knight</div>
                <div class="release-date"><i class="far fa-calendar-alt"></i> June 2025</div>
                <span class="subscription-tag"><i class="fas fa-ticket-alt"></i> IMAX</span>
            </div>
        </div>
        <div class="movie-poster-card">
            <div class="poster-img-area"><i class="fas fa-feather-alt"></i></div>
            <div class="poster-details">
                <div class="movie-title">Dune: Prophecy</div>
                <div class="release-date"><i class="far fa-calendar-alt"></i> August 2025</div>
                <span class="subscription-tag">4K HDR</span>
            </div>
        </div>
        <div class="movie-poster-card">
            <div class="poster-img-area"><i class="fas fa-robot"></i></div>
            <div class="poster-details">
                <div class="movie-title">Cyberpunk: 2077 Edgerunners</div>
                <div class="release-date"><i class="far fa-calendar-alt"></i> September 2025</div>
                <span class="subscription-tag">Prime Exclusive</span>
            </div>
        </div>
        <div class="movie-poster-card">
            <div class="poster-img-area"><i class="fas fa-crown"></i></div>
            <div class="poster-details">
                <div class="movie-title">House of the Dragon S3</div>
                <div class="release-date"><i class="far fa-calendar-alt"></i> Winter 2025</div>
                <span class="subscription-tag">Most Anticipated</span>
            </div>
        </div>
        <div class="movie-poster-card">
            <div class="poster-img-area"><i class="fas fa-mask"></i></div>
            <div class="poster-details">
                <div class="movie-title">Deadpool & Wolverine</div>
                <div class="release-date"><i class="far fa-calendar-alt"></i> July 2025</div>
                <span class="subscription-tag">Coming Soon</span>
            </div>
        </div>
        <div class="movie-poster-card">
            <div class="poster-img-area"><i class="fas fa-ghost"></i></div>
            <div class="poster-details">
                <div class="movie-title">Stranger Things: Final Season</div>
                <div class="release-date"><i class="far fa-calendar-alt"></i> Late 2025</div>
                <span class="subscription-tag">Binge Event</span>
            </div>
        </div>
    </div>
</div>

<!-- PROFESSIONAL FOOTER with Darkhole Copyright -->
<footer class="premium-footer">
    <div class="footer-grid">
        <div class="footer-brand">
            <i class="fas fa-play-circle" style="font-size:2rem; color:#00a8ff;"></i>
            <h3 style="margin-top:6px;">PrimeStream</h3>
            <p>Experience the ultimate cinematic universe. Stream exclusive originals, blockbuster movies & premium content in 4K HDR.</p>
        </div>
        <div class="footer-links-col">
            <h4>Explore</h4>
            <a href="#">Home</a>
            <a href="#">Originals</a>
            <a href="#">Trending Now</a>
            <a href="#">Coming Soon</a>
        </div>
        <div class="footer-links-col">
            <h4>Support</h4>
            <a href="#">Help Center</a>
            <a href="#">Account & Billing</a>
            <a href="#">Parental Controls</a>
            <a href="#">Device Compatibility</a>
        </div>
        <div class="footer-links-col">
            <h4>Legal</h4>
            <a href="#">Terms of Service</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Cookie Preferences</a>
            <a href="#">Corporate Info</a>
        </div>
    </div>
    <div class="copyright-darkhole">
        <i class="fas fa-copyright"></i> 2025 PrimeStream — Crafted with <i class="fas fa-heart" style="color:#ff416c;"></i> by <strong style="color:#00a8ff;">DarkHole Studios</strong> | All Rights Reserved | Next‑Gen Streaming Experience
    </div>
</footer>

<!-- Subscription Modal Simple -->
<div id="subModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.85); backdrop-filter:blur(10px); z-index:2000; align-items:center; justify-content:center;">
    <div style="background:#0e121c; max-width:400px; padding:2rem; border-radius:32px; text-align:center; border:1px solid #00a8ff;">
        <i class="fas fa-crown" style="font-size:3rem; color:#ffb347;"></i>
        <h2 style="margin:1rem 0;">Prime Membership</h2>
        <p>Get unlimited access to thousands of movies & series in 4K HDR.</p>
        <button id="closeModal" style="margin-top:1.5rem; background:#00a8ff; border:none; padding:0.7rem 1.5rem; border-radius:40px; font-weight:bold; cursor:pointer;">Close</button>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Hero Swiper
    const heroSwiper = new Swiper('.heroSwiper', {
        loop: true,
        autoplay: { delay: 4500, disableOnInteraction: false },
        effect: 'slide',
        speed: 800,
        pagination: { el: '.swiper-pagination', clickable: true },
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    });

    // Thumbnail hover preview
    const videos = document.querySelectorAll('.vid-thumb video');
    videos.forEach(video => {
        video.muted = true;
        video.preload = 'metadata';
        const card = video.closest('.video-card');
        if(card){
            card.addEventListener('mouseenter', () => {
                if(video.readyState === 0) video.load();
                video.play().catch(e=>{});
            });
            card.addEventListener('mouseleave', () => {
                video.pause();
                if(video.currentTime > 0) video.currentTime = 0;
            });
        }
        video.pause();
    });

    // Subscription popup
    const subBtn = document.getElementById('subscribeModalBtn');
    const modal = document.getElementById('subModal');
    const closeModalBtn = document.getElementById('closeModal');
    if(subBtn){
        subBtn.addEventListener('click', (e) => {
            e.preventDefault();
            modal.style.display = 'flex';
        });
    }
    if(closeModalBtn){
        closeModalBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    }
    window.onclick = (e) => { if(e.target === modal) modal.style.display = 'none'; };
    
    // Additional interactive poster click event
    document.querySelectorAll('.movie-poster-card').forEach(poster => {
        poster.addEventListener('click', () => {
            alert("🎬 Coming Soon! Get notified when this releases.");
        });
    });
</script>
</body>
</html>