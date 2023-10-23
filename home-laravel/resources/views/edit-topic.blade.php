<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=no">
    <title>DataFirst</title>
  </head>
  <body>
    <div style="border:3px solid black;">
      <h2>Edit Topic</h2>
      <form action="/edit-topic/{{$topic->id}}" method="POST">
        @csrf
        @method('PUT')
        <input name="title" type="text" value="{{$topic->title}}" placeholder="name">
        <textarea name="content" placeholder="content">{{$topic->content}}</textarea>
        <button>Save</button>
      </form>
    </div>
  </body>
</html>
