@extends("front.layouts.app")

@section("content")

    @if(session("success"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("success") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-center">
        <a href="{{route("createNote")}}" class="btn btn-success">Not Oluştur</a>
    </div>

    @if($notes->count() > 0)
        @foreach($notes as $note)
            <div class="bg-light my-3 p-3 shadow rounded-3">
                <h2><a href="{{route("noteDetails", $note)}}" class="text-dark" style="text-decoration: none;">{{$note->title}}</a></h2>
                <p class="mt-3">{{Str::limit($note->content, 200)}}</p>
                <p class="mt-3 opacity-50 d-flex justify-content-end">{{$note->updated_at->diffForHumans()}}</p>
            </div>
        @endforeach

        <div class="mt-5 d-flex justify-content-center ">
            {{ $notes->links() }}
        </div>
    @else
        <h2 class="mt-5 text-center opacity-50">Henüz bir not oluşturmadınız.</h2>
    @endif
@endsection
