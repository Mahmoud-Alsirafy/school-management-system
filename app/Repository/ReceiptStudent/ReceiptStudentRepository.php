<?php

namespace App\Repository\ReceiptStudent;

use App\Models\FundAccount;
use App\Models\Room;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Student;
use App\Models\My_Parent;
use App\Models\Type_Blood;
use App\Models\Nationality;
use App\Models\ReceiptStudent;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{
    // Show Table To Add The Students
    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return view("pages.Receipt.index", compact('receipt_students'));
    }
    // Store Studens In DB
    public function store($request)
    {
        $request->validate([
            'Debit' => 'required',
            'student_id' => 'required|integer|exists:students,id',
            'description' => 'required|string'
        ]);
        DB::beginTransaction();
        try {

            // Insert Data In Table Receipt Students
            $receipt_students = new ReceiptStudent();
            $receipt_students->date = date('Y-m-d');
            $receipt_students->student_id = $request->student_id;
            $receipt_students->Debit = $request->Debit;
            $receipt_students->description = $request->description;
            $receipt_students->save();

            $fund = new FundAccount();
            $fund->date = date('Y-m-d');
            $fund->receipt_id = $receipt_students->id;
            $fund->debit = $request->Debit;
            $fund->credit = 0.00;
            $fund->description = $request->description;
            $fund->save();

            $student = new StudentAccount();
            $student->date = date('Y-m-d');
            $student->type = 'Receipt';
            $student->student_id = $request->student_id;
            $student->receipt_id = $receipt_students->id;
            $student->Debit = 0.00;
            $student->Cridit = $request->Debit;
            $student->Description = $request->description;
            $student->save();
            DB::commit();

            toastr()->success(trans('message.success'));
            return redirect()->route('Receipt.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Show Student Info To Reade
    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.Receipt.add', compact('student'));
    }

    //  Show Info And Edit
    public function edit($id)
    {
        $receipt_student = ReceiptStudent::findorfail($id);
        return view('pages.Receipt.edit', compact('receipt_student'));
    }

    // Update Student Info
    public function update($request)
    {
        DB::beginTransaction();
        try {
            // update In ReceiptStudent Table
            $Rec = ReceiptStudent::findorfail($request->id);
            $Rec->date = date('Y-m-d');
            $Rec->Debit = $request->Debit;
            $Rec->student_id = $request->student_id;
            $Rec->description = $request->description;
            $Rec->save();

            // update In ReceiptStudent Table
            $fund = FundAccount::findorfail($request->id);
            $fund->date = date('Y-m-d');
            $fund->receipt_id = $Rec->id;
            $fund->debit = $request->debit;
            $fund->credit = 0.00;
            $fund->description = $request->description;
            $fund->save();

            $student = StudentAccount::findorfail($request->id);
            $student->date = date('Y-m-d');
            $student->type = 'Receipt';
            $student->student_id = $request->student_id;
            $student->receipt_id = $Rec->id;
            $student->Debit = 0.00;
            $student->Cridit = $request->Debit;
            $student->Description = $request->description;
            $student->save();
            DB::commit();
            toastr()->success(trans('message.update'));
            return redirect()->route('Receipt.index');
        } catch (\Throwable $e) {
            DB::rollBack();
        }
    }

    // Delete Student From DB

    public function destroy($request)
    {
        $request->validate([
            'id' => 'required|integer|exists:receipt_students,id',
        ]);

        try {
            ReceiptStudent::destroy($request->id);
            toastr()->error(trans('message.delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
