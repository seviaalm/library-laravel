<?php

namespace App\Http\Controllers;

use App\BookBorrow;
use App\BookBorrowDetails;
use App\BookReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BookBorrowController extends Controller
{

    //add item for bookborrowdetails
    public function addItem(Request $request, $book_borrow_id)
    {
        $validator = Validator::make($request->all(),[
            'book_id' => 'required',
            'qty' => 'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save = BookBorrowDetails::create([
            'book_borrow_id' => $book_borrow_id,
            'book_id' => $request->book_id,
            'qty' => $request->qty
        ]);
        if($save){
            return Response() -> json([
                'status' => 1,
                'message' => 'Success add item!',
            ]);
        }else {
            return Response() -> json([
                'status' => 0,
                'message' => 'Failed add item!'
            ]);
        }
    }
    //addItem end

    //create data start 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'date_of_borrowing' => 'required',
            'date_of_returning'  => 'required'
        ]);

        if($validator->fails()){
            return Response() -> json($validator->errors());
        }

        $store = BookBorrow::create([
            'student_id' => $request->student_id,
            'date_of_borrowing' => $request->date_of_borrowing,
            'date_of_returning' => $request->date_of_returning
        ]);

        $data = BookBorrow::where('student_id', '=', $request->student_id)->get();
        if($store){
            return Response() -> json([
                'status' => 1,
                'message' => 'Succes create new data!',
                'data' => $data
            ]);
        }else
        {
            return Response() -> json([
                'status' => 0,
                'message' => 'Failed create new data!'
            ]);
        }
    }
    //create data end

    //read data start
    public function show(){
        return BookBorrow::all();
    }

    public function detail($id){
        if(DB::table('book_borrow')->where('book_borrow_id', $id)->exists()){
            $detail_book_borrow = DB::table('book_borrow')
            ->select('book_borrow.book_borrow_id', 'book_borrow.student_id', 'students.student_name', 'book_borrow.date_of_borrowing', 'book_borrow.date_of_returning')
            ->join('students', 'students.student_id', '=', 'book_borrow.student_id')
            ->where('book_borrow_id', $id)
            ->get();
            return Response()->json($detail_book_borrow);
        }else {
            return Response()->json(['message' => 'Couldnt find the data']);
        }
    }
    //read data end

    //update data start
    public function update($id, Request $request){
        $validator=Validator::make($request->all(),
        [
            'student_id' => 'required',
            'date_of_borrowing' => 'required',
            'date_of_returning'  => 'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $update=DB::table('book_borrow')
        ->where('book_borrow_id', '=', $id)
        ->update([
            'student_id' => $request->student_id,
            'date_of_borrowing' => $request->date_of_borrowing,
            'date_of_returning' => $request->date_of_returning
        ]);

        $data=BookBorrow::where('book_borrow_id', '=', $id)->get();
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
        $delete=DB::table('book_borrow')
        ->where('book_borrow_id', '=', $id)
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
