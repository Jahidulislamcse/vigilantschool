@if(isset($facilities) && $facilities->count() > 0)
    @php
        $colors = ['primary', 'success', 'warning', 'info'];
    @endphp
    @foreach($facilities as $index => $facility)
    @php
        $theme = $facility->color_theme ?: $colors[$index % 4];
    @endphp
    <div class="modal fade facility-modal" id="facilityModal{{ $facility->id }}" tabindex="-1" aria-labelledby="facilityModalLabel{{ $facility->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg position-relative overflow-hidden">
                <!-- Top Accent Highlight Line -->
                <div class="facility-modal-bar facility-modal-bar-{{ $theme }}"></div>
                
                <div class="modal-header border-0 pb-0 pt-3 pt-md-4 px-3 px-md-4 justify-content-between align-items-center">
                    <span class="badge bg-{{ $theme }}-subtle text-{{ $theme }} border border-{{ $theme }}-subtle px-3 py-1 rounded-pill small fw-bold">
                        <i class="fa-solid fa-school me-1"></i> Campus Facility
                    </span>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body px-3 px-md-4 py-3 text-center">
                    <!-- 3D Squircle Icon Badge -->
                    <div class="facility-modal-icon facility-modal-icon-{{ $theme }} mx-auto my-2 my-md-3">
                        <i class="fa-solid {{ $facility->icon ?? 'fa-school' }}"></i>
                    </div>

                    <h4 class="modal-title fw-bold text-dark mb-2" id="facilityModalLabel{{ $facility->id }}">
                        {{ $facility->title }}
                    </h4>
                    
                    <p class="text-muted mb-3 px-1" style="font-size: 0.95rem; line-height: 1.55;">
                        {{ $facility->short_description }}
                    </p>

                    <!-- Key Features Highlight Box -->
                    <div class="facility-modal-highlights text-start p-3 p-md-4 rounded-3 mb-2">
                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center" style="font-size: 0.92rem;">
                            <i class="fa fa-circle-check text-{{ $theme }} me-2 fs-5"></i> Key Highlights & Features
                        </h6>
                        <ul class="list-unstyled mb-0 d-flex flex-column gap-2 small text-secondary">
                            @if(str_contains(strtolower($facility->title), 'teacher') || str_contains(strtolower($facility->title), 'classroom'))
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>2 Dedicated Teachers</strong> in each junior classroom from Play Group to Std-IV for individual care.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>Limited Seat Arrangement</strong> ensuring interactive learning and noise-free focus.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>Daily In-Class Lesson Practice</strong>, minimizing burdensome home tutoring.</span>
                                </li>
                            @elseif(str_contains(strtolower($facility->title), 'lab') || str_contains(strtolower($facility->title), 'library') || str_contains(strtolower($facility->title), 'science'))
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>Equipped Science Laboratory</strong> with physics, chemistry, and biology experimental kits.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>Modern Computer Workstations</strong> with digital learning tools & monitored internet.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>Curated Student Library</strong> featuring Edexcel references, Islamic ethics, and storybooks.</span>
                                </li>
                            @elseif(str_contains(strtolower($facility->title), 'cctv') || str_contains(strtolower($facility->title), 'ips') || str_contains(strtolower($facility->title), 'security'))
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>24/7 CC Camera Surveillance</strong> with integrated audio sound monitoring in all rooms.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>Standby Heavy-Duty IPS Generator</strong> for uninterrupted lighting and ventilation.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>Controlled Gate Access</strong> and dedicated security personnel for student protection.</span>
                                </li>
                            @elseif(str_contains(strtolower($facility->title), 'acap') || str_contains(strtolower($facility->title), 'care'))
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>After Class Assistance Programme (ACAP)</strong> for students needing extra academic support.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>Weekly & Monthly Guardian Meetings</strong> to actively review child progress and growth.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span><strong>Holistic Moral Character Coaching</strong> including Arabic Surah and Islamic etiquette.</span>
                                </li>
                            @else
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span>Standardized English Medium & English Version curriculum following British Council guidelines.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span>Supervised child-friendly environment with caring educators and modern facilities.</span>
                                </li>
                                <li class="d-flex align-items-start">
                                    <i class="fa fa-check text-{{ $theme }} mt-1 me-2 flex-shrink-0"></i>
                                    <span>Transparent administration with no hidden fees and full academic accountability.</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="modal-footer border-0 px-3 px-md-4 pb-3 pb-md-4 pt-0 gap-2 justify-content-between flex-nowrap">
                    <button type="button" class="btn btn-light rounded-pill px-3 px-md-4 flex-grow-1" data-bs-dismiss="modal">
                        Close
                    </button>
                    <a href="{{ route('appointment') }}" class="btn btn-primary rounded-pill px-3 px-md-4 flex-grow-1 text-nowrap">
                        Book Tour <i class="fa fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif
