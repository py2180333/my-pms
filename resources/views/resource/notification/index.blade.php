@extends('resource.master')
@include('resource.sidebar')
@section('content')
<!-- new pr 12-8-25 -->
<!-- index Page -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">

        <div class="crms-title row bg-white">
            <div class="col  p-0">
                <h3 class="page-title m-0">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="fa-regular fa-square-check"></i>
                    </span> Notifications
                </h3>
            </div>
            <div class="col p-0 text-end">
                <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                    <li class="breadcrumb-item"><a href="{{ route('resource.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Notifications</li>
                </ul>
            </div>
        </div>

        <!-- Content Starts -->

        @if(auth()->user()->unreadNotifications->isNotEmpty())
            <form action="{{ route('resource.markNotification') }}" method="POST" class="m-2">
                @csrf
                <input type="hidden" name="id" value="">
                <button type="submit" class="ms-2 p-2 fs-6  btn btn-success">
                    Mark all as read
                </button>
            </form>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-nowrap custom-table mb-0 datatable addexamplesearch">
                                <thead>
                                    <tr>
                                        <th class="checkBox">Sr</th>
                                        <th class="checkBox sorting" style="width: 35px;">Date</th>
                                        <th class="checkBox sorting" style="width: 35px;">Notification</th>
                                        <th class="checkBox sorting" style="width: 35px;">Time</th>
                                        <th class="text-end" style="width: 35px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (auth()->user()->notifications as $notification)
                                        <tr>
                                            <td class="checkBox">{{ $loop->iteration }}</td>
                                            <td>{{ $notification->created_at->format('d-m-Y') }}</td>
                                            <td> 
                                                <sapn class="{{ $notification->unread() ? 'fw-bold' : '' }}">
                                                    {{ $notification->data['data'] }}
                                                </sapn>
                                            </td>
                                            <td>{{ $notification->created_at->diffForHumans() }}</td>
                                           
                                            @if ($notification->unread())
                                                <td class="text-center d-flex">
                                                    <form action="{{ route('resource.markNotification') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $notification->id }}">
                                                        <button type="submit" class="ms-2 p-2 fs-6  btn btn-success">
                                                            Mark as read
                                                        </button>
                                                    </form>
                                                </td>
                                            @else
                                                <td class="text-center d-flex">
                                                        <button type="button" class="ms-2 p-2 fs-6  btn btn-primary">
                                                            Read
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <!-- /Content End -->
    </div>
    <!-- /Page Content -->
</div>
<!-- /index Page -->
@endsection