<!DOCTYPE html>
<html lang="ne">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWSai - नेपालको नम्बर १ समाचार पोर्टल</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header with Date Display -->
    <header class="header">
        <div class="date-bar">
            <div class="container">
                <div class="date-info">
                    <span id="current-date-bs"></span>
                    <span class="separator">|</span>
                    <span id="current-date-ad"></span>
                </div>
                <div class="header-actions">
                    <a href="#" class="login-btn">लगइन</a>
                    <a href="#" class="register-btn">रजिस्टर</a>
                </div>
            </div>
        </div>
        
        <!-- Main Navigation -->
        <nav class="main-nav">
            <div class="container">
                <div class="nav-brand">
                    <img src="Images/Logo.png" alt="NEWSai Logo" class="logo">
                    <h1>NEWSai</h1>
                </div>
                
                <ul class="nav-menu">
                    <li><a href="index.html" class="active">होमपेज</a></li>
                    <li><a href="news.html">समाचार</a></li>
                    <li><a href="business.html">बिजनेस</a></li>
                    <li><a href="lifestyle.html">जीवनशैली</a></li>
                    <li><a href="entertainment.html">मनोरञ्जन</a></li>
                    <li><a href="thoughts.html">विचार</a></li>
                    <li><a href="sports.html">खेलकुद</a></li>
                    <li><a href="upload.html" class="upload-link">समाचार अपलोड</a></li>
                </ul>
                
                <div class="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="hero-content">
                    <h2>ताजा समाचार र विश्लेषण</h2>
                    <p>नेपालको सबैभन्दा विश्वसनीय समाचार स्रोत</p>
                </div>
            </div>
        </section>

        <!-- Trending News -->
        <section class="trending-section">
            <div class="container">
                <h3 class="section-title">ट्रेन्डिङ समाचार</h3>
                <div class="trending-grid">
                    <article class="trending-item main-trending">
                        <div class="trending-image">
                            <img src="https://via.placeholder.com/600x400/ff6b6b/ffffff?text=मुख्य+समाचार" alt="Main News">
                            <div class="trending-badge">ट्रेन्डिङ</div>
                        </div>
                        <div class="trending-content">
                            <h4>सरकारले घोषणा गर्‍यो, तुइन विस्थापित भएन</h4>
                            <p>प्रदेश सरकारले आज नयाँ नीति घोषणा गर्दै भनेको छ कि तुइन विस्थापितहरूको समस्या समाधान गर्ने योजना बनाइएको छ।</p>
                            <div class="trending-meta">
                                <span class="category">समाज</span>
                                <span class="time">२ घण्टा अगाडि</span>
                            </div>
                        </div>
                    </article>
                    
                    <div class="trending-sidebar">
                        <article class="trending-item">
                            <div class="trending-image">
                                <img src="https://via.placeholder.com/300x200/4ecdc4/ffffff?text=बिजनेस" alt="Business News">
                            </div>
                            <div class="trending-content">
                                <h5>शेयर बजारमा उछाल</h5>
                                <span class="time">१ घण्टा अगाडि</span>
                            </div>
                        </article>
                        
                        <article class="trending-item">
                            <div class="trending-image">
                                <img src="https://via.placeholder.com/300x200/45b7d1/ffffff?text=खेलकुद" alt="Sports News">
                            </div>
                            <div class="trending-content">
                                <h5>नेपाली क्रिकेट टिमको जीत</h5>
                                <span class="time">३ घण्टा अगाडि</span>
                            </div>
                        </article>
                        
                        <article class="trending-item">
                            <div class="trending-image">
                                <img src="https://via.placeholder.com/300x200/96ceb4/ffffff?text=स्वास्थ्य" alt="Health News">
                            </div>
                            <div class="trending-content">
                                <h5>नयाँ स्वास्थ्य नीति</h5>
                                <span class="time">४ घण्टा अगाडि</span>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <!-- News Categories -->
        <section class="news-categories">
            <div class="container">
                <div class="categories-grid">
                    <div class="category-section">
                        <h3 class="category-title">समाचार</h3>
                        <div class="news-list">
                            <article class="news-item">
                                <img src="https://via.placeholder.com/200x150/ff6b6b/ffffff?text=राजनीति" alt="Politics">
                                <div class="news-content">
                                    <h4>संसदमा नयाँ विधेयक पेश</h4>
                                    <p>आज संसदमा नयाँ विधेयक पेश गरिएको छ जसले देशको विकासमा महत्वपूर्ण भूमिका खेल्ने अपेक्षा गरिएको छ।</p>
                                    <span class="news-time">१ घण्टा अगाडि</span>
                                </div>
                            </article>
                            
                            <article class="news-item">
                                <img src="https://via.placeholder.com/200x150/4ecdc4/ffffff?text=अर्थतन्त्र" alt="Economy">
                                <div class="news-content">
                                    <h4>अर्थतन्त्रमा सुधारको संकेत</h4>
                                    <p>ताजा आर्थिक तथ्याङ्कले अर्थतन्त्रमा सुधारको संकेत दिएको छ।</p>
                                    <span class="news-time">२ घण्टा अगाडि</span>
                                </div>
                            </article>
                        </div>
                    </div>
                    
                    <div class="category-section">
                        <h3 class="category-title">बिजनेस</h3>
                        <div class="news-list">
                            <article class="news-item">
                                <img src="https://via.placeholder.com/200x150/45b7d1/ffffff?text=बैंक" alt="Banking">
                                <div class="news-content">
                                    <h4>बैंकिङ क्षेत्रमा नयाँ नीति</h4>
                                    <p>राष्ट्र बैंकले बैंकिङ क्षेत्रका लागि नयाँ नीति जारी गरेको छ।</p>
                                    <span class="news-time">३ घण्टा अगाडि</span>
                                </div>
                            </article>
                            
                            <article class="news-item">
                                <img src="https://via.placeholder.com/200x150/96ceb4/ffffff?text=पर्यटन" alt="Tourism">
                                <div class="news-content">
                                    <h4>पर्यटन क्षेत्रमा वृद्धि</h4>
                                    <p>पर्यटन क्षेत्रमा निरन्तर वृद्धि भइरहेको छ।</p>
                                    <span class="news-time">४ घण्टा अगाडि</span>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Stories -->
        <section class="featured-stories">
            <div class="container">
                <h3 class="section-title">विशेष कथा</h3>
                <div class="stories-grid">
                    <article class="story-item">
                        <img src="https://via.placeholder.com/400x250/ff6b6b/ffffff?text=विशेष+कथा" alt="Special Story">
                        <div class="story-content">
                            <h4>नेपालको विकास यात्रा</h4>
                            <p>नेपालको विकास यात्रामा आएका चुनौतिहरू र उपलब्धिहरूको विस्तृत विश्लेषण।</p>
                            <span class="story-category">विशेष</span>
                        </div>
                    </article>
                    
                    <article class="story-item">
                        <img src="https://via.placeholder.com/400x250/4ecdc4/ffffff?text=अन्तर्वार्ता" alt="Interview">
                        <div class="story-content">
                            <h4>प्रधानमन्त्रीको अन्तर्वार्ता</h4>
                            <p>प्रधानमन्त्रीले दिएको विशेष अन्तर्वार्तामा देशको भविष्यका योजनाहरूको बारेमा बताए।</p>
                            <span class="story-category">अन्तर्वार्ता</span>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>NEWSai</h4>
                    <p>नेपालको नम्बर १ समाचार पोर्टल</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h5>समाचार</h5>
                    <ul>
                        <li><a href="#">राजनीति</a></li>
                        <li><a href="#">अर्थतन्त्र</a></li>
                        <li><a href="#">समाज</a></li>
                        <li><a href="#">अन्तर्राष्ट्रिय</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h5>बिजनेस</h5>
                    <ul>
                        <li><a href="#">बजार</a></li>
                        <li><a href="#">पर्यटन</a></li>
                        <li><a href="#">रोजगार</a></li>
                        <li><a href="#">बैंक</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h5>सम्पर्क</h5>
                    <p>ईमेल: news@newsai.com</p>
                    <p>फोन: +977-1-4790176</p>
                    <p>काठमाडौं, नेपाल</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; २०८१ NEWSai.com सर्वाधिकार सुरक्षित</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
