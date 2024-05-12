@extends("front.layouts.app")

@section("content")

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{route("addNote")}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Başlık</label>
            <input type="text" name="title" class="form-control" placeholder="Lütfen başlık giriniz" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old("title")}}">
            @error("title")
                <p class="mt-2 text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">İçerik</label>
            <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="5">{{old("content")}}</textarea>
            @error("content")
                <p class="mt-2 text-danger">{{$message}}</p>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Gönder</button>
    </form>

@endsection
