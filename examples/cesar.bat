@ECHO OFF

CALL :cipher out "examplestring" 5 "abcdefghijklmnopqrstuvwxyz"

echo %out%
EXIT /B 0

:index <string> <char> <resultVar>
    SET tmp=%~1%strterm%
    SET i=0
    :loop1
    SET char=%tmp:~0,1%
    SET tmp=%tmp:~1%
    IF "%~2" == "%char%" GOTO end1
    SET /A i=i+1
    IF "%tmp%" == "%strterm%" (
        SET i=-1
        GOTO end1
    )
    GOTO loop1
    :end1
    SET %3=%i%
EXIT /B 0

:cipher <resultVar> <input> <offset> <charset>
    SET tmp2=%~2%strterm%
    SET charset=%~4
    SET offset=%~3
    SET _length=1
    call :strlen set_length charset
    SET str=
    :loop2
    SET char2=%tmp2:~0,1%
    SET tmp2=%tmp2:~1%
    CALL :index %charset% %char2% j
    SET /A j=(j+offset+set_length)%%set_length
    CALL SET char=%%charset:~%j%,%_length%%%
    SET str=%str%%char%
    IF NOT "%tmp2%" == "%strterm%" GOTO loop2
    SET %1=%str%
EXIT /B 0

:strlen <resultVar> <stringVar>
(
    setlocal EnableDelayedExpansion
    set "s=!%~2!#"
    set "len=0"
    for %%P in (4096 2048 1024 512 256 128 64 32 16 8 4 2 1) do (
        if "!s:~%%P,1!" NEQ "" (
            set /a "len+=%%P"
            set "s=!s:~%%P!"
        )
    )
)
(
    endlocal
    set "%~1=%len%"
    exit /b
)