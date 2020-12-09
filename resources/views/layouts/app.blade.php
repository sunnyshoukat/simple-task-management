<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title')
    </title>
    {{-- Bootstrap CSS file --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <style>
        .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
    </style>
</head>
<body>
    <div class="container">
    
      @yield('content')
        </div>

    {{-- bootsrap JS, Popper.js, and jQuery --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></s
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>

    <script>
    // Some Ajax for ReOrder the task List
        $(document).ready(function(){
            $('#task-list').sortable({
                update:function(){
                    let reorder_tasks = $(this).sortable('serialize');
                    $.get(
                        "{{route('reorder')}}",
                        reorder_tasks
                    ).done(function( data ) {
                        console.log( "Data Loaded: " + data );
                    });
                }
            });
        });        
    </script>
</body>
</html>
