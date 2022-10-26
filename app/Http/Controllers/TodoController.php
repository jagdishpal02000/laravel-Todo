<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class TodoController extends Controller
{
    //
    function getAll(Request $request){
        $responseStatus=200;
        $TodoModel = new Models\Todo();
        $userId=$request->user()->id;

        $responseData = $TodoModel->readAll($userId);

       return response()->json($responseData, $responseStatus);
    }

    //todoBody

    function createTodo(Request $request){
        $flag = false;
        $responseData = [];
        $responseStatus = 400;
        $requestData = $request->input();
        $todoBody = $requestData['todoBody'];
        $userId=$request->user()->id;

        if (empty($todoBody)) {
            $responseData['message'] = "Todo Body can not blank!";
        }else {
            $flag = true;;
        }

        if ($flag) {
            $TodoModel = new Models\Todo();
            $responseData['success'] = $TodoModel->createOne($todoBody, $userId);
        }
       return response()->json($responseData, $responseStatus);
    }

    // todoId
    // todoBody #
    // todoStatus #
    function updateTodo(Request $request){
        $flag = false;
        $responseData = [];
        $responseStatus = 400;
        $requestData = $request->input();
        $todoBody = $requestData['todoBody'] ?? null;
        $status = $requestData['status'] ?? null;
        $todoId = $requestData['todoId'] ?? null;
        $userId=$request->user()->id;

        if (empty($todoId)) {
            $responseData['message'] = "Todo Id can not blank!";
        }
        else {
            $flag = true;;
        }
        if ($flag) {
            $updateData['todoId'] = $todoId;
            $updateData['userId'] = $userId;
            $updateData['todoBody'] = $todoBody;
            $updateData['status'] = $status;

            $TodoModel = new Models\Todo();
            $responseData['success'] = $TodoModel->updateTodo($updateData);
        }
       return response()->json($responseData, $responseStatus);
    }

    //todoId
    function deleteTodo(Request $request){
        $flag = false;
        $responseData = [];
        $responseStatus = 400;
        $requestData = $request->input();
        $todoId = $requestData['todoId'];
        $userId=$request->user()->id;

        if (empty($todoId)) {
            $responseData['message'] = "Todo Id can not blank!";
        }else {
            $flag = true;;
        }
        if ($flag) {
            $TodoModel = new Models\Todo();
            $responseData['success'] = $TodoModel->deleteOne($todoId, $userId);
        }
       return response()->json($responseData, $responseStatus);
    }

}
