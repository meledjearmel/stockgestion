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
