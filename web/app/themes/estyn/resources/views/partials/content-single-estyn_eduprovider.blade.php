@include('partials.inside-hero', [
    'title' => get_the_title(),
    'heroImageSrc' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
    'heroImageAlt' => 'Attendance and attitudes to learning photo 2 BPF ESP 55',
    'sectors' => get_the_terms(get_the_ID(), 'sector'),
    'localAuthorities' => get_the_terms(get_the_ID(), 'local_authority'),
    'followUpStatusses' => get_the_terms(get_the_ID(), 'provider_status'),
    'insideIntroLinks' => [
        [
            'url' => '#',
            'bgColourClass' => 'bg-signpost-blue',
            'iconClasses' => 'fas fa-graduation-cap',
            'title' => __('Inspection report', 'sage'),
            'description' => __('Read the latest report for this provider', 'sage')
        ],
        [
            'url' => '#',
            'bgColourClass' => 'bg-signpost-verylightbrown',
            'iconClasses' => 'fas fa-book',
            'title' => __('Provider details', 'sage'),
            'description' => __('Contact details and location', 'sage')
        ],
        [
            'url' => '#',
            'bgColourClass' => 'bg-signpost-lightpink',
            'iconClasses' => 'fas fa-calendar-alt',
            'title' => __('Estyn widget', 'sage'),
            'description' => __('Find out when your inspection is due', 'sage')
        ]
    ]
])
<div class="reportMain">
    <div class="container px-md-4 px-xl-5 pt-5">
        <p>testing</p>
    </div>
</div>