@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('Question.list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('Question.list')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{route('Question.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true"> {{ trans('Question.new') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">{{ trans('Question.name_qu') }}</th>
                                            <th scope="col">{{ trans('Question.answers') }}</th>
                                            <th scope="col">{{ trans('Question.right_answer') }}</th>
                                            <th scope="col">{{ trans('Question.score') }}</th>
                                            <th scope="col">{{ trans('Question.qu_name') }}</th>
                                            <th scope="col">{{ trans('Question.prosess') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($questions as $question)
                                        <tr>
                                            <td>{{ $loop->iteration}}</td>
                                            <td>{{$question->title}}</td>
                                            <td>{{$question->answers}}</td>
                                            <td>{{$question->right_answer}}</td>
                                            <td>{{$question->score}}</td>
                                            <td>{{$question->quizze->name}}</td>
                                            <td>
                                                <a href="{{route('Question.edit',$question->id)}}"
                                                    class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                        class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_exam{{ $question->id }}" title="حذف"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                                        @include('pages.Questions.destroy')
                                        @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
