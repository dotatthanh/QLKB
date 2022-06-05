@php
    if (isset($request->booking_id)) {
        $booking = App\Models\Booking::find($request->booking_id);
    }
@endphp
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Thông tin cơ bản</h4>
        <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>
        @csrf

        @if (isset($health_certification))
            <input type="number" name="health_certification_id" value="{{ $health_certification->id }}" hidden="">
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Tiêu đề" value="{{ old('title', $data_edit->title ?? '') }}">
                    {!! $errors->first('title', '<span class="error">:message</span>') !!}
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="patient_name">Tên bệnh nhân <span class="text-danger">*</span></label>
                            <input id="patient_name" name="patient_name" type="text" class="form-control" placeholder="Tên bệnh nhân" readonly=""
                            @if ($routeType == 'create')
                                value="{{ $health_certification->patient->name }}"
                            @elseif ($routeType == 'edit')
                                value="{{ old('patient_name', $data_edit->healthCertification->patient->name ?? '') }}"
                            @endif
                            >
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="date">Ngày hẹn khám bệnh <span class="text-danger">*</span></label>
                    <div class="docs-datepicker">
                        <div class="input-group">
                            <input type="text" class="form-control docs-date" name="date" placeholder="Chọn ngày hẹn khám" autocomplete="off" value="{{ old('date', isset($data_edit->date) ? date('d-m-Y', strtotime($data_edit->date)) : '') }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary docs-datepicker-trigger" disabled="">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="docs-datepicker-container"></div>
                    </div>
                    {!! $errors->first('date', '<span class="error">:message</span>') !!}
                </div>

            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="consulting_room_id">Phòng khám <span class="text-danger">*</span></label>
                    <input id="consulting_name" name="consulting_name" type="text" class="form-control" placeholder="Phòng khám" readonly=""
                    @if ($routeType == 'create')
                        value="{{ $health_certification->consultingRoom->name }}"
                    @elseif ($routeType == 'edit')
                        value="{{ old('consulting_name', $data_edit->healthCertification->consultingRoom->name ?? '') }}"
                    @endif
                    >
                </div>

                <div class="form-group">
                    <label for="user_id">Bác sĩ <span class="text-danger">*</span></label>
                    <input id="user_name" name="user_name" type="text" class="form-control" placeholder="Tên bệnh nhân" readonly=""
                    @if ($routeType == 'create')
                        value="{{ $health_certification->user->name }}"
                    @elseif ($routeType == 'edit')
                        value="{{ old('user_name', $data_edit->healthCertification->user->name ?? '') }}"
                    @endif
                    >
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ route('appointment_papers.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>