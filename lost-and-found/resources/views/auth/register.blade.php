@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-lg w-full space-y-8">
        <div class="text-center">
            <!-- Logo and Branding -->
            <div class="flex justify-center mb-6">
                <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-user-plus text-white text-2xl"></i>
                </div>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h2>
            <p class="text-gray-600">Join Strathmore Lost & Found community</p>
        </div>

        <!-- Registration Form Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Full Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-gray-400 mr-2"></i>Full Name
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus 
                        autocomplete="name"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        placeholder="Enter your full name"
                    >
                    @error('name')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Student ID -->
                <div>
                    <label for="student_id" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-id-card text-gray-400 mr-2"></i>Student/Staff ID
                    </label>
                    <input 
                        id="student_id" 
                        type="text" 
                        name="student_id" 
                        value="{{ old('student_id') }}" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('student_id') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        placeholder="e.g., 123456 or STF001"
                    >
                    @error('student_id')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Enter your university student ID or staff ID number</p>
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-gray-400 mr-2"></i>Email Address
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autocomplete="username"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        placeholder="Enter your email address"
                    >
                    @error('email')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Preferably use your university email (@strathmore.edu)</p>
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone text-gray-400 mr-2"></i>Phone Number
                    </label>
                    <input 
                        id="phone" 
                        type="tel" 
                        name="phone" 
                        value="{{ old('phone') }}" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('phone') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                        placeholder="e.g., +254700123456"
                    >
                    @error('phone')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Optional - for contact when items are found</p>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200 @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                            placeholder="Create a strong password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password')" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                        >
                            <i id="password-toggle-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="mt-2 flex items-center text-red-600 text-sm">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            {{ $message }}
                        </div>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500">Minimum 8 characters with letters and numbers</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock text-gray-400 mr-2"></i>Confirm Password
                    </label>
                    <div class="relative">
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                            placeholder="Confirm your password"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password_confirmation')" 
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600"
                        >
                            <i id="password_confirmation-toggle-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-start">
                    <input 
                        id="terms" 
                        type="checkbox" 
                        required
                        class="mt-1 h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    >
                    <label for="terms" class="ml-3 text-sm text-gray-600">
                        I agree to the 
                        <a href="{{ route('terms.show') }}" class="text-blue-600 hover:text-blue-800 font-medium">Terms of Service</a> 
                        and 
                        <a href="{{ route('privacy.show') }}" class="text-blue-600 hover:text-blue-800 font-medium">Privacy Policy</a>
                        of Strathmore University Lost & Found System
                    </label>
                </div>

                <!-- Register Button -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    <i class="fas fa-user-plus mr-2"></i>
                    Create Account
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm">
                    Already have an account?
                    <a href="{{ route('login') }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium transition duration-200">
                        Sign in here
                    </a>
                </p>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center">
            <p class="text-sm text-gray-500">
                <i class="fas fa-shield-alt mr-1"></i>
                Secure registration for Strathmore University community
            </p>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const passwordInput = document.getElementById(fieldId);
    const toggleIcon = document.getElementById(fieldId + '-toggle-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Real-time password confirmation validation
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const passwordConfirmation = document.getElementById('password_confirmation');
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type="submit"]');
    
    function validatePasswordMatch() {
        if (passwordConfirmation.value && password.value !== passwordConfirmation.value) {
            passwordConfirmation.classList.add('border-red-500');
            passwordConfirmation.classList.remove('border-gray-300');
        } else {
            passwordConfirmation.classList.remove('border-red-500');
            passwordConfirmation.classList.add('border-gray-300');
        }
    }
    
    password.addEventListener('input', validatePasswordMatch);
    passwordConfirmation.addEventListener('input', validatePasswordMatch);
    
    // Form submission loading state
    form.addEventListener('submit', function() {
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Account...';
        submitButton.disabled = true;
    });
    
    // Student ID formatting (optional)
    const studentIdInput = document.getElementById('student_id');
    studentIdInput.addEventListener('input', function() {
        // Convert to uppercase for consistency
        this.value = this.value.toUpperCase();
    });
});
</script>
@endsection