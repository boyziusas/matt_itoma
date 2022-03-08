<h1>Hello, {{$company->name}} </h1>
<p>Your info:</p>
<p>{{$company->email}}</p>
<p>{{$company->website}}</p>
<p>Your logo</p>
<img src="{{$message->embed(Storage::disk('public')->path($company->logo))}}" alt="company_logo">
