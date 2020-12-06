
@extends('admin.layouts.app')

@section('header', 'Streaming Issue Report')

@section('seconday-header', '(This feature is available only from app version 2.0)')
@section('content')
<div class="content">
        <div class="table-responsive">
            @include('flash::message')
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
			<thead>
				<th>Action</th>
                <th>Radio Name</th>
                <th>Total Number Of Reports</th>
            </thead>
            <tbody>
                @foreach ($report as $item)
                    <tr>
                        <td>
                            {{ 
                                Form::open([
                                'url' => route('admin.streaming-report.destroy', $item['id']), 
                                'method' => 'Delete',
                                'class' => 'pull-left'
                            ]) 
                            }}
                            <button class="btn btn-danger" onclick="if(!confirm('Are you sure you want to delete ?')) return false;"> <i class='fa fa-trash'> </i></button> 
                            {{ Form::close() }}
                        </td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['count'] }}</td>
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