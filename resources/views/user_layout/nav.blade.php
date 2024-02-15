<div class="d-flex justify-content-between align-items-center fixed-top p-3 mx-auto navs">
    <div>
        <a href="{{ url()->previous() }}"><i class="fas fa-arrow-left"></i></a>
    </div>
    <a href="{{ url('/') }}" class="text-decoration-none text-white d-block">
        <h4 style="font-size: 24px; font-weight: 800">77 Sports</h4>
    </a>
    <button onclick="location.reload();" class="btn btn-sm text-white"><i class="fas fa-rotate"></i></button>
    {{-- <a href="#" class="text-decoration-none text-white d-block" onclick="location.reload();">
        <i class="fas fa-rotate"></i>
    </a> --}}
</div>