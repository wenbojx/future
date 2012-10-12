<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>content</title>
</head>
<body>
<form action="/project/uploadPano/" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="Filedata" id="file" />
<input type="hidden" name="scene_id" value="2">
<input type="hidden" name="position" value="left">
<input type="hidden" name="from" value="box_pic">

<br />
<input type="submit" name="submit" value="Submit" />
</form>

<form action="http://www.dev.yiluhao.com/pano/upload" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="Filedata" id="file" />
<input type="hidden" name="scene_id" value="1">
<input type="hidden" name="from" value="thumb_pic">

<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>