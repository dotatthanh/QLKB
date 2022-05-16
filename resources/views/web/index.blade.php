@extends('layouts.master')

@section('title') Trang chủ @endsection

@section('content')
    <h2 class="title">GIỚI THIỆU</h2>
    <p>
        Với phương châm "Người bệnh đến được đón tiếp niềm nở, ở được chăm sóc tận tình, về được dặn dò chu đáo."Phòng khám Nhân ái mong muốn mang lại tâm lý thoải mái cho người bệnh trong suốt quá trình điều trị
    </p>

    <img src="images/Anh-1-1.jpg" alt="" class="d-block m-auto">
    <p class="text-center font-italic">Hệ thống Y tế Thu Cúc TCI quy tụ đội ngũ bác sĩ, nhân viên y tế giỏi chuyên môn, được đánh giá cao về chất lượng khám chữa bệnh.</p>

    <p class="mt-3">
        Nhiều năm qua, Hệ thống Y tế Thu Cúc TCI đã tạo được uy tín lớn về chất lượng khám chữa bệnh và dịch vụ chăm sóc với cơ sở vật chất hiện đại vượt trội, trang thiết bị y tế tiên tiến, cùng đội ngũ bác sĩ giỏi chuyên môn, giàu y đức. Chất lượng khám chữa bệnh luôn là tiêu chí được khẳng định tại Thu Cúc TCI với sự đánh giá cao từ Sở Y Tế Hà Nội và từ người bệnh. Không chỉ luôn nằm trong Top đầu các bệnh viện có điểm chất lượng cao nhất với 83 tiêu chí khắt khe của Sở Y tế, Bệnh viện ĐKQT Thu Cúc còn được tin chọn là “cánh tay nối dài” của các bệnh viện trung ương với sứ mệnh mang đến dịch vụ y tế tin cậy cho người dân, góp phần giảm tải y tế công. Người bệnh lựa chọn khám chữa bệnh tại đây không chỉ vì tin tưởng mà còn vì hài lòng với phong cách phục vụ tận tình, chu đáo. Tỷ lệ hài lòng khi khám chữa bệnh lên tới 99.9%.
    </p>

    <h2 class="title">LỊCH SỬ</h2>
    <p>
        Chính thức thành lập từ năm 2018, Phòng khám Nhân Ái đang là địa chỉ được đông đảo người bệnh tin chọn tại YP HCM Hà Nội. Tới đây, Phòng khám Nhân Ái sẽ thực hiện nhanh chóng việc mở chuỗi các phòng khám Nhân Ái trên toàn quốc, đưa dịch vụ y tế chất lượng cao đến gần và dễ tiếp cận hơn với người dân cả nước. Mục tiêu này có sự hỗ trợ tích cực từ nguồn vốn 26,7 triệu USD được Quỹ đầu tư danh tiếng Vinacapital rót vào cho Phòng khám Nhân Ái trong tháng 8/2022.
    </p>

    <img src="images/Anh-1-1.jpg" alt="" class="d-block m-auto">
    <p class="text-center font-italic">Hệ thống Y tế Thu Cúc TCI quy tụ đội ngũ bác sĩ, nhân viên y tế giỏi chuyên môn, được đánh giá cao về chất lượng khám chữa bệnh.</p>

    <p class="mt-3">
        Nhiều năm qua, Hệ thống Y tế Thu Cúc TCI đã tạo được uy tín lớn về chất lượng khám chữa bệnh và dịch vụ chăm sóc với cơ sở vật chất hiện đại vượt trội, trang thiết bị y tế tiên tiến, cùng đội ngũ bác sĩ giỏi chuyên môn, giàu y đức. Chất lượng khám chữa bệnh luôn là tiêu chí được khẳng định tại Thu Cúc TCI với sự đánh giá cao từ Sở Y Tế Hà Nội và từ người bệnh. Không chỉ luôn nằm trong Top đầu các bệnh viện có điểm chất lượng cao nhất với 83 tiêu chí khắt khe của Sở Y tế, Bệnh viện ĐKQT Thu Cúc còn được tin chọn là “cánh tay nối dài” của các bệnh viện trung ương với sứ mệnh mang đến dịch vụ y tế tin cậy cho người dân, góp phần giảm tải y tế công. Người bệnh lựa chọn khám chữa bệnh tại đây không chỉ vì tin tưởng mà còn vì hài lòng với phong cách phục vụ tận tình, chu đáo. Tỷ lệ hài lòng khi khám chữa bệnh lên tới 99.9%.
    </p>

    <h2 class="title">ĐỘI NGŨ BÁC SĨ</h2>

    <div class="slider-for">
        @foreach ($doctors as $doctor)
        <div class="item-slider-for">
            <div class="row">
                <div class="col-5 text-center">
                    <img class="img-responsive d-inline-block" src="{{ asset($doctor->avatar) }}" alt="" title="" style="max-width: 100%;">
                </div>
                <div class="col-7">
                    <h4>Họ và tên: {{ $doctor->name }} </h4>
                    {!! $doctor->description !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="slider-nav">
        @foreach ($doctors as $doctor)
        <img class="img-responsive" src="{{ asset($doctor->avatar) }}" alt="" title="">
        @endforeach
    </div>
@endsection

@push('js')
@endpush

@push('css')
@endpush