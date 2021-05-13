@extends('layout')

@section('title','Dashboard')


@section('content')

    <h3><i class="feather icon-codepen"></i> EMPRESAS </h3>

    <form action="{{ route('empresas.update' , $modules->ID_EMP) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('empresas.form')
    </form>

@endsection
