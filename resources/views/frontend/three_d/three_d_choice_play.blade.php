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
  <div class="time-section mt-3 mx-2">
    <div class="">
      <img src="{{ asset('user_app/assets/img/query_builder.png') }}" alt="" />
      <span class="time-text">ပိတ်ချိန်: <span class="d-block text-dark text-end" id="currentTime"></span>
      </span>
    </div>

    <div>
      <span class="d-block text-dark text-end" id="todayDate"></span>
      <span class="d-block text-dark text-end" id="sessionInfo"></span>

    </div>
  </div>

  <div class="dream-section">
    <img src="../assets/img/Border light.png" alt="" />
  </div>

  <a href="{{ url('threed/dream') }}" class="text-dark mx-auto mb-3" style="
            display: flex;
            width: 358px;
            height: 51px;
            justify-content: center;
            align-items: center;
            border-radius: 26.471px;
            background: #78d6c6;
            box-shadow: 0px 0px 21.176px 0px rgba(240, 252, 172, 0.9);
            border-radius: 25px;
            position: relative;
          ">
    <span>အိမ်မက်ဂဏန်း</span>
    <img src="{{ asset('user_app/assets/img/2D/image 4.png') }}" style="position: absolute; bottom: 0; right: 10px" alt="" />
  </a>

  <!-- <div class="btn-section">
    <a href="{{ url('/threed-quick') }}" class="text-decoration-none">
      <div class="threed-quick">အမြန်ရွေးရန်</div>
    </a>
    <a href="{{ url('/threed-under') }}" class="text-decoration-none">
      <div class="threed-quick">အောက်၂လုံးထိုးရန်</div>
    </a>
  </div> -->

  <div class="my-3 mx-2">
    <span style="
              color: var(--Font-Body, #5a5a5a);
              text-align: center;
              font-family: Noto Sans Myanmar;
              font-size: 14px;
              font-style: normal;
              font-weight: 400;
            ">ငွေပမာဏထည့်ပါ
    </span>
    <div class="play-section">
      <div>
        <input type="text" name="amount" id="all_amount" class="form-control" style="
                  border: 1px solid var(--System-Gray-500, #9e9e9e);
                  background: var(--System-White, #fff);
                " />
      </div>
      <div class="play-section">
        <div>
          <button class="btn" style="
                  display: flex;
                  width: 171px;
                  height: 45px;
                  padding: 10px;
                  justify-content: center;
                  align-items: center;
                  gap: 10px;
                  color: var(--Font-Heading, #232323);
                  border-radius: 10px;
                  background: #bbb;
                " id="permuteButton" onclick="permuteDigits()">
            ပတ်လည်ထိုးမည်
          </button>
        </div>

      </div>
    </div>
    <div class="mx-2 mt-3">
      <label for="" class="text-dark" style="font-size: 14px;">ဂဏန်းရိုက်ထည့်ပါ</label>
      <input type="text" name="amount" id="input_new_digit" placeholder="Enter 3 Digit" class="form-control mt-1 form-control-sm" autocomplete="off" />
    </div>
    <div class="">
      @if ($lottery_matches->is_active == 1)
      <form action="" method="post" class="p-1">
        <div class="p-1">
          @csrf
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

            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
          </div>

        </div>
      </form>
      @else
      <div class="text-center p-4">
        <h3>Sorry, you can't play now. Please wait for the next round.</h3>
      </div>
      @endif


    </div>

    <!-- <div>
      <p style="
                color: var(--Font-Body, #5a5a5a);
                font-size: 14px;
                font-weight: 400;
              ">
        ရွေးချယ်ထားသောဂဏန်းများ
      </p>
      <div class="rounded mx-2" style="
                min-height: 150px;
                border-radius: 8px;
                border: 1px solid var(--System-Gray-500, #9e9e9e);
              ">
        <div class="d-flex align-items-center p-2" id="output" style="gap: 10px"></div>
      </div>
    </div> -->
  </div>
</div>

<!-- footer section start  -->
<footer class="fixed-bottom bg-white py-3 mx-auto">
  <div class="row">
    <div class="col">
      <a href="" onclick="removeNumber()" style="
                display: flex;
                padding: 10px;
                justify-content: center;
                align-items: center;
                gap: 10px;
                flex: 1 0 0;
                border-radius: 10px;
                border: 1px solid #fe0000;
                color: #fe0000;
              ">ဖျက်မည်</a>
    </div>
    <div class="col">
      <a href="{{ url('/user/three-d-choice-play-confirm') }}" style="
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
</footer>
<!-- footer section end -->

<div class="mt-2" id="twoD" style="padding-bottom: 50px" style="font-size: 16px">
  <div class="twoDCard my-2">
    @foreach ($threeDigits as $digit)
    @php
    $totalBetAmountForTwoDigit = DB::table('lotto_three_digit_pivot')
    ->where('three_digit_id', $digit->id)
    ->sum('sub_amount');
    @endphp
    <button class="toggle-btn" onclick="selectDigit('{{ $digit->three_digit }}', this)">
      <span>{{ $digit->three_digit }}</span>
      <div class="progress-bar">

        @php
        $totalAmount = 50000;
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

@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
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
  document.querySelectorAll('.digit-box').forEach(box => {
    box.addEventListener('click', function() {
      const num = this.textContent.trim();
      selectDigit(num, this); // Pass the digit and the element
      // permuteDigits(); // Call permuteDigits after selecting a digit
    });
  });

  // Event listener for the manual input field
  document.getElementById('input_new_digit').addEventListener('input', function() {
    const manualInputValue = this.value.trim();

    // Validate if the input is a 3-digit number
    if (manualInputValue.length === 3 && /^\d{3}$/.test(manualInputValue)) {
      selectDigit(manualInputValue); // Pass only the digit for manual input
      //permuteDigits(); // Call permuteDigits after input
    }
  });
  // function selectDigit(num, element = null) {
  //   const selectedInput = document.getElementById('selected_digits');
  //   const amountInputsDiv = document.getElementById('amountInputs');

  //   // Ensure that the digits are handled as strings
  //   let selectedDigits = selectedInput.value ? selectedInput.value.split(",") : [];
  //   num = num.toString(); // Convert num to a string to ensure "00" is not treated as 0

  //   // Check if the digit is already selected
  //   if (selectedDigits.includes(num)) {
  //     // If it is, remove the digit, its style, and its input field
  //     selectedInput.value = selectedDigits.filter(digit => digit !== num).join(',');
  //     if (element) {
  //       element.classList.remove('selected');
  //     }
  //     const inputToRemove = document.getElementById('amount_' + num);
  //     if (inputToRemove) {
  //       amountInputsDiv.removeChild(inputToRemove);
  //     }
  //   } else {
  //     // Otherwise, add the digit, its style, and its input field
  //     selectedDigits.push(num);
  //     selectedInput.value = selectedDigits.join(',');
  //     if (element) {
  //       element.classList.add('selected');
  //     }
  //     const amountInput = document.createElement('input');
  //     amountInput.setAttribute('type', 'number');
  //     amountInput.setAttribute('name', 'amounts[' + num + ']');
  //     amountInput.setAttribute('id', 'amount_' + num);
  //     amountInput.setAttribute('placeholder', 'Amount for ' + num);
  //     amountInput.setAttribute('min', '100');
  //     amountInput.setAttribute('max', '50000');
  //     amountInput.setAttribute('class', 'form-control mt-2');
  //     amountInputsDiv.appendChild(amountInput);
  //   }

  //   // Store the current selections to local storage
  //   storeSelectionsInLocalStorage();
  // }

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
      //element.classList.add('selected');
      if (element) {
        element.classList.add('selected');
      }
      const amountInput = document.createElement('input');
      amountInput.setAttribute('type', 'number');
      amountInput.setAttribute('name', 'amounts[' + num + ']');
      amountInput.setAttribute('id', 'amount_' + num);
      amountInput.setAttribute('placeholder', 'Amount for ' + num);
      amountInput.setAttribute('min', '100');
      amountInput.setAttribute('max', '50000');
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
      if (amount) { // only add to selections if an amount is entered
        selections[digit] = amount;
      }
    });
    localStorage.setItem('twoDigitSelections', JSON.stringify(selections));
    //window.location.href = "{{ url('/user/two-d-play-9-30-early-morning-confirm') }}";
  }

  function permuteDigits() {
    const outputField = document.getElementById('selected_digits');
    const permulatedField = document.getElementById('permulated_digit');

    if (!outputField || !permulatedField) {
      console.error('Required field not found');
      return;
    }

    let selectedDigits = outputField.value.split(",").map(s => s.trim());

    // Permute the digits only if they are three digits long
    let permutedDigits = [];
    if (selectedDigits.some(num => num.length === 3)) {
      selectedDigits.forEach(num => {
        if (num.length === 3) {
          // Get all permutations for a three-digit number
          let permutations = permute(num.split(''));
          // Filter permutations for twin cases
          if (isTwin(num)) {
            permutations = permutations.filter((val, index, self) =>
              index === self.findIndex((t) => t.join('') === val.join(''))
            );
          }
          permutedDigits.push(...permutations.map(arr => arr.join('')));
        }
      });
    }

    // Update the outputField with both selected and permuted digits
    outputField.value = `${selectedDigits.join(", ")}`;

    // Update the permulatedField with the permuted digits only
    permulatedField.value = permutedDigits.join(", ");

    // Combine selectedDigits and permutedDigits while removing duplicates
    const allUniqueDigits = Array.from(new Set([...selectedDigits, ...permutedDigits]));

    // Recreate the amount inputs for all unique digits
    // Assuming createAmountInputs is a function you have defined elsewhere
    createAmountInputs(allUniqueDigits);
  }

  function isTwin(number) {
    // A number is considered a twin if it has two identical digits
    const digits = number.split('');
    return digits.some(digit => digits.filter(d => d === digit).length === 2);
  }

  function permute(inputArr) {
    let result = [];

    // The function that does the actual permutation
    const doPermute = (arr, m = []) => {
      if (arr.length === 0) {
        result.push(m);
      } else {
        for (let i = 0; i < arr.length; i++) {
          let curr = arr.slice();
          let next = curr.splice(i, 1);
          doPermute(curr.slice(), m.concat(next));
        }
      }
    }

    doPermute(inputArr);

    return result;
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
@endsection