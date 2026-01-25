<?php

namespace App\Repository\Library;

use App\Models\Grade;
use App\Models\Image;
use App\Models\Library;
use App\Traits\AttachFiles;
use Illuminate\Support\Facades\DB;

class LibraryRepository implements LibraryRepositoryInterface
{
    use AttachFiles;
    public function getAllBooks()
    {
        $books = Library::all();
        return view('pages.library.index', compact('books'));
    }

    public function create()
    {
        $grades = Grade::all();
        return view('pages.library.create', compact('grades'));
    }

    public function StoreBooks($request)
    {
        DB::beginTransaction();

        try {

            $library = Library::create([
                "title"        => $request->title,
                "Grade_id"     => $request->Grade_id,
                "Classroom_id" => $request->Classroom_id,
                "section_id"   => $request->section_id,
                "teacher_id"   => 1,
            ]);

            if ($request->hasFile('file_name')) {
                $this->uploadFile(
                    $request->file('file_name'),$library,'library'
                );
            }


            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('library.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function EditBooks($id)
    {
        $grades = Grade::all();
        $book = Library::find($id);
        $image = Image::where("imageable_id",$id)->first();
        // return $image;
        return view('pages.library.edit', compact('book', 'grades',"image"));
    }


    public function UpdateBooks($request)
    {
        DB::beginTransaction();

        try {
            $book = Library::findOrFail($request->id);


            // تحديث الملف لو موجود
            if ($request->hasFile('file_name')) {
                $this->deleteFile(
                    $request->id,
                    'library'
                );
                $this->uploadFile(
                    $request->file('file_name'),
                    $book,
                    'library'
                );
            }


            // تحديث باقي البيانات
            $book->update([
                "title"        => $request->title,
                "Grade_id"     => $request->Grade_id,
                "Classroom_id" => $request->Classroom_id,
                "section_id"   => $request->section_id,
                "teacher_id"   => 1,
            ]);

            DB::commit();
            toastr()->success(trans('message.update'));
            return redirect()->route('library.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }





    public function DeleteBooks($request)
    {
        // return $request;
        DB::beginTransaction();
        try {
            $book = Library::findOrFail($request->id);
            $book->delete();
            $this->deleteFile($request->id,'library');
            DB::commit();
            toastr()->success(trans('message.delete'));
            return redirect()->route('library.index');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function downloadAttach($id) {
        $fileName = Image::where("imageable_id",$id)->first();
        $name = $fileName->filename;
        return response()->download(public_path('attachments/library/'.$id."/".$name));
    }
}
