<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuestionController extends Controller
{
    


    public function store(StoreQuestionRequest $request, $productId){

        try{
         DB::beginTransaction();
         $question = new Question();
         $question->name = $request->name;
         $question->product_id = $productId;
         $question->question = $request->question;
         $question->save();
         DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            Log::info('error', [$e]);
            return redirect()->back()->with('error', 'sorry could not post your question try again later');
        }

        return redirect()->back()->with('success', 'You have added your question successfully');
    }
}
