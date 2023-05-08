<?php

exec('composer update -y');
exec(__DIR__ . '/vendor/bin/phinx migrate');