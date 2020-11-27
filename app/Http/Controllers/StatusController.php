<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Status;

class StatusController extends Controller
{
    public function destroy(Request $request,$id)
    {
    	 Status::where('id',$id)->delete();
    	 Task::where('status_id',$id)->delete();
    	    return $request->user()->statuses()->with('tasks')->get();
    }

    public function update(Request $request, $id)
    {
      	
      	 Status::where('id',$id)->update([

      	 	'title' => $request->title,
      	 	'slug' => preg_replace('/\s+/', '-', strtolower($request->title))


      	 	]);

      	 return $request->user()->statuses()->with('tasks')->get();
       
    }

    public function store(Request $request)
    {

       
    

        			$this->validate($request, [
            'title' => ['required', 'string', 'max:56'],
            'slug' => ['string'],
            'order' => ['required', 'numeric']
        ]);

        
         $request->user()
            ->statuses()
            ->create($request->only('title', 'slug', 'order'));

           return $tasks = auth()->user()->statuses()->with('tasks')->get();

    }
}
