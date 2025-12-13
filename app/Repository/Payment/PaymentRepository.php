<?php

namespace App\Repository\Payment;

use App\Models\FundAccount;
use App\Models\Student;
use App\Models\Payment_student;
use App\Models\ProcessingFees;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{
    // Show Table To Add The Students
    public function index()
    {
        $payment_students = Payment_student::all();
        return view('pages.payment.index', compact('payment_students'));
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

            $payment = new Payment_student();
            $payment->date = date('Y-m-d');
            $payment->student_id = $request->student_id;
            $payment->amount = $request->Debit;
            $payment->Description = $request->description;
            $payment->save();

            $fund = new FundAccount();
            $fund->date = date('Y-m-d');
            $fund->payment_id = $payment->id;
            $fund->debit = 0.00;
            $fund->credit = $request->Debit;
            $fund->description = $request->description;
            $fund->save();


            $student_acc = new StudentAccount();
            $student_acc->date = date('Y-m-d');
            $student_acc->type = 'payment';
            $student_acc->student_id = $request->student_id;
            $student_acc->Payment_id = $payment->id;
            $student_acc->Debit  = 0.00;
            $student_acc->Credit  = $request->Debit;
            $student_acc->Description  = $request->description;
            $student_acc->save();


            DB::commit();

            toastr()->success(trans('message.success'));
            return redirect()->route('Payment.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // Show Student Info To Reade
    public function show($id)
    {
        $student = Student::findorfail($id);
        return view('pages.Payment.add', compact('student'));
    }

    //  Show Info And Edit
    public function edit($id)
    {
        $payment_student = Payment_student::findorfail($id);
        return view('pages.Payment.edit', compact('payment_student'));
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

            $payment =  Payment_student::findorfail($request->id);
            $payment->date = date('Y-m-d');
            $payment->student_id = $request->student_id;
            $payment->amount = $request->Debit;
            $payment->Description = $request->description;
            $payment->save();

            $fund = FundAccount::where('payment_id', $request->id)->first();
            $fund->date = date('Y-m-d');
            $fund->payment_id = $payment->id;
            $fund->debit = 0.00;
            $fund->credit = $request->Debit;
            $fund->description = $request->description;
            $fund->save();


            $student_acc = StudentAccount::where('payment_id', $request->id)->first();
            $student_acc->date = date('Y-m-d');
            $student_acc->type = 'payment';
            $student_acc->student_id = $request->student_id;
            $student_acc->Payment_id = $payment->id;
            $student_acc->Debit  = 0.00;
            $student_acc->Credit  = $request->Debit;
            $student_acc->Description  = $request->description;
            $student_acc->save();


            DB::commit();

            toastr()->success(trans('message.update'));
            return redirect()->route('Payment.index');
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
            Payment_student::destroy($request->id);
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->back();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
