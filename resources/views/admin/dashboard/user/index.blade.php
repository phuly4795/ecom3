@extends('admin.dashboard.Layout')

@section('content')
    @include('admin.dashboard.components.breadcrumb', ['title' => $config['title']])
    <div class="row mt-2">
        <div class="col-lg-12 ">
            <div class="ibox float-e-margins">
                @include('admin.dashboard.user.components.toolbox', ['tableHeading' => $config['tableHeading']])
                <div class="ibox-content">
                    @include('admin.dashboard.user.components.filter')
                    @include('admin.dashboard.user.components.table')
                    {{ $listUser->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('css/plugins/switchery/switchery.css') }}" rel="stylesheet">
    <style>
        .tableHeading {
            text-transform: uppercase
        }

        .imageCover {
            height: 65px;
            display: block
        }

        .tableImage {
            width: 100%;
            height: 100%;
            object-fit: cover
        }

        table strong {
            min-width: 88px;
            display: inline-block
        }

        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tbody>tr>td {
            vertical-align: middle
        }
    </style>
@endsection

@section('js')
    <!-- Switchery -->
    <script src="{{ asset('js/plugins/switchery/switchery.js') }}"></script>
    <script>
        (function($){
            "use strict";
            var HT = {};
            var document = $(document);

            HT.switchery = () => {
                $('.js-switch_2').each(function() {
                    var switchery = new Switchery(this, { color: '#ED5565'});
                })
            }

            document.ready(function(){
                HT.switchery();
            });

        })(jQuery);


 
    </script>
@endsection
