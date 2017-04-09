<?php

namespace App\Observers;

use App\Models\Content\Chunk;
use Illuminate\Support\Facades\Artisan;

class ChunkObserver
{
    /**
     * @param Chunk $chunk
     */
    public function saved(Chunk $chunk)
    {
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
    }
}