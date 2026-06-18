
$files = Get-ChildItem -Path "c:\xampp\htdocs\MediFix\MediFix\run" -Filter *.php -Recurse

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    
    # Replace footer text patterns
    # Handles Different names like INES, Jemima, etc.
    $newContent = $content -replace '<p class="mb-0 fs-4">Designed and Developed by .*?</p>', '<p class="mb-0 fs-4">Masaka Hospital</p>'
    
    # Replace logo path
    $newContent = $newContent -replace '\.\./assets/images/logos/dark-logo\.svg', '../assets/images/logos/masaka-logo.png'
    
    if ($content -ne $newContent) {
        Set-Content $file.FullName $newContent
        Write-Host "Updated: $($file.Name)"
    }
}
