@extends('layouts.admin_app')


@section('content')
    <section class="py-3">
        <div class="row mb-4 mb-md-0">
            <div class="col-md-8 me-auto my-auto text-left">
                <h5>Some of Our Awesome Projects</h5>
                <p>
                    သတ်မှတ်ပွဲချိန်ပြီး - ၁၅ မိနစ်အတွင်း မဖြစ်မနေ ပြီးဆုံးခဲ့သည့် Session ကို Reset လုပ်ပေးရပါမည်။
                </p>
            </div>
            <div class="col-lg-4 col-md-12 my-auto text-end">
                <button type="button" class="btn bg-gradient-primary mb-0 mt-0 mt-md-n9 mt-lg-0">
                    <i class="material-icons text-white position-relative text-md pe-2">add</i>
                </button>
            </div>
        </div>
        <div class="row mt-lg-4 mt-2">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="d-flex mt-n2">
                            <div class="avatar avatar-xl bg-gradient-dark border-radius-xl p-2 mt-n4">
                                <img src="{{ asset('admin_app/assets/img/small-logos/logo-slack.svg') }}" alt="slack_logo">
                            </div>
                            <div class="ms-3 my-auto">
                                <h6 class="mb-0"> Session Reset</h6>
                                <div class="avatar-group">
                                    <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip"
                                        data-original-title="Jessica Rowland">
                                        <img alt="Image placeholder" src="{{ asset('admin_app/assets/img/team-3.jpg') }}"
                                            class="">
                                    </a>

                                    <form action="{{ route('admin.SessionReset') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary" type="submit"
                                            onclick="return confirm('Are you sure you want to reset?')">Reset</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                        {{-- <p class="text-sm mt-3"> If everything I did failed - which it doesn&#39;t, I think that it actually succeeds. </p> --}}
                        <hr class="horizontal dark">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-sm mb-0">5</h6>
                                <p class="text-secondary text-sm font-weight-normal mb-0">Participants</p>
                            </div>
                            <div class="col-6 text-end">
                                <h6 class="text-sm mb-0">02.03.22</h6>
                                <p class="text-secondary text-sm font-weight-normal mb-0">Due date</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </section>
@endsection
