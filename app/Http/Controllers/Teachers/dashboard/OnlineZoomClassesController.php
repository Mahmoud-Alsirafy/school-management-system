<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Online_classes;
use App\Traits\UseZoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlineZoomClassesController extends Controller
{
    use UseZoom;
    public function index()
    {
        $online_classes = Online_classes::where('created_by',Auth::user()->email)->get();
        return view('pages.Teacher.dashboard.online_classes.index', compact('online_classes'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Teacher.dashboard.online_classes.add', compact('Grades'));
    }

    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view('pages.Teacher.dashboard.online_classes.indirect', compact('Grades'));
    }



    public function store(Request $request)
    {
        try {

             $meeting = $this->createMeeting($request);
            Online_classes::create([
                'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => Auth::user()->email,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'meeting_id' => $meeting['id'],
                'duration' => $meeting['duration'],
                'password' => $meeting['password'],
                'start_url' => $meeting['start_url'],
                'join_url' => $meeting['join_url'],
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_zoom_classes .index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function storeIndirect(Request $request)
    {
        try {
            Online_classes::create([
                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => Auth::user()->email,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_zoom_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }


    public function destroy($id)
    {
        try {

            $info = Online_classes::find($id);

            if($info->integration == true){
                 $this->deleteMeeting($info->meeting_id);
                Online_classes::destroy($id);
            }
            else{

                Online_classes::destroy($id);
            }

            toastr()->success(trans('messages.Delete'));
            return redirect()->route('online_zoom_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
