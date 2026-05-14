<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

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

            .page-container {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 40px 20px;
            }

            .logo-link {
                text-decoration: none;
                display: flex;
                align-items: center;
                gap: 12px;
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

            .logo-icon {
                width: 56px;
                height: 56px;
                background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
                border-radius: 14px;
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

            .logo-text {
                font-size: 28px;
                font-weight: 700;
                color: #1E3A8A;
            }

            .form-card {
                width: 100%;
                max-width: 420px;
                margin-top: 32px;
                padding: 32px;
                background: white;
                border-radius: 20px;
                box-shadow: 0 10px 40px -10px rgba(15, 23, 42, 0.15);
                animation: fadeInUp 0.8s ease-out 0.2s both;
                border: 1px solid #E2E8F0;
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

            .form-group {
                margin-bottom: 20px;
            }

            .form-label {
                display: block;
                font-size: 14px;
                font-weight: 600;
                color: #374151;
                margin-bottom: 8px;
            }

            .form-input {
                width: 100%;
                padding: 12px 16px;
                font-size: 15px;
                border: 2px solid #E5E7EB;
                border-radius: 12px;
                outline: none;
                transition: all 0.2s ease;
                font-family: inherit;
                background: #F9FAFB;
            }

            .form-input:focus {
                border-color: #2563EB;
                box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
                background: white;
            }

            .form-input:hover {
                border-color: #9CA3AF;
            }

            .form-error {
                margin-top: 8px;
                font-size: 13px;
                color: #EF4444;
            }

            .remember-me {
                display: flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;
                user-select: none;
                margin-bottom: 12px;
            }

            .remember-me input[type="checkbox"] {
                width: 18px;
                height: 18px;
                accent-color: #2563EB;
                cursor: pointer;
            }

            .remember-me span {
                font-size: 14px;
                color: #6B7280;
            }

            .form-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 24px;
            }

            .forgot-link {
                font-size: 14px;
                color: #6B7280;
                text-decoration: underline;
                transition: color 0.2s ease;
            }

            .forgot-link:hover {
                color: #2563EB;
            }

            .btn {
                padding: 12px 28px;
                border-radius: 12px;
                font-weight: 600;
                font-size: 15px;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
                transition: all 0.2s ease;
                border: none;
                font-family: inherit;
            }

            .btn-primary {
                background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
                color: white;
                box-shadow: 0 4px 14px rgba(37, 99, 235, 0.3);
            }

            .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
                background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%);
            }

            .session-status {
                margin-bottom: 20px;
                padding: 12px 16px;
                background: #EFF6FF;
                border: 1px solid #BFDBFE;
                border-radius: 12px;
                color: #1E40AF;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="page-container">
            <div>
                <a href="/" class="logo-link">
                    <div class="logo-icon">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 9L12 2L21 9V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C4.46957 22 3.96086 21.7893 3.58579 21.4142C3.21071 21.0391 3 20.5304 3 20V9Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M9 22V12H15V22" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <span class="logo-text">CivicFix</span>
                </a>
            </div>

            <div class="form-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
