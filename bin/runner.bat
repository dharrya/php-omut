@ECHO OFF
SET BIN_TARGET=%~dp0/runner
chcp 65001
php "%BIN_TARGET%" %*
