@extends('layouts/app')

@section('title')
Task Managemant
@endsection

@section('content')

            <h1 class="text-center py-5">TASK</h1>
            <div class="row justify-content-center">
                <div class="col-md-8">

                    {{-- massage  --}}

                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif  {{-- massage / --}}

                    {{-- task create form --}}
                     
                    <form action="@if($task ?? '') {{ route('update', $task->id)}} @else {{ route('store')}} @endif" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" @if ($task ?? '')
                                value="{{$task->task_name}}"
                            @endif name="task_name"><br>
                            <input type="submit" value="@if ($task ?? '') Update Task  @else Save Task @endif"  name="save" class="btn btn-block btn-success">
                        </div>
                    </form> {{-- task create form / --}}

                    {{-- list of Task --}}

                    <div class="card border-primary">
                        <div class="card-header text-center">
                            Task List (Change the Priority of task by drag and drop)
                        </div>
                        <div class="card-body">
                            <ul class="list-group" id="task-list">
                                @foreach ($tasks as $task)

                                <li id='task_{{$task->id}}' class="list-group-item list-group-item-action">
                                    {{ $task->task_name }}

                                    <a href="{{ route('edit', $task->id)}}" class="btn btn-success btn-sm ml-2 float-right">Edit</a>

                                    <a href="{{ route('delete', $task->id)}}" class="btn btn-danger btn-sm float-right">Delete</a>
                                </li>

                                @endforeach
                            </ul>
                        </div>
                    </div> {{-- list of Task / --}}
                </div>
            </div>
            

@endsection
