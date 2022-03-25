@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card" style="width:24rem;margin:auto;">
        <div class="card-body">
            <form action="{{route('store.plan')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="plan name">Plan Name:</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Plan Name">
                </div>
                <div class="form-group">
                    <label for="cost">Cost:</label>
                    <input type="text" class="form-control" name="cost" placeholder="Enter Cost">
                </div>
                <div class="form-group">
                    <label for="description">Plan Description:</label>
                    <textarea name="description" id="description" placeholder="Enter Description" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
