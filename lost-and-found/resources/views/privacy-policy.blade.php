@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-4xl sm:mx-auto">
            <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
                <div class="max-w-4xl mx-auto">
                    <div class="divide-y divide-gray-200">
                        <div class="pb-8">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">Privacy Policy</h1>
                            <p class="text-sm text-gray-600">Last updated: {{ date('F j, Y') }}</p>
                        </div>
                        
                        <div class="pt-8 space-y-8">
                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">1. Information We Collect</h2>
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Personal Information</h3>
                                        <p class="text-gray-700 mb-2">When you register for our Lost & Found platform, we collect:</p>
                                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                                            <li>Name and email address</li>
                                            <li>Contact information (phone number, if provided)</li>
                                            <li>Profile information you choose to share</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Item Information</h3>
                                        <p class="text-gray-700 mb-2">When you post lost or found items, we collect:</p>
                                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                                            <li>Item descriptions and categories</li>
                                            <li>Location information where items were lost or found</li>
                                            <li>Photos of items (if uploaded)</li>
                                            <li>Date and time information</li>
                                            <li>Contact preferences for that specific item</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Technical Information</h3>
                                        <p class="text-gray-700 mb-2">We automatically collect:</p>
                                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                                            <li>IP address and browser information</li>
                                            <li>Device information and operating system</li>
                                            <li>Usage patterns and interaction data</li>
                                            <li>Session information and login timestamps</li>
                                        </ul>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">2. How We Use Your Information</h2>
                                <p class="text-gray-700 mb-3">We use the collected information for the following purposes:</p>
                                <ul class="list-disc list-inside text-gray-700 space-y-2">
                                    <li><strong>Platform Functionality:</strong> To enable you to post, search, and browse lost and found items</li>
                                    <li><strong>User Communication:</strong> To facilitate communication between users regarding potential item matches</li>
                                    <li><strong>Account Management:</strong> To create and maintain your user account and provide customer support</li>
                                    <li><strong>Platform Security:</strong> To detect and prevent fraud, abuse, and unauthorized access</li>
                                    <li><strong>Platform Improvement:</strong> To analyze usage patterns and improve our services</li>
                                    <li><strong>Legal Compliance:</strong> To comply with applicable laws and legal obligations</li>
                                </ul>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">3. Information Sharing and Disclosure</h2>
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Public Information</h3>
                                        <p class="text-gray-700">
                                            Item listings (descriptions, photos, general location, and contact preferences) are visible to all platform users to facilitate item recovery. Your personal contact information is only shared when you choose to respond to inquiries about specific items.
                                        </p>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Limited Sharing</h3>
                                        <p class="text-gray-700 mb-2">We may share your information in the following limited circumstances:</p>
                                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                                            <li>With your explicit consent</li>
                                            <li>To comply with legal requirements or court orders</li>
                                            <li>To protect our rights, property, or safety, or that of our users</li>
                                            <li>In connection with a business transfer or merger</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">No Commercial Sharing</h3>
                                        <p class="text-gray-700">
                                            We do not sell, rent, or otherwise commercially distribute your personal information to third parties for marketing purposes.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">4. Data Storage and Security</h2>
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Security Measures</h3>
                                        <p class="text-gray-700">
                                            We implement appropriate technical and organizational security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. This includes encryption, secure servers, and regular security assessments.
                                        </p>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Data Retention</h3>
                                        <p class="text-gray-700 mb-2">We retain your information for as long as necessary to:</p>
                                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                                            <li>Provide our services and maintain your account</li>
                                            <li>Comply with legal obligations</li>
                                            <li>Resolve disputes and enforce our agreements</li>
                                        </ul>
                                        <p class="text-gray-700 mt-2">
                                            Item listings may be automatically archived or removed after a certain period of inactivity.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">5. Your Privacy Rights</h2>
                                <div class="space-y-4">
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Access and Control</h3>
                                        <p class="text-gray-700 mb-2">You have the right to:</p>
                                        <ul class="list-disc list-inside text-gray-700 space-y-1">
                                            <li>Access and review your personal information</li>
                                            <li>Update or correct your personal information</li>
                                            <li>Delete your account and associated data</li>
                                            <li>Manage your item listings and visibility preferences</li>
                                            <li>Control communication preferences</li>
                                        </ul>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 mb-2">Data Portability</h3>
                                        <p class="text-gray-700">
                                            Upon request, we can provide you with a copy of your personal data in a structured, commonly used format.
                                        </p>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">6. Cookies and Tracking</h2>
                                <p class="text-gray-700 mb-3">
                                    We use cookies and similar technologies to enhance your experience on our platform:
                                </p>
                                <ul class="list-disc list-inside text-gray-700 space-y-2">
                                    <li><strong>Essential Cookies:</strong> Required for basic platform functionality and security</li>
                                    <li><strong>Preference Cookies:</strong> Remember your settings and preferences</li>
                                    <li><strong>Analytics Cookies:</strong> Help us understand how users interact with our platform</li>
                                </ul>
                                <p class="text-gray-700 mt-3">
                                    You can control cookie settings through your browser preferences, though disabling certain cookies may affect platform functionality.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">7. Third-Party Services</h2>
                                <p class="text-gray-700 mb-3">
                                    Our platform may integrate with third-party services for functionality such as:
                                </p>
                                <ul class="list-disc list-inside text-gray-700 space-y-1">
                                    
                                    <li>Email services for notifications</li>
                                    <li>Analytics services for platform improvement</li>
                                </ul>
                                <p class="text-gray-700 mt-3">
                                    These third-party services have their own privacy policies, and we encourage you to review them.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">8. Children's Privacy</h2>
                                <p class="text-gray-700 leading-relaxed">
                                    Our platform is not intended for children under 13 years of age. We do not knowingly collect personal information from children under 13. If we become aware that a child under 13 has provided us with personal information, we will take steps to delete such information.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">9. Changes to Privacy Policy</h2>
                                <p class="text-gray-700 leading-relaxed">
                                    We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. We will notify users of significant changes and post the updated policy on our platform with a new "Last updated" date.
                                </p>
                            </section>

                            <section>
                                <h2 class="text-xl font-semibold text-gray-900 mb-4">10. Contact Us</h2>
                                <p class="text-gray-700 leading-relaxed">
                                    If you have any questions about this Privacy Policy, want to exercise your privacy rights, or have concerns about how we handle your personal information, please contact us through our support system or via the contact information provided on the university's main platform.
                                </p>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer with links -->
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