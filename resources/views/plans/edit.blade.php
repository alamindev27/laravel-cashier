@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card" style="width:24rem;margin:auto;">
        <div class="card-body">
            <form action="{{route('store.update', $plan->id)}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="plan name">Plan Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $plan->name }}" placeholder="Enter Plan Name">
                </div>
                <div class="form-group">
                    <label for="cost">Cost:</label>
                    <input type="text" class="form-control" name="cost" value="{{ $plan->cost }}" placeholder="Enter Cost">
                </div>
                <div class="form-group">
                    <label for="cost">Plan Description:</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter Description" value="{{ $plan->description }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
