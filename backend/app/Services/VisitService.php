<?php

namespace App\Services;

use App\Models\Visit;
use App\Models\AccessCard;
use App\Notifications\VisitCreatedNotification;
use Illuminate\Support\Facades\DB;

class VisitService {
    public function registerVisit(array $data): Visit {
        return DB::transaction(function () use ($data) {
            $card = AccessCard::findOrFail($data['access_card_id']);
            $card->update(['status' => 'issued']);

            $visit = Visit::create([
                'visitor_id' => $data['visitor_id'],
                'user_id' => $data['target_user_id'],
                'access_card_id' => $card->id,
                'entered_at' => now(),
            ]);

            $visit->load(['visitor', 'accessCard']);
            $employee = $visit->user; 
            $employee->notify(new VisitCreatedNotification($visit));

            return $visit;
        });
    }
}

