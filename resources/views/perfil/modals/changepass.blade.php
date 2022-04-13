<!-- Modal -->
<div class="modal modal1 fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">@lang('profile.pass')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('perfil.password') }}">
                    <div class="form-group">
                        @csrf
                        <input type="hidden" name="idUsu" value="{{ $user->idUsu }}" >
                        <label for="pass">@lang('profile.pass1')</label>
                        <input type="password" class="form-control pass" id="pass" name="pass"  maxlength="50" required>
                        <button type="button" class="btn btn-danger passreq" hidden>@lang('messages.register.passV')</button>

                    </div>
                    <div class="form-group">
                        @csrf
                        <label for="pass1">@lang('profile.pass2')</label>
                        <input type="password" class="form-control passcon" id="pass1" name="pass1"  maxlength="50" required>
                        <button type="button" class="btn btn-danger passfail" hidden>@lang('messages.register.passC')</button>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('profile.edit.close')</button>
                        <button type="submit" class="btn btn-primary" id="env">@lang('profile.edit.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
