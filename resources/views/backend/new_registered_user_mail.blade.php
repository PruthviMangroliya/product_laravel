<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New User Is Registered to Admin Panel</title>
   
</head>

<body>
    <div class="container">

        <div class="message">
            <p>Hello Super Admin,</p>
           <p>We have a new User that registered to Admin panel</p>
           <p>New User Name Is :: <b>{{$mailData['name']}}</b></p>
           <p>New User Email Is :: <b>{{$mailData['email']}}</b></p>
           <P>To let that user access user You will ned to provide a Role to that user</P>
          <a href="http://127.0.0.1:8000/users"> <b> Click here </b></a> to assign a role to user
        </div>

        

    </div>
</body>

</html>
