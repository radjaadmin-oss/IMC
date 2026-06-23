<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            // Company Pages
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => '<h2>Welcome to RADJATIKET</h2>

<p>RADJATIKET is Indonesia\'s leading online ticketing platform, connecting event organizers with millions of event-goers nationwide. Since our inception, we\'ve been committed to making event discovery and ticket purchasing seamless, secure, and enjoyable.</p>

<h3>Our Mission</h3>

<p>To revolutionize the event industry by providing a trusted, user-friendly platform that empowers event organizers to reach their audience and enables event enthusiasts to discover and experience unforgettable moments.</p>

<h3>What We Offer</h3>

<ul>
<li><strong>Secure Ticketing:</strong> Industry-leading security measures to protect your transactions</li>
<li><strong>Wide Selection:</strong> From concerts and festivals to workshops and conferences</li>
<li><strong>Easy Management:</strong> Comprehensive tools for event organizers</li>
<li><strong>24/7 Support:</strong> Dedicated customer service team ready to assist you</li>
</ul>

<h3>Why Choose RADJATIKET?</h3>

<p>With thousands of successful events and millions of satisfied customers, RADJATIKET has become the go-to platform for event ticketing in Indonesia. Our innovative technology, combined with exceptional customer service, ensures that every event is a success.</p>

<p>Join us in creating memorable experiences, one event at a time.</p>',
                'meta_description' => 'Learn about RADJATIKET - Indonesia\'s leading online ticketing platform connecting event organizers with millions of event-goers.',
                'is_published' => true,
                'order' => 1,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'content' => '<h2>Get in Touch</h2>

<p>We\'d love to hear from you! Whether you have questions, feedback, or need assistance, our team is here to help.</p>

<h3>Customer Support</h3>

<p><strong>Email:</strong> support@radjatiket.com<br>
<strong>Phone:</strong> +62 812-3456-7890<br>
<strong>Hours:</strong> Monday - Friday, 9:00 AM - 6:00 PM WIB</p>

<h3>Business Inquiries</h3>

<p><strong>Email:</strong> business@radjatiket.com<br>
<strong>Phone:</strong> +62 821-9876-5432</p>

<h3>Office Address</h3>

<p>RADJATIKET Indonesia<br>
Jl. Sudirman Kav. 52-53<br>
Jakarta Selatan 12190<br>
Indonesia</p>

<h3>Social Media</h3>

<p>Follow us for the latest updates, promotions, and event announcements:</p>

<ul>
<li>Instagram: @radjatiket</li>
<li>Twitter: @radjatiket</li>
<li>Facebook: /radjatiket</li>
<li>TikTok: @radjatiket</li>
</ul>

<p>For urgent matters outside business hours, please contact our 24/7 emergency hotline: +62 811-2233-4455</p>',
                'meta_description' => 'Contact RADJATIKET for support, business inquiries, or general questions. We\'re here to help you 24/7.',
                'is_published' => true,
                'order' => 2,
            ],
            [
                'title' => 'Careers',
                'slug' => 'careers',
                'content' => '<h2>Join Our Team</h2>

<p>At RADJATIKET, we\'re always looking for talented individuals who are passionate about creating exceptional experiences for our customers and partners.</p>

<h3>Why Work With Us?</h3>

<ul>
<li><strong>Innovative Environment:</strong> Work with cutting-edge technology in the events industry</li>
<li><strong>Growth Opportunities:</strong> Continuous learning and career development programs</li>
<li><strong>Competitive Benefits:</strong> Attractive salary packages, health insurance, and more</li>
<li><strong>Work-Life Balance:</strong> Flexible working arrangements and generous leave policies</li>
<li><strong>Amazing Culture:</strong> Collaborative, inclusive, and fun work environment</li>
</ul>

<h3>Current Openings</h3>

<p>We\'re currently hiring for the following positions:</p>

<ul>
<li>Senior Backend Developer (Laravel/PHP)</li>
<li>Frontend Developer (Vue.js/React)</li>
<li>Product Manager</li>
<li>Customer Success Manager</li>
<li>Marketing Specialist</li>
</ul>

<h3>How to Apply</h3>

<p>Send your CV and portfolio to <strong>careers@radjatiket.com</strong> with the subject line "Application - [Position Name]".</p>

<p>Please include:</p>
<ol>
<li>Updated CV/Resume</li>
<li>Cover letter explaining why you\'re a great fit</li>
<li>Portfolio or relevant work samples (if applicable)</li>
<li>Expected salary range</li>
</ol>

<p>We look forward to hearing from you!</p>',
                'meta_description' => 'Join the RADJATIKET team! Explore career opportunities and be part of Indonesia\'s leading event ticketing platform.',
                'is_published' => true,
                'order' => 3,
            ],

            // Information Pages
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => '<h2>Privacy Policy</h2>

<p><em>Last updated: June 23, 2026</em></p>

<h3>1. Introduction</h3>

<p>RADJATIKET ("we", "our", or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our platform.</p>

<h3>2. Information We Collect</h3>

<h4>Personal Information</h4>
<ul>
<li>Name, email address, phone number</li>
<li>Payment information (processed securely by third-party providers)</li>
<li>Profile information and preferences</li>
</ul>

<h4>Automatically Collected Information</h4>
<ul>
<li>IP address, browser type, device information</li>
<li>Usage data and interaction with our platform</li>
<li>Cookies and similar tracking technologies</li>
</ul>

<h3>3. How We Use Your Information</h3>

<p>We use collected information to:</p>
<ul>
<li>Process ticket purchases and event registrations</li>
<li>Send order confirmations and event updates</li>
<li>Provide customer support</li>
<li>Improve our platform and services</li>
<li>Send promotional communications (with your consent)</li>
<li>Prevent fraud and ensure platform security</li>
</ul>

<h3>4. Information Sharing</h3>

<p>We may share your information with:</p>
<ul>
<li>Event organizers (for events you register for)</li>
<li>Payment processors and service providers</li>
<li>Legal authorities when required by law</li>
</ul>

<p>We do NOT sell your personal information to third parties.</p>

<h3>5. Data Security</h3>

<p>We implement industry-standard security measures including encryption, secure servers, and regular security audits to protect your information.</p>

<h3>6. Your Rights</h3>

<p>You have the right to:</p>
<ul>
<li>Access and update your personal information</li>
<li>Request deletion of your account and data</li>
<li>Opt-out of marketing communications</li>
<li>Request data portability</li>
</ul>

<h3>7. Contact Us</h3>

<p>For privacy-related questions, contact us at: <strong>privacy@radjatiket.com</strong></p>',
                'meta_description' => 'Read RADJATIKET\'s Privacy Policy to understand how we collect, use, and protect your personal information.',
                'is_published' => true,
                'order' => 4,
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'content' => '<h2>Terms of Service</h2>

<p><em>Last updated: June 23, 2026</em></p>

<h3>1. Acceptance of Terms</h3>

<p>By accessing and using RADJATIKET, you accept and agree to be bound by these Terms of Service and our Privacy Policy.</p>

<h3>2. User Accounts</h3>

<p>You are responsible for:</p>
<ul>
<li>Maintaining the confidentiality of your account credentials</li>
<li>All activities that occur under your account</li>
<li>Providing accurate and current information</li>
<li>Notifying us immediately of any unauthorized access</li>
</ul>

<h3>3. Ticket Purchases</h3>

<h4>Purchase Process</h4>
<ul>
<li>All ticket sales are final unless otherwise stated by the event organizer</li>
<li>Prices are subject to change until purchase is completed</li>
<li>You must provide valid payment information</li>
</ul>

<h4>Refunds and Cancellations</h4>
<ul>
<li>Refund policies are set by individual event organizers</li>
<li>Event cancellations: Full refunds will be processed</li>
<li>Rescheduled events: Original tickets remain valid</li>
</ul>

<h3>4. User Conduct</h3>

<p>You agree NOT to:</p>
<ul>
<li>Use the platform for illegal purposes</li>
<li>Attempt to gain unauthorized access to our systems</li>
<li>Resell tickets at inflated prices (scalping)</li>
<li>Share account credentials with others</li>
<li>Use automated systems (bots) to purchase tickets</li>
</ul>

<h3>5. Intellectual Property</h3>

<p>All content on RADJATIKET, including logos, text, images, and software, is protected by intellectual property laws and belongs to RADJATIKET or our licensors.</p>

<h3>6. Limitation of Liability</h3>

<p>RADJATIKET is not responsible for:</p>
<ul>
<li>Event cancellations or changes by organizers</li>
<li>Quality or safety of events</li>
<li>Actions of event organizers or other users</li>
<li>Technical issues beyond our control</li>
</ul>

<h3>7. Modifications to Terms</h3>

<p>We reserve the right to modify these terms at any time. Continued use of the platform constitutes acceptance of updated terms.</p>

<h3>8. Contact</h3>

<p>Questions about these terms? Contact: <strong>legal@radjatiket.com</strong></p>',
                'meta_description' => 'Review RADJATIKET\'s Terms of Service outlining user responsibilities, ticket purchases, refunds, and platform usage guidelines.',
                'is_published' => true,
                'order' => 5,
            ],
            [
                'title' => 'Frequently Asked Questions',
                'slug' => 'faq',
                'content' => '<h2>Frequently Asked Questions</h2>

<h3>General Questions</h3>

<h4>What is RADJATIKET?</h4>
<p>RADJATIKET is Indonesia\'s leading online ticketing platform where you can discover and purchase tickets for concerts, festivals, workshops, conferences, and other events.</p>

<h4>Is RADJATIKET safe to use?</h4>
<p>Yes! We use industry-standard security measures including SSL encryption and secure payment gateways to protect your information and transactions.</p>

<h3>Buying Tickets</h3>

<h4>How do I purchase tickets?</h4>
<ol>
<li>Browse events and select your preferred event</li>
<li>Choose ticket type and quantity</li>
<li>Create an account or log in</li>
<li>Complete payment</li>
<li>Receive e-ticket via email</li>
</ol>

<h4>What payment methods are accepted?</h4>
<p>We accept credit/debit cards (Visa, Mastercard), bank transfers, e-wallets (GoPay, OVO, Dana), and virtual accounts.</p>

<h4>Will I receive a physical ticket?</h4>
<p>Most events use e-tickets sent to your email. Simply show the QR code at the venue for entry.</p>

<h3>Refunds & Changes</h3>

<h4>Can I get a refund?</h4>
<p>Refund policies vary by event. Check the event page for specific refund terms. If an event is cancelled, you\'ll receive a full refund automatically.</p>

<h4>Can I transfer my ticket to someone else?</h4>
<p>Some events allow ticket transfers. Check your ticket details or contact the event organizer.</p>

<h3>Account & Support</h3>

<h4>I forgot my password. What should I do?</h4>
<p>Click "Forgot Password" on the login page and follow the instructions sent to your email.</p>

<h4>I didn\'t receive my e-ticket. What should I do?</h4>
<p>Check your spam folder first. If you still can\'t find it, contact our support team at support@radjatiket.com with your order number.</p>

<h4>How do I contact customer support?</h4>
<p>Email: support@radjatiket.com<br>
Phone: +62 812-3456-7890<br>
Live Chat: Available on our website during business hours</p>

<h3>For Event Organizers</h3>

<h4>How can I list my event on RADJATIKET?</h4>
<p>Visit our <a href="/page/how-to-sell">How to Sell Tickets</a> page or contact business@radjatiket.com for partnership inquiries.</p>',
                'meta_description' => 'Find answers to common questions about buying tickets, refunds, payment methods, and using RADJATIKET platform.',
                'is_published' => true,
                'order' => 6,
            ],

            // Resources Pages
            [
                'title' => 'How to Buy Tickets',
                'slug' => 'how-to-buy',
                'content' => '<h2>How to Buy Tickets on RADJATIKET</h2>

<p>Purchasing tickets on RADJATIKET is quick, easy, and secure. Follow this simple guide to get your tickets in minutes!</p>

<h3>Step 1: Find Your Event</h3>

<ul>
<li>Browse the homepage for featured events</li>
<li>Use the search bar to find specific events</li>
<li>Filter by category, location, or date</li>
<li>Click on an event to view details</li>
</ul>

<h3>Step 2: Select Your Tickets</h3>

<ul>
<li>Review event information (date, time, venue)</li>
<li>Choose your preferred ticket type (e.g., Regular, VIP)</li>
<li>Select the number of tickets you want</li>
<li>Click "Buy Tickets" or "Add to Cart"</li>
</ul>

<h3>Step 3: Create an Account or Log In</h3>

<p><strong>New users:</strong></p>
<ol>
<li>Click "Register"</li>
<li>Enter your name, email, and phone number</li>
<li>Create a secure password</li>
<li>Verify your email address</li>
</ol>

<p><strong>Existing users:</strong> Simply log in with your credentials</p>

<h3>Step 4: Complete Your Order</h3>

<ul>
<li>Review your order summary</li>
<li>Enter attendee information if required</li>
<li>Apply promo code if you have one</li>
<li>Proceed to payment</li>
</ul>

<h3>Step 5: Make Payment</h3>

<p>Choose your preferred payment method:</p>
<ul>
<li><strong>Credit/Debit Card:</strong> Instant confirmation</li>
<li><strong>Bank Transfer:</strong> Complete within 24 hours</li>
<li><strong>E-Wallet:</strong> Quick and convenient</li>
<li><strong>Virtual Account:</strong> Pay at any ATM</li>
</ul>

<h3>Step 6: Receive Your E-Ticket</h3>

<p>After successful payment:</p>
<ul>
<li>Check your email for e-ticket</li>
<li>Download and save your ticket</li>
<li>Access tickets anytime from "My Tickets" in your account</li>
</ul>

<h3>Event Day</h3>

<ul>
<li>Arrive early at the venue</li>
<li>Show your e-ticket QR code at the entrance</li>
<li>Staff will scan your ticket for entry</li>
<li>Enjoy the event!</li>
</ul>

<h3>Tips for a Smooth Purchase</h3>

<ul>
<li>Buy tickets early - popular events sell out fast</li>
<li>Check refund policy before purchasing</li>
<li>Keep your e-ticket safe and accessible</li>
<li>Don\'t share your QR code with anyone</li>
<li>Contact support if you encounter any issues</li>
</ul>

<p><strong>Need help?</strong> Contact our support team at support@radjatiket.com</p>',
                'meta_description' => 'Step-by-step guide on how to buy event tickets on RADJATIKET. Learn the easy process from browsing events to receiving your e-ticket.',
                'is_published' => true,
                'order' => 7,
            ],
            [
                'title' => 'How to Sell Tickets',
                'slug' => 'how-to-sell',
                'content' => '<h2>How to Sell Tickets on RADJATIKET</h2>

<p>Ready to host your event? RADJATIKET makes it easy to create, manage, and sell tickets for your events online.</p>

<h3>Getting Started</h3>

<h4>1. Become an Event Organizer</h4>
<ul>
<li>Contact our partnership team: business@radjatiket.com</li>
<li>Submit required documents (business license, ID, etc.)</li>
<li>Sign partnership agreement</li>
<li>Get access to Event Organizer dashboard</li>
</ul>

<h4>2. Create Your Event</h4>
<ul>
<li>Log in to your EO dashboard</li>
<li>Click "Create New Event"</li>
<li>Fill in event details (title, description, venue)</li>
<li>Upload event banner/poster</li>
<li>Set event date and time</li>
</ul>

<h4>3. Set Up Ticket Categories</h4>
<ul>
<li>Create ticket types (e.g., Regular, VIP, VVIP)</li>
<li>Set prices for each category</li>
<li>Define quantity available</li>
<li>Set early bird or discount pricing (optional)</li>
<li>Configure ticket sales start/end dates</li>
</ul>

<h4>4. Configure Event Settings</h4>
<ul>
<li>Set refund policy</li>
<li>Enable/disable ticket transfers</li>
<li>Add terms and conditions</li>
<li>Set up promotional codes</li>
</ul>

<h4>5. Publish Your Event</h4>
<ul>
<li>Review all information</li>
<li>Click "Publish Event"</li>
<li>Your event goes live immediately</li>
<li>Start promoting!</li>
</ul>

<h3>Managing Your Event</h3>

<h4>Dashboard Features</h4>
<ul>
<li><strong>Sales Analytics:</strong> Real-time ticket sales data</li>
<li><strong>Attendee List:</strong> Manage and export attendee information</li>
<li><strong>Ticket Scanner:</strong> Mobile app for entry management</li>
<li><strong>Financial Reports:</strong> Track revenue and payouts</li>
<li><strong>Marketing Tools:</strong> Create promo codes and campaigns</li>
</ul>

<h3>Payment & Fees</h3>

<h4>Our Commission Structure</h4>
<ul>
<li>Basic Plan: 5% + Rp 2,000 per ticket</li>
<li>Premium Plan: 3% + Rp 1,000 per ticket</li>
<li>Enterprise Plan: Custom rates for large events</li>
</ul>

<h4>Payout Schedule</h4>
<ul>
<li>Weekly payouts after event completion</li>
<li>Minimum payout: Rp 1,000,000</li>
<li>Funds transferred to your bank account</li>
</ul>

<h3>Event Day Support</h3>

<ul>
<li>Use RADJATIKET Scanner app for ticket validation</li>
<li>24/7 technical support available</li>
<li>Real-time attendee tracking</li>
<li>On-site support for large events (premium plan)</li>
</ul>

<h3>Best Practices</h3>

<ul>
<li>Upload high-quality event images</li>
<li>Write clear, detailed descriptions</li>
<li>Set competitive pricing</li>
<li>Offer early bird discounts</li>
<li>Promote on social media</li>
<li>Respond quickly to attendee inquiries</li>
<li>Update event info if changes occur</li>
</ul>

<h3>Marketing Support</h3>

<p>As a RADJATIKET partner, you get:</p>
<ul>
<li>Featured placement on homepage</li>
<li>Email marketing to our user base</li>
<li>Social media promotion</li>
<li>SEO-optimized event pages</li>
<li>Analytics and insights</li>
</ul>

<h3>Ready to Start?</h3>

<p>Contact our partnership team today:<br>
<strong>Email:</strong> business@radjatiket.com<br>
<strong>Phone:</strong> +62 821-9876-5432</p>',
                'meta_description' => 'Learn how to sell event tickets on RADJATIKET. Complete guide for event organizers covering setup, pricing, marketing, and management.',
                'is_published' => true,
                'order' => 8,
            ],
            [
                'title' => 'Event Organizer Guide',
                'slug' => 'eo-guide',
                'content' => '<h2>Event Organizer Comprehensive Guide</h2>

<p>Welcome to the complete guide for event organizers on RADJATIKET. This guide will help you maximize your event\'s success.</p>

<h3>Platform Overview</h3>

<h4>Key Features</h4>
<ul>
<li>Intuitive event creation and management</li>
<li>Multiple ticket types and pricing tiers</li>
<li>Real-time sales tracking and analytics</li>
<li>Automated email confirmations to attendees</li>
<li>Mobile ticket scanning app</li>
<li>Comprehensive financial reports</li>
<li>Marketing and promotional tools</li>
</ul>

<h3>Creating a Successful Event</h3>

<h4>1. Event Information</h4>
<p><strong>Title:</strong> Keep it clear and searchable</p>
<ul>
<li>Good: "Jazz Festival Jakarta 2026"</li>
<li>Bad: "The Most Amazing Festival Ever!!!"</li>
</ul>

<p><strong>Description:</strong> Include essential details</p>
<ul>
<li>What: Type of event and activities</li>
<li>Who: Featured artists, speakers, or guests</li>
<li>When: Date, time, and duration</li>
<li>Where: Venue name and address</li>
<li>Why: What makes your event special</li>
</ul>

<p><strong>Images:</strong></p>
<ul>
<li>Upload banner: 1920x1080px (16:9 ratio)</li>
<li>Use high-resolution images (at least 1080p)</li>
<li>Include event name and key information</li>
<li>Use eye-catching, professional designs</li>
</ul>

<h4>2. Ticket Strategy</h4>

<p><strong>Pricing Tiers:</strong></p>
<ul>
<li><strong>Early Bird:</strong> 20-30% discount, limited quantity</li>
<li><strong>Regular:</strong> Standard pricing</li>
<li><strong>VIP:</strong> Premium experience, 2-3x regular price</li>
<li><strong>Group Packages:</strong> Discounts for multiple tickets</li>
</ul>

<p><strong>Scarcity Tactics:</strong></p>
<ul>
<li>Limit early bird tickets to create urgency</li>
<li>Show remaining tickets ("Only 50 left!")</li>
<li>Set countdown timers for early bird periods</li>
</ul>

<h4>3. Marketing Your Event</h4>

<p><strong>Before Launch:</strong></p>
<ul>
<li>Build anticipation with teaser campaigns</li>
<li>Create social media buzz</li>
<li>Partner with influencers or media</li>
<li>Prepare email campaigns</li>
</ul>

<p><strong>After Launch:</strong></p>
<ul>
<li>Regular social media updates</li>
<li>Email reminders to past attendees</li>
<li>Paid advertising (Facebook, Instagram, Google)</li>
<li>Collaborate with sponsors for cross-promotion</li>
</ul>

<p><strong>Last Push:</strong></p>
<ul>
<li>Final countdown posts (1 week, 3 days, 1 day)</li>
<li>Last chance email campaigns</li>
<li>Limited-time promo codes</li>
</ul>

<h3>Event Day Management</h3>

<h4>Pre-Event Checklist</h4>
<ul>
<li>✓ Download RADJATIKET Scanner app</li>
<li>✓ Test scanning equipment</li>
<li>✓ Train staff on ticket validation</li>
<li>✓ Print backup attendee list</li>
<li>✓ Set up entry/exit points</li>
<li>✓ Prepare for connectivity issues (offline mode)</li>
</ul>

<h4>During Event</h4>
<ul>
<li>Scan tickets at entry points</li>
<li>Handle no-shows and late arrivals</li>
<li>Manage walk-in purchases (if enabled)</li>
<li>Monitor real-time attendance</li>
<li>Resolve ticket issues quickly</li>
</ul>

<h4>Post-Event</h4>
<ul>
<li>Review attendance statistics</li>
<li>Collect feedback from attendees</li>
<li>Analyze sales data</li>
<li>Request payout (automatic or manual)</li>
<li>Thank attendees via email</li>
</ul>

<h3>Financial Management</h3>

<h4>Understanding Fees</h4>
<p>Example calculation:</p>
<ul>
<li>Ticket Price: Rp 100,000</li>
<li>Platform Fee: 5% (Rp 5,000)</li>
<li>Payment Gateway: Rp 2,000</li>
<li>Your Net Revenue: Rp 93,000</li>
</ul>

<h4>Payout Process</h4>
<ol>
<li>Tickets sold → Revenue accumulates</li>
<li>Event completes → Settlement period (7 days)</li>
<li>Refund window closes → Payout initiated</li>
<li>Funds transferred to your bank (3-5 business days)</li>
</ol>

<h3>Advanced Features</h3>

<h4>Promo Codes</h4>
<ul>
<li>Create discount codes for marketing campaigns</li>
<li>Set percentage or fixed amount discounts</li>
<li>Limit usage per code or per user</li>
<li>Track promo code performance</li>
</ul>

<h4>Reserved Seating</h4>
<ul>
<li>Upload venue seating map</li>
<li>Allow customers to choose seats</li>
<li>Higher conversion for theater/concert events</li>
</ul>

<h4>Attendee Data Export</h4>
<ul>
<li>Export attendee list to CSV/Excel</li>
<li>Use for event check-in</li>
<li>Build email lists for future events</li>
</ul>

<h3>Customer Support</h3>

<h4>Common Attendee Questions</h4>
<ul>
<li>Ticket not received → Check spam, resend via dashboard</li>
<li>Payment pending → Wait 24h for bank confirmation</li>
<li>Want refund → Check your refund policy</li>
<li>Lost ticket → Resend via "My Tickets" page</li>
</ul>

<h4>Getting Help</h4>
<p>Event Organizer Support:</p>
<ul>
<li><strong>Email:</strong> eo-support@radjatiket.com</li>
<li><strong>Phone:</strong> +62 821-9876-5432</li>
<li><strong>Priority Line:</strong> For events happening within 48 hours</li>
</ul>

<h3>Success Tips</h3>

<ol>
<li><strong>Start Early:</strong> Create event page 30-60 days before event</li>
<li><strong>Build Community:</strong> Engage with attendees before, during, and after</li>
<li><strong>Collect Data:</strong> Use insights to improve future events</li>
<li><strong>Be Responsive:</strong> Answer questions quickly</li>
<li><strong>Over-Communicate:</strong> Send reminders and updates</li>
<li><strong>Deliver Value:</strong> Exceed attendee expectations</li>
<li><strong>Learn & Iterate:</strong> Each event is a learning opportunity</li>
</ol>

<p><strong>Ready to create amazing events?</strong> Log in to your Event Organizer dashboard and get started!</p>',
                'meta_description' => 'Comprehensive guide for event organizers using RADJATIKET. Learn best practices for event creation, ticket sales, marketing, and management.',
                'is_published' => true,
                'order' => 9,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::create($pageData);
        }

        $this->command->info('✓ Created ' . count($pages) . ' default pages successfully!');
    }
}
