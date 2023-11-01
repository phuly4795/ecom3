@extends('admin.dashboard.Layout')


@section('content')
    @include('admin.dashboard.components.breadcrumb', ['title' => $config['title']])
    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <div class="ibox float-e-margins">
                @include('admin.dashboard.user.catalogue.components.toolbox', [
                    'tableHeading' => $config['info'],
                ])
                <div class="ibox-content">
                    @php
                        $action = $method == 'create' ? route('user.catalogue.store') : route('user.catalogue.update', ['id' => $infoUser->id]);
                    @endphp
                    <form action="{{ $action }}" method="POST" class="form-horizontal">
                        @csrf
                        @if ($method == 'update')
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tên nhóm thành viên <span
                                    class="required">(*)</span></label>
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
                            <label class="col-sm-2 control-label">Ghi chú</label>
                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ old('note', !empty($infoUser) ? $infoUser->note : '') }}</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="submit">Cancel</button>
                                @if ($method == 'update')
                                    <button class="btn btn-primary" type="submit">Cập nhật nhóm thành viên</button>
                                @else
                                    <button class="btn btn-primary" type="submit">Thêm nhóm thành viên</button>
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
        var province_id = '{{ !empty($infoUser->province_id) ? $infoUser->province_id : old('province_id') }}'
        var district_id = '{{ !empty($infoUser->district_id) ? $infoUser->district_id : old('district_id') }}'
        var ward_id = '{{ !empty($infoUser->ward_id) ? $infoUser->ward_id : old('ward_id') }}'

        loadCity = () => {
            if (province_id != "") {
                $('.province').val(province_id).trigger('change');
            }

        }
    </script>
@endsection
