@extends('admin.dashboard.Layout')


@section('content')
    @include('admin.dashboard.components.breadcrumb', ['title' => $config['title']])
    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <div class="ibox float-e-margins">
                @include('admin.dashboard.user.user.components.toolbox', [
                    'tableHeading' => $config['info'],
                ])
                <div class="ibox-content">
                    @php
                        $action = $method == 'create' ? route('user.store') : route('user.update', ['id' => $infoUser->id]);
                    @endphp
                    <form action="{{ $action }}" method="POST" class="form-horizontal">
                        @csrf
                        @if ($method == 'update')
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Họ tên <span class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', !empty($infoUser) ? $infoUser->name : '') }}">
                                @if ($errors->has('name'))
                                    <span class="error-message"> * {{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email <span class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="email" class="form-control"
                                    value="{{ old('email', !empty($infoUser) ? $infoUser->email : '') }}">
                                @if ($errors->has('email'))
                                    <span class="error-message"> * {{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ngày sinh</label>
                            <div class="col-sm-10">
                                <input type="date" name="birthday" class="form-control"
                                    value="{{ old('birthday', !empty($infoUser) ? date('Y-d-m', strtotime($infoUser->birthday)) : '') }}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nhóm thành viên <span class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <select name="user_catalogue_id" class="form-control" name="">
                                    @foreach ($listCatalogue as $key => $item)
                                        <option
                                            {{ $item->id == old('user_catalogue_id', !empty($infoUser->user_catalogue_id) ? $infoUser->user_catalogue_id : '') ? 'selected' : '' }}
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('user_catalogue_id'))
                                    <span class="error-message"> * {{ $errors->first('user_catalogue_id') }}</span>
                                @endif
                            </div>
                        </div>
                        @if ($method == 'create')
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
                        @endif
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Ảnh đại diện</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control input-image" id="upload-image" name="image"
                                    value="{{ old('image', !empty($infoUser) ? $infoUser->image : '') }}">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Thành Phố</label>
                            <div class="col-sm-4">
                                <select name="province_id" class="form-control province select2 local"
                                    data-target="district">
                                    <option value="0">[Chọn Thành Phố]</option>
                                    @if (!empty($location['province']))
                                        @foreach ($location['province'] as $province)
                                            <option @if (old('province') == $province->code) selected @endif
                                                value="{{ $province->code }}">{{ $province->full_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">Quận/Huyện</label>
                            <div class="col-sm-4">
                                <select name="district_id" class="form-control district select2 local" data-target="ward">
                                    <option value="0">[Chọn Quận/Huyện]</option>
                                </select>
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phường/Xã</label>
                            <div class="col-sm-4">
                                <select name="ward_id" class="form-control ward select2">
                                    <option value="0">[Chọn Phường/Xã]</option>
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">Địa chỉ</label>
                            <div class="col-sm-4">
                                <input type="text" name="address" class="form-control"
                                    value="{{ old('address', !empty($infoUser) ? $infoUser->address : '') }}">
                            </div>

                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Số điện thoại</label>
                            <div class="col-sm-4">
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', !empty($infoUser) ? $infoUser->phone : '') }}">
                            </div>

                            <label class="col-sm-2 control-label">Ghi chú</label>
                            <div class="col-sm-4">
                                <input type="text" name="note" class="form-control"
                                    value="{{ old('note', !empty($infoUser) ? $infoUser->note : '') }}">
                            </div>

                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="submit">Cancel</button>
                                @if ($method == 'update')
                                    <button class="btn btn-primary" type="submit">Cập nhật thành viên</button>
                                @else
                                    <button class="btn btn-primary" type="submit">Thêm thành viên</button>
                                @endif
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
    <script src="{{ asset('plugin/ckfinder_2/ckfinder.js') }} "></script>
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
        var province_id = '{{ !empty($infoUser->province_id) ? $infoUser->province_id : old('province_id') }}'
        var district_id = '{{ !empty($infoUser->district_id) ? $infoUser->district_id : old('district_id') }}'
        var ward_id = '{{ !empty($infoUser->ward_id) ? $infoUser->ward_id : old('ward_id') }}'

        loadCity = () => {
            if (province_id != "") {
                $('.province').val(province_id).trigger('change');
            }

        }
    </script>


    <script>
        setUpCK = (object, type) => {
            if (typeof(type) == "undefined") {
                type = "Images";
            }

            var finder = new CKFinder();
            finder.resourceType = type;
            finder.selectActionFunction = function(fileUrl, data) {
                object.val(fileUrl);

            }
            finder.popup();
        }

        $(document).ready(function() {
            $('#upload-image').on("click", function() {
                let input = $(this);
                let type = input.attr("data-type");
                setUpCK(input, type);
            });
        });
    </script>
@endsection
