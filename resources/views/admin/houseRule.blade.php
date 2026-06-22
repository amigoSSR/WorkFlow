@include('admin.topbarAdmin')
<!-- Main Content Canvas -->
<main class="pt-16 min-h-screen">
<!-- Content Header -->
<section class="bg-white border-b border-outline-variant px-container-padding py-12">
<div class="max-w-4xl mx-auto flex flex-col md:flex-row md:items-end justify-between gap-6">
<div class="space-y-4">
<nav class="flex items-center gap-2 text-on-surface-variant text-xs font-medium">
<a class="hover:text-primary" href="#">Settings</a>
<span class="material-symbols-outlined text-[12px]">chevron_right</span>
<a class="hover:text-primary" href="#">Compliance</a>
<span class="material-symbols-outlined text-[12px]">chevron_right</span>
<span class="text-primary">House Rules</span>
</nav>
<h2 class="font-headline-xl text-headline-xl text-on-surface">House Rules</h2>
<p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl">
                        Internal office regulations and professional conduct policies for all CollabOps employees. These rules ensure a productive, safe, and respectful work environment.
                    </p>
</div>
<div class="flex gap-3">
<button class="px-6 py-2.5 bg-white border border-outline text-on-surface font-semibold rounded-lg hover:bg-surface-container-low transition-all flex items-center gap-2 active:scale-95">
<span class="material-symbols-outlined text-lg">download</span>
                        Export PDF
                    </button>
<button class="px-6 py-2.5 bg-primary text-white font-semibold rounded-lg hover:brightness-110 transition-all shadow-sm flex items-center gap-2 active:scale-95">
<span class="material-symbols-outlined text-lg">edit</span>
                        Edit Rules
                    </button>
</div>
</div>
</section>
<!-- Document Content -->
<div class="px-container-padding py-12">
<div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-4">
<!-- Table of Contents Sticky -->
<aside class="md:col-span-2 hidden md:block" role="navigation" aria-label="Table of contents">
<div class="sticky top-28 space-y-6">
<p class="text-xs font-bold uppercase tracking-widest text-outline">Contents</p>
<ul class="space-y-4" id="toc-list">
<li><a class="toc-link text-sm font-medium text-on-surface-variant hover:text-primary flex items-center gap-2" href="#jam-kerja" data-target="jam-kerja"><span class="w-1 h-1 bg-primary rounded-full"></span> Jam Kerja</a></li>
<li><a class="toc-link text-sm font-medium text-on-surface-variant hover:text-primary" href="#kode-etik" data-target="kode-etik">Kode Etik</a></li>
<li><a class="toc-link text-sm font-medium text-on-surface-variant hover:text-primary" href="#fasilitas" data-target="fasilitas">Fasilitas Kantor</a></li>
<li><a class="toc-link text-sm font-medium text-on-surface-variant hover:text-primary" href="#cuti" data-target="cuti">Cuti &amp; Izin</a></li>
<li><a class="toc-link text-sm font-medium text-on-surface-variant hover:text-primary" href="#keamanan" data-target="keamanan">Keamanan &amp; IT</a></li>
</ul>
<div class="p-4 bg-primary-container/10 rounded-xl border border-primary/20 mt-8">
<p class="text-xs font-bold text-on-primary-fixed mb-2">Last Updated</p>
<p class="text-sm text-on-primary-fixed-variant">Oct 24, 2023</p>
<p class="text-[10px] text-outline mt-2 italic">Approved by HR Director</p>
</div>
</div>
</aside>
<!-- Policy Sections -->
<!-- Mobile TOC selector -->
<div class="md:hidden mb-6 px-2">
    <label for="mobile-toc" class="sr-only">Pilih bagian</label>
    <select id="mobile-toc" class="w-full p-3 rounded-lg border border-outline-variant bg-white">
        <option value="jam-kerja">Jam Kerja</option>
        <option value="kode-etik">Kode Etik</option>
        <option value="fasilitas">Fasilitas Kantor</option>
        <option value="cuti">Cuti & Izin</option>
        <option value="keamanan">Keamanan & IT</option>
    </select>
    </div>

<article class="md:col-span-10 space-y-16 pb-24">
<!-- Section: Jam Kerja -->
<section class="section-anchor" id="jam-kerja">
<div class="flex items-center gap-4 mb-6">
<div class="w-12 h-12 rounded-2xl bg-surface-container-high flex items-center justify-center text-primary">
<span class="material-symbols-outlined" style="font-variation-settings: 'opsz' 40;">schedule</span>
</div>
<h3 class="font-headline-lg text-headline-lg text-on-surface">Jam Kerja &amp; Kehadiran</h3>
</div>
<div class="bg-white rounded-2xl p-8 shadow-sm border border-outline-variant/30 space-y-6">
<div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pb-6 border-b border-outline-variant/30">
<div>
<h4 class="text-xs font-bold text-outline uppercase mb-2">Waktu Operasional</h4>
<p class="text-body-md text-on-surface">Senin - Jumat: 09:00 - 18:00</p>
<p class="text-body-md text-on-surface">Istirahat: 12:00 - 13:00</p>
</div>
<div>
<h4 class="text-xs font-bold text-outline uppercase mb-2">Toleransi</h4>
<p class="text-body-md text-on-surface">Keterlambatan maksimal 15 menit. Lebih dari 15 menit wajib melampirkan alasan ke sistem HR.</p>
</div>
</div>
<div class="space-y-4">
<div class="flex gap-4">
<div class="mt-1"><span class="material-symbols-outlined text-primary text-lg">check_circle</span></div>
<div>
<h5 class="font-semibold text-on-surface">Presensi Digital</h5>
<p class="text-body-md text-on-surface-variant">Setiap karyawan wajib melakukan check-in melalui aplikasi CollabOps sebelum memulai aktivitas kerja.</p>
</div>
</div>
<div class="flex gap-4">
<div class="mt-1"><span class="material-symbols-outlined text-primary text-lg">check_circle</span></div>
<div>
<h5 class="font-semibold text-on-surface">Lembur (Overtime)</h5>
<p class="text-body-md text-on-surface-variant">Lembur harus mendapatkan persetujuan tertulis dari Manager maksimal jam 16:00 pada hari tersebut.</p>
</div>
</div>
</div>
</div>
</section>
<!-- Section: Kode Etik -->
<section class="section-anchor" id="kode-etik">
<div class="flex items-center gap-4 mb-6">
<div class="w-12 h-12 rounded-2xl bg-tertiary-fixed flex items-center justify-center text-tertiary">
<span class="material-symbols-outlined" style="font-variation-settings: 'opsz' 40;">gavel</span>
</div>
<h3 class="font-headline-lg text-headline-lg text-on-surface">Kode Etik &amp; Profesionalisme</h3>
</div>
<div class="bg-white rounded-2xl p-8 shadow-sm border border-outline-variant/30">
<div class="space-y-8">
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">
<div class="space-y-4">
<img class="w-full h-40 object-cover rounded-xl mb-4" data-alt="A minimalist and high-quality conceptual image representing professional integrity and collaboration. Abstract geometric glass shapes interlinking under clean studio lighting with a color palette of deep navy and soft teal. Professional corporate vibe." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCFcszqKQyL-amPuO8HOi1KSCgfPl2Gp7nlBIhu3D0nojpgAyHbNqo-FxB7ikNuSdW7HuQNgg9Vvm-Bg3YE-NaljH2oG3CcwtlVng_wjfhQSo7ujth-vVLvNPJ-wk0HAx1MGFVLnDJ_bXlYtReMyuNgapDq57HsfRz8MgNalo2YjXk3aYWQGoridDUfCIbmOiz5rInVkspDnpdaiUqwqlNwh4USPNRYECVS6S00nnhak0thrt-vjsbSBI7EDg3mdTVYHnUgCngTipM"/>
<h5 class="font-bold text-on-surface flex items-center gap-2">
<span class="material-symbols-outlined text-primary">diversity_3</span>
                                            Lingkungan Kerja Inklusif
                                        </h5>
<p class="text-body-md text-on-surface-variant">CollabOps melarang segala bentuk diskriminasi, pelecehan, dan perundungan. Kami menjunjung tinggi keberagaman dan rasa hormat antar rekan kerja.</p>
</div>
<div class="space-y-4">
<img class="w-full h-40 object-cover rounded-xl mb-4" data-alt="A minimalist overhead shot of professional office attire accessories, a notebook, and a sleek modern pen arranged on a white marble surface. Clean, organized, professional aesthetic with ample white space. Soft teal accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB0ghTyYRKhDz3SLItCpl9wCAQVjtiTAHwV1lqeEmACj1xnmfuYBY7todzZ2Iwlk9pXohdLoJd9Ww1ugmg5esjobmdZ3fa8WBfA0aQE92rFQdcCvYVM9DTpL9VJWx-sNVPXNaSZWtdlo2ooR-lWSK23GsuLzh_amIHVsGJM6ekiMk51KIxK7OKDfy_F2uTJ7vQdYf7ob3A6uD9Hj9RqbzEUUeFU0r1ULQItBoulGkGhnmewpHym6q1uGxwozaWCUanQaK7cTC7T5n8"/>
<h5 class="font-bold text-on-surface flex items-center gap-2">
<span class="material-symbols-outlined text-primary">apparel</span>
                                            Etika Berpakaian
                                        </h5>
<p class="text-body-md text-on-surface-variant">Karyawan diharapkan mengenakan pakaian Business Casual. Untuk hari Jumat diperbolehkan mengenakan Batik atau pakaian rapi bebas.</p>
</div>
</div>
<div class="p-4 bg-error-container/20 rounded-xl border border-error/20">
<div class="flex gap-3">
<span class="material-symbols-outlined text-error">report</span>
<div>
<p class="text-sm font-bold text-error">Pelanggaran Berat</p>
<p class="text-xs text-on-error-container mt-1">Pembocoran data rahasia perusahaan kepada pihak ketiga tanpa izin akan mengakibatkan pemutusan hubungan kerja (PHK) seketika.</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Section: Fasilitas Kantor -->
<section class="section-anchor" id="fasilitas">
<div class="flex items-center gap-4 mb-6">
<div class="w-12 h-12 rounded-2xl bg-secondary-fixed flex items-center justify-center text-secondary">
<span class="material-symbols-outlined" style="font-variation-settings: 'opsz' 40;">domain</span>
</div>
<h3 class="font-headline-lg text-headline-lg text-on-surface">Fasilitas Kantor</h3>
</div>
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
<div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/30 hover:border-primary transition-all group">
<span class="material-symbols-outlined text-3xl text-outline group-hover:text-primary transition-colors mb-4">meeting_room</span>
<h5 class="font-bold text-on-surface mb-2">Ruang Meeting</h5>
<p class="text-xs text-on-surface-variant leading-relaxed">Pemesanan wajib dilakukan melalui sistem minimal 2 jam sebelum penggunaan.</p>
</div>
<div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/30 hover:border-primary transition-all group">
<span class="material-symbols-outlined text-3xl text-outline group-hover:text-primary transition-colors mb-4">coffee</span>
<h5 class="font-bold text-on-surface mb-2">Pantry &amp; Snack</h5>
<p class="text-xs text-on-surface-variant leading-relaxed">Fasilitas pantry gratis untuk seluruh karyawan. Harap menjaga kebersihan area setelah makan.</p>
</div>
<div class="bg-white p-6 rounded-2xl shadow-sm border border-outline-variant/30 hover:border-primary transition-all group">
<span class="material-symbols-outlined text-3xl text-outline group-hover:text-primary transition-colors mb-4">print</span>
<h5 class="font-bold text-on-surface mb-2">Alat Tulis &amp; IT</h5>
<p class="text-xs text-on-surface-variant leading-relaxed">Pengambilan alat tulis dapat dilakukan di meja resepsionis dengan mencatat inventaris.</p>
</div>
</div>
</section>
<!-- Feedback Callout -->
<div class="bg-inverse-surface rounded-2xl p-8 text-white flex flex-col md:flex-row items-center justify-between gap-6 overflow-hidden relative">
<div class="absolute -right-10 -bottom-10 opacity-10">
<span class="material-symbols-outlined text-[160px]">edit_note</span>
</div>
<div class="relative z-10 space-y-2">
<h4 class="font-headline-md text-headline-md">Ada Pertanyaan Mengenai Aturan?</h4>
<p class="text-surface-variant font-body-md">Hubungi Departemen People &amp; Culture jika Anda memerlukan klarifikasi lebih lanjut.</p>
</div>
<button class="relative z-10 px-8 py-3 bg-primary-fixed text-on-primary-fixed font-bold rounded-lg hover:brightness-110 transition-all active:scale-95">
                            Hubungi HRD
                        </button>
</div>
</article>
</div>
</div>
</main>
<!-- Floating Action Button - Mobile Only context -->
<button class="md:hidden fixed bottom-6 right-6 w-14 h-14 bg-primary text-white rounded-full shadow-lg flex items-center justify-center active:scale-90 transition-all z-50" aria-label="Edit rules">
<span class="material-symbols-outlined">edit</span>
</button>
<script>
    // Enhanced TOC and smooth-scroll + active highlight
    (function(){
        const tocLinks = document.querySelectorAll('.toc-link');
        const sections = document.querySelectorAll('.section-anchor');

        // Smooth scroll for all anchor links that point to sections
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Mobile TOC selector
        const mobileToc = document.getElementById('mobile-toc');
        if (mobileToc) {
            mobileToc.addEventListener('change', (e) => {
                const id = e.target.value;
                const el = document.getElementById(id);
                if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        }

        // IntersectionObserver to highlight current section in TOC
        if ('IntersectionObserver' in window && tocLinks.length && sections.length) {
            const options = { root: null, rootMargin: '0px 0px -60% 0px', threshold: 0 };
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const id = entry.target.id;
                    const link = document.querySelector('.toc-link[data-target="'+id+'"]');
                    if (entry.isIntersecting) {
                        tocLinks.forEach(l => l.classList.remove('text-primary','font-bold'));
                        if (link) link.classList.add('text-primary','font-bold');
                    }
                });
            }, options);
            sections.forEach(s => observer.observe(s));
        }

        // Top nav scroll effect (if header exists)
        const header = document.querySelector('header');
        if (header) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) header.classList.add('shadow-sm'); else header.classList.remove('shadow-sm');
            });
        }
    })();
</script>
</body></html>