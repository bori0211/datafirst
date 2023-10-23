@extends('boards.layout')

@section('content')

<a href="/boards">목록</a>

<form action="/boards/{{ $board->id }}" method="POST">
  @csrf
  @method('PUT')

  <table border="1">
    <tr>
      <th>제목</th>
      <td><input type="text" name="subject" value="{{ $board->subject }}" /></td>
    </tr>
    <tr>
      <th>내용</th>
      <td><textarea name="content" rows="5">{{ $board->content }}</textarea></td>
    </tr>
    <tr>
      <td colspan="2">
        <button type="submit">저장</button>
      </td>
    </tr>
  </table>

</form>

@endsection