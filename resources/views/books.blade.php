@extends('layouts.app')

@section('content')
<!-- Bootstrapの定型コード -->
<div class="container panel-body">
  <!-- バリデーションエラーの表示に使用 -->
  @include('common.errors')

  <!-- login user info -->
  <div class="panel panel-default">
    <table  class="table table-striped task-table">
      <td>組織id : {{ Auth::user()->organization_id }}
      <td>id : {{ Auth::user()->id }}</td>
      <td>名前 : {{ Auth::user()->name }}</td>
      <td>登録日時 : {{ Auth::user()->created_at }}</td>
    </table>
  </div>

  <!-- 本登録フォーム -->
  <form action="{{ url('books') }}" method="POST" class="form-horizonal">
    {{ csrf_field() }}

    <!-- 本のタイトル -->
    <div class="form-group">
      <label for="book" class="col-sm-4 control-label">タイトル</label>
      <div class="col-sm-8">
        <input type="text" name="item_name" id="book-name" class="form-control">
      </div>
    </div>
    <!-- 本の冊数 -->
    <div class="form-group">
      <label for="number" class="col-sm-4 control-label">冊数</label>
      <div class="col-sm-8">
        <input type="text" name="item_number" id="book-number" class="form-control">
      </div>
    </div>
    <!-- 本の金額 -->
    <div class="form-group">
      <label for="amount" class="col-sm-4 control-label">金額</label>
      <div class="col-sm-8">
        <input type="text" name="item_amount" id="book-amount" class="form-control">
      </div>
    </div>
    <!-- 本の公開日時 -->
    <div class="form-group">
      <label for="published" class="col-sm-4 control-label">公開日時</label>
      <div class="col-sm-8">
        <input type="text" name="published" id="book-published" class="form-control">
      </div>
    </div>

    <!-- 本登録ボタン -->
    <div class="form-group">
      <div>
        <button type="submit" class="btn btn-default">
          <i class="glyphicon glyphicon-plus"></i>Save
        </button>
      </div>
    </div>
  </form>

  <!-- 現在の本 -->
  @if(count($books) > 0)
  <div class="panel panel-default">
    現在の本
  </div>
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      {{ $books->links() }}
    </div>
  </div>
  <div class="panel-body">
    <table class="table table-striped task-table">
      <!-- table header -->
      <thead>
        <th>本一覧</th>
        <th>&nbsp;</th>
      </thead>
      <!-- table body -->
      <tbody>
          @foreach($books as $book)
          <tr>
            <!-- book title -->
            <td class="table-text">
              <div>{{ $book->item_name }}</div>
            </td>

            <!-- delete book button -->
            <td>
              <form action="{{ url('book/'.$book->id )}}" method="POST">
                {{ csrf_field()}}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger">
                  <i class="glyphicon glyphicon-trash"></i>削除
                </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @endif
</dif>

<!-- Book: すでに登録されている本のリスト -->
@endsection
