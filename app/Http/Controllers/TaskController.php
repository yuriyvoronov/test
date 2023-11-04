<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function get(Request $request)
    {
        // dump($request->status);
        $user_id = 1;
        $tasks = \App\Models\Task::where('user_id', $user_id);
        
        if(isset($request->status)) $tasks->where('status', $request->status);
        if(isset($request->priority)) $tasks->where('priority', $request->priority);
        if(isset($request->title)) 
        {
            $words = explode(' ', $request->title);
            foreach($words as $word)
            {
                $tasks->where('title', 'LIKE', '%'.$word.'%');
            }
        }
        if(isset($request->description)) 
        {
            $words = explode(' ', $request->description);
            foreach($words as $word)
            {
                $tasks->where('description', 'LIKE', '%'.$word.'%');
            }

        }
        if(isset($request->proirity_order))
        {
            ($request->proirity_order == 'asc') ? $tasks->orderby('proirity', 'asc') : $tasks->orderby('proirity', 'desc'); 
        }
        if(isset($request->created_order))
        {
            ($request->created_order == 'asc') ? $tasks->orderby('created_at', 'asc') : $tasks->orderby('created_at', 'desc'); 
        }
        // if(isset($request->created_order))
        // {
        //     ($request->created_order == 'asc') ? $tasks->orderby('created_at', 'asc') : $tasks->orderby('created_at', 'desc'); 
        // }

        $res = $tasks->get();
        return($res);
    }
    public function post(Request $request)
    {
        if(!$request) return;
        $user_id = 1;
        $task = new \App\Models\Task();
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->title = $request->title;
        $task->user_id = $user_id;
        $task->description = $request->description;
        $task->save();
        return true;
    }
    public function update(Request $request)
    {
        if(!$request) return;
        $user_id = 1;
        $task = \App\Models\Task::where('user_id', $user_id)->where('id', $request->id)->first();
        if($task)
        {
            $task->status = ($request->status) ? $request->status : $task->status;
            $task->priority = ($request->priority) ? $request->priority : $task->priority;
            $task->title = ($request->title) ? $request->title : $task->title;
            $task->description = ($request->description) ? $request->description : $task->description;
            $task->save();
        }
        
    }
    public function set_done(Request $request)
    {
        if(!$request) return;
        $user_id = 1;
        $task = \App\Models\Task::where('user_id', $user_id)->where('id', $request->task_id)->where('status','!=','done')->first();
        if(!is_null($task))
        {
            $task->status = "done";
            $task->save();
        }
        else 
        return 'This task already done';
        return $task->title.' set status "done"';
    }
    public function delete(Request $request)
    {
        if(!$request) return;
        $user_id = 1;
        $task = \App\Models\Task::where('user_id', $user_id)->where('id', $request->task_id)->where('status', 'todo')->first();
        if(!is_null($task)) 
        {
            $task->delete();
            return 'Task deleted';
        }
        else return 'No such task';
    }
}
