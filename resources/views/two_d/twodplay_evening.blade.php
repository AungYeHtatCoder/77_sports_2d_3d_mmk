@extends('user_layout.app')
@section('style')
<link rel="stylesheet" href="{{ asset('user_app/assets/css/balance.css')}}">

@endsection
@section('content')
@include('user_layout.sub_nav')
<div class="row">
  <div class="col-lg-4 col-md-4 offset-lg-4 offset-md-4 mt-5 py-4" style="background-color: #ffffff;">
    <div class="flesh-card">
        <div class="d-flex justify-content-between">
            <div class="">
              <i class="fas fa-wallet" style="color:#265166"></i>
              <p class="px-2 d-inline" style="font-size: 14px;">လက်ကျန်ငွေ </p>
              <p class="font-green d-block" style="font-size: 14px;" id="userBalance" data-balance="{{ Auth::user()->balance }}">{{ Auth::user()->balance }} MMK</p>
            </div>
            <div class="">
                <i class="fas fa-clock" style="color:#265166"></i>
                <p class="px-2 d-inline" style="font-size: 14px;">ပိတ်ရန်ကျန်ချိန်</p>
                <p class="me-2 text-end">
                    <span id="currentTime" style="font-size: 14px"></span><br />
                    <span id="sessionInfo" style="font-size: 14px"></span>
                    <span id="todayDate" class="d-none" style="font-size: 14px"></span><br />
                </p>
            </div>
          </div>
    </div>

    <div>
      <div class="d-flex justify-content-between custom-btn">
        <!-- <a href="dream-book.html" class="btn h-50 text-white p-2" style="background-color: #2a576c;"><span class="material-icons text-white icons">menu_book</span> အိမ်မက်</a> -->
        <a href="{{ route('admin.QuickMorningPlayTwoDigit') }}" class="btn h-50 text-white" style="background-color: #2a576c; font-size:14px;">အမြန်ရွေး</a>
        <div class="">
          <h1>2D</h1>
        </div>
        <select class="h-50 text-white" style="font-size: 14px;">
          <option value="1">09:30 AM</option>
          <option value="2">12:00 PM</option>
          <option value="1">02:30 PM</option>
          <option value="2">04:00 PM</option>
        </select>
      </div>
    </div>

    <!-- <div class="d-flex justify-content-between mt-3 custom-btn">
      <button class="fs-6 px-3" id="btn-id">ပတ်လည်</button>
      <a href="{{ route('admin.QuickMorningPlayTwoDigit') }}" class="btn px-1 text-white" style="background-color: #2a576c">အမြန်ရွေးရန်</a>

    </div> -->


    <!-- <div class="d-flex justify-content-between mt-3 custom-btn">
      <a class="btn mt-3" data-bs-toggle="modal" data-bs-target="#colorModal"><span class="material-icons">
          question_mark
        </span>အရောင်ရှင်းလင်းချက်</a>
      {{-- <a href="{{ route('admin.QuickMorningPlayTwoDigit') }}" class="btn p-3 text-white" style="background-color: #2a576c">အမြန်ရွေးရန်</a> --}}
    </div> -->


    <div class=" mt-1">
      <div class="row">
        <div class="col-md-12">


        </div>
      </div>
      <div class="mt-1">
        <!-- <div class="card-header">
          <h5 class="mb-0">အရောင်ရှင်းလင်းချက်
            <span><a href="{{ url('/')}}" class="btn btn-primary">Back To Main</a></span>
          </h5>
        </div> -->
        <div class="">

          <div class="">
            <div class="form-header mb-4">
              <div class="d-flex justify-content-between mt-3 ms-3 custom-btn ">
                <input type="text" name="amount" id="all_amount" placeholder="ငွေပမာဏ" class="form-control d-block w-75 text-center border-black" />
                <button class="fs-6 d-block px-1 py-2" id="permuteButton" onclick="permuteDigits()" style="font-size: 14px;">ပတ်လည်</button>
              </div>
            </div>
          </div>
          @if ($lottery_matches->is_active == 1)
          <form action="{{ route('admin.two-d-play.store') }}" method="post" class="p-1">
            @csrf

            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="selected_digits" style="font-size: 14px;">ရွှေးချယ်ထားသောဂဏန်းများ</label>
                <input type="text" name="selected_digits" id="selected_digits" class="form-control" placeholder="" style="font-size: 30px">
              </div>

              <div class="mb-3 mt-2">
                {{-- <div class="digits-display" id="outputField_div">

        </div> --}}
                <label for="permulated_digit" style="font-size: 14px;">ပတ်လည် ဂဏန်းများ</label>
                <input type="text" id="permulated_digit" class="form-control" readonly>
              </div>

              <div id="amountInputs" class="col-md-12 mb-3 d-none"></div>

              <div class="col-md-12 mb-3">
                <label for="totalAmount" style="font-size: 14px;">စုစုပေါင်းထိုးကြေး</label>
                <input type="text" id="totalAmount" name="totalAmount" class="form-control" readonly>
              </div>

              <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <div class="col-lg-4 col-md-6 offset-lg-4 offset-md-3 py-3 submitbtns">

                <div class="d-flex justify-content-center mt-3 px-2 py-3" style="background: linear-gradient(90deg, #428387, #336876, #265166 100%); border-radius:10px;
                ">
                  <a href="{{ url('/admin/evening-play-two-d') }}" class="btn remove-btn me-2" style="font-size: 14px;">ဖျက်မည်</a>
                  <button type="submit" class="btn play-btn" style="font-size: 14px;">ထိုးမည်</button>
                </div>
              </div>
            </div>
          </form>
          @else
          <div class="text-center p-4">
            <h3>Sorry, you can't play now. Please wait for the next round.</h3>
          </div>
          @endif
        </div>
      </div>
    </div>

    <div class="container-fluid mt-1 mb-5">
      <div class="scrollable-container digit-box">
        <div class="main-row">
          @foreach ($twoDigits as $digit)
          <div class="column">

            @php
            $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
            ->where('two_digit_id', $digit->id)
            ->sum('sub_amount');
            @endphp

            @if ($totalBetAmountForTwoDigit < 50000) <div class="text-center fs-6 digit" style="background-color: {{ 'javascript:getRandomColor();' }};" onclick="selectDigit('{{ $digit->two_digit }}', this)">
              {{ $digit->two_digit }}

              <div class="progress">
                @php
                $totalAmount = 5000;
                $betAmount = $totalBetAmountForTwoDigit; // the amount already bet
                $remainAmount = $totalAmount - $betAmount; // the amount remaining that can be bet
                $percentage = ($betAmount / $totalAmount) * 100;
                @endphp

                <div class="progress-bar" style="width: {{ $percentage }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                              <small class="d-none" style="font-size: 10px">{{ $remainingAmounts[$digit->id] }}</small>
                </div>
              </div>
          </div>
          @else
          <div class="col-2 text-center digit disabled" style="background-color: {{ 'javascript:getRandomColor();' }}" onclick="showLimitFullAlert()">
            {{ $digit->two_digit }}
          </div>
          @endif

        </div>
        @endforeach
      </div>
    </div>
  </div>
  {{-- </div> --}}


</div>

</div>
{{-- modal --}}

<div class="modal fade" id="colorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title text-center">အရောင်ရှင်းလင်းချက်</h4>
        <h5 class="modal-title text-center mt-3">ထီထိုးငွေ 100% ပြည့်ပါက ဂဏန်းပိတ်ပါမည်။</h5>
        <div class="d-flex mt-3">
          <p class="betlimitcolor bg-success mt-1"></p>
          <h4 class="ms-2">50% အောက်</h4>
        </div>
        <div class="d-flex mt-3">
          <p class="betlimitcolor bg-warning mt-1"></p>
          <h4 class="ms-2">50% မှ 80%</h4>
        </div>
        <div class="d-flex mt-3">
          <p class="betlimitcolor bg-danger mt-1"></p>
          <h4 class="ms-2">80% မှ 99%</h4>
        </div>
        <div class="d-flex mt-3">
          <p class="betlimitcolor bg-secondary mt-1"></p>
          <h4 class="ms-2">ထိုးငွေပြည့်သွားပါပြီ</h4>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
<script>

</script>
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
    console.log(selectedDigits);
    // Convert num to a string to ensure "00" is not treated as 0
    num = num.toString();
    console.log(num);

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

        const amountInput = document.createElement('input');
        amountInput.setAttribute('type', 'number');
        amountInput.setAttribute('name', 'amounts[' + num + ']'); // Keep num as string
        amountInput.setAttribute('id', 'amount_' + num);
        amountInput.setAttribute('placeholder', 'Amount for ' + num);
        amountInput.setAttribute('min', '100');
        amountInput.setAttribute('max', '50000');
        amountInput.setAttribute('class', 'form-control mt-2');
        amountInput.onchange = function() {
            updateTotalAmount();
            checkBetAmount(this, num);
        };
        amountInputsDiv.appendChild(amountInput);
    }
}
  // function selectDigit(num, element) {
  //   const selectedInput = document.getElementById('selected_digits');
  //   const amountInputsDiv = document.getElementById('amountInputs');
  //   //  console.log(selectedInput);

  //   let selectedDigits = selectedInput.value ? selectedInput.value.split(",") : [];
  //   console.log(selectedDigits);
  //   // Get the remaining amount for the selected digit
  //   const remainingAmount = Number(element.querySelector('small').innerText.split(' ')[1]);


  //   // Check if the user tries to bet more than the remaining amount
  //   if (selectedDigits.includes(num)) {
  //     const betAmountInput = document.getElementById('amount_' + num);

  //     if (Number(betAmountInput.value) > remainingAmount) {
  //       Swal.fire({
  //         icon: 'error',
  //         title: 'Bet Limit Exceeded',
  //         text: `You can only bet up to ${remainingAmount} for the digit ${num}.`
  //       });
  //       return;
  //     }
  //   }

  //   // Check if the digit is already selected
  //   if (selectedDigits.includes(num)) {
  //     // If it is, remove the digit, its style, and its input field
  //     selectedInput.value = selectedInput.value.replace(num, '').replace(',,', ',').replace(/^,|,$/g, '');
  //     element.classList.remove('selected');

  //     const inputToRemove = document.getElementById('amount_' + num);
  //     amountInputsDiv.removeChild(inputToRemove);
  //   } else {
  //     // Otherwise, add the digit, its style, and its input field
  //     selectedInput.value = selectedInput.value ? selectedInput.value + "," + num : num;
  //     element.classList.add('selected');

  //     const amountInput = document.createElement('input');
  //     amountInput.setAttribute('type', 'number');
  //     amountInput.setAttribute('name', 'amounts[' + num + ']');
  //     amountInput.setAttribute('id', 'amount_' + num);
  //     amountInput.setAttribute('placeholder', 'Amount for ' + num);
  //     amountInput.setAttribute('min', '100');
  //     amountInput.setAttribute('max', '50000');
  //     amountInput.setAttribute('class', 'form-control mt-2 d-none');
  //     amountInput.onchange = function() {
  //       updateTotalAmount();
  //       checkBetAmount(this, num);
  //     };
  //     amountInputsDiv.appendChild(amountInput);
  //   }
  // }

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
    outputField.value = `${selectedDigits.join(", ")} , ${permutedDigits.join(", ")}`;

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
  // sweet alert
  document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // prevent the form from submitting immediately

    Swal.fire({
      title: 'Are you sure- ထိုးမှာလား ?',
      text: 'You are about to submit your lottery choices.',
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'No, cancel! - မထိုးပါ!',
      confirmButtonText: 'Yes, submit it! - ထိုးမယ်!'
    }).then((result) => {
      if (result.isConfirmed) {
        // If the user clicked "Yes", submit the form
        event.target.submit();
      }
    });
  });
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
