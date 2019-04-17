




<center>
<p>Post ID: <?php echo $post->id; ?></p>
<h1><p> <?php echo $post->title; ?></p> </h1>
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

</center>

<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-6">
        <form class="form-horizontal" action='' method="POST">
            <div class="form-group">
                <label class="col-lg-3 control-label">Add Comment</label>
                <div class="col-lg-9">
                    <textarea class="form-control" rows="5" cols="10" name="content" placeholder="Comment here"></textarea>
                </div>
            </div>
            <input type="submit" name="postcomment" value="comment" class="btn btn-primary">
        </form>
    </div>
</div>
