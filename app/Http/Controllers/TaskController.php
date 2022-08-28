<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Tasks;

class TaskController extends Controller
{

    public function showTasks(){

        $toDoTasks = Tasks::select("*")->where('STATUS', 'to-do')->orderBy('TASK_ID', 'DESC')->get();
        $inProgressTasks = Tasks::select("*")->where('STATUS', 'in-progress')->orderBy('TASK_ID', 'DESC')->get();
        $doneTasks = Tasks::select("*")->where('STATUS', 'done')->orderBy('TASK_ID', 'DESC')->get();

        return view('kanban-board',compact('toDoTasks','inProgressTasks','doneTasks'));

    }

    public function ajaxInsert(Request $request){
        $validated = $request->validate([
            'task_description' => 'required',
        ],
        [
            'task_description.required' => 'Please Enter Task Name',
        ]);

        $data = array();

        $data["DESCRIPTION"] = $request->task_description;
        $data["STATUS"] = "to-do";
        $data["created_at"] = Carbon::now();
        $data["updated_at"] = Carbon::now();

        $TASK_ID = DB::table('tasks')->insertGetId($data);

        $records = Tasks::select("*")->where('STATUS', 'to-do')->orderBy('TASK_ID', 'DESC')->get();

        return Response()->json($records);
        // return response()->json(['success' => 'Task Added Successfully.', 'TASK_ID' => $records]);

    }

    public function ajaxUpdate(Request $request){

        $data = array();

        $STATUS = $data["STATUS"] = $request->STATUS;
        $data["updated_at"] = Carbon::now();
        $TASK_ID = $request->TASK_ID;

        DB::table('tasks')->where('TASK_ID',$TASK_ID)->update($data);

        $records = Tasks::select("*")->where('STATUS', $STATUS)->orderBy('TASK_ID', 'DESC')->get();
        // $records["U_TIME"] = "12";

        return Response()->json($records);
        // return response()->json(['records' => $records, 'updated_at' => $records->updated_at->diffForHumans()]);

    }

    public function ajaxDelete($id){

        // $delete = Tasks::find($id)->delete();
        DB::table("tasks")->where('TASK_ID',$id)->delete();

        return response()->json(['success' => 'Task Deleted Successfully.']);
    }

}
