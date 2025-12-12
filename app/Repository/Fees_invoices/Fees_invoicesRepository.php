<?php

namespace App\Repository\Fees_invoices;

use App\Models\Fees;
use App\Models\FeesInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class Fees_invoicesRepository implements Fees_invoicesRepositoryInterface
{
    public function index()
    {
        $Fee_invoices = FeesInvoice::get();
        return view('pages.Fees_Invoices.index', compact('Fee_invoices'));
    }

    public function ShowFeesInvoice($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fees::where('Classroom_id', $student->Classroom_id)->get();
        return view('pages.Fees_Invoices.add', compact('student', 'fees'));
    }

    public function edit($id)
    {
        $fee_invoices = FeesInvoice::findorfail($id);
        $fees = Fees::where('Classroom_id', $fee_invoices->Classroom_id)->get();
        return view('pages.Fees_Invoices.edit', compact('fee_invoices', 'fees'));
    }


    public function store($request)
    {
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();
        try {
            foreach ($List_Fees as $List_Fee) {
                $Fees = new FeesInvoice();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->Grade_id = $request->Grade_id;
                $Fees->Classroom_id = $request->Classroom_id;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();

                // Student_account
                $Student_account = new StudentAccount();
                $Student_account->date = date('Y-m-d');
                $Student_account->type = 'invoices';
                $Student_account->student_id = $List_Fee['student_id'];
                $Student_account->fee_invoice_id = $Fees->id;
                $Student_account->Debit = $List_Fee['amount'];
                $Student_account->Credit = 0.00;
                $Student_account->Description = $List_Fee['description'];
                $Student_account->save();
            }
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $Fees = FeesInvoice::findOrFail($request->id);
            $Fees->invoice_date = date('Y-m-d');
            $Fees->amount = $request->amount;
            $Fees->fee_id = $request->fee_id;
            $Fees->description = $request->description;
            $Fees->save();


            // Student_account
            $Student_account = StudentAccount::where('fee_invoice_id', $request->id)->first();
            $Student_account->Debit = $request->amount;
            $Student_account->Cridit = 0.00;
            $Student_account->Description = $request->description;
            $Student_account->save();

            DB::commit();
            toastr()->success(trans('message.update'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            toastr()->error(trans('message.error'));
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($request)
    {
        try {
            Feesinvoice::destroy($request->id);
            toastr()->error(trans('message.delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
