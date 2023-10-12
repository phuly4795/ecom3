@extends('admin.dashboard.Layout')


@section('content')
    @include('admin.dashboard.components.breadcrumb', ['title' => $config['title']])
    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <div class="ibox float-e-margins">
                @include('admin.dashboard.user.components.toolbox', ['tableHeading' => $config['info']])
                <div class="ibox-content">

                    <form action="{{ route('user.store') }}" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Họ tên <span class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="error-message"> * {{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email <span class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="error-message"> * {{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ngày sinh</label>
                            <div class="col-sm-10">
                                <input type="date" name="birday" class="form-control" value="{{ old('birday') }}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nhóm thành viên <span class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <select name="user_catalogue_id" class="form-control" name="">
                                    <option value="0">[Chọn nhóm thành viên]</option>
                                </select>
                                @if ($errors->has('user_catalogue_id'))
                                    <span class="error-message"> * {{ $errors->first('user_catalogue_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mật khẩu <span class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <span class="error-message"> * {{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nhập lại mật khẩu <span
                                    class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="re_password">
                                @if ($errors->has('re_password'))
                                    <span class="error-message"> * {{ $errors->first('re_password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ảnh đại diện</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control input-image" name="file">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Thành Phố</label>
                            <div class="col-sm-4">
                                <select name="province" class="form-control province select2 local" data-target="district">
                                    <option value="0">[Chọn Thành Phố]</option>
                                    @if (!empty($location['province']))
                                        @foreach ($location['province'] as $province)
                                            <option @if (old('province') == $province->code) selected @endif
                                                value="{{ $province->code }}">{{ $province->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">Quận/Huyện</label>
                            <div class="col-sm-4">
                                <select name="district" class="form-control district select2 local" data-target="ward">
                                    <option value="0">[Chọn Quận/Huyện]</option>
                                </select>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phường/Xã</label>
                            <div class="col-sm-4">
                                <select name="ward" class="form-control ward select2">
                                    <option value="0">[Chọn Phường/Xã]</option>
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">Địa chỉ</label>
                            <div class="col-sm-4">
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số điện thoại</label>
                            <div class="col-sm-4">
                                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                            </div>

                            <label class="col-sm-2 control-label">Ghi chú</label>
                            <div class="col-sm-4">
                                <input type="text" name="note" class="form-control" value="{{ old('note') }}">
                            </div>

                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="submit">Cancel</button>
                                <button class="btn btn-primary" type="submit">Thêm thành viên</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .required {
            font-size: 15px;
            color: red;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('plugin/ckfinder_2/ckfinder.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            loadCity();
        });

        $('.local').on('change', function() {
            let _this = $(this)
            let option = {
                'data': {
                    'location_code': _this.val(),
                },
                'target': _this.attr('data-target'),
            }

            sendDataToGetLocation(option);

        });

        sendDataToGetLocation = (option) => {
            $.ajax({
                url: "{{ route('getLocation') }}",
                type: 'GET',
                data: option,
                dataType: 'json',
                success: function(data) {
                    $('.' + option.target).html(data.html)

                    if (district_id != "" && option.target == 'district') {
                        $('.district').val(district_id).trigger('change');
                    }

                    if (ward_id != "" && option.target == 'ward') {
                        $('.ward').val(ward_id).trigger('change');
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                }
            });
        };
    </script>
    <script>
        var province_id = '{{ old('province') }}'
        var district_id = '{{ old('district') }}'
        var ward_id = '{{ old('ward') }}'

        loadCity = () => {
            if (province_id != "") {
                $('.province').val(province_id).trigger('change');
            }

        }
    </script>
@endsection
