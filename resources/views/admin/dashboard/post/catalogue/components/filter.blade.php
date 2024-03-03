<form action="" method="GET">
    <div class="filter-wrapper">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div class="perpage">
                {{-- <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <select name="perpage" class="form-control input-sm perpage filter mr10">
                        @for ($i = 20; $i <= 200; $i += 20)
                            <option {{ request('perpage') &&  request('perpage') == $i ? 'selected'  : ""}} value="{{ $i }}">{{ $i }} bản ghi</option>
                        @endfor
                    </select>
                </div> --}}
            </div>

            <div class="action">
                <div class="uk-flex uk-flex-middle">
                    <?php
                    $isAcitve = [
                        '-1' => 'Tất cả',
                        '0' => 'Không xuất bản',
                        '1' => 'Xuất bản',
                    ];
                    ?>
                    <select name="is_active" class="form-control mr10">
                        @foreach ($isAcitve as $key => $value)
                            <option {{ request('is_active') == $key ? 'selected' : '' }} value="{{ $key }}">
                                {{ $value }}</option>
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
                    <a href=" {{ route('post-catalogue.create') }} " class="btn btn-danger"><i
                            class="fa fa-plus mr5"></i>Thêm nhóm bài viết</a>
                </div>
            </div>
        </div>
    </div>

</form>
