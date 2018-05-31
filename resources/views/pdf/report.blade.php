<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>title</title>
  </head>
  <body>       
        <div style="margin-top: 20px;">
            <img style="width: 400px; height: 200px" src="storage/cover_images/{{$post->cover_image}}">
            <h1>{{$post->title}}</h1>
            <p>{!!$post->body!!}</p>
        </div>
  </body>
</html>