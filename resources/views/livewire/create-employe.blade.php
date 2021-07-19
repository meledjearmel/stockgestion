<div>
    @if ($picture)
        <div id="modaldemo1" class="modal fade" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-vertical-center" role="document">
                <div class="modal-content bd-0 tx-14">
                    <div class="modal-header pd-y-20 pd-x-25">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Photo Preview</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pd-25">
                        <figure class="overlay">
                            <img src="{{ $picture->temporaryUrl() }}" class="img-fluid" alt="">
                            <figcaption class="overlay-body d-flex align-items-end justify-content-center">
                                <div class="img-option">

                                </div>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-dismiss="modal">Reduire</button>
                    </div>
                </div>
            </div><!-- modal-dialog -->
        </div>
    @endif

    <form action="{{ route('employe.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Prenom(s): <span class="tx-danger">*</span></label>
                        <input wire:model="lastname" class="form-control" type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Ex: John">
                        @error('lastname')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Nom: <span class="tx-danger">*</span></label>
                        <input wire:model="name" class="form-control" maxlength="8" type="text" name="name" value="{{ old('name') }}" placeholder="Ex: Doe">
                        @error('name')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Sexe: </label>
                        <div style="justify-content: space-evenly" class="d-flex align-items-center">
                            <label class="rdiobox">
                                <input wire:model="sex" name="sex" value="Masculin" type="radio" checked>
                                <span>Homme</span>
                            </label>
                            <label class="rdiobox">
                                <input name="sex" value="Feminin" type="radio">
                                <span>Femme</span>
                            </label>
                        </div>
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Adresse e-mail: <span class="tx-danger">*</span></label>
                        <input wire:model="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Ex: johndoe@stockgestion.com">
                        @error('email')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Numero de telephone: <span class="tx-danger">*</span></label>
                        <input wire:model="contact" id="phoneMask" class="form-control" type="text" name="contact" value="{{ old('contact') }}" placeholder="(225) 87-614-613">
                        @error('contact')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div style="padding-bottom: 0px;" class="form-group">
                        <div class="row">
                            <div class="col-5">
                                <label class="form-control-label">Photo: </label>
                                <input wire:model="picture" type="file" name="picture" id="file-2" accept=".jpg, .jpeg, .png, .svg" class="inputfile">
                                <label for="file-2" class="if-outline if-outline-info">
                                    <i class="icon ion-ios-upload-outline tx-20"></i>
                                    @if ($picture)
                                        Changer de photo
                                    @else
                                        Choisir une photo
                                    @endif
                                </label>
                            </div>
                            <div class="col-7 d-flex justify-content-end align-items-center">
                                @if ($picture)
                                    <a href="#" data-toggle="modal" data-target="#modaldemo1">
                                        <img src="{{ $picture->temporaryUrl() }}" height="67px" style="padding: 0.25rem;background-color: #E9ECEF;border: 1px solid #ddd;border-radius: 3px;transition: all 0.2s ease-in-out;" title="Cliquez pour agrandir">
                                    </a>
                                @endif
                            </div>
                        </div>
                        @error('picture')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Point de vente: <span class="tx-danger">*</span></label>
                        @if($sellpoints)
                            <select name="sellpoint_id" class="form-control select2-show-search" data-placeholder="Choose Browser">
                                @foreach($sellpoints as $sellpoint)
                                    <option value="{{ $sellpoint->id }}">{{ $sellpoint->name }}</option>
                                @endforeach
                            </select>
                        @else
                            <div class="has-warning">
                                <select name="sellpoint_id" class="form-control select2" data-placeholder="Choose Browser">
                                    <option value="">Aucun entrepot disponible</option>
                                </select>
                            </div>
                        @endif
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Role: <span class="tx-danger">*</span></label>
                        <select name="role" class="form-control select2" data-placeholder="Choisis le role">
                            <option value="admin">Super Administrateur</option>
                            <option value="manager">Manager de stock</option>
                            <option value="seller">Vendeur</option>b1vb23
                        </select>
                    </div>
                </div><!-- col-4 -->

            </div><!-- row -->
            <div class="d-flex justify-content-between form-layout-footer bd pd-20 bd-t-0">
                <div>
                    <button class="btn btn-info">Creer</button>
                    <button type="reset" class="btn btn-secondary">Effacer</button>
                </div>
                <div>
                    <a href="{{ route('employe.index') }}"><button type="button" class="btn btn-outline-success">Voir tout les employes</button></a>
                </div>
            </div><!-- form-group -->
        </div><!-- form-layout -->
    </form>
</div>
