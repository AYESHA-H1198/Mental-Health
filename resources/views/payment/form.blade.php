@extends('layout.user')

@section('title', 'Make Payment')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Roboto:wght@400;500&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9fafc;
        }

        .payment-wrapper {
            max-width: 520px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .payment-wrapper h2 {
            font-family: 'Merriweather', serif;
            font-size: 1.8rem;
            text-align: center;
            color: #7b4f75;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            color: #1d3557;
            margin-top: 1rem;
            display: block;
        }

        select,
        input[type="number"],
        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 1rem;
            background-color: #fefefe;
            transition: border-color 0.3s ease;
        }

        select:focus,
        input:focus {
            border-color: #a78bfa;
            outline: none;
            box-shadow: 0 0 0 3px rgba(167, 139, 250, 0.2);
        }

        .message {
            padding: 12px;
            border-radius: 10px;
            font-weight: 500;
            margin-bottom: 15px;
            text-align: center;
        }

        .success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(to right, #f472b6, #a78bfa);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 24px;
            transition: 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #ec4899, #7c3aed);
            transform: scale(1.03);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #6d28d9;
            font-weight: bold;
            font-size: 0.95rem;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>

    <div class="payment-wrapper">
        <h2>💳 Payment for Appointment #{{ $appointment->Anum }}</h2>

        @if (session('error'))
            <div class="message error">{{ session('error') }}</div>
        @endif

        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('payment.process') }}" id="payment-form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="Anum" value="{{ $appointment->Anum }}">

            <label for="type">Payment Type:</label>
            <select name="type" id="type" required>
                <option value="">-- Select Type --</option>
                <option value="Cash">Cash</option>
                <option value="Credit">Credit (Stripe)</option>
                <option value="Online">Online (Easypaisa)</option>
                <option value="Mobile">Mobile (JazzCash)</option>
            </select>

            <label for="Amt_display">Amount:</label>
            <input type="text" id="Amt_display" value="2000 PKR" readonly required>
            <input type="hidden" name="Amt" id="Amt" value="2000">

            <!-- Easypaisa Fields -->
            <div id="easypaisa-details" style="display: none;">
                <p><strong>Easypaisa No:</strong> 03425939663 (Ayesha Fayyaz)</p>
                <label for="easypaisa_txn_id">Transaction ID:</label>
                <input type="text" name="easypaisa_txn_id" id="easypaisa_txn_id">

                <label for="easypaisa_screenshot">Upload Screenshot:</label>
                <input type="file" name="easypaisa_screenshot" id="easypaisa_screenshot" accept="image/*">
            </div>

            <!-- JazzCash Fields -->
            <div id="jazzcash-details" style="display: none;">
                <p><strong>JazzCash No:</strong> 03009342480 (Ayesha Fayyaz)</p>
                <label for="jazzcash_txn_id">Transaction ID:</label>
                <input type="text" name="jazzcash_txn_id" id="jazzcash_txn_id">

                <label for="jazzcash_screenshot">Upload Screenshot:</label>
                <input type="file" name="jazzcash_screenshot" id="jazzcash_screenshot" accept="image/*">
            </div>

            <button type="submit">💰 Pay Now</button>
        </form>

        <a href="{{ route('user.dashboard') }}" class="back-link">⬅ Back to Dashboard</a>
    </div>
@endsection

@section('scripts')
<script>
    const typeSelector = document.getElementById('type');
    const amtInput = document.getElementById('Amt');
    const amtDisplay = document.getElementById('Amt_display');
    const form = document.getElementById('payment-form');

    const easypaisaDetails = document.getElementById('easypaisa-details');
    const jazzcashDetails = document.getElementById('jazzcash-details');

    typeSelector.addEventListener('change', function () {
        const type = this.value;

        // Hide all method-specific fields
        easypaisaDetails.style.display = 'none';
        jazzcashDetails.style.display = 'none';

        let amount = 2000;

        if (type === 'Cash') amount = 2200;
        else if (type === 'Online') {
            amount = 2000;
            easypaisaDetails.style.display = 'block';
        } else if (type === 'Mobile') {
            amount = 2000;
            jazzcashDetails.style.display = 'block';
        }

        amtDisplay.value = amount + ' PKR';
        amtInput.value = amount;
    });

    form.addEventListener('submit', function (e) {
        const selectedType = typeSelector.value;

        if (selectedType === 'Online') {
            const txnId = document.getElementById('easypaisa_txn_id').value.trim();
            const screenshot = document.getElementById('easypaisa_screenshot').files.length;

            if (!txnId || !screenshot) {
                e.preventDefault();
                alert("Please enter Easypaisa Transaction ID and upload the screenshot.");
                return;
            }
        }

        if (selectedType === 'Mobile') {
            const txnId = document.getElementById('jazzcash_txn_id').value.trim();
            const screenshot = document.getElementById('jazzcash_screenshot').files.length;

            if (!txnId || !screenshot) {
                e.preventDefault();
                alert("Please enter JazzCash Transaction ID and upload the screenshot.");
                return;
            }
        }

        if (selectedType === 'Credit') {
            e.preventDefault();
            window.open("https://buy.stripe.com/test_28E6oG573b3s9KVdBC5wI00", "_blank");
            window.location.href = "{{ route('user.dashboard') }}";
        }
    });
</script>
@endsection
