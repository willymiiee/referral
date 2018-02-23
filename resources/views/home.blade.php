@extends('layouts.app')

@section('content')
    <form action="{{ url('/') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="upline">Upline</label>
            <select name="upline_id" id="upline" class="form-control">
                <option disabled selected>Choose Upline</option>
                @foreach ($network as $n)
                <option value="{{ $n->id }}">{{ $n->id }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@stop