// Verify code
function moveToNext(currentInput) {
    const maxLength = parseInt(currentInput.getAttribute('maxlength'));
    const inputValue = currentInput.value;

    if (inputValue.length === maxLength) {
      const nextInput = currentInput.nextElementSibling;
      if (nextInput) {
        nextInput.focus();
      }
    } else if (inputValue.length === 0) {
      const prevInput = currentInput.previousElementSibling;
      if (prevInput) {
        prevInput.focus();
      }
    }
  }

  function verifyCode() {
    const verificationCode = document.getElementById('box1').value +
                              document.getElementById('box2').value +
                              document.getElementById('box3').value +
                              document.getElementById('box4').value;

    // Perform verification logic here
    if (verificationCode.length === 4) {
      alert('Verification successful!'); // Replace with your actual verification logic
    } else {
      alert('Please enter a valid four-digit code.');
    }
  }