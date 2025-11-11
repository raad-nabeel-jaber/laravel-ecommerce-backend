<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use App\Http\Requests\UpdateAboutRequest;


class AboutController extends Controller
{
    public function index()
    {
        return About::all();
    }

    public function update(UpdateAboutRequest $request, $id){
        $about = About::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('abouts', 'public');
        }

        $about->update($data);
        return response()->json($about, 200);
    }
}
