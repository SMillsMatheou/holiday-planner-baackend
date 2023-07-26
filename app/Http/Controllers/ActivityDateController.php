<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityDateResource;
use App\Models\Activity;
use App\Models\ActivityDate;
use Illuminate\Http\Request;

class ActivityDateController extends Controller
{
    
    public function create(Request $request, string $id) {
        $data = $request->all();

        $activityDate = ActivityDate::create([
            'from_date' => $data['from_date'],
            'to_date' => $data['to_date'],
            'user_id' => $request->user()->id,
            'activity_id' => $id,
            'type' => $data['type']
        ]);

        return new ActivityDateResource($activityDate);
    }

    public function getByActivity(Request $request, string $id) {
        $data = $request->all();

        $activityDates = Activity::find($id)->dates
                            ->where('from_date', '<=', $data['to_date'])
                            ->where('to_date', '>=', $data['from_date'])
                            ->values()
                            ->all();

        return $activityDates;
    }

    public function delete(Request $request, string $id) {
        //TODO: only allow user to delete there own item
        $activityDate = ActivityDate::find($id);

        $activityDate->delete();

        return response()->json([
            'message' => 'Date successfully deleted'
        ], 200);
    }
}
