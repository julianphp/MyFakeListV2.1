<!-- Modal -->
<div class="modal modal2 fade" id="staticBackdrop1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">@lang('profile.changeEmail')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('profile.edit.close')</button>
                        <button type="submit" class="btn btn-primary" id="env">@lang('profile.edit.save')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
