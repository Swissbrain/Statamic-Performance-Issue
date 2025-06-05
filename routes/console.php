<?php

Schedule::command(\App\Console\Commands\ClearUnusedQuotesCommand::class)->daily();