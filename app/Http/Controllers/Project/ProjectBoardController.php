<?php

namespace App\Http\Controllers\Project;

use App\Events\ProjectBoardEvent;
use App\Http\Controllers\Controller;
use App\Models\Drawing;
use App\Models\Joinee;
use App\Models\MiniTextEditor;
use App\Models\Project;
use App\Models\StickyNote;
use App\Models\TextCaption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectBoardController extends Controller
{
    public function addJoinees(Request $request)
    {
        $projectCode = $request->projectCode;
        $userId = $request->userId;

        $project = Project::where('code', $projectCode)->first();

        if (!is_null($project)) {

            // check if user already added
            $joinee = Joinee::where('projectCode', $projectCode)->first();

            if (is_null($joinee)) {

                Joinee::create([
                    'projectId' => $project->id,
                    'userId' => $userId,
                ]);

                ProjectBoardEvent::dispatch($projectCode);

                return response([
                    'message' => ' User join the project',
                    'status' => true
                ]);
            } else {

                ProjectBoardEvent::dispatch($projectCode);

                return response([
                    'message' => 'User already joinned the project',
                    'status' => true
                ]);
            }

        } else {

            return response(['message' => 'Project not found']);
        }
    }

    public function projectBoardData(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $projectId = $request->projectId;
            $userId = $request->userId;

            $project = Project::where('id', $projectId)->first();

            if (intval($userId) === intval($project->userId)) {

                $miniTextEditor = MiniTextEditor::where('projectId', $projectId)->first();
                $stickyNote = StickyNote::where('projectId', $projectId)->first();
                $textCaption = TextCaption::where('projectId', $projectId)->first();
                $drawing = Drawing::where('projectId', $projectId)->first();

                return response([
                    'miniTextEditor'    => $miniTextEditor,
                    'stickyNote'        => $stickyNote,
                    'textCaption'       => $textCaption,
                    'drawing'           => $drawing,
                ]);

            } else {
                return response([
                    'miniTextEditor'    => null,
                    'stickyNote'        => null,
                    'textCaption'       => null,
                    'drawing'           => null,
                 ]);
            }
        });
    }

    public function createOrUpdateStickyNote(Request $request)
    {

        $projectId = $request->projectId;
        $stickyNote = StickyNote::where('projectId', $projectId)->first();
        $json = json_encode( $request->stickyNoteData);

        if (is_null($stickyNote)){

            //insert a new row
            StickyNote::create([
                'projectId' => $projectId,
                'stickyNoteData' => $json
            ]);

            return response(['success' => true]);
        } else {

            StickyNote::where('projectId', $projectId)
                        ->update([
                            'stickyNoteData' => $json
                        ]);

            return response(['success' => true]);
        }
    }

    public function createOrUpdateMiniTextEditor(Request $request)
    {

        $projectId = $request->projectId;
        $miniTextEditor = MiniTextEditor::where('projectId', $projectId)->first();

        $json = json_encode( $request->miniTextEditorData);

        if (is_null($miniTextEditor)) {

            //insert a new row
            MiniTextEditor::create([
                'projectId' => $projectId,
                'miniTextEditorData' => $json
            ]);

            return response(['success' => true]);

        } else {

            MiniTextEditor::where('projectId', $projectId)
                            ->update([
                                'miniTextEditorData' => $json
                            ]);

            return response(['success' => true]);
        }
    }

    public function createOrUpdateTextCaption(Request $request)
    {

        $projectId = $request->projectId;
        $TextCaption = TextCaption::where('projectId', $projectId)->first();

        $json = json_encode( $request->textCaptionData);

        if (is_null($TextCaption)) {

            //insert a new row
            TextCaption::create([
                'projectId' => $projectId,
                'textCaptionData' => $json
            ]);

            return response(['success' => true]);

        } else {

            TextCaption::where('projectId', $projectId)
                        ->update([
                            'textCaptionData' => $json
                        ]);

            return response(['success' => true]);
        }
    }

    public function createOrUpdateDrawing(Request $request)
    {

        $projectId = $request->projectId;
        $drawing = Drawing::where('projectId', $projectId)->first();

        $json = json_encode( $request->drawingData);

        if (is_null($drawing)) {

            //insert a new row
            Drawing::create([
                'projectId' => $projectId,
                'drawingData' => $json
            ]);

            return response(['success' => true]);
        } else {

            Drawing::where('projectId', $projectId)
                    ->update([
                        'drawingData' => $json
                    ]);

            return response(['success' => true]);
        }
    }
}
