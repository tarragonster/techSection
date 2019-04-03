@extends('layouts.app')


@section('content')

    {!! Form::open(['action'=>'DictionariesController@search','method'=>'GET']) !!}
    <div class="input-group">
        {{Form::text('q',$q,['class'=>'form-control','placeholder'=>'Search'])}}

        {{Form::select('language', ['E' => 'English', 'K' => 'Korean'],$selectOption,['class'=>'btn btn-outline-secondary dropdown-toggle'])}}

        {{Form::button('search',['class'=>'btn btn-dark','type'=>'submit'])}}

    </div>
    {!! Form::close() !!}
    {{--<hr>--}}
    <div class="heading" style=" margin: 10px">
        <h4 id="display" style="margin-bottom: 0">{{$display}}

            @if($selectOption=='E' && $display!='')
                <input onclick='responsiveVoice.speak("{{$display}}","UK English Male");' type='button' value='🔊'
                       class="btn btn-light"/>
            @elseif($selectOption=='K' && $display!='')
                <input onclick='responsiveVoice.speak("{{$display}}","Korean Female");' type='button' value='🔊'
                       class="btn btn-light"/>
            @endif</h4>

        <span id="style">{{$type}}&nbsp</span> <span id="spelling">{{$spelling}}</span> <br>
        {{--<hr>--}}
    </div>

    @if(count($defs)>0)
        @foreach($defs as $def)
            @if($def !='')
                <div class="list-group-item">
                    <h5 class="theDef{{++$n}}">{{substr($def,0,-1)}}</h5>
                    <div class="dropdown">
                        {{Form::button('save',['class'=>"btn btn-secondary dropdown-toggle btn-sm btn-dropdown",'type'=>'button' , 'data-toggle'=>"dropdown"])}}

                        <ul class="dropdown-menu columnsFilterDropDownMenu">

                            @if(Auth::check())

                                <li class="list{{$n}}">
                                    {{--@if(count($searches)>0)--}}
                                    {{--@foreach($searches as $search)--}}
                                    {{--<div>--}}
                                    {{--{{Form::checkbox('defaultCheck'.$k++, '','',['class'=>'form-check-input','onClick'=>'modalAfterCheck(this.id, this.name)', 'id'=>'defaultCheck'.$k, 'name'=>'#exampleModalCenter'.$n])}}--}}
                                    {{--{{Form::label('defaultCheck'.$k,$search->list,['class'=>'form-check-label'])}}--}}
                                    {{--</div>--}}
                                    {{--@endforeach--}}
                                    {{--@endif--}}
                                </li>

                                {{Form::button('+ Create new list',['class'=>"btn btn-light btn-sm", 'data-toggle'=>'modal', 'data-target'=>'#exampleModalCenter'.$n])}}
                            @else
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @endif
                        </ul>
                    </div>

                    @if(count($example)>0)
                        @if($example[++$t] !='')
                            <h6 class="theExample"
                                style="font-weight: bolder; font-style: italic">{{substr($example[$t],7,-7)}}</h6>
                        @endif
                    @endif
                </div>
            @endif
        @endforeach
    @endif

    <!-- Modal -->
    {!! Form::open(['action'=>'DictionariesController@store', 'method'=>'POST', 'class'=>'ajax-form']) !!}
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="form-group">
                        <strong>
                            {{ Form::label('newList', 'Title:')}}
                        </strong>
                        {{Form::text('newList','',['class'=>'form-control','placeholder'=>'Enter list name'])}}
                    </div>

                    {{Form::button('<span aria-hidden="true">&times;</span>',
                    ['type'=>'button','class'=>'close','data-dismiss'=>'modal','aria-label'=>'Close'])}}

                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        {{ Form::label('lang', 'Language',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('lang',$selectOption,['class'=>'form-control', 'style'=>'width:100px', 'readonly'=>'true'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('word', 'Word',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('word',$display,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('type', 'Type',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('type',$type,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('pronunciation', 'Pronunciation',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('pronunciation',$spelling,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('def', 'Definition',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('def',$defs[0],['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('example', 'Example',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('example',substr($example[0],7,-7),['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::button('Close',['class'=>"btn btn-secondary shutdown",'data-dismiss'=>'modal'])}}
                    {{Form::submit('Save',['class'=>"btn btn-primary ajax-btn"])}}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    <!-- Modal -->
    {!! Form::open(['action'=>'DictionariesController@store', 'method'=>'POST', 'class'=>'ajax-form']) !!}
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="form-group">
                        <strong>
                            {{ Form::label('newList', 'Title:')}}
                        </strong>
                        {{Form::text('newList','',['class'=>'form-control','placeholder'=>'Enter list name'])}}
                    </div>
                    {{Form::button('<span aria-hidden="true">&times;</span>',
                    ['type'=>'button','class'=>'close','data-dismiss'=>'modal','aria-label'=>'Close'])}}
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        {{ Form::label('lang', 'Language',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('lang',$selectOption,['class'=>'form-control', 'style'=>'width:100px', 'readonly'=>'true'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('word', 'Word',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('word',$display,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('type', 'Type',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('type',$type,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('pronunciation', 'Pronunciation',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('pronunciation',$spelling,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('def', 'Definition', ['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('def',$defs[1],['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('example', 'Example',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('example',substr($example[1],7,-7),['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::button('Close',['class'=>"btn btn-secondary shutdown",'data-dismiss'=>'modal'])}}
                    {{Form::submit('Save',['class'=>"btn btn-primary ajax-btn"])}}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    <!-- Modal -->
    {!! Form::open(['action'=>'DictionariesController@store', 'method'=>'POST', 'class'=>'ajax-form']) !!}
    <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="form-group">
                        <strong>
                            {{ Form::label('newList', 'Title:')}}
                        </strong>
                        {{Form::text('newList','',['class'=>'form-control','placeholder'=>'Enter list name'])}}
                    </div>
                    {{Form::button('<span aria-hidden="true">&times;</span>',
                    ['type'=>'button','class'=>'close','data-dismiss'=>'modal','aria-label'=>'Close'])}}
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        {{ Form::label('lang', 'Language',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('lang',$selectOption,['class'=>'form-control', 'style'=>'width:100px', 'readonly'=>'true'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('word', 'Word',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('word',$display,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('type', 'Type',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('type',$type,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('pronunciation', 'Pronunciation',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('pronunciation',$spelling,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('def', 'Definition', ['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('def',$defs[2],['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('example', 'Example',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('example',substr($example[2],7,-7),['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::button('Close',['class'=>"btn btn-secondary shutdown",'data-dismiss'=>'modal'])}}
                    {{Form::submit('Save',['class'=>"btn btn-primary ajax-btn"])}}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    <!-- Modal -->
    {!! Form::open(['action'=>'DictionariesController@store', 'method'=>'POST', 'class'=>'ajax-form']) !!}
    <div class="modal fade" id="exampleModalCenter4" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="form-group">
                        <strong>
                            {{ Form::label('newList', 'Title:')}}
                        </strong>
                        {{Form::text('newList','',['class'=>'form-control','placeholder'=>'Enter list name'])}}
                    </div>
                    {{Form::button('<span aria-hidden="true">&times;</span>',
                    ['type'=>'button','class'=>'close','data-dismiss'=>'modal','aria-label'=>'Close'])}}
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        {{ Form::label('lang', 'Language',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('lang',$selectOption,['class'=>'form-control', 'style'=>'width:100px', 'readonly'=>'true'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('word', 'Word',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('word',$display,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('type', 'Type',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('type',$type,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('pronunciation', 'Pronunciation',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('pronunciation',$spelling,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('def', 'Definition', ['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('def',$defs[3],['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('example', 'Example',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('example',substr($example[3],7,-7),['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::button('Close',['class'=>"btn btn-secondary shutdown",'data-dismiss'=>'modal'])}}
                    {{Form::submit('Save',['class'=>"btn btn-primary ajax-btn"])}}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    <!-- Modal -->
    {!! Form::open(['action'=>'DictionariesController@store', 'method'=>'POST', 'class'=>'ajax-form']) !!}
    <div class="modal fade" id="exampleModalCenter5" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="form-group">
                        <strong>
                            {{ Form::label('newList', 'Title:')}}
                        </strong>
                        {{Form::text('newList','',['class'=>'form-control','placeholder'=>'Enter list name'])}}
                    </div>
                    {{Form::button('<span aria-hidden="true">&times;</span>',
                    ['type'=>'button','class'=>'close','data-dismiss'=>'modal','aria-label'=>'Close'])}}
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        {{ Form::label('lang', 'Language',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('lang',$selectOption,['class'=>'form-control', 'style'=>'width:100px', 'readonly'=>'true'])}}
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('word', 'Word',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('word',$display,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('type', 'Type',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('type',$type,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('pronunciation', 'Pronunciation',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::text('pronunciation',$spelling,['class'=>'form-control', 'style'=>'width:100px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('def', 'Definition', ['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('def',$defs[4],['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('example', 'Example',['class'=>"col-sm-2 col-form-label"])}}
                        <div class="col-sm-10" style="padding-left: 30px; width: 200px">
                            {{Form::textarea('example',substr($example[4],7,-7),['class'=>'form-control', 'style'=>'height:60px'])}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{Form::button('Close',['class'=>"btn btn-secondary shutdown",'data-dismiss'=>'modal'])}}
                    {{Form::submit('Save',['class'=>"btn btn-primary ajax-btn"])}}
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.ajax-form').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var post = $(this).attr('method');

            $.ajax({
                type: post,
                url: url,
                data: data,
                dataTy: 'json',
                success: function (data) {
                    console.log(data);
                    $('.fade').modal('hide')
                }

            });
        });

        var n = 0;
        $('.btn-dropdown').on('click', function () {
            // console.log('123123123');
            // var dev = $( this ).parent().text();

            // console.log(dev);
            $.get("{{'/search/dropdown'}}", function (data) {
                console.log(data[0]);
                console.log(data[1]);

                for (var t = 1; t < 6; t++) {

                    $('.list' + t).empty();

                    $.each(data[0], function (i, p) {
                        n++;
                        $('.list' + t).append($('<input id="theList' + n + '" type="checkbox">'))
                            .append($('<label for="theList' + n + '"></label>').val(p.list).html(p.list))
                            .append($("<br>"));

                    });

                    $('.list' + t).click(function (event) {
                        event.stopPropagation();

                    });

                    $.each(data[1],function (i,p) {
                        var count = $('.list' + t).find("label").length;

                        //     console.log(p.definition);
                        // console.log($('.theDef' + t).text());
                        if(p.definition == $('.theDef' + t).text()){
                            for(var s = 0; s< count;s++){
                                // console.log(p.list);
                                // console.log($('.list' + t).find($("label")[s]).val());
                                // console.log(p.list === $('.list' + t).find($("label")[s]).val());

                                if(p.list === $('.list' + t).find($("label")[s]).val()){
                                    $('.list' + t).find($("input")[s+3]).prop('checked', true)
                                }
                            }
                        }
                    })
                }

                // $.each(data[1], function (i, p) {
                //
                //     for ( n; n < 12; n++) {
                //         if (p.definition === $('theDef' + n).text()) {
                //             for(n; n<12;n++){
                //                 if(p.list === $('label[for="theList'+ n +'"]').val()){
                //                     $('theList' + n).checked()
                //                 }
                //             }
                //         }
                //     }
                // })
            });
        });


        // $('.list').click(function(event){
        //     event.stopPropagation();
        //
        // });

        function modalAfterCheck(theId, theTarget) {

            if ($('#' + theId).is(":checked")) {
                $(theTarget).modal('show');

            } else {
                $(theTarget).modal('hide');
            }
        }

    </script>

@endsection


