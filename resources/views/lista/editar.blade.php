<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><span id="titulo"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('editSerieUsu') }}">
                    {{ method_field('PUT') }}
                        @csrf
                    <div class="row">
                        <input type="hidden" id="idUsuM" name="idUsu" value="{{ $user->idUsu }}" >
                        <input type="hidden" id="idSeM" name="idSe" value="" >
                        <input type="hidden" id="tit" name="tit" value="" >
                        <div class="col-sm-3">
                            <label for="status" class="col-md-6">@lang('list.status')</label>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control selEst" name="status" >

                                @foreach($estados as $estado)
                                    <option>{{ $estado == "Para_Ver" ? "Para Ver" : $estado }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="status" class="col-md-5">@lang('list.episodes')</label>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group-append">
                                <input  type="number" class="form-control" value=""  id="cap" name="cap" >
                                <span class="input-group-text" id="basic-addon2">/ 12</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="coment">@lang('list.comment')</label>
                        </div>
                        <div class="col-sm-8">
                            <label>
                                <textarea class="form-control" name="coment" id="rev" cols="60" maxlength="254" ></textarea>
                            </label>
                        </div>
                    </div>

                    <hr>
                    <div>
                        <button type="button" class="btn btn-info btnfav" id="favA" data-opefav="1">@lang('list.favAdd')</button>
                        <button type="button" class="btn btn-danger btnfav" id="favD" data-opefav="0">@lang('list.favdel')</button>
                        <button type="button" class="btn btn-danger" id="btnd">@lang('list.del')</button>
                        <button class="btn btn-primary btnSendF" id="btnLoading" type="button" hidden disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            @lang('list.update')
                        </button>

                    </div>
                    <hr>
                    <div>
                        @lang('list.fecSts') <span id="fec_ini"></span>
                        <br>
                        @lang('list.fecEnd') <span id="fec_fin"></span>
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
@include('serie.borradoConfirmacion')
