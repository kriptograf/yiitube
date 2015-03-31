<div class="form-login">
    <?php if(Yii::app()->user->isGuest):?>
    <form action="/login" method="post">
        <?php echo CHtml::activeTextField($model, 'username', array('class'=>"input-text"));?>
        <br>
        <?php echo CHtml::activeTextField($model, 'password', array('class'=>"input-text"));?>
        <br>
        <input type="submit" value="Войти" class="btn-login">
        <br>
        <a href="/registration" class="registration">Регистрация</a>       
    </form>
    <div class="social-login">
        <p>Вход через социальные сети</p>
        <?php 
                $this->widget('application.components.UloginWidget', array(
                    'params'=>array(
                        'display'=>'small',
                        'redirect'=>'http://'.$_SERVER['HTTP_HOST'].'/ulogin/login' //Адрес, на который ulogin будет редиректить браузер клиента. Он должен соответствовать контроллеру ulogin и действию login
                    )
                )); 
        ?>
    </div>
    <?php else:?>
        <?php
            $anchor = 'Выйти ('.Yii::app()->user->fullname.')';
            echo CHtml::link($anchor, array('/logout'));
        ?>
    <?php endif;?>
</div>
