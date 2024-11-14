@extends('pokeball.base')

@section('basecontent')

    <div class="form-group">
        Id #
        {{$pokemon->id}}
    </div>
    <div class="form-group">
        Name:
        {{$pokemon->name}}
    </div>
    <div class="form-group">
        Weight:
        {{$pokemon->weight}} kg
    </div>
    <div class="form-group">
        Height:
        {{$pokemon->height}} m
    </div>
    <div class="form-group">
        Type:
        {{$pokemon->type}}
    </div>
    <div class="form-group">
        Number of evolutions:
        {{$pokemon->evolution}}
    </div>
    <div class="form-group">
        <a href="{{url()->previous()}}">back</a>
    </div>

@endsection
