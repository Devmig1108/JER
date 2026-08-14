<?php
declare(strict_types=1);

$recipient = 'info@jer-elite.com';
$formMessage = '';
$formError = false;

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = filter_var(trim((string) ($_POST['email'] ?? '')), FILTER_VALIDATE_EMAIL);
    $phone = trim((string) ($_POST['phone'] ?? ''));
    $project = trim((string) ($_POST['project'] ?? ''));
    $details = trim((string) ($_POST['details'] ?? ''));
    $website = trim((string) ($_POST['website'] ?? ''));

    if ($website !== '') {
        $formMessage = 'Thank you. Your request has been received.';
    } elseif ($name === '' || $email === false || $project === '') {
        $formError = true;
        $formMessage = 'Please provide your name, a valid email address, and project type.';
    } else {
        $safeName = preg_replace('/[\r\n]+/', ' ', $name) ?: 'Website visitor';
        $safeEmail = preg_replace('/[\r\n]+/', '', (string) $email);
        $subject = 'Roof assessment request from ' . $safeName;
        $body = implode("\n", [
            'Name: ' . $safeName,
            'Email: ' . $safeEmail,
            'Phone: ' . ($phone !== '' ? $phone : 'Not provided'),
            'Project: ' . $project,
            '',
            'Details:',
            $details !== '' ? $details : 'Not provided',
        ]);
        $headers = [
            'From: JER Website <noreply@jer-elite.com>',
            'Reply-To: ' . $safeEmail,
            'Content-Type: text/plain; charset=UTF-8',
        ];

        if (@mail($recipient, $subject, $body, implode("\r\n", $headers))) {
            $formMessage = 'Thank you. Your assessment request has been sent to the JER team.';
        } else {
            $formError = true;
            $formMessage = 'The request could not be sent. Please email info@jer-elite.com directly.';
        }
    }
}

$services = [
    ['01', 'Residential roofing', 'Replacement · New construction', 'Architectural shingle, standing seam metal, cedar, tile, and specialty systems composed for the home—not simply installed on it.'],
    ['02', 'Commercial systems', 'TPO · EPDM · Coatings', 'Durable low-slope and flat roofing assemblies engineered around drainage, energy performance, access, and long-term maintenance.'],
    ['03', 'Storm restoration', 'Inspection · Repair · Replacement', 'A calm, documented response after severe weather—from detailed inspection and temporary protection through a complete, considered restoration.'],
];

$faqs = [
    ['How do I know whether I need a repair or replacement?', 'A thorough roof assessment should come first. We evaluate the system’s age, installation, ventilation, flashing, material condition, and active damage before recommending the most responsible path.'],
    ['What roofing materials do you install?', 'JER works across premium architectural shingles, standing seam metal, cedar, tile, slate, and commercial membrane systems. The right recommendation depends on the architecture, performance goals, and existing structure.'],
    ['Can you help after storm damage?', 'Yes. We document visible damage, identify urgent protection needs, and develop a clear restoration scope so you can make an informed decision about next steps.'],
    ['What should I expect during the project?', 'A clear schedule, proactive communication, attentive site protection, and a disciplined final review. Your project lead keeps the work moving and keeps you informed.'],
];

$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'RoofingContractor',
    'name' => 'JER General Contractor',
    'url' => 'https://jer-elite.com',
    'email' => $recipient,
    'description' => 'Premium residential and commercial roof replacement, repair, and storm restoration.',
    'knowsAbout' => ['Residential roofing', 'Commercial roofing', 'Roof replacement', 'Roof repair', 'Storm restoration'],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => 'Roofing services',
        'itemListElement' => array_map(static fn(array $service): array => [
            '@type' => 'Offer',
            'itemOffered' => ['@type' => 'Service', 'name' => $service[1], 'description' => $service[3]],
        ], $services),
    ],
];

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0a171a">
    <title>JER General Contractor | Premium Roof Replacement &amp; Repair</title>
    <meta name="description" content="Premium residential and commercial roof replacement, repair, and storm restoration from a licensed, bonded, and insured roofing team.">
    <meta name="keywords" content="premium roofing contractor, roof replacement, roof repair, commercial roofing, storm restoration">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="https://jer-elite.com/">
    <link rel="icon" href="assets/jer-mark.webp">
    <link rel="apple-touch-icon" href="assets/jer-mark.webp">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://jer-elite.com/">
    <meta property="og:site_name" content="JER General Contractor">
    <meta property="og:title" content="JER General Contractor | Protection, Elevated">
    <meta property="og:description" content="High-performance roofing systems installed with exacting craft for homes and properties built to last.">
    <meta property="og:image" content="https://images.unsplash.com/photo-1632759145355-6cb31f78726f?auto=format&amp;fit=crop&amp;w=1600&amp;q=90">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="JER General Contractor | Protection, Elevated">
    <meta name="twitter:description" content="Premium residential and commercial roofing, replacement, repair, and restoration.">
    <link rel="stylesheet" href="styles.css">
    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body>
<main>
    <section class="hero" id="top" aria-labelledby="hero-title">
        <div class="hero-image" aria-hidden="true"></div>
        <div class="hero-vignette" aria-hidden="true"></div>
        <img class="hero-monogram" src="assets/jer-mark.webp" alt="" aria-hidden="true">
        <header class="site-header shell">
            <a class="brand" href="#top" aria-label="JER General Contractor roofing home">
                <span class="brand-lockup"><img src="assets/jer-mark.webp" alt=""><span><strong>JER</strong><small>General Contractor · Roofing</small></span></span>
            </a>
            <nav class="desktop-nav" aria-label="Primary navigation"><a href="#standard">Our standard</a><a href="#services">Expertise</a><a href="#work">Selected work</a></nav>
            <a class="header-cta" href="#consultation">Plan a consultation <span aria-hidden="true">↗</span></a>
        </header>

        <div class="hero-content shell">
            <div class="hero-copy">
                <p class="eyebrow"><span></span> Residential · Commercial · Restoration</p>
                <h1 id="hero-title">The roof over<br><em>everything that matters.</em></h1>
                <p class="hero-lede">High-performance roofing systems, installed with exacting craft for homes and properties built to last.</p>
                <div class="hero-actions">
                    <a class="button button-primary" href="#consultation">Request a roof assessment <span aria-hidden="true">↗</span></a>
                    <a class="text-link" href="#work">Explore our work <span>↓</span></a>
                </div>
            </div>
            <aside class="hero-note" aria-label="JER service promise"><span class="note-number">01</span><p>Protection, elevated.</p><small>Meticulous planning. Proven materials.<br>A finish worthy of the architecture.</small></aside>
        </div>
        <div class="hero-footer shell"><p>Fully licensed · Bonded · Insured</p><p class="scroll-label">Discover the JER standard <span>↓</span></p></div>
    </section>

    <section class="trust-strip" aria-label="Core commitments"><div class="shell trust-grid"><div><span>01</span><p>Precision installation</p></div><div><span>02</span><p>Premium material systems</p></div><div><span>03</span><p>Clear project stewardship</p></div><div><span>04</span><p>Residential &amp; commercial</p></div></div></section>

    <section class="opening shell" id="standard"><p class="section-kicker">The JER standard</p><h2>A roof should do more than cover a building.</h2><p class="opening-copy">It should perform beautifully, age gracefully, and make the structure beneath it feel complete. That belief shapes every inspection, every recommendation, and every detail we install.</p></section>

    <section class="standard-feature shell" aria-label="Our approach">
        <div class="standard-image" role="img" aria-label="Craftsperson installing premium roofing materials"></div>
        <article class="standard-card"><p class="section-kicker light">A higher measure</p><h2>Craftsmanship you can see. Protection you can trust.</h2><p>We design each roofing system around the property, the climate, and the way the structure needs to perform. Then we execute the details that determine how well it endures.</p><ul><li><span>01</span> System-first recommendations</li><li><span>02</span> Disciplined installation standards</li><li><span>03</span> Clean, considered job sites</li></ul><a class="text-link dark-link" href="#process">See how we work <span aria-hidden="true">↗</span></a></article>
    </section>

    <section class="services" id="services">
        <div class="shell services-heading"><div><p class="section-kicker light">Specialized expertise</p><h2>One standard.<br><em>Every roof.</em></h2></div><p>From a single-family residence to a complex commercial envelope, our discipline does not change: understand the system, respect the structure, and install with precision.</p></div>
        <div class="shell service-list">
            <?php foreach ($services as [$number, $title, $tag, $copy]): ?>
                <article class="service-row"><span class="service-number"><?= e($number) ?></span><div><h3><?= e($title) ?></h3><small><?= e($tag) ?></small></div><p><?= e($copy) ?></p><span aria-hidden="true">↗</span></article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="project-paths" aria-labelledby="project-paths-title">
        <div class="shell paths-heading"><p class="section-kicker">Start with what you know</p><h2 id="project-paths-title">Whatever brought you here,<br><em>there is a clear next step.</em></h2></div>
        <div class="shell path-grid">
            <a class="path-card" href="#consultation"><span>01</span><small>Urgent concern</small><h3>Active leak or interior staining</h3><p>Begin with a focused assessment to find the source and protect the property.</p><i>Request an assessment <span aria-hidden="true">↗</span></i></a>
            <a class="path-card" href="#consultation"><span>02</span><small>Recent weather</small><h3>Storm, wind, or hail exposure</h3><p>Document the visible condition and understand what requires immediate attention.</p><i>Review the damage <span aria-hidden="true">↗</span></i></a>
            <a class="path-card" href="#consultation"><span>03</span><small>Planned investment</small><h3>Aging system or considered upgrade</h3><p>Compare responsible options for performance, longevity, and architectural fit.</p><i>Plan the project <span aria-hidden="true">↗</span></i></a>
        </div>
    </section>

    <section class="process shell" id="process">
        <div class="process-intro"><p class="section-kicker">A composed process</p><h2>Certainty at every stage.</h2><p>Premium work is not only the finished roof. It is the clarity, care, and confidence you experience on the way there.</p></div>
        <ol class="process-steps"><li><span>01</span><h3>Assess</h3><p>We examine the complete roof system and listen closely to your goals.</p></li><li><span>02</span><h3>Specify</h3><p>You receive a clear, tailored recommendation with an understandable scope.</p></li><li><span>03</span><h3>Execute</h3><p>Experienced crews protect the property and install to exacting standards.</p></li><li><span>04</span><h3>Assure</h3><p>We review the work, the site, and the system details before closeout.</p></li></ol>
    </section>

    <section class="work" id="work">
        <div class="shell work-heading"><div><p class="section-kicker light">Selected work</p><h2>Built to protect.<br><em>Designed to belong.</em></h2></div><p>Every property has a visual language. The best roofing work strengthens it quietly.</p></div>
        <div class="shell project-grid">
            <article class="project project-large"><div class="project-image project-one" role="img" aria-label="Contemporary luxury residence with a dark architectural roof"></div><div class="project-caption"><div><span>Residential</span><h3>Architectural shingle system</h3></div><p>Performance without compromising the home's proportions.</p></div></article>
            <article class="project"><div class="project-image project-two" role="img" aria-label="Modern residence with standing seam metal roofing"></div><div class="project-caption"><div><span>Residential</span><h3>Standing seam metal</h3></div></div></article>
            <article class="project"><div class="project-image project-three" role="img" aria-label="Commercial property with a low-slope roofing system"></div><div class="project-caption"><div><span>Commercial</span><h3>High-performance flat roof</h3></div></div></article>
        </div>
    </section>

    <section class="faq shell">
        <div class="faq-heading"><p class="section-kicker">Before your project</p><h2>Questions, answered clearly.</h2></div>
        <div class="faq-list">
            <?php foreach ($faqs as $index => [$question, $answer]): ?>
                <details><summary><span>0<?= $index + 1 ?></span><?= e($question) ?><i>+</i></summary><p><?= e($answer) ?></p></details>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="consultation" id="consultation">
        <div class="shell consultation-grid">
            <div class="consult-copy"><p class="section-kicker light">Begin with a conversation</p><h2>Let's protect what you've built.</h2><p>Tell us about your property and what you are seeing. We'll help you identify the right next step.</p><a href="mailto:info@jer-elite.com">info@jer-elite.com <span aria-hidden="true">↗</span></a></div>
            <form class="lead-form" method="post" action="#consultation">
                <?php if ($formMessage !== ''): ?><p class="form-status<?= $formError ? ' error' : '' ?>" role="status"><?= e($formMessage) ?></p><?php endif; ?>
                <label class="website-field" aria-hidden="true">Website<input name="website" tabindex="-1" autocomplete="off"></label>
                <div class="field-row"><label><span>Name</span><input name="name" autocomplete="name" required placeholder="Your name" value="<?= e((string) ($_POST['name'] ?? '')) ?>"></label><label><span>Email</span><input name="email" type="email" autocomplete="email" required placeholder="you@email.com" value="<?= e((string) ($_POST['email'] ?? '')) ?>"></label></div>
                <div class="field-row"><label><span>Phone <small>Optional</small></span><input name="phone" type="tel" autocomplete="tel" placeholder="(000) 000–0000" value="<?= e((string) ($_POST['phone'] ?? '')) ?>"></label><label><span>Project type</span><select name="project" required><option value="" disabled <?= empty($_POST['project']) ? 'selected' : '' ?>>Select one</option><?php foreach (['Roof replacement', 'Roof repair', 'Storm restoration', 'Commercial roofing', 'Not sure yet'] as $option): ?><option <?= (($_POST['project'] ?? '') === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></label></div>
                <label><span>Tell us about the property <small>Optional</small></span><textarea name="details" rows="3" placeholder="What are you seeing, and how can we help?"><?= e((string) ($_POST['details'] ?? '')) ?></textarea></label>
                <div class="form-action"><p>Your information is used only to respond to this request.</p><button class="button button-primary" type="submit">Send my request <span aria-hidden="true">↗</span></button></div>
            </form>
        </div>
    </section>

    <footer>
        <div class="shell footer-top"><a class="brand footer-brand" href="#top" aria-label="JER General Contractor roofing home"><span class="brand-lockup brand-lockup-full"><img src="assets/jer-logo.webp" alt="JER General Contractor"></span></a><p>Premium residential &amp; commercial roofing.<br>Fully licensed, bonded, and insured.</p><nav aria-label="Footer navigation"><a href="#standard">Our standard</a><a href="#services">Expertise</a><a href="#work">Selected work</a><a href="#consultation">Contact</a></nav></div>
        <div class="shell footer-bottom"><p>© <?= date('Y') ?> JER General Contractor</p><p>Protection, elevated.</p><a href="#top">Back to top ↑</a></div>
    </footer>
    <a class="mobile-cta" href="#consultation">Request assessment <span aria-hidden="true">↗</span></a>
</main>
</body>
</html>
