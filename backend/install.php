<?php

exec('composer update');
exec(__DIR__ . '/vendor/bin/phinx migrate');