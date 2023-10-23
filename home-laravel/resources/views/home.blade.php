<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no,user-scalable=no">
    <title>DataFirst</title>
    <link rel="shortcut icon" href="https://laravel.com/img/favicon/favicon.ico" type="image/x-icon">
  </head>
  <body>
    @auth
    <p>You are login.</p>
    <form action="/logout" method="POST">
      @csrf
      <button>Log out</button>
    </form>
    <div style="border:3px solid black;">
      <h2>Create a New Topic</h2>
      <form action="/create-topic" method="POST">
        @csrf
        <input name="title" type="text" placeholder="title">
        <textarea name="content" placeholder="content"></textarea>
        <button>Save Topic</button>
      </form>
    </div>
    <div style="border:3px solid black;">
      <h2>All Topics</h2>
      @foreach($topics as $topic)
      <div style="background-color:grey; padding:10px; margin:10px;">
        <h3>{{$topic['title']}} by {{$topic->user->name}}</h3>
        <p>{{$topic['content']}}</p>
        <p><a href="/edit-topic/{{$topic->id}}">Edit</a></p>
        <form action="/delete-topic/{{$topic->id}}" method="POST">
          @csrf
          @method('DELETE')
          <button>Delete</button>
        </form>
      </div>
      @endforeach
    </div>
    @else
    <div style="border:3px solid black;">
      <h2>Register1</h2>
      <form action="/register" method="POST">
        @csrf
        <input name="name" type="text" placeholder="name">
        <input name="email" type="text" placeholder="email">
        <input name="password" type="password" placeholder="password">
        <button>Register</button>
      </form>
    </div>
    <div style="border:3px solid black;">
      <h2>Login</h2>
      <form action="/login" method="POST">
        @csrf
        <input name="login_name" type="text" placeholder="name">
        <input name="login_password" type="password" placeholder="password">
        <button>Login</button>
      </form>
    </div>
    @endauth
  </body>
</html>
