@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Mira las publicaciones</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @if (file_exists('storage/'.$imagen->image_path))
                                <div class="card text-center mt-5">
                                    <div class="card-header">
                                        <div>
                                            <img src="{{ asset('storage/'.$imagen->user->image) }}" alt=""  class="rounded-circle avatar">
                                            <span class="text-sm">{{ $imagen->user->nick }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body ">
                                        <div class="card-img-top">
                                            <img src="{{ asset('storage/'.$imagen->image_path) }}" alt=""  class="rounded card-img-top"> {{ file_exists('storage/'.$imagen->image_path) ? '' : $imagen->description }}
                                        </div>
                                        <p class="card-text">{{$imagen->description}}</p>
                                    </div>
                                    <div class="card-footer text-muted pull-right">
                                        <div class="float-left">
                                            {{-- button for comments --}}
                                            <a href="" class="btn btn-primary pull-right ">Comentarios ({{ count($imagen->comments) }})</a>
                                            {{-- button for likes --}}
                                            <img src="{{ asset('imagenlike/like1.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endif
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
