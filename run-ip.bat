@echo off
:: USER PROMPT: "yr aik link bna do jo ya same web site ip per chaly"
title Pet Marketplace - Local Network Server (IP Mode)
color 0A

echo =====================================================================
echo           PET MARKETPLACE - RUNNING ON LOCAL NETWORK / IP
echo =====================================================================
echo.

:: Detect primary IPv4 address
for /f "tokens=4" %%a in ('route print ^| findstr 0.0.0.0 ^| findstr /v "0.0.0.0.*0.0.0.0"') do (
    set LOCAL_IP=%%a
    goto :found_ip
)

:found_ip
if "%LOCAL_IP%"=="" (
    for /f "tokens=2 delims=:" %%a in ('ipconfig ^| findstr /i "IPv4" ^| findstr "192.168."') do (
        set LOCAL_IP=%%a
        goto :clean_ip
    )
)

:clean_ip
set LOCAL_IP=%LOCAL_IP: =%
if "%LOCAL_IP%"=="" set LOCAL_IP=192.168.1.24

echo  [+] Local Wi-Fi / Network IP Address : %LOCAL_IP%
echo.
echo  -------------------------------------------------------------------
echo  [LINK 1] Open from Mobile / Other Devices on Same Wi-Fi:
echo         http://%LOCAL_IP%:8000
echo.
echo  [LINK 2] Open from this PC (Localhost):
echo         http://127.0.0.1:8000
echo  -------------------------------------------------------------------
echo.
echo  Starting Laravel Server on 0.0.0.0:8000 ...
echo  Press Ctrl + C at any time to stop the server.
echo.
echo  Opening http://%LOCAL_IP%:8000 in your browser...
echo =====================================================================
echo.

start "" "http://%LOCAL_IP%:8000"
php artisan serve --host=0.0.0.0 --port=8000
pause
