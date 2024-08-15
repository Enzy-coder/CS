@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('contact_page_name')}}
@endsection
@section('page-title')
    {{get_static_option('contact_page_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('contact_page_meta_description')}}">
    <meta name="tags" content="{{get_static_option('contact_page_meta_tags')}}">
@endsection
@section('content')
    {!! \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_by_location('contactpage') !!}
@endsection
@section('script')
    <script>
        (function ($) {
            "use strict";
            $(document).ready(function () {
                function removeTags(str) {
                    if ((str === null) || (str === '')) {
                        return false;
                    }
                    str = str.toString();
                    return str.replace(/(<([^>]+)>)/ig, '');
                }

                $(document).on('submit', '.custom-form-builder-form', function (e) {
                    e.preventDefault();
                    var form = $(this);
                    var formID = form.attr('id');
                    var msgContainer =  form.find('.error-message');
                    var formSelector = document.getElementById(formID);
                    var formData = new FormData(formSelector);
                    msgContainer.html('');
                    $.ajax({
                        url: "{{route('frontend.form.builder.custom.submit')}}",
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': "{{csrf_token()}}",
                        },
                        beforeSend:function (){
                            form.find('.ajax-loading-wrap').addClass('show').removeClass('hide');
                        },
                        processData: false,
                        contentType: false,
                        data:formData,
                        success: function (data) {
                            form.find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                            msgContainer.html('<div class="alert alert-'+data.type+'">' + data.msg + '</div>');
                        },
                        error: function (data) {
                            form.find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                            var errors = data.responseJSON.errors;
                            var markup = '<ul class="alert alert-danger">';
                            $.each(errors,function (index,value){
                                markup += '<li>'+value+'</li>';
                            })
                            markup += '</ul>';
                            msgContainer.html(markup);
                        }
                    });
                });
            });
        })(jQuery);
    </script>

    @if(!empty(get_static_option('site_google_captcha_v3_site_key')))
        <script src="https://www.google.com/recaptcha/api.js?render={{get_static_option('site_google_captcha_v3_site_key')}}"></script>
        <script>
            grecaptcha.ready(function () {
                grecaptcha.execute("{{get_static_option('site_google_captcha_v3_site_key')}}", {action: 'homepage'}).then(function (token) {
                    document.getElementById('gcaptcha_token').value = token;
                });
            });
        </script>
    @endif
@endsection
