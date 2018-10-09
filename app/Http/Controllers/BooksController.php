<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Auth;
use Validator;

class BooksController extends Controller
{
  /**
   * [__construct description]
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * list 一覧表示
   * @return view viewヘルパ関数結果
   */
  public function list() {
    $books = Book::where('user_id', Auth::user()->id)
              ->orderBy('created_at', 'asc')
              ->paginate(2);
    return view('books', [
      'books' => $books
    ]);
  }

  /**
   * store 登録処理
   * @param  Request $request リクエスト
   * @return Illuminate\Http\RedirectResponse
   */
  public function store(Request $request) {
    // validation
    $validator = Validator::make($request->all(), [
       'item_name'   => 'required|min:3|max:255'
      ,'item_number' => 'required|min:1|max:3'
      ,'item_amount' => 'required|max:6'
      ,'published'   => 'required|date'
    ]);

    // validation errors
    if ($validator->fails()) {
      return redirect('/')
                ->withInput()
                ->withErrors($validator);
    }

    // 本登録処理
    // Eloquent model
    $books = new Book;
    $books->user_id     = Auth::user()->id;
    $books->item_name   = $request->item_name;
    $books->item_number = $request->item_number;
    $books->item_amount = $request->item_amount;
    $books->published   = $request->published;
    $books->save();

    return redirect('/');
  }

  /**
   * delete 削除処理
   * @param  Book   $book 削除対象bookオブジェクト
   * @return Illuminate\Http\RedirectResponse
   */
  public function delete(Book $book) {
    $book->delete();
    return redirect('/');
  }
}
