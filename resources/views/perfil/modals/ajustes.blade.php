<div class="modal fade" id="infoUsu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('profile.edit.popup') <b> {{ $user->alias }}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('perfil.foto') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="formFile" class="form-label">@lang('profile.edit.photo')</label>
                        <input class="form-control" type="file" id="inputPhotoUser" name="img">
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" id="btnUploadPhotoUser" disabled type="submit">@lang('profile.edit.photo.save')</button>
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
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        @lang('profile.pass')
                    </button>
                    <button type="button" class="btn btn-primary " id="btnEmail" data-bs-toggle="modal2" data-bs-target="#staticBackdrop1">
                        @lang('profile.email')
                    </button>
                    <button type="button" class="btn btn-danger" id="btnDelAcc" data-bs-toggle="modal3" data-bs-target="#staticBackdrop3">
                        @lang('profile.deleteAccount')
                    </button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('profile.edit.close')</button>
                    <button type="submit" class="btn btn-primary">@lang('profile.edit.save')</button>
                </div>
            </form>
        </div>

        </div>
    </div>
</div>
@include('perfil.modals.changeEmail')

@include('perfil.modals.changepass')
@include('perfil.modals.deleteAccount')
