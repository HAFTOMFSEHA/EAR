
@extends('admin.layouts.app')

@section('header', 'Feedback')

@section('seconday-header', '(This feature is available only from app version 2.0)')

@section('content')
<div class="content">
        <div class="table-responsive">
            @include('flash::message')
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
			<thead>
				<th>Action</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
            </thead>
            <tbody>
                @foreach ($feedback as $item)
                    <tr>
                    <td>
                            {{ 
                                Form::open([
                                'url' => route('admin.feedback.destroy', $item->id), 
                                'method' => 'Delete',
                                'class' => 'pull-left'
                            ]) 
                            }}
                            <button class="btn btn-danger" onclick="if(!confirm('Are you sure you want to delete ?')) return false;"> <i class='fa fa-trash'> </i></button> 
                            {{ Form::close() }}
                        </td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->description }}</td>
                    </tr>
                @endforeach

            </tbody>
		</table>
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