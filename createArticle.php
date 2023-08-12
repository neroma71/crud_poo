<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="create.php" enctype="multipart/form-data">
        <p>
            <input type="text" name="title">
        </p>
        <p>
            <input type="text" name="intro">
        </p>
        <p>
            <textarea name="content"></textarea>
        </p>
        <p>
        <input type="file" name="image[]" multiple>
        </p>
        <p>
        <input type="submit" value="envoyer">
        </p>
    </form>
</body>
</html>