
@extends('admin.layouts.app')

@section('header', 'Notification')

@section('content')
    <div class="content">
        <div class="row">
            <div class="content-top-button mb-2">
                <a href="{{ route('admin.notification.create') }}" class='pull-right btn btn-success btn-sm'><i class='fa fa-plus'></i> Add
                    New</a>
            </div>
        </div>
        <div class="table-responsive">
            @include('flash::message')
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                    <th>Action</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Image</th>
                    <th>Send Date</th>
                </thead>
                <tbody>
                    @foreach ($notification as $item)
                        <tr>
                            <td>
                                {{ 
                                    Form::open([
                                    'url' => route('admin.notification.destroy', $item->id), 
                                    'method' => 'Delete',
                                    'class' => 'pull-left'
                                ]) 
                                }}
                                <button class="btn btn-danger" onclick="if(!confirm('Are you sure you want to delete ?')) return false;"> <i class='fa fa-trash'> </i></button> 
                                {{ Form::close() }}
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->message }}</td>
                            <td><img src="{{ asset(config('dashboard.notification_image') . $item->image) }}" width="100" height="100" class="img-responsive table-img"></td>
                            <td>{{ $item->created_at }}</td>
                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection


@push('scripts')
<script>
$(document).ready(function() {
    $('#datatable').DataTable({
        responsive: true
    });
});
</script>

@endpush