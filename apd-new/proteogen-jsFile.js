
        // Mobile Menu Toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const navLinks = document.getElementById('navLinks');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        
        function toggleMobileMenu() {
            const isActive = navLinks.classList.contains('mobile-active');
            
            if (isActive) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        }
        
        function openMobileMenu() {
            navLinks.classList.add('mobile-active');
            mobileMenuOverlay.classList.add('active');
            mobileMenuToggle.setAttribute('aria-expanded', 'true');
            mobileMenuToggle.textContent = '✕';
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileMenu() {
            navLinks.classList.remove('mobile-active');
            mobileMenuOverlay.classList.remove('active');
            mobileMenuToggle.setAttribute('aria-expanded', 'false');
            mobileMenuToggle.textContent = '☰';
            document.body.style.overflow = '';
        }
        
        mobileMenuToggle.addEventListener('click', toggleMobileMenu);
        
        // Close mobile menu when clicking on overlay
        mobileMenuOverlay.addEventListener('click', closeMobileMenu);
        
        // Close mobile menu when clicking on a link
        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (navLinks.classList.contains('mobile-active')) {
                    closeMobileMenu();
                }
            });
        });
        
        // Close mobile menu on window resize if open
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth > 768 && navLinks.classList.contains('mobile-active')) {
                    closeMobileMenu();
                }
            }, 250);
        });
        
        // Handle escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && navLinks.classList.contains('mobile-active')) {
                closeMobileMenu();
            }
        });
        
        // Dark Mode Toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        
        // Check for saved theme preference or default to light mode
        const currentTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', currentTheme);
        updateThemeIcon(currentTheme);
        updateLogo(currentTheme);
        
        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
            updateLogo(newTheme);
        });
        
        function updateThemeIcon(theme) {
            themeToggle.textContent = theme === 'light' ? '🌙' : '☀️';
        }
        
        function updateLogo(theme) {
            // Get all logo images (including those in picture sources and main img)
            const logoImages = document.querySelectorAll('.logo-picture img, .logo-picture source');

            logoImages.forEach(element => {
                if (element.tagName === 'IMG') {
                    element.src = theme === 'light' ? 'images/Logo-dark.png' : 'images/Logo.jpeg';
                } else if (element.tagName === 'SOURCE') {
                    element.srcset = theme === 'light' ? 'images/Logo-dark.png' : 'images/Logo.jpeg';
                }
            });
        }
        
        // Navbar scroll effect
        const nav = document.querySelector('.nav-wrapper');
        let lastScrollTop = 0;
        
        window.addEventListener('scroll', () => {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
            
            lastScrollTop = scrollTop;
        });

        // Enhanced smooth scrolling for anchor links with fixed header compensation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const target = document.querySelector(targetId);
                
                if (target) {
                    // Calculate header height dynamically
                    const header = document.querySelector('.nav-wrapper');
                    const headerHeight = header ? header.offsetHeight : 80;
                    const additionalOffset = 20; // Extra padding for better visual spacing
                    const totalOffset = headerHeight + additionalOffset;
                    
                    // Get target position
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - totalOffset;
                    
                    // Smooth scroll to calculated position
                    window.scrollTo({
                        top: Math.max(0, targetPosition), // Ensure we don't scroll above the page
                        behavior: 'smooth'
                    });
                    
                    // Update URL hash after scrolling (optional)
                    setTimeout(() => {
                        if (history.pushState) {
                            history.pushState(null, null, targetId);
                        }
                    }, 100);
                }
            });
        });

        // Performance-Optimized YouTube-Style Counter Animation System
        class PerformanceCounter {
            constructor() {
                this.activeAnimations = new Map();
                this.animationFrameId = null;
                this.isAnimating = false;
                this.debounceTimer = null;
                this.performanceMetrics = {
                    startTime: 0,
                    frameCount: 0,
                    lastFrameTime: 0
                };
            }

            // Easing functions for smooth animations
            easeOutQuart(t) {
                return 1 - Math.pow(1 - t, 4);
            }

            easeOutExpo(t) {
                return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
            }

            // Debounced animation starter to prevent memory leaks
            startAnimation(element, target, duration = 2500, delay = 0) {
                // Clear any existing debounce timer
                if (this.debounceTimer) {
                    clearTimeout(this.debounceTimer);
                }

                // Debounce to prevent rapid successive calls
                this.debounceTimer = setTimeout(() => {
                    this.initializeAnimation(element, target, duration, delay);
                }, 50);
            }

            initializeAnimation(element, target, duration, delay) {
                const animationId = element.dataset.animationId || `counter_${Date.now()}_${Math.random()}`;
                element.dataset.animationId = animationId;

                // Clean up any existing animation for this element
                if (this.activeAnimations.has(animationId)) {
                    this.stopAnimation(animationId);
                }

                // Create animation config
                const config = {
                    element,
                    target: parseInt(target),
                    duration,
                    delay,
                    startTime: null,
                    startValue: 0,
                    currentValue: 0,
                    isComplete: false,
                    hasStarted: false
                };

                this.activeAnimations.set(animationId, config);

                // Start the animation loop if not already running
                if (!this.isAnimating) {
                    this.startAnimationLoop();
                }
            }

            startAnimationLoop() {
                this.isAnimating = true;
                this.performanceMetrics.startTime = performance.now();
                this.performanceMetrics.frameCount = 0;
                this.animate();
            }

            animate() {
                const currentTime = performance.now();
                this.performanceMetrics.frameCount++;

                // Performance monitoring
                if (this.performanceMetrics.frameCount % 60 === 0) {
                    const fps = 60000 / (currentTime - this.performanceMetrics.lastFrameTime);
                    if (fps < 30) {
                        console.warn('Counter animation FPS dropped below 30:', fps);
                    }
                    this.performanceMetrics.lastFrameTime = currentTime;
                }

                let hasActiveAnimations = false;

                // Process all active animations
                for (const [animationId, config] of this.activeAnimations) {
                    if (config.isComplete) continue;

                    // Handle delay
                    if (!config.hasStarted) {
                        if (!config.startTime) {
                            config.startTime = currentTime + config.delay;
                        }
                        if (currentTime < config.startTime) {
                            hasActiveAnimations = true;
                            continue;
                        }
                        config.hasStarted = true;
                        config.startTime = currentTime;
                    }

                    // Calculate progress
                    const elapsed = currentTime - config.startTime;
                    const progress = Math.min(elapsed / config.duration, 1);

                    // Apply easing
                    const easedProgress = this.easeOutExpo(progress);
                    
                    // Calculate current value with YouTube-style increments
                    let newValue;
                    if (config.target <= 100) {
                        // Small numbers: smooth increment
                        newValue = Math.floor(config.startValue + (config.target - config.startValue) * easedProgress);
                    } else {
                        // Large numbers: accelerating increments like YouTube
                        const baseIncrement = config.target * easedProgress;
                        const randomVariation = Math.random() * 0.1 - 0.05; // ±5% variation
                        newValue = Math.floor(baseIncrement * (1 + randomVariation * (1 - progress)));
                        newValue = Math.min(newValue, config.target);
                    }

                    // Update display only if value changed (performance optimization)
                    if (newValue !== config.currentValue) {
                        config.currentValue = newValue;
                        
                        // Format number with commas for large values
                        const displayValue = newValue.toLocaleString();
                        config.element.textContent = displayValue;

                        // Add visual feedback for significant milestones
                        if (config.target >= 1000 && newValue % 100 === 0 && newValue > 0) {
                            this.addMilestoneEffect(config.element);
                        }
                    }

                    // Check if animation is complete
                    if (progress >= 1) {
                        config.isComplete = true;
                        config.element.textContent = config.target.toLocaleString();
                        this.addCompletionEffect(config.element);
                    } else {
                        hasActiveAnimations = true;
                    }
                }

                // Continue animation loop or clean up
                if (hasActiveAnimations) {
                    this.animationFrameId = requestAnimationFrame(() => this.animate());
                } else {
                    this.stopAnimationLoop();
                }
            }

            addMilestoneEffect(element) {
                // Subtle scale effect for milestones
                element.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 100);
            }

            addCompletionEffect(element) {
                // Final completion effect
                element.parentElement.classList.add('animation-complete');
                element.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 200);
            }

            stopAnimation(animationId) {
                if (this.activeAnimations.has(animationId)) {
                    const config = this.activeAnimations.get(animationId);
                    config.isComplete = true;
                    this.activeAnimations.delete(animationId);
                }
            }

            stopAnimationLoop() {
                this.isAnimating = false;
                if (this.animationFrameId) {
                    cancelAnimationFrame(this.animationFrameId);
                    this.animationFrameId = null;
                }
                
                // Clean up completed animations
                for (const [animationId, config] of this.activeAnimations) {
                    if (config.isComplete) {
                        this.activeAnimations.delete(animationId);
                    }
                }

                // Log performance metrics
                const totalTime = performance.now() - this.performanceMetrics.startTime;
                const avgFPS = (this.performanceMetrics.frameCount * 1000) / totalTime;
                console.log(`Counter animation completed. Avg FPS: ${avgFPS.toFixed(2)}, Total frames: ${this.performanceMetrics.frameCount}`);
            }

            // Clean up all animations and prevent memory leaks
            destroy() {
                this.stopAnimationLoop();
                this.activeAnimations.clear();
                if (this.debounceTimer) {
                    clearTimeout(this.debounceTimer);
                    this.debounceTimer = null;
                }
            }
        }

        // Global counter instance
        const performanceCounter = new PerformanceCounter();

        // Enhanced animateCounter function using the performance system
        function animateCounter(element, target, duration = 2500, delay = 0) {
            performanceCounter.startAnimation(element, target, duration, delay);
        }

        // Enhanced Infinite Carousel with Fixed Navigation
        class EnhancedCarousel {
            constructor(carouselElement) {
                this.carousel = carouselElement;
                this.track = carouselElement.querySelector('.carousel-track');
                this.slides = carouselElement.querySelectorAll('.carousel-slide');
                this.prevBtn = carouselElement.querySelector('.carousel-nav.prev');
                this.nextBtn = carouselElement.querySelector('.carousel-nav.next');

                this.currentSlide = 0;
                this.totalSlides = this.slides.length;
                this.isAutoPlaying = true;
                this.autoPlayInterval = null;
                this.autoPlayDelay = 5000; // 5 seconds per slide for discrete mode
                this.isTransitioning = false;
                this.userInteractionTimeout = null;
                this.isDiscreteMode = true; // Enable discrete slide-by-slide navigation
                
                // Touch/swipe properties
                this.startX = 0;
                this.currentX = 0;
                this.isDragging = false;
                
                this.init();
            }

            init() {
                this.setupDiscreteMode();
                this.preloadImages();
                this.setupEventListeners();
                this.startAutoPlay();
                this.setInitialPosition();
                
                // Add keyboard navigation
                this.carousel.setAttribute('tabindex', '0');
                this.carousel.addEventListener('keydown', this.handleKeyboard.bind(this));
                
                console.log('Enhanced carousel initialized with discrete navigation and', this.totalSlides, 'slides');
            }

            setupDiscreteMode() {
                // Enable discrete mode
                this.track.classList.add('discrete-mode');
                this.track.classList.remove('auto-scroll');
                this.carousel.classList.add('discrete-mode');
                
                // Set initial active states
                this.updateActiveStates();
                
                console.log('Discrete slide-by-slide mode enabled');
            }

            preloadImages() {
                // Preload all carousel images for seamless transitions
                this.slides.forEach(slide => {
                    const img = slide.querySelector('img');
                    if (img && img.src) {
                        const preloadImg = new Image();
                        preloadImg.src = img.src;
                        
                        // Set background image for seamless transitions
                        slide.style.backgroundImage = `url(${img.src})`;
                    }
                });
                console.log('All carousel images preloaded for seamless transitions');
            }
            
            setupEventListeners() {
                // Navigation arrows - bind methods properly
                this.prevBtn.addEventListener('click', this.handlePrevClick.bind(this));
                this.nextBtn.addEventListener('click', this.handleNextClick.bind(this));
                
                
                // Keyboard navigation
                this.handleKeyboardBound = this.handleKeyboard.bind(this);
                document.addEventListener('keydown', this.handleKeyboardBound);
                
                // Touch/swipe events
                this.carousel.addEventListener('touchstart', this.handleTouchStart.bind(this), { passive: true });
                this.carousel.addEventListener('touchmove', this.handleTouchMove.bind(this), { passive: false });
                this.carousel.addEventListener('touchend', this.handleTouchEnd.bind(this));
                
                // Mouse events for desktop dragging
                this.carousel.addEventListener('mousedown', this.handleMouseDown.bind(this));
                this.carousel.addEventListener('mousemove', this.handleMouseMove.bind(this));
                this.carousel.addEventListener('mouseup', this.handleMouseUp.bind(this));
                this.carousel.addEventListener('mouseleave', this.handleMouseUp.bind(this));
                
                // Pause on hover
                this.carousel.addEventListener('mouseenter', this.pauseAutoPlay.bind(this));
                this.carousel.addEventListener('mouseleave', this.resumeAutoPlay.bind(this));
                
                // Focus events for accessibility
                this.carousel.addEventListener('focusin', this.pauseAutoPlay.bind(this));
                this.carousel.addEventListener('focusout', this.resumeAutoPlay.bind(this));
                
                // Prevent context menu
                this.carousel.addEventListener('contextmenu', (e) => e.preventDefault());
            }
            
            setInitialPosition() {
                // For opacity-based transitions, set initial slide as active
                this.slides.forEach((slide, index) => {
                    if (index === 0) {
                        slide.classList.add('active');
                        slide.style.opacity = '1';
                    } else {
                        slide.classList.remove('active');
                        slide.style.opacity = '0';
                    }
                });
                this.updateActiveStates();
            }
            
            handlePrevClick() {
                this.handleUserInteraction(() => this.prevSlide());
            }
            
            handleNextClick() {
                this.handleUserInteraction(() => this.nextSlide());
            }
            
            
            handleUserInteraction(callback) {
                this.pauseAutoPlay();
                
                // Execute callback immediately in discrete mode
                callback();
                
                // Resume auto-play after 6 seconds of no interaction
                clearTimeout(this.userInteractionTimeout);
                this.userInteractionTimeout = setTimeout(() => {
                    this.resumeAutoPlay();
                }, 6000);
            }
            
            
            handleKeyboard(e) {
                // Only handle keyboard events when carousel is focused or contains focus
                if (!this.carousel.contains(document.activeElement)) return;
                
                switch(e.key) {
                    case 'ArrowLeft':
                        e.preventDefault();
                        this.handleUserInteraction(() => this.prevSlide());
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        this.handleUserInteraction(() => this.nextSlide());
                        break;
                    case 'Home':
                        e.preventDefault();
                        this.handleUserInteraction(() => this.goToSlide(0));
                        break;
                    case 'End':
                        e.preventDefault();
                        this.handleUserInteraction(() => this.goToSlide(this.totalSlides - 1));
                        break;
                }
            }
            
            // Touch/Swipe handling
            handleTouchStart(e) {
                this.startX = e.touches[0].clientX;
                this.isDragging = true;
                this.handleUserInteraction(() => {});
            }
            
            handleTouchMove(e) {
                if (!this.isDragging) return;
                
                e.preventDefault();
                this.currentX = e.touches[0].clientX;
                const deltaX = this.currentX - this.startX;
                
                // Add resistance effect
                const resistance = Math.abs(deltaX) > 50 ? 0.5 : 1;
                const currentTransform = -this.currentSlide * (100 / this.totalSlides);
                const newTransform = currentTransform + (deltaX * resistance / this.carousel.offsetWidth * 100);
                this.track.style.transform = `translateX(${newTransform}%)`;
            }
            
            handleTouchEnd() {
                if (!this.isDragging) return;
                
                const deltaX = this.currentX - this.startX;
                const threshold = 50;
                
                if (Math.abs(deltaX) > threshold) {
                    if (deltaX > 0) {
                        this.prevSlide();
                    } else {
                        this.nextSlide();
                    }
                } else {
                    // Snap back to current slide
                    this.goToSlide(this.currentSlide);
                }
                
                this.isDragging = false;
                this.startX = 0;
                this.currentX = 0;
            }
            
            // Mouse drag handling
            handleMouseDown(e) {
                this.startX = e.clientX;
                this.isDragging = true;
                this.handleUserInteraction(() => {});
                this.carousel.style.cursor = 'grabbing';
            }
            
            handleMouseMove(e) {
                if (!this.isDragging) return;
                
                this.currentX = e.clientX;
                const deltaX = this.currentX - this.startX;
                
                const resistance = Math.abs(deltaX) > 50 ? 0.5 : 1;
                const currentTransform = -this.currentSlide * (100 / this.totalSlides);
                const newTransform = currentTransform + (deltaX * resistance / this.carousel.offsetWidth * 100);
                this.track.style.transform = `translateX(${newTransform}%)`;
            }
            
            handleMouseUp() {
                if (!this.isDragging) return;
                
                const deltaX = this.currentX - this.startX;
                const threshold = 50;
                
                if (Math.abs(deltaX) > threshold) {
                    if (deltaX > 0) {
                        this.prevSlide();
                    } else {
                        this.nextSlide();
                    }
                } else {
                    this.goToSlide(this.currentSlide);
                }
                
                this.isDragging = false;
                this.startX = 0;
                this.currentX = 0;
                this.carousel.style.cursor = 'grab';
            }
            
            prevSlide() {
                if (this.isTransitioning) return;
                this.currentSlide = this.currentSlide === 0 ? this.totalSlides - 1 : this.currentSlide - 1;
                this.updateCarousel();
            }
            
            nextSlide() {
                if (this.isTransitioning) return;
                this.currentSlide = this.currentSlide === this.totalSlides - 1 ? 0 : this.currentSlide + 1;
                this.updateCarousel();
            }
            
            goToSlide(slideIndex) {
                if (this.isTransitioning || slideIndex === this.currentSlide) return;
                this.currentSlide = slideIndex;
                this.updateCarousel();
            }
            
            updateCarousel() {
                this.isTransitioning = true;
                
                // Use opacity-based crossfading for seamless transitions
                this.transitionToSlide(this.currentSlide);
                
                // Reset transition flag
                setTimeout(() => {
                    this.isTransitioning = false;
                }, 600);
            }

            transitionToSlide(newIndex) {
                // Get current and next slides
                const currentActiveSlide = this.track.querySelector('.carousel-slide.active');
                const nextSlide = this.slides[newIndex];
                
                if (!nextSlide) return;
                
                // Ensure next slide is ready for transition
                nextSlide.style.opacity = '0';
                nextSlide.classList.add('active');
                
                // Force reflow then start crossfade
                requestAnimationFrame(() => {
                    // Fade out current slide
                    if (currentActiveSlide && currentActiveSlide !== nextSlide) {
                        currentActiveSlide.style.opacity = '0';
                    }
                    
                    // Fade in next slide
                    nextSlide.style.opacity = '1';
                    
                    // Clean up after transition
                    setTimeout(() => {
                        // Remove active class from all slides except current
                        this.slides.forEach((slide, index) => {
                            if (index !== newIndex) {
                                slide.classList.remove('active');
                                slide.style.opacity = '0';
                            }
                        });
                        
                        // Update active states
                        this.updateActiveStates();
                    }, 600);
                });
            }
            
            updateActiveStates() {
                // Update slide active states
                this.slides.forEach((slide, index) => {
                    const isActive = index === this.currentSlide;
                    slide.classList.toggle('active', isActive);
                });
            }
            
            startAutoPlay() {
                if (this.autoPlayInterval) return;
                
                this.autoPlayInterval = setInterval(() => {
                    if (this.isAutoPlaying && !this.isDragging && !this.isTransitioning) {
                        // For discrete mode, advance to next slide
                        this.nextSlide();
                    }
                }, this.autoPlayDelay);
            }
            
            pauseAutoPlay() {
                this.isAutoPlaying = false;
            }
            
            resumeAutoPlay() {
                // Only resume if user hasn't interacted recently
                if (!this.userInteractionTimeout) {
                    this.isAutoPlaying = true;
                }
            }
            
            stopAutoPlay() {
                if (this.autoPlayInterval) {
                    clearInterval(this.autoPlayInterval);
                    this.autoPlayInterval = null;
                }
                this.isAutoPlaying = false;
            }
            
            destroy() {
                this.stopAutoPlay();
                clearTimeout(this.userInteractionTimeout);
                
                // Remove event listeners properly
                this.prevBtn.removeEventListener('click', this.handlePrevClick);
                this.nextBtn.removeEventListener('click', this.handleNextClick);
                document.removeEventListener('keydown', this.handleKeyboardBound);
                
                console.log('Enhanced discrete carousel destroyed');
            }
        }

        // Intersection Observer for animations and stats
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    
                    // Trigger stats animation if it's the stats section
                    if (entry.target.id === 'heroStats') {
                        debouncedAnimateStats();
                    }
                }
            });
        }, observerOptions);

        // Enhanced Stats Animation Function with Performance Optimization
        function animateStats() {
            const statItems = document.querySelectorAll('.stat-item');
            
            // Prevent multiple simultaneous animations
            if (window.statsAnimationInProgress) {
                return;
            }
            window.statsAnimationInProgress = true;
            
            statItems.forEach((item, index) => {
                const target = parseInt(item.dataset.target);
                const numberElement = item.querySelector('.stat-number');
                
                // Reset any previous state
                item.classList.remove('animating', 'animation-complete');
                numberElement.textContent = '0';
                
                // Staggered animation start with performance-optimized timing
                const delay = index * 150; // Reduced delay for snappier feel
                const duration = 2000 + (target > 100 ? 500 : 0); // Longer duration for larger numbers
                
                // Add initial animation class
                setTimeout(() => {
                    item.classList.add('animating');
                    
                    // Start the performance-optimized counter animation
                    animateCounter(numberElement, target, duration, 0);
                    
                }, delay);
                
                // Clean up animation class after completion
                setTimeout(() => {
                    item.classList.remove('animating');
                }, duration + delay + 500);
            });
            
            // Auto-cleanup after all animations should be complete
            setTimeout(() => {
                window.statsAnimationInProgress = false;
            }, 5000);
        }

        // Debounced stats animation to prevent rapid re-triggers
        let statsAnimationTimeout;
        function debouncedAnimateStats() {
            if (statsAnimationTimeout) {
                clearTimeout(statsAnimationTimeout);
            }
            statsAnimationTimeout = setTimeout(animateStats, 100);
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize enhanced carousel
            const carousel = document.getElementById('heroCarousel');
            let enhancedCarousel = null;
            if (carousel) {
                enhancedCarousel = new EnhancedCarousel(carousel);
                carousel.style.cursor = 'grab';
                
                // Make carousel focusable for keyboard navigation
                carousel.setAttribute('tabindex', '0');
                carousel.setAttribute('role', 'region');
                carousel.setAttribute('aria-label', 'Image carousel with 7 slides');
            }
            
            // Observe stats section for animation trigger
            const heroStats = document.getElementById('heroStats');
            if (heroStats) {
                observer.observe(heroStats);
            }
            
            // Observe other elements for fade-in animations
            document.querySelectorAll('.service-card, .partner-card, .feature-item').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });

            // Cleanup function to prevent memory leaks
            function cleanup() {
                // Clean up performance counter
                if (performanceCounter) {
                    performanceCounter.destroy();
                }
                
                // Clean up intersection observer
                if (observer) {
                    observer.disconnect();
                }
                
                // Clean up enhanced carousel
                if (enhancedCarousel && enhancedCarousel.destroy) {
                    enhancedCarousel.destroy();
                }
                
                // Clear any remaining timeouts
                if (statsAnimationTimeout) {
                    clearTimeout(statsAnimationTimeout);
                }
                
                // Reset global flags
                window.statsAnimationInProgress = false;
                
                console.log('Hero section cleanup completed');
            }

            // Register cleanup handlers
            window.addEventListener('beforeunload', cleanup);
            window.addEventListener('pagehide', cleanup);
            
            // Cleanup on visibility change (for mobile browsers)
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    // Pause animations when page is hidden
                    if (performanceCounter && performanceCounter.isAnimating) {
                        performanceCounter.stopAnimationLoop();
                    }
                    // Pause carousel when page is hidden
                    if (enhancedCarousel) {
                        enhancedCarousel.pauseAutoPlay();
                    }
                } else {
                    // Resume carousel when page is visible
                    if (enhancedCarousel) {
                        enhancedCarousel.resumeAutoPlay();
                    }
                }
            });
        });

        // Performance monitoring and debugging
        if (typeof window !== 'undefined' && window.performance) {
            // Monitor memory usage periodically
            setInterval(() => {
                if (window.performance.memory) {
                    const memInfo = window.performance.memory;
                    const memUsage = (memInfo.usedJSHeapSize / memInfo.totalJSHeapSize * 100).toFixed(2);
                    
                    // Log warning if memory usage is high
                    if (memUsage > 80) {
                        console.warn(`High memory usage detected: ${memUsage}%`);
                    }
                }
            }, 30000); // Check every 30 seconds
        }

        // Modern Downloads Section Functionality
        class DownloadsManager {
            constructor() {
                this.searchInput = document.getElementById('downloadSearch');
                this.filterTabs = document.querySelectorAll('.filter-tab');
                this.downloadCategories = document.querySelectorAll('.downloads-category');
                this.categoryToggles = document.querySelectorAll('.category-toggle');
                this.downloadLinks = document.querySelectorAll('.download-link');
                
                this.init();
            }

            init() {
                this.setupSearchFunctionality();
                this.setupFilterTabs();
                this.setupCategoryToggles();
                this.setupDownloadTracking();
                this.setupKeyboardNavigation();
                this.setupAccessibility();
            }

            setupSearchFunctionality() {
                if (this.searchInput) {
                    this.searchInput.addEventListener('input', (e) => {
                        const searchTerm = e.target.value.toLowerCase();
                        this.filterDownloads(searchTerm, this.getActiveFilter());
                    });

                    // Add search suggestions/autocomplete
                    this.searchInput.addEventListener('focus', () => {
                        this.searchInput.setAttribute('placeholder', 'Try: "PCR", "Safety", "Manual"...');
                    });

                    this.searchInput.addEventListener('blur', () => {
                        this.searchInput.setAttribute('placeholder', 'Search downloads...');
                    });
                }
            }

            setupFilterTabs() {
                this.filterTabs.forEach(tab => {
                    tab.addEventListener('click', (e) => {
                        e.preventDefault();
                        
                        // Update active tab with animation
                        this.filterTabs.forEach(t => t.classList.remove('active'));
                        tab.classList.add('active');
                        
                        const category = tab.dataset.category;
                        const searchTerm = this.searchInput ? this.searchInput.value.toLowerCase() : '';
                        
                        this.filterDownloads(searchTerm, category);
                        this.trackFilterUsage(category);
                    });

                    // Add keyboard support
                    tab.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            tab.click();
                        }
                    });
                });
            }

            setupCategoryToggles() {
                this.categoryToggles.forEach(toggle => {
                    toggle.addEventListener('click', (e) => {
                        e.preventDefault();
                        const category = toggle.closest('.downloads-category');
                        this.toggleCategory(category);
                    });

                    // Keyboard support
                    toggle.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            toggle.click();
                        }
                    });
                });
            }

            setupDownloadTracking() {
                this.downloadLinks.forEach(link => {
                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        
                        const downloadName = link.closest('.download-row').querySelector('h4').textContent;
                        const category = link.closest('.downloads-category').querySelector('h3').textContent;
                        
                        this.handleDownload(downloadName, category, link);
                    });
                });
            }

            setupKeyboardNavigation() {
                // Arrow key navigation for download rows
                document.addEventListener('keydown', (e) => {
                    if (!this.isDownloadsSection()) return;

                    const focusedElement = document.activeElement;
                    const downloadRows = Array.from(document.querySelectorAll('.download-row'));
                    const currentIndex = downloadRows.findIndex(row => row.contains(focusedElement));

                    if (currentIndex === -1) return;

                    switch(e.key) {
                        case 'ArrowDown':
                            e.preventDefault();
                            this.focusNextRow(downloadRows, currentIndex);
                            break;
                        case 'ArrowUp':
                            e.preventDefault();
                            this.focusPreviousRow(downloadRows, currentIndex);
                            break;
                        case 'Home':
                            e.preventDefault();
                            this.focusFirstRow(downloadRows);
                            break;
                        case 'End':
                            e.preventDefault();
                            this.focusLastRow(downloadRows);
                            break;
                    }
                });
            }

            setupAccessibility() {
                // Add ARIA labels and descriptions
                this.downloadCategories.forEach((category, index) => {
                    const header = category.querySelector('.category-header');
                    const table = category.querySelector('.downloads-table');
                    const toggle = category.querySelector('.category-toggle');
                    
                    const headerId = `downloads-category-${index}`;
                    const tableId = `downloads-table-${index}`;
                    
                    header.setAttribute('id', headerId);
                    header.setAttribute('role', 'button');
                    header.setAttribute('aria-expanded', 'true');
                    header.setAttribute('aria-controls', tableId);
                    
                    table.setAttribute('id', tableId);
                    table.setAttribute('aria-labelledby', headerId);
                    table.setAttribute('role', 'table');
                    
                    toggle.setAttribute('aria-label', `Toggle ${category.querySelector('h3').textContent} category`);
                });

                // Add download link accessibility
                this.downloadLinks.forEach(link => {
                    const fileName = link.closest('.download-row').querySelector('h4').textContent;
                    const fileType = link.closest('.download-row').querySelector('.file-type').textContent;
                    const fileSize = link.closest('.download-row').querySelector('.file-size')?.textContent;
                    
                    link.setAttribute('aria-label', `Download ${fileName} (${fileType}, ${fileSize})`);
                });
            }

            toggleCategory(category) {
                const isCollapsed = category.classList.contains('collapsed');
                const toggle = category.querySelector('.category-toggle');
                const header = category.querySelector('.category-header');
                
                if (isCollapsed) {
                    category.classList.remove('collapsed');
                    header.setAttribute('aria-expanded', 'true');
                    toggle.setAttribute('aria-label', toggle.getAttribute('aria-label').replace('Expand', 'Collapse'));
                } else {
                    category.classList.add('collapsed');
                    header.setAttribute('aria-expanded', 'false');
                    toggle.setAttribute('aria-label', toggle.getAttribute('aria-label').replace('Collapse', 'Expand'));
                }

                // Animate the toggle icon
                const svg = toggle.querySelector('svg');
                if (svg) {
                    svg.style.transform = isCollapsed ? 'rotate(0deg)' : 'rotate(-90deg)';
                }

                this.trackCategoryToggle(category.querySelector('h3').textContent, !isCollapsed);
            }

            filterDownloads(searchTerm, category) {
                this.downloadCategories.forEach(categoryElement => {
                    const categoryName = categoryElement.dataset.category;
                    const downloadRows = categoryElement.querySelectorAll('.download-row');
                    let visibleRows = 0;

                    // Show/hide category based on filter
                    const categoryMatches = category === 'all' || categoryName === category;
                    
                    if (!categoryMatches) {
                        categoryElement.style.display = 'none';
                        return;
                    }

                    categoryElement.style.display = 'block';

                    // Filter individual download rows
                    downloadRows.forEach(row => {
                        const title = row.querySelector('h4').textContent.toLowerCase();
                        const description = row.querySelector('p').textContent.toLowerCase();
                        
                        const matchesSearch = !searchTerm ||
                            title.includes(searchTerm) ||
                            description.includes(searchTerm);

                        if (matchesSearch) {
                            row.style.display = 'flex';
                            row.style.animation = 'fadeInUp 0.3s ease';
                            visibleRows++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Update category count
                    const countElement = categoryElement.querySelector('.category-count');
                    if (countElement) {
                        countElement.textContent = `${visibleRows} item${visibleRows !== 1 ? 's' : ''}`;
                    }

                    // Hide category if no visible rows
                    if (visibleRows === 0 && searchTerm) {
                        categoryElement.style.display = 'none';
                    }
                });

                this.updateSearchResults(searchTerm, category);
            }

            handleDownload(fileName, category, linkElement) {
                // Add loading state
                linkElement.classList.add('downloading');
                const originalText = linkElement.querySelector('span').textContent;
                linkElement.querySelector('span').textContent = 'Downloading...';

                // Show download notification
                this.showDownloadNotification(fileName);

                // Simulate download process
                setTimeout(() => {
                    linkElement.classList.remove('downloading');
                    linkElement.querySelector('span').textContent = originalText;
                    
                    // Track download
                    this.trackDownload(fileName, category);
                    
                    // In a real implementation, this would trigger the actual download
                    console.log(`Download initiated: ${fileName} from ${category}`);
                }, 1000);
            }

            showDownloadNotification(fileName) {
                const notification = document.createElement('div');
                notification.className = 'download-notification';
                notification.innerHTML = `
                    <div class="notification-icon">📥</div>
                    <div class="notification-content">
                        <strong>Download Started</strong>
                        <p>${fileName}</p>
                    </div>
                    <button class="notification-close" aria-label="Close notification">×</button>
                `;
                
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, #FF6B35, #F7931E);
                    color: white;
                    padding: 1rem;
                    border-radius: 12px;
                    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
                    z-index: 1000;
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    max-width: 350px;
                    animation: slideInRight 0.3s ease;
                `;

                document.body.appendChild(notification);

                // Auto-remove after 4 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.style.animation = 'slideOutRight 0.3s ease';
                        setTimeout(() => {
                            if (notification.parentNode) {
                                notification.parentNode.removeChild(notification);
                            }
                        }, 300);
                    }
                }, 4000);

                // Manual close
                const closeBtn = notification.querySelector('.notification-close');
                closeBtn.addEventListener('click', () => {
                    notification.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                });
            }

            // Helper methods
            getActiveFilter() {
                const activeTab = document.querySelector('.filter-tab.active');
                return activeTab ? activeTab.dataset.category : 'all';
            }

            isDownloadsSection() {
                const downloadsSection = document.getElementById('downloads');
                return downloadsSection && downloadsSection.contains(document.activeElement);
            }

            focusNextRow(rows, currentIndex) {
                const nextIndex = (currentIndex + 1) % rows.length;
                const nextRow = rows[nextIndex];
                const focusableElement = nextRow.querySelector('.download-link') || nextRow;
                focusableElement.focus();
            }

            focusPreviousRow(rows, currentIndex) {
                const prevIndex = currentIndex === 0 ? rows.length - 1 : currentIndex - 1;
                const prevRow = rows[prevIndex];
                const focusableElement = prevRow.querySelector('.download-link') || prevRow;
                focusableElement.focus();
            }

            focusFirstRow(rows) {
                if (rows.length > 0) {
                    const firstRow = rows[0];
                    const focusableElement = firstRow.querySelector('.download-link') || firstRow;
                    focusableElement.focus();
                }
            }

            focusLastRow(rows) {
                if (rows.length > 0) {
                    const lastRow = rows[rows.length - 1];
                    const focusableElement = lastRow.querySelector('.download-link') || lastRow;
                    focusableElement.focus();
                }
            }

            updateSearchResults(searchTerm, category) {
                const visibleRows = document.querySelectorAll('.download-row[style*="flex"]').length;
                
                // Update search results indicator (if exists)
                let resultsIndicator = document.querySelector('.search-results-indicator');
                if (!resultsIndicator && (searchTerm || category !== 'all')) {
                    resultsIndicator = document.createElement('div');
                    resultsIndicator.className = 'search-results-indicator';
                    resultsIndicator.style.cssText = `
                        text-align: center;
                        padding: 1rem;
                        color: var(--text-light);
                        font-style: italic;
                    `;
                    
                    const container = document.querySelector('.downloads-table-container');
                    if (container) {
                        container.parentNode.insertBefore(resultsIndicator, container);
                    }
                }

                if (resultsIndicator) {
                    if (searchTerm || category !== 'all') {
                        let message = `Found ${visibleRows} download${visibleRows !== 1 ? 's' : ''}`;
                        if (searchTerm) message += ` matching "${searchTerm}"`;
                        if (category !== 'all') message += ` in ${category}`;
                        
                        resultsIndicator.textContent = message;
                        resultsIndicator.style.display = 'block';
                    } else {
                        resultsIndicator.style.display = 'none';
                    }
                }
            }

            // Analytics tracking methods
            trackDownload(fileName, category) {
                console.log(`Download tracked: ${fileName} from ${category}`);
                // Placeholder for analytics
            }

            trackFilterUsage(category) {
                console.log(`Filter used: ${category}`);
                // Placeholder for analytics
            }

            trackCategoryToggle(categoryName, isExpanded) {
                console.log(`Category ${isExpanded ? 'expanded' : 'collapsed'}: ${categoryName}`);
                // Placeholder for analytics
            }
        }

        // Add notification animations
        const downloadsStyles = document.createElement('style');
        downloadsStyles.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
            
            .download-link.downloading {
                pointer-events: none;
                opacity: 0.7;
            }
            
            .download-link.downloading svg {
                animation: spin 1s linear infinite;
            }
            
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
            
            .notification-close {
                background: none;
                border: none;
                color: white;
                font-size: 1.2rem;
                cursor: pointer;
                padding: 0.25rem;
                border-radius: 50%;
                transition: background-color 0.3s ease;
            }
            
            .notification-close:hover {
                background: rgba(255, 255, 255, 0.2);
            }
        `;
        document.head.appendChild(downloadsStyles);

        // Initialize downloads manager
        let downloadsManager;
        document.addEventListener('DOMContentLoaded', () => {
            downloadsManager = new DownloadsManager();
        });

        // Career Section Functionality
        const deptTabs = document.querySelectorAll('.dept-tab');
        const jobCards = document.querySelectorAll('.job-card');

        // Department filter functionality
        deptTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Update active tab
                deptTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                const department = this.dataset.dept;
                filterJobs(department);
            });
        });

        function filterJobs(department) {
            jobCards.forEach(card => {
                const cardDept = card.dataset.dept;
                
                if (department === 'all' || cardDept === department) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.3s ease';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Add fade-in animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        `;
        document.head.appendChild(style);


        // Add download tracking (placeholder functionality)
        document.querySelectorAll('.download-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const downloadName = this.closest('.download-item').querySelector('h3').textContent;
                
                // Show download confirmation
                const confirmation = document.createElement('div');
                confirmation.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: var(--primary);
                    color: white;
                    padding: 1rem 2rem;
                    border-radius: 10px;
                    z-index: 1000;
                    animation: slideIn 0.3s ease;
                `;
                confirmation.textContent = `Download started: ${downloadName}`;
                document.body.appendChild(confirmation);
                
                // Remove confirmation after 3 seconds
                setTimeout(() => {
                    confirmation.remove();
                }, 3000);
                
                // In a real implementation, this would trigger the actual download
                console.log(`Download requested: ${downloadName}`);
            });
        });

        // Add application tracking (placeholder functionality)
        document.querySelectorAll('.apply-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const jobTitle = this.closest('.job-card').querySelector('h4').textContent;
                
                // Show application confirmation
                const confirmation = document.createElement('div');
                confirmation.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: var(--secondary);
                    color: white;
                    padding: 1rem 2rem;
                    border-radius: 10px;
                    z-index: 1000;
                    animation: slideIn 0.3s ease;
                `;
                confirmation.textContent = `Application form opened for: ${jobTitle}`;
                document.body.appendChild(confirmation);
                
                // Remove confirmation after 3 seconds
                setTimeout(() => {
                    confirmation.remove();
                }, 3000);
                
                // In a real implementation, this would open the application form
                console.log(`Application requested for: ${jobTitle}`);
            });
        });

        // Add slide-in animation for notifications
        const notificationStyle = document.createElement('style');
        notificationStyle.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        `;
        document.head.appendChild(notificationStyle);

        // Team Dropdown Navigation Functionality
        const teamDropdown = document.getElementById('teamDropdown');
        const teamDropdownMenu = document.getElementById('teamDropdownMenu');

        if (teamDropdown) {
            // Handle dropdown hover and click
            teamDropdown.addEventListener('mouseenter', function() {
                this.classList.add('active');
            });

            teamDropdown.addEventListener('mouseleave', function() {
                this.classList.remove('active');
            });

            // Handle mobile dropdown toggle
            const dropdownTrigger = teamDropdown.querySelector('.dropdown-trigger');
            if (dropdownTrigger) {
                dropdownTrigger.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.preventDefault();
                        teamDropdown.classList.toggle('mobile-active');
                    }
                });
            }

            // Handle dropdown item clicks
            const dropdownItems = teamDropdownMenu.querySelectorAll('.dropdown-item');
            dropdownItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const href = this.getAttribute('href');
                    
                    // Close mobile dropdown
                    teamDropdown.classList.remove('mobile-active');
                    
                    // Scroll to target section with header offset
                    const target = document.querySelector(href);
                    if (target) {
                        // Calculate header height dynamically
                        const header = document.querySelector('.nav-wrapper');
                        const headerHeight = header ? header.offsetHeight : 80;
                        const additionalOffset = 20;
                        const totalOffset = headerHeight + additionalOffset;
                        
                        // Get target position
                        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - totalOffset;
                        
                        // Smooth scroll to calculated position
                        window.scrollTo({
                            top: Math.max(0, targetPosition),
                            behavior: 'smooth'
                        });
                        
                        // If it's a specific team category, filter the team
                        if (href.includes('team-')) {
                            const category = href.replace('#team-', '');
                            filterTeamByCategory(category);
                        }
                    }
                });
            });
        }

        // Team Section Filtering Functionality
        const teamCategoryBtns = document.querySelectorAll('.team-category-btn');
        const teamSections = document.querySelectorAll('.team-section');

        // Team category filtering
        teamCategoryBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active button
                teamCategoryBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const category = this.dataset.category;
                filterTeamByCategory(category);
            });
        });

        function filterTeamByCategory(category) {
            teamSections.forEach(section => {
                const sectionCategory = section.dataset.category;
                
                if (category === 'all' || sectionCategory === category) {
                    section.style.display = 'block';
                    section.classList.remove('hidden');
                    
                    // Animate team cards
                    const cards = section.querySelectorAll('.team-member-card');
                    cards.forEach((card, index) => {
                        card.style.animationDelay = `${index * 0.1}s`;
                        card.style.animation = 'none';
                        setTimeout(() => {
                            card.style.animation = 'fadeInUp 0.6s ease forwards';
                        }, 10);
                    });
                } else {
                    section.style.display = 'none';
                    section.classList.add('hidden');
                }
            });

            // Update active category button
            teamCategoryBtns.forEach(btn => {
                if (btn.dataset.category === category) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }

        // Handle team member contact interactions
        document.querySelectorAll('.member-contact a').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                // Handle email links
                if (href.startsWith('mailto:')) {
                    // Show email confirmation
                    const email = href.replace('mailto:', '');
                    showNotification(`Opening email client for: ${email}`, 'var(--primary)');
                }
                
                // Handle phone links
                if (href.startsWith('tel:')) {
                    e.preventDefault();
                    const phone = href.replace('tel:', '');
                    showNotification(`Phone number copied: ${phone}`, 'var(--secondary)');
                    
                    // Copy to clipboard
                    if (navigator.clipboard) {
                        navigator.clipboard.writeText(phone).catch(() => {
                            // Fallback for older browsers
                            const textArea = document.createElement('textarea');
                            textArea.value = phone;
                            document.body.appendChild(textArea);
                            textArea.select();
                            document.execCommand('copy');
                            document.body.removeChild(textArea);
                        });
                    }
                }
                
                // Handle LinkedIn links
                if (href.includes('linkedin.com')) {
                    showNotification('Opening LinkedIn profile...', 'var(--accent)');
                }
            });
        });

        // Notification helper function
        function showNotification(message, backgroundColor = 'var(--primary)') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${backgroundColor};
                color: white;
                padding: 1rem 2rem;
                border-radius: 10px;
                z-index: 1000;
                animation: slideIn 0.3s ease;
                max-width: 300px;
                word-wrap: break-word;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Handle window resize for dropdown behavior
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                // Close mobile dropdown on desktop
                if (teamDropdown) {
                    teamDropdown.classList.remove('mobile-active');
                }
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (teamDropdown && !teamDropdown.contains(e.target)) {
                teamDropdown.classList.remove('mobile-active');
            }
        });

        // Keyboard navigation for dropdown
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (teamDropdown) {
                    teamDropdown.classList.remove('mobile-active');
                }
            }
        });

        // Initialize team section - show all by default
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure all team sections are visible initially
            teamSections.forEach(section => {
                section.style.display = 'block';
                section.classList.remove('hidden');
            });
            
            // Set initial active button
            const allButton = document.querySelector('.team-category-btn[data-category="all"]');
            if (allButton) {
                allButton.classList.add('active');
            }
        });

        // Products Accordion Functionality
        const accordionItems = document.querySelectorAll('.accordion-item');
        const accordionHeaders = document.querySelectorAll('.accordion-header');

        // Initialize accordion - ensure all are closed initially
        accordionItems.forEach(item => {
            item.classList.remove('active');
        });

        // Add click event listeners to accordion headers
        accordionHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const accordionItem = this.closest('.accordion-item');
                const isCurrentlyActive = accordionItem.classList.contains('active');
                
                // Close all accordion items (exclusive behavior)
                accordionItems.forEach(item => {
                    item.classList.remove('active');
                    
                    // Reset expand icon
                    const expandIcon = item.querySelector('.expand-icon');
                    if (expandIcon) {
                        expandIcon.textContent = '+';
                    }
                });
                
                // If the clicked item wasn't active, open it
                if (!isCurrentlyActive) {
                    accordionItem.classList.add('active');
                    
                    // Update expand icon
                    const expandIcon = accordionItem.querySelector('.expand-icon');
                    if (expandIcon) {
                        expandIcon.textContent = '×';
                    }
                    
                    // Scroll to accordion item with header offset compensation
                    setTimeout(() => {
                        // Calculate header height dynamically
                        const header = document.querySelector('.nav-wrapper');
                        const headerHeight = header ? header.offsetHeight : 80;
                        const additionalOffset = 20;
                        const totalOffset = headerHeight + additionalOffset;
                        
                        // Get target position
                        const targetPosition = accordionItem.getBoundingClientRect().top + window.pageYOffset - totalOffset;
                        
                        // Smooth scroll to calculated position
                        window.scrollTo({
                            top: Math.max(0, targetPosition),
                            behavior: 'smooth'
                        });
                    }, 100);
                }
            });
        });

        // Add keyboard navigation for accordion
        accordionHeaders.forEach(header => {
            header.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    this.click();
                }
            });
            
            // Make headers focusable
            header.setAttribute('tabindex', '0');
        });

        // Add hover effects for accordion headers
        accordionHeaders.forEach(header => {
            header.addEventListener('mouseenter', function() {
                if (!this.closest('.accordion-item').classList.contains('active')) {
                    this.style.transform = 'translateY(-2px)';
                }
            });
            
            header.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add intersection observer for accordion animation on scroll
        const accordionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observe all accordion items for scroll animations
        accordionItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateY(30px)';
            item.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            accordionObserver.observe(item);
        });

        // Add staggered animation delay for accordion items
        accordionItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
        });

        // Handle window resize for accordion responsiveness
        window.addEventListener('resize', () => {
            // Recalculate accordion content heights on resize
            const activeAccordion = document.querySelector('.accordion-item.active');
            if (activeAccordion) {
                const content = activeAccordion.querySelector('.accordion-content');
                if (content) {
                    // Temporarily remove max-height to get natural height
                    content.style.maxHeight = 'none';
                    const naturalHeight = content.scrollHeight;
                    content.style.maxHeight = naturalHeight + 'px';
                }
            }
        });

        // Add accessibility improvements
        accordionItems.forEach(item => {
            const header = item.querySelector('.accordion-header');
            const content = item.querySelector('.accordion-content');
            const headerId = 'accordion-header-' + Math.random().toString(36).substr(2, 9);
            const contentId = 'accordion-content-' + Math.random().toString(36).substr(2, 9);
            
            // Set ARIA attributes
            header.setAttribute('id', headerId);
            header.setAttribute('aria-expanded', 'false');
            header.setAttribute('aria-controls', contentId);
            header.setAttribute('role', 'button');
            
            content.setAttribute('id', contentId);
            content.setAttribute('aria-labelledby', headerId);
            content.setAttribute('role', 'region');
            
            // Update ARIA attributes when accordion state changes
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        const isActive = item.classList.contains('active');
                        header.setAttribute('aria-expanded', isActive.toString());
                    }
                });
            });
            
            observer.observe(item, { attributes: true, attributeFilter: ['class'] });
        });

        // Add analytics tracking for accordion interactions (placeholder)
        accordionHeaders.forEach(header => {
            header.addEventListener('click', function() {
                const productName = this.querySelector('h3').textContent;
                const isOpening = !this.closest('.accordion-item').classList.contains('active');
                
                // Placeholder for analytics tracking
                console.log(`Accordion ${isOpening ? 'opened' : 'closed'}: ${productName}`);
            });
        });

        // Get in Touch Section Functionality
        const contactCards = document.querySelectorAll('.contact-card');

        // Enhanced Contact Card Interactions
        class ContactCardManager {
            constructor() {
                this.cards = document.querySelectorAll('.contact-card');
                this.currentFocusIndex = -1;
                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupIntersectionObserver();
                this.setupKeyboardNavigation();
                this.setupAccessibility();
            }

            setupEventListeners() {
                this.cards.forEach((card, index) => {
                    // Mouse events
                    card.addEventListener('mouseenter', () => this.handleCardHover(card, index));
                    card.addEventListener('mouseleave', () => this.handleCardLeave(card, index));
                    card.addEventListener('click', () => this.handleCardClick(card, index));
                    
                    // Touch events for mobile
                    card.addEventListener('touchstart', (e) => this.handleTouchStart(e, card, index), { passive: true });
                    card.addEventListener('touchend', (e) => this.handleTouchEnd(e, card, index));
                    
                    // Focus events
                    card.addEventListener('focus', () => this.handleCardFocus(card, index));
                    card.addEventListener('blur', () => this.handleCardBlur(card, index));
                });
            }

            setupIntersectionObserver() {
                const observerOptions = {
                    threshold: 0.1,
                    rootMargin: '0px 0px -50px 0px'
                };

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            const cardIndex = Array.from(this.cards).indexOf(entry.target);
                            setTimeout(() => {
                                this.animateCardIn(entry.target, cardIndex);
                            }, cardIndex * 100);
                        }
                    });
                }, observerOptions);

                this.cards.forEach(card => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    observer.observe(card);
                });
            }

            setupKeyboardNavigation() {
                document.addEventListener('keydown', (e) => {
                    if (!this.isCardFocused()) return;

                    switch(e.key) {
                        case 'ArrowRight':
                        case 'ArrowDown':
                            e.preventDefault();
                            this.focusNextCard();
                            break;
                        case 'ArrowLeft':
                        case 'ArrowUp':
                            e.preventDefault();
                            this.focusPreviousCard();
                            break;
                        case 'Home':
                            e.preventDefault();
                            this.focusFirstCard();
                            break;
                        case 'End':
                            e.preventDefault();
                            this.focusLastCard();
                            break;
                        case 'Enter':
                        case ' ':
                            e.preventDefault();
                            this.activateCurrentCard();
                            break;
                    }
                });
            }

            setupAccessibility() {
                this.cards.forEach((card, index) => {
                    card.setAttribute('aria-describedby', `contact-card-desc-${index}`);
                    card.setAttribute('role', 'button');
                    card.setAttribute('tabindex', '0');
                    
                    const description = document.createElement('div');
                    description.id = `contact-card-desc-${index}`;
                    description.className = 'sr-only';
                    description.textContent = `Contact card for ${card.querySelector('.contact-title').textContent}. Press Enter to activate.`;
                    card.appendChild(description);
                });
            }

            handleCardHover(card, index) {
                this.createRippleEffect(card);
                this.animateNeighboringCards(index, 'hover');
                card.style.cursor = 'pointer';
                this.trackInteraction('hover', card);
            }

            handleCardLeave(card, index) {
                this.animateNeighboringCards(index, 'leave');
            }

            handleCardClick(card, index) {
                if (card.classList.contains('clicking')) return;
                
                card.classList.add('clicking');
                this.animateCardClick(card);
                
                const primaryAction = card.querySelector('.contact-action');
                if (primaryAction) {
                    setTimeout(() => {
                        primaryAction.click();
                    }, 150);
                }
                
                this.trackInteraction('click', card);
                
                setTimeout(() => {
                    card.classList.remove('clicking');
                }, 300);
            }

            handleTouchStart(e, card, index) {
                card.classList.add('touch-active');
                this.handleCardHover(card, index);
            }

            handleTouchEnd(e, card, index) {
                card.classList.remove('touch-active');
                setTimeout(() => {
                    this.handleCardClick(card, index);
                }, 50);
            }

            handleCardFocus(card, index) {
                this.currentFocusIndex = index;
                card.classList.add('focused');
                
                card.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                
                this.announceToScreenReader(`Focused on ${card.querySelector('.contact-title').textContent} contact card`);
            }

            handleCardBlur(card, index) {
                card.classList.remove('focused');
            }

            animateCardIn(card, index) {
                card.style.transition = 'all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
                
                setTimeout(() => {
                    card.style.transform = 'translateY(-5px)';
                    setTimeout(() => {
                        card.style.transform = 'translateY(0)';
                    }, 200);
                }, 100);
            }

            createRippleEffect(card) {
                const ripple = document.createElement('div');
                ripple.className = 'contact-card-ripple';
                ripple.style.cssText = `
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    width: 0;
                    height: 0;
                    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
                    border-radius: 50%;
                    transform: translate(-50%, -50%);
                    pointer-events: none;
                    z-index: 1;
                    animation: rippleExpand 0.6s ease-out;
                `;
                
                card.appendChild(ripple);
                
                setTimeout(() => {
                    if (ripple.parentNode) {
                        ripple.parentNode.removeChild(ripple);
                    }
                }, 600);
            }

            animateNeighboringCards(centerIndex, action) {
                this.cards.forEach((card, index) => {
                    if (index === centerIndex) return;
                    
                    const distance = Math.abs(index - centerIndex);
                    const maxDistance = 2;
                    
                    if (distance <= maxDistance) {
                        const intensity = 1 - (distance / maxDistance);
                        const scale = action === 'hover' ? 1 + (intensity * 0.02) : 1;
                        const translateY = action === 'hover' ? -(intensity * 2) : 0;
                        
                        card.style.transform = `scale(${scale}) translateY(${translateY}px)`;
                        card.style.transition = 'transform 0.3s ease';
                    }
                });
            }

            animateCardClick(card) {
                card.style.transform = 'scale(0.95)';
                card.style.transition = 'transform 0.1s ease';
                
                setTimeout(() => {
                    card.style.transform = 'scale(1.02)';
                    setTimeout(() => {
                        card.style.transform = 'scale(1)';
                    }, 100);
                }, 100);
            }

            // Keyboard navigation methods
            isCardFocused() {
                return document.activeElement && document.activeElement.classList.contains('contact-card');
            }

            focusNextCard() {
                const nextIndex = (this.currentFocusIndex + 1) % this.cards.length;
                this.cards[nextIndex].focus();
            }

            focusPreviousCard() {
                const prevIndex = this.currentFocusIndex === 0 ? this.cards.length - 1 : this.currentFocusIndex - 1;
                this.cards[prevIndex].focus();
            }

            focusFirstCard() {
                this.cards[0].focus();
            }

            focusLastCard() {
                this.cards[this.cards.length - 1].focus();
            }

            activateCurrentCard() {
                if (this.currentFocusIndex >= 0) {
                    this.handleCardClick(this.cards[this.currentFocusIndex], this.currentFocusIndex);
                }
            }

            trackInteraction(type, card) {
                const cardType = card.classList[1];
                console.log(`Contact card interaction: ${type} on ${cardType}`);
            }

            announceToScreenReader(message) {
                const announcement = document.createElement('div');
                announcement.setAttribute('aria-live', 'polite');
                announcement.setAttribute('aria-atomic', 'true');
                announcement.className = 'sr-only';
                announcement.textContent = message;
                
                document.body.appendChild(announcement);
                
                setTimeout(() => {
                    document.body.removeChild(announcement);
                }, 1000);
            }
        }

        // Add CSS for contact card animations
        const contactCardStyles = document.createElement('style');
        contactCardStyles.textContent = `
            @keyframes rippleExpand {
                0% {
                    width: 0;
                    height: 0;
                    opacity: 1;
                }
                100% {
                    width: 200px;
                    height: 200px;
                    opacity: 0;
                }
            }
            
            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }
            
            .contact-card.focused {
                outline: 3px solid var(--accent);
                outline-offset: 3px;
            }
            
            .contact-card.clicking {
                pointer-events: none;
            }
            
            .contact-card.touch-active {
                transform: scale(0.98);
            }
        `;
        document.head.appendChild(contactCardStyles);

        // Initialize contact card manager
        let contactCardManager;
        if (contactCards.length > 0) {
            contactCardManager = new ContactCardManager();
        }

        // Copy to clipboard functionality
        function copyToClipboard(text, successMessage) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    showNotification(successMessage, 'var(--primary)');
                }).catch(() => {
                    fallbackCopyToClipboard(text, successMessage);
                });
            } else {
                fallbackCopyToClipboard(text, successMessage);
            }
        }

        function fallbackCopyToClipboard(text, successMessage) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '-999999px';
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            
            try {
                document.execCommand('copy');
                showNotification(successMessage, 'var(--primary)');
            } catch (err) {
                showNotification('Unable to copy to clipboard', 'var(--accent)');
            }
            
            document.body.removeChild(textArea);
        }

        // Enhanced contact card interactions
        contactCards.forEach(card => {
            card.addEventListener('dblclick', function(e) {
                e.preventDefault();
                const contactInfo = this.querySelector('.contact-info');
                const emailMatch = contactInfo.textContent.match(/[\w\.-]+@[\w\.-]+\.\w+/);
                const phoneMatch = contactInfo.textContent.match(/\+91[\s\-\d]+/);
                
                if (emailMatch) {
                    copyToClipboard(emailMatch[0], `Email copied: ${emailMatch[0]}`);
                } else if (phoneMatch) {
                    copyToClipboard(phoneMatch[0], `Phone copied: ${phoneMatch[0]}`);
                }
            });
        });

        // Scroll to Top Button Functionality
        class ScrollToTopManager {
            constructor() {
                this.button = document.getElementById('scrollToTopBtn');
                this.scrollThreshold = 300;
                this.scrollDuration = 800;
                this.isScrolling = false;
                this.ticking = false;
                
                if (this.button) {
                    this.init();
                }
            }

            init() {
                this.setupEventListeners();
                this.checkScrollPosition(); // Initial check
            }

            setupEventListeners() {
                // Scroll event with throttling for performance
                window.addEventListener('scroll', () => {
                    if (!this.ticking) {
                        requestAnimationFrame(() => {
                            this.checkScrollPosition();
                            this.ticking = false;
                        });
                        this.ticking = true;
                    }
                });

                // Click event
                this.button.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.scrollToTop();
                });

                // Keyboard navigation
                this.button.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.scrollToTop();
                    }
                });

                // Touch events for mobile
                this.button.addEventListener('touchstart', (e) => {
                    this.button.style.transform = 'translateY(-2px) scale(1.05)';
                }, { passive: true });

                this.button.addEventListener('touchend', (e) => {
                    this.button.style.transform = '';
                }, { passive: true });

                // Focus events for accessibility
                this.button.addEventListener('focus', () => {
                    this.announceToScreenReader('Scroll to top button focused');
                });
            }

            checkScrollPosition() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                if (scrollTop > this.scrollThreshold) {
                    this.showButton();
                } else {
                    this.hideButton();
                }
            }

            showButton() {
                if (!this.button.classList.contains('visible')) {
                    this.button.classList.add('visible');
                    this.button.setAttribute('aria-hidden', 'false');
                    this.button.setAttribute('tabindex', '0');
                }
            }

            hideButton() {
                if (this.button.classList.contains('visible')) {
                    this.button.classList.remove('visible');
                    this.button.setAttribute('aria-hidden', 'true');
                    this.button.setAttribute('tabindex', '-1');
                }
            }

            scrollToTop() {
                if (this.isScrolling) return;
                
                this.isScrolling = true;
                this.button.classList.add('scrolling');
                
                // Announce to screen readers
                this.announceToScreenReader('Scrolling to top of page');
                
                // Check if browser supports smooth scrolling
                if ('scrollBehavior' in document.documentElement.style) {
                    // Use native smooth scrolling
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    
                    // Reset scrolling state after estimated duration
                    setTimeout(() => {
                        this.isScrolling = false;
                        this.button.classList.remove('scrolling');
                    }, this.scrollDuration);
                } else {
                    // Fallback: Custom smooth scrolling animation
                    this.animateScrollToTop();
                }
                
                // Analytics tracking
                this.trackScrollToTop();
            }

            animateScrollToTop() {
                const startPosition = window.pageYOffset;
                const startTime = performance.now();
                
                const animateScroll = (currentTime) => {
                    const elapsed = currentTime - startTime;
                    const progress = Math.min(elapsed / this.scrollDuration, 1);
                    
                    // Easing function (ease-out-cubic)
                    const easeOutCubic = 1 - Math.pow(1 - progress, 3);
                    
                    const currentPosition = startPosition * (1 - easeOutCubic);
                    window.scrollTo(0, currentPosition);
                    
                    if (progress < 1) {
                        requestAnimationFrame(animateScroll);
                    } else {
                        this.isScrolling = false;
                        this.button.classList.remove('scrolling');
                        this.announceToScreenReader('Reached top of page');
                    }
                };
                
                requestAnimationFrame(animateScroll);
            }

            announceToScreenReader(message) {
                const announcement = document.createElement('div');
                announcement.setAttribute('aria-live', 'polite');
                announcement.setAttribute('aria-atomic', 'true');
                announcement.className = 'sr-only';
                announcement.textContent = message;
                
                document.body.appendChild(announcement);
                
                setTimeout(() => {
                    if (announcement.parentNode) {
                        document.body.removeChild(announcement);
                    }
                }, 1000);
            }

            trackScrollToTop() {
                console.log('Scroll to top button clicked');
                
                // Placeholder for analytics tracking
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'scroll_to_top', {
                        'event_category': 'navigation',
                        'event_label': 'scroll_to_top_button'
                    });
                }
            }

            // Performance optimization
            destroy() {
                window.removeEventListener('scroll', this.checkScrollPosition);
                if (this.button) {
                    this.button.removeEventListener('click', this.scrollToTop);
                    this.button.removeEventListener('keydown', this.handleKeydown);
                }
            }
        }

        // Initialize scroll to top functionality
        let scrollToTopManager;
        document.addEventListener('DOMContentLoaded', () => {
            scrollToTopManager = new ScrollToTopManager();
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (scrollToTopManager) {
                scrollToTopManager.destroy();
            }
        });

        // Enhanced scroll to top button with ripple effect
        document.addEventListener('DOMContentLoaded', () => {
            const scrollBtn = document.getElementById('scrollToTopBtn');
            
            if (scrollBtn) {
                // Add ripple effect on click
                scrollBtn.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: rgba(255, 255, 255, 0.4);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: scrollRipple 0.6s ease-out;
                        pointer-events: none;
                    `;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => {
                        if (ripple.parentNode) {
                            ripple.parentNode.removeChild(ripple);
                        }
                    }, 600);
                });
            }
        });

        // Add CSS for scroll button animations
        const scrollButtonStyles = document.createElement('style');
        scrollButtonStyles.textContent = `
            @keyframes scrollRipple {
                0% {
                    transform: scale(0);
                    opacity: 1;
                }
                100% {
                    transform: scale(2);
                    opacity: 0;
                }
            }
            
            .scroll-to-top.scrolling {
                pointer-events: none;
                opacity: 0.7;
            }
            
            .scroll-to-top.scrolling .scroll-to-top-icon {
                animation: scrollSpin 0.8s ease-in-out;
            }
            
            @keyframes scrollSpin {
                0% {
                    transform: rotate(0deg);
                }
                100% {
                    transform: rotate(360deg);
                }
            }
        `;
        document.head.appendChild(scrollButtonStyles);

        // Office Gallery Modal System
        class OfficeGalleryModal {
            constructor() {
                this.modal = document.getElementById('officeModal');
                this.modalImage = document.getElementById('modalImage');
                this.modalTitle = document.getElementById('modalTitle');
                this.modalDescription = document.querySelector('.image-description');
                this.modalClose = document.getElementById('modalClose');
                this.prevBtn = document.getElementById('prevBtn');
                this.nextBtn = document.getElementById('nextBtn');
                this.currentImageIndex = document.getElementById('currentImageIndex');
                this.totalImages = document.getElementById('totalImages');
                this.fullscreenBtn = document.getElementById('fullscreenBtn');
                this.downloadBtn = document.getElementById('downloadBtn');
                this.imageLoading = document.querySelector('.image-loading');
                this.imageError = document.querySelector('.image-error');
                this.retryBtn = document.querySelector('.retry-btn');
                this.backdrop = document.querySelector('.modal-backdrop');
                
                this.thumbnails = document.querySelectorAll('.office-thumbnail-small');
                this.images = [];
                this.currentIndex = 0;
                this.isOpen = false;
                this.isFullscreen = false;
                this.touchStartX = 0;
                this.touchEndX = 0;
                this.isLoading = false;
                
                this.init();
            }

            init() {
                this.setupImageData();
                this.setupEventListeners();
                this.setupLazyLoading();
                this.setupAccessibility();
                this.preloadImages();
            }

            setupImageData() {
                this.images = Array.from(this.thumbnails).map(thumbnail => ({
                    src: thumbnail.dataset.image,
                    title: thumbnail.dataset.title,
                    description: thumbnail.dataset.description,
                    thumbnail: thumbnail
                }));
                
                if (this.totalImages) {
                    this.totalImages.textContent = this.images.length;
                }
            }

            setupEventListeners() {
                // Thumbnail click events
                this.thumbnails.forEach((thumbnail, index) => {
                    thumbnail.addEventListener('click', () => this.openModal(index));
                    thumbnail.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            this.openModal(index);
                        }
                    });
                });

                // Modal controls
                this.modalClose.addEventListener('click', () => this.closeModal());
                this.prevBtn.addEventListener('click', () => this.previousImage());
                this.nextBtn.addEventListener('click', () => this.nextImage());
                this.backdrop.addEventListener('click', () => this.closeModal());
                
                // Action buttons
                this.fullscreenBtn.addEventListener('click', () => this.toggleFullscreen());
                this.downloadBtn.addEventListener('click', () => this.downloadImage());
                this.retryBtn.addEventListener('click', () => this.retryImageLoad());

                // Keyboard navigation
                document.addEventListener('keydown', (e) => this.handleKeydown(e));

                // Touch events for swipe gestures
                this.modal.addEventListener('touchstart', (e) => this.handleTouchStart(e), { passive: true });
                this.modal.addEventListener('touchend', (e) => this.handleTouchEnd(e), { passive: true });

                // Mouse wheel for navigation
                this.modal.addEventListener('wheel', (e) => this.handleWheel(e), { passive: false });

                // Prevent modal content clicks from closing modal
                this.modal.querySelector('.modal-container').addEventListener('click', (e) => {
                    e.stopPropagation();
                });

                // Handle fullscreen changes
                document.addEventListener('fullscreenchange', () => this.handleFullscreenChange());
                document.addEventListener('webkitfullscreenchange', () => this.handleFullscreenChange());
                document.addEventListener('mozfullscreenchange', () => this.handleFullscreenChange());
                document.addEventListener('MSFullscreenChange', () => this.handleFullscreenChange());

                // Handle window resize
                window.addEventListener('resize', () => this.handleResize());
            }

            setupLazyLoading() {
                // For small thumbnails, we'll load them immediately since they're small
                // and part of the main content flow
                this.thumbnails.forEach(thumbnail => {
                    const img = thumbnail.querySelector('img');
                    if (img) {
                        // Images are already loaded, no lazy loading needed for small thumbnails
                        thumbnail.classList.add('loaded');
                    }
                });
            }

            setupAccessibility() {
                // Add ARIA labels and roles
                this.thumbnails.forEach((thumbnail, index) => {
                    thumbnail.setAttribute('role', 'button');
                    thumbnail.setAttribute('tabindex', '0');
                    thumbnail.setAttribute('aria-label', `View office image ${index + 1}: ${thumbnail.dataset.title}`);
                });

                // Modal accessibility
                this.modal.setAttribute('role', 'dialog');
                this.modal.setAttribute('aria-modal', 'true');
                this.modal.setAttribute('aria-labelledby', 'modalTitle');
                this.modal.setAttribute('aria-describedby', 'modalDescription');
            }

            preloadImages() {
                // Preload the first few images for better performance
                const preloadCount = Math.min(2, this.images.length);
                for (let i = 0; i < preloadCount; i++) {
                    const img = new Image();
                    img.src = this.images[i].src;
                }
            }

            openModal(index) {
                this.currentIndex = index;
                this.isOpen = true;
                
                // Update modal content
                this.updateModalContent();
                
                // Show modal
                this.modal.classList.add('active');
                this.modal.setAttribute('aria-hidden', 'false');
                
                // Prevent body scroll
                document.body.style.overflow = 'hidden';
                
                // Focus management
                this.modalClose.focus();
                
                // Load image
                this.loadCurrentImage();
                
                // Track analytics
                this.trackModalOpen(this.images[index].title);
            }

            closeModal() {
                if (!this.isOpen) return;
                
                this.isOpen = false;
                this.modal.classList.remove('active');
                this.modal.setAttribute('aria-hidden', 'true');
                
                // Restore body scroll
                document.body.style.overflow = '';
                
                // Exit fullscreen if active
                if (this.isFullscreen) {
                    this.exitFullscreen();
                }
                
                // Return focus to thumbnail
                if (this.images[this.currentIndex] && this.images[this.currentIndex].thumbnail) {
                    this.images[this.currentIndex].thumbnail.focus();
                }
                
                // Track analytics
                this.trackModalClose();
            }

            updateModalContent() {
                const currentImage = this.images[this.currentIndex];
                
                this.modalTitle.textContent = currentImage.title;
                this.modalDescription.textContent = currentImage.description;
                
                if (this.currentImageIndex) {
                    this.currentImageIndex.textContent = this.currentIndex + 1;
                }
                
                // Update navigation buttons
                this.prevBtn.disabled = this.currentIndex === 0;
                this.nextBtn.disabled = this.currentIndex === this.images.length - 1;
                
                // Update ARIA labels
                this.prevBtn.setAttribute('aria-label', `Previous image: ${this.currentIndex > 0 ? this.images[this.currentIndex - 1].title : 'None'}`);
                this.nextBtn.setAttribute('aria-label', `Next image: ${this.currentIndex < this.images.length - 1 ? this.images[this.currentIndex + 1].title : 'None'}`);
            }

            loadCurrentImage() {
                if (this.isLoading) return;
                
                this.isLoading = true;
                const currentImage = this.images[this.currentIndex];
                
                // Show loading state
                this.showLoading();
                
                // Create new image element
                const img = new Image();
                
                img.onload = () => {
                    this.modalImage.src = img.src;
                    this.modalImage.alt = `${currentImage.title} - ${currentImage.description}`;
                    this.modalImage.classList.add('loaded');
                    this.hideLoading();
                    this.hideError();
                    this.isLoading = false;
                    
                    // Preload adjacent images
                    this.preloadAdjacentImages();
                };
                
                img.onerror = () => {
                    this.showError();
                    this.hideLoading();
                    this.isLoading = false;
                };
                
                img.src = currentImage.src;
            }

            preloadAdjacentImages() {
                // Preload previous and next images
                const preloadIndexes = [this.currentIndex - 1, this.currentIndex + 1];
                
                preloadIndexes.forEach(index => {
                    if (index >= 0 && index < this.images.length) {
                        const img = new Image();
                        img.src = this.images[index].src;
                    }
                });
            }

            showLoading() {
                this.imageLoading.style.display = 'block';
                this.modalImage.classList.remove('loaded');
            }

            hideLoading() {
                this.imageLoading.style.display = 'none';
            }

            showError() {
                this.imageError.style.display = 'block';
                this.modalImage.classList.remove('loaded');
            }

            hideError() {
                this.imageError.style.display = 'none';
            }

            retryImageLoad() {
                this.hideError();
                this.loadCurrentImage();
            }

            previousImage() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                    this.updateModalContent();
                    this.loadCurrentImage();
                    this.announceImageChange();
                }
            }

            nextImage() {
                if (this.currentIndex < this.images.length - 1) {
                    this.currentIndex++;
                    this.updateModalContent();
                    this.loadCurrentImage();
                    this.announceImageChange();
                }
            }

            handleKeydown(e) {
                if (!this.isOpen) return;
                
                switch (e.key) {
                    case 'Escape':
                        e.preventDefault();
                        this.closeModal();
                        break;
                    case 'ArrowLeft':
                        e.preventDefault();
                        this.previousImage();
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        this.nextImage();
                        break;
                    case 'Home':
                        e.preventDefault();
                        this.goToImage(0);
                        break;
                    case 'End':
                        e.preventDefault();
                        this.goToImage(this.images.length - 1);
                        break;
                    case 'f':
                    case 'F':
                        if (!e.ctrlKey && !e.metaKey) {
                            e.preventDefault();
                            this.toggleFullscreen();
                        }
                        break;
                    case 'd':
                    case 'D':
                        if (!e.ctrlKey && !e.metaKey) {
                            e.preventDefault();
                            this.downloadImage();
                        }
                        break;
                }
            }

            handleTouchStart(e) {
                this.touchStartX = e.changedTouches[0].screenX;
            }

            handleTouchEnd(e) {
                this.touchEndX = e.changedTouches[0].screenX;
                this.handleSwipe();
            }

            handleSwipe() {
                const swipeThreshold = 50;
                const swipeDistance = this.touchEndX - this.touchStartX;
                
                if (Math.abs(swipeDistance) > swipeThreshold) {
                    if (swipeDistance > 0) {
                        // Swipe right - previous image
                        this.previousImage();
                    } else {
                        // Swipe left - next image
                        this.nextImage();
                    }
                }
            }

            handleWheel(e) {
                if (!this.isOpen) return;
                
                e.preventDefault();
                
                if (e.deltaY > 0) {
                    // Scroll down - next image
                    this.nextImage();
                } else {
                    // Scroll up - previous image
                    this.previousImage();
                }
            }

            goToImage(index) {
                if (index >= 0 && index < this.images.length && index !== this.currentIndex) {
                    this.currentIndex = index;
                    this.updateModalContent();
                    this.loadCurrentImage();
                    this.announceImageChange();
                }
            }

            toggleFullscreen() {
                if (this.isFullscreen) {
                    this.exitFullscreen();
                } else {
                    this.enterFullscreen();
                }
            }

            enterFullscreen() {
                const element = this.modal;
                
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.webkitRequestFullscreen) {
                    element.webkitRequestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                }
            }

            exitFullscreen() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }

            handleFullscreenChange() {
                this.isFullscreen = !!(document.fullscreenElement ||
                                     document.webkitFullscreenElement ||
                                     document.mozFullScreenElement ||
                                     document.msFullscreenElement);
                
                // Update fullscreen button icon
                this.fullscreenBtn.innerHTML = this.isFullscreen ?
                    '<span aria-hidden="true">⛶</span>' :
                    '<span aria-hidden="true">⛶</span>';
                
                this.fullscreenBtn.setAttribute('aria-label',
                    this.isFullscreen ? 'Exit fullscreen' : 'Enter fullscreen');
            }

            downloadImage() {
                const currentImage = this.images[this.currentIndex];
                const link = document.createElement('a');
                link.href = currentImage.src;
                link.download = `${currentImage.title.replace(/\s+/g, '_')}.jpg`;
                link.style.display = 'none';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                // Show download notification
                this.showNotification(`Downloaded: ${currentImage.title}`);
                this.trackDownload(currentImage.title);
            }

            handleResize() {
                if (this.isOpen) {
                    // Adjust modal size if needed
                    this.updateModalLayout();
                }
            }

            updateModalLayout() {
                // Recalculate modal dimensions for responsive behavior
                const container = this.modal.querySelector('.modal-container');
                const imageContainer = this.modal.querySelector('.image-container');
                
                if (window.innerWidth <= 480) {
                    imageContainer.style.height = '50vh';
                } else if (window.innerWidth <= 768) {
                    imageContainer.style.height = '55vh';
                } else {
                    imageContainer.style.height = '60vh';
                }
            }

            announceImageChange() {
                const currentImage = this.images[this.currentIndex];
                const announcement = `Image ${this.currentIndex + 1} of ${this.images.length}: ${currentImage.title}`;
                this.announceToScreenReader(announcement);
            }

            announceToScreenReader(message) {
                const announcement = document.createElement('div');
                announcement.setAttribute('aria-live', 'polite');
                announcement.setAttribute('aria-atomic', 'true');
                announcement.className = 'sr-only';
                announcement.textContent = message;
                
                document.body.appendChild(announcement);
                
                setTimeout(() => {
                    if (announcement.parentNode) {
                        document.body.removeChild(announcement);
                    }
                }, 1000);
            }

            showNotification(message) {
                const notification = document.createElement('div');
                notification.className = 'office-notification';
                notification.innerHTML = `
                    <div class="notification-icon">📥</div>
                    <div class="notification-content">
                        <p>${message}</p>
                    </div>
                `;
                
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, var(--primary), var(--secondary));
                    color: white;
                    padding: 1rem;
                    border-radius: 12px;
                    box-shadow: 0 8px 25px rgba(10, 77, 60, 0.3);
                    z-index: 10000;
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    max-width: 300px;
                    animation: slideInRight 0.3s ease;
                `;
                
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.style.animation = 'slideOutRight 0.3s ease';
                        setTimeout(() => {
                            if (notification.parentNode) {
                                notification.parentNode.removeChild(notification);
                            }
                        }, 300);
                    }
                }, 3000);
            }

            // Analytics tracking methods
            trackModalOpen(imageTitle) {
                console.log(`Office gallery opened: ${imageTitle}`);
                // Placeholder for analytics
            }

            trackModalClose() {
                console.log('Office gallery closed');
                // Placeholder for analytics
            }

            trackDownload(imageTitle) {
                console.log(`Office image downloaded: ${imageTitle}`);
                // Placeholder for analytics
            }

            // Cleanup method
            destroy() {
                // Remove event listeners
                document.removeEventListener('keydown', this.handleKeydown);
                window.removeEventListener('resize', this.handleResize);
                
                // Close modal if open
                if (this.isOpen) {
                    this.closeModal();
                }
            }
        }

        // Awards Gallery Modal System
        class AwardsGalleryModal {
            constructor() {
                this.modal = document.getElementById('awardsModal');
                this.modalImage = document.getElementById('awardsModalImage');
                this.modalTitle = document.getElementById('awardsModalTitle');
                this.modalDescription = document.querySelector('#awardsModal .image-description');
                this.modalClose = document.getElementById('awardsModalClose');
                this.prevBtn = document.getElementById('awardsPrevBtn');
                this.nextBtn = document.getElementById('awardsNextBtn');
                this.currentIndexEl = document.getElementById('awardsCurrentIndex');
                this.totalEl = document.getElementById('awardsTotalImages');
                this.fullscreenBtn = document.getElementById('awardsFullscreenBtn');
                this.imageLoading = this.modal.querySelector('.image-loading');
                this.imageError = this.modal.querySelector('.image-error');
                this.retryBtn = this.modal.querySelector('.retry-btn');
                this.backdrop = this.modal.querySelector('.modal-backdrop');

                this.thumbnails = document.querySelectorAll('.certificate-item');
                this.images = [];
                this.currentIndex = 0;
                this.isOpen = false;
                this.isFullscreen = false;
                this.touchStartX = 0;
                this.touchEndX = 0;
                this.isLoading = false;

                this.init();
            }

            init() {
                this.setupImageData();
                this.setupEventListeners();
                this.setupAccessibility();
            }

            setupImageData() {
                this.images = Array.from(this.thumbnails).map(item => ({
                    src: item.dataset.image,
                    title: item.dataset.title,
                    description: item.dataset.description,
                    thumbnail: item
                }));
                if (this.totalEl) {
                    this.totalEl.textContent = this.images.length;
                }
            }

            setupEventListeners() {
                this.thumbnails.forEach((item, index) => {
                    item.addEventListener('click', () => this.openModal(index));
                    item.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            this.openModal(index);
                        }
                    });
                });

                this.modalClose.addEventListener('click', () => this.closeModal());
                this.prevBtn.addEventListener('click', () => this.previousImage());
                this.nextBtn.addEventListener('click', () => this.nextImage());
                this.backdrop.addEventListener('click', () => this.closeModal());
                this.fullscreenBtn.addEventListener('click', () => this.toggleFullscreen());
                this.retryBtn.addEventListener('click', () => this.retryLoad());

                document.addEventListener('keydown', (e) => this.handleKeydown(e));

                this.modal.addEventListener('touchstart', (e) => { this.touchStartX = e.changedTouches[0].screenX; }, { passive: true });
                this.modal.addEventListener('touchend', (e) => {
                    const diff = e.changedTouches[0].screenX - this.touchStartX;
                    if (Math.abs(diff) > 50) { diff > 0 ? this.previousImage() : this.nextImage(); }
                }, { passive: true });

                this.modal.querySelector('.modal-container').addEventListener('click', (e) => e.stopPropagation());

                document.addEventListener('fullscreenchange', () => this.handleFullscreenChange());
                document.addEventListener('webkitfullscreenchange', () => this.handleFullscreenChange());
            }

            setupAccessibility() {
                this.thumbnails.forEach((item, index) => {
                    item.setAttribute('role', 'button');
                    item.setAttribute('tabindex', '0');
                    if (!item.getAttribute('aria-label')) {
                        item.setAttribute('aria-label', `View award certificate ${index + 1}: ${item.dataset.title}`);
                    }
                });
            }

            openModal(index) {
                this.currentIndex = index;
                this.isOpen = true;
                this.updateContent();
                this.modal.classList.add('active');
                this.modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
                this.modalClose.focus();
                this.loadImage();
            }

            closeModal() {
                if (!this.isOpen) return;
                this.isOpen = false;
                this.modal.classList.remove('active');
                this.modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
                if (this.isFullscreen) this.exitFullscreen();
                const thumb = this.images[this.currentIndex] && this.images[this.currentIndex].thumbnail;
                if (thumb) thumb.focus();
            }

            updateContent() {
                const img = this.images[this.currentIndex];
                this.modalTitle.textContent = img.title;
                this.modal.querySelector('.image-title').textContent = img.title;
                if (this.modalDescription) this.modalDescription.textContent = img.description;
                if (this.currentIndexEl) this.currentIndexEl.textContent = this.currentIndex + 1;
                this.prevBtn.disabled = this.currentIndex === 0;
                this.nextBtn.disabled = this.currentIndex === this.images.length - 1;
            }

            loadImage() {
                if (this.isLoading) return;
                this.isLoading = true;
                const current = this.images[this.currentIndex];
                this.imageLoading.style.display = 'block';
                this.modalImage.classList.remove('loaded');

                const img = new Image();
                img.onload = () => {
                    this.modalImage.src = img.src;
                    this.modalImage.alt = current.title;
                    this.modalImage.classList.add('loaded');
                    this.imageLoading.style.display = 'none';
                    this.imageError.style.display = 'none';
                    this.isLoading = false;
                    this.preloadAdjacent();
                };
                img.onerror = () => {
                    this.imageLoading.style.display = 'none';
                    this.imageError.style.display = 'block';
                    this.isLoading = false;
                };
                img.src = current.src;
            }

            preloadAdjacent() {
                [this.currentIndex - 1, this.currentIndex + 1].forEach(i => {
                    if (i >= 0 && i < this.images.length) {
                        const pre = new Image();
                        pre.src = this.images[i].src;
                    }
                });
            }

            retryLoad() {
                this.imageError.style.display = 'none';
                this.loadImage();
            }

            previousImage() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                    this.updateContent();
                    this.loadImage();
                }
            }

            nextImage() {
                if (this.currentIndex < this.images.length - 1) {
                    this.currentIndex++;
                    this.updateContent();
                    this.loadImage();
                }
            }

            handleKeydown(e) {
                if (!this.isOpen) return;
                switch (e.key) {
                    case 'Escape': e.preventDefault(); this.closeModal(); break;
                    case 'ArrowLeft': e.preventDefault(); this.previousImage(); break;
                    case 'ArrowRight': e.preventDefault(); this.nextImage(); break;
                    case 'Home': e.preventDefault(); this.currentIndex = 0; this.updateContent(); this.loadImage(); break;
                    case 'End': e.preventDefault(); this.currentIndex = this.images.length - 1; this.updateContent(); this.loadImage(); break;
                    case 'f': case 'F':
                        if (!e.ctrlKey && !e.metaKey) { e.preventDefault(); this.toggleFullscreen(); }
                        break;
                }
            }

            toggleFullscreen() {
                if (this.isFullscreen) { this.exitFullscreen(); } else { this.enterFullscreen(); }
            }

            enterFullscreen() {
                const el = this.modal;
                const req = el.requestFullscreen || el.webkitRequestFullscreen || el.mozRequestFullScreen || el.msRequestFullscreen;
                if (req) { req.call(el); this.isFullscreen = true; this.modal.classList.add('fullscreen'); }
            }

            exitFullscreen() {
                const exit = document.exitFullscreen || document.webkitExitFullscreen || document.mozCancelFullScreen || document.msExitFullscreen;
                if (exit) { exit.call(document); }
                this.isFullscreen = false;
                this.modal.classList.remove('fullscreen');
            }

            handleFullscreenChange() {
                if (!document.fullscreenElement && !document.webkitFullscreenElement) {
                    this.isFullscreen = false;
                    this.modal.classList.remove('fullscreen');
                }
            }
        }

        // Initialize Office Gallery Modal
        let officeGalleryModal;
        document.addEventListener('DOMContentLoaded', () => {
            const officeCard = document.querySelector('.office-card');
            if (officeCard) {
                officeGalleryModal = new OfficeGalleryModal();
            }
        });

        // Initialize Awards Gallery Modal
        let awardsGalleryModal;
        document.addEventListener('DOMContentLoaded', () => {
            const awardsSection = document.querySelector('.award-certificates-section');
            if (awardsSection) {
                awardsGalleryModal = new AwardsGalleryModal();
            }
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (officeGalleryModal) {
                officeGalleryModal.destroy();
            }
        });

        // Add CSS animations for notifications
        const officeNotificationStyles = document.createElement('style');
        officeNotificationStyles.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
            
            .office-notification {
                font-family: 'Archivo', sans-serif;
            }
            
            .office-notification .notification-icon {
                font-size: 1.5rem;
                flex-shrink: 0;
            }
            
            .office-notification .notification-content p {
                margin: 0;
                font-weight: 500;
                line-height: 1.4;
            }
        `;
        document.head.appendChild(officeNotificationStyles);

        // Downloads Accordion Functionality
        class DownloadsAccordion {
            constructor() {
                this.accordionContainer = document.querySelector('.downloads-accordion-container');
                this.accordionItems = document.querySelectorAll('.downloads-accordion-item');
                this.accordionHeaders = document.querySelectorAll('.accordion-header');
                this.searchInput = document.getElementById('downloadSearch');
                this.filterTabs = document.querySelectorAll('.filter-tab');
                
                this.init();
            }

            init() {
                if (!this.accordionContainer) return;
                
                this.setupAccordionBehavior();
                this.setupSearchFunctionality();
                this.setupFilterTabs();
                this.setupKeyboardNavigation();
                this.setupAccessibility();
                
                // Set Bio-Rad as default open panel
                this.setDefaultOpenPanel();
            }

            setupAccordionBehavior() {
                this.accordionHeaders.forEach((header, index) => {
                    header.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.toggleAccordionPanel(header.closest('.downloads-accordion-item'));
                    });

                    // Add keyboard support
                    header.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            this.toggleAccordionPanel(header.closest('.downloads-accordion-item'));
                        }
                    });
                });
            }

            toggleAccordionPanel(targetItem) {
                const isCurrentlyActive = targetItem.classList.contains('active');
                
                // Close all panels (single-panel-open behavior)
                this.accordionItems.forEach(item => {
                    item.classList.remove('active');
                    const header = item.querySelector('.accordion-header');
                    if (header) {
                        header.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // If the clicked panel wasn't active, open it
                if (!isCurrentlyActive) {
                    targetItem.classList.add('active');
                    const header = targetItem.querySelector('.accordion-header');
                    if (header) {
                        header.setAttribute('aria-expanded', 'true');
                    }
                    
                    // Scroll to accordion panel with header offset
                    setTimeout(() => {
                        this.scrollToAccordionPanel(targetItem);
                    }, 100);
                }
                
                // Track accordion interaction
                this.trackAccordionInteraction(targetItem, !isCurrentlyActive);
            }

            setDefaultOpenPanel() {
                // Set Bio-Rad panel as default open
                const bioRadPanel = document.getElementById('bio-rad-content');
                if (bioRadPanel) {
                    const bioRadItem = bioRadPanel.closest('.downloads-accordion-item');
                    if (bioRadItem) {
                        bioRadItem.classList.add('active');
                        const header = bioRadItem.querySelector('.accordion-header');
                        if (header) {
                            header.setAttribute('aria-expanded', 'true');
                        }
                    }
                }
            }

            scrollToAccordionPanel(item) {
                const header = document.querySelector('.nav-wrapper');
                const headerHeight = header ? header.offsetHeight : 80;
                const additionalOffset = 20;
                const totalOffset = headerHeight + additionalOffset;
                
                const targetPosition = item.getBoundingClientRect().top + window.pageYOffset - totalOffset;
                
                window.scrollTo({
                    top: Math.max(0, targetPosition),
                    behavior: 'smooth'
                });
            }

            setupSearchFunctionality() {
                if (!this.searchInput) return;
                
                this.searchInput.addEventListener('input', (e) => {
                    const searchTerm = e.target.value.toLowerCase();
                    this.filterDownloads(searchTerm);
                });

                // Enhanced search with suggestions
                this.searchInput.addEventListener('focus', () => {
                    this.searchInput.setAttribute('placeholder', 'Try: "PCR", "Cell Counter", "Chromatography"...');
                });

                this.searchInput.addEventListener('blur', () => {
                    this.searchInput.setAttribute('placeholder', 'Search downloads...');
                });
            }

            filterDownloads(searchTerm) {
                let hasVisibleResults = false;
                let firstMatchingPanel = null;

                this.accordionItems.forEach(accordionItem => {
                    const downloadRows = accordionItem.querySelectorAll('.download-row');
                    let visibleRowsInPanel = 0;

                    downloadRows.forEach(row => {
                        const title = row.querySelector('h4')?.textContent.toLowerCase() || '';
                        const description = row.querySelector('p')?.textContent.toLowerCase() || '';
                        
                        const matchesSearch = !searchTerm ||
                            title.includes(searchTerm) ||
                            description.includes(searchTerm);

                        if (matchesSearch) {
                            row.style.display = 'flex';
                            row.style.animation = 'fadeInUp 0.3s ease';
                            visibleRowsInPanel++;
                            hasVisibleResults = true;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Show/hide accordion panel based on whether it has visible results
                    if (visibleRowsInPanel > 0) {
                        accordionItem.style.display = 'block';
                        if (!firstMatchingPanel && searchTerm) {
                            firstMatchingPanel = accordionItem;
                        }
                        
                        // Update category count if element exists
                        const countElement = accordionItem.querySelector('.category-count');
                        if (countElement) {
                            countElement.textContent = `${visibleRowsInPanel} item${visibleRowsInPanel !== 1 ? 's' : ''}`;
                        }
                    } else if (searchTerm) {
                        accordionItem.style.display = 'none';
                    } else {
                        accordionItem.style.display = 'block';
                    }
                });

                // Auto-open first matching panel when searching
                if (searchTerm && firstMatchingPanel) {
                    // Close all panels first
                    this.accordionItems.forEach(item => {
                        item.classList.remove('active');
                        const header = item.querySelector('.accordion-header');
                        if (header) {
                            header.setAttribute('aria-expanded', 'false');
                        }
                    });
                    
                    // Open first matching panel
                    firstMatchingPanel.classList.add('active');
                    const header = firstMatchingPanel.querySelector('.accordion-header');
                    if (header) {
                        header.setAttribute('aria-expanded', 'true');
                    }
                } else if (!searchTerm) {
                    // Reset to default state when search is cleared
                    this.setDefaultOpenPanel();
                }

                this.updateSearchResults(searchTerm, hasVisibleResults);
            }

            setupFilterTabs() {
                this.filterTabs.forEach(tab => {
                    tab.addEventListener('click', (e) => {
                        e.preventDefault();
                        
                        // Update active tab
                        this.filterTabs.forEach(t => t.classList.remove('active'));
                        tab.classList.add('active');
                        
                        const category = tab.dataset.category;
                        this.filterByCategory(category);
                    });
                });
            }

            filterByCategory(category) {
                this.accordionItems.forEach(accordionItem => {
                    const itemCategory = accordionItem.dataset.category;
                    
                    if (category === 'all' || itemCategory === category) {
                        accordionItem.style.display = 'block';
                        accordionItem.style.animation = 'fadeInUp 0.3s ease';
                    } else {
                        accordionItem.style.display = 'none';
                        accordionItem.classList.remove('active');
                    }
                });

                // If filtering by specific category, open that panel
                if (category !== 'all') {
                    const targetPanel = document.querySelector(`[data-category="${category}"]`);
                    if (targetPanel) {
                        this.accordionItems.forEach(item => {
                            item.classList.remove('active');
                            const header = item.querySelector('.accordion-header');
                            if (header) {
                                header.setAttribute('aria-expanded', 'false');
                            }
                        });
                        
                        targetPanel.classList.add('active');
                        const header = targetPanel.querySelector('.accordion-header');
                        if (header) {
                            header.setAttribute('aria-expanded', 'true');
                        }
                    }
                } else {
                    // Reset to default when showing all
                    this.setDefaultOpenPanel();
                }
            }

            setupKeyboardNavigation() {
                document.addEventListener('keydown', (e) => {
                    if (!this.isDownloadsSection()) return;

                    const focusedElement = document.activeElement;
                    const accordionHeaders = Array.from(this.accordionHeaders);
                    const currentIndex = accordionHeaders.findIndex(header => header === focusedElement);

                    if (currentIndex === -1) return;

                    switch(e.key) {
                        case 'ArrowDown':
                            e.preventDefault();
                            this.focusNextHeader(accordionHeaders, currentIndex);
                            break;
                        case 'ArrowUp':
                            e.preventDefault();
                            this.focusPreviousHeader(accordionHeaders, currentIndex);
                            break;
                        case 'Home':
                            e.preventDefault();
                            accordionHeaders[0].focus();
                            break;
                        case 'End':
                            e.preventDefault();
                            accordionHeaders[accordionHeaders.length - 1].focus();
                            break;
                    }
                });
            }

            setupAccessibility() {
                this.accordionItems.forEach((item, index) => {
                    const header = item.querySelector('.accordion-header');
                    const content = item.querySelector('.accordion-content');
                    
                    if (header && content) {
                        const headerId = `accordion-header-${index}`;
                        const contentId = `accordion-content-${index}`;
                        
                        header.setAttribute('id', headerId);
                        header.setAttribute('aria-controls', contentId);
                        header.setAttribute('role', 'button');
                        header.setAttribute('tabindex', '0');
                        
                        content.setAttribute('id', contentId);
                        content.setAttribute('aria-labelledby', headerId);
                        content.setAttribute('role', 'region');
                    }
                });
            }

            updateSearchResults(searchTerm, hasResults) {
                let resultsIndicator = document.querySelector('.search-results-indicator');
                
                if (searchTerm) {
                    if (!resultsIndicator) {
                        resultsIndicator = document.createElement('div');
                        resultsIndicator.className = 'search-results-indicator';
                        resultsIndicator.style.cssText = `
                            text-align: center;
                            padding: 1rem;
                            color: var(--text-light);
                            font-style: italic;
                            background: var(--bg-accent);
                            border-radius: 8px;
                            margin-bottom: 1rem;
                        `;
                        
                        this.accordionContainer.parentNode.insertBefore(resultsIndicator, this.accordionContainer);
                    }
                    
                    if (hasResults) {
                        const visibleRows = document.querySelectorAll('.download-row[style*="flex"]').length;
                        resultsIndicator.textContent = `Found ${visibleRows} download${visibleRows !== 1 ? 's' : ''} matching "${searchTerm}"`;
                        resultsIndicator.style.color = 'var(--text-light)';
                    } else {
                        resultsIndicator.textContent = `No downloads found matching "${searchTerm}"`;
                        resultsIndicator.style.color = 'var(--accent)';
                    }
                    
                    resultsIndicator.style.display = 'block';
                } else if (resultsIndicator) {
                    resultsIndicator.style.display = 'none';
                }
            }

            // Helper methods
            isDownloadsSection() {
                const downloadsSection = document.getElementById('downloads');
                return downloadsSection && downloadsSection.contains(document.activeElement);
            }

            focusNextHeader(headers, currentIndex) {
                const nextIndex = (currentIndex + 1) % headers.length;
                headers[nextIndex].focus();
            }

            focusPreviousHeader(headers, currentIndex) {
                const prevIndex = currentIndex === 0 ? headers.length - 1 : currentIndex - 1;
                headers[prevIndex].focus();
            }

            trackAccordionInteraction(item, isOpening) {
                const categoryName = item.querySelector('.accordion-header')?.textContent?.trim() || 'Unknown';
                console.log(`Accordion ${isOpening ? 'opened' : 'closed'}: ${categoryName}`);
                // Placeholder for analytics tracking
            }

            // Public method to open specific accordion panel (for external use)
            openPanel(panelId) {
                const targetPanel = document.getElementById(panelId);
                if (targetPanel) {
                    const accordionItem = targetPanel.closest('.downloads-accordion-item');
                    if (accordionItem) {
                        this.toggleAccordionPanel(accordionItem);
                    }
                }
            }

            // Cleanup method
            destroy() {
                // Remove event listeners if needed
                console.log('Downloads accordion destroyed');
            }
        }

        // Initialize Downloads Accordion
        let downloadsAccordion;
        document.addEventListener('DOMContentLoaded', () => {
            const accordionContainer = document.querySelector('.downloads-accordion-container');
            if (accordionContainer) {
                downloadsAccordion = new DownloadsAccordion();
            }
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (downloadsAccordion) {
                downloadsAccordion.destroy();
            }
        });

        // ===== CAREERS SECTION FUNCTIONALITY =====

        // Modern Careers Section Manager
        class CareersManager {
            constructor() {
                this.jobFilters = document.querySelectorAll('.filter-select');
                this.filterResetBtn = document.querySelector('.filter-reset-btn');
                this.jobCards = document.querySelectorAll('.job-card.modern-card');
                this.noJobsMessage = document.querySelector('.no-jobs-message');
                this.jobsGrid = document.querySelector('.jobs-grid');
                this.searchInput = document.getElementById('jobSearch');
                
                this.currentFilters = {
                    department: 'all',
                    type: 'all',
                    location: 'all',
                    experience: 'all'
                };
                
                this.init();
            }

            init() {
                if (!this.jobsGrid) return;
                
                this.setupFilterListeners();
                this.setupSearchFunctionality();
                this.setupJobCardInteractions();
                this.setupApplicationTracking();
                this.setupKeyboardNavigation();
                this.setupAccessibility();
                this.animateJobCards();
            }

            setupFilterListeners() {
                // Filter dropdowns
                this.jobFilters.forEach(filter => {
                    filter.addEventListener('change', (e) => {
                        const filterType = e.target.dataset.filter;
                        const filterValue = e.target.value;
                        
                        this.currentFilters[filterType] = filterValue;
                        this.applyFilters();
                        this.trackFilterUsage(filterType, filterValue);
                    });
                });

                // Reset button
                if (this.filterResetBtn) {
                    this.filterResetBtn.addEventListener('click', () => {
                        this.resetFilters();
                    });
                }
            }

            setupSearchFunctionality() {
                if (!this.searchInput) return;
                
                let searchTimeout;
                this.searchInput.addEventListener('input', (e) => {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        this.applyFilters(e.target.value.toLowerCase());
                    }, 300);
                });

                // Search suggestions
                this.searchInput.addEventListener('focus', () => {
                    this.searchInput.setAttribute('placeholder', 'Try: "Engineer", "Sales", "Remote"...');
                });

                this.searchInput.addEventListener('blur', () => {
                    this.searchInput.setAttribute('placeholder', 'Search jobs...');
                });
            }

            setupJobCardInteractions() {
                this.jobCards.forEach((card, index) => {
                    // Hover effects
                    card.addEventListener('mouseenter', () => {
                        this.animateCardHover(card, true);
                    });

                    card.addEventListener('mouseleave', () => {
                        this.animateCardHover(card, false);
                    });

                    // Click to expand/focus
                    card.addEventListener('click', (e) => {
                        if (!e.target.closest('.job-actions')) {
                            this.focusJobCard(card);
                        }
                    });

                    // Keyboard navigation
                    card.addEventListener('keydown', (e) => {
                        if (e.key === 'Enter' || e.key === ' ') {
                            if (!e.target.closest('.job-actions')) {
                                e.preventDefault();
                                this.focusJobCard(card);
                            }
                        }
                    });
                });
            }

            setupApplicationTracking() {
                // Apply buttons
                document.querySelectorAll('.btn-primary').forEach(btn => {
                    if (btn.textContent.includes('Apply')) {
                        btn.addEventListener('click', (e) => {
                            e.preventDefault();
                            const jobCard = btn.closest('.job-card');
                            const jobTitle = jobCard.querySelector('.job-title').textContent;
                            this.handleJobApplication(jobTitle, btn);
                        });
                    }
                });

                // Learn more buttons
                document.querySelectorAll('.btn-outline').forEach(btn => {
                    if (btn.textContent.includes('Learn More')) {
                        btn.addEventListener('click', (e) => {
                            e.preventDefault();
                            const jobCard = btn.closest('.job-card');
                            this.expandJobDetails(jobCard);
                        });
                    }
                });
            }

            setupKeyboardNavigation() {
                document.addEventListener('keydown', (e) => {
                    if (!this.isCareersSection()) return;

                    const focusedCard = document.querySelector('.job-card.focused');
                    const visibleCards = Array.from(this.jobCards).filter(card =>
                        card.style.display !== 'none'
                    );

                    if (!focusedCard || visibleCards.length === 0) return;

                    const currentIndex = visibleCards.indexOf(focusedCard);

                    switch(e.key) {
                        case 'ArrowDown':
                            e.preventDefault();
                            this.focusNextCard(visibleCards, currentIndex);
                            break;
                        case 'ArrowUp':
                            e.preventDefault();
                            this.focusPreviousCard(visibleCards, currentIndex);
                            break;
                        case 'Home':
                            e.preventDefault();
                            this.focusJobCard(visibleCards[0]);
                            break;
                        case 'End':
                            e.preventDefault();
                            this.focusJobCard(visibleCards[visibleCards.length - 1]);
                            break;
                    }
                });
            }

            setupAccessibility() {
                this.jobCards.forEach((card, index) => {
                    card.setAttribute('role', 'article');
                    card.setAttribute('tabindex', '0');
                    card.setAttribute('aria-labelledby', `job-title-${index}`);
                    
                    const jobTitle = card.querySelector('.job-title');
                    if (jobTitle) {
                        jobTitle.id = `job-title-${index}`;
                    }

                    // Add screen reader description
                    const description = document.createElement('div');
                    description.className = 'sr-only';
                    description.textContent = 'Job posting. Press Enter to focus or use arrow keys to navigate.';
                    card.appendChild(description);
                });
            }

            applyFilters(searchTerm = '') {
                let visibleCount = 0;
                const searchQuery = searchTerm || (this.searchInput ? this.searchInput.value.toLowerCase() : '');

                this.jobCards.forEach((card, index) => {
                    const jobData = this.extractJobData(card);
                    const matchesFilters = this.checkFilterMatch(jobData);
                    const matchesSearch = this.checkSearchMatch(jobData, searchQuery);

                    if (matchesFilters && matchesSearch) {
                        this.showJobCard(card, index);
                        visibleCount++;
                    } else {
                        this.hideJobCard(card);
                    }
                });

                this.updateJobCount(visibleCount);
                this.toggleNoJobsMessage(visibleCount === 0);
                this.updateFilterSummary();
            }

            extractJobData(card) {
                return {
                    title: card.querySelector('.job-title')?.textContent.toLowerCase() || '',
                    description: card.querySelector('.job-description')?.textContent.toLowerCase() || '',
                    department: card.dataset.department || '',
                    type: card.dataset.type || '',
                    location: card.dataset.location || '',
                    experience: card.dataset.experience || '',
                    badges: Array.from(card.querySelectorAll('.badge')).map(badge =>
                        badge.textContent.toLowerCase()
                    )
                };
            }

            checkFilterMatch(jobData) {
                return Object.entries(this.currentFilters).every(([filterType, filterValue]) => {
                    if (filterValue === 'all') return true;
                    return jobData[filterType] === filterValue;
                });
            }

            checkSearchMatch(jobData, searchQuery) {
                if (!searchQuery) return true;
                
                return jobData.title.includes(searchQuery) ||
                       jobData.description.includes(searchQuery) ||
                       jobData.badges.some(badge => badge.includes(searchQuery));
            }

            showJobCard(card, index) {
                card.style.display = 'block';
                card.style.animation = `fadeInUp 0.6s ease ${index * 0.1}s both`;
                card.classList.remove('hidden');
            }

            hideJobCard(card) {
                card.style.display = 'none';
                card.classList.add('hidden');
                card.classList.remove('focused');
            }

            updateJobCount(count) {
                let countElement = document.querySelector('.jobs-count');
                if (!countElement) {
                    countElement = document.createElement('div');
                    countElement.className = 'jobs-count';
                    countElement.style.cssText = `
                        text-align: center;
                        margin-bottom: 2rem;
                        color: var(--text-light);
                        font-weight: 500;
                    `;
                    this.jobsGrid.parentNode.insertBefore(countElement, this.jobsGrid);
                }
                
                countElement.textContent = `${count} job${count !== 1 ? 's' : ''} available`;
            }

            toggleNoJobsMessage(show) {
                if (!this.noJobsMessage) {
                    this.createNoJobsMessage();
                }
                
                if (show) {
                    this.noJobsMessage.style.display = 'block';
                    this.jobsGrid.style.display = 'none';
                } else {
                    this.noJobsMessage.style.display = 'none';
                    this.jobsGrid.style.display = 'grid';
                }
            }

            createNoJobsMessage() {
                if (this.noJobsMessage) return;
                
                this.noJobsMessage = document.createElement('div');
                this.noJobsMessage.className = 'no-jobs-message';
                this.noJobsMessage.innerHTML = `
                    <div class="no-jobs-content">
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="m21 21-4.35-4.35"></path>
                        </svg>
                        <h3>No jobs found</h3>
                        <p>Try adjusting your filters or search terms to find more opportunities.</p>
                        <button class="btn btn-outline" onclick="careersManager.resetFilters()">
                            Clear Filters
                        </button>
                    </div>
                `;
                
                this.jobsGrid.parentNode.insertBefore(this.noJobsMessage, this.jobsGrid.nextSibling);
            }

            updateFilterSummary() {
                const activeFilters = Object.entries(this.currentFilters)
                    .filter(([key, value]) => value !== 'all')
                    .map(([key, value]) => `${key}: ${value}`);
                
                let summaryElement = document.querySelector('.filter-summary');
                if (activeFilters.length > 0) {
                    if (!summaryElement) {
                        summaryElement = document.createElement('div');
                        summaryElement.className = 'filter-summary';
                        summaryElement.style.cssText = `
                            background: var(--bg-accent);
                            padding: 1rem;
                            border-radius: 8px;
                            margin-bottom: 1rem;
                            font-size: 0.9rem;
                            color: var(--text-light);
                        `;
                        this.jobsGrid.parentNode.insertBefore(summaryElement, this.jobsGrid);
                    }
                    
                    summaryElement.innerHTML = `
                        <strong>Active filters:</strong> ${activeFilters.join(', ')}
                        <button class="btn-link" onclick="careersManager.resetFilters()" style="margin-left: 1rem; color: var(--primary); text-decoration: underline; background: none; border: none; cursor: pointer;">
                            Clear all
                        </button>
                    `;
                    summaryElement.style.display = 'block';
                } else if (summaryElement) {
                    summaryElement.style.display = 'none';
                }
            }

            resetFilters() {
                // Reset filter dropdowns
                this.jobFilters.forEach(filter => {
                    filter.value = 'all';
                });

                // Reset search
                if (this.searchInput) {
                    this.searchInput.value = '';
                }

                // Reset current filters
                Object.keys(this.currentFilters).forEach(key => {
                    this.currentFilters[key] = 'all';
                });

                // Apply filters (show all)
                this.applyFilters();
                
                // Show notification
                this.showNotification('Filters cleared', 'var(--primary)');
                
                // Track reset action
                this.trackFilterReset();
            }

            animateCardHover(card, isHovering) {
                if (isHovering) {
                    card.style.transform = 'translateY(-8px) scale(1.02)';
                    this.animateNeighboringCards(card, 'hover');
                } else {
                    card.style.transform = 'translateY(0) scale(1)';
                    this.animateNeighboringCards(card, 'leave');
                }
            }

            animateNeighboringCards(targetCard, action) {
                const allCards = Array.from(this.jobCards);
                const targetIndex = allCards.indexOf(targetCard);
                
                allCards.forEach((card, index) => {
                    if (index === targetIndex) return;
                    
                    const distance = Math.abs(index - targetIndex);
                    const maxDistance = 2;
                    
                    if (distance <= maxDistance) {
                        const intensity = 1 - (distance / maxDistance);
                        const scale = action === 'hover' ? 1 + (intensity * 0.01) : 1;
                        const translateY = action === 'hover' ? -(intensity * 2) : 0;
                        
                        card.style.transform = `scale(${scale}) translateY(${translateY}px)`;
                        card.style.transition = 'transform 0.3s ease';
                    }
                });
            }

            focusJobCard(card) {
                // Remove focus from other cards
                this.jobCards.forEach(c => c.classList.remove('focused'));
                
                // Add focus to target card
                card.classList.add('focused');
                card.focus();
                
                // Scroll to card
                card.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                
                // Announce to screen reader
                const jobTitle = card.querySelector('.job-title').textContent;
                this.announceToScreenReader(`Focused on ${jobTitle} position`);
            }

            focusNextCard(visibleCards, currentIndex) {
                const nextIndex = (currentIndex + 1) % visibleCards.length;
                this.focusJobCard(visibleCards[nextIndex]);
            }

            focusPreviousCard(visibleCards, currentIndex) {
                const prevIndex = currentIndex === 0 ? visibleCards.length - 1 : currentIndex - 1;
                this.focusJobCard(visibleCards[prevIndex]);
            }

            expandJobDetails(jobCard) {
                const isExpanded = jobCard.classList.contains('expanded');
                
                // Collapse all other cards
                this.jobCards.forEach(card => {
                    card.classList.remove('expanded');
                });
                
                if (!isExpanded) {
                    jobCard.classList.add('expanded');
                    
                    // Scroll to card
                    setTimeout(() => {
                        jobCard.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }, 100);
                }
                
                this.trackJobDetailView(jobCard.querySelector('.job-title').textContent);
            }

            handleJobApplication(jobTitle, button) {
                // Add loading state
                const originalText = button.textContent;
                button.textContent = 'Processing...';
                button.disabled = true;
                button.classList.add('loading');
                
                // Simulate application process
                setTimeout(() => {
                    button.textContent = originalText;
                    button.disabled = false;
                    button.classList.remove('loading');
                    
                    // Show success notification
                    this.showApplicationNotification(jobTitle);
                    
                    // Track application
                    this.trackJobApplication(jobTitle);
                }, 1500);
            }

            showApplicationNotification(jobTitle) {
                const notification = document.createElement('div');
                notification.className = 'application-notification';
                notification.innerHTML = `
                    <div class="notification-icon">✅</div>
                    <div class="notification-content">
                        <strong>Application Started</strong>
                        <p>Opening application form for ${jobTitle}</p>
                    </div>
                    <button class="notification-close" aria-label="Close notification">×</button>
                `;
                
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, #48bb78, #38a169);
                    color: white;
                    padding: 1rem;
                    border-radius: 12px;
                    box-shadow: 0 8px 25px rgba(72, 187, 120, 0.3);
                    z-index: 1000;
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    max-width: 350px;
                    animation: slideInRight 0.3s ease;
                `;
                
                document.body.appendChild(notification);
                
                // Auto-remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.style.animation = 'slideOutRight 0.3s ease';
                        setTimeout(() => {
                            if (notification.parentNode) {
                                notification.parentNode.removeChild(notification);
                            }
                        }, 300);
                    }
                }, 5000);
                
                // Manual close
                const closeBtn = notification.querySelector('.notification-close');
                closeBtn.addEventListener('click', () => {
                    notification.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                });
            }

            animateJobCards() {
                // Initial animation for job cards
                this.jobCards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    
                    setTimeout(() => {
                        card.style.transition = 'all 0.6s ease';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            }

            // Helper methods
            isCareersSection() {
                const careersSection = document.getElementById('careers');
                return careersSection && careersSection.contains(document.activeElement);
            }

            showNotification(message, backgroundColor = 'var(--primary)') {
                const notification = document.createElement('div');
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: ${backgroundColor};
                    color: white;
                    padding: 1rem 2rem;
                    border-radius: 10px;
                    z-index: 1000;
                    animation: slideInRight 0.3s ease;
                    max-width: 300px;
                    word-wrap: break-word;
                `;
                notification.textContent = message;
                document.body.appendChild(notification);
                
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.style.animation = 'slideOutRight 0.3s ease';
                        setTimeout(() => {
                            if (notification.parentNode) {
                                notification.parentNode.removeChild(notification);
                            }
                        }, 300);
                    }
                }, 3000);
            }

            announceToScreenReader(message) {
                const announcement = document.createElement('div');
                announcement.setAttribute('aria-live', 'polite');
                announcement.setAttribute('aria-atomic', 'true');
                announcement.className = 'sr-only';
                announcement.textContent = message;
                
                document.body.appendChild(announcement);
                
                setTimeout(() => {
                    if (announcement.parentNode) {
                        document.body.removeChild(announcement);
                    }
                }, 1000);
            }

            // Analytics tracking methods
            trackFilterUsage(filterType, filterValue) {
                console.log(`Filter used: ${filterType} = ${filterValue}`);
            }

            trackFilterReset() {
                console.log('Filters reset');
            }

            trackJobDetailView(jobTitle) {
                console.log(`Job details viewed: ${jobTitle}`);
            }

            trackJobApplication(jobTitle) {
                console.log(`Job application started: ${jobTitle}`);
            }

            // Public methods for external use
            openJobDetails(jobId) {
                const jobCard = document.querySelector(`[data-job-id="${jobId}"]`);
                if (jobCard) {
                    this.expandJobDetails(jobCard);
                }
            }

            filterByDepartment(department) {
                const departmentFilter = document.querySelector('[data-filter="department"]');
                if (departmentFilter) {
                    departmentFilter.value = department;
                    this.currentFilters.department = department;
                    this.applyFilters();
                }
            }

            // Cleanup method
            destroy() {
                // Remove event listeners and clean up
                console.log('Careers manager destroyed');
            }
        }

        // Add CSS for careers animations and interactions
        const careersStyles = document.createElement('style');
        careersStyles.textContent = `
            .job-card.focused {
                outline: 3px solid var(--accent);
                outline-offset: 3px;
            }
            
            .job-card.expanded {
                transform: scale(1.02);
                box-shadow: 0 20px 60px rgba(0,0,0,0.2);
                z-index: 10;
                position: relative;
            }
            
            .job-card.loading .btn-primary {
                pointer-events: none;
                opacity: 0.7;
            }
            
            .sr-only {
                position: absolute;
                width: 1px;
                height: 1px;
                padding: 0;
                margin: -1px;
                overflow: hidden;
                clip: rect(0, 0, 0, 0);
                white-space: nowrap;
                border: 0;
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
            
            .notification-close {
                background: none;
                border: none;
                color: white;
                font-size: 1.2rem;
                cursor: pointer;
                padding: 0.25rem;
                border-radius: 50%;
                transition: background-color 0.3s ease;
                flex-shrink: 0;
            }
            
            .notification-close:hover {
                background: rgba(255, 255, 255, 0.2);
            }
            
            .btn-link {
                background: none;
                border: none;
                color: var(--primary);
                text-decoration: underline;
                cursor: pointer;
                font-size: inherit;
                padding: 0;
            }
            
            .btn-link:hover {
                color: var(--secondary);
            }
        `;
        document.head.appendChild(careersStyles);

        // Initialize Careers Manager
        let careersManager;
        document.addEventListener('DOMContentLoaded', () => {
            const careersSection = document.getElementById('careers');
            if (careersSection) {
                careersManager = new CareersManager();
                
                // Make it globally accessible for button onclick handlers
                window.careersManager = careersManager;
            }
        });

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (careersManager) {
                careersManager.destroy();
            }
        });

        // ===== CONTACT FORM FUNCTIONALITY =====

        // Contact Form JavaScript (converted from jQuery)
        document.addEventListener('DOMContentLoaded', function() {
            // Wait a bit more to ensure all elements are loaded
            setTimeout(() => {
                // The element with id "contact-form" is a section, so we need to find the actual form inside it
                const contactFormSection = document.getElementById('contact-form');
                const contactForm = contactFormSection ? contactFormSection.querySelector('form') : document.querySelector('.modern-contact-form');
                
                if (!contactForm) {
                    console.warn('Contact form element not found');
                    return;
                }
                
                // Verify it's actually a form element
                if (contactForm.tagName !== 'FORM') {
                    console.error('Found element is not a form element, found:', contactForm.tagName);
                    return;
                }
                
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    try {
                        // Serialize form data (equivalent to jQuery's serialize())
                        const formData = new FormData(contactForm);
                        const serializedData = new URLSearchParams(formData).toString();
                        
                        // Reset form (equivalent to jQuery's trigger("reset"))
                        contactForm.reset();
                        
                        // AJAX call (equivalent to jQuery's $.ajax())
                        fetch('send_mail.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: serializedData
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Form submitted successfully:', data);
                        })
                        .catch(error => {
                            console.log('Form submission error:', error);
                            alert("Form submission failed. Please try again.");
                        });
                    } catch (error) {
                        console.error('Error processing form:', error);
                        alert("An error occurred while processing the form.");
                    }
                });
            }, 100); // Small delay to ensure DOM is fully ready
        });

/* ============================================================
   CUSTOMERS & AWARDS — Tab Switching, Stats Counter, Timeline
   ============================================================ */
(function () {
    'use strict';

    /* ── Helpers ── */
    function easeOutQuad(t) { return t * (2 - t); }

    function animateValue(el, from, to, duration) {
        const start = performance.now();
        function step(now) {
            const elapsed = now - start;
            const progress = Math.min(elapsed / duration, 1);
            const value = Math.round(from + (to - from) * easeOutQuad(progress));
            el.textContent = value;
            if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    /* ── Tab Switching ── */
    function initTabs() {
        const tabs = document.querySelectorAll('.customers-awards-nav .nav-tab');
        const customersPanel = document.getElementById('customers-content');
        const awardsPanel = document.getElementById('awards-content');

        if (!tabs.length || !customersPanel || !awardsPanel) return;

        let statsAnimated = false;

        function showPanel(section) {
            if (section === 'customers') {
                customersPanel.classList.add('active');
                awardsPanel.classList.remove('active');
                // Animate stats on first reveal
                if (!statsAnimated) {
                    statsAnimated = true;
                    animateCustomerStats();
                }
            } else {
                awardsPanel.classList.add('active');
                customersPanel.classList.remove('active');
                // Trigger timeline animations
                setTimeout(triggerTimelineAnimations, 80);
            }
        }

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) { t.classList.remove('active'); });
                tab.classList.add('active');
                showPanel(tab.dataset.section);
            });
        });

        // Initialise: customers panel is shown by default (already has .active in HTML)
        // Animate stats on first view when section scrolls in
        const section = document.getElementById('customers-awards');
        if (section) {
            const io = new IntersectionObserver(function (entries) {
                if (entries[0].isIntersecting && !statsAnimated) {
                    statsAnimated = true;
                    animateCustomerStats();
                    io.disconnect();
                }
            }, { threshold: 0.15 });
            io.observe(section);
        }
    }

    /* ── Customer Stats Counter (no stat cards in current layout — kept for future use) ── */
    function animateCustomerStats() {
        var cards = document.querySelectorAll('.customers-awards-section .stat-card');
        cards.forEach(function (card, i) {
            var numEl = card.querySelector('.stat-number');
            if (!numEl) return;
            var target = parseInt(numEl.dataset.target, 10);
            if (isNaN(target)) return;
            setTimeout(function () {
                animateValue(numEl, 0, target, 1800);
            }, i * 150);
        });
    }

    /* ── Timeline Scroll Reveal ── */
    function triggerTimelineAnimations() {
        var items = document.querySelectorAll('.timeline-item');
        if (!items.length) return;

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        items.forEach(function (item, i) {
            // Stagger via transition-delay so each item reveals sequentially
            item.style.transitionDelay = (i * 0.1) + 's';
            io.observe(item);
        });
    }

    /* ── Boot ── */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTabs);
    } else {
        initTabs();
    }
}());
