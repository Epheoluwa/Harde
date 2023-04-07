<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Harde Business School</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css" rel="stylesheet" />

    <!-- Datatable route  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.js"></script>


    <!-- Toastr Notification route -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0- 
     alpha/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        td {
            word-break: break;

        }
    </style>
</head>

<body>
    <div class="text-center">
        <h1>Harde Business School</h1>
        <h3>Full stack Laravel Developer Assessment</h3>
    </div>

    <div class="container" style="margin-top:10px;">
        <table id="allbooks" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Isbn</th>
                    <th>Authors</th>
                    <th>Country</th>
                    <th>Number of pages</th>
                    <th>Publisher</th>
                    <th>Release Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sn = 0; ?>
                @foreach($data as $d)
                <tr>
                    <td><?= ++$sn ?></td>
                    <td>{{$d->name}}</td>
                    <td>{{$d->isbn}}</td>
                    <td>
                        @foreach($d->authors as $authors)
                        <p>- {{$authors}}</p>
                        @endforeach
                    </td>
                    <td>{{$d->country}}</td>
                    <td>{{$d->number_of_pages}}</td>
                    <td>{{$d->publisher}}</td>
                    <td>{{$d->release_date}}</td>
                    <td>
                        <button data-bs-toggle="modal" data-bs-target="#deleteModal{{$d->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        <button data-bs-toggle="modal" data-bs-target="#editModal{{$d->id}}"><i class="fas fa-edit"></i></button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{$d->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{url('/delete-record', $d->id)}}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h4>Are you sure you want to delete this record</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete Record</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal{{$d->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ...
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Update changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Isbn</th>
                    <th>Authors</th>
                    <th>Country</th>
                    <th>Number of pages</th>
                    <th>Publisher</th>
                    <th>Release Date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>


</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#allbooks').DataTable({
            ordering: false,
        });
    });
</script>
<script>
    @if(Session::has('message'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true
    }
    toastr.error("{{ session('error') }}");
    @endif

</script>

</html>