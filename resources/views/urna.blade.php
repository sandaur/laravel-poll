@extends('layouts.base')

@section('content')
    <div class="row bg-primary" style="height: 25vh;">
        <div class="col align-self-center">
            <h1 class="font-weight-bold text-center " >Urna {{ $poll->title }}</h1>

        </div>
    </div>

    <div class="container">    
        <div class="row mt-5" style="text-align: center;">
            @foreach ($options as $option)
                <div class="col">
                    <img class="rounded-circle" src="{{ asset('storage/opt_img/'.$option->image) }}" alt="candidate_image" width="140" height="140">
                    <h2>{{ $option->name }}</h2>
                    <p>{{ $option->description }}</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details »</a></p>
                </div><!-- /.col-lg-4 -->
            @endforeach
        </div><!-- /.row -->

      </div>
@endsection