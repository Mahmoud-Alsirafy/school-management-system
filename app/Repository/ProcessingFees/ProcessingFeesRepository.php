<?php

namespace App\Repository\ProcessingFees;

use App\Models\Student;
use App\Models\ProcessingFees;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\Clock\now;

class ProcessingFeesRepository implements ProcessingFeesRepositoryInterface
{
    // Show Table To Add The Students
    public function index()
    {
        $ProcessingFees = ProcessingFees::all();
        return view('pages.ProcessingFee.index', compact('ProcessingFees'));
    }
    // Store Studens In DB
    public function store($request)
    {
        $request->validate([
            'Debit' => 'required',
            'final_balance' => 'required',
            'student_id' => 'required|integer|exists:students,id',
            'description' => 'required|string'
        ]);


        DB::beginTransaction();
        try {

            $processingFee = new ProcessingFees();
            $processingFee->date = date('Y-m-d');
            $processingFee->student_id = $request->student_id;
            $processingFee->amount = $request->Debit;
            $processingFee->description = $request->description;
            $processingFee->save();


            $student_acc = new StudentAccount();
            $student_acc->date = date('Y-m-d');
            $student_acc->type = 'receipt';
            $student_acc->student_id = $request->student_id;
            $student_acc->processing_id = $processingFee->id;
            $student_acc->Debit  = 0.00;
            $student_acc->Credit  = $request->Debit;
            $student_acc->description  = $request->description;
            $student_acc->save();


            DB::commit();

            toastr()->success(trans('message.success'));
            return redirect()->route('Processing.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Show Student Info To Reade
    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.ProcessingFee.add', compact('student'));
    }

    //  Show Info And Edit
    public function edit($id)
    {
        $ProcessingFee = ProcessingFees::findorfail($id);
        return view('pages.ProcessingFee.edit', compact('ProcessingFee'));
    }

    // Update Student Info
    public function update($request)
    {
        $request->validate([
            'Debit' => 'required',
            'id' => 'required',
            'student_id' => 'required|integer|exists:students,id',
            'description' => 'required|string'
        ]);


        DB::beginTransaction();
        try {

            $Fee = ProcessingFees::findorfail($request->id);
            $Fee->date = date('Y-m-d');
            $Fee->student_id = $request->student_id;
            $Fee->amount = $request->Debit;
            $Fee->description = $request->description;
            $Fee->save();


            $acc = StudentAccount::where('processing_id', $request->id)->firstOrFail();
            $acc->date = date('Y-m-d');
            $acc->type = 'receipt';
            $acc->student_id = $request->student_id;
            $acc->processing_id = $Fee->id;
            $acc->Debit  = 0.00;
            $acc->Credit  = $request->Debit;
            $acc->description  = $request->description;
            $acc->save();


            DB::commit();

            toastr()->success(trans('message.update'));
            return redirect()->route('Processing.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Delete Student From DB

    public function destroy($request)
    {
        $request->validate([
            'id' => 'required|integer|exists:processing_fees,id',
        ]);
        DB::beginTransaction();
        try {
            ProcessingFees::destroy($request->id);
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
