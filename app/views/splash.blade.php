@extends('layouts.master')

@section('PlaceHolderLeadCopy', 'hello world')

@section('PlaceHolderMain')
<div class="container">
    <h3>Lorem Ipsum Text Generator</h3>
    <p>This tool will generate random lorem ipsum text. Visit <a href="http://www.lipsum.com/">http://www.lipsum.com/</a> for more information about lorem ipsum text including its history and how it's used.</p>
    <p><strong>RESTful URL Examples:</strong></p>
    <ul>
        <li><a href="/generate/lorem-ipsum">/generate/lorem-ipsum</a></li>
        <li><a href="/generate/5/lorem-ipsum/paragraphs">/generate/5/lorem-ipsum/paragraphs</a></li>
        <li><a href="/generate/5/lorem-ipsum/sentences">/generate/5/lorem-ipsum/sentences</a></li>
        <li><a href="/generate/5/lorem-ipsum/words">/generate/5/lorem-ipsum/words</a></li>
    </ul>
    <hr />
    <h3>Random User Generator</h3>
    <p>This tool will generate random user profiles or individual user profile properties.</p>
    <p><strong>RESTful URL Examples:</strong></p>
    <ul>
        <li><a href="/generate/users">/generate/users</a></li>
        <li><a href="/generate/5/user/profiles">/generate/5/user/profiles</a></li>
        <li><a href="/generate/5/user/names">/generate/5/user/names</a></li>
        <li><a href="/generate/5/user/email-addresses">/generate/5/user/email-addresses</a></li>
        <li><a href="/generate/5/user/phone-numbers">/generate/5/user/phone-numbers</a></li>
        <li><a href="/generate/5/user/photos">/generate/5/user/photos</a></li>
    </ul>
</div>
@stop
