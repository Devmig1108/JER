<?php
declare(strict_types=1);

$recipient = 'info@jer-elite.com';
$formMessage = '';
$formError = false;

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = filter_var(trim((string) ($_POST['email'] ?? '')), FILTER_VALIDATE_EMAIL);
    $phone = trim((string) ($_POST['phone'] ?? ''));
    $propertyType = trim((string) ($_POST['property_type'] ?? ''));
    $timeline = trim((string) ($_POST['timeline'] ?? ''));
    $details = trim((string) ($_POST['details'] ?? ''));
    $website = trim((string) ($_POST['website'] ?? ''));

    if ($website !== '') {
        $formMessage = 'Thank you. Your request has been received.';
    } elseif ($name === '' || $email === false || $propertyType === '') {
        $formError = true;
        $formMessage = 'Please provide your name, a valid email address, and property type.';
    } else {
        $safeName = preg_replace('/[\r\n]+/', ' ', $name) ?: 'Website visitor';
        $safeEmail = preg_replace('/[\r\n]+/', '', (string) $email);
        $safePhone = preg_replace('/[\r\n]+/', ' ', $phone) ?: 'Not provided';
        $safePropertyType = preg_replace('/[\r\n]+/', ' ', $propertyType) ?: 'Not provided';
        $safeTimeline = preg_replace('/[\r\n]+/', ' ', $timeline) ?: 'Not provided';
        $subject = 'Roof replacement consultation from ' . $safeName;
        $body = implode("\n", [
            'Source: Roof replacement service page',
            'Name: ' . $safeName,
            'Email: ' . $safeEmail,
            'Phone: ' . $safePhone,
            'Property type: ' . $safePropertyType,
            'Project timing: ' . $safeTimeline,
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
            $formMessage = 'Thank you. Your roof replacement consultation request has been sent.';
        } else {
            $formError = true;
            $formMessage = 'The request could not be sent. Please email info@jer-elite.com directly.';
        }
    }
}

$replacementSignals = [
    ['01', 'Age and widespread wear', 'A roof with broad material deterioration may need a system-level solution rather than another isolated repair.'],
    ['02', 'Recurring leaks', 'Repeated water entry in different areas can point to conditions that should be evaluated across the entire roof assembly.'],
    ['03', 'Storm or impact damage', 'Wind, hail, and debris can affect more than the visible surface. A documented assessment clarifies the extent of the damage.'],
    ['04', 'A planned property upgrade', 'Replacement can be considered alongside exterior improvements, energy goals, long-term ownership plans, or a change in roofing material.'],
];

$systems = [
    ['Architectural shingle', 'A versatile residential option available in varied profiles and colors. Selection should account for roof geometry, ventilation, appearance, and project goals.'],
    ['Standing seam metal', 'A clean-lined roofing system often considered for durability and architectural definition. Proper detailing is central to performance.'],
    ['Tile and specialty systems', 'Distinctive materials that require careful evaluation of the existing structure, underlayment, flashing, and installation requirements.'],
];

$faqs = [
    ['How do I know whether my roof needs replacement?', 'The decision should follow a complete assessment, not a single symptom. JER reviews material condition, recurring leaks, flashing, ventilation, visible damage, and the overall roof assembly before discussing repair or replacement.'],
    ['Can a damaged roof still be repaired instead?', 'Sometimes. A focused repair may be responsible when damage is limited and the remaining system is in serviceable condition. The assessment is designed to separate an isolated issue from broader system failure.'],
    ['How long does a roof replacement take?', 'Timing depends on roof size, slope, material, access, weather, required preparation, and the final scope. JER establishes the schedule after evaluating the property and confirming the selected system.'],
    ['How do we choose the right roofing material?', 'Material selection should balance the structure, roof geometry, desired appearance, maintenance expectations, performance priorities, and budget. JER explains the practical tradeoffs before the scope is finalized.'],
    ['What should be included in a replacement proposal?', 'A useful proposal should clearly identify the recommended system, removal and preparation work, major installation details, site-protection plan, project assumptions, and the next steps required before work begins.'],
];

$schema = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Roof Replacement in El Paso, TX',
        'serviceType' => 'Roof replacement',
        'url' => 'https://jer-elite.com/roof-replacement/',
        'description' => 'Residential and commercial roof replacement planning, system selection, installation, and project closeout in El Paso, Texas.',
        'areaServed' => ['@type' => 'City', 'name' => 'El Paso', 'containedInPlace' => ['@type' => 'State', 'name' => 'Texas']],
        'provider' => [
            '@type' => 'Organization',
            'name' => 'JER General Contractor',
            'url' => 'https://jer-elite.com/',
            'email' => $recipient,
        ],
    ],
    [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://jer-elite.com/'],
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Roof Replacement', 'item' => 'https://jer-elite.com/roof-replacement/'],
        ],
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
    <title>Roof Replacement in El Paso, TX | JER General Contractor</title>
    <meta name="description" content="Plan a roof replacement in El Paso, TX with a clear assessment, system comparison, defined scope, careful installation, and disciplined closeout.">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <link rel="canonical" href="https://jer-elite.com/roof-replacement/">
    <link rel="icon" href="../assets/jer-mark.webp">
    <link rel="apple-touch-icon" href="../assets/jer-mark.webp">
    <link rel="preconnect" href="https://images.unsplash.com" crossorigin>
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://jer-elite.com/roof-replacement/">
    <meta property="og:site_name" content="JER General Contractor">
    <meta property="og:title" content="Roof Replacement in El Paso, TX | JER General Contractor">
    <meta property="og:description" content="A considered El Paso roof replacement process—from assessment and system selection through installation and final review.">
    <meta property="og:image" content="https://images.unsplash.com/photo-1632759145355-6cb31f78726f?auto=format&amp;fit=crop&amp;w=1600&amp;q=90">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Roof Replacement in El Paso, TX | JER General Contractor">
    <meta name="twitter:description" content="Plan an El Paso roof replacement around the property, the complete roof system, and the priorities that matter after installation.">
    <link rel="stylesheet" href="../styles.css">
    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body class="service-page replacement-page">
<main>
    <section class="inner-hero" id="top" aria-labelledby="replacement-title">
        <img class="inner-hero-image" src="https://images.unsplash.com/photo-1632759145355-6cb31f78726f?auto=format&amp;fit=crop&amp;w=2200&amp;q=90" alt="Roofing professional working on a residential roof replacement" width="2200" height="1467" fetchpriority="high">
        <div class="inner-hero-vignette" aria-hidden="true"></div>
        <img class="hero-monogram inner-monogram" src="../assets/jer-mark.webp" alt="" aria-hidden="true">

        <header class="site-header shell">
            <a class="brand" href="../" aria-label="JER General Contractor home">
                <span class="brand-lockup"><img src="../assets/jer-mark.webp" alt=""><span><strong>JER</strong><small>General Contractor · Roofing</small></span></span>
            </a>
            <nav class="desktop-nav" aria-label="Primary navigation"><a href="../">Home</a><a href="./" aria-current="page">Roof replacement</a><a href="../roof-repair/">Roof repair</a><a href="#replacement-faq">Questions</a></nav>
            <a class="header-cta" href="#replacement-consultation">Plan a consultation <span aria-hidden="true">↗</span></a>
        </header>
        <nav class="mobile-nav shell" aria-label="Mobile navigation"><a href="../">Home</a><a href="./" aria-current="page">Replacement</a><a href="../roof-repair/">Repair</a></nav>

        <div class="inner-hero-content shell">
            <div class="inner-hero-copy">
                <nav class="breadcrumbs" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page">Roof replacement</span></nav>
                <p class="eyebrow"><span></span> Roof replacement · El Paso, Texas</p>
                <h1 id="replacement-title">Roof replacement<br><em>in El Paso, TX.</em></h1>
                <p class="hero-lede">A new roof is a major property decision. JER brings the condition, material options, installation details, and project scope into one clear plan for El Paso properties.</p>
                <div class="hero-actions">
                    <a class="button button-primary" href="#replacement-consultation">Request a replacement assessment <span aria-hidden="true">↗</span></a>
                    <a class="text-link" href="#replacement-guide">Understand the decision <span>↓</span></a>
                </div>
            </div>
            <aside class="replacement-brief" aria-label="What a roof replacement assessment should clarify">
                <span class="note-number">Replacement brief</span>
                <h2>Begin with the questions that shape the entire project.</h2>
                <ul><li>What condition is the full roof system in?</li><li>Which materials fit the structure and priorities?</li><li>What preparation and details belong in the scope?</li></ul>
            </aside>
        </div>
        <div class="hero-footer shell"><p>Assessment · Specification · Installation</p><p class="scroll-label">Explore the replacement process <span>↓</span></p></div>
    </section>

    <section class="trust-strip" aria-label="Roof replacement priorities">
        <div class="shell trust-grid"><div><span>01</span><p>Complete-system assessment</p></div><div><span>02</span><p>Material comparison</p></div><div><span>03</span><p>Defined project scope</p></div><div><span>04</span><p>Disciplined closeout</p></div></div>
    </section>

    <section class="replacement-guide shell" id="replacement-guide">
        <div class="replacement-intro">
            <p class="section-kicker">Repair or replace</p>
            <h2>When roof replacement becomes the responsible next step in El Paso.</h2>
            <div class="replacement-intro-copy">
                <p>Not every roofing problem calls for a full replacement. The right decision depends on whether the concern is isolated or part of wider deterioration across the roof assembly.</p>
                <p>For an El Paso roof, the assessment should look beyond surface appearance. Material condition, flashing, penetrations, drainage, ventilation, underlayment, recurring leaks, previous work, sun exposure, wind exposure, and the property's long-term plan all help define the appropriate path.</p>
            </div>
        </div>
        <div class="signal-grid">
            <?php foreach ($replacementSignals as [$number, $title, $copy]): ?>
                <article class="signal-card"><span><?= e($number) ?></span><h3><?= e($title) ?></h3><p><?= e($copy) ?></p></article>
            <?php endforeach; ?>
        </div>
        <p class="guide-note">These conditions are reasons to schedule an assessment—not a diagnosis by themselves. JER reviews the property before recommending a scope.</p>
    </section>

    <section class="replacement-scope" aria-labelledby="scope-title">
        <div class="shell scope-grid">
            <div class="scope-image" role="img" aria-label="Detailed roofing installation work"></div>
            <div class="scope-content">
                <p class="section-kicker light">The complete assembly</p>
                <h2 id="scope-title">The visible roof is only one part of the system.</h2>
                <p>A replacement plan should account for the connected components that manage water, airflow, transitions, edges, penetrations, and long-term serviceability.</p>
                <dl>
                    <div><dt>Roof surface</dt><dd>Condition, material, fastening approach, transitions, and finish details.</dd></div>
                    <div><dt>Water management</dt><dd>Underlayment, flashing, valleys, edges, penetrations, and drainage conditions.</dd></div>
                    <div><dt>Airflow and structure</dt><dd>Ventilation, visible deck conditions, roof geometry, and system compatibility.</dd></div>
                    <div><dt>Project environment</dt><dd>Access, landscaping, occupied areas, debris control, and site protection.</dd></div>
                </dl>
            </div>
        </div>
    </section>

    <section class="system-options shell" id="replacement-systems" aria-labelledby="systems-title">
        <div class="systems-heading"><div><p class="section-kicker">Material direction</p><h2 id="systems-title">Choose the system after understanding the property.</h2></div><p>The best roof is not simply the most expensive material. It is the system that fits the structure, detailing requirements, appearance, performance priorities, and ownership plan.</p></div>
        <div class="system-grid">
            <?php foreach ($systems as $index => [$title, $copy]): ?>
                <article class="system-card"><span>0<?= $index + 1 ?></span><h3><?= e($title) ?></h3><p><?= e($copy) ?></p><a href="#replacement-consultation">Discuss this system <i aria-hidden="true">↗</i></a></article>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="replacement-process" id="replacement-process" aria-labelledby="replacement-process-title">
        <div class="shell process-heading"><p class="section-kicker light">From condition to closeout</p><h2 id="replacement-process-title">A roof replacement process designed for clarity.</h2><p>Each phase resolves a different set of questions so the project can move forward with fewer assumptions and a better-defined outcome.</p></div>
        <ol class="shell replacement-steps">
            <li><span>01</span><div><small>Assess</small><h3>Understand the existing roof</h3><p>Review the roof assembly, visible condition, known concerns, access, and the goals behind the project.</p></div></li>
            <li><span>02</span><div><small>Specify</small><h3>Define the recommended system</h3><p>Compare appropriate material directions and organize the preparation, installation, and detail work into a clear scope.</p></div></li>
            <li><span>03</span><div><small>Prepare</small><h3>Plan the property experience</h3><p>Coordinate scheduling, access, staging, site protection, communication, and the practical details of the work.</p></div></li>
            <li><span>04</span><div><small>Install</small><h3>Build the roof as a complete system</h3><p>Execute the defined scope with attention to transitions, penetrations, edges, water management, and finish quality.</p></div></li>
            <li><span>05</span><div><small>Close out</small><h3>Review the work and the site</h3><p>Complete the final walkthrough, address closeout items, and leave the property ready for the next chapter.</p></div></li>
        </ol>
    </section>

    <section class="decision-panel shell" aria-labelledby="decision-title">
        <div><p class="section-kicker">A useful first conversation</p><h2 id="decision-title">You do not need to arrive knowing the answer.</h2></div>
        <div><p>If you are weighing another repair against a full replacement, start with what you are seeing and what you want from the property. JER can help organize the decision around the roof's condition and the scope each path would require.</p><a class="button button-primary" href="#replacement-consultation">Discuss the roof <span aria-hidden="true">↗</span></a></div>
    </section>

    <section class="faq shell" id="replacement-faq">
        <div class="faq-heading"><p class="section-kicker">Roof replacement FAQ</p><h2>Questions worth asking before the project begins.</h2></div>
        <div class="faq-list">
            <?php foreach ($faqs as $index => [$question, $answer]): ?>
                <details><summary><span>0<?= $index + 1 ?></span><?= e($question) ?><i>+</i></summary><p><?= e($answer) ?></p></details>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="consultation" id="replacement-consultation">
        <div class="shell consultation-grid">
            <div class="consult-copy"><p class="section-kicker light">Plan the replacement</p><h2>Bring the roof into focus.</h2><p>Tell us about the property, what prompted the project, and when you are considering the work. JER will use that context to prepare for the first conversation.</p><a href="mailto:info@jer-elite.com">info@jer-elite.com <span aria-hidden="true">↗</span></a></div>
            <form class="lead-form" method="post" action="#replacement-consultation">
                <?php if ($formMessage !== ''): ?><p class="form-status<?= $formError ? ' error' : '' ?>" role="status"><?= e($formMessage) ?></p><?php endif; ?>
                <label class="website-field" aria-hidden="true">Website<input name="website" tabindex="-1" autocomplete="off"></label>
                <div class="field-row"><label><span>Name</span><input name="name" autocomplete="name" required maxlength="100" placeholder="Your name" value="<?= e((string) ($_POST['name'] ?? '')) ?>"></label><label><span>Email</span><input name="email" type="email" autocomplete="email" required maxlength="160" placeholder="you@email.com" value="<?= e((string) ($_POST['email'] ?? '')) ?>"></label></div>
                <div class="field-row"><label><span>Phone <small>Optional</small></span><input name="phone" type="tel" autocomplete="tel" maxlength="40" placeholder="(000) 000–0000" value="<?= e((string) ($_POST['phone'] ?? '')) ?>"></label><label><span>Property type</span><select name="property_type" required><option value="" disabled <?= empty($_POST['property_type']) ? 'selected' : '' ?>>Select one</option><?php foreach (['Single-family home', 'Multifamily property', 'Commercial property', 'Other'] as $option): ?><option <?= (($_POST['property_type'] ?? '') === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></label></div>
                <label><span>Project timing <small>Optional</small></span><select name="timeline"><option value="">Select one</option><?php foreach (['As soon as appropriate', 'Within 1–3 months', 'Within 3–6 months', 'Planning for later', 'Not sure yet'] as $option): ?><option <?= (($_POST['timeline'] ?? '') === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></label>
                <label><span>What prompted the project? <small>Optional</small></span><textarea name="details" rows="4" maxlength="2000" placeholder="Roof age, leaks, storm exposure, material interest, or anything else we should know."><?= e((string) ($_POST['details'] ?? '')) ?></textarea></label>
                <div class="form-action"><p>Your information is used only to respond to this request.</p><button class="button button-primary" type="submit">Request consultation <span aria-hidden="true">↗</span></button></div>
            </form>
        </div>
    </section>

    <footer>
        <div class="shell footer-top"><a class="brand footer-brand" href="../" aria-label="JER General Contractor home"><span class="brand-lockup brand-lockup-full"><img src="../assets/jer-logo.webp" alt="JER General Contractor"></span></a><p>Residential &amp; commercial roofing<br>in El Paso, Texas.</p><nav aria-label="Footer navigation"><a href="../">Home</a><a href="./">Roof replacement</a><a href="../roof-repair/">Roof repair</a><a href="#replacement-consultation">Contact</a></nav></div>
        <div class="shell footer-bottom"><p>© <?= date('Y') ?> JER General Contractor</p><p>Roof replacement in El Paso, TX</p><a href="#top">Back to top ↑</a></div>
    </footer>
    <a class="mobile-cta" href="#replacement-consultation">Plan a replacement <span aria-hidden="true">↗</span></a>
</main>
</body>
</html>
