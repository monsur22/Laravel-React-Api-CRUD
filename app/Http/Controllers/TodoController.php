<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TodoRequest;
class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks=Todo::all();
        // $tasks=Todo::paginate(2);
        // $tasks=Todo::orderBy('id', 'desc')->paginate(5);
        return request()->json(200,$tasks);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $todo=Todo::create($request->all());

        if($todo){
            $tasks=Todo::orderBy('id', 'desc')->paginate(5);
            return request()->json(200,$tasks);
           
        }
 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $task)
    {
        return request()->json(200,$task);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, Todo $task)
    {
        $task->name =$request->name;
        if($task->save()){
            $tasks=Todo::orderBy('id', 'desc')->paginate(5);
            return request()->json(200,$tasks);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $task)
    {
        if ($task->delete()) {
            $tasks=Todo::orderBy('id', 'desc')->paginate(5);
            return request()->json(200,$tasks);
        } else {
           return response()->json(425,['delete' => "error deleting record"]);
        }
        
        
    }
}
