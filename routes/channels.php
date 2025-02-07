<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('draw', function ($user) {
    return true;
});
