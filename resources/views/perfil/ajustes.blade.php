<div class="modal fade" id="infoUsu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('profile.edit.popup') <b> {{ $user->alias }}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('perfil.foto') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="img">
                            <label class="custom-file-label" for="customFile">@lang('profile.edit.photo')</label>
                        </div>

                    </div>
                    <div class="col">
                        <button class="btn btn-primary uplpht" disabled type="submit">@lang('profile.edit.photo.save')</button>
                    </div>
                </form>


            <form method="post" action="{{ route('perfil.infousua') }}">
                <div class="form-group">
                    @csrf
                    <input type="hidden" name="idUsu" value="{{ $user->idUsu }}">
                    <label for="ubicacion">@lang('profile.edit.location')</label>
                    <input type="text" class="form-control" id="location" name="location" aria-describedby="ubicacion" maxlength="499" value="{{ $user->location }}">

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">@lang('profile.edit.about')</label>
                    <input type="text" class="form-control" name="about" maxlength="499" id="about" value="{{ $user->about }}">
                </div>
                <div class="modal-footer">
                    <a href="{{ route('UsoDeApi') }}">Informacion sobre uso de la API.</a>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#staticBackdrop">
                        @lang('profile.pass')
                    </button>
                    <button type="button" class="btn btn-primary " id="btnEmail" data-toggle="modal2" data-target="#staticBackdrop1">
                        @lang('profile.email')
                    </button>
                    <button type="button" class="btn btn-danger" id="btnDelAcc" data-toggle="modal3" data-target="#staticBackdrop3">
                        @lang('profile.deleteAccount')
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('profile.edit.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('profile.edit.save')</button>
                </div>
            </form>
        </div>

        </div>
    </div>
</div>
@include('perfil.changeEmail')

@include('perfil.changepass')
@include('perfil.deleteAccount')
