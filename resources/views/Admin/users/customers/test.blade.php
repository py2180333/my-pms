@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
<div class="page-wrapper create_p">
    <!-- Page Content -->
    <div class="content container-fluid">
    <form action="" method="POST" enctype="multipart/form-data" >
        @csrf
        <input type="text" name="name" placeholder="type your name">
        <input type="submit" value="submit"/>
    </form>
</div></div>
@endsection