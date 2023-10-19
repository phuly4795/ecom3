@extends('admin.dashboard.Layout')

@section('content')
    @include('admin.dashboard.components.breadcrumb', ['title' => $config['title']])
    <div class="row mt-2">
        <div class="col-lg-12 ">
            <div class="ibox float-e-margins">
                @include('admin.dashboard.user.user.components.toolbox', [
                    'tableHeading' => $config['tableHeading'],
                ])
                <div class="ibox-content">
                    @include('admin.dashboard.components.modal', [
                        'modalHeading' => $config['modalHeading'],
                        'status' => 'warning',
                    ])
                    @include('admin.dashboard.user.user.components.filter')
                    @include('admin.dashboard.user.user.components.table')

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

        .d-flex {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: space-around;
            align-items: center;
        }
    </style>
@endsection

@section('js')
    <!-- Switchery -->
    <script src="{{ asset('js/plugins/switchery/switchery.js') }}"></script>
    <script>
        (function($) {
            "use strict";
            var HT = {};
            var document = $(document);

            HT.switchery = () => {
                $('.js-switch_2').each(function() {
                    var switchery = new Switchery(this, {
                        color: '#ED5565'
                    });
                })
            }

            document.ready(function() {
                HT.switchery();
            });

        })(jQuery);
    </script>

    <script>
        $('.status').on('change', function() {
            const _this = $(this); // Define _this as the current element with the 'status' class.
            const id = _this.attr('data-status');
            console.log(id);
            $.ajax({
                url: "{{ route('user.updateStatus') }}", // Sử dụng biến id trong URL
                type: 'get',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error: ' + textStatus + ' ' + errorThrown);
                }
            });
        });

        // update status muti
        $('#change-all').on('click', function() {
            let _this = $(this);
            let id = []
            let field = $('.checkboxItem').attr('data-field')
            let valueInput = $('.checkboxItem').attr('data-value')
            $('.checkboxItem').each(function() {
                let checkBox = $(this);
                if (checkBox.prop('checked')) {
                    id.push(checkBox.val())
                }
            });
            let option = {
                id: id,
                field: field,
                value: valueInput,
            };
            $.ajax({
                url: "{{ route('user.updateStatusMultiple') }}", // Sử dụng biến id trong URL
                type: 'get',
                dataType: 'json',
                data: option,
                success: function(res) {
                    if (res.flag == true) {
                        let cssActive1 =
                            'background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s; box-shadow: 0.4s ease 0s; backgroud-color: 1.2 ease 0s;';
                        let cssActive2 =
                            'left: 20px; background-color: rgb(255, 255, 255); transition: background-color: 0.4s ease 0s, left 0.2s ease 0s;'
                        if (option.value == 1) {
                            for (let i = 0; i < id.length; i++) {
                                $('.js-switch-' + id[i]).find('span.switchery').attr('style',
                                    cssActive1).find('small').attr('style', cssActive2)

                            }
                        }
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error: ' + textStatus + ' ' + errorThrown);
                }
            });
        });
    </script>

    <script>
        $('#checkAll').on('click', function() {
            let isCheckAll = $(this).prop('checked')

            $('.checkboxItem').prop('checked', isCheckAll);
            $('.checkboxItem').each(function() {
                let _this = $(this);
                if (_this.prop('checked')) {
                    _this.closest('tr').addClass('active-bg')
                } else {
                    _this.closest('tr').removeClass('active-bg')
                }
            });

        });

        $('.checkboxItem').on('click', function() {
            let _this = $(this);
            changeBackground(_this)
        });

        changeBackground = (object) => {
            let isChecked = object.prop('checked');
            if (isChecked) {
                object.closest('tr').addClass('active-bg')
            } else {
                object.closest('tr').removeClass('active-bg')
            }
        }
    </script>
@endsection
