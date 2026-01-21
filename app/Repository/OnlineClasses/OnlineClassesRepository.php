<?php

namespace App\Repository\OnlineClasses;

use App\Models\Grade;
use App\Traits\UseZoom;
use App\Models\Online_classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OnlineClassesRepository implements OnlineClassesRepositoryInterface
{
    use UseZoom;
    public function index()
    {
        $online_classes = Online_classes::all();
        return view("pages.online_classes.index", compact('online_classes'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.add', compact("Grades"));
    }

    public function Store($request)
    {
        DB::beginTransaction();
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
                // 'meeting_id' => $meeting->id,
                // 'duration' => $meeting->duration,
                // 'password' => $meeting->password,
                // 'start_url' => $meeting->start_url,
                // 'join_url' => $meeting->join_url,
                'meeting_id' => $meeting['id'],
                'duration' => $meeting['duration'],
                'password' => $meeting['password'],
                'start_url' => $meeting['start_url'],
                'join_url' => $meeting['join_url'],
            ]);
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('Online.index');
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view("pages.online_classes.indirect", compact("Grades"));
    }
    public function storeIndirect($request)
    {
        DB::beginTransaction();
        try {
            Online_classes::create([
                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => Auth::user()->email,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'meeting_id' => $request->meeting_id,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,

            ]);
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('Online.index');
        } catch (\Throwable $e) {
            DB::rollback();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($request)
    {
        // $info = Online_classes::findOrFail($request->id);
        DB::beginTransaction();
        $meeting = Online_classes::findOrFail($request->id);
        try {

            if ($meeting->integration == true) {
                // احذف من Zoom الأول
                $this->deleteMeeting($meeting->meeting_id);

                // لو نجح → احذف من DB
                $meeting->delete();
            } else {
                $meeting->delete();
            }


            DB::commit();
            toastr()->success('Deleted successfully');
            return redirect()->route('Online.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return back();
        }
    }
}
