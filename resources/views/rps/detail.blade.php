@extends('layouts.app')

@section('title', 'Detail RPS')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30 mb-3">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section pb-4">
                        <div class="white_box_tittle list_header">
                            <h4>Informasi RPS</h4>
                        </div>
                        <div class="QA_tables">
                            <table class="align-top">
                                <tr>
                                    <td style="width: 40%;"><b>Jurusan</b></td>
                                    <td style="width:5%">:</td>
                                    <td style="width: 55%">{{ $template->department_name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Mata Kuliah</b></td>
                                    <td>:</td>
                                    <td>{{ $template->course_name }}</td>
                                </tr>
                                <tr>
                                    <td><b>Pengampu</b></td>
                                    <td>:</td>
                                    <td>
                                        @foreach ($template->teachers as $t)
                                            {{ $loop->iteration }}. {{ $t }}<br>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Semester</b></td>
                                    <td>:</td>
                                    <td>{{ $template->semester }}</td>
                                </tr>
                                <tr>
                                    <td><b>Periode</b></td>
                                    <td>:</td>
                                    <td>{{ $template->periode }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid plr_30 body_white_bg pt_30">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section pb-4">
                        <div class="white_box_tittle list_header">
                            <h4>Detail RPS</h4>
                        </div>
                        <div class="QA_tables ">
                            @forelse ($details as $detail)
                                <div class="alert alert-gray">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            {{ $loop->iteration }}.
                                            {{ $detail->title }}
                                        </div>
                                        @if ($detail->type == 'text')
                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button" class="btn text-white py-0 px-0 ps-2"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal2"
                                                    data-item="{{ $detail }}"><i
                                                        class="bi bi-pencil-square fs-7"></i></button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if ($detail->type == 'text')
                                    <div
                                        class="alert border-gray-dashed area-text {{ $detail->value ? 'area-text-2' : '' }}">
                                        @if ($detail->value == null)
                                            <p class="mb-0 py-4">
                                                Silahkan mengisi dengan klik icon edit
                                            </p>
                                        @else
                                            <p class="mb-0 py-4 text-dark">
                                                {!! $detail->value !!}
                                            </p>
                                        @endif
                                    </div>
                                @else
                                    <div class="table-responsive border mb-3">
                                        <table class="table-custom">
                                            <thead>
                                                <tr>
                                                    @foreach (json_decode($detail->column) as $col)
                                                        <th>{{ $col }}</th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($detail->value == null)
                                                    <tr>
                                                        <td colspan="{{ count(json_decode($detail->column)) }}">
                                                            <p class="mb-0 py-4">
                                                                Silahkan mengisi dengan klik tambahkan isi tabel
                                                            </p>
                                                        </td>
                                                    </tr>
                                                @else
                                                    @forelse(json_decode($detail->value) as $row)
                                                        <tr>
                                                            @foreach ($row as $item)
                                                                <td class="text-dark">{!! $item !!}</td>
                                                            @endforeach
                                                        </tr>
                                                    @empty
                                                        <tr></tr>
                                                    @endforelse
                                                @endif
                                                <tr>
                                                    <td colspan="{{ count(json_decode($detail->column)) }}"
                                                        class="text-center border-top-dashed">
                                                        <button type="button" class="btn text-dark py-0 px-0 ps-2"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal2"
                                                            data-item="{{ $detail }}"><i
                                                                class="bi bi-plus-circle fs-7"></i> Tambahkan isi
                                                            tabel</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @empty
                                <div class="alert alert-info">
                                    Silahkan hubungi institusi untuk menambahkan template RPS.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fs-6 fw-bold" id="exampleModalLabel">Edit Kolom</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form method="POST" autocomplete="off" id="form-template-update">
                                    @csrf
                                    <div class="append-input">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-update">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#column').hide();
        $(document).ready(function() {
            $('#type').change(function() {
                if ($(this).val() == 'table') {
                    $('#column').show();
                    $('#exampleModal2').find('.modal-body #column').show();
                } else {
                    $('#column').hide();
                    $('#exampleModal2').find('.modal-body #column').hide();
                }
            });

            $('#exampleModal2 #type').change(function() {
                if ($(this).val() == 'table') {
                    $('#exampleModal2 #column').show();
                } else {
                    $('#exampleModal2 #column').hide();
                }
            });
        });

        $('#exampleModal2').on('shown.bs.modal', function() {
            var append_input = $('.append-input textarea');
            console.log(append_input)
            var length = append_input.length;
            for (let i = 0; i < length; i++) {
                var id = append_input[i].dataset.id;
                ClassicEditor
                    .create(document.querySelector(`.tiny-${id}`))
                    .then(editor => {
                        console.log(editor);
                        const content = editor.getData();
                        console.log('data', content)
                        editor.model.document.on('change:data', () => {
                            const content = editor.getData();
                            console.log('data', content)
                            $(`.tiny-${i}`).text(content);
                            console.log($(`.tiny-${i}`))
                        });
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        });

        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var item = button.data('item');
            var modal = $(this);
            const {
                id,
                title,
                type,
                column,
                value,
                id_template_fill,
                id_learning_plan
            } = item;
            modal.find('#exampleModalLabel').text(title);
            $('.append-input').html('');
            $('.append-input').append(
                `<input type="hidden" name="id" id="id" value="${id}" >`
            )
            $('.append-input').append(
                `<input type="hidden" name="type" id="type" value="${type}" >`
            )
            $('.append-input').append(
                `<input type="hidden" name="id_learning_plan" id="id_learning_plan" value="${id_learning_plan}" >`
            )
            $('.append-input').append(
                `<input type="hidden" name="id_template_fill" id="id_template_fill" value="${id_template_fill}" >`
            )
            if (item?.type == 'text') {
                $('.append-input').append(
                    `<div class="mb-3">
                                        <textarea name="value" id="value" class="form-control tiny-0" rows="10" data-id="0">${value ?? ''}</textarea>
                                        <label for="value" class="text-danger" id="error-title-update"></label>
                                    </div>`
                );
            } else {
                let parseColumn = JSON.parse(column);
                console.log(parseColumn);
                parseColumn.forEach((item, index) => {
                    $('.append-input').append(
                        `<div class="mb-3">
                                            <label for="value" class="form-label">${item}</label>
                                            <textarea name="value[]" id="value" class="form-control tiny-${index}" rows="10" data-id="${index}">${parseColumn[index] ?? ''}</textarea>
                                            <label for="value" class="text-danger" id="error-title-update"></label>
                                        </div>`
                    );
                });
            }
        });

        $('#btn-update').click(function() {
            $.ajax({
                url: "{{ route('rps-detail.apiUpdate') }}",
                method: "PATCH",
                data: $('#form-template-update').serialize(),
                //make loading
                beforeSend: function() {
                    $('#btn-update').html(
                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                    );
                },
                success: function(data) {
                    if (data.success) {
                        console.log(data);
                        window.location.reload();
                    } else {
                        let err = JSON.parse(data?.message);
                        if (err?.title) {
                            $('#error-title-update').text(err?.title[0]);
                        }
                        if (err?.type) {
                            $('#error-type-update').text(err?.type[0]);
                        }
                        $('#btn-update').html('Simpan');
                    }
                }
            });
        });
    </script>
@endpush
