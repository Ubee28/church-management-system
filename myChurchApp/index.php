<?php 
session_start();
require_once "classes/Member.php";


include_once "partials/header.php";
    $member = new Member;
?>

    <!-- Intro Video Section -->
    <div class="row ml-0">
        <div class="col-12 video-section">
            <video src="assets/images/video/church_vid.mp4" autoplay muted loop></video>
        </div>
    </div>
    
<!-- Latest Sermons Section (YouTube Embedded Videos) -->
<div class="container-fluid mt-5">
    <h3 class="text-center">Latest Sermons</h3>

    <?php
    // Include Sermon class and fetch carousel sermons
        require_once('classes/Sermon.php');
        $sermon = new Sermon();
        $carousel_sermons = $sermon->getCarouselSermons(); // Fetch sermons marked for the carousel
        // print_r($carousel_sermons);

    if (!empty($carousel_sermons)) {
    ?>
<div id="latestSermonYouTubeCarousel" class="carousel slide" data-bs-interval="false">
    <div class="carousel-inner">
        <?php
        $isActive = 'active'; // Set the first carousel item as active
        foreach ($carousel_sermons as $sermon) {
        ?>
            <div class="carousel-item <?php echo $isActive; ?>">
                <div class="d-flex justify-content-center">
                    <!-- Dynamically embedded YouTube video -->
                    <iframe width="640" height="360" src="<?php echo $sermon['sermon_video']; ?>" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        <?php
            $isActive = ''; // Only the first item should be active
        }
        ?>
    </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#latestSermonYouTubeCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#latestSermonYouTubeCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <?php
    } else {
        echo '<p class="text-center">No sermons available for the carousel.</p>';
    }
    ?>

    <div class="d-flex justify-content-center">
        <a href="sermon_archives.php" class="btn btn-primary mt-2">Sermon Archives</a>
    </div>
</div>




  <!-- Upcoming Events Section -->
<div class="container-fluid mt-5">
    <h3 class="text-center">Upcoming Events</h3>

    <?php
    // Include Event class and fetch carousel events
    require_once('classes/Event.php');
    $event = new Event();
    $carousel_events = $event->getCarouselEvents(); // Fetch events marked for the carousel

    if (!empty($carousel_events)) {
    ?>
    <div id="upcomingEventsCarousel" class="carousel slide" data-bs-interval="false">
        <div class="carousel-inner">
            <?php
            $isActive = 'active'; // Set the first carousel item as active
            foreach ($carousel_events as $event) {
            ?>
                <div class="carousel-item <?php echo $isActive; ?>">
                    <div class="d-flex justify-content-center">
                        <!-- Dynamically displayed event flier -->
                        <img src="<?php echo htmlspecialchars($event['event_flier']); ?>" class="d-block" alt="<?php echo htmlspecialchars($event['event_name']); ?>" style="max-width: 100%; height: auto;">
                    </div>
                </div>
            <?php
                $isActive = ''; // Only the first item should be active
            }
            ?>
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#upcomingEventsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#upcomingEventsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php
    } else {
        echo '<p class="text-center">No upcoming events available for the carousel.</p>';
    }
    ?>

    <div class="d-flex justify-content-center">
        <a href="event_archives.php" class="btn btn-primary mt-2">Event Archives</a>
    </div>
</div>


    
    <!-- Blog Posts Section -->
    <div class="full-width-background mt-5">
        <div class="container card-container">
            <h5 class="mt-4" style="color:rgb(214, 222, 231); font-family: proxima-nova, muli, 'Trebuchet MS', Raleway, sans-serif;">KEEP UP TO DATE</h5>
            <h3>Latest Blog Posts</h3>
            <div class="row">
                <div class="col-md-4 d-flex align-items-stretch mb-4">
                    <div class="card" style="width: 100%;">
                        <img src="uploads/fliers/blog1.jpg" class="card-img-top" alt="Not found">
                        <div class="card-body">
                            <h5>What is Caesar's work?</h5>
                            <p class="card-text">That is what Caesar's duty is. It's a very hard job, so hard that God permitted them to punish, and even sometimes kill, people who oppose them. 
                            That's how hard civil authority is. When...</p>
                            <a href="blogpost/blog1.php" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 d-flex align-items-stretch mb-4">
                    <div class="card" style="width: 100%;">
                        <img src="uploads/fliers/blog1.jpg" class="card-img-top" alt="Not found">
                        <div class="card-body">
                            <h5>What is Caesar's work?</h5>
                            <p class="card-text">That is what Caesar's duty is. It's a very hard job, so hard that God permitted them to punish, and even sometimes kill, people who oppose them. 
                            That's how hard civil authority is. When...</p>
                            <a href="blogpost/blog1.php" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 d-flex align-items-stretch mb-4">
                    <div class="card" style="width: 100%;">
                        <img src="uploads/fliers/blog1.jpg" class="card-img-top" alt="Not found">
                        <div class="card-body">
                            <h5>What is Caesar's work?</h5>
                            <p class="card-text">That is what Caesar's duty is. It's a very hard job, so hard that God permitted them to punish, and even sometimes kill, people who oppose them. 
                            That's how hard civil authority is. When...</p>
                            <a href="blogpost/blog1.php" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- footer -->
    <footer class="site-footer">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="widget">
								<h3 class="widget-title">Our address</h3>
                                <p>Remnant Christian Centre is conveniently located at the heart of the city, making it easily accessible for everyone. Situated near major roads and public transport, our church is just a short distance from key neighborhoods and community hubs. Whether you're driving or using public transport, you’ll find our location both welcoming and convenient, ensuring that you can join us for worship, events, and community activities with ease.</p>
								<ul class="address">
									<li><i class="fa fa-map-marker"></i> 329 Church St, Garland, TX 75042</li>
									<li><i class="fa fa-phone"></i> (425) 853 442 552</li>
									<li><i class="fa fa-envelope"></i> info@yourchurch.com</li>
								</ul>
							</div>
						</div>
						<div class="col-md-4">
							<div class="widget">
								<h3 class="widget-title">Topics from last meeting</h3>
								<ul class="bullet">
									<li><a href="#">Faith in Uncertainty: Exploring how to trust God during challenging and uncertain times.</a></li>
									<li><a href="#">The Power of Forgiveness: Understanding the importance of forgiving others and ourselves in our spiritual journey</a></li>
									<li><a href="#">Living with Purpose: Discovering God's purpose for our lives and how to align our actions with that calling.</a></li> 
									<li><a href="#">Joy in Service: The blessings of serving others and how acts of kindness reflect God's love.</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-4">
							<div class="widget">
								<h3 class="widget-title">Contact form</h3>
								<form action="#" class="contact-form">
									<div class="row">
										<div class="col-md-6"><input type="text" placeholder="Your name..."></div>
										<div class="col-md-6"><input type="text" placeholder="Email..."></div>
									</div>
									
									<textarea name="" placeholder="Your message..."></textarea>
									<div class="text-right"><input type="submit" value="Send message"></div>
									
								</form>
							</div>
						</div>
					</div> <!-- .row -->

					<p class="colophon">Copyright 2014 RCM Church. All rights reserved.</p>
				</div><!-- .container -->
			</footer> <!-- .site-footer -->

<?php
     include_once "partials/footer.php";
?>
