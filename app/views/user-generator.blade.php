@extends('layouts.master')

@section('PlaceHolderTitle', 'Random User Generator')

@section('PlaceHolderLeadCopy', 'This tool will generate random user profiles or individual user profile properties.')

@section('PlaceHolderResult')
    <div class="container"> 
      @foreach ($profiles as $profile)
        <div class="row profile">       
          @if (isset($profile['photo']))
            <div class="col-md-2">
                <img class="img-circle img-responsive photo" src="" border="0"/>
            </div>
          @endif
            <div class="col-md-10">
              @if (isset($profile['name']))
                <h2 class="name">{{ $profile['name'] }}</h2>
              @endif
                <p>                     
                  @if (isset($profile['email']))
                    <span class="email">{{ $profile['email'] }}</span>
                  @endif
                  @if (isset($profile['phone']))
                    <span class="phone">{{ $profile['phone'] }}</span>
                  @endif
                </p>              
            </div>
        </div>
      @endforeach
    </div>
@stop

@section('PlaceHolderMainForm')
    {{ Form::open(
        array(
            'url' => URL::current(),
            'method' => 'POST'
        )
    ) }}
        <p class="instructions"><strong>Instructions:</strong> Set the number of users, select the property (or properties), and click the "Regenerate" button below.</p>
        
        <div class="form-group">
            <span>Limit to </span>
            {{ Form::number('userQty', Input::get('userQty'),
                array(
                    'min' => $userQtyMin,
                    'max' => $userQtyMax
                )
            ) }}
            <span>user</span>
            {{ Form::select('userProperty', $userPropertyOptions, Input::get('userProperty') ) }}
        </div>
    
        <div class="form-group">
            <ul class="list-unstyled errors">
              @foreach($errors->all() as $message)
                <li><p class="text-danger">{{ $message }}</p></li>
              @endforeach
            </ul>
        </div>  
    
        <div class="form-group">
            {{ Form::submit('Regenerate',
                array(
                    'class' => 'btn btn-primary btn-lg'
                )
            ) }}
        </div>
    
    {{ Form::close() }}
    
    <script>
        $(document).ready(function() {
            $('form').submit(function() {
                var userQty = $('input[name="userQty"]').val();
                var userProperty = $('select[name="userProperty"]').val();
                $(this).attr('action', '/generate/' + userQty + '/user/' + userProperty);
            });

            $('input[name="userQty"]').keyup(function() {
                fixGrammar('select[name="userProperty"] option', $(this).val());
            });
            fixGrammar('select[name="userProperty"] option', $('input[name="userQty"]').val());
            
            $('.profile .photo').each(function() {
                var img = $(this);
                $.ajax({
                    url: 'http://api.randomuser.me/',
                    dataType: 'json',
                    success: function(data){
                        img.attr('src', data.results[0].user.picture.medium);
                    }
                });
            });
        });
    </script>

@stop
