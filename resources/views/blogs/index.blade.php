@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blogs</h1>
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
                <div class="card-body">
                    <form method="get">

                        <div class="row p-1">
                            <div class="col-sm-2">
                                <label for="title">title</label>
                                <input type="text" name="title" class="form-control" placeholder="title">
                            </div>
                            <!-- Name Field -->
                            <div class="col-sm-2">
                                <label for="content">content</label>
                                <input type="text" name="content" class="form-control"
                                       placeholder="content">
                            </div>
                            <!-- Name Field -->
                            <div class="col-sm-2">
                                <label for="publishDate">publish from</label>
                                <input type="date" name="from" class="form-control"
                                       placeholder="publish Date">
                            </div>
                            <div class="col-sm-2">
                                <label for="publishDate">publish to</label>
                                <input type="date" name="to" class="form-control"
                                       placeholder="publish Date">
                            </div>
                            <!-- Name Field -->
                            <div class="col-sm-3 mt-4">
                                <input type="submit" value="filter" id="submit">
                            </div>
                        </div>
                    </form>
                    @include('blogs.table')

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
                                <form method="post" id="upload-image-form" enctype="multipart/form-data">
                                    <span class="text-danger" id="input-error"></span>

                                    @csrf
                                    <div class="form-group">
                                        <input type="file" name="image" class="form-control" id="image-input">
                                    </div>
                                    <!-- Name Field -->
                                    <div class="form-group col-sm-6">
                                        <label for="title">title</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                               placeholder="title">
                                    </div>
                                    <!-- Name Field -->
                                    <div class="form-group col-sm-6">
                                        <label for="content">content</label>
                                        <textarea name="content" class="form-control" id="content"
                                                  placeholder="content"> </textarea>
                                    </div>
                                    <!-- Name Field -->
                                    <div class="form-group col-sm-6">
                                        <label for="publishDate">publish Date</label>
                                        <input type="datetime-local" name="publish_date" class="form-control"
                                               id="publishDate" placeholder="publish Date">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <div class="form-check">
                                            <input type="checkbox" name="status" class="form-check-input" value="1"
                                                   id="status">
                                            <label class="form-check-label" for="status">status</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Upload</button>
                                    </div>

                                </form>
                                <!-- Status Field -->

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

        @endsection
        @push('third_party_scripts')

            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#upload-image-form').submit(function (e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    let formData = new FormData(this);
                    $('#input-error').text('');
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('blogs.store') }}",
                        method: "POST",
                        data: formData,
                        dataType: 'JSON',
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            if (data) {
                                this.reset();
                                alert(data.message);
                                $('#createModel').modal('hide');
                                $('.buttons-reload').click();
                            }
                        },
                        error: function (response) {
                            $('#input-error').text(response.responseJSON.message);
                        }
                    });
                });

                function destroyId(id) {
                    var token = "{{ csrf_token() }}";
                    var url = '{{ route("blogs.destroy", ":id") }}';
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
