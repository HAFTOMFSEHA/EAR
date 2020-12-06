
@extends('admin.layouts.app')

@section('header', 'App')

@section('content')
<div class="row">
        <div class="pull-right content-top-button">
            <a href="{{ route('admin.app.create') }}" class='btn btn-success btn-sm'><i class='glyphicon glyphicon-plus'></i> Add New</a>
        </div>
    </div>
    <div class="table">
        @include('flash::message')
		<table class="table table-bordered table-condensed table-hover table-smalltext" id="users-table">
			<thead>
				<th></th>
				<th>Name</th>
				<th>Key</th>
                <th>Status</th>
				<th>Action</th>
            </thead>
            <tbody>
                @foreach ($app as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->key }}</td>
                        <td>
							@if($item->status) 
								<span style="color:green;">Active</span> 
							@else 
								<span style="color:red;">Inactive</span> 
							@endif
						</td>
						
                        <td>
                            <a href="{{ route('admin.app.edit', $item->id) }}" style="float:right" type="button" class="btn btn-primary"><i class="fa fa-edit"></i>&nbsp; Edit</a>

                            {{ 
                                Form::open([
                                'url' => route('admin.app.destroy', $item->id), 
                                'method' => 'Delete',
                                'class' => 'pull-right'
                            ]) 
                            }}
                            <button class="btn btn-danger" onclick="if(!confirm('Are you sure you want to delete ?')) return false;"> <i class='glyphicon glyphicon-trash'> </i>&nbsp; Delete</button> 
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
		</table>
	</div>

@endsection

