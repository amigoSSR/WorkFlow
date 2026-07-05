@include('user.topbaruser')
<style>
        body { font-family: 'Inter', sans-serif; background-color: #F8FAFC; color: #0b1c30; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .sidebar-active { border-left: 4px solid #006565; background: rgba(0, 128, 128, 0.1); color: #93f2f2; font-weight: 600; }
        .glass-header { backdrop-filter: blur(8px); background: rgba(248, 249, 255, 0.8); }
        .section-anchor:target { scroll-margin-top: 100px; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #bdc9c8; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #6e7979; }
</style>
<!-- Main Content Canvas -->
<div class="relative">
    <!-- Content Header -->
    <section class="bg-white border-b border-outline-variant px-container-padding py-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-headline-lg text-headline-lg text-on-surface font-bold">House Rules</h2>
        </div>
    </section>

    <!-- Document Content -->
    <div class="px-container-padding py-12">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row gap-6 md:gap-12">
            
            <!-- Table of Contents Sticky -->
            <aside class="w-full md:w-48 flex-shrink-0 hidden md:block" role="navigation" aria-label="Table of contents">
                <div class="sticky top-28 space-y-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-outline">Contents</p>
                    <ul class="space-y-4" id="toc-list">
                        @foreach($houseRules as $rule)
                            <li>
                                <a class="toc-link text-sm font-medium text-on-surface-variant hover:text-primary flex items-center gap-2" href="#rule-{{ $rule->id }}" data-target="rule-{{ $rule->id }}">
                                    {{ $rule->judul_rule }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Policy Sections -->
            <div class="md:hidden mb-6 px-2">
                <label for="mobile-toc" class="sr-only">Pilih bagian</label>
                <select id="mobile-toc" class="w-full p-3 rounded-lg border border-outline-variant bg-white" onchange="window.location.hash = this.value">
                    @foreach($houseRules as $rule)
                        <option value="rule-{{ $rule->id }}">{{ $rule->judul_rule }}</option>
                    @endforeach
                </select>
            </div>

            <article class="flex-1 min-w-0 space-y-16 pb-24">
                @forelse($houseRules as $rule)
                <section class="section-anchor relative group" id="rule-{{ $rule->id }}">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-surface-container-high flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'opsz' 40;">gavel</span>
                        </div>
                        <div>
                            <h3 class="font-headline-lg text-headline-lg text-on-surface">{{ $rule->judul_rule }}</h3>
                            <p class="text-xs text-on-surface-variant mt-1">Kategori: {{ $rule->kategori }}</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-outline-variant/30 space-y-6 prose max-w-none text-on-surface">
                        {!! nl2br(e($rule->deskripsi_rule)) !!}
                    </div>
                </section>
                @empty
                <div class="text-center py-20 bg-surface-container-low rounded-2xl border border-dashed border-outline">
                    <span class="material-symbols-outlined text-4xl text-outline mb-4">gavel</span>
                    <h3 class="text-on-surface font-semibold mb-2">Belum Ada House Rule</h3>
                    <p class="text-on-surface-variant text-sm mb-6">Saat ini belum ada aturan yang ditambahkan oleh admin.</p>
                </div>
                @endforelse

                <!-- Feedback Callout -->
</body></html>