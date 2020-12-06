
@extends('admin.layouts.app')

@section('header', 'Mostly Played')

@section('content')
<div class="content">
        <div class="table-responsive">
            @include('flash::message')
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
			<thead>
				<th>Action</th>
                <th>Country</th>
                <th>Genres</th>
                <th>Name</th>
                {{-- <th>Streaming Url</th> --}}
				<th>Image</th>
                {{-- <th>Description</th> --}}
                <th>Count</th>
            </thead>
            <tbody>
                @foreach ($radio as $item)
                    <tr>
                        <td>
                            <a href="{{ route('admin.mostly-played.show', $item->id) }}" style="float:left" type="button" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        </td>
                        <td>{{ $item->country ? $item->country->name : "" }}</td>
                        <td>{{ $item->genres ? $item->genres->name : "" }}</td>
                        <td>{{ $item->name }}</td>
                        {{-- <td>{{ $item->streaming_link }}</td> --}}
                        <td><img src="{{ asset(config('dashboard.radio_image') . $item->image) }}" width="100" height="100" class="img-responsive table-img"></td>
                        {{-- <td>{{ $item->description }}</td> --}}
                        <td>{{ $item->count }}</td>
                        
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