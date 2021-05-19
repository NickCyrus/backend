@extends('layout')

@section('title','Dashboard')


@section('content')
    <form action="{{ route('empresas.update' , $modules->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('empresas.form')
    </form>

@endsection
