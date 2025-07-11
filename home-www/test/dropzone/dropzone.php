<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css' />

  </head>

  <body class="m-4">
    <input type="file" name="attach_img" accept=".jpg,.jpeg" multiple value="">
    
    <div class="dropzone">
    </div>

    <script>
      Dropzone.autoDiscover = false;

      const dropzone = new Dropzone(".dropzone", {
        url: "https://dev.webframe.io/test/dropzone_upload.php", // 파일을 업로드할 서버 주소 url. 
        method: "post", // 기본 post로 request 감. put으로도 할수있음
		
	    acceptedFiles: '.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF', // 이미지 파일 포맷만 허용
	    init: function () {
	      this.on('success', function (file, responseText) {
	         console.log('성공');
	      });
	      
	      this.on("complete", function (data) {
	        console.log('complete');
	        console.log(data);
	        console.log(this.getUploadingFiles().length);
	        console.log(this.getQueuedFiles().length);
	      });
	    }
			
      });
    </script>
  </body>

</html>