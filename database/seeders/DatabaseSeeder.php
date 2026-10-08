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

        // 1. Create Default Administrators
        User::updateOrCreate(
            ['email' => 'admin@vigilantschool.com'],
            [
                'name' => 'School Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'principal@vigilantschool.com'],
            [
                'name' => 'Prof. Dr. M. A. Rahman',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. School Settings from Official Prospectus & Bangladeshi Context
        $settings = [
            ['key' => 'school_name', 'value' => 'Vigilant International School', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site_title', 'value' => 'Vigilant International School', 'group' => 'general', 'type' => 'text'],
            ['key' => 'site_tagline', 'value' => 'Constant effort in acquiring quality and quantity', 'group' => 'general', 'type' => 'text'],
            ['key' => 'motto', 'value' => 'Visit first then decide', 'group' => 'general', 'type' => 'text'],
            ['key' => 'medium_version', 'value' => 'English Medium & English Version (Play Group to S.S.C & O Level)', 'group' => 'general', 'type' => 'text'],
            ['key' => 'affiliations', 'value' => 'Corporate Member of British Council • Following the Curriculum of Edexcel', 'group' => 'general', 'type' => 'text'],
            ['key' => 'meta_description', 'value' => 'Vigilant International School, South Mugda, Dhaka - English Medium & English Version from Play Group to S.S.C & O Level with Edexcel and British Council affiliation.', 'group' => 'general', 'type' => 'textarea'],
            ['key' => 'contact_email', 'value' => 'vigilantschool@gmail.com', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'contact_phone', 'value' => '01734 655 655, 01674 655 655, 01978 655 655', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'contact_address', 'value' => '1/51/5 South Mugda, WASA Road, Mugda, Dhaka-1214, Bangladesh', 'group' => 'contact', 'type' => 'textarea'],
            ['key' => 'working_hours', 'value' => 'Morning Shift: 08:00 AM - 10:45 AM | Day Shift: 10:45 AM - 01:30 PM | Std-I to X: 08:00 AM - 01:00 PM', 'group' => 'contact', 'type' => 'text'],
            ['key' => 'academic_sessions', 'value' => 'January - December Session | July - June Session', 'group' => 'general', 'type' => 'text'],
            ['key' => 'google_map_iframe', 'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.548777931362!2d90.4285!3d23.7285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjPCsDQzJzQyLjYiTiA5MMKwMjUnNDIuNiJF!5e0!3m2!1sen!2sbd!4v1680000000000', 'group' => 'contact', 'type' => 'textarea'],
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/vigilantschool', 'group' => 'social', 'type' => 'text'],
            ['key' => 'twitter_url', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'instagram_url', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'youtube_url', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'linkedin_url', 'value' => '', 'group' => 'social', 'type' => 'text'],
            ['key' => 'site_logo', 'value' => null, 'group' => 'branding', 'type' => 'image'],
            ['key' => 'site_favicon', 'value' => 'kider/img/favicon.ico', 'group' => 'branding', 'type' => 'image'],
            ['key' => 'footer_about', 'value' => 'A child is born with an abundance of multiple capabilities. Vigilant International School in South Mugda, Dhaka is committed to nurturing your children into confident, competitive citizens for the global village with British Council affiliation, Edexcel curriculum, and Islamic moral coaching.', 'group' => 'general', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. Hero Carousel Sliders (Authentic Vigilant School Banners)
        Slider::truncate();
        Slider::create([
            'title' => 'Constant Effort in Acquiring Quality and Quantity',
            'subtitle' => 'English Medium & English Version • Play Group to S.S.C & O Level',
            'description' => 'Moulding competitive citizens for the global village in South Mugda, Dhaka with caring teachers, modern lab facilities, and Islamic moral grounding.',
            'btn_text_1' => 'Explore Classes',
            'btn_url_1' => '/classes',
            'btn_text_2' => 'School Timing',
            'btn_url_2' => '/about',
            'image' => 'kider/img/carousel-1.jpg',
            'order' => 1,
            'is_active' => true,
        ]);
        Slider::create([
            'title' => 'Visit First Then Decide — Premier Education Hub in Dhaka',
            'subtitle' => 'Corporate Member of British Council • Edexcel Curriculum',
            'description' => 'Two teachers in each junior classroom, equipped science and computer labs, 24/7 CCTV monitoring with audio, and After Class Assistance Programme (ACAP).',
            'btn_text_1' => 'Admission Inquiry',
            'btn_url_1' => '/appointment',
            'btn_text_2' => 'Contact Us',
            'btn_url_2' => '/contact',
            'image' => 'kider/img/carousel-2.jpg',
            'order' => 2,
            'is_active' => true,
        ]);
        Slider::create([
            'title' => 'Admissions Open for Academic Sessions (Jan–Dec & Jul–Jun)',
            'subtitle' => 'From Play Group to S.S.C & O Level • South Mugda Campus',
            'description' => 'Give your child the advantage of personalized education with full lesson preparation at school, zero private tuition pressure, and caring educators.',
            'btn_text_1' => 'Book A School Tour',
            'btn_url_1' => '/appointment',
            'btn_text_2' => 'Meet Faculty',
            'btn_url_2' => '/team',
            'image' => 'kider/img/carousel-1.jpg',
            'order' => 3,
            'is_active' => true,
        ]);

        // 4. Real Facilities from Official Prospectus
        Facility::truncate();
        $facilities = [
            [
                'title' => 'Interactive Classrooms (2 Teachers)',
                'icon' => 'fa-chalkboard-user',
                'color_theme' => 'primary',
                'short_description' => 'Well-decorated interactive classrooms with limited seats and 2 dedicated teachers from Play Group to Std-IV for personalized care.',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Science & Computer Lab & Library',
                'icon' => 'fa-flask-vial',
                'color_theme' => 'success',
                'short_description' => 'Modern physics, chemistry, biology lab apparatus, networked computer workstations, and an enriched children\'s library.',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => '24/7 CCTV Security & Standby IPS',
                'icon' => 'fa-shield-halved',
                'color_theme' => 'warning',
                'short_description' => 'Complete CCTV surveillance with sound monitoring in every room and heavy-duty standby IPS generator for continuous power.',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'ACAP & Full Lesson Preparation',
                'icon' => 'fa-user-graduate',
                'color_theme' => 'info',
                'short_description' => 'After Class Assistance Programme (ACAP) ensures all daily lessons and homework are completed at school without private coaching.',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Islamic & Moral Ethics Coaching',
                'icon' => 'fa-mosque',
                'color_theme' => 'danger',
                'short_description' => 'Daily moral coaching, Quranic recitation, cultural etiquette, and character building integrated into every student\'s routine.',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Study Tours, Sports & Cultural Events',
                'icon' => 'fa-trophy',
                'color_theme' => 'secondary',
                'short_description' => 'Annual sports competition, Baishakhi Utshob, science exhibition, and educational study tours for comprehensive development.',
                'order' => 6,
                'is_active' => true,
            ],
        ];
        foreach ($facilities as $facility) {
            Facility::create($facility);
        }

        // 5. About Section with Official Mission & Bangladeshi Perspective
        AboutSection::truncate();
        AboutSection::create([
            'title' => 'Moulding Competitive Citizens in the Global Village',
            'tagline' => 'About Vigilant International School, South Mugda, Dhaka',
            'description_1' => 'A Child is born with an abundance of multiple capabilities. At Vigilant International School (South Mugda, Dhaka), our mission is to nourish each child with British Council standards, Edexcel curriculum, and sound moral values so they proudly represent Bangladesh on the global stage.',
            'description_2' => 'We operate under two flexible academic sessions (January - December & July - June) with a 3-Semester evaluation system. With two teachers in junior classrooms and our After Class Assistance Programme (ACAP), all homework and lessons are completed on campus without private coaching burden.',
            'founder_name' => 'Prof. Dr. M. A. Rahman',
            'founder_role' => 'Chairman & Senior Academic Advisor',
            'founder_photo' => 'kider/img/user.jpg',
            'image_1' => 'kider/img/about-1.jpg',
            'image_2' => 'kider/img/about-2.jpg',
            'image_3' => 'kider/img/about-3.jpg',
            'cta_title' => 'Visit Our South Mugda Campus First, Then Decide',
            'cta_description' => 'Schedule a campus walkthrough at 1/51/5 South Mugda, WASA Road, Dhaka to observe our multimedia classrooms, laboratories, and interactive learning environment.',
            'cta_button_text' => 'Book A School Tour',
            'cta_button_url' => '/appointment',
            'cta_image' => 'kider/img/call-to-action.jpg',
        ]);

        // 6. Faculty Teachers with Authentic Bangladeshi Names & Qualifications
        Teacher::truncate();
        $teachers = [
            [
                'name' => 'Shahana Akhter, M.A (English)',
                'designation' => 'Junior Section Lead Educator & English Specialist',
                'photo' => 'kider/img/team-1.jpg',
                'bio' => 'Certified early childhood educator with 8+ years experience managing dual-teacher classrooms, phonetics, and interactive play-based learning.',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => '',
                'instagram_url' => '',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Md. Jahidul Islam, M.Sc (Physics)',
                'designation' => 'Science & Mathematics Department Head',
                'photo' => 'kider/img/team-2.jpg',
                'bio' => 'Senior faculty with 10+ years coaching Edexcel O Level physics, higher math, and mentoring students in national science olympiads.',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => '',
                'instagram_url' => '',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Farhana Chowdhury, M.A (ELT), B.Ed',
                'designation' => 'Senior English Faculty & Edexcel Coordinator',
                'photo' => 'kider/img/team-3.jpg',
                'bio' => 'British Council trained educator specializing in English language mastery, creative writing, and Edexcel curriculum standards.',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => '',
                'instagram_url' => '',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Mohammad Tanvir Ahmed, M.Sc (CSE)',
                'designation' => 'ICT & Computer Science Instructor',
                'photo' => 'kider/img/team-1.jpg',
                'bio' => 'Hands-on computer laboratory instructor introducing foundational coding, digital literacy, and multimedia educational tools.',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => '',
                'instagram_url' => '',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Nusrat Jahan, M.A (Bangla Literature)',
                'designation' => 'Bangla Language & Cultural Affairs Head',
                'photo' => 'kider/img/team-2.jpg',
                'bio' => 'Dedicated educator coordinating Bangla language arts, cultural festival celebrations, and youth public speaking.',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => '',
                'instagram_url' => '',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Dr. Kazi Mahbubur Rahman, Ph.D',
                'designation' => 'Senior Academic Advisor & Moral Ethics Mentor',
                'photo' => 'kider/img/team-3.jpg',
                'bio' => 'Guiding students with comprehensive academic excellence combined with moral ethics, discipline, and guardian counseling.',
                'facebook_url' => 'https://facebook.com',
                'twitter_url' => '',
                'instagram_url' => '',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        $teacherModels = [];
        foreach ($teachers as $t) {
            $teacherModels[] = Teacher::create($t);
        }

        // 7. Classes & Academic Levels with Bangladeshi Tuition Fees (BDT / ৳)
        SchoolClass::truncate();
        $classes = [
            [
                'title' => 'Play Group (Morning / Day)',
                'slug' => 'play-group',
                'image' => 'kider/img/classes-1.jpg',
                'description' => 'Sensory development, nursery rhymes, motor skills, and 2 dedicated teachers per classroom in South Mugda.',
                'age_range' => '3 - 4 Years',
                'time_schedule' => 'Morning: 8:00-10:15 | Day: 10:45-1:00',
                'capacity' => '20 Kids (2 Teachers)',
                'fee' => '৳ 2,500 / mo',
                'teacher_id' => $teacherModels[0]->id,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Nursery (Morning / Day)',
                'slug' => 'nursery',
                'image' => 'kider/img/classes-2.jpg',
                'description' => 'Phonetics, basic numbers, English conversation, handwriting practice, and social etiquette development.',
                'age_range' => '4 - 5 Years',
                'time_schedule' => 'Morning: 8:00-10:30 | Day: 10:45-1:15',
                'capacity' => '22 Kids (2 Teachers)',
                'fee' => '৳ 2,800 / mo',
                'teacher_id' => $teacherModels[0]->id,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Kindergarten (KG)',
                'slug' => 'kindergarten-kg',
                'image' => 'kider/img/classes-3.jpg',
                'description' => 'Structured lesson plans, reading fluency, elementary science, and weekly surprise assessments.',
                'age_range' => '5 - 6 Years',
                'time_schedule' => 'Morning: 8:00-10:45 | Day: 10:45-1:30',
                'capacity' => '25 Kids (2 Teachers)',
                'fee' => '৳ 3,000 / mo',
                'teacher_id' => $teacherModels[2]->id,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Standard I to V (Primary English Version)',
                'slug' => 'standard-1-to-5',
                'image' => 'kider/img/classes-4.jpg',
                'description' => 'National curriculum English Version with dual teachers up to Std-IV, computer lab, and ACAP assistance.',
                'age_range' => '6 - 11 Years',
                'time_schedule' => '08:00 AM - 01:00 PM',
                'capacity' => '25 Students',
                'fee' => '৳ 3,500 / mo',
                'teacher_id' => $teacherModels[2]->id,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Standard VI to X (Secondary / S.S.C)',
                'slug' => 'standard-6-to-10',
                'image' => 'kider/img/classes-5.jpg',
                'description' => 'Rigorous S.S.C English Version syllabus, model tests, science lab practicums, and continuous evaluation.',
                'age_range' => '11 - 16 Years',
                'time_schedule' => '08:00 AM - 01:00 PM',
                'capacity' => '30 Students',
                'fee' => '৳ 4,000 / mo',
                'teacher_id' => $teacherModels[1]->id,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'O Level & Edexcel International',
                'slug' => 'o-level-edexcel',
                'image' => 'kider/img/classes-6.jpg',
                'description' => 'British Council attached centre curriculum preparing students for international Edexcel IGCSE / O Level exams.',
                'age_range' => '14 - 17 Years',
                'time_schedule' => '08:00 AM - 01:30 PM',
                'capacity' => '20 Students',
                'fee' => '৳ 5,500 / mo',
                'teacher_id' => $teacherModels[1]->id,
                'order' => 6,
                'is_active' => true,
            ],
        ];

        $classModels = [];
        foreach ($classes as $c) {
            $classModels[] = SchoolClass::create($c);
        }

        // 8. Authentic Parent Testimonials from Dhaka Guardians
        Testimonial::truncate();
        $testimonials = [
            [
                'client_name' => 'Engr. M. Rafiqul Islam',
                'profession' => 'Senior Engineer & Father of Std-IV Student, Mugda, Dhaka',
                'avatar' => 'kider/img/testimonial-1.jpg',
                'content' => 'The two-teacher system in junior classes and the ACAP after-class assistance have made a huge difference for my son. All lessons and homework are completed right at school without needing private tutors!',
                'rating' => 5,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'Dr. Sabina Yasmin',
                'profession' => 'Physician & Parent of O-Level Candidate, WASA Road, Dhaka',
                'avatar' => 'kider/img/testimonial-2.jpg',
                'content' => 'Vigilant International School’s British Council affiliation and Edexcel curriculum guidance ensure top-tier academic standards right in our neighbourhood. The laboratory facilities and teacher dedication are outstanding.',
                'rating' => 5,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'Advocate Nazrul Islam',
                'profession' => 'Supreme Court Advocate & Guardian of KG Student, Maniknagar, Dhaka',
                'avatar' => 'kider/img/testimonial-3.jpg',
                'content' => '24/7 CCTV surveillance with audio, standby IPS generator, and highly attentive teachers give our family complete peace of mind regarding our child\'s safety and moral upbringing.',
                'rating' => 5,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'client_name' => 'Farzana Haque, M.Sc',
                'profession' => 'Banker & Mother of Play Group Student, Gopibagh, Dhaka',
                'avatar' => 'kider/img/testimonial-1.jpg',
                'content' => 'The caring environment in the Play Group section helped my daughter adapt within days. Her English speaking fluency, moral manners, and confidence have improved noticeably.',
                'rating' => 5,
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $test) {
            Testimonial::create($test);
        }

        // 9. Photo Gallery Matching Bangladeshi Campus & Cultural Events
        Gallery::truncate();
        $galleries = [
            ['title' => 'Annual Science & IT Fair', 'image' => 'kider/img/classes-6.jpg', 'category' => 'Events', 'order' => 1],
            ['title' => 'Bangla Noboborsho & Baishakhi Utshob', 'image' => 'kider/img/classes-2.jpg', 'category' => 'Culture', 'order' => 2],
            ['title' => 'Annual Study Tour & Picnic to Gazipur', 'image' => 'kider/img/classes-3.jpg', 'category' => 'Tour', 'order' => 3],
            ['title' => 'Art, Calligraphy & Handwriting Competition', 'image' => 'kider/img/classes-1.jpg', 'category' => 'Co-Curricular', 'order' => 4],
            ['title' => 'Annual Sports & Prize Giving Ceremony', 'image' => 'kider/img/classes-5.jpg', 'category' => 'Events', 'order' => 5],
            ['title' => 'Eid Reunion & Moral Values Assembly', 'image' => 'kider/img/classes-4.jpg', 'category' => 'Culture', 'order' => 6],
            ['title' => 'Interactive Dual-Teacher Classroom Activities', 'image' => 'kider/img/classes-1.jpg', 'category' => 'Campus', 'order' => 7],
            ['title' => 'Science & Physics Lab Practicum Session', 'image' => 'kider/img/classes-6.jpg', 'category' => 'Campus', 'order' => 8],
        ];

        foreach ($galleries as $g) {
            Gallery::create($g);
        }

        // 10. Sample Appointment Inquiries from Bangladeshi Guardians
        Appointment::truncate();
        $appointments = [
            [
                'guardian_name' => 'Engr. Mahbubul Alam',
                'guardian_email' => 'mahbub.alam78@gmail.com',
                'guardian_phone' => '01712-345678',
                'child_name' => 'Aayan Alam',
                'child_age' => '3.5 Years',
                'class_id' => $classModels[0]->id,
                'message' => 'Inquiring for Play Group morning shift admission in January session. We live nearby on WASA Road, Mugda.',
                'status' => 'confirmed',
                'admin_notes' => 'Guardian visited campus on Oct 6. Admitted for Morning Shift.',
            ],
            [
                'guardian_name' => 'Dr. Sabina Yasmin',
                'guardian_email' => 'dr.sabina.y@gmail.com',
                'guardian_phone' => '01819-876543',
                'child_name' => 'Nafisa Zaki',
                'child_age' => '14 Years',
                'class_id' => $classModels[5]->id,
                'message' => 'Would like to know the subject combination for Edexcel O-Level Science stream and lab practicum schedule.',
                'status' => 'pending',
                'admin_notes' => 'Phone consultation scheduled for tomorrow 11:00 AM.',
            ],
            [
                'guardian_name' => 'Advocate Nazrul Islam',
                'guardian_email' => 'nazrul.law@yahoo.com',
                'guardian_phone' => '01911-223344',
                'child_name' => 'Zayan Islam',
                'child_age' => '5 Years',
                'class_id' => $classModels[2]->id,
                'message' => 'Interested in KG Day Shift. Want to understand the ACAP after-school lesson preparation program.',
                'status' => 'completed',
                'admin_notes' => 'Campus walkthrough completed. Admission form and prospectus collected.',
            ],
            [
                'guardian_name' => 'Mrs. Farzana Sultana',
                'guardian_email' => 'farzana.sultana.bd@gmail.com',
                'guardian_phone' => '01678-901234',
                'child_name' => 'Tahsin Ahmed',
                'child_age' => '7 Years',
                'class_id' => $classModels[3]->id,
                'message' => 'Transfer inquiry for Std-II English Version from another school due to family relocation to South Mugda.',
                'status' => 'confirmed',
                'admin_notes' => 'Transfer evaluation assessment scheduled for Saturday.',
            ],
            [
                'guardian_name' => 'Md. Kamrul Hasan',
                'guardian_email' => 'kamrul.hasan.dhaka@outlook.com',
                'guardian_phone' => '01733-445566',
                'child_name' => 'Amina Hasan',
                'child_age' => '4.5 Years',
                'class_id' => $classModels[1]->id,
                'message' => 'Inquiry about school van/transportation coverage for Mugda/Maniknagar and shift timing for Nursery.',
                'status' => 'pending',
                'admin_notes' => 'Inquiry received through website appointment form.',
            ],
        ];

        foreach ($appointments as $app) {
            Appointment::create($app);
        }

        // 11. Sample Contact Inquiries with Authentic Bangladeshi Perspective
        Contact::truncate();
        $contacts = [
            [
                'name' => 'Md. Shafiqur Rahman',
                'email' => 'shafiq.rahman.bd@gmail.com',
                'subject' => 'Admission Form & Fee Structure for 2027 Session',
                'message' => 'Dear Authority, Could you please provide details on admission fees and monthly tuition for Standard-III English Version for the upcoming academic session?',
                'is_read' => true,
                'admin_reply' => 'Dear Mr. Shafiq, thank you for your interest. The admission brochure and fee schedule have been sent to your email. You are also welcome to visit our South Mugda campus between 8:00 AM and 2:00 PM.',
            ],
            [
                'name' => 'Tahmina Akter',
                'email' => 'tahmina.akter.dhaka@yahoo.com',
                'subject' => 'School Transportation Coverage for Motijheel & Khilgaon',
                'message' => 'Assalamu Alaikum, Does the school have designated van or transport support for students coming from Motijheel / Khilgaon area?',
                'is_read' => false,
                'admin_reply' => null,
            ],
            [
                'name' => 'Dr. Enamul Karim',
                'email' => 'enamul.karim.dr@gmail.com',
                'subject' => 'Edexcel O Level Science Stream Lab Facilities',
                'message' => 'Hello, I would like to visit the Physics and Chemistry laboratories before finalizing admission for my daughter in Std-IX O-Level.',
                'is_read' => true,
                'admin_reply' => 'Dear Dr. Enamul, you are warmly invited to visit our science lab this Thursday at 11:30 AM to meet our Head of Science, Md. Jahidul Islam.',
            ],
        ];

        foreach ($contacts as $cnt) {
            Contact::create($cnt);
        }

        // 12. Sample Newsletter Subscribers from Bangladesh
        Newsletter::truncate();
        $subscribers = [
            'alamgir.kabir.bd@gmail.com',
            'rashida.begum.dhaka@yahoo.com',
            'tareq.zaman@outlook.com',
            'anwar.hossain.mugda@gmail.com',
            'farzana.haque.banker@gmail.com',
        ];

        foreach ($subscribers as $email) {
            Newsletter::create([
                'email' => $email,
                'is_active' => true,
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
