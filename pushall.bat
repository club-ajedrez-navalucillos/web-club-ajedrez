@echo off
:: Lee la versión desde el archivo docs\VERSION.md
for /f "tokens=3" %%i in ('findstr /i "Versión actual:" docs\VERSION.md') do set version=%%i

:: Pide mensaje de commit personalizado
set /p msg=Introduce el mensaje del commit: 

:: Combina mensaje con versión
git add .
git commit -m "[%version%] %msg%"
git push origin main
pause
