<!-- Modal -->
<div class="modal fade" id="modalDeleteSerieFromUserList" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">@lang('anime.deleteTitle')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @lang('anime.deleteText') <span id="md"></span> @lang('anime.deleteText2')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('anime.keep')</button>
                <button type="button" class="btn btn-primary" id="del">@lang('anime.del')</button>
            </div>
        </div>
    </div>
</div>
