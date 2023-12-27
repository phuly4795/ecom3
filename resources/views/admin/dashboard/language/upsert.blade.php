@extends('admin.dashboard.Layout')


@section('content')
    @include('admin.dashboard.components.breadcrumb', ['title' => $config['title']])
    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <div class="ibox float-e-margins">
                @include('admin.dashboard.language.components.toolbox', [
                    'tableHeading' => $config['info'],
                ])
                <div class="ibox-content">
                    @php
                        $action = $method == 'create' ? route('language.store') : route('language.update', ['id' => $infoLanguage->id]);
                    @endphp
                    <form action="{{ $action }}" method="POST" class="form-horizontal">
                        @csrf
                        @if ($method == 'update')
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name <span
                                    class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', !empty($infoLanguage) ? $infoLanguage->name : '') }}">
                                @if ($errors->has('name'))
                                    <span class="error-message"> * {{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Canonical <span
                                class="required">(*)</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="canonical" class="form-control"
                                    value="{{ old('canonical', !empty($infoLanguage) ? $infoLanguage->canonical : '') }}">
                                @if ($errors->has('canonical'))
                                    <span class="error-message"> * {{ $errors->first('canonical') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image </label>
                            <div class="col-sm-10">
                                <input type="file" name="Image" class="form-control"
                                    value="{{ old('Image', !empty($infoLanguage) ? $infoLanguage->Image : '') }}">
                                @if ($errors->has('Image'))
                                    <span class="error-message"> * {{ $errors->first('Image') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-10">
                                <textarea name="note" class="form-control" id="" cols="30" rows="10">{{ old('note', !empty($infoLanguage) ? $infoLanguage->note : '') }}</textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-white" type="submit">Cancel</button>
                                @if ($method == 'update')
                                    <button class="btn btn-primary" type="submit">Cập nhật ngôn ngữ</button>
                                @else
                                    <button class="btn btn-primary" type="submit">Thêm ngôn ngữ</button>
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
