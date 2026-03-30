    <!-- WhatsApp Button -->
    <a href="https://wa.me/919983537401?text=Hi%20Vibrant%20Academy,%20I%20want%20to%20know%20more%20about%20your%20courses" 
       class="whatsapp-btn" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Footer -->
    <footer style="background: var(--dark-color); color: white; padding: 4rem 0 2rem;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4 class="mb-3"><i class="fas fa-graduation-cap me-2"></i>Vibrant Academy</h4>
                    <p>Empowering students with quality education and personalized attention for over 13 years. Your success is our mission.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#home" class="text-white-50 text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="#about" class="text-white-50 text-decoration-none">About Us</a></li>
                        <li class="mb-2"><a href="#courses" class="text-white-50 text-decoration-none">Courses</a></li>
                        <li class="mb-2"><a href="#contact" class="text-white-50 text-decoration-none">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="mb-3">Contact Info</h5>
                    <p class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i><?= esc($institute['address']) ?></p>
                    <p class="mb-2"><i class="fas fa-phone me-2 text-primary"></i>+91 <?= esc($institute['phone']) ?></p>
                    <p class="mb-2"><i class="fas fa-envelope me-2 text-primary"></i><?= esc($institute['email']) ?></p>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> Vibrant Academy. All rights reserved. | Designed with <i class="fas fa-heart text-danger"></i> for Education</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Smooth Scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Navbar Background on Scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
            }
        });

        // Form Submission with AJAX
        document.getElementById('inquiryForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Disable button
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';
            
            // Clear previous errors
            form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            form.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            
            const formData = new FormData(form);
            
            fetch('<?= base_url('submit-inquiry') ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        <i class="fas fa-check-circle me-2"></i>${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    form.insertBefore(alertDiv, form.firstChild);
                    
                    // Reset form
                    form.reset();
                    
                    // Remove success message after 5 seconds
                    setTimeout(() => alertDiv.remove(), 5000);
                } else {
                    // Show validation errors
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            const input = form.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('is-invalid');
                                const feedback = document.createElement('div');
                                feedback.className = 'invalid-feedback';
                                feedback.textContent = data.errors[field];
                                input.parentNode.appendChild(feedback);
                            }
                        });
                    } else {
                        alert(data.message || 'An error occurred. Please try again.');
                    }
                }
                
                // Update CSRF token
                if (data.token) {
                    document.querySelector('meta[name="csrf-token"]').content = data.token;
                    form.querySelector('input[name="<?= csrf_token() ?>"]').value = data.token;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong. Please try again later.');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });
    </script>
</body>
</html>