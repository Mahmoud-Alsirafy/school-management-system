@extends('layouts.master')
@section('css')
{{-- @toastr_css --}}
@section('title')
{{ trans('main_trans.Grades') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('main_trans.Grades') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">Page Title</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button" class="btn btn-success mb-3 font-bold" style="font-size: 20px" data-toggle="modal"
                    data-target="#exampleModal">
                    {{ trans('Grades_trans.add_Grade') }}
                </button>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('Grades_trans.Name') }}</th>
                                <th>{{ trans('Grades_trans.Notes') }}</th>
                                <th>{{ trans('Grades_trans.Processes') }}</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($Grades as $key => $Grade)


                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $Grade->Name }}</td>
                                <td>{{ $Grade->Notes }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit{{ $Grade->id }}" title="{{ trans('Grades_trans.Edit') }}"><i
                                            class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{ $Grade->id }}"
                                        title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                </td>

                            </tr>

                            {{-- model edit --}}
                            <div class="modal fade" id="edit{{ $Grade->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                               id="exampleModalLabel">
                                               {{ trans('Grades_trans.edit_Grade') }}
                                           </h5>
                                           <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">
                                           <!-- add_form -->
                                           <form action="{{route('grade.update','test')}}" method="post">
                                               {{method_field('patch')}}
                                               @csrf
                                               <div class="row">
                                                   <div class="col">
                                                       <label for="Name"
                                                              class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                                           :</label>
                                                       <input id="Name" type="text" name="Name"
                                                              class="form-control"
                                                              value="{{$Grade->getTranslation('Name', 'ar')}}"
                                                              required>
                                                       <input id="id" type="hidden" name="id" class="form-control"
                                                              value="{{ $Grade->id }}">
                                                   </div>
                                                   <div class="col">
                                                       <label for="Name_en"
                                                              class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                                           :</label>
                                                       <input type="text" class="form-control"
                                                              value="{{$Grade->getTranslation('Name', 'en')}}"
                                                              name="Name_en" required>
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <label
                                                       for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                                       :</label>
                                                   <textarea class="form-control" name="Notes"
                                                             id="exampleFormControlTextarea1"
                                                             rows="3">{{ $Grade->Notes }}</textarea>
                                               </div>
                                               <br><br>

                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                           data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                   <button type="submit"
                                                           class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                               </div>
                                           </form>

                                       </div>
                                   </div>
                               </div>
                           </div>
                            {{-- model delete --}}

                            <div class="modal fade" id="delete{{ $Grade->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                               <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                               id="exampleModalLabel">
                                               {{ trans('Grades_trans.delete_Grade') }}
                                           </h5>
                                           <button type="button" class="close" data-dismiss="modal"
                                                   aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                       </div>
                                       <div class="modal-body">
                                           <form action="{{route('grade.destroy','test')}}" method="post">
                                               {{method_field('Delete')}}
                                               @csrf
                                               {{ trans('Grades_trans.Warning_Grade') }}

                                               <input id="id" type="hidden" name="id" class="form-control"
                                                      value="{{ $Grade->id }}">
                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary"
                                                           data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                   <button type="submit"
                                                           class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
                                               </div>
                                           </form>
                                       </div>
                                   </div>
                               </div>
                           </div>
                            @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- add_modal_class -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('grade.store') }}" method="post">
                        @csrf
                        <div class=" d-flex justify-content-between">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">{{
                                    trans('Grades_trans.Name_Grade_ar') }}</label>
                                <input type="text" class="form-control" name="Name" id="recipient-name">
                            </div>
                            <div class="form-group">

                                <label for="recipient-name" class="col-form-label">{{
                                    trans('Grades_trans.Name_Grade_en') }}</label>
                                <input type="text" class="form-control" name="Name_en" id="recipient-name">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="message-text" class="col-form-label">{{ trans('Grades_trans.Notes') }}</label>
                            <textarea class="form-control" name="Notes" id="message-text"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">{{
                                trans('Grades_trans.Close') }}</button>
                            <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@jquery
@toastr_js
@toastr_render
@endsection
