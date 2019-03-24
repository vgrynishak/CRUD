@extends('layout.header')

@section('mainbar')
    <lists :datas="{{request()->session()->has('id')?1:0}}" :lists="{{json_encode($list)}}"></lists>
@endsection