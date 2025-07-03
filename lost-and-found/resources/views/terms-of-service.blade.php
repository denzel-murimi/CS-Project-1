@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-4xl sm:mx-auto">
            {{-- Optional: If you have a fancy card background --}}
            {{-- <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-light-blue-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:rotate-3 sm:rounded-3xl"></div> --}}
            
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-4xl mx-auto">
                    <div class="divide-y divide-gray-200">
                        <div class="pb-8">
                            {{-- Assuming your primary text color is dark, or you want a specific "heading" color --}}
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">Terms of Service</h1>
                            {{-- Often small text like this might use a lighter secondary color --}}
                            <p class="text-sm text-gray-600">Last updated: {{ date('F j, Y') }}</p>
                        </div>
                        
                        <div class="pt-8 space-y-8">
                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">1. Acceptance of Terms</h2>
                                {{-- Main body text often uses a slightly darker gray than helper text --}}
                                <p class="text-gray-700 leading-relaxed">
                                    By accessing and using this Lost and Found platform, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">2. Platform Purpose</h2>
                                <p class="text-gray-700 leading-relaxed mb-3">
                                    This platform is designed to help users report lost items and found items to facilitate reunification. The service is provided free of charge to help our community members recover their belongings.
                                </p>
                                <ul class="list-disc list-inside text-gray-700 space-y-2">
                                    <li>Report lost items with detailed descriptions</li>
                                    <li>Report found items to help return them to owners</li>
                                    <li>Browse and search through lost and found listings</li>
                                    <li>Contact other users regarding potential matches</li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">3. User Responsibilities</h2>
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Accurate Information</h3>
                                        <p class="text-gray-700">Users must provide accurate, truthful, and complete information when posting lost or found items.</p>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Legitimate Claims</h3>
                                        <p class="text-gray-700">Users must only claim items that genuinely belong to them and provide adequate proof of ownership when requested.</p>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Respectful Communication</h3>
                                        <p class="text-gray-700">All interactions through the platform must be respectful, honest, and conducted in good faith.</p>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">4. Prohibited Activities</h2>
                                <p class="text-gray-700 mb-3">The following activities are strictly prohibited:</p>
                                <ul class="list-disc list-inside text-gray-700 space-y-2">
                                    <li>Posting false or fraudulent lost/found reports</li>
                                    <li>Attempting to claim items that do not belong to you</li>
                                    <li>Using the platform for commercial purposes or spam</li>
                                    <li>Posting inappropriate, offensive, or harmful content</li>
                                    <li>Harassing or intimidating other users</li>
                                    <li>Attempting to bypass security features or access unauthorized areas</li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">5. Item Verification and Ownership</h2>
                                <p class="text-gray-700 leading-relaxed mb-3">
                                    While we provide a platform for users to connect, we do not verify the ownership of items or mediate disputes. Users are responsible for:
                                </p>
                                <ul class="list-disc list-inside text-gray-700 space-y-2">
                                    <li>Verifying the identity of persons claiming their items</li>
                                    <li>Requesting adequate proof of ownership before returning items</li>
                                    <li>Meeting in safe, public locations for item exchanges</li>
                                    <li>Using their own judgment when interacting with other users</li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">6. Privacy and Data Protection</h2>
                                <p class="text-gray-700 leading-relaxed">
                                    We respect your privacy and handle your personal information in accordance with our Privacy Policy. By using this service, you consent to the collection and use of your information as described in our Privacy Policy.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">7. Limitation of Liability</h2>
                                <p class="text-gray-700 leading-relaxed mb-3">
                                    This platform serves as a facilitator for lost and found items. We are not responsible for:
                                </p>
                                <ul class="list-disc list-inside text-gray-700 space-y-2">
                                    <li>The accuracy of user-submitted information</li>
                                    <li>Disputes between users regarding item ownership</li>
                                    <li>Lost, stolen, or damaged items during exchanges</li>
                                    <li>Any fraudulent activity by users</li>
                                    <li>Safety issues arising from user meetings or interactions</li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">8. Content Moderation</h2>
                                <p class="text-gray-700 leading-relaxed">
                                    We reserve the right to review, edit, or remove any content that violates these terms or is deemed inappropriate. We may also suspend or terminate user accounts for violations of these terms.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">9. Modifications to Terms</h2>
                                <p class="text-gray-700 leading-relaxed">
                                    We reserve the right to modify these terms at any time. Users will be notified of significant changes, and continued use of the platform constitutes acceptance of the modified terms.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">10. Contact Information</h2>
                                <p class="text-gray-700 leading-relaxed">
                                    If you have any questions about these Terms of Service, please contact us through our support system or via the contact information provided on the university's main platform.
                                </p>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white border-t border-gray-200 mt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex justify-center space-x-6 text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-gray-700">Home</a>
                <a href="{{ route('privacy.show') }}" class="hover:text-gray-700">Privacy Policy</a>
                <a href="{{ route('terms.show') }}" class="hover:text-gray-700">Terms of Service</a>
            </div>
        </div>
    </footer>
@endsection