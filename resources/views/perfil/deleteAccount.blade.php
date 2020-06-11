<!-- Modal -->
<div class="modal modal3 fade" id="staticBackdrop2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">@lang('profile.deleteAcc')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>@lang('profile.deleteAccInfo')</span>
                <form method="post" action="{{ route('perfil.delete') }}">
                    @csrf
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('profile.edit.close')</button>
                        <button type="submit" class="btn btn-danger" id="env">@lang('profile.deleteCon')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
