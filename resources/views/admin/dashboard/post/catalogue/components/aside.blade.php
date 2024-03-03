<div class="ibox">
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <label class="text-left control-label">Chọn danh mục cha <span class="required">(*)</span>
                    </label>
                    <div class="text-danger noti mb-2">Chọn Root nếu không có danh mục cha</div>
                    <select name="parent_id" id="" class="form-control select2">
                        @foreach ($dropdown as $key => $item)
                            <option {{ old('parent_id') == $key ? 'selected' : '' }} value="{{ $key }}">
                                {{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>Chọn ảnh đại diện</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <span class="image img-cover img-target">
                        <img src="{{ old('img-target') ?? asset('/img/no-image.jpg') }}" alt="no-image">
                    </span>
                    <input type="hidden" name="image" value="{{ old('img-target') }}">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ibox">
    <div class="ibox-title">
        <h5>Cấu hình nâng cao</h5>
    </div>
    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12">
                <div class="form-row">
                    <div class="mb15">
                        <select name="is_active" id="" class="form-control select2">
                            @foreach (config('apps.general.publish') as $key => $val)
                                <option {{ old('is_active') == $key ? 'selected' : '' }} value="{{ $key }}">
                                    {{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <select name="follow" id="" class="form-control select2">
                        @foreach (config('apps.general.follow') as $key => $val)
                            <option {{ old('follow') == $key ? 'selected' : '' }} value="{{ $key }}"
                                value="{{ $key }}">{{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="btn-submit">
    <button class="btn btn-success w100">Submit</button>
</div>
