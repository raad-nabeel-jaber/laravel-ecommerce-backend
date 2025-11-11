<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OurTeam;
use App\Http\Requests\StoreOurTeamRequest;
use App\Http\Requests\UpdateOurTeamRequest;


class OurTeamController extends Controller
{
    public function index(){
        $teams = OurTeam::all();
        return response()->json($teams);
    }

    public function store(StoreOurTeamRequest $request){
        $ourTeamData = $request->validated();
        if($request->hasFile('image')){
            $path = $request->file('image')->store('assets/img/ourTeamImages', 'public');
            $ourTeamData['image'] = $path;
        }
        $team = OurTeam::create($ourTeamData);
        return response()->json($team, 201);
    }

    public function update(UpdateOurTeamRequest $request, $id){
        $team = OurTeam::findOrFail($id);
        $ourTeamData = $request->validated();
        if($request->hasFile('image')){
            $path = $request->file('image')->store('assets/img/ourTeamImages', 'public');
            $ourTeamData['image'] = $path;
            }
        $team->update($ourTeamData);
        return response()->json($team);
    }
    public function destroy($id){
        $team = OurTeam::findOrFail($id);
        $team->delete();
        return response()->json(null, 204);
    }
}