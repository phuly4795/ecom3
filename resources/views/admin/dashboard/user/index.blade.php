@extends('admin.dashboard.Layout')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 ">
        <h2>{{config('apps.user.title')}}</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <li class="active">
                <strong>{{config('apps.user.title')}}</strong>
            </li>
        </ol>
    </div>

</div>
<div class="row mt-2">
    <div class="col-lg-12 ">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5 class="tableHeading">{{config('apps.user.title')}}</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox">
                            </th>
                            <th style="width: 150px">Ảnh đại điện</th>
                            <th>Thông tin thành viên</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox">
                            </td>
                            <td>
                                <div class="imageCover">
                                    <img  src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS8FmUXVqZHmza8ov8uBcWOc3E4agtUuCOjBKzFPcQjwA&s"
                                    alt="ảnh đại diện" class="tableImage">
                                </div>                      
                            </td>
                            <td>
                                <div class="info-item"><strong>Họ tên</strong> : Thành Phú</div>
                                <div class="info-item"><strong>Email</strong> : phuly4795@gmail.com</div>
                                <div class="info-item"><strong>SĐT</strong> : 0794248804</div>
                            </td>
                            <td>
                                <div class="address-item"><strong>Địa chỉ</strong> : Nhà trọ 331, Hẻm 330, Nguyễn Văn Linh</div>
                                <div class="address-item"><strong>Phường</strong> : An Khánh</div>
                                <div class="address-item"><strong>Quận</strong> : Ninh Kiều</div>
                                <div class="address-item"><strong>Thành Phố</strong> : Cần Thơ</div>
                            </td>
                            <td>
                                <input type="checkbox" class="js-switch_2" checked />
                            </td>
                        </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="{{asset('css/plugins/switchery/switchery.css')}}" rel="stylesheet">
<style>
    .tableHeading {
        text-transform: uppercase
    }

    .imageCover{
        height: 65px;
        display: block
    }
    .tableImage{
        width: 100%;
        height: 100%;
        object-fit: cover
    }

    table strong{
        min-width: 88px;
        display: inline-block
    }
    .table > thead > tr > th, 
    .table > tbody > tr > th,
    .table > tbody > tr > td
    
    {
        vertical-align: middle
    }
</style>
@endsection

@section('js')
<!-- Switchery -->
<script src="{{asset('js/plugins/switchery/switchery.js')}}"></script>
<script>
    var elem_2 = document.querySelector('.js-switch_2');
            var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });
</script>
@endsection