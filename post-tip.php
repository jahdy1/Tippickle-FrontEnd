<?php
/*
Template Name: Post a Tip
*/
?>

<?php get_header(); ?>

<?php 

$post_url = get_bloginfo('url') . '/api';

?>



<form action="" method="post">

<input type="text" name="title">

<textarea name="tip">
</textarea>

<input type="submit" value="add tip">

</form>

<?php get_footer(); ?>