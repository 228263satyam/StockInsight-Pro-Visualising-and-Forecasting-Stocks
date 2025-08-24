<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockInsight Pro - Home</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="logo.png" alt="StockInsight Pro Logo">
                <h1>StockInsight Pro</h1>
            </div>
            <nav>
                <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li><a href="http://localhost:8501/">Market Analysis</a></li>
                <li><a href="forecasting.html">Forecasting</a></li>
                <li><a href="about_us.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>

                <?php if (isset($_SESSION['username'])) : ?>
                    <li>
                        
                        <a href="user_dashboard.php">Profile</a>
                    </li>
                <?php else : ?>
                    <li><a href="log_in.php">Login</a></li>
                <?php endif; ?>
                </ul>
            </nav>
            <div class="hamburger">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h2>Your Investment Decisions with Real-Time Data</h2>
            <p>Explore comprehensive stock market insights and accurate forecasts powered by AI.</p><br>
            <div class="cta-buttons">
                <a href="dashboard.html" class="cta">Get Started</a>
                <a href="learn.html" class="cta secondary">Learn More</a>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2>Key Features</h2>
            <div class="features-grid">
                <div class="feature">
                    <i class="fas fa-chart-line"></i>
                    <h3>Interactive Stock Charts</h3>
                    <p>Real-time data visualization with customizable charts.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-brain"></i>
                    <h3>AI-Powered Forecasting</h3>
                    <p>Predictive analytics based on machine learning algorithms.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-newspaper"></i>
                    <h3>Market News & Analysis</h3>
                    <p>Latest news, expert opinions, and in-depth market analysis.</p>
                </div>
                <div class="feature">
                    <i class="fas fa-user-cog"></i>
                    <h3>Personalized Dashboard</h3>
                    <p>Tailored insights based on your portfolio and interests.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="market-updates">
        <div class="container">
            <div class="ticker-bar">
                <marquee>Live Stock Ticker: AAPL 150.00 ▲2.00 | GOOG 2800.00 ▲15.00 | AMZN 3500.00 ▼10.00</marquee>
            </div>
            <div class="market-overview">
                <h2>Market Overview</h2>
                <div class="market-overview-grid">
                    <div class="gainers-losers">
                        <h3>Gainers & Losers</h3>
                        <p>Top-performing and worst-performing stocks.</p>
                    </div>
                    <div class="heat-map">      
                        <h3>Top News</h3>
                        <p>A visual representation of market trends.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="testimonials">
        <div class="container">
            <h2>What Our Users Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial">
                    <p>"StockInsight Pro has transformed the way I invest. The forecasts are spot-on!"</p>
                    <h4>- Alex Johnson</h4>
                </div>
                <div class="testimonial">
                    <p>"A must-have tool for any serious investor."</p>
                    <h4>- Samantha Lee</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-insights">
        <div class="container">
            <h2>Blog & Insights</h2>
            <div class="blog-insights-grid">
                <div class="blog-post">
                    <h3>Understanding Market Trends in 2024</h3>
                    <p>Exploring the factors that will shape the stock market in the coming year.</p>
                    <a href="#">Read more</a>
                </div>
                <div class="blog-post">
                    <h3>How to Use AI for Stock Forecasting</h3>
                    <p>A guide to leveraging AI models for accurate market predictions.</p>
                    <a href="#">Read more</a>
                </div>
                
            </div>
        </div>
    </section>



    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">FAQs</a>
                </div>
                <div class="contact-info">
                    <p>Email: yadavsatyam898@gmail.com</p>
                    <p>Phone: 7208441899 </p>
                    <div class="social-media">
                        <a href="https://www.facebook.com/profile.php?id=100024224862958"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/Satyam_30_"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/in/satyam-yadav-411936235/?trk=public-profile-join-page"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>© 2024 StockInsight Pro. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="scripts.js"></script>
   
</body>

</html>
