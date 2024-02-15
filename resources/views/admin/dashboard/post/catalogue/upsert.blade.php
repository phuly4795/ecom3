@extends('admin.dashboard.Layout')


@section('content')
    @include('admin.dashboard.components.breadcrumb', ['title' => $config['title']])
    <div class="row mt-2">
        <div class="col-lg-9 mb-2">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>
                        Thông tin chung
                    </h5>
                </div>
                <div class="ibox-content">
                    @include('admin.dashboard.post.catalogue.components.general')
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-title">
                    <h5>
                        Cầu hình SEO
                    </h5>
                </div>
                <div class="ibox-content">
                    @include('admin.dashboard.post.catalogue.components.seo')
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            @include('admin.dashboard.post.catalogue.components.aside')
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugin/ckfinder_2/ckfinder.js') }} "></script>
    <script src="{{ asset('plugin/ckeditor/ckeditor.js') }} "></script>
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

        setUpCKEditor = () => {
            if ($(".ck-editor")) {
                $(".ck-editor").each(function() {
                    let editor = $(this);
                    let elementId = editor.attr("id");
                    Ckedit4(elementId)
                })
            }
        }

        Ckedit4 = (elementId) => {
            CKEDITOR.replace(elementId, {
                height: 250,
                removeButtons: '',
                entities: true,
                allowedContent: true,
                toolbarGroups: [{
                        name: "clipboard",
                        groups: ["clipboard", "undo"]
                    },
                    {
                        name: "editing",
                        groups: ["find", "selection", "spellchecker"]
                    },
                    {
                        name: "links"
                    },
                    {
                        name: "inserts"
                    },
                    {
                        name: "forms"
                    },
                    {
                        name: "tools"
                    },
                    {
                        name: "document",
                        groups: ["mode", "document", "doctools"]
                    },
                    {
                        name: "colors"
                    },
                    {
                        name: "others"
                    },
                    "/",
                    {
                        name: "basicstyles",
                        groups: ["basicstyles", "cleanup"]
                    },
                    {
                        name: "paragraph",
                        groups: ["list", "indent", "blocks", "align", "bidi"]
                    },
                    {
                        name: "styles"
                    }
                ]
            })
        }

        $(document).ready(function() {
            $('#Images').on("click", function() {
                let input = $(this);
                let type = input.attr("data-type");
                setUpCK(input, type);
            });
            setUpCKEditor();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection

@section('css')
    <style>
        .required {
            font-size: 15px;
            color: red;
        }
    </style>
@endsection
