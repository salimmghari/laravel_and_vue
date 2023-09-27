<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Models\Note;
use App\Http\Resources\NoteResource;


class NoteController extends Controller {
    public function index() {
        $notes = Note::where('user_id', auth()->user()->id)->get();

        return response()->json(NoteResource::collection($notes));
    }

    public function show($id) {
        $note = Note::where('user_id', auth()->user()->id)->findOrFail($id);
         
        return response()->json(new NoteResource($note));
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $note = Note::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->user()->id
        ]);

        return response()->json(new NoteResource($note));
    } 

    public function update(Request $request, $id) {
        $note = Note::where('user_id', auth()->user()->id)->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'string|max:100',
            'body' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $note->update([
            'title' => $request->input('title'),
            'body' => $request->input('body')
        ]);

        return response()->json(new NoteResource($note));
    }

    public function destroy($id) {
        $note = Note::where('user_id', auth()->user()->id)->findOrFail($id);

        $note->delete();

        return response()->json('Note deleted successfully');
    }
}
