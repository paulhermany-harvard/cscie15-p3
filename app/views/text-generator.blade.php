@extends('layouts.master')

@section('PlaceHolderTitle', 'Lorem Ipsum Text Generator')

@section('PlaceHolderLeadCopy', 'This tool will generate random lorem ipsum text. Visit <a href="http://www.lipsum.com/">http://www.lipsum.com/</a> for more information about lorem ipsum text including its history and how it\'s used.')

@section('PlaceHolderResult', isset($result) ? $result : '')

@section('PlaceHolderMainForm')
    {{ Form::open(
        array(
            'url' => URL::current(),
            'method' => 'POST'
        )
    ) }}
        
        <p class="instructions"><strong>Instructions:</strong> Set the number of paragraphs, sentences or words, and click the "Regenerate" button below.</p>
        
        <div class="form-group">
            <span>Limit to </span>
            {{ Form::number('textQty', Input::get('textQty'),
                array(
                    'min' => $textQtyMin,
                    'max' => $textQtyMax
                )
            ) }}
            {{ Form::select('textType', $textTypeOptions, Input::get('textType')) }}
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
                var textQty = $('input[name="textQty"]').val();
                var textType = $('select[name="textType"]').val();
                $(this).attr('action', '/generate/' + textQty + '/lorem-ipsum/' + textType);
            });
            
            $('input[name="textQty"]').keyup(function() {
                fixGrammar('select[name="textType"] option', $(this).val());
            });
            fixGrammar('select[name="textType"] option', $('input[name="textQty"]').val());
            
            $('select[name="textType"]').change(function() {
                var textType = $(this).val();
                var max;
                switch(textType) {
                    case 'paragraphs': max = 10; break;
                    case 'sentences': max = 100; break;
                    case 'words': max = 1000; break;
                }
                $('input[name="textQty"]').attr('max', max);
            });
        });
    </script>
@stop