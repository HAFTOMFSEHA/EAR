@extends('admin.layouts.app')

@section('header', $radio->exists ? 'Detail Radio' : 'Detail Radio')

@section('panel-color', 'primary')

@section('content')
<div class="content">
        <div class="row">
            <div class="content-top-button mb-2">
                <a href="{{ route('admin.radio.index') }}" class='pull-right btn btn-success btn-sm'>Back</a>
            </div>
        </div>
    @include('flash::message')
	
	<div class="form-group">
		<div class="col-sm-5">
			<strong>Country:</strong> {{ $radio->country ? $radio->country->name : "" }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-5">
			<strong>Genres:</strong> {{ $radio->country ? $radio->country->name : "" }}
		</div>
	</div>


	<div class="form-group">
		<div class="col-sm-5">
			<strong>Name:</strong> {{ $radio->country ? $radio->country->name : "" }}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-5">
			<strong>Streaming Link:</strong> {{ $radio->country ? $radio->country->name : "" }}
		</div>
	</div>


	<div class="form-group">
		<div class="col-sm-5">
			<strong>Description:</strong>
			<p>	
				{{ $radio->country ? $radio->country->name : "" }}
			</p>
		</div>
	</div>

    <div class="form-group">
		<div class="col-sm-5">
			<strong>Image:</strong>
		</div>
		<div class="col-sm-5">
			@if($radio->exists)
				<div class="">
                    <img src="{{ asset(config('dashboard.radio_image') . $radio->image) }}" width="100" height="100" class="img-responsive">
				</div>
			@endif
		</div>
	</div>
@stop

