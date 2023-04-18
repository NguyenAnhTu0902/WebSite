<div style="width: 600px; margin: 0 auto;">
    <div style="text-align: center;">
        <h2>Hello {{$user->name}}</h2>
        <p>You have successfully registered in our website</p>
        <p>To continue using the services, please click the activate button below to activate your account</p>
        <a href="{{url('account/actived',['id'=>$user->id, 'token'=>$user->token])}}" style="display: inline-block; background: green; color: #fff; padding: 7px 25px; font-weight: bold;">Active</a>
    </div>

</div>
