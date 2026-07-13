<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pharmacy System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <style>
        :root {
            --ph-primary: #0d7f86;
            --ph-accent: #17c1ff;
            --muted: #6c757d
        }

        body {
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial
        }

        .hero {
            background: linear-gradient(135deg, #f3fff6 0%, #e6fbff 100%);
            padding: 4rem 0
        }

        .feature-icon {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ph-primary);
            box-shadow: 0 4px 12px rgba(13, 127, 134, 0.08)
        }

        .medicine-card img {
            height: 140px;
            object-fit: contain;
            background: #fff
        }

        .section-title {
            color: var(--ph-primary);
            font-weight: 700
        }

        .user-avatar {
            width: 72px;
            height: 72px;
            border-radius: 12px;
            object-fit: cover
        }

        footer {
            background: #0b2b2f;
            color: #dfeff0;
            padding: 2rem 0
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom nav-glass">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('backend/assets/images/Pharmacy-png.png') }}" alt="logo" height="40"
                    class="me-2">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
                aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-5 mb-3">Delivering Care, One Prescription at a Time</h1>
                    <p class="lead text-muted">Fast, reliable pharmacy services with expert advice and home delivery.
                    </p>
                    <div class="d-flex gap-2 mt-4">
                        <a href="#medicines" class="btn btn-primary btn-lg">Shop Medicines</a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-secondary btn-lg">Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <div class="hero-media d-inline-block">
                        <img src="https://images.unsplash.com/photo-1532938911079-1b06ac7ceec7?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bWVkaWNpbmV8ZW58MHx8MHx8fDA%3D"
                            alt="pharmacy team" class="img-fluid rounded-3 shadow-lg" style="max-height:320px"
                            loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Features -->
    <section class="py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                        <div class="feature-icon mb-3 mx-auto"><i class="fa-solid fa-truck"></i></div>
                        <h5>Fast Delivery</h5>
                        <p class="text-muted small">Get medicines delivered to your door quickly.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                        <div class="feature-icon mb-3 mx-auto"><i class="fa-solid fa-user-doctor"></i></div>
                        <h5>Licensed Pharmacists</h5>
                        <p class="text-muted small">Professional advice from experienced staff.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                        <div class="feature-icon mb-3 mx-auto"><i class="fa-solid fa-pills"></i></div>
                        <h5>Wide Selection</h5>
                        <p class="text-muted small">Thousands of medicines and health products.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-4 bg-white rounded-3 shadow-sm h-100">
                        <div class="feature-icon mb-3 mx-auto"><i class="fa-solid fa-phone"></i></div>
                        <h5>24/7 Support</h5>
                        <p class="text-muted small">We're here to help whenever you need us.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row align-items-center gy-3">
                <div class="col-6 col-md-2 text-center"><img
                        src="{{ asset('frontend/uploads/sites/40/2023/10/Brand-1.png') }}" alt="brand"
                        class="img-fluid" style="max-height:60px"></div>
                <div class="col-6 col-md-2 text-center"><img
                        src="{{ asset('frontend/uploads/sites/40/2023/10/Brand-2.png') }}" alt="brand"
                        class="img-fluid" style="max-height:60px"></div>
                <div class="col-6 col-md-2 text-center"><img
                        src="{{ asset('frontend/uploads/sites/40/2023/10/Brand-3.png') }}" alt="brand"
                        class="img-fluid" style="max-height:60px"></div>
                <div class="col-6 col-md-2 text-center"><img
                        src="{{ asset('frontend/uploads/sites/40/2023/10/Brand-4.png') }}" alt="brand"
                        class="img-fluid" style="max-height:60px"></div>
                <div class="col-6 col-md-2 text-center"><img
                        src="{{ asset('frontend/uploads/sites/40/2023/10/Brand-5.png') }}" alt="brand"
                        class="img-fluid" style="max-height:60px"></div>
            </div>
        </div>
    </section>

    <!-- Medicines -->
    <main class="py-5">
        <div class="container">
            <div class="mb-5 text-center">
                <h2 class="section-title">Featured Medicines</h2>
                <p class="text-muted">Browse some of our available medicines. Click any item for details in the admin
                    area.</p>
            </div>

            <div id="medicines" class="row g-4">
                @forelse($medicines as $medicine)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card medicine-card h-100">
                            @if ($medicine->image)
                                <img src="{{ asset($medicine->image) }}" class="card-img-top p-3"
                                    alt="{{ $medicine->name }}">
                            @else
                                <img src="{{ asset('frontend/assets/images/default-medicine.jpg') }}"
                                    class="card-img-top p-3" alt="{{ $medicine->name }}">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-1">{{ $medicine->name }}</h5>
                                <p class="text-muted mb-2 small">{{ $medicine->category->name ?? 'Uncategorized' }}
                                </p>
                                <p class="mb-2 small text-muted">Supplier: {{ $medicine->supplier->name ?? '—' }}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="price-pill">{{ number_format($medicine->selling_price ?? 0, 2) }}
                                        Afn</span>
                                    <a href="#" class="btn btn-sm btn-outline-primary">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">No medicines found.</div>
                    </div>
                @endforelse
            </div>

            <!-- Who We Are -->
            <div class="row mt-5 align-items-center">
                <div class="col-md-6">
                    <h3 class="section-title">Who We Are</h3>
                    <h4 class="mb-3">We Are The Most Trusted Pharmacy In This Town</h4>
                    <p class="text-muted">We combine professional expertise with compassionate service to deliver
                        wellness to our community. Our pharmacists are licensed and our delivery is reliable.</p>
                    <a href="{{ route('about') }}" class="btn btn-outline-primary mt-3">More About Us</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('frontend/uploads/sites/40/2023/10/young-female-pharmacist-posing-while-working-in-a-pharmacy-e1697689073593.jpg') }}"
                        alt="pharmacist" class="img-fluid rounded-3">
                </div>
            </div>

            <!-- Users -->
            <div class="mt-5">
                <h3 class="section-title text-center">Our Users</h3>
                <p class="text-muted text-center">Some of the users registered in the system.</p>
                <div class="row g-4 mt-3">
                    @if (isset($users) && $users->count())
                        @foreach ($users->take(8) as $u)
                            <div class="col-6 col-md-3">
                                <div class="card user-card h-100 text-center p-3">
                                    @if (isset($u->image) && $u->image)
                                        <img src="{{ asset($u->image) }}" alt="{{ $u->name }}"
                                            class="user-avatar mb-3 mx-auto d-block">
                                    @else
                                        <img src="{{ asset('frontend/assets/images/default-avatar.png') }}"
                                            alt="{{ $u->name }}" class="user-avatar mb-3 mx-auto d-block">
                                    @endif
                                    <h6 class="mb-0">{{ $u->name }}</h6>
                                    <p class="small muted-small">{{ $u->email }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-info">No users found.</div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </main>

    <!-- CTA -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h3 class="mb-3">Need a consultation?</h3>
            <p class="mb-3">Contact our pharmacists for prescription advice and medication reviews.</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg">Get in Touch</a>
        </div>
    </section>

    <!-- Services -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="section-title">Our Services</h3>
                <p class="text-muted">Professional pharmacy services to support your health needs.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm">
                        <div class="mb-3 feature-icon mx-auto"><i class="fa-solid fa-capsules fa-lg"></i></div>
                        <h5>Prescription Fulfilment</h5>
                        <p class="small text-muted">Fast, accurate dispensing with safety checks.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm">
                        <div class="mb-3 feature-icon mx-auto"><i class="fa-solid fa-shield-halved fa-lg"></i></div>
                        <h5>Medication Reviews</h5>
                        <p class="small text-muted">Expert advice to optimise treatments and avoid interactions.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm">
                        <div class="mb-3 feature-icon mx-auto"><i class="fa-solid fa-truck-fast fa-lg"></i></div>
                        <h5>Home Delivery</h5>
                        <p class="small text-muted">Reliable local deliveries for your convenience.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card h-100 text-center p-3 border-0 shadow-sm">
                        <div class="mb-3 feature-icon mx-auto"><i class="fa-solid fa-hands-holding-circle fa-lg"></i>
                        </div>
                        <h5>Vaccination Support</h5>
                        <p class="small text-muted">Guidance and support for routine immunisations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h3 class="section-title">What Our Customers Say</h3>
                <p class="text-muted">Real feedback from people we serve.</p>
            </div>
            <div id="testimonials" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card border-0 shadow-sm p-4 text-center">
                                    <p class="mb-3">"Fast delivery and friendly pharmacists — helped me sort my
                                        medication quickly."</p>
                                    <small class="text-muted">— Jane D.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card border-0 shadow-sm p-4 text-center">
                                    <p class="mb-3">"Excellent service and clear advice on my prescriptions."</p>
                                    <small class="text-muted">— Ahmed K.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonials"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonials"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- FAQ + Newsletter -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-6">
                    <h3 class="section-title">Frequently Asked Questions</h3>
                    <div class="accordion" id="faq">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    Do you deliver medicines?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="faq1"
                                data-bs-parent="#faq">
                                <div class="accordion-body">Yes — we provide local home delivery for prescriptions and
                                    orders.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faq2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Can I get advice from a pharmacist?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2"
                                data-bs-parent="#faq">
                                <div class="accordion-body">Our licensed pharmacists are available to provide private
                                    medication reviews and advice.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="section-title">Subscribe for Updates</h3>
                    <p class="text-muted">Get health tips and store updates delivered to your inbox.</p>
                    <form action="{{ route('contact') }}" method="get" class="d-flex gap-2">
                        <input type="email" name="email" class="form-control" placeholder="you@example.com"
                            required>
                        <button class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Pharmacy System</h4>
                        <p class="small">Quality healthcare products with expert advice. Serving the community with
                            care.</p>
                        <p class="small">Address: 123 Main St • Phone: +93(0)72929565</p>
                    </div>
                    <div class="col-md-3">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="#medicines">Medicines</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <h5>Contact</h5>
                        <p class="small">afghanshaker21@gmail.com</p>
                        <p class="small">Mon–Sat • 8am–8pm</p>
                        <div class="social mt-2">
                            <a href="#" aria-label="facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="twitter"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="instagram"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h5>Subscribe</h5>
                        <form class="newsletter" action="{{ route('contact') }}" method="get">
                            <div class="d-flex">
                                <input type="email" name="email" class="form-control form-control-sm me-2"
                                    placeholder="you@example.com" required>
                                <button class="btn btn-sm btn-primary">OK</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container d-flex justify-content-between align-items-center">
                <div class="small">&copy; {{ date('Y') }} Pharmacy System. All rights reserved.</div>
                <div class="small">Powered by Pharmacy System</div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
