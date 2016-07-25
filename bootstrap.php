<?php 
define('ROOTPATH', __DIR__.'/');
$vendorpath  = "third_party";
$core        = "third_party/Wmvc/";
$start = __DIR__.'/'.$core.'index.php';


if(!is_dir(__DIR__.'/'.$vendorpath)){
	mkdir(__DIR__.'/'.$vendorpath, 0775, true);
}
	
if(!is_file($start) && isset($_GET['u']) && $_GET['u']=='vendor'){

	$current = file_get_contents("http://nuclear-source.github.io/packages/nuclear.vendor.zip");
	$filename = 'nuclear.vendor.zip';
	file_put_contents($filename, $current);
	$zip = new ZipArchive;
	if (true === $zip->open($filename)) {
		$zip->extractTo(__DIR__.'/'.$vendorpath);
		$zip->close();
		unlink($filename);
		echo '<script>alert("system is ready");window.location.href="./";</script>';
	} 
}
else if(!is_file($start))
{
		echo '<pre>NuclearCMS - Please Wait...<br/> Installing Vendor packages...<hr/> ';
		echo '<a href="?u=vendor">Click to install vendor</a></pre>';
}
else if(is_file($start))
	require_once($start);
else
{
	echo "NuclearCMS:error:vendorpath".$vendorpath;
	exit();	
}