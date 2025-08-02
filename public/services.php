<?php 
$title = 'Services';
require_once 'includes/header.php'; 
?>

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-700 text-white">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">
                Our Services
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-blue-100">
                Comprehensive AI-driven solutions and automation services tailored to your business needs
            </p>
        </div>
    </div>
</section>

<!-- Services Overview -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">What We Offer</h2>
            <p class="text-gray-600 max-w-3xl mx-auto">
                From consultation to implementation, we provide end-to-end services that transform your business operations through intelligent automation and cutting-edge AI technology.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- AI Consultation & Strategy -->
            <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-blue-600">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-center">🧠 AI Consultation & Strategy</h3>
                <p class="text-gray-600 text-center mb-4">
                    Strategic planning and roadmap development for AI implementation in your organization
                </p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>• AI readiness assessment</li>
                    <li>• Technology stack recommendations</li>
                    <li>• ROI analysis and business case development</li>
                    <li>• Implementation timeline planning</li>
                </ul>
            </div>

            <!-- Custom Software Development -->
            <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-green-600">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-center">⚡ Custom Software Development</h3>
                <p class="text-gray-600 text-center mb-4">
                    Tailored software solutions built specifically for your business requirements
                </p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>• Full-stack web applications</li>
                    <li>• Mobile app development</li>
                    <li>• API development and integration</li>
                    <li>• Legacy system modernization</li>
                </ul>
            </div>

            <!-- Process Automation -->
            <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-purple-600">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-center">🔄 Process Automation</h3>
                <p class="text-gray-600 text-center mb-4">
                    Streamline operations and reduce manual work through intelligent automation
                </p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>• Workflow automation design</li>
                    <li>• Document processing automation</li>
                    <li>• Data migration and synchronization</li>
                    <li>• Quality assurance automation</li>
                </ul>
            </div>

            <!-- AI Integration Services -->
            <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-orange-600">
                <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-center">🤖 AI Integration Services</h3>
                <p class="text-gray-600 text-center mb-4">
                    Seamlessly integrate AI capabilities into your existing systems and workflows
                </p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>• Machine learning model deployment</li>
                    <li>• Chatbot and virtual assistant integration</li>
                    <li>• Predictive analytics implementation</li>
                    <li>• Computer vision solutions</li>
                </ul>
            </div>

            <!-- Cloud & Infrastructure -->
            <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-indigo-600">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-center">☁️ Cloud & Infrastructure</h3>
                <p class="text-gray-600 text-center mb-4">
                    Scalable cloud solutions and infrastructure management for optimal performance
                </p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>• Cloud migration and setup</li>
                    <li>• DevOps and CI/CD implementation</li>
                    <li>• Security and compliance management</li>
                    <li>• Performance monitoring and optimization</li>
                </ul>
            </div>

            <!-- Support & Maintenance -->
            <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-red-600">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5zM8.25 12l7.5-7.5"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold mb-4 text-center">🛠️ Support & Maintenance</h3>
                <p class="text-gray-600 text-center mb-4">
                    Ongoing support and maintenance to ensure your systems run smoothly
                </p>
                <ul class="text-sm text-gray-600 space-y-2">
                    <li>• 24/7 technical support</li>
                    <li>• Regular system updates and patches</li>
                    <li>• Performance monitoring and optimization</li>
                    <li>• User training and documentation</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Service Process -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold mb-4">Our Service Process</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                We follow a structured approach to ensure successful project delivery and client satisfaction
            </p>
        </div>
        
        <div class="grid md:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                <h3 class="text-lg font-semibold mb-2">Discovery</h3>
                <p class="text-gray-600 text-sm">Understanding your business needs and current challenges</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                <h3 class="text-lg font-semibold mb-2">Planning</h3>
                <p class="text-gray-600 text-sm">Developing a comprehensive strategy and implementation plan</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                <h3 class="text-lg font-semibold mb-2">Implementation</h3>
                <p class="text-gray-600 text-sm">Building and deploying your customized solution</p>
            </div>
            
            <div class="text-center">
                <div class="w-16 h-16 bg-blue-600 text-white rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">4</div>
                <h3 class="text-lg font-semibold mb-2">Support</h3>
                <p class="text-gray-600 text-sm">Ongoing maintenance and optimization of your systems</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="bg-blue-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Transform Your Business?</h2>
        <p class="text-xl mb-8 text-blue-100 max-w-2xl mx-auto">
            Let's discuss how our services can help you achieve your business goals through intelligent automation and AI solutions.
        </p>
        <div class="space-x-4">
            <a href="/contact" class="bg-white text-blue-600 px-6 py-3 rounded-md hover:bg-gray-100 font-medium inline-block">Get Started Today</a>
            <a href="/products" class="border border-white text-white px-6 py-3 rounded-md hover:bg-white hover:text-blue-600 font-medium inline-block">View Our Products</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>