<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CivicFix - Smart Complaint Reporting</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                background: linear-gradient(135deg, #F8FAFC 0%, #F0F4F8 100%);
                min-height: 100vh;
                color: #1F2937;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
            }

            header {
                padding: 24px 0;
                border-bottom: 1px solid rgba(30, 64, 175, 0.08);
                animation: fadeInDown 0.6s ease-out;
            }

            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            nav {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .logo {
                display: flex;
                align-items: center;
                gap: 12px;
                font-size: 24px;
                font-weight: 700;
                color: #1E3A8A;
            }

            .logo-icon {
                width: 40px;
                height: 40px;
                background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                animation: pulse 2s ease-in-out infinite;
            }

            @keyframes pulse {
                0%, 100% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(37, 99, 235, 0.4);
                }
                50% {
                    transform: scale(1.05);
                    box-shadow: 0 0 0 10px rgba(37, 99, 235, 0);
                }
            }

            .nav-links {
                display: flex;
                gap: 20px;
                align-items: center;
            }

            .btn {
                padding: 10px 24px;
                border-radius: 10px;
                font-weight: 600;
                font-size: 15px;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
                transition: all 0.2s ease;
            }

            .btn-secondary {
                color: #475569;
                border: 1px solid #E2E8F0;
                background: white;
            }

            .btn-secondary:hover {
                border-color: #2563EB;
                color: #2563EB;
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
            }

            .btn-primary {
                background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
                color: white;
                border: none;
                box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
                background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%);
            }

            .hero {
                padding: 80px 0;
            }

            .hero-inner {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 60px;
                align-items: center;
            }

            .hero-content {
                animation: fadeInLeft 0.8s ease-out;
            }

            @keyframes fadeInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-40px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .hero-content h1 {
                font-size: 56px;
                line-height: 1.1;
                margin-bottom: 24px;
                color: #0F172A;
            }

            .hero-content h1 span {
                color: #2563EB;
                position: relative;
                display: inline-block;
            }

            .hero-content h1 span::after {
                content: '';
                position: absolute;
                bottom: 4px;
                left: 0;
                width: 100%;
                height: 8px;
                background: rgba(37, 99, 235, 0.15);
                z-index: -1;
                border-radius: 4px;
            }

            .hero-content p {
                font-size: 18px;
                line-height: 1.6;
                color: #64748B;
                margin-bottom: 32px;
                max-width: 480px;
            }

            .hero-buttons {
                display: flex;
                gap: 16px;
            }

            .hero-image {
                background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
                border-radius: 24px;
                padding: 40px;
                display: flex;
                flex-direction: column;
                gap: 20px;
                animation: fadeInRight 0.8s ease-out 0.2s both;
            }

            @keyframes fadeInRight {
                from {
                    opacity: 0;
                    transform: translateX(40px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .feature-card {
                background: white;
                border-radius: 16px;
                padding: 24px;
                box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.08);
                display: flex;
                gap: 16px;
                align-items: flex-start;
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 24px -8px rgba(15, 23, 42, 0.15);
            }

            .feature-icon {
                width: 48px;
                height: 48px;
                background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                transition: all 0.3s ease;
            }

            .feature-icon svg {
                stroke: #1E3A8A;
            }

            .feature-card:hover .feature-icon {
                transform: scale(1.1) rotate(5deg);
                background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            }

            .feature-card:hover .feature-icon svg {
                stroke: white;
            }



            .feature-card h3 {
                font-size: 16px;
                font-weight: 600;
                margin-bottom: 4px;
                color: #0F172A;
            }

            .feature-card p {
                font-size: 14px;
                color: #64748B;
            }

            .features {
                padding: 80px 0;
            }

            .section-title {
                text-align: center;
                margin-bottom: 60px;
                animation: fadeInUp 0.8s ease-out;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .section-title h2 {
                font-size: 36px;
                margin-bottom: 16px;
                color: #0F172A;
            }

            .section-title p {
                font-size: 18px;
                color: #64748B;
            }

            .features-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 24px;
            }

            .feature-box {
                background: white;
                border-radius: 16px;
                padding: 32px;
                box-shadow: 0 4px 6px -1px rgba(15, 23, 42, 0.05);
                border: 1px solid #E2E8F0;
                transition: all 0.3s ease;
                animation: fadeInUp 0.8s ease-out;
            }

            .features-grid .feature-box:nth-child(1) { animation-delay: 0.1s; }
            .features-grid .feature-box:nth-child(2) { animation-delay: 0.2s; }
            .features-grid .feature-box:nth-child(3) { animation-delay: 0.3s; }

            .feature-box:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 40px -12px rgba(15, 23, 42, 0.15);
                border-color: #2563EB;
            }

            .feature-box-icon {
                width: 56px;
                height: 56px;
                background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 20px;
                transition: all 0.3s ease;
            }

            .feature-box-icon svg {
                stroke: #1E3A8A;
            }

            .feature-box:hover .feature-box-icon {
                transform: scale(1.15);
                background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            }

            .feature-box:hover .feature-box-icon svg {
                stroke: white;
            }



            .feature-box h3 {
                font-size: 20px;
                font-weight: 600;
                margin-bottom: 12px;
                color: #0F172A;
            }

            .feature-box p {
                font-size: 15px;
                color: #64748B;
                line-height: 1.6;
            }

            footer {
                padding: 40px 0;
                text-align: center;
                border-top: 1px solid #E2E8F0;
                color: #94A3B8;
                animation: fadeIn 0.8s ease-out 0.5s both;
            }

            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            @media (max-width: 968px) {
                .hero-inner {
                    grid-template-columns: 1fr;
                    padding: 40px 0;
                }

                .hero-content h1 {
                    font-size: 40px;
                }

                .features-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>
    </head>
    <body>
        <header>
            <div class="container">
                <nav>
                    <div class="logo">
                        <div class="logo-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 22V12H15V22" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <span>CivicFix</span>
                    </div>
                    <div class="nav-links">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-secondary">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-secondary">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
                        <div class="hero-content">
                            <h1>Report civic issues, <span>get them fixed</span></h1>
                            <p>A simple, transparent way to report public problems like garbage, water leaks, broken roads, and more. Track progress and see real change in your community.</p>
                            <div class="hero-buttons">
                                @if (Route::has('login'))
                                    @auth
                                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                                        <a href="{{ route('issues.create') }}" class="btn btn-secondary">Report Issue</a>
                                    @else
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                                        @endif
                                        <a href="{{ route('login') }}" class="btn btn-secondary">Log In</a>
                                    @endauth
                                @endif
                            </div>
                        </div>
                        <div class="hero-image">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M23 19V21H1V19" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M4 15L6 5H18L20 15" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M10 10H14" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3>Upload Photos</h3>
                                    <p>Attach images as proof of the issue</p>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M21 10C21 17 12 23 12 23C12 23 3 17 3 10C3 7.61305 3.94821 5.32387 5.63604 3.63604C7.32387 1.94821 9.61305 1 12 1C14.3869 1 16.6761 1.94821 18.364 3.63604C20.0518 5.32387 21 7.61305 21 10Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3>Add Location</h3>
                                    <p>Pin the exact location on the map</p>
                                </div>
                            </div>
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 3V21H21" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3 7H7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3 11H11" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M3 15H7" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M12 7L16 12L21 5" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3>Track Status</h3>
                                    <p>See real-time updates on your complaint</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="features">
                <div class="container">
                    <div class="section-title">
                        <h2>How It Works</h2>
                        <p>Three simple steps to make your community better</p>
                    </div>
                    <div class="features-grid">
                        <div class="feature-box">
                            <div class="feature-box-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 20H21" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.5 3.5C16.8978 3.10218 17.4374 2.87868 18 2.87868C18.5626 2.87868 19.1022 3.10218 19.5 3.5C19.8978 3.89782 20.1213 4.43742 20.1213 5C20.1213 5.56258 19.8978 6.10218 19.5 6.5L7 19L3 20L4 16L16.5 3.5Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3>1. Report the Issue</h3>
                            <p>Create an account and submit your complaint with details, photos, and exact location.</p>
                        </div>
                        <div class="feature-box">
                            <div class="feature-box-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 12H5" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M19 12H23" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 1V5" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 19V23" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3>2. We Review It</h3>
                            <p>Our team reviews your complaint and updates the status as work progresses.</p>
                        </div>
                        <div class="feature-box">
                            <div class="feature-box-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22 11.08V12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C13.6907 2 15.2587 2.43779 16.5537 3.23974" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22 4L12 14.01L9 11.01" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h3>3. Problem Solved</h3>
                            <p>Get notified when your issue is resolved and your community becomes better!</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <div class="container">
                <p>© 2026 CivicFix. Making communities better, one issue at a time.</p>
            </div>
        </footer>
    </body>
</html>
