@extends('admin.layouts.app')

@section('header', $genres->exists ? 'Edit Genres' : 'New Genres')

@section('panel-color', 'primary')

@section('content')
	<div class="content">
        <div class="row">
            <div class="content-top-button mb-2">
                <a href="{{ route('admin.genres.index') }}" class='pull-right btn btn-success btn-sm'>Back</a>
            </div>
        </div>
		@include('flash::message')
		@if($genres->exists)
			{{Form::model($genres, [
				'route' => ['admin.genres.update', $genres],
				'method' => 'PUT',
				'class' => 'form-horizontal',
				'enctype'=>'multipart/form-data'
				])
			}}
		@else
			{{ Form::open([
				'url' => route('admin.genres.store') ,
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
			{{ Form::label('image', 'Image', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-5">
				@if($genres->exists)
					<div class="">
						<img src="{{ asset(config('dashboard.genres_image') . $genres->image) }}" width="100" height="100" class="img-responsive">
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
				{{ Form::submit($genres->exists ? 'Edit' : 'Create', ['class'=>'btn btn-primary']) }}
			</div>
		</div>

		{{ Form::close() }}
	</div>		
@stop

