<?php

namespace App\Http\Controllers;

use App\Models\UserProject;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$users = DB::table('users')->get(); then get the id and compare (this can be done in routes section)
        $userid =  $request->user()->id;

        return Inertia::render('UserProjects/Index', [

            'projects' => UserProject::where('user_id', $userid)->orderBy('updated_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('UserProjects/NewProject', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * This function is only called when createing a new project 
     * (to update/add more files use the update() function).
     * It takes the new project's name and all the files (maybe additional configs) and stores them all
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request)
    {
        //new project name is stored in the db together with the project configs (and maybe file names).
        //(the project configs could include all changes made inside the project or these could be saved in other files)
        //$project_name= $request -> name;

        $project_name = $request->validate([

            'name' => 'required|string|max:30', //correct this. It should be unique between the user project names

        ]);
        $userid =  $request->user()->id;

        $userproject = new UserProject(['name' =>$project_name['name'],'user_id' => $userid]);
        $userproject = $userproject->save();

        $files = $request->file('file');
        for($i = 0; $i < count($files); ++$i) {
            //$filename = time() . '_' . $files[$i]->getClientOriginalName();
            $files[$i]->store('teststore') ;
        }
        
        //testing the response
        //return  $userproject -> name;
    
    }

    /**
     * Display the specified resource.
     * @param  \App\Models\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function show( UserProject $project )
    {
        //DO A CHECK TO SEE IF THE USER IS THE AUTH USER, ELSE REDIRECT
        //
        //use project name on the url instead of id
        return Inertia::render('UserProjects/Project', [

            'project_id' => $project -> id,
            'project_name' => $project -> name,

        ]);
    }






    /**
     * Show the form for editing the specified resource.
     * 
     * (this function changes the configs and updates the vue container)
     * @param  \App\Models\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function edit( UserProject $userProject)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * (This function mainly adds files to the project)
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, UserProject $userProject)
    {
        //  
    }



    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function destroy( UserProject $userProject)
    {
        //
    }
}
