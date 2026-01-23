<?php /*a:1:{s:76:"/www/wwwroot/www.hyperionrobot.com/public/plugins/d_comment/view/widget.html";i:1768643827;}*/ ?>


<?php switch($comment_type): case "1": ?>

<!-- Start Blog Comment 评论模块-->


<style type="text/css" media="all">
    .time{
        border-left: 1px solid #e7e7e7;
    padding-left: 15px;
    margin-left: 15px;
    }
    .comment-area .avatar{
        width:80px;
        height: 80px;
    }
    .pull-right a{
        border: 1px solid #e7e7e7;
    color: #002359;
    display: inline-block;
    font-size: 14px;
    margin-top: 5px;
    padding: 1px 10px;
    text-transform: uppercase;
    font-weight: normal;
    }
    .comment-form button{
        background: #ff1949;
    border: 1px solid transparent;
    color: #fff;
    display: inline-block;
    font-size: 14px;
    font-weight: 700;
    line-height: 25px;
    margin-top: 20px;
    padding: 15px 45px;
    text-transform: uppercase;
    transition: all .35s ease-in-out;
    -webkit-transition: all .35s ease-in-out;
    -moz-transition: all .35s ease-in-out;
    -ms-transition: all .35s ease-in-out;
    -o-transition: all .35s ease-in-out;
    border-radius: 30px;
    }
    .title a{
        font-size: 16px;
    font-weight: 600;
    text-transform: capitalize;
    margin-bottom: 0;
    }
    .comment{
        
    }
    .comment .pull-left{width:15%;min-width:105px;float:left;}
    /*.comment .title{width:85%;float:left;}*/
    /*.comment .comment-body{width:85%;float:left;}*/

</style>






        <div style="">
            <br>
            <h3>评论<span class="badge"><?php echo $total; ?> Comments</span></h3>
            <div class="comment-area" id="comments" style="">
                
                <form class="comment-form" action="<?php echo cmf_plugin_url('DComment://Index/add'); ?>" method="post" style="">
                    <div class="form-group" style="">
                        <div class="comment-postbox-wraper" style="">
                            <textarea name="content" required class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn js-ajax-submit" id="plugin-comment-comment-box-submit-btn">发表评论</button>
                    </div>
                    <input type="hidden" name="object_title" value="<?php echo $object_title; ?>">
                    <input type="hidden" name="table_name" value="<?php echo $table_name; ?>">
                    <input type="hidden" name="object_id" value="<?php echo $object_id; ?>">
                    <input type="hidden" name="url" value='<?php echo $url; ?>'>
                    <input type="hidden" name="to_user_id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="parent_id" value="0">
                    <div class="clearfix"></div>
                </form>
                <br />
                <script class="comment-reply-box-tpl" type="text/html">
                	<div class="clearfix"></div>
                    <div class="comment-reply-submit"><br>
                        <div class="comment-reply-box">
                            <input type="text" class="textbox form-control" placeholder="回复">
                        </div>
                        <button class="btn pull-right" onclick="commentSubmit(this);" style="margin-top: 5px;font-weight: normal;font-size:12px;"><i class="fa fa-comments"></i>&nbsp;回复</button>
                    </div>
                </script>
                <div class="comments">
                    <?php if(is_array($comments) || $comments instanceof \think\Collection || $comments instanceof \think\Paginator): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                        <hr style="margin: 15px 0;">
                        <div id="comment<?php echo $v['id']; ?>" class="comment" data-id="<?php echo $v['id']; ?>" data-user_id="<?php echo $v['user_id']; ?>" data-touser_id="<?php echo $v['to_user_id']; ?>" data-username="<?php echo $v['username']; ?>" >
                         
                            <a class="pull-left" href="<?php echo cmf_url('user/index/index',array('id'=>$v['user_id'])); ?>" >
                    	        <img class="media-object avatar" src="<?php echo cmf_url('user/public/avatar',array('id'=>$v['id'])); ?>">
                    	    </a>
                    	    <div>
                    	         <div class="title">
                                    <a href="<?php echo cmf_url('user/index/index',array('id'=>$v['user_id'])); ?>"><?php echo (isset($v['username']) && ($v['username'] !== '')?$v['username']:'新用户'); ?></a>
                                    <span class="time"><?php echo date('Y-m-d H:i',$v['create_time']); ?></span>
                                </div>
                                <div class="comment-body">
                                    <div class="comment-content">
                                        <?php if($v['parent_id'] > '0'): ?><span class="huifu">@</span><a href="<?php echo cmf_url('user/index/index',array('id'=>$v['to_user_id'])); ?>"><?php echo $v['to_username']; ?></a>&nbsp;<?php endif; ?><?php echo htmlspecialchars_decode($v['content']); ?>
                                    </div>
                                    <div class="pull-right">
                                        <a onclick="commentReply(this);" href="javascript:;"><i class="fa fa-reply"></i>&nbsp;回复</a>
                                        <!--<a href="<?php echo cmf_url('user/index/index',array('id'=>$v['user_id'])); ?>"><i class="fa fa-rmb"></i>打赏TA</a>-->
                                    </div>
                                </div>
                    	    </div>
                           
                            <div class="clearfix"></div>
                        </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <ul class="pagination"><?php echo $page; ?></ul>
                </div><br />
                <div id="container">
                    
                </div>
            </div>
            
            
            <script type="text/javascript" charset="utf-8">
                //.comment-content{}
                //$('.huifu').parents('.comment').css('padding-left','100px');
                

     
                
                
                
                
            </script>
            <!-- Start Blog Comment 
            <div class="blog-comments">
                <div class="comments-area">
                    <div class="comments-title">
                        <div class="comments-list">
                            <div class="commen-item">
                                <div class="avatar">
                                    <img src="__TMPL__/public/assets/img/common/square.png" alt="Author">
                                </div>
                                <div class="content">
                                    <div class="title">
                                        <h5>卖火柴的小子</h5>
                                        <span>2019-06-24</span>
                                    </div>
                                    <p>
                                        这模板可以呀，支持cmf6.0不？怎么买？ 
                                    </p>
                                    <div class="comments-info">
                                        <a href=""><i class="fa fa-reply"></i>回复</a>
                                    </div>
                                </div>
                            </div>
                            <div class="commen-item reply">
                                <div class="avatar">
                                    <img src="__TMPL__/public/assets/img/common/square.png" alt="Author">
                                </div>
                                <div class="content">
                                    <div class="title">
                                        <h5>洋洋</h5>
                                        <span>2020-10-02</span>
                                    </div>
                                    <p>
                                        支持的！可以直接联系我购买！18220523738 
                                    </p>
                                    <div class="comments-info">
                                        <a href=""><i class="fa fa-reply"></i>回复</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            -->
            
            
            <script>
            Wind.use('ajaxForm', 'cookie', function() {

                var $comment_form = $(".comment-form");
                var intervel = "<?php echo (isset($comment_interval) && ($comment_interval !== '')?$comment_interval:'5'); ?>";


                $(".js-ajax-submit", $comment_form).on("click", function(e) {
                    var btn = $(this),
                        form = btn.parents(".comment-form");
                    var d = Date.parse(new Date()) / 1000;

                    if ($.cookie('com') && (d - $.cookie('com')) < intervel) {
                        $('<span class="tips_success alert-danger">请' + intervel + '秒后再评论</span>').appendTo(btn.parent()).fadeIn('slow').delay(1000).fadeOut(function() {})
                        return false;
                    }
                    e.preventDefault();

                    var url = btn.data('action') ? btn.data('action') : form.attr('action');
                    $.ajax({
                        url: url,
                        dataType: 'json',
                        type: "POST",
                        beforeSend: function() {
                            var text = btn.text();

                            //按钮文案、状态修改
                            btn.text(text + '中...').prop('disabled', true).addClass('disabled');
                        },
                        data: form.serialize(),
                        success: function(data, textStatus, jqXHR) {
                            var text = btn.text();

                            //按钮文案、状态修改
                            btn.removeClass('disabled').text(text.replace('中...', '')).parent().find('span').remove();
                            btn.removeProp('disabled').removeClass('disabled');
                            if (data.code == 1) {
                                $('<span class="tips_success alert-danger">' + data.msg + '</span>').appendTo(btn.parent()).fadeIn('slow').delay(1000).fadeOut(function() {});
                                $.cookie('com', Date.parse(new Date()) / 1000);
                                form.find("[name='content']").val('');
                                window.location.reload();
                            } else if (data.code == 0) {
                                $('<span class="tips_error alert-danger">' + data.msg + '</span>').appendTo(btn.parent()).fadeIn('fast');
                                btn.removeProp('disabled').removeClass('disabled');
                            }

                            // if (data.code == 1) {
                            //     var $comments = form.siblings(".comments");
                            //     var comment_tpl = btn.parents(".comment-area").find(".comment-tpl").html();
                            //     var $comment_tpl = $(comment_tpl);
                            //     $comment_tpl.attr("data-id", data.data.id);
                            //     var $comment_postbox = form.find("[name='content']");
                            //     var comment_content = $comment_postbox.val();
                            //     $comment_tpl.find(".comment-content .content").html(comment_content);

                            //     if (hljs) {
                            //         $('pre', $comment_tpl).each(function(i, block) {
                            //             hljs.highlightBlock(block);
                            //         });
                            //     }

                            //     $comments.prepend($comment_tpl);
                            // }

                        },
                        error: function(data) {
                            var text = btn.text();
                            btn.removeProp('disabled').removeClass('disabled').text(text.replace('中...', '')).parent().find('span').remove();
                            $('<span class="tips_error alert-danger">' + data.msg + '</span>').appendTo(btn.parent()).fadeIn('fast');
                        }

                    });

                    return false;

                });
            });


            function commentReply(obj) {

                $(".comments .comment-reply-submit").hide();
                var $this = $(obj);
                var $comment_body = $this.parents(".comments > .comment> .comment-body");
                var $comment = $this.parents(".comment");
                var commentid = $comment.data("id");
                var username = $comment.data("username");

                var $commentReplySubmit = $comment_body.find(".comment-reply-submit");

                if ($commentReplySubmit.length) {
                    $commentReplySubmit.show();
                } else {
                    var comment_reply_box_tpl = $comment_body.parents(".comment-area").find(".comment-reply-box-tpl").html();
                    $commentReplySubmit = $(comment_reply_box_tpl);
                    $comment_body.append($commentReplySubmit);
                }

                var $replyTextbox = $commentReplySubmit.find(".textbox");
                $replyTextbox.attr('placeholder', '@' + username);
                $replyTextbox.focus();
                $commentReplySubmit.data("replyid", commentid);
            }

            function commentSubmit(obj) {

                Wind.use('noty', function() {

                    var $this = $(obj);

                    var $commentReplySubmit = $this.parents(".comment-reply-submit");

                    var $replyTextbox = $commentReplySubmit.find(".textbox");
                    var reply_content = $replyTextbox.val();

                    if (reply_content == '') {
                        $replyTextbox.focus();
                        return;
                    }

                    var $comment_body = $this.parents(".comments > .comment> .comment-body");

                    var comment_tpl = $comment_body.parents(".comment-area").find(".comment-tpl").html();

                    var $comment_tpl = $(comment_tpl);

                    var replyid = $commentReplySubmit.data('replyid');

                    var $comment = $(".comments [data-id='" + replyid + "']");

                    var username = $comment.data("username");

                    var comment_content = "@" + username + ":" + reply_content;
                    $comment_tpl.find(".comment-content .content").html(comment_content);
                    $('.comment-area .comments').prepend($comment_tpl);

                    var $comment_form = $this.parents(".comment-area").find(".comment-form");

                    var comment_url = $comment_form.attr("action");

                    var table_name = $comment_form.find("[name='table_name']").val();
                    var object_title = $comment_form.find("[name='object_title']").val();
                    var object_id = $comment_form.find("[name='object_id']").val();
                    var object_url = $comment_form.find("[name='url']").val();

                    var user_id = $comment.data("user_id");

                    $.post(comment_url, {
                        object_title: object_title,
                        table_name: table_name,
                        object_id: object_id,
                        to_user_id: user_id,
                        parent_id: replyid,
                        content: reply_content,
                        url: object_url
                    }, function(data) {
                        if (data.code == 0) {
                            noty({
                                text: '回复失败！',
                                type: 'error',
                                layout: 'center'
                            });
                            $comment_tpl.remove();
                        }

                        if (data.code == 1) {
                        	noty({
                                text: '回复成功！',
                                type: 'success',
                                layout: 'center'
                            });
                            $comment_tpl.attr("data-id", data.data.id);
                            $replyTextbox.val('');
                        }

                    }, 'json');

                    $commentReplySubmit.hide();
                });

            }
            </script>
        </div>
    <?php break; case "2": ?>
        <div style="border: 1px dashed #ddd;padding-top: 20px;">
            <div class="alert alert-danger" role="alert">
                评论已关闭！
            </div>
        </div>
    <?php break; ?>
<?php endswitch; ?>
