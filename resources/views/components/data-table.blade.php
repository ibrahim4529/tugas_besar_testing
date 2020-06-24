<div>
    <div class="page-inner">
        <div class="page-header">
            <h3 class="page-title">
                {{$title}}
            </h3>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href=""><i class="flaticon-home"></i></a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{route($resource.".index")}}">{{$title}}</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{$title}}</h4>
                            <button class="btn btn-primary btn-round ml-auto" onclick="add_data()">
                                <i class="fa fa-plus"></i>
                                Tambah {{$title}}
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="modal fade bd-example-modal-lg" id="modal_form" tabindex="-1" role="dialog"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">
                                                Tambah </span>
                                            <span class="fw-light">
                                                {{$title}}
                                            </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form enctype="multipart/form-data" id="form">
                                            <div class="row">
                                                {{$slot}}
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" onclick="save_data()" id="btn_save"
                                            class="btn btn-primary">Save data
                                        </button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table width="100%" id="dataTable" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        @foreach($header as $title)
                                        <th>{{ucfirst($title)}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
<script !src="">
    var table;
    var method;
    var url = "{{route($resource.".index")}}";
    var edited_id;
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 5,
            ajax: url,
            language: {
              emptyTable: "Tidak ada data"
            },
            columns: [
                @foreach($header as $key => $val)
                {
                    data: '{{$key}}',
                    name: '{{$key}}',
                    orderable: '{{$key == "action" ? false : true }}' ? true : false,
                },
                @endforeach
            ]
        });
    });

    function add_data() {
        initSelect2();
        method = "POST";
        reset_form();
        $("#modal_form").modal('show');
        $('.modal-title').text('');
    }

    function edit_data(id) {
        edited_id = id;
        method = "PUT";
        reset_form();
        $.ajax({
            url: url + '/' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function (data) {
                $.each(data, function (key, value) {
                    console.log('Key: ' + key + ' Value: ' + value);
                    $("img#photo").attr("src", "/img/"+value);
                    $("#form input[name=" + key + "], select[name="+key+"], textarea[name="+key+"]").not("input[type=file]").val(value);
                });
                $("#modal_form").modal('show');
                $('.modal-title').text('Edit Data');
                initSelect2();
            }
        })
    }

    function save_data() {
        console.log("Save");
        var formData = new FormData($("#form")[0]);
        $.ajax({
            url: method == 'POST' ? url : url + '/' + edited_id,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            beforeSend: function () {
                if(method != 'POST'){
                    formData.append('_method', 'PATCH');
                }
                delete_error();
            },
            success: function (data) {
                $("#modal_form").modal('hide');
                swal("Pesan", data.message, {
						icon : "success",
						buttons: {
							confirm: {
								className : 'btn btn-success'
							}
						},
				});
                reload_table()
            },
            error: function (xhr, error, errorThrown) {
                if (xhr.status == 422) {
                    let message = xhr.responseJSON.message;
                    let errors = xhr.responseJSON.errors;
                    swal('Error', message, {
                        icon: 'error',
                        buttons: {
                            confirm:{
                                className: 'btn btn-info'
                            }
                        }
                    });
                    $.each(errors, function (index, val) {
                        $(".form-group#" + index).addClass('has-error has-feedback').append(
                            '<label class="error" for="' + index + '">' + val[0] + '</label>'
                        );
                    })
                }
            }
        })
    }

    function delete_data(id) {
        $.ajax({
            url: url + '/' + id,
            method: 'DELETE',
            success: function (data) {
                swal("Pesan", data.message, {
						icon : "success",
						buttons: {
							confirm: {
								className : 'btn btn-success'
							}
						},
				});
                reload_table(false);
            }
        })
    }

    function reload_table() {
        table.ajax.reload(false);
    }

    function reset_form() {
        delete_error();
        $("#form")[0].reset();
    }

    function initSelect2() {
        $(".select2-input select, .form-group select").select2({
            theme: 'bootstrap'
        });
    }

    function delete_error() {
        $(".has-error label.error").remove();
        $(".has-error").removeClass("has-error has-feedback");
    }
</script>
@endpush
