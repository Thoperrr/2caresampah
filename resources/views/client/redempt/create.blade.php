@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="max-w-5xl mx-auto px-6 mt-10">
        <section class="flex flex-col md:flex-row md:space-x-12">
            <form id="redemption-form" action="{{ route('points.redemptions.store') }}" method="POST"
                class="flex-1 max-w-lg space-y-6">
                @csrf
                <input type="hidden" name="reward_id" id="reward_id">
                <h2 class="font-extrabold text-lg">
                    Withdraw your Points to Cash
                </h2>
                <p class="text-gray-400 text-sm font-normal">
                    Get all access and an extra 20% off when you subscribe annually
                </p>
                <div>
                    <label class="block text-sm font-normal mb-1" for="name">
                        Akun
                    </label>
                    <input class="w-full border border-gray-200 rounded-md px-4 py-2 text-gray-400 cursor-not-allowed"
                        id="name" name="name" readonly="" type="text" value="{{ auth()->user()->name }}" />
                </div>
                <div>
                    <label class="block text-sm font-normal mb-1" for="method">
                        Metode Pembayaran
                    </label>
                    <select
                        class="w-full border border-gray-200 rounded-md px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="method" name="method" required>
                        <option value="">Select Payment Method</option>
                        <option value="bank">Bank Mandiri</option>
                        <option value="bank">Bank BCA</option>
                        <option value="bank">Bank BRI</option>
                        <option value="ewallet">DANA</option>
                        <option value="ewallet">GoPay</option>
                        <option value="ewallet">OVO</option>
                        <option value="ewallet">ShopeePay</option>
                        <option value="ewallet">QRIS</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-normal mb-1" for="destination">
                        Account Number / E-wallet Number
                    </label>
                    <input
                        class="w-full border border-gray-200 rounded-md px-4 py-2 text-gray-700 placeholder:text-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        id="destination" name="destination" placeholder="Input your account number or e-wallet number"
                        type="text" required />
                </div>
            </form>
            <aside class="flex-1 max-w-md mt-10 md:mt-0 space-y-6">
                <!-- Reward List -->
                <div class="grid grid-cols-3 gap-4">
                    @foreach($rewards as $reward)
                        <label class="cursor-pointer">
                            <input type="radio" name="reward" value="{{ $reward->id }}" class="hidden reward-radio"
                                data-points="{{ $reward->points_required }}" data-amount="{{ $reward->cash_value }}">
                            <div class="bg-gray-100 rounded-lg p-4 text-center hover:bg-gray-200 transition-colors reward-card">
                                <p class="text-xs font-semibold text-gray-600">
                                    {{ number_format($reward->points_required) }} Points
                                </p>
                                <p class="text-base font-bold mt-1">
                                    Rp. {{ number_format($reward->cash_value, 0, ',', '.') }}
                                </p>
                            </div>
                        </label>
                    @endforeach
                </div>
                <fieldset class="border border-gray-200 rounded-xl p-4 mt-6">
                    <legend class="text-sm font-semibold mb-2">
                        Withdrawal Details
                    </legend>
                    <div id="selected-reward" class="hidden">
                        <p class="text-sm text-gray-600">Selected Reward:</p>
                        <p class="font-semibold text-black">
                            <span id="selected-points">0</span> Points to Rp. <span id="selected-amount">0</span>
                        </p>
                    </div>
                </fieldset>
                <button id="withdraw-button"
                    class="w-full bg-gray-400 text-white font-semibold py-2 rounded-md cursor-not-allowed" type="submit"
                    form="redemption-form" disabled>
                    Withdraw
                </button>
                <p class="text-xs text-gray-400">
                    <span class="font-semibold">
                        By Continuing
                    </span>
                    <a class="text-blue-500" href="#">
                        you agree to our terms and conditions.
                    </a>
                </p>
            </aside>
        </section>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const rewardRadios = document.querySelectorAll('.reward-radio');
                const rewardCards = document.querySelectorAll('.reward-card');
                const selectedReward = document.getElementById('selected-reward');
                const selectedPoints = document.getElementById('selected-points');
                const selectedAmount = document.getElementById('selected-amount');
                const withdrawButton = document.getElementById('withdraw-button');
                const rewardIdInput = document.getElementById('reward_id');

                rewardRadios.forEach((radio, index) => {
                    radio.addEventListener('change', function () {
                        // Remove selected state from all cards
                        rewardCards.forEach(card => card.classList.remove('bg-blue-100', 'border-2', 'border-blue-500'));

                        if (this.checked) {
                            // Add selected state to the chosen card
                            rewardCards[index].classList.add('bg-blue-100', 'border-2', 'border-blue-500');

                            // Update selected reward details
                            const points = this.dataset.points;
                            const amount = this.dataset.amount;

                            selectedPoints.textContent = new Intl.NumberFormat('id-ID').format(points);
                            selectedAmount.textContent = new Intl.NumberFormat('id-ID').format(amount);

                            // Set the reward ID in the hidden input
                            rewardIdInput.value = this.value;

                            selectedReward.classList.remove('hidden');
                            withdrawButton.classList.remove('bg-gray-400', 'cursor-not-allowed');
                            withdrawButton.classList.add('bg-blue-500', 'cursor-pointer');
                            withdrawButton.disabled = false;
                        }
                    });
                });
            });
        </script>
    @endpush

    @include('layouts.footer')
@endsection