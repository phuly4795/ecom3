<div class="seo-container">
    <div class="meta_title">
        {{ old('meta_title') ?? 'Bạn chưa có tiêu đề SEO' }}
    </div>
    <div class="canonical">
        {{ old('canonical') ? config('app.url') . old('canonical') . config('apps.general.suffix') : 'https://duong-dan-cua-ban.html' }}
    </div>
    <div class="meta_description">
        {{ old('meta_description') ?? 'Bạn chưa có mô tả SEO' }}
    </div>
</div>
<div class="seo-wrapper">
    <div class="row mb15">
        <div class="col-lg-12">
            <div class="form-row">
                <label class="text-left control-label" style="width: 100%">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <span>Tiêu đề SEO</span>
                        <span class="count_meta-title">0 ký tự</span>
                    </div>
                </label>
                <input type="text" name="meta_title" class="form-control" autocomplete="off"
                    value="{{ old('meta_title') }}">
            </div>
        </div>
    </div>
    <div class="row mb15">
        <div class="col-lg-12">
            <div class="form-row">
                <label class="text-left control-label" style="width: 100%">
                    <span>Từ khóa SEO</span>
                </label>
                <input type="text" name="meta_keyword" class="form-control" autocomplete="off"
                    value="{{ old('meta_keyword') }}">
            </div>
        </div>
    </div>
    <div class="row mb15">
        <div class="col-lg-12">
            <div class="form-row">
                <label class="text-left control-label" style="width: 100%">
                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                        <span>Mô tả SEO</span>
                        <span class="count_meta-description">0 ký tự</span>
                    </div>
                </label>
                <textarea type="text" name="meta_description" class="form-control" autocomplete="off" rows="10">{{ old('meta_description') }}</textarea>

            </div>
        </div>
    </div>
    <div class="row mb15">
        <div class="col-lg-12">
            <div class="form-row">
                <label class="text-left control-label" style="width: 100%">
                    <span>Đường dẫn <span class="required">(*)</span></span>
                </label>
                <div class="input-wrapper">
                    <input type="text" name="canonical" class="form-control" autocomplete="off"
                        value="{{ old('canonical') }}">
                    <span class="baseUrl">{{ env('APP_URL') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
