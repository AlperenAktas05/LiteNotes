<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function app(){
        return view("front.layouts.app");
    }

    public function index(){

        $notes = Note::where("user_id", Auth::id())->latest("updated_at")->paginate(5);

        return view("front.index", compact("notes"));
    }

    public function createNote(){
        return view("front.create");
    }

    public function addNote(Request $request){

        request()->validate([
            'title' => 'required | min:5 | max:50',
            'content' => 'required',
        ],[
            "title.required" => "Lütfen başlık ekleyiniz!",
            "title.min" => "Başlık minimum 5 haneli olmalı!",
            "title.max" => "Başlık maksimum 50 haneli olmalı!",
            "content.required" => "Lütfen içerik ekleyiniz!"
        ]);

        $note = new Note();

        $note->user_id = Auth::id();
        $note->uuid = Str::uuid();
        $note->title = $request->input("title");
        $note->content = $request->input("content");
        $note->save();

        return redirect()->route("index")->with("success", "Başarıyla oluşturuldu.");
    }

    public function noteDetails(Note $note){

        if($note->user_id != Auth::id()){
            abort(403);
        }

        return view("front.noteDetails", compact("note"));
    }

    public function updateNote(Note $note)
    {
        if($note->user_id != Auth::id()){
            abort(403);
        }

        return view("front.update", compact("note"));
    }

    public function updatedNote(Request $request, Note $note)
    {

        request()->validate([
           "title" => "required | min:5 | max:50",
           "content" => "required"
        ],[
            "title.required" => "Lütfen başlık ekleyiniz!",
            "title.min" => "Başlık minimum 5 haneli olmalı!",
            "title.max" => "Başlık maksimum 50 haneli olmalı!",
            "content.required" => "Lütfen içerik ekleyiniz!"
        ]);

        if($note->user_id != Auth::id()){
            abort(403);
        }

        $note->title = $request->input("title");
        $note->content = $request->input("content");
        $note->save();

        return redirect()->route("index")->with("success", "Başarıyla güncellendi.");
    }

    public function deleteNote(Note $note)
    {
        if($note->user_id != Auth::id()){
            abort(403);
        }

        $note->delete();

        return redirect()->route("index")->with("success", "Başarıyla silindi.");
    }
}
