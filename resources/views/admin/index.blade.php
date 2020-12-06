@extends('admin.layouts.app')

@section('content')
<div class="dash">
    <div class="row my-5">
        <div class="col-md-4 col-sm-6 my-4">
            <a href="{{ route('admin.country.index') }}">
                <div class="sort-info">
                    <div class="icon shadow position-absolute">
                        <img alt='' src="{{ asset('/images/language.png') }}" style='width:15px;border-radius: 20px;'>
                    </div>
                    <div class="float-right text-left">
                        <h2>Language</h2>
                        <h3>{{ $countLanguage }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 my-4">
            <a href="{{ route('admin.country.index') }}">
                <div class="sort-info">
                    <div class="icon shadow position-absolute">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                    </div>
                    <div class="float-right text-left">
                        <h2>Country</h2>
                        <h3>{{ $countCountry }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 my-4">
            <a href="{{ route('admin.genres.index') }}">
                <div class="sort-info">
                    <div class="icon shadow position-absolute">
                        <i class="fa fa-server" aria-hidden="true"></i>
                    </div>
                    <div class="float-right text-left">
                        <h2>Genres</h2>
                        <h3>{{ $countGenres }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 my-4">
            <a href="{{ route('admin.radio.index') }}">
                <div class="sort-info pr-4">
                    <div class="icon shadow position-absolute">
                        <i class="fa fa-music"></i>
                    </div>
                    <div class="float-right text-left">
                        <h2>Radio Station</h2>
                        <h3>{{ $countRadio }}</h3>
                    </div>
                </div>
            </a>
        </div>

        
  </div>
</div>

@endsection