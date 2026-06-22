<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAVBAR TEST - RADJATIKET</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #050B14;
            color: white;
            padding: 20px;
        }
        
        .test-container {
            max-width: 1200px;
            margin: 0 auto;
            background: #0B1220;
            border: 2px solid #F5C518;
            border-radius: 20px;
            padding: 40px;
        }
        
        h1 {
            color: #F5C518;
            margin-bottom: 30px;
            font-size: 32px;
        }
        
        .test-section {
            margin-bottom: 40px;
            padding: 20px;
            background: rgba(255,255,255,0.02);
            border-radius: 10px;
        }
        
        .test-section h2 {
            color: #F5C518;
            margin-bottom: 20px;
            font-size: 20px;
        }
        
        .test-links {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .test-link {
            display: block;
            padding: 15px 25px;
            background: #F5C518;
            color: #000;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
            text-align: center;
            transition: all 0.3s;
        }
        
        .test-link:hover {
            background: #D4A017;
            transform: translateY(-2px);
        }
        
        .test-button {
            display: block;
            width: 100%;
            padding: 15px 25px;
            background: #00ff00;
            color: #000;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .test-button:hover {
            background: #00cc00;
            transform: translateY(-2px);
        }
        
        .console-box {
            background: #000;
            border: 2px solid #333;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            max-height: 400px;
            overflow-y: auto;
        }
        
        .console-line {
            margin: 5px 0;
            color: #0f0;
        }
        
        .console-error {
            color: #f00;
        }
        
        .console-info {
            color: #0ff;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1>🔧 NAVBAR CLICK TEST PAGE</h1>
        
        <!-- TEST 1: Standard Links -->
        <div class="test-section">
            <h2>TEST 1: Standard &lt;a&gt; Links (Normal Behavior)</h2>
            <div class="test-links">
                <a href="{{ route('home') }}" class="test-link">
                    ✓ Link ke HOME ({{ route('home') }})
                </a>
                <a href="{{ route('events.index') }}" class="test-link">
                    ✓ Link ke EVENTS ({{ route('events.index') }})
                </a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.index') }}" class="test-link">
                            ✓ Link ke ADMIN ({{ route('admin.index') }})
                        </a>
                    @endif
                @endauth
            </div>
            <p style="margin-top: 15px; color: #888;">
                ☝️ Klik salah satu link di atas. Jika redirect, berarti routing berfungsi normal.
            </p>
        </div>
        
        <!-- TEST 2: Button with onClick -->
        <div class="test-section">
            <h2>TEST 2: Button with window.location (JavaScript Navigation)</h2>
            <div class="test-links">
                <button class="test-button" onclick="window.location.href='{{ route('home') }}'">
                    ✓ Navigate ke HOME via JavaScript
                </button>
                <button class="test-button" onclick="window.location.href='{{ route('events.index') }}'">
                    ✓ Navigate ke EVENTS via JavaScript
                </button>
            </div>
            <p style="margin-top: 15px; color: #888;">
                ☝️ Jika ini berfungsi tapi navbar tidak, berarti ada masalah z-index/pointer-events.
            </p>
        </div>
        
        <!-- TEST 3: Console Diagnostic -->
        <div class="test-section">
            <h2>TEST 3: Browser Diagnostic</h2>
            <div class="test-links">
                <button class="test-button" onclick="runDiagnostic()">
                    🔍 Run Full Diagnostic
                </button>
            </div>
            <div id="console-output" class="console-box">
                <div class="console-line console-info">Click button di atas untuk run diagnostic...</div>
            </div>
        </div>
        
        <!-- Back Button -->
        <div class="test-section">
            <a href="{{ route('home') }}" class="test-link" style="background: #dc3545;">
                ← Kembali ke Homepage
            </a>
        </div>
    </div>

    <script>
        function log(message, type = 'info') {
            const consoleBox = document.getElementById('console-output');
            const line = document.createElement('div');
            line.className = `console-line console-${type}`;
            line.textContent = `[${new Date().toLocaleTimeString()}] ${message}`;
            consoleBox.appendChild(line);
            consoleBox.scrollTop = consoleBox.scrollHeight;
            
            // Also log to real console
            console.log(message);
        }
        
        function runDiagnostic() {
            document.getElementById('console-output').innerHTML = '';
            
            log('═══════════════════════════════════════', 'info');
            log('STARTING DIAGNOSTIC...', 'info');
            log('═══════════════════════════════════════', 'info');
            
            // Test 1: Window object
            log('✓ window object exists: ' + (typeof window !== 'undefined'));
            log('✓ window.location available: ' + (typeof window.location !== 'undefined'));
            log('✓ Current URL: ' + window.location.href);
            
            // Test 2: Routes
            log('✓ HOME route: {{ route("home") }}');
            log('✓ EVENTS route: {{ route("events.index") }}');
            
            // Test 3: Try navigation
            setTimeout(() => {
                log('Testing navigation in 3 seconds...', 'info');
                setTimeout(() => {
                    log('Navigating to HOME...', 'info');
                    window.location.href = '{{ route("home") }}';
                }, 3000);
            }, 100);
        }
        
        // Auto-run on load
        window.addEventListener('DOMContentLoaded', function() {
            console.log('%c NAVBAR TEST PAGE LOADED', 'color: #F5C518; font-size: 20px; font-weight: bold');
            console.log('%c All links should work perfectly here', 'color: #0f0');
            console.log('%c If they work here but not on homepage, there is a CSS/JS conflict', 'color: #ff0');
        });
    </script>
</body>
</html>
