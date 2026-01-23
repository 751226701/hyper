<?php /*a:1:{s:76:"/www/wwwroot/www.hyperionrobot.com/public/plugins/guestbook/view/widget.html";i:1761754764;}*/ ?>
 <!-- <style>
.lead{font-size:18px;}
.form-control{border-right:0;border-top:0;border-left:0;border-bottom:1px solid #eaeaea;}
.guestbook-btn{border:1px solid #eee;background-color:#00a885;color:#fff;padding:8px 20px;border-radius:3px;}
</style>
<div class="guestbook">
<p class="lead"><?php echo $config['desc']; ?></p>
<div class="alert alert-success" role="alert" id="MessageSent" style="display:none">
    <?php echo $config['messagesent']; ?>
</div>
<form id="guestbook-form" role="form">
<div class="row">
  <div class="form-group col-md-6">
   <label for="name"><?php echo lang('name'); ?></label> 
    <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo lang('name'); ?>*">
  </div>
  <div class="form-group col-md-6">
     <label for="phone"><?php echo lang('phone'); ?></label><span class="require-item">*</span> 
    <input type="text" class="form-control" id="phone" name="phone" placeholder="<?php echo lang('phone'); ?>*">
  </div>
</div>
<div class="form-group">
   <label for="message"><?php echo lang('message'); ?></label> 
  <textarea class="form-control" rows="6" id="message" name="message" placeholder="<?php echo lang('message'); ?>*"></textarea>
</div>
<input type="hidden" id="siteUrl" name="siteUrl" readonly="readonly">
<script>document.getElementById('siteUrl').value=window.location.href;</script>
<button type="submit" id="guestbook-submit" value="<?php echo lang('submit'); ?>" class="guestbook-btn"><?php echo lang('submit'); ?></button>
</form>
</div>-->

<form class="js-ajax-form" action="<?php echo cmf_plugin_url('Guestbook://Index/addMsg'); ?>" method="post">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <input class="form-control" id="name" name="name" placeholder="您的姓名..." type="text">
                <span class="alert-error"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <input class="form-control" id="email" name="email" placeholder="您的邮件..." type="text">
                <span class="alert-error"></span>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <input class="form-control" id="phone" name="phone" placeholder="您的电话(必填)..." type="text">
                <span class="alert-error"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group comments">
                <textarea class="form-control" id="message" name="message" placeholder="详细内容..."></textarea>
            </div>
        </div>
    </div>
    <!--<div class="row">-->
    <!--    <div class="col-lg-12">-->
    <!--        <input class="form-control" id="captcha" name="captcha" type="text" placeholder="验证码" style="float: left; width: 160px;"/>-->
    <!--        <?php $__CAPTCHA_SRC=url('/new_captcha').'?height=38&width=160&font_size=20'; ?>
<img src="<?php echo $__CAPTCHA_SRC; ?>" onclick="this.src='<?php echo $__CAPTCHA_SRC; ?>&time='+Math.random();" title="换一张" class="captcha captcha-img verify_img" style="cursor: pointer;"/>
<input type="hidden" name="_captcha_id" value="">-->
    <!--    </div>-->
    <!--</div>-->
    
    <input type="hidden" id="siteUrl" name="siteUrl" readonly="readonly">
    <script>document.getElementById('siteUrl').value=window.location.href;</script>
    <div class="row">
        <div class="col-lg-12">
            <button type="submit" name="submit" id="submit" class="js-ajax-submit">
                立即提交 <i class="fa fa-paper-plane"></i>
            </button>
        </div>
    </div>
    <!-- Alert Message -->
    <div class="col-lg-12 alert-notification">
        <div id="message" class="alert-msg"></div>
    </div>
</form>

