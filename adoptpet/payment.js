const form = document.getElementById('paymentForm');
        const amountInput = document.getElementById('amount');
        const phoneInput = document.getElementById('phone');
        const nameInput = document.getElementById('name');
    
        // Add event listener to form submission
        form.addEventListener('submit', function(event) {
            // Prevent default form submission
            event.preventDefault();
    
            // Call validation functions and check if all are valid
            const isAmountValid = validateAmount();
            const isPhoneValid = validatePhone();
            const isNameValid = validateName();
    
            // If all validations pass, submit the form
            if (isAmountValid && isPhoneValid && isNameValid) {
                form.submit();
            }
        });
    
        // Validation functions
        function validateAmount() {
            const amountValue = amountInput.value.trim();
            const amountError = document.getElementById('amountError');
    
            if (!(/^\d+$/.test(amountValue))) {
                amountError.textContent = 'Amount should be a number';
                return false;
            }
    
            if (parseInt(amountValue) >= 100000) {
                amountError.textContent = 'Amount should be less than 100,000';
                return false;
            }
    
            amountError.textContent = ''; 
            return true;
        }
    
        function validatePhone() {
            const phoneValue = phoneInput.value.trim();
            const phoneError = document.getElementById('phoneError');
    
            if (!(/^\d{10}$/.test(phoneValue))) {
                phoneError.textContent = 'Phone number should be 10 digits';
                return false;
            }
    
            phoneError.textContent = ''; 
            return true;
        }
    
        function validateName() {
            const nameValue = nameInput.value.trim();
            const nameError = document.getElementById('nameError');
    
            if (!(/^[a-zA-Z\s]+$/.test(nameValue))) {
                nameError.textContent = 'Name should only contain alphabets and spaces';
                return false;
            }
    
            nameError.textContent = ''; 
            return true;
        }





        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var amount = document.getElementById('amount').value;
            var name = document.getElementById('name').value
            var phone = document.getElementById('phone').value;
          
            var options = {
              key: 'rzp_test_9BJ0z9nca8Qlth',
              amount: amount * 100,  // Amount is in paise
              currency: 'INR',
              name: 'Hostel Management System',
              description: 'Payment for hostel fees',
              image: 'https://example.com/logo.png',  // Your logo URL
              handler: function(response) {
                alert('Payment successful!Payment ID: sonunikule@ybl'+ pay_NcQONjBd2p4K11);
                // You can handle the payment success here
              },
              prefill: {
                name: name,
                email: email,
                contact: phone
              },
              theme: {
                color: '#007bff'
              }
            };
          
            var rzp = new Razorpay(options);
            rzp.open();
          });