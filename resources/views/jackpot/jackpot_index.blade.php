@extends('user_layout.app')

@section('style')
<style>
  #twoD {
    width: 100%;
    height: 400px;
    overflow: scroll;
  }

  .twoDCard {
    display: grid;
    grid-template-columns: auto auto auto auto auto;
    grid-gap: 10px;
  }
</style>
@endsection

@section('content')
@include('user_layout.nav')
<div class="d-flex justify-content-around align-items-center mx-auto" style="
          background-color: var(--default);
          width: 358px;
          height: 59px;
          border-radius: 24px;
          border: 2px solid var(--gold, #576265);
          background: #12486b;
          padding: 12px 16px;
          margin-top: 80px;
        ">
  <img src="{{ asset('user_app/assets/img/vector.png') }}" width="24px" height="24px" alt="" />
  <p class="pt-3" style="font-size: 16px; font-weight: 500">ပိုက်ဆံအိတ် </p>
  <p class="pt-3" style="
            font-size: 16px;
            font-weight: 700;
            font-family: 'Lato', sans-serif;
          " id="userBalance" data-balance="{{ Auth::user()->balance }}">
    {{ number_format(Auth::user()->balance) }} Kyats
  </p>

  <img src="{{ asset('user_app/assets/img/plus.png') }}" class="rounded-circle" style="padding: 10px; color: var(--blue); background-color: #fff" alt="" />
</div>
<div class="">
  <div class="d-flex justify-content-around align-items-center">
    <div class="d-flex justify-content-center align-items-center">
      <img src="{{ asset('user_app/assets/img/query_builder.png') }}" alt="" />
      <span class="mx-1 text-end" style="
                color: var(--Font-Body, #5a5a5a);
                font-family: Noto Sans Myanmar;
                font-size: 14px;
                font-style: normal;
                font-weight: 500;
              ">ပိတ်ရန်ကျန်ချိန်</span>
      <small class="d-block text-end text-dark" id="todayDate"></small>

    </div>
    <div>

      <span class="mx-1" style="
                color: var(--Font-Heading, #232323);
                font-family: Poppins;
                font-size: 16px;
                font-style: normal;
                font-weight: 600;
              ">

        <small class="d-block text-end" id="currentTime"></small>
        <small class="d-block text-end" id="sessionInfo"></small></span>
    </div>
  </div>
</div>

<div class="d-flex justify-content-center align-items-center mt-3">
  <a href="{{ route('user.jackport-quick-play') }}" class="quick-select mx-2">
    <span>အမြန်ရွေးရန်</span>
  </a>

  <a href="{{ url('twod/dream') }}" type="button" class="d-flex justify-content-center align-items-center btn mx-2 px-3 py-2" style="
            border-radius: 26.471px;
            background: #78d6c6;
            box-shadow: 0px 0px 21.176px 0px rgba(240, 252, 172, 0.9);
          ">
    <img src="{{ asset('user_app/assets/img/2D/tabler_planet.png') }}" class="mx-2" alt="" />
    <span style="color: #12486b">အိမ်မက်ဂဏန်း</span>
  </a>
</div>

<div class=" mt-4">
  <div class="text-center">
    <label for="" class="form-label text-dark ">ထိုးမည့် ငွေအမျိုးအစား ရွေးချယ်ပါ။</label>
  </div>
  
  <div class="d-flex justify-content-around">
    <label for="kyat" class="btn btn-outline-secondary d-block kyat w-75">ကျပ်</label>
    <label for="baht" class="btn btn-outline-secondary d-block baht w-75">ဘတ်</label>
  </div>
</div>


<div class="d-flex justify-content-center align-items-center mt-3" style="font-size: 16px">
  <div class="px-4" style="width: 100%">
    <input type="text " class="form-control" name="amount" id="all_amount" placeholder="ငွေပမာဏထည့်ပါ" />
    <button type="button" class="btn my-2" style="
              display: flex;
              width: 100%;
              height: 45px;
              padding: 10px;
              justify-content: center;
              align-items: center;
              gap: 10px;
              align-self: stretch;
              border-radius: 10px;
              background: #bbb;
            " id="permuteButton" onclick="permuteDigits()">
      <span style="color: var(--Font-Heading, #232323)">ပတ်လည်ထိုးမည်</span>
    </button>
  </div>
</div>

<div class="mx-3">
  @if ($lottery_matches->is_active == 1)
  <form action="" method="post" class="p-1">
    <div class="p-1">
      @csrf
      <div class="d-none">
        <input type="radio" name="currency" value="kyat" id="kyat">
        <input type="radio" name="currency" value="baht" id="baht">
      </div>
      <div class="row">
        <div class="col-md-12">
          <label for="selected_digits" class="text-dark" style="font-size: 14px;">ရွှေးချယ်ထားသောဂဏန်းများ</label>
          <input type="text" name="selected_digits" id="selected_digits" class="form-control form-control-sm mt-1" placeholder="Enter Digits">
        </div>
        <div class="col-md-12 mt-2">
          <label for="totalAmount" class="text-dark" style="font-size: 14px;">ပတ်လည်ဂဏန်းများ</label>
          <input type="text" id="permulated_digit" class="form-control form-control-sm" readonly>
        </div>
        <div id="amountInputs" class="col-md-12 mb-3 d-none"></div>
        <div class="col-md-12 mt-2">
          <label for="totalAmount" class="text-dark" style="font-size: 14px;"><i class="fas fa-coins me-2 text-dark"></i>စုစုပေါင်းထိုးကြေး</label>
          <input type="text" id="totalAmount" name="totalAmount" class="form-control form-control-sm mt-1" readonly>
        </div>
      </div>

    </div>

    @else
    <div class="text-center p-4">
      <h3>Sorry, you can't play now. Please wait for the next round.</h3>
    </div>
    @endif
</div>

<!-- footer section start  -->
<footer class="fixed-bottom bg-white py-3 mx-auto">
  <div class="row">
    <div class="col">
      <button class="btn w-100" type="reset" style="
                display: flex;
                padding: 10px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 10px;
                border: 1px solid #fe0000;
                color: #fe0000;
              ">ဖျက်မည်</button>
    </div>
    <div class="col">
      <a href="{{ route('user.jackport-play-confirm') }}" style="
                display: flex;
                padding: 10px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 10px;
                background: var(--Primary, #12486b);
              " onclick="storeSelectionsInLocalStorage()">ထိုးမည်</a>
      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    </div>
  </div>
  </form>
</footer>
<!-- footer section end -->

<!-- number start -->
<div class="mt-2" id="twoD" style="padding-bottom: 50px" style="font-size: 16px">
  <div class="twoDCard my-2">
    @foreach ($twoDigits as $digit)
    @php
    $totalBetAmountForTwoDigit = DB::table('jackpot_two_digit_copy')
    ->where('two_digit_id', $digit->id)
    ->sum('sub_amount');
    @endphp


    <button class="toggle-btn" onclick="selectDigit('{{ $digit->two_digit }}', this)">
      <span>{{ $digit->two_digit }}</span>
      <div class="progress-bar">

        @php
        $totalAmount = $limitAmount;
        $betAmount = $totalBetAmountForTwoDigit; // the amount already bet
        $remainAmount = $totalAmount - $betAmount; // the amount remaining that can be bet
        $percentage = ($betAmount / $totalAmount) * 100;
        $remainPercent = 100 - $percentage;
        @endphp

        <div class="progress-bar bg-{{ $remainPercent >= 50 ? 'success' : 'warning' }}" role="progressbar" style="width: {{ $remainPercent }}%;">
          <!-- <small class="text-{{ $remainPercent >= 50 ? 'white' : 'dark' }}">{{ $remainingAmounts[$digit->id] }}</small> -->
        </div>
      </div>
    </button>
    @endforeach
  </div>

</div>
<!-- number end -->


</div>

<!-- Modal -->
<div class=" modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content py-4" style="background: var(--Scondary, #419197)">
      <button type="button" class="btn-close ms-auto py-2 px-4" data-bs-dismiss="modal" aria-label="Close"></button>
      <div class="mx-3">
        <div>
          <p class="modal-text">ဘရိတ်</p>
          <div class="modal-box">
            <div class="modal-digit">
              <span>0/10</span>
            </div>
            <div class="modal-digit">
              <span>1/11</span>
            </div>
            <div class="modal-digit">
              <span>2/12</span>
            </div>
            <div class="modal-digit">
              <span>3/13</span>
            </div>
            <div class="modal-digit">
              <span>4/14</span>
            </div>
          </div>
          <div class="modal-box my-2">
            <div class="modal-digit">
              <span>0/10</span>
            </div>
            <div class="modal-digit">
              <span>1/11</span>
            </div>
            <div class="modal-digit">
              <span>2/12</span>
            </div>
            <div class="modal-digit">
              <span>3/13</span>
            </div>
            <div class="modal-digit">
              <span>4/14</span>
            </div>
          </div>
        </div>
        <div>
          <p class="modal-text">Single & Double Size</p>
          <div class="modal-box">
            <div class="modal-digit">
              <span>ညီကို</span>
            </div>
            <div class="modal-digit">
              <span>ကြီး</span>
            </div>
            <div class="modal-digit">
              <span>ငယ်</span>
            </div>
            <div class="modal-digit">
              <span>မ</span>
            </div>
            <div class="modal-digit">
              <span>စုံ</span>
            </div>
          </div>
          <div class="modal-box my-2">
            <div class="modal-digit">
              <span>စုံစုံ</span>
            </div>
            <div class="modal-digit">
              <span>စုံမ</span>
            </div>
            <div class="modal-digit">
              <span>မစုံ</span>
            </div>
            <div class="modal-digit">
              <span>မမ</span>
            </div>
            <div class="modal-digit">
              <span>အပူး</span>
            </div>
          </div>
        </div>
        <div>
          <p class="modal-text">ပတ်သီး</p>
          <div class="modal-box">
            <div class="modal-digit">
              <span>0</span>
            </div>
            <div class="modal-digit">
              <span>1</span>
            </div>
            <div class="modal-digit">
              <span>2</span>
            </div>
            <div class="modal-digit">
              <span>3</span>
            </div>
            <div class="modal-digit">
              <span>4</span>
            </div>
          </div>
          <div class="modal-box my-2">
            <div class="modal-digit">
              <span>5</span>
            </div>
            <div class="modal-digit">
              <span>6</span>
            </div>
            <div class="modal-digit">
              <span>7</span>
            </div>
            <div class="modal-digit">
              <span>8</span>
            </div>
            <div class="modal-digit">
              <span>9</span>
            </div>
          </div>
        </div>
        <div>
          <p class="modal-text">ထိပ်</p>
          <div class="modal-box">
            <div class="modal-digit">
              <span>0</span>
            </div>
            <div class="modal-digit">
              <span>1</span>
            </div>
            <div class="modal-digit">
              <span>2</span>
            </div>
            <div class="modal-digit">
              <span>3</span>
            </div>
            <div class="modal-digit">
              <span>4</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>
  // Function to update date and time display
  function updateDateTimeDisplay() {
    var d = new Date();
    document.getElementById('todayDate').textContent = d.toLocaleDateString();
    document.getElementById('currentTime').textContent = d.toLocaleTimeString();

    // Define the morning and evening session close times
    var morningClose = new Date(d.getFullYear(), d.getMonth(), d.getDate(), 12, 1);
    var eveningClose = new Date(d.getFullYear(), d.getMonth(), d.getDate(), 16, 30);

    // Determine current session based on current time
    var sessionInfo = "";
    if (d < morningClose) {
      sessionInfo = "Closes at 12:01 PM.";
    } else if (d >= morningClose && d < eveningClose) {
      sessionInfo = "Closes at 4:30 PM.";
    } else if (d >= eveningClose) {
      sessionInfo = "Evening session closed.";
    }
    document.getElementById('sessionInfo').textContent = sessionInfo;
  }

  // Update the display initially
  updateDateTimeDisplay();

  // Set interval to update the display every minute
  setInterval(updateDateTimeDisplay, 60000);
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    @if(session('SuccessRequest'))
    Swal.fire({
      icon: 'success',
      title: 'Success! သင့်ကံစမ်းမှုအောင်မြင်ပါသည် ! သိန်းထီးဆုကြီးပေါက်ပါစေ',
      text: '{{ session('
      SuccessRequest ') }}',
      timer: 3000,
      showConfirmButton: false
    });
    @endif
  });
</script>
<script>
  function showLimitFullAlert() {
    Swal.fire({
      icon: 'info',
      title: 'Limit Reached',
      text: 'This two digit\'s amount limit is full.'
    });
  }

  function selectDigit(num, element) {
    const selectedInput = document.getElementById('selected_digits');
    const amountInputsDiv = document.getElementById('amountInputs');

    // Ensure that the digits are handled as strings
    let selectedDigits = selectedInput.value ? selectedInput.value.split(",") : [];
    num = num.toString(); // Convert num to a string to ensure "00" is not treated as 0

    // Check if the digit is already selected
    if (selectedDigits.includes(num)) {
      // If it is, remove the digit, its style, and its input field
      selectedInput.value = selectedDigits.filter(digit => digit !== num).join(',');
      element.classList.remove('selected');
      const inputToRemove = document.getElementById('amount_' + num);
      if (inputToRemove) {
        amountInputsDiv.removeChild(inputToRemove);
      }
    } else {
      // Otherwise, add the digit, its style, and its input field
      selectedDigits.push(num);
      selectedInput.value = selectedDigits.join(',');
      element.classList.add('selected');
      // const amountLabel = document.createElement('label');
      // amountLabel.textContent = 'ထိုးကြေးသတ်မှတ်ပါ ' + num;
      const amountInput = document.createElement('input');
      amountInput.setAttribute('type', 'number');
      amountInput.setAttribute('name', 'amounts[' + num + ']');
      amountInput.setAttribute('id', 'amount_' + num);
      amountInput.setAttribute('placeholder', 'Amount for ' + num);
      amountInput.setAttribute('min', '1');
      //amountInput.setAttribute('max', '50000');
      amountInput.setAttribute('class', 'form-control mt-2');
      // amountInputsDiv.appendChild(amountLabel);
      amountInputsDiv.appendChild(amountInput);
    }

    // Store the current selections to local storage
    storeSelectionsInLocalStorage();
  }

  function storeSelectionsInLocalStorage() {
    let selections = {};
    document.querySelectorAll('input[name^="amounts["]').forEach(input => {
      let digit = input.name.match(/\[(.*?)\]/)[1];
      let amount = input.value;
      if (amount) {
        selections[digit] = amount;
      }
    });
    let currency = document.querySelector('input[name="currency"]:checked').value;

    localStorage.setItem('twoDigitSelections', JSON.stringify(selections));
    localStorage.setItem('selectedCurrency', currency);
  }

  function permuteDigits() {
    const outputField = document.getElementById('selected_digits');
    const permulatedField = document.getElementById('permulated_digit');

    if (!outputField || !permulatedField) {
      console.error('Required field not found');
      return;
    }

    let selectedDigits = outputField.value.split(",").map(s => s.trim());

    // Permute the digits only if they are two digits long
    const permutedDigits = selectedDigits.map(num => {
      return (num.length === 2) ? num[1] + num[0] : num;
    });

    // Update the outputField with both selected and permuted digits
    outputField.value = `${selectedDigits.join(", ")}`;

    // Update the permulatedField with the permuted digits only
    permulatedField.value = permutedDigits.join(",");

    // Combine selectedDigits and permutedDigits while removing duplicates
    const allUniqueDigits = Array.from(new Set([...selectedDigits, ...permutedDigits]));

    // Recreate the amount inputs for all unique digits
    createAmountInputs(allUniqueDigits);
  }

  function createAmountInputs(digits) {
    const amountInputsDiv = document.getElementById('amountInputs');
    amountInputsDiv.innerHTML = ''; // Clear existing amount inputs

    // Create a new input field for each unique digit
    digits.forEach(digit => {
      const amountInput = document.createElement('input');
      amountInput.type = 'number';
      amountInput.name = `amounts[${digit}]`;
      amountInput.id = `amount_${digit}`;
      amountInput.placeholder = `Amount for ${digit}`;
      amountInput.value = '100'; // Set a default value or retrieve the existing value
      amountInput.classList.add('form-control', 'mt-2');
      amountInput.onchange = updateTotalAmount;
      amountInputsDiv.appendChild(amountInput);
    });

    updateTotalAmount(); // Update the total amount to reflect changes
  }


  function checkBetAmount(inputElement, num) {
    // Replace the problematic line with the following code
    const digits = document.querySelectorAll('.digit');
    let digitElement = null;

    for (let i = 0; i < digits.length; i++) {
      if (digits[i].textContent.includes(num)) {
        digitElement = digits[i];
        break;
      }
    }

    // Ensure that the digitElement was found before proceeding
    if (!digitElement) {
      console.error('Could not find the digit element for', num);
      return;
    }

    // Continue with the rest of your function as before
    const remainingAmount = Number(digitElement.querySelector('small').innerText.split(' ')[1]);

    // Check if the entered bet amount exceeds the remaining amount
    if (Number(inputElement.value) > remainingAmount) {
      Swal.fire({
        icon: 'error',
        title: 'Bet Limit Exceeded',
        text: `You can only bet up to ${remainingAmount} for the digit ${num}.`
      });
      inputElement.value = ""; // Reset the input value
    }
  }

  function setAmountForAllDigits(amount) {
    const inputs = document.querySelectorAll('input[name^="amounts["]');
    inputs.forEach(input => {
      input.value = amount;
    });
    updateTotalAmount(); // Update the total amount after setting the new amounts
  }

  // Event listener for the amount input field
  document.getElementById('all_amount').addEventListener('input', function() {
    const amount = this.value; // Get the current value of the input field
    setAmountForAllDigits(amount); // Set this amount for all digit inputs
  });
  // New function to calculate and display the total amount
  function updateTotalAmount() {
    let total = 0;
    const inputs = document.querySelectorAll('input[name^="amounts["]');
    inputs.forEach(input => {
      total += Number(input.value);
    });

    // Get the user's current balance from the data attribute
    const userBalanceSpan = document.getElementById('userBalance');
    let userBalance = Number(userBalanceSpan.getAttribute('data-balance'));

    // Check if user balance is less than total amount
    if (userBalance < total) {
      //alert('Your balance is not enough to play two digit.');
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Your balance is not enough to play two digit. - သင်၏လက်ကျန်ငွေ မလုံလောက်ပါ - ကျေးဇူးပြု၍ ငွေဖြည့်ပါ။',
        footer: `<a href=
         "{{ url('user/wallet-deposite') }}" style="background-color: #007BFF; color: #FFFFFF; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Fill Balance - ငွေဖြည့်သွင်းရန် နိုပ်ပါ </a>`
      });
      return; // Exit the function to prevent further changes
    }
    // Decrease the user balance by the total
    userBalance -= total;

    // Update the displayed balance and the data attribute
    userBalanceSpan.textContent = userBalance;
    userBalanceSpan.setAttribute('data-balance', userBalance);

    document.getElementById('totalAmount').value = total;
  }
</script>
<script>
  function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
      color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
  }

  document.querySelectorAll('.digit.disabled').forEach(el => {
    el.style.backgroundColor = getRandomColor();
  });
</script>
<script>
  $(document).ready(function() {
    $("#kyat").change(function() {
      if ($(this).prop("checked")) {
        $(".kyat").addClass('btn-secondary').removeClass('btn-outline-secondary');
        $(".baht").addClass('btn-outline-secondary').removeClass('btn-secondary');
      }
    });

    $("#baht").change(function() {
      if ($(this).prop("checked")) {
        $(".baht").addClass('btn-secondary').removeClass('btn-outline-secondary');
        $(".kyat").addClass('btn-outline-secondary').removeClass('btn-secondary');
      }
    });
  });
</script>


@endsection