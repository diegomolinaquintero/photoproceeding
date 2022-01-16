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
                            @if (file_exists('storage/'.$imagen->image_path))
                                <div class="card text-center mt-5">
                                    <div class="card-header">
                                            <div>  
                                                <img src="{{ asset('storage/'.$imagen->user->image) }}" alt=""  class="rounded-circle avatar">
                                                <span class="text-sm">{{ $imagen->user->nick }}</span>
                                            </div>
                                    </div>
                                    <div class="card-body ">
                                        <a href="{{ route('showimage',['id'=>$imagen->id ]) }}">

                                            <div class="card-img-top">
                                                <img src="{{ asset('storage/'.$imagen->image_path) }}" alt=""  class="rounded card-img-top"> {{ file_exists('storage/'.$imagen->image_path) ? '' : $imagen->description }}
                                            </div>
                                        </a>
                                        <p class="card-text float-left">
                                            <div class="float-left">
                                                <span class="float-left small">{{ $imagen->created_at->diffForHumans() }}</span>
                                                <div> </div>
                                                <span class="float-left">{{ $imagen->description}}</span>
                                            </div>
                                            {{-- {{ $imagen->created_at->diffForHumans().' - '.$imagen->description}}</p> --}}
                                        </p>
                                    </div>
                                    <div class="card-footer text-muted pull-right">
                                        <div class="float-left">
                                            <div class="container">
                                                {{-- button for likes --}}
                                                <img class="float-left" src="{{ asset('imagenlike/like1.png') }}" alt="">
                                                <div class="row">
                                                    {{-- button for comments
                                                    <h3 class="col-6 col-sm-3">Comentarios ({{ count($imagen->comments) }})</h3> --}}
                                                    {{-- form by comments --}}
                                                    <form class="form-inline" action="{{ route('savecomment') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="image_id" value="{{ $imagen->id }}">
                                                        <div class="form-group row">
                                                            <label for="comments" class=" col-form-label">Comentarios ({{ count($imagen->comments) }})</label>
                                                            <textarea id="comments" type="text" class="form-control "  placeholder="Comentar" style="height: 100px">
                                                            </textarea>
                                                            <button type="submit" class="btn btn-primary col-form-label">
                                                                Comentar
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection
