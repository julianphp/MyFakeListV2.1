<!-- Modal -->
<div class="modal modal2 fade" id="modalChangeEmail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">@lang('profile.changeEmail')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>tu actual correo es: <b>{{ $user->email }}</b></span>
                <form method="post" action="{{ route('email.change') }}">
                    <div class="form-group">
                        @csrf
                        <input type="hidden" name="idUsu" value="{{ $user->idUsu }}" >
                        <label for="email">@lang('profile.changeEmail1')</label>
                        <input type="email" class="form-control email" id="email" name="email" required >


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
