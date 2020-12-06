@extends('admin.layouts.app')

@section('header', $app->exists ? 'Edit App' : 'New App')

@section('panel-color', 'info')

@section('content')
    @include('flash::message')
	@if($app->exists)
		{{Form::model($app, [
			'route' => ['admin.app.update', $app],
			'method' => 'PUT',
			'class' => 'form-horizontal',
			'enctype'=>'multipart/form-data'
			])
		}}
	@else
		{{ Form::open([
			'url' => route('admin.app.store') ,
			'method' => 'POST',
			'class' => 'form-horizontal',
			'enctype'=>'multipart/form-data'
			])
		}}
	@endif

	
	<div class="form-group">
		{{ Form::label('name', 'App Name', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::text('name', null , ['class'=>'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('key', 'App Key', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::text('key', null , ['class'=>'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('status', 'Is Show', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::select('status', [1=>'Active', 0=>'inActive'], null , ['class'=>'form-control']) }}
		</div>
	</div>

   <div class="form-group">
		<div class="text-center">
		    {{ Form::submit($app->exists ? 'Edit' : 'Create', ['class'=>'btn btn-primary']) }}
		</div>
	</div>

	{{ Form::close() }}
@stop

