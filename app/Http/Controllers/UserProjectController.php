<?php

namespace App\Http\Controllers;

use App\Models\UserProject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('UserProjects/Index', [

            //

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('UserProjects/NewProject', [

            //This creates a page for file and project name inputs. These values should be sent to the store function
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * This function is only called when createing a new project 
     * (to update/add more files use the update() function).
     * It takes the new project's name and all the files (maybe additional configs) and stores them all
     * 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //new project name is stored in the db together with the project configs (and maybe file names).
        //(the project configs could include all changes made inside the project or these could be saved in other files)
        $project_name= $request -> Title;




        //files are stored in the user directory
        $files = $request->file('file');

        for($i = 0; $i < count($files); ++$i) {
            //$filename = time() . '_' . $files[$i]->getClientOriginalName();
            $files[$i]->store('teststore') ;
        }
        
        //testing the response
        return $project_name;
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function show(UserProject $userProject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * (this function changes the configs and updates the vue container)
     *
     * @param  \App\Models\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProject $userProject)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * (This function mainly adds files to the project)
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserProject $userProject)
    {
        //  
    }








    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProject  $userProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProject $userProject)
    {
        //
    }
}
