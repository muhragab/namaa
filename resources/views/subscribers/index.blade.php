@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscribers</h1>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                            data-target="#createModel">
                        Create New
                    </button>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">

                <form method="get">

                    <div class="row p-1">
                        <div class="col-sm-2">
                            <label for="name">name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="name">
                        </div>
                        <!-- Name Field -->
                        <div class="col-sm-2">
                            <label for="username">username</label>
                            <input type="text" name="username" class="form-control" id="username"
                                   placeholder="username">
                        </div>

                        <!-- Name Field -->
                        <div class="col-sm-3 mt-4">
                            <input type="submit" id="submit">
                        </div>
                    </div>
                </form>
                @include('subscribers.table')

                <div class="card-footer clearfix">
                    <div class="float-right">

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="createModel" tabindex="-1" role="dialog" aria-labelledby="createModelLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <!-- Name Field -->
                            <div class="form-group col-sm-6">
                                <label for="name">name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="name">
                            </div>

                            <!-- Username Field -->
                            <div class="form-group col-sm-6">
                                <label for="username">username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                       placeholder="username">
                            </div>

                            <!-- Password Field -->
                            <div class="form-group col-sm-6">
                                <label for="password">password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                       placeholder="password">
                            </div>

                            <!-- Status Field -->
                            <div class="form-group col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" name="status" class="form-check-input" value="1" id="status">
                                    <label class="form-check-label" for="status">status</label>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary createForm">Submit</button>

                    </div>


                </div>

            </div>
        </div>
    </div>

@endsection
@push('third_party_scripts')

    <script type="text/javascript">
        $(".createForm").click(function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            var name = $("#name").val();

            var password = $("#password").val();

            var username = $("#username").val();

            var status = $("input[name=status]").val();

            var token = "{{ csrf_token() }}";
            $.ajax({
                type: 'POST',
                url: "{{ route('subscribers.store') }}",
                data: {name: name, password: password, status: status, username: username, _token: token},
                success: function (data) {
                    alert(data.message);
                    $("#name").val("")
                    $("#password").val("");
                    $("#username").val("")
                    $('#createModel').modal('hide');
                    $('.buttons-reload').click();
                },
                error: function (errors) {
                    alert(errors.responseJSON.message)
                }
            });
        });

        function destroyId(id) {
            var token = "{{ csrf_token() }}";
            var url = '{{ route("subscribers.destroy", ":id") }}';
            url = url.replace(':id', id);
            console.log(url);
            $.ajax({
                type: 'delete',
                url: url,
                data: {
                    _token: token,
                },
                success: function (data) {
                    alert(data.message);
                    $('.buttons-reload').click();

                },
                error: function (errors) {
                    alert(errors.responseJSON.message)
                }
            });
        }
    </script>

@endpush
