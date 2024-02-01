@extends('user_layout.app')

@section('style')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Myanmar&family=Poppins&display=swap');
    .header{
        color: #fff;
        font-family: Poppins;
        font-size: 30px;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
        /* margin-top: 41px; */
    }
    .frame {
        max-width: 414px;
        height: auto;
        /* min-height: 100vh; */
        margin: auto;
        border-radius: 59px 59px 0px 0px;
        background: linear-gradient(90deg, #9B5DE5 0%, #7158E2 100%);
        backdrop-filter: blur(40px);
        padding: 41px 37px 0 37px;
        color: #fff;
    }
    .sub-header{
        color: #fff;
        font-family: Poppins;
        font-size: 14.33px;
        font-style: normal;
        font-weight: 500;
        line-height: normal;
        margin-bottom: 16px;
    }
    .input-width{
        padding: 16px 24px;
    }
    .btn-login{
        background: linear-gradient(90deg, #9B5DE5 0%, #7158E2 100%);
        font-size: 18px;
        border: 1px solid #fff;
    }
    .login{
        margin: 48px 0 40px 0;
    }
    .form-label{
        color: #fff;
    }
    @media (max-width: 414px) {
        .frame{
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="frame fixed-bottom">
    <div class="login-card">
        <h5 class="text-center header mb-0 pb-0">Welcome Back!</h5>
        <span class="d-block text-center sub-header">welcome back we missed you</span>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="country_code" class="form-label">ဖုန်းနံပါတ်</label>
                <div class="d-flex">
                    <div class="w-50 me-1">
                        <select name="country_code" class="form-control form-select border border-1 border-secondary input-width">
                            <option value="+95"> <p style="font-style:20px;">&#x1F1F2;&#x1F1F2;</p></option>
                            <option value="+66">🇬🇧</option>
                        </select>
                    </div>
                    <div class="w-100">
                        <div class="form-floating text-dark">
                            <input type="number" class="form-control border border-1 border-secondary input-width" name="phone" id="phone" placeholder="xxxx">
                            <label for="phone">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                    <g clip-path="url(#clip0_280_8329)">
                                    <path d="M11.499 16.385C6.14445 16.5361 -3.33595 7.04454 1.22421 1.8884C1.24063 1.87263 1.94108 1.26155 1.94108 1.26155C2.37471 0.842353 2.95565 0.610276 3.55875 0.615315C4.16185 0.620354 4.73883 0.862106 5.16539 1.28849L6.58009 2.81226C6.99642 3.24753 7.22665 3.82797 7.22186 4.43027C7.21708 5.03258 6.97766 5.60928 6.55447 6.03789L6.29886 6.29678C7.0586 7.97816 8.40243 9.32689 10.081 10.0927L10.3504 9.82991C10.7883 9.41243 11.3701 9.17953 11.9751 9.17953C12.5801 9.17953 13.1618 9.41243 13.5997 9.82991L15.0703 11.194C15.5065 11.6189 15.757 12.1991 15.7669 12.808C15.7769 13.4169 15.5456 14.005 15.1235 14.444C15.1235 14.444 14.5124 15.1451 14.4966 15.1615C14.1026 15.5534 13.6348 15.8633 13.1203 16.0733C12.6058 16.2833 12.0547 16.3892 11.499 16.385ZM2.59554 3.30902C-0.597886 7.26269 9.62173 16.8929 13.0793 13.7895C13.0793 13.7895 13.6864 13.0936 13.7029 13.0772C13.7348 13.0476 13.7602 13.0117 13.7776 12.9718C13.795 12.9319 13.8039 12.8888 13.8039 12.8453C13.8039 12.8017 13.795 12.7587 13.7776 12.7188C13.7602 12.6789 13.7348 12.643 13.7029 12.6133L12.2323 11.2505C12.0352 11.0863 11.9248 11.0843 11.7408 11.2242L10.995 11.9582C10.8604 12.0907 10.6905 12.1816 10.5057 12.2203C10.3208 12.259 10.1287 12.2437 9.95224 12.1764C8.64118 11.6887 7.4503 10.9249 6.46034 9.93661C5.47038 8.94835 4.70449 7.75878 4.21459 6.44856C4.14307 6.27066 4.125 6.07576 4.16258 5.88774C4.20016 5.69972 4.29176 5.52674 4.42617 5.39L5.15488 4.64947C5.18809 4.62019 5.21479 4.58428 5.23327 4.54404C5.25174 4.50381 5.26157 4.46014 5.26213 4.41587C5.26269 4.3716 5.25396 4.32771 5.2365 4.28702C5.21905 4.24633 5.19326 4.20976 5.16079 4.17965L3.74543 2.65588C3.68196 2.60524 3.60198 2.57991 3.52092 2.58476C3.43987 2.58962 3.36349 2.62431 3.3065 2.68216C3.29139 2.69859 2.59554 3.30902 2.59554 3.30902ZM15.5401 7.79887C15.819 6.83433 15.8341 5.81264 15.5838 4.84029C15.3335 3.86794 14.827 2.98051 14.117 2.27051C13.4071 1.56051 12.5197 1.05391 11.5474 0.803526C10.575 0.55314 9.55336 0.568127 8.5888 0.846927C8.46476 0.883945 8.34922 0.945032 8.24879 1.0267C8.14835 1.10837 8.06499 1.20902 8.00346 1.32291C7.94192 1.43679 7.90342 1.56168 7.89015 1.69045C7.87689 1.81921 7.88911 1.94933 7.92613 2.07337C7.96315 2.19741 8.02423 2.31295 8.1059 2.41338C8.18757 2.51381 8.28822 2.59718 8.40211 2.65871C8.51599 2.72025 8.64088 2.75875 8.76965 2.77202C8.89841 2.78528 9.02853 2.77306 9.15257 2.73604C9.77632 2.55772 10.4364 2.54948 11.0644 2.71219C11.6924 2.87489 12.2655 3.20261 12.7242 3.66137C13.1829 4.12014 13.5105 4.69324 13.6731 5.32127C13.8357 5.9493 13.8274 6.60939 13.649 7.23312C13.612 7.3572 13.5999 7.48735 13.6132 7.61614C13.6266 7.74492 13.6652 7.86981 13.7268 7.98367C13.7884 8.09753 13.8719 8.19814 13.9724 8.27974C14.0729 8.36134 14.1885 8.42233 14.3126 8.45924C14.4042 8.48622 14.4991 8.49994 14.5945 8.49998C14.8067 8.49974 15.0131 8.43107 15.1831 8.30417C15.3531 8.17727 15.4776 7.9989 15.5381 7.79558L15.5401 7.79887ZM11.8696 7.88626C11.9612 7.79473 12.0339 7.68605 12.0834 7.56642C12.133 7.4468 12.1585 7.31858 12.1585 7.1891C12.1585 7.05961 12.133 6.93139 12.0834 6.81177C12.0339 6.69214 11.9612 6.58346 11.8696 6.49193L11.1705 5.79214V4.88602C11.1705 4.62461 11.0666 4.37392 10.8818 4.18908C10.697 4.00424 10.4463 3.90039 10.1849 3.90039C9.92345 3.90039 9.67275 4.00424 9.48791 4.18908C9.30307 4.37392 9.19923 4.62461 9.19923 4.88602V6.20018C9.19917 6.32964 9.22461 6.45784 9.27411 6.57746C9.3236 6.69708 9.39618 6.80578 9.48769 6.89735L10.4733 7.88298C10.5648 7.97457 10.6735 8.04722 10.7931 8.0968C10.9128 8.14637 11.041 8.17188 11.1705 8.17188C11.3 8.17188 11.4282 8.14637 11.5478 8.0968C11.6674 8.04722 11.7761 7.97457 11.8676 7.88298L11.8696 7.88626Z" fill="#A4A4A4"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_280_8329">
                                    <rect width="15.77" height="15.77" fill="white" transform="translate(0 0.61499)"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                            </label>
                            @error('phone')
                                <span class="text-danger">*{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">လျို့ဝှက်နံပါတ်</label>
                <div class="form-floating text-dark">
                    <input type="password" class="form-control border border-1 border-secondary" name="password" id="floatingPassword" placeholder="xxxx">
                    <label for="floatingPassword">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17" fill="none">
                        <path d="M15.7724 2.21039L16.3617 1.6303C16.518 1.47425 16.6058 1.26261 16.6058 1.04193C16.6058 0.821243 16.518 0.609598 16.3617 0.453551C16.2054 0.297505 15.9935 0.209839 15.7724 0.209839C15.5514 0.209839 15.3394 0.297505 15.1832 0.453551L14.0212 1.62201L11.6724 3.96722L6.43522 9.18801C5.57706 8.6227 4.53929 8.39558 3.52298 8.55065C2.50667 8.70572 1.5842 9.23194 0.934303 10.0274C0.284406 10.8228 -0.0466423 11.8307 0.00530445 12.8559C0.0572512 13.8811 0.488495 14.8506 1.21547 15.5765C1.94245 16.3023 2.91341 16.7329 3.9402 16.7848C4.96699 16.8366 5.97651 16.5061 6.77315 15.8572C7.56978 15.2083 8.09682 14.2872 8.25213 13.2725C8.40744 12.2578 8.17997 11.2216 7.61379 10.3648L12.2533 5.72406L14.0129 7.48918C14.0903 7.5659 14.182 7.62666 14.2829 7.66797C14.3838 7.70928 14.4919 7.73035 14.601 7.72996C14.71 7.72958 14.8179 7.70775 14.9185 7.66573C15.0191 7.6237 15.1105 7.5623 15.1873 7.48504C15.2641 7.40777 15.325 7.31615 15.3664 7.2154C15.4077 7.11466 15.4288 7.00676 15.4285 6.89788C15.4281 6.78899 15.4062 6.68125 15.3641 6.5808C15.322 6.48034 15.2605 6.38915 15.1832 6.31243L13.4236 4.5556L14.6022 3.38714L15.1832 3.96722C15.26 4.04449 15.3513 4.10589 15.4519 4.14791C15.5525 4.18994 15.6604 4.21176 15.7695 4.21215C15.8786 4.21253 15.9866 4.19147 16.0875 4.15015C16.1884 4.10884 16.2802 4.04809 16.3576 3.97137C16.435 3.89464 16.4965 3.80345 16.5385 3.703C16.5806 3.60255 16.6025 3.49481 16.6029 3.38592C16.6033 3.27704 16.5822 3.16914 16.5408 3.06839C16.4994 2.96765 16.4386 2.87603 16.3617 2.79876L15.7724 2.21039ZM4.15279 15.1298C3.66033 15.1298 3.17893 14.984 2.76946 14.7108C2.36 14.4376 2.04086 14.0493 1.8524 13.5951C1.66394 13.1408 1.61464 12.6409 1.71071 12.1587C1.80678 11.6764 2.04393 11.2334 2.39215 10.8857C2.74037 10.5381 3.18403 10.3013 3.66703 10.2054C4.15003 10.1094 4.65067 10.1587 5.10564 10.3468C5.56062 10.535 5.94949 10.8536 6.22309 11.2625C6.49668 11.6713 6.64272 12.152 6.64272 12.6437C6.64272 13.303 6.38038 13.9354 5.91343 14.4016C5.44648 14.8678 4.81316 15.1298 4.15279 15.1298Z" fill="#A4A4A4"/>
                        </svg>
                    </label>
                </div>
                @error('password')
                    <span class="text-danger">*{{ $message }}</span>
                @enderror
            </div>
            <small class="text-end d-block">လျှိ၀ှက်နံပါတ် မမှတ်မိဘူးလား ? <a href="" class="text-decoration-underline">ဒီမှာနှိပ်ပါ</a></small>

            <div class="login">
                <button class="btn btn-login w-100 text-white text-center">အကောင့်၀င်မည်</button>
            </div>
            <span class="text-center d-block mb-5">အကောင့်အသစ်ဖွင့်ရန် <a href="{{ url('/register') }}" class="text-decoration-underline">ဒီမှာနှိပ်ပါ</a></span>
        </form>
    </div>
</div>
{{-- <div class="main-body">

 <div class="d-flex justify-content-center align-items-center">
  <img src="{{ asset('user_app/assets/img/image 3 (1).png') }}" class="mb-5" style="border-radius: 50%;" alt="">
 </div>

 <div class="fixed-bottom frame" style="background: linear-gradient(90deg, #C6ECEA 0%, #2BC0E4 330.33%);
 backdrop-filter: blur(40px);
 border-top-left-radius: 59px;
 border-top-right-radius: 59px;">
  <div class="text-center">
   <h6 class="login-titles">Welcome Back!</h6>
   <span style="color: #5A5A5A;font-size: 14px;font-weight: 500;">welcome back we missed you</span>
  </div>

  <form action="">
   <span class="text-start mx-2" style="color: #A4A4A4;font-family: 'Noto Sans',sans-serif;font-size: 14px;">ဖုန်းနံပါတ်</span>
   <div class="d-flex justify-content-start align-items-center my-3">
    <div class="dropdown mx-2">
     <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
      <img src="{{ asset('user_app/assets/img/2D/flag.png') }}" alt="">
     </button>
     <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Thailand</a></li>
      <li><a class="dropdown-item" href="#">China</a></li>
     </ul>
    </div>

    <div class="mx-2" style="position: relative;">
     <img src="{{ asset('user_app/assets/img/2D/fi-br-call-history.png') }}" style="position: absolute;top: 5px;left: 10px;" alt="">
     <input type="text" class="ps-5 py-2 rounded" style="outline: none;border: 1px solid #ddd;" placeholder="09123456789">
    </div>
   </div>

   <div>
    <span class="text-start mx-2" style="color: #A4A4A4;font-family: 'Noto Sans',sans-serif;font-size: 14px;">လျှိ၀ှက်နံပါတ်</span>

    <div class="m-2" style="position: relative;">
     <img src="{{ asset('user_app/assets/img/2D/Vector (1).png') }}" style="position: absolute;top: 5px;left: 10px;" alt="">
     <input type="password" class="ps-5 py-2 rounded w-100" style="outline: none;border: 1px solid #ddd;" placeholder="******">
     <div class="text-end my-1" style="font-size: 12px;font-weight: 500;">
      <span style="color: #5A5A5A;">လျှိ၀ှက်နံပါတ် မမှတ်မိဘူးလား ? <a href="#" style="color: #232323;">ဒီမှာနှိပ်ပါ</a></span>
     </div>
    </div>
   </div>

   <div class="d-flex justify-content-center align-items-center">
    <button type="button" class="w-100 mx-2 mt-5 py-2 rounded text-white border border-none" style="background: var(--linear);font-size: 18px;">အကောင့်၀င်မည်</button>
   </div>

   <div class="text-center mt-3" style="font-size: 12px;font-weight: 500;">
    <span style="color: #5A5A5A;">အကောင့်အသစ်ဖွင့်ရန်<a href="{{ url('/signin') }}" class="fw-bold" style="color: #232323;">ဒီမှာနှိပ်ပါ</a></span>
   </div>

  </form>
 </div>
</div> --}}
@endsection