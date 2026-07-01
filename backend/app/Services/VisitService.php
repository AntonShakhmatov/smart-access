<?php

namespace App\Services;

use App\Models\Visit;
use App\Models\AccessCard;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendVisitNotificationJob;

class VisitService {
    public function registerVisit(array $data): Visit {
        return DB::transaction(function () use ($data) {
            $card = AccessCard::findOrFail($data['access_card_id']);
            $card->update(['status' => 'issued']);

            $visit = Visit::create([
                'visitor_id' => $data['visitor_id'],
                'user_id' => $data['user_id'],
                'access_card_id' => $card->id,
                'entered_at' => now(),
            ]);

            SendVisitNotificationJob::dispatch($visit->id)->onQueue('notification');

            return $visit;
        });
    }
}

