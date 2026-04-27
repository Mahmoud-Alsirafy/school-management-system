@extends('layouts.master')
@section('css')
    @toastr_css
    @livewireStyles
    @section('title')
        {{ trans('quizze.take_exam') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('quizze.take_exam') }}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')

    @livewire('ShowQuestion', ['quizze_id' => $quizze_id, 'student_id' => $student_id])

@endsection
@section('js')
    @toastr_js
    @toastr_render
    @livewireScripts
@endsection

