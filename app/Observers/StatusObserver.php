<?php

namespace App\Observers;

use App\Models\Status;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class StatusObserver
{
    public function creating(Status $status)
    {
        //
    }

    public function updating(Status $status)
    {
        //
    }

    public function deleted(Status $status)
    {
        \DB::table('comments')->where('status_id', $status->id)->delete();
    }
}