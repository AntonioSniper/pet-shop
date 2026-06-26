@echo off
setlocal

for %%I in ("%~dp0..") do set "PROJECT_ROOT=%%~fI"

set "DB_FILE=%PROJECT_ROOT%\database\database.sqlite"
set "BACKUP_DIR=%PROJECT_ROOT%\backups"

if "%~1"=="" (
    echo Usage: restore_sqlite.bat backup_file_name_or_path
    echo Example: restore_sqlite.bat petshop_backup_20260509.sqlite
    exit /b 1
)

set "INPUT_BACKUP=%~1"

if exist "%BACKUP_DIR%\%INPUT_BACKUP%" (
    set "BACKUP_FILE=%BACKUP_DIR%\%INPUT_BACKUP%"
) else (
    if exist "%INPUT_BACKUP%" (
        for %%I in ("%INPUT_BACKUP%") do set "BACKUP_FILE=%%~fI"
    ) else (
        echo Error: backup file not found: "%INPUT_BACKUP%"
        exit /b 1
    )
)

copy /Y "%BACKUP_FILE%" "%DB_FILE%" >nul

if errorlevel 1 (
    echo Error: restore failed.
    exit /b 1
)

echo Database restored from: "%BACKUP_FILE%"
exit /b 0
