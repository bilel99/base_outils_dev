<h1>{{Lang::get('mail.newPass')}}</h1>
<hr/>

<h5>
    <h3>{{Lang::get('mail.commentaire_hi')}}</h3>
    <p>
        {{Lang::get('mail.register_descr2')}}
        <?php if(isset($password)){ ?>
        Password : {{$password}}
        <?php } ?>
    </p>
    <hr/>
    <p style="margin-left: 30px;">{{Lang::get('mail.automate')}}</p>
    <hr/>
</h5>
