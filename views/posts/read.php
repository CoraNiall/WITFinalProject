<p>This is the requested post:</p>

<p>Post ID: <?php echo $post->id; ?></p>
<p>Title: <?php echo $post->title; ?></p>
<p>Content: <?php echo $post->content; ?></p>
<?php 
$file = 'views/images/' . $post->title . '.jpeg';
if(file_exists($file)){
    $img = "<img src='$file' width='150' />";
    echo $img;
}
else
{
echo "<img src='views/images/standard/_noproductimage.png' width='150' />";
}

?>
	
