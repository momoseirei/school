<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello/Index</title>
    <style>
      body {
        font-size: 16pt; color: #999;
      }
      h1 {
        font-size: 120pt; text-align: right; color: #eee;
      }
    </style>
  </head>
  <body>
    <h1>Index</h1>
    <p><?= $msg; ?></p>
    <p><?= date("Y年m月d日"); ?></p>
    <p>ID: <?= $id; ?></p>
  </body>
</html>