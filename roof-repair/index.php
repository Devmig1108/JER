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
    $concern = trim((string) ($_POST['concern'] ?? ''));
    $details = trim((string) ($_POST['details'] ?? ''));
    $website = trim((string) ($_POST['website'] ?? ''));

    if ($website !== '') {
        $formMessage = 'Thank you. Your request has been received.';
    } elseif ($name === '' || $email === false || $propertyType === '' || $concern === '') {
        $formError = true;
        $formMessage = 'Please provide your name, a valid email address, property type, and primary roofing concern.';
    } else {
        $safeName = preg_replace('/[\r\n]+/', ' ', $name) ?: 'Website visitor';
        $safeEmail = preg_replace('/[\r\n]+/', '', (string) $email);
        $safePhone = preg_replace('/[\r\n]+/', ' ', $phone) ?: 'Not provided';
        $safePropertyType = preg_replace('/[\r\n]+/', ' ', $propertyType) ?: 'Not provided';
        $safeConcern = preg_replace('/[\r\n]+/', ' ', $concern) ?: 'Not provided';
        $subject = 'El Paso roof repair request from ' . $safeName;
        $body = implode("\n", [
            'Source: El Paso roof repair service page',
            'Name: ' . $safeName,
            'Email: ' . $safeEmail,
            'Phone: ' . $safePhone,
            'Property type: ' . $safePropertyType,
            'Primary concern: ' . $safeConcern,
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
            $formMessage = 'Thank you. Your El Paso roof repair request has been sent.';
        } else {
            $formError = true;
            $formMessage = 'The request could not be sent. Please email info@jer-elite.com directly.';
        }
    }
}

$repairSignals = [
    ['01', 'Interior stains or active leaks', 'Water can travel before it becomes visible indoors. The inspection should trace the likely entry point instead of treating only the interior symptom.'],
    ['02', 'Damaged or missing material', 'Lifted, cracked, displaced, or missing roofing can leave surrounding components exposed and should be evaluated in context.'],
    ['03', 'Flashing and penetration concerns', 'Edges, walls, vents, pipes, skylights, and other transitions depend on correctly integrated details to manage water.'],
    ['04', 'Wind, hail, or debris exposure', 'After an El Paso storm, a documented roof assessment can separate visible impact from conditions that require closer attention.'],
];

$repairTypes = [
    ['Leak investigation', 'Trace likely water-entry paths and review the connected roofing details before defining the repair area.'],
    ['Material and flashing repair', 'Address affected surface materials, transitions, edges, penetrations, or flashing within a clearly documented scope.'],
    ['Storm-related roof repair', 'Assess visible wind, hail, or debris damage and identify temporary or permanent work appropriate to the condition found.'],
];

$faqs = [
    ['What are common signs that a roof needs repair?', 'Interior staining, active dripping, displaced or missing material, damaged flashing, exposed fasteners, deteriorated sealant, debris impact, and changes noticed after wind or hail are all reasons to schedule an assessment.'],
    ['Can you identify where a roof leak is coming from?', 'A repair assessment looks for likely entry points and follows how water may be moving through the roof assembly. Because water can travel, the visible interior stain is not always directly below the exterior source.'],
    ['Should I repair or replace my roof?', 'That depends on the extent of damage, the condition of the surrounding roof, recurring issues, prior work, and the expected serviceability of the remaining system. JER evaluates those factors before recommending either path.'],
    ['What should I do after wind or hail in El Paso?', 'Document what you can see safely from the ground, protect interior belongings if water is entering, and arrange a roof assessment. Avoid walking on the roof or attempting repairs in unsafe conditions.'],
    ['How long does a roof repair take?', 'The timeline depends on the source of the problem, roof access, weather, material availability, and the confirmed scope. JER can discuss timing after the condition has been assessed.'],
];

$schema = [
    [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Roof Repair in El Paso, TX',
        'serviceType' => 'Roof repair',
        'url' => 'https://jer-elite.com/roof-repair/',
        'description' => 'Roof leak investigation, storm-related roof repair, flashing repair, and material repair for homes and commercial properties in El Paso, Texas.',
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
            ['@type' => 'ListItem', 'position' => 2, 'name' => 'Roof Repair', 'item' => 'https://jer-elite.com/roof-repair/'],
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
    <title>Roof Repair in El Paso, TX | JER General Contractor</title>
    <meta name="description" content="Request roof repair in El Paso, TX for leaks, damaged roofing, flashing concerns, or storm-related damage. Start with a focused JER assessment.">
    <meta name="robots" content="index,follow,max-image-preview:large">
    <link rel="canonical" href="https://jer-elite.com/roof-repair/">
    <link rel="icon" href="../assets/jer-mark.webp">
    <link rel="apple-touch-icon" href="../assets/jer-mark.webp">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://jer-elite.com/roof-repair/">
    <meta property="og:site_name" content="JER General Contractor">
    <meta property="og:title" content="Roof Repair in El Paso, TX | JER General Contractor">
    <meta property="og:description" content="A focused El Paso roof repair process—from locating the concern and defining the scope through repair and review.">
    <meta property="og:image" content="https://jer-elite.com/assets/projects/el-paso-brown-shingle-roof.webp">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Roof Repair in El Paso, TX | JER General Contractor">
    <meta name="twitter:description" content="Roof leak investigation and considered roof repair for El Paso homes and commercial properties.">
    <link rel="stylesheet" href="../styles.css">
    <script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
</head>
<body class="service-page repair-page">
<main>
    <section class="inner-hero" id="top" aria-labelledby="repair-title">
        <img class="inner-hero-image" src="../assets/projects/el-paso-brown-shingle-roof.webp" alt="Brown architectural shingle roof with the Franklin Mountains in El Paso" width="1600" height="1200" fetchpriority="high">
        <div class="inner-hero-vignette" aria-hidden="true"></div>
        <img class="hero-monogram inner-monogram" src="../assets/jer-mark.webp" alt="" aria-hidden="true">

        <header class="site-header shell">
            <a class="brand" href="../" aria-label="JER General Contractor home"><span class="brand-lockup"><img src="../assets/jer-mark.webp" alt=""><span><strong>JER</strong><small>General Contractor · Roofing</small></span></span></a>
            <nav class="desktop-nav" aria-label="Primary navigation"><a href="../">Home</a><a href="../roof-replacement/">Roof replacement</a><a href="./" aria-current="page">Roof repair</a><a href="#repair-faq">Questions</a></nav>
            <a class="header-cta" href="#repair-request">Request an assessment <span aria-hidden="true">↗</span></a>
        </header>
        <nav class="mobile-nav shell" aria-label="Mobile navigation"><a href="../">Home</a><a href="../roof-replacement/">Replacement</a><a href="./" aria-current="page">Repair</a></nav>

        <div class="inner-hero-content shell">
            <div class="inner-hero-copy">
                <nav class="breadcrumbs" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page">Roof repair</span></nav>
                <p class="eyebrow"><span></span> Roof repair · El Paso, Texas</p>
                <h1 id="repair-title">Roof repair<br><em>in El Paso, TX.</em></h1>
                <p class="hero-lede">A lasting repair begins by understanding how the problem started, what it affects, and how the surrounding roof is performing.</p>
                <div class="hero-actions"><a class="button button-primary" href="#repair-request">Request a roof repair assessment <span aria-hidden="true">↗</span></a><a class="text-link" href="#repair-guide">See what we evaluate <span>↓</span></a></div>
            </div>
            <aside class="replacement-brief" aria-label="Information that helps begin a roof repair assessment"><span class="note-number">Repair brief</span><h2>Start with what changed.</h2><ul><li>Where and when did you first notice the concern?</li><li>Was there recent wind, hail, rain, or debris?</li><li>Has this area been repaired before?</li></ul></aside>
        </div>
        <div class="hero-footer shell"><p>Locate · Document · Repair · Review</p><p class="scroll-label">Understand the repair process <span>↓</span></p></div>
    </section>

    <section class="trust-strip" aria-label="Roof repair priorities"><div class="shell trust-grid"><div><span>01</span><p>Focused leak investigation</p></div><div><span>02</span><p>Condition-based scope</p></div><div><span>03</span><p>Property-conscious work</p></div><div><span>04</span><p>Clear next-step guidance</p></div></div></section>

    <section class="replacement-guide repair-guide shell" id="repair-guide">
        <div class="replacement-intro"><p class="section-kicker">Find the cause</p><h2>Repair the roofing concern—not only the visible symptom.</h2><div class="replacement-intro-copy"><p>Roof leaks and material damage are not always isolated where they first appear. Water can move along the roof assembly, while wind or impact can disturb connected details beyond one obvious spot.</p><p>JER begins with a focused assessment of the affected area and the surrounding roof. The goal is to define what is damaged, what remains serviceable, and whether a repair is a responsible solution.</p></div></div>
        <div class="signal-grid">
            <?php foreach ($repairSignals as [$number, $title, $copy]): ?><article class="signal-card"><span><?= e($number) ?></span><h3><?= e($title) ?></h3><p><?= e($copy) ?></p></article><?php endforeach; ?>
        </div>
        <p class="guide-note">Do not climb onto a wet, damaged, or unfamiliar roof. Share what you can observe safely from the ground or inside the property and let the assessment begin from there.</p>
    </section>

    <section class="replacement-scope repair-scope" aria-labelledby="repair-assessment-title">
        <div class="shell scope-grid"><div class="scope-image repair-scope-image" role="img" aria-label="Shingle roof with chimney flashing and ventilation details on an El Paso home"></div><div class="scope-content"><p class="section-kicker light">A focused assessment</p><h2 id="repair-assessment-title">Every repair begins with a chain of evidence.</h2><p>Visible damage matters, but the connected roof details often determine the appropriate repair scope.</p><dl><div><dt>Interior evidence</dt><dd>Staining, moisture location, timing, and the conditions present when the issue appears.</dd></div><div><dt>Exterior condition</dt><dd>Roofing material, flashing, penetrations, edges, transitions, drainage, and nearby wear.</dd></div><div><dt>Repair history</dt><dd>Prior patches, previous leaks, changed materials, and recurring concerns in the same area.</dd></div><div><dt>Surrounding system</dt><dd>Whether adjacent roofing remains serviceable enough for a focused repair to make sense.</dd></div></dl></div></div>
    </section>

    <section class="system-options repair-options shell" aria-labelledby="repair-types-title">
        <div class="systems-heading"><div><p class="section-kicker">Roof repair services</p><h2 id="repair-types-title">A scope shaped by the condition found.</h2></div><p>El Paso roofs encounter strong sun, wind, dust, and seasonal storms. The repair should respond to the actual failure point and the roof system around it—not a generic patch.</p></div>
        <div class="system-grid"><?php foreach ($repairTypes as $index => [$title, $copy]): ?><article class="system-card"><span>0<?= $index + 1 ?></span><h3><?= e($title) ?></h3><p><?= e($copy) ?></p><a href="#repair-request">Request an assessment <i aria-hidden="true">↗</i></a></article><?php endforeach; ?></div>
    </section>

    <section class="replacement-process repair-process" id="repair-process" aria-labelledby="repair-process-title">
        <div class="shell process-heading"><p class="section-kicker light">The repair path</p><h2 id="repair-process-title">From first concern to a clearly reviewed repair.</h2><p>A disciplined process keeps the recommendation connected to the condition that was actually found.</p></div>
        <ol class="shell replacement-steps">
            <li><span>01</span><div><small>Listen</small><h3>Understand what you noticed</h3><p>Review when the concern appeared, where it is visible, recent weather, and any earlier work in the area.</p></div></li>
            <li><span>02</span><div><small>Assess</small><h3>Locate the likely source</h3><p>Inspect the affected area and connected roofing details to understand how the problem may be developing.</p></div></li>
            <li><span>03</span><div><small>Define</small><h3>Set the repair scope</h3><p>Explain what should be addressed, what can remain, and any condition that changes the recommended path.</p></div></li>
            <li><span>04</span><div><small>Repair</small><h3>Complete the specified work</h3><p>Protect the property and execute the defined repair with attention to the surrounding roof assembly.</p></div></li>
            <li><span>05</span><div><small>Review</small><h3>Close out the repair clearly</h3><p>Review the completed work and communicate any maintenance or longer-term consideration identified during the project.</p></div></li>
        </ol>
    </section>

    <section class="decision-panel shell" aria-labelledby="repair-decision-title"><div><p class="section-kicker">Repair or replacement</p><h2 id="repair-decision-title">The right answer depends on the roof around the damage.</h2></div><div><p>A focused repair can be the responsible choice when the issue is limited and the surrounding system remains serviceable. If deterioration is widespread or problems keep returning, compare the repair scope with a complete <a class="inline-service-link" href="../roof-replacement/">roof replacement in El Paso</a>.</p><a class="button button-primary" href="#repair-request">Discuss the concern <span aria-hidden="true">↗</span></a></div></section>

    <section class="faq shell" id="repair-faq"><div class="faq-heading"><p class="section-kicker">El Paso roof repair FAQ</p><h2>Useful answers before the repair begins.</h2></div><div class="faq-list"><?php foreach ($faqs as $index => [$question, $answer]): ?><details><summary><span>0<?= $index + 1 ?></span><?= e($question) ?><i>+</i></summary><p><?= e($answer) ?></p></details><?php endforeach; ?></div></section>

    <section class="consultation" id="repair-request">
        <div class="shell consultation-grid"><div class="consult-copy"><p class="section-kicker light">Request roof repair</p><h2>Tell us what changed.</h2><p>Share what you can see, where it appears, and whether recent El Paso weather may be connected. JER will use that information to prepare for the assessment.</p><a href="mailto:info@jer-elite.com">info@jer-elite.com <span aria-hidden="true">↗</span></a></div>
            <form class="lead-form" method="post" action="#repair-request">
                <?php if ($formMessage !== ''): ?><p class="form-status<?= $formError ? ' error' : '' ?>" role="status"><?= e($formMessage) ?></p><?php endif; ?>
                <label class="website-field" aria-hidden="true">Website<input name="website" tabindex="-1" autocomplete="off"></label>
                <div class="field-row"><label><span>Name</span><input name="name" autocomplete="name" required maxlength="100" placeholder="Your name" value="<?= e((string) ($_POST['name'] ?? '')) ?>"></label><label><span>Email</span><input name="email" type="email" autocomplete="email" required maxlength="160" placeholder="you@email.com" value="<?= e((string) ($_POST['email'] ?? '')) ?>"></label></div>
                <div class="field-row"><label><span>Phone <small>Optional</small></span><input name="phone" type="tel" autocomplete="tel" maxlength="40" placeholder="(000) 000–0000" value="<?= e((string) ($_POST['phone'] ?? '')) ?>"></label><label><span>Property type</span><select name="property_type" required><option value="" disabled <?= empty($_POST['property_type']) ? 'selected' : '' ?>>Select one</option><?php foreach (['Single-family home', 'Multifamily property', 'Commercial property', 'Other'] as $option): ?><option <?= (($_POST['property_type'] ?? '') === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></label></div>
                <label><span>Primary concern</span><select name="concern" required><option value="" disabled <?= empty($_POST['concern']) ? 'selected' : '' ?>>Select one</option><?php foreach (['Active leak or interior staining', 'Missing or damaged roofing', 'Flashing or penetration concern', 'Recent wind, hail, or debris', 'Recurring issue', 'Not sure yet'] as $option): ?><option <?= (($_POST['concern'] ?? '') === $option) ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select></label>
                <label><span>Tell us what you are seeing <small>Optional</small></span><textarea name="details" rows="4" maxlength="2000" placeholder="Where is the concern, when did it begin, and was there recent weather or prior repair work?"><?= e((string) ($_POST['details'] ?? '')) ?></textarea></label>
                <div class="form-action"><p>Your information is used only to respond to this request.</p><button class="button button-primary" type="submit">Request repair assessment <span aria-hidden="true">↗</span></button></div>
            </form>
        </div>
    </section>

    <footer><div class="shell footer-top"><a class="brand footer-brand" href="../" aria-label="JER General Contractor home"><span class="brand-lockup brand-lockup-full"><img src="../assets/jer-logo.webp" alt="JER General Contractor"></span></a><p>Residential &amp; commercial roofing<br>in El Paso, Texas.</p><nav aria-label="Footer navigation"><a href="../">Home</a><a href="../roof-replacement/">Roof replacement</a><a href="./">Roof repair</a><a href="#repair-request">Contact</a></nav></div><div class="shell footer-bottom"><p>© <?= date('Y') ?> JER General Contractor</p><p>Roof repair in El Paso, TX</p><a href="#top">Back to top ↑</a></div></footer>
    <a class="mobile-cta" href="#repair-request">Request roof repair <span aria-hidden="true">↗</span></a>
</main>
</body>
</html>
