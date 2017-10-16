<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('bootstrap/css/bootstrap-theme.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('media/css/styles.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('media/css/loader.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('media/css/jquery-ui-1.10.4.custom.css') }}">

        <script type="text/javascript" src="{{ URL::asset('media/js/jquery/jquery-1.11.1.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('bootstrap/js/bootstrap.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('bootstrap/js/typeahead.bundle.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/jquery/jquery.validate.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/jquery/jquery.validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/jquery/additional-validate.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/globalfunctions.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/jquery.autosize.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/jquery.autosize.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/jquery-ui-1.10.4.custom.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/jquery.ui.datepicker-es.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/bootbox.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/bootstrap-filestyle.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('media/js/jquery/jquery.timepicker.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('media/js/jquery/jquery.timepicker.css') }}">


        <script type="text/javascript">
        $(function () {

                //add picker to date field
               $('#date').datepicker({
                    dateFormat: "yy-mm-dd",
                    maxDate: new Date(),
                    changeMonth: true,
                    changeYear: true,
                    yearRange: '1914:date("Y")',
                    onSelect: function (dateText, inst) {
                        $('#date').valid();
                    },
                   
                });

                //add timepicker to time field 
               $('#time').timepicker({
                   timeFormat: 'H:i',
                    minTime: '0:00',
                    maxTime: '23:59',
                    step:1
                });

               //add validations to the form
               $('#picoPlacaFrm').validate({
                    ignore: [],
                    rules: {
                        plate: {
                            required: true,
                            plate:true
                        },
                        date: {
                            required: true
                        },
                         time: {
                           required: true,
                           time:true
                        }       
                    },
                    messages: {
                        plate: {
                            required: 'Plate required',
                            plate:'Invalid plate format'

                        },
                        date: {
                            required: 'Date required'

                        },
                        time: {
                            required: 'Time required',
                            time:'Invalid time'
                        }
                    },
                    highlight: function (element) {
                        $(element).closest('.form-group').addClass('has-error').removeClass('has-success');
                    },
                    unhighlight: function (element) {
                        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                    },
                    errorElement: 'span',
                    errorClass: 'help-block',
                    errorPlacement: function (error, element) {
                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    invalidHandler: function (form, validator) {
                        var errors = validator.numberOfInvalids();

                        if (!validator.numberOfInvalids())
                            return;

                        $('html, body').animate({
                            scrollTop: $(validator.errorList[0].element).offset().top
                        }, 1000);
                        $('#responseDiv').html("");
                    },
                    submitHandler: function (form) {
                        predictPicoPlaca();
                    }
                });


            //Get Pico y Placa prediction
            function predictPicoPlaca() {
                $.ajax({
                    type: 'POST',
                    async: false,
                    url: '/picoplacapredictor',
                    data: {
                        _token: '{{ Session::token() }}',
                        plate:$("#plate").val(),
                        date: $("#date").val(),
                        time:$("#time").val()
                    },
                    success: function (data) {
                        if (data) {
                            $('#responseDiv').html(data);
                        }
                    }
                });
            }

        });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="text-center col-md-12 h3 ">
                    "Pico y Placa" predictor
                     <br> <br>
                </div>
              {!! Form::model('picoplacapredictor/index', array('id'=>'picoPlacaFrm', 'class'=>'form-horizontal',"method"=>"post")) !!}

                    <div class="row form-group">
                        <div class="col-md-offset-2 col-md-4 text-left">
                            {!! Form::label('*Plate:', null, array('class' => 'control-label'))!!}
                        </div>
                        <div class="col-md-4">
                             {!! Form::text('plate', null,  array('id'=>'plate','class' => 'form-control','maxlength'=>'8')) !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                         <div class="col-md-offset-2 col-md-4 text-left">
                            {!! Form::label('*Date:', null, array('class' => 'control-label'))!!}
                        </div>
                         <div class="col-md-4">
                             {!! Form::text('date', null,  array('id'=>'date','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                         <div class="col-md-offset-2 col-md-4 text-left">
                            {!! Form::label('*Time:', null, array('class' => 'control-label'))!!}
                        </div>
                        <div class="col-md-4">
                             {!! Form::text('time', null,  array('id'=>'time','class' => 'form-control')) !!}
                        </div>
                    </div>
            

                     <div class="text-center row">
                        <br>
                        {!! Form::button('Predict', array('id'=>'predictBtn' ,'type' => 'submit')) !!}
                    </div>
                {!! Form::close() !!}

                <div class="row">
                    <br>
                    <div id="responseDiv" class="text-center row"></div>
               </div>
            </div>
        </div>
    </body>
</html>
