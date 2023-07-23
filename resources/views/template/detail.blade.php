@extends('layouts.app')

@section('title', 'Detail Template RPS')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid plr_30 body_white_bg pt_30 mb-3">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="QA_section pb-4">
                        <div class="white_box_tittle list_header">
                            <h4>Informasi Template RPS</h4>
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
                            <h4>Detail Template RPS</h4>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Tambah
                            </button>
                        </div>
                        <div class="QA_tables">
                            @forelse ($details as $detail)
                                <div class="alert alert-gray">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            {{ $loop->iteration }}.
                                            {{ $detail->title }}
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            {{-- button to change position up and down --}}
                                            @if ($loop->iteration != 1)
                                                <form action="{{ route('template-detail.apiChangePosition') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="id" value="{{ $detail->id }}">
                                                    <input type="hidden" name="position" value={{ $loop->iteration - 1 }}>
                                                    <input type="hidden" name="type" value="up">
                                                    <button type="submit" class="btn text-white py-0 px-0"><i
                                                            class="bi bi-arrow-up fs-7"></i></button>
                                                </form>
                                            @endif
                                            @if ($loop->iteration != count($details))
                                                <form action="{{ route('template-detail.apiChangePosition') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="id" value="{{ $detail->id }}">
                                                    <input type="hidden" name="position" value={{ $loop->iteration + 1 }}>
                                                    <input type="hidden" name="type" value="down">
                                                    <button type="submit" class="btn text-white py-0 px-0"><i
                                                            class="bi bi-arrow-down fs-7"></i></button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn text-white py-0 px-0 ps-2"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal2"
                                                data-item="{{ $detail }}"><i
                                                    class="bi bi-pencil-square fs-7"></i></button>
                                            <form action="{{ route('template-detail.destroy', $detail->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn text-white py-0 px-0 ps-1"><i
                                                        class="bi bi-x-lg fs-7"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @if ($detail->type == 'text')
                                    <div class="alert border-gray-dashed area-text">
                                        <p class="mb-0 py-4">
                                            Area ini akan ditulisan oleh pengajar sebagai teks.
                                        </p>
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
                                                <td colspan="{{ count(json_decode($detail->column)) }}" class="px-0">
                                                    <p class="mb-0 py-4">
                                                        Area ini akan diisikan sebagai tabel oleh pengajar.
                                                    </p>
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @empty
                                <div class="alert alert-info">
                                    Belum ada data!
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fs-6 fw-bold" id="exampleModalLabel">Tambah Kolom</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('template-detail.apiStore') }}" method="POST" autocomplete="off"
                                    id="form-template">
                                    @csrf
                                    <input type="hidden" name="id_template" id="id_template" class="form-control"
                                        value="{{ $template->id }}">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Judul</label>
                                        <input type="text" name="title" id="title" class="form-control">
                                        <label for="title" class="form-label">*Contoh: Tujuan Pembelajaran, Materi
                                            Pokok,
                                            dll</label><br />
                                        <label for="title" class="text-danger" id="error-title"></label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Tipe</label>
                                        <select name="type" id="type" class="form-select">
                                            <option value="text">Text</option>
                                            <option value="table">Tabel</option>
                                        </select>
                                        @error('type')
                                            <label for="type" class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="mb-3" id="column">
                                        <label for="column" class="form-label">Kolom</label>
                                        <input type="text" name="column" id="column" class="form-control">
                                        <label for="column" class="form-label mb-0">*Contoh: No, Kompetensi, Indikator,
                                            dll</label><br />
                                        <label for="column" class="form-label">*Pisahkan dengan koma (,)</label>
                                        @error('column')
                                            <label for="column" class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="template_id" value="{{ $template->id }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fs-6 fw-bold" id="exampleModalLabel">Tambah Kolom</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('template-detail.apiUpdate') }}" method="POST"
                                    autocomplete="off" id="form-template-update">
                                    @csrf
                                    <input type="hidden" name="id_template" id="id_template" class="form-control"
                                        value="{{ $template->id }}">
                                    <input type="hidden" name="id" id="id" class="form-control">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Judul</label>
                                        <input type="text" name="title" id="title" class="form-control">
                                        <label for="title" class="form-label">*Contoh: Tujuan Pembelajaran, Materi
                                            Pokok,
                                            dll</label><br />
                                        <label for="title" class="text-danger" id="error-title-update"></label>
                                    </div>
                                    <div class="mb-3">
                                        <label for="type" class="form-label">Tipe</label>
                                        <select name="type" id="type" class="form-select">
                                            <option value="text">Text</option>
                                            <option value="table">Tabel</option>
                                        </select>
                                        <label for="type" class="text-danger" id="error-type-update"></label>
                                    </div>
                                    <div class="mb-3" id="column">
                                        <label for="column" class="form-label">Kolom</label>
                                        <input type="text" name="column" id="column" class="form-control">
                                        <label for="column" class="form-label mb-0">*Contoh: No, Kompetensi, Indikator,
                                            dll</label><br />
                                        <label for="column" class="form-label">*Pisahkan dengan koma (,)</label>
                                        @error('column')
                                            <label for="column" class="text-danger">{{ $message }}</label>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="template_id" value="{{ $template->id }}">
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
                    //find the exampleModal2 and show the #column
                    $('#exampleModal2').find('.modal-body #column').show();
                } else {
                    $('#column').hide();
                    //find the exampleModal2 and hide the #column
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

        //while exampleModal2 show
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var item = button.data('item');
            var modal = $(this);
            const {
                id,
                title,
                type,
                column
            } = item;
            if (item?.column) {
                //show column
                modal.find('.modal-body #column').show();
            } else {
                //hide column
                modal.find('.modal-body #column').hide();
            }
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #title').val(title);
            modal.find('.modal-body #type').val(type);
            modal.find('.modal-body #column').val(JSON.parse(column));
        });

        $('#btn-save').click(function() {
            $.ajax({
                url: "{{ route('template-detail.apiStore') }}",
                method: "POST",
                data: $('#form-template').serialize(),
                //make loading
                beforeSend: function() {
                    $('#btn-save').html(
                        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                    );
                },
                success: function(data) {
                    if (data.success) {
                        console.log(data);
                        window.location.reload();
                        //close the modal
                        // $('#exampleModal').modal('hide');
                        //clear form
                    } else {
                        let err = JSON.parse(data?.message);
                        if (err?.title) {
                            $('#error-title').text(err?.title[0]);
                        }
                        $('#btn-save').html('Simpan');
                    }
                }
            });
        });

        $('#btn-update').click(function() {
            $.ajax({
                url: "{{ route('template-detail.apiUpdate') }}",
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
                        //close the modal
                        // $('#exampleModal').modal('hide');
                        //clear form
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
