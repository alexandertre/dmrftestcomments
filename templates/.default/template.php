<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?php
extract( $arResult );
?>
<div class="comments"><h3>Комментарии:</h3><br>
<div><h5>Оставить комментарий:</h5>
<form name="sendcomment" action="<?=$_SERVER["REQUEST_URI"]?>" method="POST">
<label>Ваше имя</label><br>
<input type="text" name="usrname"><br>
<label>Текст комментария</label><br>
<textarea name="commenttext"></textarea><br>
<input type="submit" title="Отправить">
</form>
</div><hr>
<?php
 foreach($infoList as $commentelem){ ?>
<div class="commentel"><h4><?php echo $commentelem['commentname']; ?></h4>
<div><?php echo $commentelem['commenttext']; ?></div><hr>
</div>
<?php } ?>
</div>
