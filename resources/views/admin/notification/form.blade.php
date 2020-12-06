@extends('admin.layouts.app')

@section('header', $notification->exists ? 'Edit notification' : 'New notification')

@section('panel-color', 'primary')

@section('content')
<div class="content">
        <div class="row">
            <div class="content-top-button mb-2">
                <a href="{{ route('admin.notification.index') }}" class='pull-right btn btn-success btn-sm'>Back</a>
            </div>
        </div>
    @include('flash::message')
	@if($notification->exists)
		{{Form::model($notification, [
			'route' => ['admin.notification.update', $notification],
			'method' => 'PUT',
			'class' => 'form-horizontal',
			'enctype'=>'multipart/form-data'
			])
		}}
	@else
		{{ Form::open([
			'url' => route('admin.notification.store') ,
			'method' => 'POST',
			'class' => 'form-horizontal',
			'enctype'=>'multipart/form-data'
			])
		}}
	@endif


	
	<div class="form-group">
		{{ Form::label('title', 'Title', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::Text('title', null , ['class'=>'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('message', 'Message', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::Text('message', null , ['class'=>'form-control']) }}
		</div>
	</div>

    <div class="form-group">
		{{ Form::label('image', 'Image(Optional)', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			@if($notification->exists)
				<div class="">
                    <img src="{{ asset(config('dashboard.notification_image') . $notification->image) }}" width="100" height="100" class="img-responsive">
				</div>
				<div class="help-block">
					Image Currently
				</div>
			@endif
			{{ Form::file('image', ['class'=>'form-control', 'accept' => 'image/x-png,image/jpeg']) }}
			<span class="help-block">
		        <strong>Min:50x50, Max:500x500, Mime:jpg/png</strong>
		    </span>
		</div>
	</div>


	<div class="form-group">
		<div class="col-sm-5">
		    {{ Form::submit($notification->exists ? 'Edit' : 'Create', ['class'=>'btn btn-primary']) }}
		</div>
	</div>

	{{ Form::close() }}
</div>
@stop

