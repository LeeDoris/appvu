<div id="chatter" class="chatter_home" style="font-family: 'lato';">
    <div class="row">
        @if(Session::has('chatter_alert'))
            <div class="chatter-alert alert alert-{{ Session::get('chatter_alert_type') }}">
                <div class="container">
                    <strong><i class="chatter-alert-{{ Session::get('chatter_alert_type') }}"></i> {{ Config::get('chatter.alert_messages.' . Session::get('chatter_alert_type')) }}</strong>
                    {{ Session::get('chatter_alert') }}
                    <i class="chatter-close"></i>
                </div>
            </div>
            <div class="chatter-alert-spacer"></div>
        @endif

        @if (count($errors) > 0)
            <div class="chatter-alert alert alert-danger">
                <div class="container">
                    <p><strong><i class="chatter-alert-danger"></i> {{ Config::get('chatter.alert_messages.danger') }}</strong> Please fix the following errors:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="col-md-12 right-column">
            <div class="panel">
                <button class="btn btn-primary" id="new_discussion_btn"><i class="fa fa-plus-circle"></i> New Comment</button>
                <ul class="discussions">
                    @foreach($discussions as $discussion)
                            <li data-id="{{ $discussion->id }}" id="comment_discussion">
                                <a class="discussion_list">
                                    <div class="chatter_avatar">
                                        {{--<img src="https://www.gravatar.com/userimage/113327198/954bbb9aa8572226405de1ad87544f8f">--}}
                                        <span class="chatter_avatar_circle" style="background-color:#<?= \App\Discussion::stringToColorCode($discussion->user->email) ?>">
                                            {{ strtoupper(substr($discussion->user->email, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div class="chatter_middle">
                                        <h3 class="chatter_middle_title">{{ $discussion->user->name }}</h3>
                                        <span class="chatter_middle_details">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans() }}</span>
                                        <p> {!! $discussion->body !!}</p>
                                    </div>
                                    <div class="chatter_right">
                                        <div class="chatter_count"><i class="fa fa-reply" id="reply"></i> </div>
                                    </div>
                                    <div class="chatter_clear"></div>
                                </a>
                            </li>
                        {{--@if($discussion->replysCount[0]->total != 0)--}}
                            <div id="chatter" class="discussion" style="padding-left: 50px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="conversation">
                                                <ul class="discussions no-bg" style="display:block;">
                                                    @foreach($replys as $reply)
                                                        @if($reply->chatter_discussion_id == $discussion->id)
                                                            <li data-id="{{ $reply->id }}">
																<span class="chatter_posts">
                                                                    <div class="chatter_avatar">
                                                                        {{--<img src="https://www.gravatar.com/userimage/113327198/954bbb9aa8572226405de1ad87544f8f">--}}
                                                                        <span class="small chatter_avatar_circle" style="background-color:#<?= \App\Discussion::stringToColorCode($discussion->user->email) ?>">
                                                                            {{ strtoupper(substr($reply->user->email, 0, 1)) }}
                                                                        </span>
                                                                    </div>
																	<div class="chatter_middle">
                                                                        <h5 class="chatter_middle_title">{{ $reply->user->name }}</h5>
                                                                        <span class="chatter_middle_details">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($reply->created_at))->diffForHumans() }}</span>
                                                                        <p><?= $reply->body ?></p>
                                                                    </div>
																	<div class="chatter_clear"></div>
																</span>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div id="new_discussion" style="font-family: 'Lato';">
        <div class="chatter_loader dark" id="new_discussion_loader">
            <div></div>
        </div>
        <form id="chatter_form_editor" action="" method="POST" style="display: block">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div id="chatter_check_id">
                <input type="hidden" name="" value="">
            </div>
            <div class="row">
                <div class="col-md-11">
                    <p style="margin: 10px;padding-left:20px;font-size: 16px;color: gray" id="comment_title"></p>
                </div>
                <div class="col-md-1">
                    <i class="fa fa-remove" id="chatter-close"></i>
                </div>
            </div><!-- .row -->

            <!-- BODY -->
            <div id="editor">
                <textarea id="body" class="richText" name="body" placeholder="Please comment here..">{{old('body')}}</textarea>
            </div>
            <div id="new_discussion_footer">
                <button id="submit_discussion" class="btn btn-success pull-right"><i class="fa fa-plus-circle"></i>
                    submit</button>
                <a class="btn btn-default pull-right" id="cancel_discussion">Cancel</a>
                <div style="clear:both"></div>
            </div>
        </form>
    </div>

</div>
<script src="{{ asset('/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('/vendor/devdojo/chatter/assets/js/tinymce.js') }}"></script>
<script src="{{ asset('/vendor/devdojo/chatter/assets/vendor/spectrum/spectrum.js') }}"></script>
<script src="{{ asset('/vendor/devdojo/chatter/assets/js/chatter.js') }}"></script>
<script>
    var my_tinymce = tinyMCE;
    $('document').ready(function(){

        $('#tinymce_placeholder').click(function(){
            my_tinymce.activeEditor.focus();
        });
        $('#chatter-close').click(function(){
            $('#new_discussion').slideUp();
            $('#comment_title').append().html('');
//            $('#comment_type').val().html('');
//            $('#comment_type').name().html('');
        });
        $('#cancel_discussion').click(function(){
            $('#new_discussion').slideUp();
            $('#comment_title').append().html('');
//            $('#comment_type').val().html('');
//            $('#comment_type').name().html('');
        });
        $('#new_discussion_btn').click(function(){
            @if(Auth::guest())
                    window.location.href = "/login";
            @else
            $('#new_discussion').slideDown();
            $('#body').focus();
            $('#chatter_form_editor').attr('action', '{{ url('comment/discussion') }}');
            $('#chatter_check_id input').val('{{$post->id}}');
            $('#chatter_check_id input').attr('name','chatter_category_id');
            $('#comment_title').append('New Comment');

            @endif
        });
        $('#reply').click(function(){
            @if(Auth::guest())
                    window.location.href = "/login";
            @else
            $('#new_discussion').slideDown();
            $('#body').focus();
            $('#chatter_form_editor').attr('action', '{{ url('comment/reply') }}');
            $('#comment_title').append('New Reply');
            $('#chatter_check_id input').val($('#comment_discussion').data('id'));
            $('#chatter_check_id input').attr('name', 'chatter_discussion_id');

            @endif
        });

        @if (count($errors) > 0)
            $('#new_discussion').slideDown();
        $('#body').focus();
        @endif
    });
</script>
