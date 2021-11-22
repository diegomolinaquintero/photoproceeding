@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mira las publicaciones</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @foreach ($imagenes as $imagen)
                        <div class="card text-center mt-5">
                            <div class="card-header">
                                <div>
                                    <img src="{{ asset('storage/'.$imagen->user->image) }}" alt=""  class="rounded-circle avatar">
                                    <span class="text-sm">{{ $imagen->user->nick }}</span>
                                </div>
                            </div>
                            <div class="card-body ">
                                <div class="card-img-top">
                                    <img src="{{ asset('storage/'.$imagen->image_path) }}" alt=""  class="rounded card-img-top">
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <p class="card-text">{{$imagen->description}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
