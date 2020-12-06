@extends('admin.layouts.app')

@section('header', $language->exists ? 'Edit Language' : 'New Language')

@section('panel-color', 'primary')

@section('content')
	<div class="content">
        <div class="row">
            <div class="content-top-button mb-2">
                <a href="{{ route('admin.language.index') }}" class='pull-right btn btn-success btn-sm'>Back</a>
            </div>
        </div>
		@include('flash::message')
		@if($language->exists)
			{{Form::model($language, [
				'route' => ['admin.language.update', $language],
				'method' => 'PUT',
				'class' => 'form-horizontal',
				'enctype'=>'multipart/form-data'
				])
			}}
		@else
			{{ Form::open([
				'url' => route('admin.language.store') ,
				'method' => 'POST',
				'class' => 'form-horizontal',
				'enctype'=>'multipart/form-data'
				])
			}}
		@endif


		
		<div class="form-group">
			{{ Form::label('name', 'Name', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-5">
				{{ Form::Text('name', null , ['class'=>'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-5">
				{{ Form::submit($language->exists ? 'Edit' : 'Create', ['class'=>'btn btn-primary']) }}
			</div>
		</div>

		{{ Form::close() }}
	</div>		
@stop

