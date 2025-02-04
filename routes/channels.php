<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('draw', function () {
    return true;
});
