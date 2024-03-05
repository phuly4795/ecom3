<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label class="text-left control-label">Tiêu đề nhóm bài viết <span class="required">(*)</span></label>
            <input type="text" name="name" class="form-control" autocomplete="off"
                value="{{ old('name', isset($infoPostCatalogue) ? $infoPostCatalogue->name : '') }}">
        </div>
    </div>
</div>
<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label class="text-left control-label">Mô tả ngắn</label>
            <textarea type="text" name="description" class="form-control ck-editor" id="ck-description" data-height = "500"
                autocomplete="off">{{ old('description', isset($infoPostCatalogue) ? $infoPostCatalogue->description : '') }}</textarea>
        </div>
    </div>
</div>
<div class="row mb15">
    <div class="col-lg-12">
        <div class="form-row">
            <label class="text-left control-label">Nội dung</label>
            <textarea type="text" name="content" class="form-control ck-editor" id="content"
                data-height = "500"autocomplete="off">{{ old('content', isset($infoPostCatalogue) ? $infoPostCatalogue->content : '') }}</textarea>
        </div>
    </div>
</div>
