@echo off
setlocal

for %%I in ("%~dp0..") do set "PROJECT_ROOT=%%~fI"

set "DB_FILE=%PROJECT_ROOT%\database\database.sqlite"
set "BACKUP_DIR=%PROJECT_ROOT%\backups"

if not exist "%DB_FILE%" (
    echo Error: database file not found: "%DB_FILE%"
    exit /b 1
)

if not exist "%BACKUP_DIR%" (
    mkdir "%BACKUP_DIR%"
)

for /f %%I in ('powershell -NoProfile -Command "Get-Date -Format yyyyMMdd"') do set "BACKUP_DATE=%%I"

set "BACKUP_FILE=%BACKUP_DIR%\petshop_backup_%BACKUP_DATE%.sqlite"

copy /Y "%DB_FILE%" "%BACKUP_FILE%" >nul

if errorlevel 1 (
    echo Error: backup failed.
    exit /b 1
)

echo Backup created: "%BACKUP_FILE%"
exit /b 0
