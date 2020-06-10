<h3>@lang('changeEmail.emailPart1')<a href="{{ url('/email/verify/'.$token) }}">{{ config('app.url') }}/email/verify/{{$token}}</a>
    @lang('changeEmail.emailPart2')
</h3>
