@extends('layouts.connect')
@section('conten')
    <form method="post" action="form-validation.html" data-parsley-validate>
        <div class="wd-300">
            <div class="d-flex mg-b-30">
                <div class="form-group mg-b-0">
                    <label>Firstname: <span class="tx-danger">*</span></label>
                    <input type="text" name="firstname" class="form-control wd-250" placeholder="Enter firstname" required>
                </div><!-- form-group -->
                <div class="form-group mg-b-0 mg-l-20">
                    <label>Lastname: <span class="tx-danger">*</span></label>
                    <input type="text" name="lastname" class="form-control wd-250" placeholder="Enter lastname" required>
                </div><!-- form-group -->
            </div><!-- d-flex -->
            <button type="submit" class="btn btn-info">Validate Form</button>
        </div>
    </form>
@endsection
@section('content')
    <div id="app-register" class="row no-gutters flex-row-reverse ht-100v">
      <div class="col-md-6 bg-gray-200 d-flex align-items-center justify-content-center">
        <div class="login-wrapper wd-250 wd-xl-350 mg-y-30">
          <h4 class="tx-inverse tx-center">Inscription</h4>
          <p class="tx-center mg-b-60">Creéz un compte proprietaire.</p>
            <form id="formRegister" method="POST" action="{{ route('admin.register') }}" data-parsley-validate>
                @csrf
              <div class="form-group">
                <input v-model.trim.lazy="firstname" @blur="validFirstname" type="text" name="firstname"  id="firstname"  class="form-control" placeholder="{{ __('Prénom(s)') }}" data-parsley-partern="/^[a-z][a-z ]+/gi" required>
              </div><!-- form-group -->
              <div class="form-group">
                  <input v-model.trim.lazy="lastname" @blur="validLastname" type="text" name="lastname" id="lastname" class="form-control" placeholder="{{ __('Nom') }}" data-parsley-partern="/^[a-z][a-z ]+/gi" required>
              </div><!-- form-group -->
              <div class="form-group">
                <input v-model.trim.lazy="email" @blur="validEmail" type="email" name="email" id="email" class="form-control" placeholder="{{ __('Ex: exemple@test.fr') }}" data-parsley-type="email" required>
              </div><!-- form-group -->
              <div class="form-group">
                <input v-model.trim.lazy="password" @blur="validPass" type="password" name="password" id="password" class="form-control" placeholder="{{ __('Mot de passe') }}" data-parsley-minlenght="8" required>
              </div><!-- form-group -->
                <div class="form-group">
                    <input v-model.trim="passConfirm" @blur="validPassConf" @keyup="validPassConf" type="password" name="passConfirm" id="passConfirm" class="form-control" placeholder="{{ __('Confirmez le mot de passe') }}" data-parsley-minlenght="8" required>
                </div><!-- form-group -->
              <div class="d-flex justify-content-center align-items-center form-group tx-12">
                  <label class="ckbox">
                      <input v-model="agree" type="checkbox" name="checked">
                      <span>J'accepte les <a href="#" class="tx-info">conditions d'utilisation</a>.</span>
                  </label>
              </div>
              <button @click.prevent="spinner" type="submit" id="send" class="btn btn-info btn-block" style="cursor: pointer" :style="loading ? 'padding-top: 0 !important; padding-bottom: 0 !important; transition: padding .3s' : ''">S'inscrire</button>
          </form>
          <div class="mg-t-60 tx-center">Vous êtes déjà membre? <a href="{{ route('admin.login') }}" class="tx-info">Connectez vous</a></div>
        </div><!-- login-wrapper -->
      </div><!-- col -->
      <div class="col-md-6 bg-br-primary d-flex align-items-center justify-content-center">
        <div class="wd-250 wd-xl-450 mg-y-30">
          <div class="signin-logo tx-28 tx-bold tx-white"><span class="tx-normal">[</span>Stock<span class="tx-info">Gestion</span><span class="tx-normal">]</span></div>
          <div class="tx-white-7 mg-b-60">Voyez de plus prêt l'évolution de votre entreprise</div>

          <h5 class="tx-white">Pourquoi Stock<span class="tx-info">Gestion</span>?</h5>
          <p class="tx-white-6">When it comes to websites or apps, one of the first impression you consider is the design. It needs to be high quality enough otherwise you will lose potential users due to bad design.</p>
          <p class="tx-white-6 mg-b-60">When your website or app is attractive to use, your users will not simply be using it, they’ll look forward to using it. This means that you should fashion the look and feel of your interface for your users.</p>
          <a href="#" class="btn btn-outline-light bd bd-white bd-2 tx-white pd-x-25 tx-uppercase tx-12 tx-spacing-2 tx-medium">Purchase Template</a>
        </div><!-- wd-500 -->
      </div>
    </div><!-- row -->
@endsection
@section('js-script')
    <script src="{{ asset('js/app-register.js') }}"></script>
    <script>{{ 'console.log('.json_encode($errors).')' }}</script>
@endsection
