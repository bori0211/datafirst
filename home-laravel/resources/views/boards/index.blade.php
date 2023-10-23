@extends('boards.layout')

@section('content')

board index

<a href="/boards/create">글 쓰기</a>

<a href="{{ route('boards.create') }}">글 쓰기</a>

<table border="1">
  <tr>
    <th>No</th>
    <th>제목</th>
    <th>작성일</th>
    <th>관리</th>
  </tr>
  @foreach($lists as $list)
  <tr>
    <td>{{ $list->id }}</td>
    <td>{{ $list->subject }}</td>
    <td>{{ $list->created_at }}</td>
    <td>
      <a href="/boards/{{ $list->id }}">보기</a>
      <a href="/boards/{{ $list->id }}/edit">수정</a>
      <form action="/boards/{{ $list->id }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">삭제</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>

@endsection