<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Models\Activity;
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
        $activities = Activity::paginate(10);

        return ActivityResource::collection($activities);
    }

    public function delete(Request $request) {

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
