<script setup>

const year = new Date().getFullYear()

// If you keep images under resources, you can import instead, e.g.:
// import ogCover from '@/../images/og-cover.png'
// Then use :content="ogCover" in the <Head> meta tag.
</script>

<template>
  <!-- SEO / OpenGraph -->
  <Head title="Job Hunt CRM — Track, follow up, get hired">
    <meta name="description" content="A simple pipeline + daily metrics for job seekers. Track applications, schedule follow‑ups, and learn what works.">
    <meta property="og:title" content="Job Hunt CRM — Track, follow up, get hired">
    <meta property="og:description" content="A simple pipeline + daily metrics for job seekers. Track applications, schedule follow‑ups, and learn what works.">
    <meta property="og:type" content="website">
    <meta property="og:image" content="/images/og-cover.png">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="icon" href="/images/favicon.svg" type="image/svg+xml">
  </Head>

  <div class="bg-white text-gray-900">
    <div class="w-full bg-yellow-100 border-b border-yellow-300 text-yellow-900 text-center py-3 px-4 text-sm font-medium">
      🚧 <span class="font-semibold">Job Hunt CRM is under development</span> — Launching later this year! Stay tuned for updates.
    </div>
    <!-- Header -->
    <header class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
      <a href="#" class="flex items-center gap-3">
        <!-- Inline SVG logo -->
        <svg class="w-9 h-9" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <rect x="4" y="6" width="40" height="32" rx="6" class="fill-indigo-600" />
          <path d="M12 16h16M12 22h24M12 28h14" stroke="white" stroke-width="3" stroke-linecap="round" />
        </svg>
        <span class="text-xl font-extrabold tracking-tight">Job Hunt CRM</span>
      </a>
      <nav class="hidden md:flex items-center gap-8 text-sm">
        <a href="#features" class="hover:underline">Features</a>
        <a href="#metrics" class="hover:underline">Metrics</a>
        <a href="#pricing" class="hover:underline">Pricing</a>
        <a href="#faq" class="hover:underline">FAQ</a>
      </nav>
      <div class="flex items-center gap-3">
        <Link href="/admin" class="px-4 py-2 rounded-xl border focus-ring">Sign in</Link>
        <Link href="/admin" class="px-4 py-2 rounded-xl bg-indigo-600 text-white font-semibold focus-ring">Start Free</Link>
      </div>
    </header>

    <!-- Hero -->
    <section class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">
      <div>
        <h1 class="text-4xl md:text-5xl font-black leading-tight">
          Track your applications, follow up on time, and learn what works.
        </h1>
        <p class="mt-5 text-lg text-gray-600">
          Stay consistent with a pipeline built for job seekers. Daily KPIs, automatic follow‑ups, and simple analytics that actually help you ship more applications.
        </p>
        <div class="mt-8 flex flex-wrap gap-4">
          <Link href="/admin" class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold focus-ring">Create my account</Link>
          <a href="#features" class="px-6 py-3 rounded-xl border focus-ring">See how it works</a>
        </div>
        <div class="mt-6 flex items-center gap-4 text-sm text-gray-600">
          <div class="flex -space-x-2">
            <img src="https://placehold.co/40x40?text=Coming Soon" class="inline-block w-8 h-8 rounded-full ring-2 ring-white" alt="User avatar 1" />
            <img src="https://placehold.co/40x40?text=Coming Soon" class="inline-block w-8 h-8 rounded-full ring-2 ring-white" alt="User avatar 2" />
            <img src="https://placehold.co/40x40?text=Coming Soon" class="inline-block w-8 h-8 rounded-full ring-2 ring-white" alt="User avatar 3" />
          </div>
          <span>Trusted by focused job seekers worldwide</span>
        </div>
      </div>

      <div class="relative">
        <div class="absolute -inset-4 bg-gradient-to-tr from-indigo-100 to-white rounded-3xl blur"></div>
        <div class="relative bg-white border rounded-3xl p-4 shadow-xl">
          <img src="https://placehold.co/600x400?text=Coming Soon" alt="Dashboard preview" class="rounded-2xl border" />
          <p class="text-xs text-gray-500 mt-3">Preview of the daily dashboard with KPIs and follow‑ups.</p>
        </div>
      </div>
    </section>

    <!-- Social Proof -->
    <section aria-label="Social proof" class="border-y bg-gray-50">
      <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-3 gap-6 text-center">
        <div>
          <div class="text-3xl font-extrabold">+23%</div>
          <div class="text-sm text-gray-600">higher reply rate in 14 days*</div>
        </div>
        <div>
          <div class="text-3xl font-extrabold">5–10</div>
          <div class="text-sm text-gray-600">minutes saved per application</div>
        </div>
        <div>
          <div class="text-3xl font-extrabold">Zero</div>
          <div class="text-sm text-gray-600">missed follow‑ups (seriously)</div>
        </div>
      </div>
    </section>

    <!-- Features -->
    <section id="features" class="max-w-7xl mx-auto px-6 py-16">
      <div class="grid md:grid-cols-3 gap-6">
        <div class="p-6 bg-white rounded-2xl border">
          <div class="text-indigo-600 font-semibold">Pipeline</div>
          <h3 class="mt-1 text-lg font-bold">From prospect to offer</h3>
          <p class="mt-2 text-sm text-gray-600">
            Kanban‑style stages: Prospect → Applied → Replied → Interview → Offer → Accepted/Rejected.
          </p>
          <img src="https://placehold.co/600x400?text=Coming Soon" alt="Pipeline screenshot" class="mt-4 rounded-xl border" />
        </div>
        <div class="p-6 bg-white rounded-2xl border">
          <div class="text-indigo-600 font-semibold">Follow‑ups</div>
          <h3 class="mt-1 text-lg font-bold">Never forget to nudge</h3>
          <p class="mt-2 text-sm text-gray-600">
            Auto‑create follow‑up tasks after X days with friendly reminders. Reschedule in one click.
          </p>
          <img src="https://placehold.co/600x400?text=Coming Soon" alt="Follow‑ups screenshot" class="mt-4 rounded-xl border" />
        </div>
        <div class="p-6 bg-white rounded-2xl border">
          <div class="text-indigo-600 font-semibold">Notes & emails</div>
          <h3 class="mt-1 text-lg font-bold">Keep context in one place</h3>
          <p class="mt-2 text-sm text-gray-600">
            Log emails, calls, and notes right on the application. See the full timeline at a glance.
          </p>
          <img src="https://placehold.co/600x400?text=Coming Soon" alt="Timeline screenshot" class="mt-4 rounded-xl border" />
        </div>
      </div>
    </section>

    <!-- Metrics / How it helps -->
    <section id="metrics" class="bg-gray-50">
      <div class="max-w-7xl mx-auto px-6 py-16 grid lg:grid-cols-2 gap-10 items-center">
        <div>
          <h2 class="text-2xl font-bold">Your daily operating system</h2>
          <p class="mt-3 text-gray-600">
            See today’s KPIs at a glance, then knock out your top five follow‑ups. Track success rate, time‑to‑reply, and which sources work best.
          </p>
          <ul class="mt-6 space-y-3 text-sm text-gray-700">
            <li class="flex gap-3"><span class="mt-1">✅</span> Applied today, Replies today, Interviews today</li>
            <li class="flex gap-3"><span class="mt-1">✅</span> Success rate by week and by source</li>
            <li class="flex gap-3"><span class="mt-1">✅</span> Calendar with interviews & take‑home deadlines</li>
          </ul>
          <div class="mt-8 flex gap-4">
            <Link href="/admin" class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold focus-ring">Start Free</Link>
            <a href="#pricing" class="px-6 py-3 rounded-xl border focus-ring">View Pricing</a>
          </div>
        </div>
        <div class="bg-white border rounded-2xl p-4 shadow-sm">
          <img src="https://placehold.co/600x400?text=Coming Soon" alt="Metrics screenshot" class="rounded-xl border" />
        </div>
      </div>
    </section>

    <!-- How it works (3 steps) -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <h2 class="text-2xl font-bold">How it works</h2>
      <div class="mt-8 grid md:grid-cols-3 gap-6">
        <div class="p-6 border rounded-2xl">
          <div class="text-sm text-gray-500">Step 1</div>
          <h3 class="mt-1 font-semibold">Add applications fast</h3>
          <p class="mt-2 text-sm text-gray-600">Paste a job URL or type Company + Role. Optional: salary, tags, and notes.</p>
        </div>
        <div class="p-6 border rounded-2xl">
          <div class="text-sm text-gray-500">Step 2</div>
          <h3 class="mt-1 font-semibold">Work your follow‑ups</h3>
          <p class="mt-2 text-sm text-gray-600">We create tasks if there’s no reply after X days. Snooze or complete in one click.</p>
        </div>
        <div class="p-6 border rounded-2xl">
          <div class="text-sm text-gray-500">Step 3</div>
          <h3 class="mt-1 font-semibold">Learn what works</h3>
          <p class="mt-2 text-sm text-gray-600">See sources and templates with the best reply and offer rates.</p>
        </div>
      </div>
    </section>

    <!-- Testimonials -->
    <section class="bg-gray-50">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-2xl font-bold">What our users say</h2>
        <div class="mt-8 grid md:grid-cols-3 gap-6">
          <figure class="p-6 bg-white border rounded-2xl">
            <blockquote class="text-sm text-gray-700">“I stopped guessing and started following a system. Two offers in three weeks.”</blockquote>
            <figcaption class="mt-4 flex items-center gap-3 text-sm text-gray-600">
              <img src="/images/avatars/a4.png" class="w-8 h-8 rounded-full" alt="Avatar Mark" />
              <div><b>Mark</b> · Frontend Dev</div>
            </figcaption>
          </figure>
          <figure class="p-6 bg-white border rounded-2xl">
            <blockquote class="text-sm text-gray-700">“The daily KPIs kept me honest. It’s like a gym tracker, but for my job hunt.”</blockquote>
            <figcaption class="mt-4 flex items-center gap-3 text-sm text-gray-600">
              <img src="/images/avatars/a5.png" class="w-8 h-8 rounded-full" alt="Avatar Jessa" />
              <div><b>Jessa</b> · QA Engineer</div>
            </figcaption>
          </figure>
          <figure class="p-6 bg-white border rounded-2xl">
            <blockquote class="text-sm text-gray-700">“Follow‑ups used to slip. Not anymore. I just do the top 5 and move on.”</blockquote>
            <figcaption class="mt-4 flex items-center gap-3 text-sm text-gray-600">
              <img src="/images/avatars/a6.png" class="w-8 h-8 rounded-full" alt="Avatar Ian" />
              <div><b>Ian</b> · Backend Dev</div>
            </figcaption>
          </figure>
        </div>
      </div>
    </section>

    <!-- Pricing -->
    <section id="pricing" class="max-w-7xl mx-auto px-6 py-16">
      <h2 class="text-2xl font-bold">Pricing</h2>
      <div class="mt-8 grid md:grid-cols-2 gap-6">
        <div class="p-6 border rounded-2xl">
          <h3 class="font-semibold">Free</h3>
          <p class="mt-2 text-sm text-gray-600">100 applications, basic metrics, CSV export</p>
          <div class="mt-4 text-3xl font-extrabold">₱0</div>
          <ul class="mt-4 space-y-2 text-sm text-gray-700">
            <li>• Pipeline + tasks</li>
            <li>• Daily KPIs</li>
            <li>• CSV export</li>
          </ul>
          <Link href="/admin" class="mt-6 inline-block px-5 py-3 rounded-xl border focus-ring">Start Free</Link>
        </div>
        <div class="p-6 border rounded-2xl relative overflow-hidden">
          <span class="absolute right-4 top-4 text-xs bg-indigo-600 text-white px-2 py-1 rounded-full">Most popular</span>
          <h3 class="font-semibold">Pro</h3>
          <p class="mt-2 text-sm text-gray-600">Unlimited apps, follow‑up engine, calendar</p>
          <div class="mt-4 text-2xl font-extrabold">Contact for pricing</div>
          <ul class="mt-4 space-y-2 text-sm text-gray-700">
            <li>• Everything in Free</li>
            <li>• Automatic follow‑ups</li>
            <li>• Calendar & interview kit</li>
            <li>• Priority support</li>
          </ul>
          <a href="mailto:your-email@example.com?subject=Pro Plan Inquiry" class="mt-6 inline-block px-5 py-3 rounded-xl bg-indigo-600 text-white font-semibold focus-ring">Contact Me</a>
        </div>
      </div>
      <p class="mt-3 text-xs text-gray-500">*Impact estimates based on early user cohort; your mileage may vary.</p>
    </section>

    <!-- FAQ -->
    <section id="faq" class="bg-gray-50">
      <div class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-2xl font-bold">Frequently asked questions</h2>
        <div class="mt-8 grid md:grid-cols-2 gap-6">
          <details class="p-5 bg-white border rounded-2xl" open>
            <summary class="font-semibold cursor-pointer">Do I need Gmail or Outlook integration?</summary>
            <p class="mt-2 text-sm text-gray-600">No. You can log replies manually. Email sync is optional and coming later.</p>
          </details>
          <details class="p-5 bg-white border rounded-2xl">
            <summary class="font-semibold cursor-pointer">Can I export my data?</summary>
            <p class="mt-2 text-sm text-gray-600">Yes, CSV/JSON export is available. Your data is yours.</p>
          </details>
          <details class="p-5 bg-white border rounded-2xl">
            <summary class="font-semibold cursor-pointer">Is there a mobile app?</summary>
            <p class="mt-2 text-sm text-gray-600">A PWA is in the works. The web app is mobile‑friendly today.</p>
          </details>
          <details class="p-5 bg-white border rounded-2xl">
            <summary class="font-semibold cursor-pointer">Can I import existing applications?</summary>
            <p class="mt-2 text-sm text-gray-600">Yes, you can paste or upload a CSV and map fields.</p>
          </details>
        </div>
      </div>
    </section>

    <!-- Final CTA -->
    <section class="max-w-7xl mx-auto px-6 py-16">
      <div class="p-8 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-3xl grid md:grid-cols-2 gap-6 items-center">
        <div>
          <h2 class="text-2xl md:text-3xl font-black">Make your job hunt a system, not a sprint.</h2>
          <p class="mt-2 text-indigo-100">Join free and start tracking applications in minutes.</p>
        </div>
        <div class="md:text-right">
          <Link href="/admin" class="inline-block px-6 py-3 rounded-xl bg-white text-indigo-700 font-semibold focus-ring">Start Free</Link>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="max-w-7xl mx-auto px-6 py-10 text-sm text-gray-500">
      <div class="flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
          <svg class="w-6 h-6" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <rect x="4" y="6" width="40" height="32" rx="6" class="fill-indigo-600" />
            <path d="M12 16h16M12 22h24M12 28h14" stroke="white" stroke-width="3" stroke-linecap="round" />
          </svg>
          <span>© {{ year }} Job Hunt CRM</span>
        </div>
        <nav class="flex gap-6">
          <a href="#" class="hover:underline">Privacy</a>
          <a href="#" class="hover:underline">Terms</a>
          <a href="mailto:hello@kennethsolomon.com" class="hover:underline">Contact</a>
        </nav>
      </div>
    </footer>
  </div>
</template>

<style>
/* focus ring from your Blade */
.focus-ring { outline: 2px solid transparent; outline-offset: 2px; }
.focus-ring:focus { outline-color: rgb(99 102 241); box-shadow: 0 0 0 4px rgb(99 102 241 / 0.25); }
</style>