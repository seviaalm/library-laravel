<?php

namespace App\Http\Controllers;

use App\BookReturn;
use App\BookBorrow;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BookReturnController extends Controller
{
    //create data start
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'book_borrow_id' => 'required'
        ]);

        if($validator->fails()){
            return Response() -> json($validator->errors());
        }

        $cekagain = BookReturn::where('book_borrow_id', $request->book_borrow_id);
        if($cekagain->count() == 0){
            $dt_return = BookBorrow::where('book_borrow_id', $request->book_borrow_id)->first();
            $current_date = Carbon::now()->format('Y-m-d');
            $date_of_returning = new Carbon ($dt_return->date_of_returning);
            $fineperday = 1500;
            if(strtotime($current_date) > strtotime($date_of_returning)){
                $numberofdays = $date_of_returning->diff($current_date)->days;
                $fine = $numberofdays * $fineperday;
            }else {
                $fine = 0;
            }
            $save = BookReturn::create([
                'book_borrow_id' => $request->book_borrow_id,
                'date_of_returning' => $date_of_returning,
                'fine' => $fine
            ]);
            if ($save){
                $data['status'] = 1;
                $data['message'] = 'Successfully Returned!';
            }else {
                $data['status'] = 0;
                $data['message'] = 'Failed Returned!';
            }
        }else {
            $data = ['status' => 0, 'message' => 'Has Been Returned!'];
        }
        return Response()->json($data);
    }
    //create data end

    //read data start
    public function show(){
        return BookReturn::all();
    }

    public function detail($id){
        if(DB::table('book_return')->where('book_return_id', $id)->exists()){
            $detail = DB::table('book_return')
            ->select('book_return.*')
            ->join('book_borrow', 'book_borrow.book_borrow_id', '=', 'book_return.book_borrow_id')
            ->where('book_return_id', $id)
            ->get();
            return Response()->json($detail);
        }else{
            return Response()->json(['message' => 'Couldnt find the data']);
        }
    }
    //read data end

    //update data start
    public function update($id, Request $request){
        $validator=Validator::make($request->all(),
        [
            'book_borrow_id' => 'required',
            'date_of_returning' => 'required',
            'fine' => 'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $update=DB::table('book_return')
        ->where('book_return_id', '=', $id)
        ->update([
            'book_borrow_id' => $request->book_borrow_id,
            'date_of_returning' => $request->date_of_returning,
            'fine' => $request->fine
        ]);

        $data=BookReturn::where('book_return_id', '=', $id)->get();
        if($update){
            return Response() -> json([
                'status' => 1,
                'message' => 'Success updating data!',
                'data' => $data  
            ]);
        } else {
            return Response() -> json([
                'status' => 0,
                'message' => 'Failed updating data!'
            ]);
        }
    }
    //update data end

    //delete data start
    public function delete($id){
        $delete = DB::table('book_return')
        ->where('book_return_id', '=', $id)
        ->delete();

        if($delete){
            return Response() -> json([
                'status' => 1,
                'message' => 'Succes delete data!'
        ]);
        } else {
            return Response() -> json([
                'status' => 0,
                'message' => 'Failed delete data!'
        ]);
        }

    }
    //delete data end
}
