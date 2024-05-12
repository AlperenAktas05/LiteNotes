@extends("front.layouts.app")

@section("content")

    <div class="my-3 p-3">
        <h2>{{$note->title}}</h2>
        <p class="mt-3">{{$note->content}}</p>
        <p class="mt-3 opacity-50 d-flex justify-content-end">{{$note->updated_at->diffForHumans()}}</p>
        <a class="btn btn-success mt-3" href="{{route("updateNote", $note)}}">Güncelle</a>
        <a class="btn btn-danger mt-3" href="{{route("deleteNote", $note)}}">Sil</a>
    </div>

@endsection
