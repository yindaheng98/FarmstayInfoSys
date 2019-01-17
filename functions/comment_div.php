<?php
function comment_div($comment)
{
    ?>
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <blockquote>
                <p><?php
                    if ($comment['打分'] > 64)
                        echo "好评";
                    elseif ($comment['打分'] > -64)
                        echo "中评";
                    else
                        echo "差评" ?></p>
                <p><?php echo $comment['内容'] ?></p>
                <footer><?php echo $comment['用户'] . ' 评论于 ' . $comment['时间'] ?></footer>
            </blockquote>
        </div>
        <?php
        if ($comment['图片'] != 'null')
        {
            ?>
            <img src="<?php echo $comment['图片'] ?>" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <?php
        } ?>
    </div>
    <?php
} ?>