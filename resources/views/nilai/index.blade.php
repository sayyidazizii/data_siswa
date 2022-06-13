    <!doctype html>
    <html lang="en">

    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('assets/bootstrap/favicon.ico') }}">


        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('sidebar-01/css/style.css') }}">

        {{-- dataTables --}}
        <link href="{{ asset('assets/datatables/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">

        {{-- SweetAlert2 --}}
        <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
        <link href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="{{ asset('assets/bootstrap/css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

        {{-- <!-- Custom styles for this template -->
        <link href="{{ asset('assets/bootstrap/css/navbar-fixed-top.css') }}" rel="stylesheet"> --}}

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="{{ asset('assets/bootstrap/js/ie-emulation-modes-warning.js') }}"></script>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    </head>

    <body>

        <div class="wrapper d-flex align-items-stretch">
            <nav id="sidebar">
                <div class="p-4 pt-5">
                    <a href="#" class="img logo rounded-circle mb-5 text-light"
                    style="background-image: url('{{ asset('sidebar-01/images/user.jpg')}}');"></a>
                    <ul class="list-unstyled components mb-5">
                        <li class="active">
                        <li>
                            <a href="/home">Home</a>
                        </li>
                        </li>
                        <li>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle">Pages</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu">
                                <li>
                                    <a href="/datasiswa">Data Siswa</a>
                                </li>
                                <li>
                                    <a href="/datanilai">Nilai Siswa</a>
                                </li>
                                <li>
                                    <a href="#">Lainnya</a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="footer">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib.com</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>

                </div>
            </nav>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="/home">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/datasiswa">Data Siswa</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/datanilai">Data Nilai</a>
                                </li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <!-- Authentication Links -->
                              
                                    <li class="">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>
        
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
        
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                
                            </ul>
                        </div>
                    </div>
                </nav>

                <h2 class="mb-4">Data Nilai</h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Nilai Siswa                     
                                      <a onclick="addForm()" class="btn btn-primary pull-right text-light" style="margin-top: -8px;">Add Nilai</a>
                                      <a href="/export_datanilai" target="_blank" class="btn btn-success pull-right text-light" style="margin-top: -8px;">Export</a>      
                                  </h4>
                                </h4>
                            </div>
                            <div class="panel-body">
                                <table id="nilai-table" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="30">ID</th>
                                            <th>Nis</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Nilai</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                {{-- MODAL INSERT DAN EDIT --}}
                <div class="modal" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form id="form-nilai" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data">
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <div class="modal-header">
                                    <h3 class="modal-title"></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"> &times; </span>
                                    </button>
                                </div>
                
                                <div class="modal-body">
                                    <input type="hidden" id="id" name="id">
                                    <div class="form-group">
                                        <label for="name" class="col-md-3 control-label">Nis Siswa</label>
                                        <div class="col-md-6">
                                            <input type="text" id="nis" name="nis" class="form-control" autofocus required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                    </div>
                        
                                      <div class="form-group">
                                        <label for="email" class="col-md-3 control-label">Nilai</label>
                                        <div class="col-md-6">
                                            <input type="text" id="nilai" name="nilai" class="form-control" required>
                                            <span class="help-block with-errors"></span>
                                        </div>
                                      </div>
                                </div>
                
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-save">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                
                            </form>
                        </div>
                    </div>
                </div>
                
                {{-- END MODAL --}}


            </div>
        </div>

        <script src="{{ asset('sidebar-01/js/jquery.min.js') }}"></script>
        {{-- <script src="{{ asset('sidebar-01/js/popper.js') }}"></script> --}}
        {{-- <script src="{{ asset('sidebar-01/js/bootstrap.min.js') }}"></script> --}}
        <script src="{{ asset('sidebar-01/js/main.js') }}"></script>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{ asset('assets/jquery/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

        {{-- dataTables --}}
        <script src="{{ asset('assets/dataTables/js/jquery.dataTables.min.js') }}"></script>
        {{-- <script src="{{ asset('assets/dataTables/js/dataTables.bootstrap.min.js') }}"></script> --}}

        {{-- Validator --}}
        <script src="{{ asset('assets/validator/validator.min.js') }}"></script>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="{{ asset('assets/bootstrap/js/ie10-viewport-bug-workaround.js') }}"></script>

        <script type="text/javascript">
            var table = $('#nilai-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('api.datanilai') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'fnis_siswa',
                        name: 'fnis_siswa'
                    },
                    {
                        data: 'fnama_siswa',
                        name: 'fnama_siswa'
                    },
                    {
                        data: 'fkelas_siswa',
                        name: 'fkelas_siswa'
                    },
                    {
                        data: 'fnilai_siswa',
                        name: 'fnilai_siswa'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            function addForm() {
                save_method = "add";
                $('input[name=_method]').val('POST');
                $('#modal-form').modal('show');
                $('#modal-form form')[0].reset();
                $('.modal-title').text('Add Nilai');
            }


            function editForm(id) {
                save_method = 'edit';
                $('input[name=_method]').val('PATCH');
                $('#modal-form form')[0].reset();
                $.ajax({
                    url: "{{ url('datanilai') }}" + '/' + id + "/edit",
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        console.log(data);
                        $('#modal-form').modal('show');
                        $('.modal-title').text('Edit Nilai');

                        $('#id').val(data[0].fid);
                        $('#nis').val(data[0].fnis);
                        $('#nilai').val(data[0].fnilai_siswa);
                    },
                    error: function() {
                        alert("Nothing Data");
                    }
                });
            }

            function deleteData(id) {
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function() {
                    $.ajax({
                        url: "{{ url('datanilai') }}" + '/' + id,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            '_token': csrf_token
                        },
                        success: function(data) {
                            table.ajax.reload();
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error: function() {
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                });
            }

            $(function() {
                $('#modal-form form').validator().on('submit', function(e) {
                    if (!e.isDefaultPrevented()) {
                        var id = $('#id').val();
                        if (save_method == 'add') url = "{{ url('datanilai') }}";
                        else url = "{{ url('datanilai') . '/' }}" + id;

                        $.ajax({
                            url: url,
                            type: "POST",
                            //                        data : $('#modal-form form').serialize(),
                            data: new FormData($("#modal-form form")[0]),
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                console.log(data);
                                $('#modal-form').modal('hide');
                                table.ajax.reload();
                                swal({
                                    title: 'Success!',
                                    text: data.message,
                                    type: 'success',
                                    timer: '1500'
                                })
                            },
                            error: function(data) {
                                swal({
                                    title: 'Oops...',
                                    text: data.message,
                                    type: 'error',
                                    timer: '1500'
                                })
                            }
                        });
                        return false;
                    }
                });
            });
        </script>
    </body>

    </html>
