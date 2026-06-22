@echo off  
echo Fixing vite...  
powershell -Command "Get-ChildItem -Path resources\views -Filter *.blade.php -Recurse | ForEach-Object { $content = Get-Content $_.FullName -Raw; $content = $content -replace '@vite\(\[.*?\]\)', '<script src=\"https://cdn.tailwindcss.com\"></script>'; Set-Content $_.FullName -Value $content }"  
php artisan view:clear  
php artisan config:clear 
