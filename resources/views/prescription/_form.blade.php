@csrf
<div class="card">
    <div class="card-body">

        @if (isset($health_certification_id))
            <input type="number" hidden name="health_certification_id" value="{{ $health_certification_id }}">
            <input type="number" hidden name="patient_id" value="{{ $health_certification->patient_id }}">
            <input type="number" hidden name="user_id" value="{{ $health_certification->user_id }}">

            <h4 class="card-title">Thông tin giấy khám bệnh</h4>

            <div class="row">
                <div class="col-sm-2">
                    <label>Mã giấy khám bệnh :</label>
                </div>

                <div class="col-sm-10">
                    <label>{{ $health_certification->code }}</label>
                </div>

                <div class="col-sm-2">
                    <label>Tiêu đề :</label>
                </div>

                <div class="col-sm-10">
                    <label>{{ $health_certification->title }}</label>
                </div>

                <div class="col-sm-2">
                    <label>Tên bệnh nhân :</label>
                </div>

                <div class="col-sm-4">
                    <label class="font-weight-bold">{{ $health_certification->patient->name }}</label>
                </div>

                <div class="col-sm-2">
                    <label>Tên phòng khám :</label>
                </div>

                <div class="col-sm-4">
                    <label class="font-weight-bold">{{ $health_certification->consultingRoom->name }}</label>
                </div>

                <div class="col-sm-2">
                    <label>Tên bác sĩ :</label>
                </div>

                <div class="col-sm-4">
                    <label class="font-weight-bold">{{ $health_certification->user->name }}</label>
                </div>

                <div class="col-sm-2">
                    <label>Trạng thái :</label>
                </div>

                <div class="col-sm-4">
                    @if ($health_certification->status)
                        <label class="text-success">Đã khám</label>
                    @else
                        <label class="text-warning">Chưa khám</label>
                    @endif
                </div>
            </div>
        @else
            @if (isset($data_edit->health_certification_id))
                <input type="number" hidden name="patient_id" value="{{ $data_edit->patient_id }}">
                <input type="number" hidden name="user_id" value="{{ $data_edit->user_id }}">
            @endif

            <h4 class="card-title">Thông tin đơn thuốc</h4>
            <p class="card-title-desc">Điền tất cả thông tin bên dưới</p>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="patient_id">Tên bệnh nhân <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="patient_id" {{ isset($data_edit->health_certification_id) ? 'disabled' : '' }}>
                            <option value="">Chọn bệnh nhân</option>
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}" {{ isset($data_edit->patient_id) && $data_edit->patient_id == $patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('patient_id', '<span class="error">:message</span>') !!}
                    </div>


                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="user_id">Bác sĩ <span class="text-danger">*</span></label>
                        <select class="form-control select2" name="user_id" {{ isset($data_edit->health_certification_id) ? 'disabled' : '' }}>
                            <option value="">Chọn bác sĩ</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ isset($data_edit->user_id) && $data_edit->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('user_id', '<span class="error">:message</span>') !!}
                    </div>

                </div>
            </div>
        @endif

    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-4">Chi tiết đơn thuốc</h4>
        {!! $errors->first('prescription_details', '<span class="error">:message</span>') !!}

        <div data-repeater-list="prescription_details">
            @if (isset($data_edit))
                @foreach ($data_edit->prescriptionDetails as $prescription_detail)
                <div data-repeater-item class="row">
                    <div class="form-group col-lg-3 custom-validate-select">
                        <label for="name">Tên thuốc</label>
                        <select class="form-control select2" name="medicine_id" required="">
                            <option value="">Chọn thuốc</option>
                            @foreach ($medicines as $medicine)
                            <option value="{{ $medicine->id }}" {{ $prescription_detail->medicine_id == $medicine->id ? 'selected' : '' }}>{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-lg-2">
                        <label for="amount">Số lượng</label>
                        <input type="number" id="amount" name="amount" class="form-control" placeholder="Số lượng" required="" data-parsley-min="1" value="{{ $prescription_detail->amount }}">
                    </div>

                    <div class="form-group col-lg-6 custom-validate-select">
                        <label for="use">Cách dùng</label>
                        <select class="form-control select2-tag" name="use" required="">
                            <option value="">Chọn hoặc thêm cách dùng</option>
                            <option {{ $prescription_detail->use == 'Sáng 1 viên' ? 'selected' : ''}} value="Sáng 1 viên">Sáng 1 viên</option>
                            <option {{ $prescription_detail->use == 'Trưa 1 viên' ? 'selected' : ''}} value="Trưa 1 viên">Trưa 1 viên</option>
                            <option {{ $prescription_detail->use == 'Tối 1 viên' ? 'selected' : ''}} value="Tối 1 viên">Tối 1 viên</option>
                            <option {{ $prescription_detail->use == 'Sáng tối mỗi buổi 1 viên' ? 'selected' : ''}} value="Sáng tối mỗi buổi 1 viên">Sáng tối mỗi buổi 1 viên</option>
                            @if ($prescription_detail->use != 'Sáng 1 viên' && $prescription_detail->use != 'Trưa 1 viên' && $prescription_detail->use != 'Tối 1 viên' && $prescription_detail->use != 'Sáng tối mỗi buổi 1 viên')
                                <option {{ $prescription_detail->use == $prescription_detail->use ? 'selected' : ''}} value="{{ $prescription_detail->use }}">{{ $prescription_detail->use }}</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-lg-1">
                        <label>Thao tác</label>
                        <input data-repeater-delete="" type="button" class="btn btn-danger btn-block" value="Xóa">
                    </div>
                </div>
                @endforeach
            @else
            <div data-repeater-item="" class="row">
                <div class="form-group col-lg-3 custom-validate-select">
                    <label for="name">Tên thuốc</label>
                    <select class="form-control select2" name="medicine_id" required="">
                        <option value="">Chọn thuốc</option>
                        @foreach ($medicines as $medicine)
                        <option value="{{ $medicine->id }}" {{ isset($data_edit->medicine_id) && $data_edit->medicine_id == $medicine->id ? 'selected' : '' }}>{{ $medicine->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-lg-2">
                    <label for="amount">Số lượng</label>
                    <input type="number" id="amount" name="amount" class="form-control" placeholder="Số lượng" required="" data-parsley-min="1">
                </div>

                <div class="form-group col-lg-6 custom-validate-select">
                    <label for="use">Cách dùng</label>
                    <select class="form-control select2-tag" name="use" required="">
                        <option value="">Chọn hoặc thêm cách dùng</option>
                        <option value="Sáng 1 viên">Sáng 1 viên</option>
                        <option value="Trưa 1 viên">Trưa 1 viên</option>
                        <option value="Tối 1 viên">Tối 1 viên</option>
                        <option value="Sáng tối mỗi buổi 1 viên">Sáng tối mỗi buổi 1 viên</option>
                    </select>
                </div>

                <div class="col-lg-1">
                    <label>Thao tác</label>
                    <input data-repeater-delete="" type="button" class="btn btn-danger btn-block" value="Xóa">
                </div>
            </div>
            @endif
        </div>
        <input data-repeater-create="" type="button" class="btn btn-success mt-3 mt-lg-0" value="Thêm">
    </div>
</div>

<div class="card">
    <div class="card-body">
        <button type="submit" class="btn btn-primary mr-1 waves-effect waves-light">Lưu lại</button>
        <a href="{{ isset($health_certification_id) ? route('health_certifications.index') : route('prescriptions.index') }}" class="btn btn-secondary waves-effect">Quay lại</a>
    </div>
</div>