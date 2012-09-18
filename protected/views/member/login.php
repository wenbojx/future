<!-- <div id="js_content_list" class="feature-show"></div> -->
            <div class="login-box">
                <form method="post" action="<?=$this->createUrl('member/login/checkLogin')?>" id="js_login_form">
                    <ul>
                        <li>
                            <!-- <label for="account">请输入手机/邮箱/帐号</label> -->
                            <input type="text"  tabindex="1" value="" class="text" id="email" name="login[email]">
                        </li>
                        <li>
                            <!-- <label for="passwd">请输入您的密码</label> -->
                            <input type="password"  tabindex="2" class="text"  id="passwd" name="login[passwd]">
                        </li>
                        <li class="s">
                            <button class="btn-login" type="submit"><i>登录</i></button>
                        </li>
                        <li class="status-save">
                            <input type="checkbox" tabindex="4" name="login[time]" id="autologin">
                            <label for="autologin">保持我的登录状态</label>
                        </li>
                        <li>
                            <em><a href="">找回密码？</a></em>
                            <em><a href="">找回帐号？</a></em>
                        </li>
                        <li class="s">
                            <a href="">注册新帐号</a>
                        </li>
                    </ul>
                </form>
            </div>