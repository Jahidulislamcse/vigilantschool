<?php

namespace Database\Seeders;

use App\Models\AboutSection;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Newsletter;
use App\Models\SchoolClass;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Teacher;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // 1. Create Default Administrator
        User::updateOrCreate(
            ['email' => 'admin@vigilantschool.com'],
            [
                'name' => 'School Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. School Settings from Official Prospectus
        $settings = [
            ['key' => 'school_name', 'value' => 'Vigilant International School', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site_title', 'value' => 'Vigilant International School', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site_tagline', 'value' => 'Constant effort in acquiring quality and quantity', 'group' => 'general', 'type' => 'text'],
            ['key' => 'motto', 'value' => 'Visit first then decide', 'group' => 'general', 'type' => 'text'],
            ['key' => 'medium_version', 'value' => 'English Medium & English Version (Play Group to S.S.C & O Level)', 'group' => 'general', 'type' => 'text'],
            ['key' => 'affiliations', 'value' => 'Corporate Member of British Council • Following the Curriculum of Edexcel', 'group' => 'general', 'type' => 'text'],
            ['key' => 'meta_description', 'value' => 'Vigilant International School - English Medium & English Version from Play Group to S.S.C & O Level with Edexcel and British Council affiliation.', 'group' => 'general', 'type' => 'textarea'],
            ['key' => 'contact_email', 'value' => 'vigilantschool@gmail.com', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'contact_phone', 'value' => '01734 655 655, 01674 655 655, 01978 655 655', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'contact_address', 'value' => '1/51/5 South Mugda, WASA Road, Mugda, Dhaka-1214', 'group' => 'contact', 'type' => 'textarea'],
            ['key' => 'working_hours', 'value' => 'Morning Shift: 08:00 AM - 10:45 AM | Day Shift: 10:45 AM - 01:30 PM | Std-I to X: 08:00 AM - 01:00 PM', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'academic_sessions', 'value' => 'January - December Session | July - June Session', 'group' => 'general', 'type' => 'text'],
            ['key' => 'google_map_iframe', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.548777931362!2d90.4285!3d23.7285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQzJzQyLjYiTiA5MMKwMjUnNDIuNiJF!5e0!3m2!1sen!2sbd!4v1680000000000', 'group' => 'contact', 'type' => 'textarea'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/vigilantinternationalschool', 'group' => 'social', 'type' => 'text'],
            ['key' => 'twitter_url', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'instagram_url', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'youtube_url', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'linkedin_url', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'site_logo', 'value' => null, 'group' => 'branding', 'type' => 'image'],
            ['key' => 'site_favicon', 'value' => 'kider/img/favicon.ico', 'group' => 'branding', 'type' => 'image'],
            ['key' => 'footer_about', 'value' => 'A Child is born with abundance of multiple capabilities. Vigilant School is ready to rear up your children as competitive citizens in the global village with constant effort in acquiring quality and quantity.', 'group' => 'general', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. Hero Carousel Sliders (Authentic Vigilant School Banners)
        Slider::truncate();
        Slider::create([
            'title' => 'Constant Effort in Acquiring Quality and Quantity',
            'subtitle' => 'English Medium & English Version • Play Group to S.S.C & O Level',
            'description' => 'Moulding competitive citizens for the global village with caring teachers, modern lab facilities, and comprehensive Islamic moral grounding.',
            'btn_text_1' => 'Explore Classes',
            'btn_url_1' => '/classes',
            'btn_text_2' => 'School Timing',
            'btn_url_2' => '/about',
            'image' => 'kider/img/carousel-1.jpg',
            'order' => 1,
            'is_active' => true,
        ]);
        Slider::create([
            'title' => 'Visit First Then Decide — The Premier Education Hub',
            'subtitle' => 'Corporate Member of British Council • Edexcel Curriculum',
            'description' => 'Two teachers in each junior classroom, equipped science and computer labs, CCTV monitoring, and After Class Assistance Programme (ACAP).',
            'btn_text_1' => 'Admission Inquiry',
            'btn_url_1' => '/appointment',
            'btn_text_2' => 'Contact Us',
            'btn_url_2' => '/contact',
            'image' => 'kider/img/carousel-2.jpg',
            'order' => 2,
            'is_active' => true,
        ]);

        // 4. Real Facilities from Prospectus
        Facility::truncate();
        $facilities = [
            [
                'title' => 'Interactive Classrooms (2 Teachers)',
                'icon' => 'fa-chalkboard-user',
                'color_theme' => 'primary',
                'short_description' => 'Well-decorated interactive classrooms with limited seats and 2 dedicated teachers from Play Group to Std-IV.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Science & Computer Lab & Library',
                'icon' => 'fa-flask-vial',
                'color_theme' => 'success',
                'short_description' => 'State-of-the-art physics, chemistry, biology lab equipment, computer station, and enriched children’s library.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'CCTV Security & Standby IPS',
                'icon' => 'fa-shield-halved',
                'color_theme' => 'warning',
                'short_description' => '24/7 CC Camera surveillance with sound system in all rooms and standby IPS generator for continuous power.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'ACAP & Full Time Care',
                'icon' => 'fa-user-graduate',
                'color_theme' => 'info',
                'short_description' => 'After Class Assistance Programme (ACAP), regular lesson preparation at school, and weekly/monthly guardian meetings.',
                'order' => 4,
                'is_active' => true,
            ],
        ];
        foreach ($facilities as $facility) {
            Facility::create($facility);
        }

        // 5. About Section with Official Mission & Philosophy
        AboutSection::truncate();
        AboutSection::create([
            'title' => 'Moulding Competitive Citizens in the Global Village',
            'tagline' => 'About Vigilant International School',
            'description_1' => 'A Child is born with abundance of multiple capabilities. It is the great responsibility of caring parents and vigilant teachers to nourish him/her by providing all sorts of facilities so they will represent Bangladesh with fame and reputation.',
            'description_2' => 'Vigilant International School operates under two sessions (January - December & July - June) with a 3-Semester evaluation system (Jan-Apr, May-Aug, Sep-Dec), British Council affiliation, and Edexcel curriculum standards.',
            'founder_name' => 'Academic Advisory Council',
            'founder_role' => 'Vigilant International School',
            'founder_photo' => 'kider/img/user.jpg',
            'image_1' => 'kider/img/about-1.jpg',
            'image_2' => 'kider/img/about-2.jpg',
            'image_3' => 'kider/img/about-3.jpg',
            'cta_title' => 'Visit First Then Decide',
            'cta_description' => 'Schedule a campus walkthrough at South Mugda, WASA Road to observe our classrooms, labs, and interactive environment.',
            'cta_button_text' => 'Book A Tour',
            'cta_button_url' => '/appointment',
            'cta_image' => 'kider/img/call-to-action.jpg',
        ]);

        // 6. Faculty Teachers
        Teacher::truncate();
        $teachers = [
            [
                'name' => 'Senior English Faculty',
                'designation' => 'Edexcel & O Level Specialist',
                'photo' => 'kider/img/team-1.jpg',
                'bio' => 'Specialized in English language, literature, and British Council curriculum methodology.',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => '',
                'instagram_url' => '',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Junior Section Lead Educator',
                'designation' => 'Play Group & KG Specialist',
                'photo' => 'kider/img/team-2.jpg',
                'bio' => 'Certified early child educator managing dual-teacher junior classrooms and ACAP sessions.',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => '',
                'instagram_url' => '',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Science & Math Department Head',
                'designation' => 'S.S.C & O Level Instructor',
                'photo' => 'kider/img/team-3.jpg',
                'bio' => 'Laboratory coordinator and Olympiad coach fostering analytical problem-solving skills.',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => '',
                'instagram_url' => '',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        $teacherModels = [];
        foreach ($teachers as $t) {
            $teacherModels[] = Teacher::create($t);
        }

        // 7. Classes & Academic Levels from Prospectus
        SchoolClass::truncate();
        $classes = [
            [
                'title' => 'Play Group (Morning / Day)',
                'slug' => 'play-group',
                'image' => 'kider/img/classes-1.jpg',
                'description' => 'Sensory development, rhymes, interactive toys, and 2 dedicated teachers per classroom.',
                'age_range' => '3 - 4 Years',
                'time_schedule' => 'Morning: 8:00-10:15 | Day: 10:45-1:00',
                'capacity' => 'Limited Seats',
                'fee' => 'Affordable',
                'teacher_id' => $teacherModels[1]->id,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Nursery (Morning / Day)',
                'slug' => 'nursery',
                'image' => 'kider/img/classes-2.jpg',
                'description' => 'Phonetics, basic arithmetic, handwriting practice, and social etiquette development.',
                'age_range' => '4 - 5 Years',
                'time_schedule' => 'Morning: 8:00-10:30 | Day: 10:45-1:15',
                'capacity' => 'Limited Seats',
                'fee' => 'Affordable',
                'teacher_id' => $teacherModels[1]->id,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Kindergarten (KG)',
                'slug' => 'kindergarten-kg',
                'image' => 'kider/img/classes-3.jpg',
                'description' => 'Preparation for primary grades with structured lesson plans and weekly surprise assessments.',
                'age_range' => '5 - 6 Years',
                'time_schedule' => 'Morning: 8:00-10:45 | Day: 10:45-1:30',
                'capacity' => 'Limited Seats',
                'fee' => 'Affordable',
                'teacher_id' => $teacherModels[0]->id,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Standard I to V (Primary)',
                'slug' => 'standard-1-to-5',
                'image' => 'kider/img/classes-4.jpg',
                'description' => 'Dual-teacher classrooms up to Std-IV, after class assistance (ACAP), and computer labs.',
                'age_range' => '6 - 11 Years',
                'time_schedule' => '08:00 AM - 01:00 PM',
                'capacity' => 'Limited Seats',
                'fee' => 'Standard',
                'teacher_id' => $teacherModels[0]->id,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Standard VI to X (Secondary / S.S.C)',
                'slug' => 'standard-6-to-10',
                'image' => 'kider/img/classes-5.jpg',
                'description' => 'Intensive curriculum covering English Version syllabus, model tests, and science lab practicums.',
                'age_range' => '11 - 16 Years',
                'time_schedule' => '08:00 AM - 01:00 PM',
                'capacity' => 'Limited Seats',
                'fee' => 'Standard',
                'teacher_id' => $teacherModels[2]->id,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'O Level & Edexcel International',
                'slug' => 'o-level-edexcel',
                'image' => 'kider/img/classes-6.jpg',
                'description' => 'British Council attached centre curriculum preparing students for global Edexcel O Level examinations.',
                'age_range' => '14 - 17 Years',
                'time_schedule' => '08:00 AM - 01:00 PM',
                'capacity' => 'Limited Seats',
                'fee' => 'Competitive',
                'teacher_id' => $teacherModels[0]->id,
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($classes as $c) {
            SchoolClass::create($c);
        }

        // 8. Testimonials from Real Parents
        Testimonial::truncate();
        $testimonials = [
            [
                'client_name' => 'Guardian of Std-III Student',
                'profession' => 'South Mugda, Dhaka',
                'avatar' => 'kider/img/testimonial-1.jpg',
                'content' => 'The two-teacher system in junior classes and the ACAP after-class assistance have made a huge difference. All lessons are prepared at school!',
                'rating' => 5,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'Parent of O-Level Candidate',
                'profession' => 'WASA Road, Dhaka',
                'avatar' => 'kider/img/testimonial-2.jpg',
                'content' => 'Vigilant International School’s British Council affiliation and Edexcel curriculum guidance ensure top-tier academic standards right in our neighbourhood.',
                'rating' => 5,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'Parent of Play Group Student',
                'profession' => 'Mugda, Dhaka',
                'avatar' => 'kider/img/testimonial-3.jpg',
                'content' => 'CCTV with sound system and regular parent-teacher meetings give us complete peace of mind about our child’s safety and moral growth.',
                'rating' => 5,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $test) {
            Testimonial::create($test);
        }

        // 9. Photo Gallery matching Prospectus Events
        Gallery::truncate();
        $galleries = [
            ['title' => 'Annual Science Fair', 'image' => 'kider/img/classes-6.jpg', 'category' => 'Events', 'order' => 1],
            ['title' => 'Eid Get Together & Party', 'image' => 'kider/img/classes-2.jpg', 'category' => 'Culture', 'order' => 2],
            ['title' => 'Annual Study Tour', 'image' => 'kider/img/classes-3.jpg', 'category' => 'Tour', 'order' => 3],
            ['title' => 'Art & Handwriting Competition', 'image' => 'kider/img/classes-1.jpg', 'category' => 'Co-Curricular', 'order' => 4],
            ['title' => 'Baishakhi Festival Celebration', 'image' => 'kider/img/classes-5.jpg', 'category' => 'Culture', 'order' => 5],
            ['title' => 'Interactive Classroom Activities', 'image' => 'kider/img/classes-4.jpg', 'category' => 'Campus', 'order' => 6],
        ];

        foreach ($galleries as $g) {
            Gallery::create($g);
        }

        // 10. Sample Appointment Inquiry
        Appointment::firstOrCreate(
            ['guardian_email' => 'faruk.hossain@gmail.com'],
            [
                'guardian_name' => 'Md. Faruk Hossain',
                'guardian_phone' => '01711 000 111',
                'child_name' => 'Abrar Hossain',
                'child_age' => '4 Years',
                'class_id' => 1,
                'message' => 'Inquiring for Play Group admission in the Morning Shift (January Session).',
                'status' => 'pending',
                'admin_notes' => 'Guardian invited for campus visit next Monday.',
            ]
        );

        // 11. Sample Contact Message
        Contact::firstOrCreate(
            ['email' => 'shaheen.akhtar@yahoo.com'],
            [
                'name' => 'Dr. Shaheen Akhtar',
                'subject' => 'Admission inquiry for S.S.C English Version',
                'message' => 'Hello, I want to know about seat availability for Std-IX English Version in the upcoming session.',
                'is_read' => false,
            ]
        );

        // 12. Sample Newsletter Subscriber
        Newsletter::firstOrCreate(
            ['email' => 'parent.updates@gmail.com'],
            ['is_active' => true]
        );

        Schema::enableForeignKeyConstraints();
    }
}
