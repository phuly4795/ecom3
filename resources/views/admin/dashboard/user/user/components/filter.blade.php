<form action="" method="GET">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="perpage">
                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <select name="perpage" class="form-control input-sm perpage filter mr10">
                        @for ($i = 20; $i <= 200; $i += 20)
                            <option {{ request('perpage') && request('perpage') == $i ? 'selected' : '' }}
                                value="{{ $i }}">{{ $i }} bản ghi</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    <select name="user_catalogue_id" class="form-control mr10">
                        <option value="0">Chọn nhóm thành viên</option>
                        @foreach ($listCatalogue as $item)
                            <option {{ $item->id == request('user_catalogue_id') ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <div class="uk-search uk-flex uk-flex-middle mr10">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ request('keyword') ?? old('keyword') }}"
                                placeholder="Nhập từ khóa bạn muốn tìm kiếm..." class="form-control">
                            <span class="input-group-btn">
                                <button type="submit" value="search" name="search"
                                    class="btn btn-primary mb0 btn-sm">Tìm kiếm</button>
                            </span>
                        </div>
                    </div>
                    <a href=" {{ route('user.create') }} " class="btn btn-danger"><i class="fa fa-plus mr5"></i>Thêm
                        thành
                        viên mới</a>
                </div>
            </div>
        </div>
    </div>

</form>
