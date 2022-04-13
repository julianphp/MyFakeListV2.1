<!-- Modal -->
<div class="modal modal3 fade" id="modalDeleteAccount" data-bs-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">@lang('profile.deleteAcc')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>@lang('profile.deleteAccInfo')</span>
                <form method="post" action="{{ route('perfil.delete') }}">
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('profile.edit.close')</button>
                        <button type="submit" class="btn btn-danger" id="env">@lang('profile.deleteCon')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
