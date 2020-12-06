@extends('admin.layouts.app')

@section('header', $radio->exists ? 'Edit Radio' : 'New Radio')

@section('panel-color', 'primary')

@section('content')
<div class="content">
        <div class="row">
            <div class="content-top-button mb-2">
                <a href="{{ route('admin.radio.index') }}" class='pull-right btn btn-success btn-sm'>Back</a>
            </div>
        </div>
    @include('flash::message')
	@if($radio->exists)
		{{Form::model($radio, [
			'route' => ['admin.radio.update', $radio],
			'method' => 'PUT',
			'class' => 'form-horizontal',
			'enctype'=>'multipart/form-data'
			])
		}}
	@else
		{{ Form::open([
			'url' => route('admin.radio.store') ,
			'method' => 'POST',
			'class' => 'form-horizontal',
			'enctype'=>'multipart/form-data'
			])
		}}
	@endif

	<div class="form-group">
		{{ Form::label('name', 'Language', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::select('language_id', $languageList, null, ['class'=>'form-control']) }}
		</div>
	</div>
	
	<div class="form-group">
		{{ Form::label('name', 'Country', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::select('country_id', $countryList, null, ['class'=>'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('name', 'Genres', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::select('genres_id', $genresList,  null, ['class'=>'form-control']) }}
		</div>
	</div>


	<div class="form-group">
		{{ Form::label('name', 'Name', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::Text('name', null , ['class'=>'form-control']) }}
		</div>
	</div>

	<div class="form-group">
		{{ Form::label('streaming_link', 'Streaming Link', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::Text('streaming_link', null , ['class'=>'form-control']) }}
		</div>
	</div>


	<div class="form-group">
		{{ Form::label('name', 'Description', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			{{ Form::Text('description', null , ['class'=>'form-control']) }}
		</div>
	</div>

    <div class="form-group">
		{{ Form::label('image', 'Image', ['class' => 'control-label col-sm-3']) }}
		<div class="col-sm-5">
			@if($radio->exists)
				<div class="">
                    <img src="{{ asset(config('dashboard.radio_image') . $radio->image) }}" width="100" height="100" class="img-responsive">
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
		    {{ Form::submit($radio->exists ? 'Edit' : 'Create', ['class'=>'btn btn-primary']) }}
		</div>
	</div>

	{{ Form::close() }}
@stop

