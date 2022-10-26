<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Todo extends Model
{
    public function readAll($userId){
        $allTodo = DB::table("todo")
        ->where('user_id',$userId)
        ->get();
    return $allTodo;
    }

    public function createOne($todoBody,$userId){
        $createNewTodo = DB::table("todo")
        ->insert(['user_id'=>$userId,'body'=>$todoBody]);
    return $createNewTodo;
    }
    
    
    public function updateTodo($updateData){
        $todoBody=$updateData['todoBody'];
        $status=$updateData['status'];
        
        $update = DB::table("todo")
            ->where('id',$updateData['todoId'])
            ->where('user_id',$updateData['userId'])
            ->when($todoBody, function ($query,$todoBody) {
                $query->update(['body'=>$todoBody]);
            })
            ->when($status, function ($query1,$status) {
                $query1->update(['status'=>$status]);
            });

         return $update;
    }
    
    public function deleteOne($todoId, $userId){
        $update = DB::table("todo")
        ->where('id',$todoId)
        ->where('user_id',$userId)
        ->delete();
    return $update;
    }

}

