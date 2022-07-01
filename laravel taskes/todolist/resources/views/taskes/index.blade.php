<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }

        .m-b-1em {
            margin-bottom: 1em;
        }

        .m-l-1em {
            margin-left: 1em;
        }

        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1> {{ $title }} </h1>
            <br>
            {{ 'Welcome , ' . auth()->user()->name }}
            <br>

            @include('messages')

        </div>

        <a href="{{ url('Taskes/create') }}" class='btn btn-primary m-r-1em'>+ Task</a> <a href="{{ url('Logout') }}"
            class='btn btn-primary m-r-1em'>Logout</a>

        <br>

        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>image</th>
                <th>Start date</th>
                <th>End date</th>
                <th>User id</th>
                <th>action</th>
            </tr>



            @foreach ($data as $key => $Raw)
            @if ($Raw->user_id == auth()->user()->id)


                <tr>


                    <td>{{ $Raw->id }}</td>
                    <td>{{ $Raw->title }}</td>
                    <td>{{ Str::limit($Raw->content, 30, '...') }}</td>
                    <td><img src="{{ url('images/taskes/' . $Raw->image) }}" width="80px" height="80px"></td>
                    <td>{{ date('Y-m-d', $Raw->startDate) }}</td>
                    <td>{{ date('Y-m-d', $Raw->endDate) }}</td>

                    <td> {{ $Raw->name }} </td>


                    <td>
                        <a href='' data-toggle="modal" data-target="#modal_single_del{{ $Raw->id }}"
                            class='btn btn-danger m-r-1em'>Remove </a><br><br>
                        <a href='{{ url('Taskes/' . $Raw->id) }}' class='btn btn-primary m-r-1em'>Show more</a>
                        {{-- <a href="{{ url('Taskes/' . $Raw->id.'/edit') }} " class='btn btn-primary m-r-1em'>Update</a> --}}

                    </td>


                </tr>






                <div class="modal" id="modal_single_del{{ $Raw->id }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">delete confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                Remove Task : {{ $Raw->title }} !!!!
                            </div>
                            <div class="modal-footer">
                                <form action="{{ url('Taskes/' . $Raw->id) }}" method="post">

                                    @method('delete')
                                    @csrf

                                    <div class="not-empty-record">
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach

            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>
