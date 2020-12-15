
@extends('layout.admin.adminMain')

@section('title','Dashboard')

@section('nav')
    @include('nav.admin')
@endsection

@section('konten')
    @include('layout.admin.adminsidebar')
@endsection

@section('footer')
    @include('layout.admin.adminfooter')
@endsection