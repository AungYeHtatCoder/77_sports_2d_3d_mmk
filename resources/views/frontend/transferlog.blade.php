@extends('user_layout.app')

@section('style')
<style>
  .form{
    font-size: 14px;
    position: relative;
    color: var(--Text-Body, #abb1cc);
  }
  .input{
    border: 1px solid var(--System-Gray-500, #9e9e9e);
    background: var(--System-White, #fff);
  }
</style>
@endsection

@section('content')
@include('user_layout.nav')
<!-- content section start -->
<div style="padding-top: 80px;">
  <small class="text-center text-dark d-block mb-3">ငွေလွဲ/ထုတ်မှတ်တမ်း</small>
</div>
@foreach ($logs as $log)
<div class="card mb-3 pt-2 text-center shadow">
  <div class="d-flex justify-content-around align-items-center">
    <p>
      <span class="d-block" style="color: goldenrod"><i class="fas fa-money-bill-wave"></i></span>
      
      K {{ number_format($log->amount) }}
    </p>
    <p>
      <span class="d-block" style="color: goldenrod"><i class="fas fa-money-bill-transfer"></i></span>
      <small class="badge text-bg-{{ $log->status == 0 ? "warning" : ($log->status == 1 ? "success" : ($log->status == 2 ? "danger" : "")) }}">
        {{ $log->status == 0 ? "pending" : ($log->status == 1 ? "accepted" : ($log->status == 2 ? "rejected" : "")) }}  
      </small>
    </p>
    <p>
      <span class="d-block" style="color: goldenrod">Type</span>
      {{ $log->type }}
    </p>
    <p>
      <span class="d-block" style="color: goldenrod"><i class="fas fa-calendar"></i></span>
      {{ $log->created_at->format('d-m-Y') }}
    </p>
  </div>
</div>
@endforeach
<!-- content section end -->
@include('user_layout.footer')
@endsection

@section('script')
<script>
  function copyText() {
    var inputElement = document.getElementById("receiver");
  
    // Select the text in the input field
    inputElement.select();
  
    // Copy the selected text
    document.execCommand("copy");
    // alert('copied text!');
  
    // Deselect the input field
    inputElement.setSelectionRange(0, 0);
  
    alert("Text copied: " + inputElement.value);
  }
</script>
<script>
  function fillInputBox(element) {
    let value = element.getAttribute('data-value');
    console.log(value);
    let inputField = document.getElementById('amount');
    inputField.value = value;
  }
</script>
@endsection