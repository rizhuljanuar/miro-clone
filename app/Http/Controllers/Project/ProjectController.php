<?php

namespace App\Http\Controllers\Project;

use App\Events\ProjectBoardEvent;
use App\Events\UserTypingEvent;
use App\Http\Controllers\Controller;
use App\Models\Joinee;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function knowWhoIsTyping($projectId, $sendId)
    {
        $joiness = Joinee::where('projectId', $projectId)->get();

        foreach ($joiness as $joinee) {

            // event
            UserTypingEvent::dispatch($row->userId);
        }
    }

    public function projects(Request $request)
    {
        $data = Project::where('userId', $request->userId)->get();

        return response($data);
    }

    public function projectDetail(Request $request)
    {
        $projectCode = $request->project_code;
        $sendId = $request->sendId;

        $data = Project::where('projectCode', $projectCode)->first();

        if (!is_null($data)) {

            ProjectBoardEvent::dispatch($projectCode);
            $this->knowWhoIsTyping($data->id, $sendId);

            return response($data);
        } else {
            return response([]);
        }

    }

    public function createProject(Request $request)
    {
        $fields = $request->all();

        $errors = Validator::make($fields, [
            'name' => 'required',
            'userId' => 'required',
        ]);

        if ($errors->fails()) {

            return response([
                'errors' => $errors->errors()->all(),
                'message' => 'Invalid Input',
            ], 422);
        }

        $projectCode = Str::random(10). '-' .time();
        $projectLink = url('/');

        Project::create([
            'name' => $fields['name'],
            'projectCode' => $projectCode,
            'projectLink' => $projectLink,
            'userId' => $fields['userId'],
        ]);

        return response(['message' => 'Project Created Successfully']);
    }

    public function updateProject(Request $request)
    {
        $fields = $request->all();

        $errors = Validator::make($fields, [
            'id' => 'required',
            'name' => 'required',
            'userId' => 'required',
        ]);

        if ($errors->fails()) {
            return response([
                'errors' => $errors->errors()->all(),
                'message' => 'Invalid Input',
            ], 422);
        }

        Project::where('id', $fields['id'])->update([
            'name' => $fields['name'],
        ]);

        return response(['message' => 'Project Updated Successfully']);
    }

}
