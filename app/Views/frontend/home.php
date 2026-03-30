<?= $this->include('frontend/templates/header') ?>

<!-- Hero Section -->
<section id="home" class="hero-section">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="hero-title">Build Your Future With <span style="color: var(--secondary-color);">Vibrant Academy</span></h1>
                <p class="hero-subtitle">Premier coaching institute in Ajmer with 13+ years of excellence. We nurture talent and transform students into achievers through personalized attention and expert guidance.</p>
                <a href="#contact" class="btn btn-hero">Enroll Now <i class="fas fa-arrow-right ms-2"></i></a>
                
                <div class="mt-5 d-flex gap-4 text-white">
                    <div>
                        <h3 class="fw-bold mb-0">13+</h3>
                        <small>Years Experience</small>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">5000+</h3>
                        <small>Students Trained</small>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">100%</h3>
                        <small>Success Rate</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="Students" class="img-fluid rounded-4 shadow-lg" style="transform: perspective(1000px) rotateY(-10deg);">
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" style="padding: 6rem 0; background: var(--light-color);">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                     alt="About Us" class="img-fluid rounded-4 shadow-lg">
            </div>
            <div class="col-lg-6">
                <div class="badge bg-primary mb-3">About Us</div>
                <h2 class="display-5 fw-bold mb-4">Shaping Minds, Building Futures Since 2011</h2>
                <p class="lead text-muted mb-4">Vibrant Academy has been at the forefront of quality education in Ajmer for over 13 years. We believe every student has the potential to excel, and our mission is to unlock that potential through innovative teaching methods and dedicated mentorship.</p>
                
                <div class="row g-3">
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-primary text-white rounded-3 p-3 me-3">
                                <i class="fas fa-award fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Expert Faculty</h6>
                                <small class="text-muted">Highly qualified teachers</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center">
                            <div class="icon-box bg-success text-white rounded-3 p-3 me-3">
                                <i class="fas fa-book-reader fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-0">Modern Methods</h6>
                                <small class="text-muted">Interactive learning</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Courses Section -->
<section id="courses" style="padding: 6rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="badge bg-primary mb-3">Our Courses</div>
            <h2 class="display-5 fw-bold">Comprehensive Programs for Every Student</h2>
            <p class="lead text-muted">From school academics to competitive exams, we cover it all</p>
        </div>
        
        <div class="row g-4">
            <?php foreach ($courses as $course): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm hover-card" style="transition: all 0.3s ease; border-radius: 20px;">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" 
                             style="width: 80px; height: 80px;">
                            <i class="fas <?= esc($course['icon']) ?> fa-2x"></i>
                        </div>
                        <h4 class="fw-bold mb-2"><?= esc($course['title']) ?></h4>
                        <p class="text-muted mb-0"><?= esc($course['desc']) ?></p>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-center pb-4">
                        <a href="#contact" class="btn btn-outline-primary rounded-pill">Learn More</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section id="why-us" style="padding: 6rem 0; background: linear-gradient(135deg, #1e293b, #334155); color: white;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="badge bg-warning text-dark mb-3">Why Choose Us</div>
            <h2 class="display-5 fw-bold">The Vibrant Academy Advantage</h2>
        </div>
        
        <div class="row g-4">
            <?php foreach ($why_us as $item): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card bg-white bg-opacity-10 border-0 h-100" style="backdrop-filter: blur(10px); border-radius: 20px;">
                    <div class="card-body p-4 text-center">
                        <i class="fas <?= esc($item['icon']) ?> fa-3x text-warning mb-3"></i>
                        <h4 class="fw-bold mb-2"><?= esc($item['title']) ?></h4>
                        <p class="text-white-50 mb-0"><?= esc($item['desc']) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section style="padding: 6rem 0; background: var(--light-color);">
    <div class="container">
        <div class="text-center mb-5">
            <div class="badge bg-primary mb-3">Testimonials</div>
            <h2 class="display-5 fw-bold">What Our Students Say</h2>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="rounded-circle me-3" width="50" height="50" alt="Student">
                        <div>
                            <h6 class="fw-bold mb-0">Priya Sharma</h6>
                            <small class="text-muted">NEET Qualified</small>
                        </div>
                    </div>
                    <p class="text-muted">"Vibrant Academy transformed my preparation. The faculty's dedication and personalized attention helped me secure a top rank in NEET."</p>
                    <div class="text-warning">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="rounded-circle me-3" width="50" height="50" alt="Student">
                        <div>
                            <h6 class="fw-bold mb-0">Rahul Patel</h6>
                            <small class="text-muted">IIT-JEE Advanced</small>
                        </div>
                    </div>
                    <p class="text-muted">"The structured approach and regular tests at Vibrant Academy prepared me perfectly for JEE. Best coaching institute in Ajmer!"</p>
                    <div class="text-warning">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm p-4 h-100" style="border-radius: 20px;">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" class="rounded-circle me-3" width="50" height="50" alt="Student">
                        <div>
                            <h6 class="fw-bold mb-0">Ananya Gupta</h6>
                            <small class="text-muted">Class 12, 98% CBSE</small>
                        </div>
                    </div>
                    <p class="text-muted">"From average to topper, Vibrant Academy made it possible. The teachers explain concepts so clearly that everything becomes easy."</p>
                    <div class="text-warning">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" style="padding: 6rem 0;">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <div class="badge bg-primary mb-3">Contact Us</div>
                <h2 class="display-5 fw-bold mb-4">Get In Touch</h2>
                <p class="lead text-muted mb-4">Ready to start your journey to success? Fill out the form and we'll get back to you within 24 hours.</p>
                
                <div class="contact-info mb-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-primary text-white rounded-3 p-3 me-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Visit Us</h6>
                            <p class="text-muted mb-0"><?= esc($institute['address']) ?></p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box bg-success text-white rounded-3 p-3 me-3">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Call Us</h6>
                            <p class="text-muted mb-0">+91 <?= esc($institute['phone']) ?></p>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <div class="icon-box bg-warning text-white rounded-3 p-3 me-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">Email Us</h6>
                            <p class="text-muted mb-0"><?= esc($institute['email']) ?></p>
                        </div>
                    </div>
                </div>
                
                <!-- Google Maps Embed -->
                <div class="ratio ratio-4x3 rounded-4 overflow-hidden shadow-sm">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3571.558012851376!2d74.6276083150327!3d26.44988898333144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396be71f1b0d4c3b%3A0x4b8c6c2a6a3e8d0f!2sAjmer%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1234567890" 
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
            
            <div class="col-lg-7">
                <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                    <div class="card-body p-5">
                        <h3 class="fw-bold mb-4">Enquiry Form</h3>
                        
                        <form id="inquiryForm" action="<?= base_url('submit-inquiry') ?>" method="post">
                            <?= csrf_field() ?>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Enter your full name" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Mobile Number *</label>
                                    <input type="tel" name="mobile" class="form-control form-control-lg" placeholder="10-digit mobile number" pattern="[6-9]{1}[0-9]{9}" required>
                                    <div class="form-text">We'll never share your number with anyone else.</div>
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Address</label>
                                    <textarea name="address" class="form-control" rows="2" placeholder="Your address (optional)"></textarea>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Class / Course Interested In *</label>
                                    <select name="class" class="form-select form-select-lg" required>
                                        <option value="">Select Class/Course</option>
                                        <?php for($i=1; $i<=12; $i++): ?>
                                            <option value="<?= $i ?>">Class <?= $i ?></option>
                                        <?php endfor; ?>
                                        <option value="NEET">NEET Preparation</option>
                                        <option value="IIT-JEE">IIT-JEE Preparation</option>
                                        <option value="Others">Other Competitive Exams</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">School Name</label>
                                    <input type="text" name="school_name" class="form-control form-control-lg" placeholder="Your school name">
                                </div>
                                
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg w-100" style="border-radius: 50px; padding: 1rem;">
                                        <i class="fas fa-paper-plane me-2"></i>Submit Enquiry
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('frontend/templates/footer') ?>