@extends('layouts.admin')

@section('title', 'School Settings')
@section('page-title', 'School Profile & General Settings')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header d-flex align-items-center justify-content-between bg-white py-3">
                <div class="d-flex align-items-center">
                    <i class="fa fa-sliders text-primary me-2 fs-5"></i>
                    <div>
                        <h6 class="mb-0 fw-bold">School Configuration & Profile</h6>
                        <small class="text-muted">Manage academic credentials, contact numbers, shift timings, and official branding</small>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <ul class="nav nav-pills mb-4 gap-2 border-bottom pb-3" id="settingsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill px-4" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                                <i class="fa fa-id-card me-2"></i> Branding & Slogan
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4" id="academic-tab" data-bs-toggle="tab" data-bs-target="#academic" type="button" role="tab">
                                <i class="fa fa-graduation-cap me-2"></i> Academic & Affiliations
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab">
                                <i class="fa fa-location-dot me-2"></i> Contact & Shifts
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab">
                                <i class="fa fa-share-nodes me-2"></i> Social Links
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill px-4" id="seo-tab" data-bs-toggle="tab" data-bs-target="#seo" type="button" role="tab">
                                <i class="fa fa-magnifying-glass-chart me-2"></i> SEO & Meta Tags
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="settingsTabsContent">
                        <!-- Branding & Identity Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Official School Name *</label>
                                    <input type="text" name="site_title" class="form-control" value="{{ old('site_title', $settings['site_title'] ?? 'Vigilant International School') }}" required>
                                    <small class="text-muted">Displayed in header branding, page titles, and browser tabs.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Official Motto / Slogan</label>
                                    <input type="text" name="site_tagline" class="form-control" value="{{ old('site_tagline', $settings['site_tagline'] ?? 'Constant effort in acquiring quality and quantity') }}">
                                    <small class="text-muted">School core slogan featured in prospectus & headers.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Campaign Tagline</label>
                                    <input type="text" name="motto" class="form-control" value="{{ old('motto', $settings['motto'] ?? 'Visit first then decide') }}">
                                    <small class="text-muted">e.g. Visit first then decide</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">School Brand Logo</label>
                                    <input type="file" name="site_logo" class="form-control" accept="image/png,image/jpeg,image/svg+xml,image/webp">
                                    <small class="text-muted">Custom PNG or SVG logo for navbar and official documents (Max 3MB).</small>
                                    @if(isset($settings['site_logo']) && $settings['site_logo'])
                                        <div class="admin-img-preview-box d-flex align-items-center justify-content-between mt-2">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset($settings['site_logo']) }}" alt="Current Logo" class="admin-preview-thumb p-1 bg-white" style="height: 48px; width: auto; max-width: 140px; object-fit: contain;">
                                                <div>
                                                    <span class="badge bg-primary-subtle text-primary admin-preview-badge mb-1"><i class="fa fa-image me-1"></i> Current Logo Active</span>
                                                    <div class="small text-muted font-monospace text-truncate" style="max-width: 220px;">{{ $settings['site_logo'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Browser Favicon (.ico / .png / .svg)</label>
                                    <input type="file" name="site_favicon" class="form-control" accept=".ico,image/x-icon,image/png,image/svg+xml,image/jpeg,image/webp">
                                    <small class="text-muted">Appears on browser tabs, bookmarks & mobile shortcuts (32x32 px recommended).</small>
                                    @if(isset($settings['site_favicon']) && $settings['site_favicon'])
                                        <div class="admin-img-preview-box d-flex align-items-center justify-content-between mt-2">
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="border rounded p-2 bg-white shadow-sm d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                                    <img src="{{ asset($settings['site_favicon']) }}" alt="Current Favicon" class="admin-preview-thumb favicon" style="width: 28px; height: 28px; object-fit: contain;">
                                                </div>
                                                <div>
                                                    <span class="badge bg-info-subtle text-info admin-preview-badge mb-1"><i class="fa fa-globe me-1"></i> Current Favicon Active</span>
                                                    <div class="small text-muted font-monospace text-truncate" style="max-width: 220px;">{{ $settings['site_favicon'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Academic & Affiliations Tab -->
                        <div class="tab-pane fade" id="academic" role="tabpanel">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Curriculum Medium & Versions</label>
                                    <input type="text" name="medium_version" class="form-control" value="{{ old('medium_version', $settings['medium_version'] ?? 'English Medium & English Version (Play Group to S.S.C & O Level)') }}">
                                    <small class="text-muted">e.g. English Medium & English Version (Play Group to S.S.C & O Level)</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Board & International Affiliations</label>
                                    <input type="text" name="affiliations" class="form-control" value="{{ old('affiliations', $settings['affiliations'] ?? 'Corporate Member of British Council • Following the Curriculum of Edexcel') }}">
                                    <small class="text-muted">e.g. Edexcel Approved Centre, British Council Attached Centre</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Academic Sessions</label>
                                    <input type="text" name="academic_sessions" class="form-control" value="{{ old('academic_sessions', $settings['academic_sessions'] ?? 'January - December Session | July - June Session') }}">
                                    <small class="text-muted">e.g. January - December Session / July - June Session</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Footer Mission Statement</label>
                                    <textarea name="footer_about" class="form-control" rows="2">{{ old('footer_about', $settings['footer_about'] ?? 'A Child is born with abundance of multiple capabilities...') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Contact & Location Tab -->
                        <div class="tab-pane fade" id="contact" role="tabpanel">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Campus Address *</label>
                                    <input type="text" name="contact_address" class="form-control" value="{{ old('contact_address', $settings['contact_address'] ?? '1/51/5 South Mugda, WASA Road, Mugda, Dhaka-1214') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Helpline / Contact Numbers *</label>
                                    <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $settings['contact_phone'] ?? '01734 655 655, 01674 655 655, 01978 655 655') }}" required>
                                    <small class="text-muted">Separate multiple phone numbers with commas.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Official Email Address *</label>
                                    <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $settings['contact_email'] ?? 'vigilantschool@gmail.com') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">School Shift Timings</label>
                                    <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours', $settings['working_hours'] ?? 'Morning Shift: 08:00 AM - 10:45 AM | Day Shift: 10:45 AM - 01:30 PM | Std-I to VIII: 08:00 AM - 01:00 PM') }}">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold small text-secondary">Google Map Embed Code / Iframe Source</label>
                                    <textarea name="google_map_iframe" class="form-control" rows="3" placeholder="https://www.google.com/maps/embed?pb=...">{{ old('google_map_iframe', $settings['google_map_iframe'] ?? '') }}</textarea>
                                    <small class="text-muted">Enter Google Map iframe URL or full iframe tag to show on the Contact Us page.</small>
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Tab -->
                        <div class="tab-pane fade" id="social" role="tabpanel">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary"><i class="fab fa-facebook text-primary me-2"></i> Facebook URL</label>
                                    <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}" placeholder="https://facebook.com/your-school">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary"><i class="fab fa-twitter text-info me-2"></i> Twitter / X URL</label>
                                    <input type="url" name="twitter_url" class="form-control" value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}" placeholder="https://twitter.com/your-school">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary"><i class="fab fa-instagram text-danger me-2"></i> Instagram URL</label>
                                    <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}" placeholder="https://instagram.com/your-school">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary"><i class="fab fa-youtube text-danger me-2"></i> YouTube Channel</label>
                                    <input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}" placeholder="https://youtube.com/@your-school">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary"><i class="fab fa-linkedin text-primary me-2"></i> LinkedIn Profile</label>
                                    <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}" placeholder="https://linkedin.com/company/your-school">
                                </div>
                            </div>
                        </div>

                        <!-- SEO & Meta Tags Tab -->
                        <div class="tab-pane fade" id="seo" role="tabpanel">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary">Search Engine Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3" placeholder="Brief summary of your school for Google search results...">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                                    <small class="text-muted">Recommended length: 150-160 characters. Appears directly under your school link on Google.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control" value="{{ old('meta_keywords', $settings['meta_keywords'] ?? 'school, english medium, english version, play group, primary, edexcel, british council') }}" placeholder="school, english medium, admissions...">
                                    <small class="text-muted">Comma-separated keywords for search engine indexers.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Google Site Verification Token</label>
                                    <input type="text" name="google_site_verification" class="form-control" value="{{ old('google_site_verification', $settings['google_site_verification'] ?? '') }}" placeholder="e.g. AbC123XyZ_search_console_token">
                                    <small class="text-muted">Google Search Console verification meta tag token.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Google Analytics (GA4) Measurement ID</label>
                                    <input type="text" name="google_analytics_id" class="form-control" value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}" placeholder="e.g. G-XXXXXXXXXX">
                                    <small class="text-muted">Enter your Google Analytics 4 Measurement ID to track visitor traffic.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary">Social Share Preview Banner (OG Image)</label>
                                    <input type="file" name="og_image" class="form-control" accept="image/*">
                                    <small class="text-muted">Image displayed when sharing links on Facebook, WhatsApp, and LinkedIn (1200x630 px recommended).</small>
                                    @if(isset($settings['og_image']) && $settings['og_image'])
                                        <div class="admin-img-preview-box d-flex align-items-center justify-content-between mt-2">
                                            <div class="d-flex align-items-center gap-3">
                                                <img src="{{ asset($settings['og_image']) }}" alt="OG Banner" class="admin-preview-thumb banner" style="width: 120px; height: 60px; object-fit: cover;">
                                                <div>
                                                    <span class="badge bg-secondary-subtle text-dark admin-preview-badge mb-1"><i class="fa fa-share-nodes me-1"></i> Current OG Image</span>
                                                    <div class="small text-muted font-monospace text-truncate" style="max-width: 200px;">{{ $settings['og_image'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <div class="alert alert-info d-flex align-items-center mb-0 rounded-3">
                                        <i class="fa fa-circle-info fs-4 me-3 text-info"></i>
                                        <div>
                                            <strong>Automated SEO Features Active:</strong>
                                            <div class="small">
                                                • Dynamic XML Sitemap is live at <a href="{{ route('sitemap') }}" target="_blank" class="fw-bold text-decoration-underline">{{ route('sitemap') }}</a><br>
                                                • Crawler Directives are live at <a href="{{ route('robots') }}" target="_blank" class="fw-bold text-decoration-underline">{{ route('robots') }}</a><br>
                                                • Schema.org JSON-LD Structured Data (Google Knowledge Graph) is auto-injected on every page.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                            <i class="fa fa-floppy-disk me-2"></i> Save School Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
