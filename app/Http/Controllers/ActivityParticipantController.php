<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityParticipantResource;
use App\Models\Activity;
use App\Models\ActivityParticipant;
use App\Http\Requests\StoreActivityParticipantRequest;
use App\Http\Requests\UpdateActivityParticipantRequest;
use Illuminate\Http\Request;

class ActivityParticipantController extends Controller
{

    public function create(Request $request) {
        $data = $request->all();

        $activityParticipant = ActivityParticipant::create([
            'user_id' => $data['user_id'],
            'activity_id' => $data['activity_id']
        ]);

        return new ActivityParticipantResource($activityParticipant);
    }

    public function update(Request $request, string $id) {
        $data = $request->all();
    }

    public function get(Request $request, string $id) {
        $activityParticipant = ActivityParticipant::findOrFail($id);

        return new ActivityParticipantResource($activityParticipant);
    }

    public function list(Request $request, string $id) {
        $activityParticipants = ActivityParticipant::paginate(10);

        return ActivityParticipantResource::collection($activityParticipants);
    }

    public function getByActivity(Request $request, string $id) {
        $users = Activity::find($id)->users->pluck('name');

        return $users;
    }

    public function delete(Request $request) {

    }
}
