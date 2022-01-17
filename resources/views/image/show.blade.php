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
                                            <div class="container">
                                                {{-- button for likes --}}
                                                <div class="row">
                                                    <br>
                                                    <img class="float-left" src="{{ asset('imagenlike/like1.png') }}" alt="">
                                                    <br>
                                                </div>
                                                <div class="row">
                                                    {{-- button for comments
                                                    <h3 class="col-6 col-sm-3">Comentarios ({{ count($imagen->comments) }})</h3> --}}
                                                    {{-- form by comments --}}
                                                    <div>
                                                        <form class="form-inline" action="{{ route('savecomment') }}" method="POST">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <input type="hidden" name="image_id" value="{{ $imagen->id }}">
                                                                <input type="text" name="comentarios" id="comentarios" class="form-control @error('comentarios') is-invalid @enderror" required>
                                                                
                                                                @error('comentarios')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                                {{-- <input id="commentarios" type="text" class="form-control "  placeholder="Comentar" style="height: 100px"> --}}
                                                                
                                                                <button type="submit" class="btn btn-primary col-form-label">
                                                                    Comentar
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <br>
                                                    {{-- comments --}}
                                                    <div>
                                                        <div class="form-group bordered">
                                                            <br>
                                                            <label for="comments" class=" col-form-label">Comentarios ({{ count($imagen->comments) }})</label>
                                                        </div>
                                                        @foreach ($imagen->comments as $comment)
                                                        <div class="form-group bordered">
                                                                <p class="card-text">
                                                                    <div class="float-left">
                                                                        <div> 
                                                                            <span class="float-left">{{ $comment->content }} </span>
                                                                            <br>
                                                                            <span class="float-left">by {{ $comment->user->name }}</span>
                                                                            <span class="float-left small">at {{ $comment->created_at->diffForHumans() }}</span>
                                                                        </div>
                                                                    </div>
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
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
