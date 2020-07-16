@extends('layouts.connect')
@section('content')
    <div id="app-login">
        <form method="POST" action="" data-parsley-validate>
            <div class="d-flex align-items-center justify-content-center bg-br-primary ht-100v">
                <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
                    <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span>Stock<span class="tx-info">Gestion</span> <span class="tx-normal">]</span></div>
                    <div class="tx-center mg-b-60">Voyez de plus prêt l'évolution de votre entreprise</div>
                    @csrf
                    <div class="form-group">
                        <input @blur="load" v-model.trim.lazy="username" type="text"  name="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('Email ou nom d\'utilisateur') }}" required>
                        @error('email')
                        <ul class="parsley-errors-list filled" id="parsley-id-5">
                            <li class="parsley-required">{{ $message }}</li>
                        </ul>
                        @enderror
                    </div><!-- form-group -->
                    <div class="form-group">
                        <input @blur="load" v-model.lazy="password" type="password" name="password" class="form-control" placeholder="{{ __('Mot de passe') }}" required>
                        <a href="" class="tx-info tx-12 d-block mg-t-10">Mot de passe oublié?</a>
                    </div><!-- form-group -->
                    <button @click="spinner" type="submit" id="send" class="btn btn-info btn-block" style="cursor: pointer" :style="loading ? 'padding-top: 0 !important; padding-bottom: 0 !important; transition: padding .3s' : ''">Se connecter</button>

                    <div class="mg-t-60 tx-center"></div>
                </div><!-- login-wrapper -->
            </div><!-- d-flex -->
        </form>
    </div>
@endsection

@section('js-script')
    <script src="{{ asset('js/app-login.js') }}"></script>
@endsection
