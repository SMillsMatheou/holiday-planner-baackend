<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityParticipantResource;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use App\Models\ActivityParticipant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    
    
    public function create(Request $request) {
        $data = $request->all();

        $code = $this->generateRoomCode();

        $activity = Activity::create([
            'code' => $code,
            'name' => $data['name'],
            'description' => $data['description'],
            'from_date' => $data['from_date'],
            'to_date' => $data['to_date'],
            'user_id' => $request->user()->id
        ]);
        
        ActivityParticipant::create([
            'user_id' => $request->user()->id,
            'activity_id' => $activity->id
        ]);

        return new ActivityResource($activity);
    }

    public function update(Request $request, string $id) {
        $data = $request->all();

        $activity = Activity::findOrFail($id);
        $activity->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'from_date' => $data['from_date'],
            'to_date' => $data['to_date']
        ]);

        return new ActivityResource($activity);
    }

    public function get(Request $request, string $id) {
        $activity = Activity::findOrFail($id);

        return new ActivityResource($activity);
    }

    public function list(Request $request) {
        $userId = $request->user()->id;
        
        $activities = Activity::whereHas('participants', function(Builder $q) use($userId) {
            $q->whereUserId($userId);
        })->paginate(10);

        return ActivityResource::collection($activities);
    }

    public function delete(Request $request) {

    }

    public function join(Request $request, string $id) {
        $activity = Activity::whereCode($id)->first();

        if(!$activity) {
            return response()->json([
                'message' => 'Activity not found'
            ], 404);
        } else {
            try {
                $activityParticipant = ActivityParticipant::create([
                    'user_id' => $request->user()->id,
                    'activity_id' => $activity->id
                ]);
            } catch (QueryException $e) {
                if($e->getCode() === '23000') {
                    return response()->json([
                        'message' => 'Activity already joined'
                    ], 403);
                }
            }
    
            return new ActivityParticipantResource($activityParticipant);
        }
    }

    private function generateRoomCode() {
        $uniqueString = Str::random(5);

        $count = Activity::where('code', $uniqueString)->count();

        if($count > 0) {
            return $this->generateRoomCode();
        }
        
        return $uniqueString;
    }
}
