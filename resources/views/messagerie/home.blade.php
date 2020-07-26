@extends('layouts.swup')
@section('content')

    <div class="br-subleft">
        <div class="pd-10">
            <a href="#" class="btn btn-teal bd-0 btn-compose" data-toggle="modal" data-target="#modalCompose"><i class="icon ion-ios-compose-outline"></i> Compose</a>
        </div>

        <nav class="nav br-nav-mailbox flex-column">
            <a href="#" class="nav-link active"><i class="icon ion-ios-filing-outline"></i> Inbox</a>
            <a href="#" class="nav-link"><i class="icon ion-ios-folder-outline"></i> Drafts</a>
            <a href="#" class="nav-link"><i class="icon ion-ios-paperplane-outline"></i> Sent</a>
            <a href="#" class="nav-link"><i class="icon ion-ios-trash-outline"></i> Trash</a>
        </nav>

        <div class="d-flex justify-content-between align-items-center mg-t-20 pd-x-10 bd-b pd-b-5">
            <h6 class="tx-uppercase tx-10 mg-b-0 tx-roboto tx-white-7">My Folder</h6>
            <a href="#" class="tx-uppercase tx-10 tx-info tx-roboto">+ New</a>
        </div>

        <nav class="nav br-nav-mailbox flex-column">
            <a href="#" class="nav-link"><i class="icon ion-ios-folder-outline"></i> Social</a>
            <a href="#" class="nav-link"><i class="icon ion-ios-folder-outline"></i> Promotions</a>
            <a href="#" class="nav-link"><i class="icon ion-ios-folder-outline"></i> Internet</a>
        </nav>

        <div class="d-flex justify-content-between align-items-center mg-t-20 pd-x-10 bd-b pd-b-5">
            <h6 class="tx-uppercase tx-10 mg-b-0 tx-roboto tx-white-7">Labels</h6>
            <a href="#" class="tx-10 tx-uppercase tx-info tx-roboto">+ New</a>
        </div>

        <nav class="nav br-nav-mailbox flex-column">
            <a href="#" class="nav-link"><i class="icon ion-ios-pricetag-outline"></i> Facebook</a>
            <a href="#" class="nav-link"><i class="icon ion-ios-pricetag-outline"></i> Twitter</a>
        </nav>
    </div><!-- br-subleft -->

    <div class="br-mailbox-list">
        <div class="br-mailbox-list-header">
            <a href="#" id="showMailBoxLeft" class="show-mailbox-left hidden-sm-up">
                <i class="fa fa-arrow-right"></i>
            </a>
            <h6 class="tx-inverse mg-b-0 tx-13 tx-uppercase">Inbox <span class="tx-roboto">(2)</span></h6>
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-light disabled pd-x-25"><i class="fa fa-angle-left"></i></button>
                <button type="button" class="btn btn-light pd-x-25"><i class="fa fa-angle-right"></i></button>
            </div>
        </div><!-- br-mailbox-list-header -->
        <div class="br-mailbox-list-body">
            <div class="br-mailbox-list-item active">
                <div class="d-flex justify-content-between mg-b-5">
                    <div>
                        <i class="icon ion-ios-star tx-warning"></i>
                        <i class="icon ion-android-attach"></i>
                    </div>
                    <span class="tx-12">10 hours ago</span>
                </div><!-- d-flex -->
                <h6 class="tx-14 mg-b-10 tx-gray-800">Socrates Itumay, me (4)</h6>
                <p class="tx-12 tx-gray-600 mg-b-5">I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never...</p>
            </div><!-- br-mailbox-list-item -->
            <div class="br-mailbox-list-item unread">
                <div class="d-flex justify-content-between mg-b-5">
                    <div>
                        <i class="icon ion-ios-star"></i>
                        <i class="icon ion-android-attach"></i>
                    </div>
                    <span class="tx-12">1 day ago</span>
                </div><!-- d-flex -->
                <h6 class="tx-14 mg-b-10 tx-gray-800">Envato, me (2)</h6>
                <p class="tx-12 tx-gray-600 mg-b-5">I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never...</p>
            </div><!-- br-mailbox-list-item -->
            <div class="br-mailbox-list-item">
                <div class="d-flex justify-content-between mg-b-5">
                    <div>
                        <i class="icon ion-ios-star"></i>
                        <i class="icon ion-android-attach"></i>
                    </div>
                    <span class="tx-12">2 days ago</span>
                </div><!-- d-flex -->
                <h6 class="tx-14 mg-b-10 tx-gray-800">Themeforest</h6>
                <p class="tx-12 tx-gray-600 mg-b-5">I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never...</p>
            </div><!-- br-mailbox-list-item -->
            <div class="br-mailbox-list-item">
                <div class="d-flex justify-content-between mg-b-5">
                    <div>
                        <i class="icon ion-ios-star"></i>
                        <i class="icon ion-android-attach"></i>
                    </div>
                    <span class="tx-12">2 days ago</span>
                </div><!-- d-flex -->
                <h6 class="tx-14 mg-b-10 tx-gray-800">Reynante Labares, me (2)</h6>
                <p class="tx-12 tx-gray-600 mg-b-5">I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never...</p>
            </div><!-- br-mailbox-list-item -->
            <div class="br-mailbox-list-item">
                <div class="d-flex justify-content-between mg-b-5">
                    <div>
                        <i class="icon ion-ios-star"></i>
                        <i class="icon ion-android-attach"></i>
                    </div>
                    <span class="tx-12">3 days ago</span>
                </div><!-- d-flex -->
                <h6 class="tx-14 mg-b-10 tx-gray-800">Isidore Dilao (3)</h6>
                <p class="tx-12 tx-gray-600 mg-b-5">I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never...</p>
            </div><!-- br-mailbox-list-item -->
            <div class="br-mailbox-list-item">
                <div class="d-flex justify-content-between mg-b-5">
                    <div>
                        <i class="icon ion-ios-star"></i>
                        <i class="icon ion-android-attach"></i>
                    </div>
                    <span class="tx-12">Sep 20</span>
                </div><!-- d-flex -->
                <h6 class="tx-14 mg-b-10 tx-gray-800">Reynante Labares, me (2)</h6>
                <p class="tx-12 tx-gray-600 mg-b-5">I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never...</p>
            </div><!-- br-mailbox-list-item -->
            <div class="br-mailbox-list-item">
                <div class="d-flex justify-content-between mg-b-5">
                    <div>
                        <i class="icon ion-ios-star"></i>
                        <i class="icon ion-android-attach"></i>
                    </div>
                    <span class="tx-12">Sep 19</span>
                </div><!-- d-flex -->
                <h6 class="tx-14 mg-b-10 tx-gray-800">Envato, me (2)</h6>
                <p class="tx-12 tx-gray-600 mg-b-5">I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never...</p>
            </div><!-- br-mailbox-list-item -->
            <div class="br-mailbox-list-item">
                <div class="d-flex justify-content-between mg-b-5">
                    <div>
                        <i class="icon ion-ios-star"></i>
                        <i class="icon ion-android-attach"></i>
                    </div>
                    <span class="tx-12">Sep 17</span>
                </div><!-- d-flex -->
                <h6 class="tx-14 mg-b-10 tx-gray-800">Themeforest</h6>
                <p class="tx-12 tx-gray-600 mg-b-5">I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never...</p>
            </div><!-- br-mailbox-list-item -->
        </div><!-- br-mailbox-list-body -->
    </div><!-- br-mailbox-list -->

    <div class="br-mailbox-body">
        <div class="br-msg-header d-flex justify-content-between">
            <div class="media align-items-center">
                <img src="../img/img4.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body mg-l-10">
                    <p class="tx-inverse tx-medium mg-b-0">Louise Kate Lumaad</p>
                    <p class="tx-12 mg-b-0">
                        <span>Sep 20, 2017 8:45am</span>
                        <a href="#" class="mg-l-5 tx-gray-500"><i class="icon ion-star"></i></a>
                        <a href="#" class="mg-l-5 tx-gray-500"><i class="icon ion-android-attach"></i></a>
                    </p>
                </div><!-- media-body -->
            </div><!-- media -->
            <nav class="nav nav-inline tx-size-24 mg-b-0 lh-0">
                <a href="#" class="nav-link tx-gray-light hover-inverse pd-x-5"><i class="icon ion-reply"></i></a>
                <a href="#" class="nav-link tx-gray-light hover-inverse pd-x-5"><i class="icon ion-reply-all"></i></a>
                <a href="#" class="nav-link tx-gray-light hover-inverse pd-x-5"><i class="icon ion-printer"></i></a>
                <a href="#" class="nav-link tx-gray-light hover-inverse pd-x-5"><i class="icon ion-android-more-horizontal"></i></a>
                <a id="closeMail" href="#" class="nav-link pd-x-5 mg-l-15 hidden-xl-up">
                    <i class="icon ion-close"></i>
                </a>
            </nav>
        </div><!-- br-msg-header -->
        <div class="br-msg-body">
            <h6 class="tx-inverse mg-b-25 lh-4">Message sent via your Envato Market profile from themepixels</h6>

            <p>Hi Isidore,</p>

            <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>

            <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents.</p>

            <p>I should be incapable of drawing a single stroke at the present moment; and yet I feel that I never was a greater artist than now.</p>

            <p>Regards,<br>ThemePixels</p>
        </div><!-- br-msg-body -->

        <div class="pd-x-30 pd-b-30">
            <div class="row flex-row-reverse">
                <div class="col-md-9">
                    <textarea class="form-control ht-150" placeholder="Click to write message"></textarea>
                </div><!-- col-9 -->
                <div class="col-md-3 mg-t-30 mg-md-t-0">
                    <div class="ht-150 bd bd-dashed d-flex align-items-center justify-content-center rounded bg-gray-300">
                        <div class="tx-center wd-60p">
                            <i class="icon ion-android-attach tx-32"></i>
                            <p class="tx-12">Drag or click to attach a file</p>
                        </div>
                    </div>
                </div><!-- col-3 -->
            </div><!-- row -->
        </div>
    </div><!-- br-mailbox-body -->

    <!-- ########## END: MAIN PANEL ########## -->

    <div id="modalCompose" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-header pd-x-20">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Compose Message</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="form-group">
                        <div class="input-group wd-sm-400 wd-lg-600">
                            <span class="input-group-addon wd-80 bg-gray-100">To:</span>
                            <input type="text" class="form-control" placeholder="Add recepient">
                        </div><!-- input-group -->
                    </div><!-- form-group -->
                    <div class="form-group">
                        <div class="input-group wd-sm-400 wd-lg-600">
                            <span class="input-group-addon wd-80 bg-gray-100">Subject:</span>
                            <input type="text" class="form-control" placeholder="Type subject">
                        </div><!-- input-group -->
                    </div><!-- form-group -->
                    <div class="form-group mg-b-0">
                        <textarea class="form-control" rows="6" placeholder="Type your message"></textarea>
                    </div><!-- form-group -->
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-info">Send Message</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

@endsection
@section('child-js')

    <script>
        $(function(){
            'use strict';

            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');

            $(document).on('mouseover', function(e){
                e.stopPropagation();
                if($('body').hasClass('collapsed-menu')) {
                    var targ = $(e.target).closest('.br-sideleft').length;
                    if(targ) {
                        $('body').addClass('expand-menu');

                        // show current shown sub menu that was hidden from collapsed
                        $('.show-sub + .br-menu-sub').slideDown();

                        var menuText = $('.menu-item-label,.menu-item-arrow');
                        menuText.removeClass('d-lg-none');
                        menuText.removeClass('op-lg-0-force');

                    } else {
                        $('body').removeClass('expand-menu');

                        // hide current shown menu
                        $('.show-sub + .br-menu-sub').slideUp();

                        var menuText = $('.menu-item-label,.menu-item-arrow');
                        menuText.addClass('op-lg-0-force');
                        menuText.addClass('d-lg-none');
                    }
                }
            });

            $('.br-mailbox-list').perfectScrollbar();

            $('#showMailBoxLeft').on('click', function(e){
                e.preventDefault();
                if($('body').hasClass('show-mb-left')) {
                    $('body').removeClass('show-mb-left');
                    $(this).find('.fa').removeClass('fa-arrow-left').addClass('fa-arrow-right');
                } else {
                    $('body').addClass('show-mb-left');
                    $(this).find('.fa').removeClass('fa-arrow-right').addClass('fa-arrow-left');
                }
            });
        });
    </script>

@endsection
