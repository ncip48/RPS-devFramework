<link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/themefy_icon/themify-icons.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/swiper_slider/css/swiper.min.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/niceselect/css/nice-select.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/owl_carousel/css/owl.carousel.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/gijgo/gijgo.min.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/font_awesome/css/all.min.css') }}" />
<link rel="stylesheet" href="{{ asset('vendors/tagsinput/tagsinput.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/datatable/css/jquery.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('vendors/datatable/css/responsive.dataTables.min.css') }}" />
<link rel="stylesheet" href="{{ asset('vendors/datatable/css/buttons.dataTables.min.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/text_editor/summernote-bs4.css') }}" />

<link rel="stylesheet" href="{{ asset('vendors/morris/morris.css') }}">

<link rel="stylesheet" href="{{ asset('vendors/material_icon/material-icons.css') }}" />

<link rel="stylesheet" href="{{ asset('css/metismenu.css') }}">

<link rel="stylesheet" href="{{ asset('css/style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/colors/default.css') }}" id="colorSkinCSS">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>

<style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }

    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>

{{ $style ?? '' }}
