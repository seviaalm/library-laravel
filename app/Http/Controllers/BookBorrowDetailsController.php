<?php

namespace App\Http\Controllers;

use App\BookBorrowDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BookBorrowDetailsController extends Controller
{
    //create data start
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'book_borrow_id' => 'required',
            'book_id' => 'required',
            'qty' => 'required'
        ]);

        if($validator->fails()){
            return Response() -> json($validator->errors());
        }

        $store = BookBorrowDetails::create([
            'book_borrow_id' => $request->book_borrow_id,
            'book_id' => $request->book_id,
            'qty' => $request->qty
        ]);

        $data = BookBorrowDetails::where('book_borrow_id', '=', $request->book_borrow_id)->get();
        if($store){ 
            return Response()->json([
                'status' => 1,
                'message' => 'Succes create new data!',
                'data' => $data
            ]);
        }else {
            return Response() -> json([
                'status' => 0,
                'message' => 'Failed create new data!'
            ]);
        }
    }
    //create data end

    //read data start
    public function show(){
        return BookBorrowDetails::all();
    }

    public function detail($id){
        if(DB::table('book_borrow_details')->where('book_borrow_detail_id', $id)->exists()){
            $detail = DB::table('book_borrow_details')
            ->select('book_borrow_details.*')
            ->join('book_borrow', 'book_borrow.book_borrow_id', '=', 'book_borrow_details.book_borrow_id')
            ->join('book', 'book.book_id', '=', 'book_borrow_details.book_id')
            ->get();
            return Response()->json($detail);
        }else {
            return Response()->json(['message'=>'Couldnt find the data']);
        }
    }
    //read data end

    //update data start
    public function update($id, Request $request){
        $validator=Validator::make($request->all(),
        [
            'book_borrow_id' => 'required',
            'book_id' => 'required',
            'qty' => 'required'
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $update=DB::table('book_borrow_details')
        ->where('book_borrow_detail_id', '=', $id)
        ->update(
            [
                'book_borrow_id' => $request->book_borrow_id,
                'book_id' => $request->book_id,
                'qty' => $request->qty
            ]);

        $data=BookBorrowDetails::where('book_borrow_detail_id', '=', $id)->get();
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
        $delete = DB::table('book_borrow_details')
        ->where('book_borrow_details_id', '=', $id)
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
