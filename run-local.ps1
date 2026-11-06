param([int]$Port = 8000)

$ErrorActionPreference = 'Stop'
Set-Location -LiteralPath $PSScriptRoot
$phpExecutable = if (Test-Path -LiteralPath 'C:\xampp\php\php.exe') { 'C:\xampp\php\php.exe' } else { (Get-Command php -ErrorAction Stop).Source }
$phpModules = & $phpExecutable -m
$phpOptions = @()
if ($phpModules -notcontains 'gd') { $phpOptions += @('-d', 'extension=gd') }
Write-Host "The Daily Fit: http://127.0.0.1:$Port (Ctrl+C to stop)"
# Launch PHP directly so the server receives the GD option, even when php.ini disables it.
Push-Location -LiteralPath (Join-Path $PSScriptRoot 'public')
try {
    & $phpExecutable @phpOptions -S "127.0.0.1:$Port" -t . ../vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php
} finally {
    Pop-Location
}
