@extends('user_layout.app')
@section('style')
<link rel="stylesheet" href="{{ asset('user_app/assets/css/balance.css')}}">
<style>
    .digits-display {
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        background-color: #f8f9fa;
        max-height: 200px;
        /* or any other value you prefer */
        overflow-y: auto;
        /* enables scrolling if content is too long */
    }

    .digits-display ul {
        list-style: none;
        /* removes bullet points */
        padding: 0;
        margin: 0;
    }

    .digits-display ul li {
        margin: 5px 0;
        /* adds some space between the digits */
        padding: 3px;
        border-bottom: 1px solid #ddd;
        /* adds a separator line */
    }
</style>
@endsection
@section('content')
@include('user_layout.nav')
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
                <a href="{{ url('admin/morning-play-two-d')}}" class="btn h-50 text-white p-2" style="background-color: #2a576c; font-size:14px;">ပုံမှန်ရွေး</a>
                <div class="text-center">
                    <h1>2D </h1>
                    <span>အမြန်ရွေး</span>
                </div>
                <select class="h-50 text-white" style="font-size: 14px;">
                    <option value="1">12:00 AM</option>
                    <option value="2">04:00 PM</option>
                </select>
            </div>
        </div>
        <div class="scrollable-container overflow-scroll d-none mt-6 digit-box">
            <div class="main-row">
                @foreach ($twoDigits->chunk(3) as $chunk)
                <div class="column">
                    @foreach ($chunk as $digit)
                    @php
                    $totalBetAmountForTwoDigit = DB::table('lottery_two_digit_copy')
                    ->where('two_digit_id', $digit->id)
                    ->sum('sub_amount');
                    @endphp

                    @if ($totalBetAmountForTwoDigit < 5000) <div class="text-center digit digit-button" style="background-color: javascript:getRandomColor();" data-digit="{{ $digit->two_digit }}" onclick="selectDigit('{{ $digit->two_digit }}', this)">
                        {{ $digit->two_digit }}

                        <div class="progress">
                            @php
                            $totalAmount = 5000;
                            $betAmount = $totalBetAmountForTwoDigit; // the amount already bet
                            $remainAmount = $totalAmount - $betAmount; // the amount remaining that can be bet
                            $percentage = ($betAmount / $totalAmount) * 100;
                            @endphp

                            <div class="progress-bar" style="width: {{ $percentage }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                            <small class="d-block" style="font-size: 10px">{{ $remainingAmounts[$digit->id] }}</small>
                            </div>
                        </div>
                </div>
                @else
                <div class="col-2 text-center digit disabled" style="background-color: javascript:getRandomColor();" data-digit="{{ $digit->two_digit }}" onclick="showLimitFullAlert()">
                    {{ $digit->two_digit }}
                </div>
                @endif
                @endforeach
            </div>
            @endforeach
        </div>

    </div>

    <div class="mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between mt-3 ms-3 custom-btn ">
                    <input type="text" name="amount" id="all_amount" placeholder="ငွေပမာဏ" class="form-control w-50 text-center border-black" />
                    <button class="fs-6 d-block px-1 py-2" id="permuteButton" onclick="permuteDigits()" style="font-size: 14px;">ပတ်လည်</button>
                </div>
            </div>
        </div>

        <div class="row mt-2 p-3">
            <div class="col-md-12">
                <div class="">
                    <div class="">
                        <button type="button" id="zero" class="btn btn-primary">0</button>
                        <button type="button" id="one" class="btn btn-secondary">1</button>
                        <button type="button" id="two" class="btn btn-success">2</button>
                        <button type="button" id="three" class="btn btn-danger">3</button>
                        <button type="button" id="four" class="btn btn-warning">4</button>
                        <button type="button" id="five" class="btn btn-info">5</button>
                        <button type="button" id="six" class="btn btn-primary">6</button>
                        <button type="button" id="seven" class="btn btn-dark">7</button>
                        <button type="button" id="eight" class="btn btn-warning mt-1">8</button>
                        <button type="button" id="nine" class="btn btn-success mt-1">9</button>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="">
                        <a href="{{ route('admin.QuickOddMorningPlayTwoDigit') }}" class="btn btn-info btn-sm">မမ</a>
                        <a href="{{ route('admin.QuickEvenMorningPlayTwoDigit') }}" class="btn btn-warning btn-sm">စုံစုံ</a>
                        <a href="{{ route('admin.QuickEvenSameMorningPlayTwoDigit') }}" class="btn btn-primary btn-sm">မမ အပူး</a>
                        <a href="{{ route('admin.QuickEvenSameMorningPlayTwoDigit') }}" class="btn btn-warning btn-sm">စုံစုံ အပူး</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="">

            @if ($lottery_matches->is_active == 1)
            <form action="{{ route('admin.Quickstore') }}" method="post" class="p-4">
                @csrf
                <!-- Selected Digits Input -->
                <div class="mb-3">
                    <input type="text" id="outputField" name="selected_digits" class="form-control" placeholder="Selected digits">
                </div>

                <div class="mb-3 mt-3">
                    {{-- <div class="digits-display" id="outputField_div">

        </div> --}}
                    <label for="permulated_digit" style="font-size: 14px;">ပတ်လည် ဂဏန်းများ</label>
                    <input type="text" id="permulated_digit" class="form-control" readonly>
                </div>

                <!-- Amounts Inputs will be appended here -->
                <div id="amountInputs" class="col-md-12 mb-3 d-none"></div>

                <!-- Total Amount Input -->
                <div class="col-md-12 mb-5">
                    <label for="totalAmount" style="font-size: 14px;">Total Amount</label>
                    <input type="text" id="totalAmount" name="totalAmount" class="form-control" readonly>
                </div>

                <!-- User ID Hidden Input -->
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <!-- Submit Buttons -->
                <div class="col-lg-4 col-md-6 offset-lg-4 offset-md-3 py-3 submitbtns">

                    <div class="d-flex justify-content-center mt-3 px-2 py-3" style="background: linear-gradient(90deg, #428387, #336876, #265166 100%); border-radius:10px;
        ">
                        <a href="{{ url('/admin/quick-morning-play-two-d') }}" class="btn remove-btn me-2" style="font-size: 14px;" >ဖျက်မည်</a>
                        <button type="submit" class="btn play-btn"  style="font-size: 14px;">ထိုးမည်</button>
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


</div>

</div>

<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">ထိုးမည့်အချိန် (section) ကိုရွေးပါ</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-btn">
                    <a href="{{ url('/twodplay') }}" class="text-decoration-none btn">12:00 AM</a>
                </div>
                <div class="modal-btn mt-2">
                    <a href="#" class="text-decoration-none btn">04:00 PM</a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn modal-button">ထိုးမည်</button>
            </div>
        </div>
    </div>
</div>
{{-- @include('user_layout.footer') --}}
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
    function selectDigit(num, element) {
        const selectedInput = document.getElementById('selected_digits');
        const amountInputsDiv = document.getElementById('amountInputs');

        let selectedDigits = selectedInput.value ? selectedInput.value.split(",") : [];

        // Get the remaining amount for the selected digit
        const remainingAmount = Number(element.querySelector('small').innerText.split(' ')[1]);

        // Check if the user tries to bet more than the remaining amount
        if (selectedDigits.includes(num)) {
            const betAmountInput = document.getElementById('amount_' + num);

            if (Number(betAmountInput.value) > remainingAmount) {
                Swal.fire({
                    icon: 'error',
                    title: 'Bet Limit Exceeded',
                    text: `You can only bet up to ${remainingAmount} for the digit ${num}.`
                });
                return;
            }
        }

        // Check if the digit is already selected
        if (selectedDigits.includes(num)) {
            // If it is, remove the digit, its style, and its input field
            selectedInput.value = selectedInput.value.replace(num, '').replace(',,', ',').replace(/^,|,$/g, '');
            element.classList.remove('selected');

            const inputToRemove = document.getElementById('amount_' + num);
            amountInputsDiv.removeChild(inputToRemove);
        } else {
            // Otherwise, add the digit, its style, and its input field
            selectedInput.value = selectedInput.value ? selectedInput.value + "," + num : num;
            element.classList.add('selected');

            const amountInput = document.createElement('input');
            amountInput.setAttribute('type', 'number');
            amountInput.setAttribute('name', 'amounts[' + num + ']');
            amountInput.setAttribute('id', 'amount_' + num);
            amountInput.setAttribute('placeholder', 'Amount for ' + num);
            amountInput.setAttribute('min', '100');
            amountInput.setAttribute('max', '50000');
            amountInput.setAttribute('class', 'form-control mt-2 d-none');
            amountInput.onchange = function() {
                updateTotalAmount();
                checkBetAmount(this, num);
            };
            amountInputsDiv.appendChild(amountInput);
        }
    }

    //     outputField.value = selectedDigits.join(', ');
    // }
</script>
<script>
    // This function handles the click event for all digit buttons
    function handleDigitButtonClick(startDigit) {
        const digitsStartingWith = Array.from(document.querySelectorAll('.digit-button'))
            .filter(button => button.getAttribute('data-digit').startsWith(startDigit))
            .map(button => button.getAttribute('data-digit'));

        // Assuming 'outputField' is where the selected digits will be displayed
        const outputField = document.getElementById('outputField');
        // Add the new digits to the existing ones, separated by a comma
        outputField.value += outputField.value ? ',' + digitsStartingWith.join(',') : digitsStartingWith.join(',');

        createAmountInputs(digitsStartingWith);
    }


    // permulation
    function permuteDigits() {
        const outputField = document.getElementById('outputField');
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
            amountInput.classList.add('form-control', 'mt-2', 'd-none');
            amountInput.onchange = updateTotalAmount;
            amountInputsDiv.appendChild(amountInput);
        });

        updateTotalAmount(); // Update the total amount to reflect changes
    }


    // Attach the click event handler to each digit button
    ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'].forEach((id, index) => {
        document.getElementById(id).addEventListener('click', function() {
            handleDigitButtonClick(index.toString());
        });
    });

    function updateOutputField(digits) {
        const outputDiv = document.getElementById('outputField_div');
        outputDiv.innerHTML = '<ul>' + digits.map(num => `<li>${num}</li>`).join('') + '</ul>';
    }
    // permulation end
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

    function updateTotalAmount() {
        let total = 0;
        const inputs = document.querySelectorAll('input[name^="amounts["]'); // Get all amount inputs
        inputs.forEach(input => {
            const value = Number(input.value);
            if (value < 1 || value > 5000) {
                // If the input value is less than 100 or greater than 5000, show an error and reset the input
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid amount',
                    text: 'The amount for each two-digit number must be between 100 and 5000 MMK.'
                });
                input.value = ''; // Reset the invalid input
            } else {
                total += value; // Add valid input values to the total
            }
        });

        // Check against the user's balance
        const userBalanceSpan = document.getElementById('userBalance');
        let userBalance = Number(userBalanceSpan.getAttribute('data-balance'));

        if (userBalance < total) {
            // If the balance is insufficient, show an error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Your balance is not enough to play two digit. - သင်၏လက်ကျန်ငွေ မလုံလောက်ပါ - ကျေးဇူးပြု၍ ငွေဖြည့်ပါ။',
                footer: `<a href="{{ url('user/wallet-deposite') }}" style="background-color: #007BFF; color: #FFFFFF; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Fill Balance - ငွေဖြည့်သွင်းရန် နိုပ်ပါ </a>`
            });
        } else {
            // If the balance is sufficient, update the display
            userBalanceSpan.textContent = `လက်ကျန်ငွေ - ${(userBalance - total).toFixed(2)} MMK`; // Format for display
            userBalanceSpan.setAttribute('data-balance', userBalance - total);

            // Update the total amount display
            document.getElementById('totalAmount').value = total.toFixed(2);
        }
    }
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
