@extends('admin.dashboard.Layout')


@section('content')
    @include('admin.dashboard.components.breadcrumb', ['title' => $config['title']])
    @if ($errors->any())
        <div class="alert alert-danger mt-1">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('post-catalogue.store') }}" method="POST">
        @csrf
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
    </form>
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
                object.find('img').attr('src', fileUrl);
                object.siblings('input').val(fileUrl);
            }
            finder.popup();
        }

        setUpCKEditor = () => {
            if ($(".ck-editor")) {
                $(".ck-editor").each(function() {
                    let editor = $(this);
                    let elementId = editor.attr("id");
                    let elementHeight = editor.attr("data-height");

                    Ckedit4(elementId, elementHeight)
                })
            }
        }

        Ckedit4 = (elementId, elementHeight) => {
            if (typeof(elementHeight) == "undefined") {
                elementHeight = 500;
            }
            CKEDITOR.replace(elementId, {
                height: elementHeight,
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
            $('.img-target').on("click", function() {
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

    <script>
        seoReview = () => {
            $("input[name=meta_title]").on("keyup", function() {
                let input = $(this);
                let value = input.val();
                $(".meta_title").html(value);
            })

            $("input[name=canonical").css({
                "padding-left": parseInt($(".baseUrl").outerWidth()) + 5
            })

            $("input[name=canonical").on("keyup", function() {
                let input = $(this);
                let value = input.val();
                $(".canonical").html(BASE_URL + value + SUFFIX);
            })

            $("textarea[name=meta_description").on("keyup", function() {
                let input = $(this);
                let value = input.val();
                $(".meta_description").html(value);
            })


        }

        $(document).ready(function() {
            seoReview();
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
