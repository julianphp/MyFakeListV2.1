@if (session('errorPhoto'))
    <div class="alert alert-danger">
        @lang('profile.edit.photoError')
    </div>
@endif
@if (session('errorEmail'))
    <div class="alert alert-danger">
        @lang('profile.errorEmail')
    </div>
@endif
@if (session('errorEmailSend'))
    <div class="alert alert-danger">
        @lang('profile.errorEmailSend')
    </div>
@endif
@if (session('successEmail'))
    <div class="alert alert-info">
        @lang('profile.successEmail',['email' => session('successEmail')])
    </div>
@endif
@if (session('successPhoto') == true)
    <div class="alert alert-info">
        @lang('profile.successPhoto')
    </div>
@endif
@if(session('successMailDelAcc'))
    <div class="alert alert-success" role="alert">
        @lang('profile.successMailDelAcc')
    </div>
@endif


@if(session('pass') == 'ok')
    <div class="alert alert-info">
        @lang('profile.successPass')
    </div>
@endif
@if(session('pass') == 'no')
    <div class="alert alert-danger">
        @lang('profile.successError')
    </div>
@endif
