<div>
    @if ($photo)
        <div id="modaldemo1" class="modal fade" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-vertical-center" role="document">
                <div class="modal-content bd-0 tx-14">
                    <div class="modal-header pd-y-20 pd-x-25">
                        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Image Preview</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pd-25">
                        <figure class="overlay">
                            <img src="{{ $photo->temporaryUrl() }}" class="img-fluid" alt="">
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

    <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-layout form-layout-2">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Code de l'article: <span class="tx-danger">*</span></label>
                        <input wire:model="code" class="form-control tx-uppercase" maxlength="8" type="text" name="code" value="{{ old('code') }}" placeholder="Entrer le code de l'article">
                        @error('code')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-control-label">Le prix de l'article: <span class="tx-danger">*</span></label>
                        <input wire:model="price" class="form-control" type="number" name="price" value="{{ old('price') }}" placeholder="Entrer le prix de l'article">
                        @error('price')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-4 ">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-5">
                                <label class="form-control-label">L'image de l'article: </label>
                                <input wire:model="photo" type="file" name="img_url" id="file-2" accept=".jpg, .jpeg, .png, .svg" class="inputfile">
                                <label for="file-2" class="if-outline if-outline-info">
                                    <i class="icon ion-ios-upload-outline tx-20"></i>
                                    @if ($photo)
                                        Changer d'image
                                    @else
                                        Choisir une image
                                    @endif
                                </label>
                            </div>
                            <div class="col-7 d-flex justify-content-end align-items-center">
                                @if ($photo)
                                    <a href="#" data-toggle="modal" data-target="#modaldemo1">
                                        <img src="{{ $photo->temporaryUrl() }}" height="67px" style="padding: 0.25rem;background-color: #E9ECEF;border: 1px solid #ddd;border-radius: 3px;transition: all 0.2s ease-in-out;" title="Cliquez pour agrandir">
                                    </a>
                                @endif
                            </div>
                        </div>
                        @error('img_url')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Le libélé de l'article: <span class="tx-danger">*</span></label>
                        <input wire:model="name" class="form-control" type="text" name="name" value="{{ old('name') }}" placeholder="Entrer le libélé de l'article">
                        @error('name')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label">Description de l'article: </label>
                        <input wire:model="caracts" class="form-control" type="text" name="caracts" value="{{ old('caracts') }}" placeholder="Decriver l'article">
                        @error('caracts')
                        <ul class="parsley-errors-list filled" id="parsley-id-26">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div>
                </div><!-- col-4 -->
            </div><!-- row -->
            <div class="d-flex justify-content-between form-layout-footer bd pd-20 bd-t-0">
                <div>
                    <button class="btn btn-info">Creer</button>
                    <button type="reset" class="btn btn-secondary">Effacer</button>
                </div>
                <div>
                    <a href="{{ route('article.index') }}"><button type="button" class="btn btn-outline-success">Voir mes articles</button></a>
                </div>
            </div><!-- form-group -->
        </div><!-- form-layout -->
    </form>
</div>
