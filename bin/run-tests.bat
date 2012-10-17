@echo off
call phpunit -v --bootstrap %~dp0../tests/bootstrap.php %~dp0../tests/SCLoaderTest.php
@pause