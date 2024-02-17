<x-mail::message>
# Hi there , you receive a new message from:

<h3>Name:{{$data['firstName'].' '.$data['lastName']}}</h3>
<h3>email:{{$data['email']}}</h3>
<h3>phone:{{$data['phone']}}</h3>
<h3>message:{{$data['message']}}</h3>



<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
Adnane
</x-mail::message>
