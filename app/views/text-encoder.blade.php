@extends('layouts.master')

@section('PlaceHolderTitle', 'Text Encoder')

@section('PlaceHolderLeadCopy', 'This tool will encode and decode Base64, HTML, and URL text.')

@section('PlaceHolderResultContainer')
@stop

@section('PlaceHolderMainForm')
  {{ Form::open(
    array(
      'url' => URL::current(),
      'method' => 'POST'
    )
  ) }}
    <div class="row">
    
        <div class="col-md-12">
            <p class="instructions"><strong>Instructions:</strong> Set the encoded or decoded text, choose an encoding, and click the "Encode" or "Decode" button below.</p>
        </div>
        
        <div class="col-md-5 form-group">
            {{ Form::label('decodedText', 'Unencoded Text') }}
            {{ Form::textarea('decodedText', Input::get('decodedText'),
                array('class' => 'form-control')
            ) }}
        </div>
        
        <div class="col-md-2 form-group">
            {{ Form::label('encoding', 'Encoding') }}
            {{ Form::select('encoding', 
                array(
                    'base64' => 'Base64',
                    'html' => 'HTML',
                    'url' => 'URL'
                ), 
                Input::get('encoding'),
                array('class' => 'form-control')
            ) }}
            <br />
            <button class="btn btn-block btn-primary btn-lg" onclick="_submit('encode');">
                <span class="text">Encode</span>
                <span class="glyphicon glyphicon-arrow-right"></span>
            </button>
            <br />
            <button class="btn btn-block btn-primary btn-lg" onclick="_submit('decode');">
                <span class="glyphicon glyphicon-arrow-left"></span>
                <span class="text">Decode</span>
            </button>
        </div>
        
        <div class="col-md-5 form-group">
          {{ Form::label('encodedText', 'Encoded Text') }}
          {{ Form::textarea('encodedText', Input::get('encodedText'),
            array('class' => 'form-control')
          ) }}
        </div>
        <div class="col-md-12 form-group">
            <ul class="list-unstyled errors">
              @foreach($errors->all() as $message)
                <li><p class="text-danger">{{ $message }}</p></li>
              @endforeach
            </ul>
        </div>
    </div>
  {{ Form::close() }}
    <script>
        function _submit(action) {
            $('form').attr('action', '/' + $('select[name="encoding"]').val() + '/' + action).submit();
        }
    </script>

@stop
