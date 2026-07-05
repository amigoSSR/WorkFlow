@include ('user.topbaruser')

<style>
    /* Card Shadow */
    .card-shadow { box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 4px 12px rgba(0,0,0,0.04); }

    /* Modal Animations */
    .modal-overlay {
        animation: fadeIn 0.2s ease;
    }
    .modal-box {
        animation: slideUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(30px) scale(0.96); } to { opacity: 1; transform: translateY(0) scale(1); } }

    /* Tab indicator */
    .tab-btn.active-tab {
        color: #006565;
        border-bottom: 3px solid #006565;
        font-weight: 700;
    }
    .tab-btn { transition: all 0.2s ease; }

    /* Project card hover */
    .project-card { transition: all 0.25s ease; }
    .project-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,101,101,0.12); border-color: #006565 !important; }
    .project-card.selected { border-color: #006565 !important; background: rgba(0, 101, 101, 0.03); }

    /* Form input focus */
    .form-input:focus { outline: none; border-color: #006565; box-shadow: 0 0 0 3px rgba(0,101,101,0.1); }

    /* Success Toast */
    #toast { transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); }

    /* Step indicator */
    .step-dot { transition: all 0.3s ease; }
    .step-dot.active { background: #006565; transform: scale(1.2); }
    .step-dot.done { background: #008080; }

    /* Priority badges */
    .badge-high { background: rgba(139,72,35,0.1); color: #8b4823; }
    .badge-medium { background: rgba(69,95,136,0.1); color: #455f88; }
    .badge-low { background: rgba(110,121,121,0.1); color: #6e7979; }

    /* Scrollbar */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-thumb { background: #bdc9c8; border-radius: 10px; }
</style>

    <!-- Page Header -->
    <div class="sticky top-16 z-30 bg-surface border-b border-outline-variant px-container-padding py-4 flex items-center justify-between">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-background">Project Hub</h2>
            <p class="text-body-md text-on-surface-variant mt-0.5">Bergabung atau buat project baru untuk berkolaborasi.</p>
        </div>
        <!-- Tab Switcher -->
        <div class="flex items-center gap-1 bg-surface-container-low rounded-xl p-1">
            <button id="tab-join" onclick="switchTab('join')" class="tab-btn active-tab px-5 py-2 rounded-lg text-label-md transition-all">
                 Join Project
            </button>
            <button id="tab-create" onclick="switchTab('create')" class="tab-btn px-5 py-2 rounded-lg text-label-md text-on-surface-variant">
                 Create Project
            </button>
        </div>
    </div>

    <!-- Session Alerts -->
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 mx-container-padding mt-4 rounded-lg flex items-center gap-2">
        <span class="material-symbols-outlined">check_circle</span>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 text-red-800 p-4 mx-container-padding mt-4 rounded-lg flex items-center gap-2">
        <span class="material-symbols-outlined">error</span>
        {{ session('error') }}
    </div>
    @endif
    @if($errors->any())
    <div class="bg-red-100 text-red-800 p-4 mx-container-padding mt-4 rounded-lg">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- ================================ -->
    <!-- TAB 1: JOIN PROJECT              -->
    <!-- ================================ -->
    <div id="panel-join" class="p-container-padding">

        <!-- ── JOIN WITH CODE CARD ───────────────────── -->
        <div class="bg-gradient-to-br from-primary/5 to-secondary/5 border-2 border-primary/20 rounded-2xl p-6 mb-8">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                <div class="w-14 h-14 bg-primary rounded-2xl flex items-center justify-center shrink-0 shadow-md">
                    <span class="material-symbols-outlined text-white text-[28px]">key</span>
                </div>
                <div class="flex-1">
                    <h3 class="font-headline-md text-headline-md text-on-background mb-0.5">Punya Kode Join?</h3>
                    <p class="text-body-md text-on-surface-variant">Masukkan kode unik 8 karakter yang diberikan oleh pemilik project.</p>
                </div>
                <form method="POST" action="{{ route('user.project.join') }}" class="flex flex-col sm:flex-row items-stretch gap-3 w-full md:w-auto" id="join-code-form">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <!-- Join Code Input -->
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">tag</span>
                            <input
                                type="text"
                                name="join_code"
                                id="join-code-input"
                                maxlength="8"
                                placeholder="Kode Join (8 karakter)"
                                oninput="this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g,''); checkPasswordField(this.value)"
                                class="form-input pl-10 pr-4 py-3 border border-outline-variant rounded-lg text-body-md bg-white w-full sm:w-56 uppercase tracking-widest font-mono"
                                required
                            >
                        </div>
                        <!-- Password Input (shown when needed) -->
                        <div id="join-password-wrapper" class="relative hidden">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">lock</span>
                            <input
                                type="password"
                                name="join_password"
                                id="join-password-input"
                                placeholder="Password project (jika ada)"
                                class="form-input pl-10 pr-4 py-3 border border-outline-variant rounded-lg text-body-md bg-white w-full sm:w-56"
                            >
                        </div>
                    </div>
                    <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg font-semibold flex items-center justify-center gap-2 hover:opacity-90 transition-all active:scale-95 shadow-sm self-start sm:self-center whitespace-nowrap">
                        <span class="material-symbols-outlined text-[18px]">login</span>
                        Gabung Sekarang
                    </button>
                </form>
            </div>
            <p class="text-[11px] text-on-surface-variant mt-3 ml-0 md:ml-20">💡 Kode join akan muncul di notifikasi saat Anda membuat project, atau minta dari pemilik project.</p>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-3 gap-card-gap mb-8">
            <div class="bg-white rounded-xl p-5 card-shadow flex items-center gap-4">
                <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary">folder_open</span>
                </div>
                <div>
                    <p class="text-headline-md font-headline-md text-on-background font-bold">{{ $projects->count() }}</p>
                    <p class="text-label-md text-on-surface-variant">Project Tersedia</p>
                </div>
            </div>
            <div class="bg-white rounded-xl p-5 card-shadow flex items-center gap-4">
                <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary">groups</span>
                </div>
                <div>
                    <p class="text-headline-md font-headline-md text-on-background font-bold">{{ $projects->sum('users_count') }}</p>
                    <p class="text-label-md text-on-surface-variant">Total Member</p>
                </div>
            </div>
            <div class="bg-white rounded-xl p-5 card-shadow flex items-center gap-4">
                <div class="w-12 h-12 bg-tertiary/10 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-tertiary">trending_up</span>
                </div>
                <div>
                    <p class="text-headline-md font-headline-md text-on-background font-bold">{{ $projects->where('status', 'Active')->count() }}</p>
                    <p class="text-label-md text-on-surface-variant">Active Projects</p>
                </div>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="flex items-center gap-3 mb-5">
            <p class="text-label-md font-bold text-on-surface-variant uppercase tracking-wider">Project yang Tersedia</p>
            <div class="flex-1 h-px bg-outline-variant/40"></div>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                <input id="search-project" oninput="filterProjects()" type="text" placeholder="Cari nama project..." class="form-input w-56 pl-10 pr-4 py-2.5 border border-outline-variant rounded-lg text-body-md bg-white">
            </div>
            <select id="filter-kategori" onchange="filterProjects()" class="form-input border border-outline-variant rounded-lg px-4 py-2.5 text-body-md bg-white text-on-surface">
                <option value="">Semua Kategori</option>
                <option value="Development">Development</option>
                <option value="Design">Design</option>
                <option value="Marketing">Marketing</option>
                <option value="HR">HR</option>
            </select>
        </div>

        <!-- Project Discovery Grid (read-only — join via code) -->
        <div id="project-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-card-gap">
            @forelse($projects as $project)
            <div class="project-card bg-white rounded-xl p-6 card-shadow border-2 border-transparent"
                data-name="{{ $project->name }}" data-status="{{ $project->status }}" data-kategori="{{ $project->category }}">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-11 h-11 bg-primary/10 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary">folder</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="bg-{{ $project->status == 'Active' ? 'green' : ($project->status == 'Completed' ? 'blue' : 'gray') }}-100 text-{{ $project->status == 'Active' ? 'green' : ($project->status == 'Completed' ? 'blue' : 'gray') }}-700 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">{{ $project->status }}</span>
                        <span class="bg-primary/10 text-primary text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $project->category }}</span>
                    </div>
                </div>
                <h3 class="font-headline-md text-headline-md text-on-background mb-1">{{ $project->name }}</h3>
                <p class="text-body-md text-on-surface-variant mb-4 line-clamp-2">{{ $project->description }}</p>
                <div class="mb-3">
                    <div class="flex justify-between text-label-md mb-1">
                        <span class="text-on-surface-variant">Kapasitas</span>
                        <span class="text-primary font-bold">{{ $project->users_count }} / {{ $project->max_members }}</span>
                    </div>
                    <div class="w-full bg-surface-container-low h-1.5 rounded-full">
                        <div class="bg-primary h-full rounded-full" style="width: {{ ($project->users_count / max($project->max_members, 1)) * 100 }}%"></div>
                    </div>
                </div>
                <!-- Info join via code -->
                <div class="flex items-center gap-2 pt-3 border-t border-outline-variant/50">
                    @if(in_array($project->id, $joinedProjectIds))
                        <span class="material-symbols-outlined text-[16px] text-primary">check_circle</span>
                        <span class="text-label-md text-primary font-bold">Sudah Bergabung</span>
                    @elseif($project->join_password)
                        <span class="material-symbols-outlined text-[16px] text-tertiary">lock</span>
                        <span class="text-label-md text-tertiary font-bold">Password Protected</span>
                    @else
                        <span class="material-symbols-outlined text-[16px] text-outline">key</span>
                        <span class="text-label-md text-outline">Perlu kode join</span>
                    @endif
                    <div class="ml-auto w-7 h-7 rounded-full bg-surface-container text-on-surface text-[10px] font-bold flex items-center justify-center">
                        {{ $project->users_count }}
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <span class="material-symbols-outlined text-[56px] text-outline/40">folder_off</span>
                <p class="text-headline-md font-headline-md text-on-surface-variant mt-3">Belum ada project yang tersedia</p>
                <p class="text-body-md text-outline mt-1">Buat project baru atau masukkan kode join dari pemilik project</p>
            </div>
            @endforelse
        </div>

        <!-- Empty State (Client filter) -->
        <div id="empty-state" class="hidden text-center py-16">
            <span class="material-symbols-outlined text-[64px] text-outline">search_off</span>
            <p class="text-headline-md font-headline-md text-on-surface-variant mt-4">Project tidak ditemukan</p>
            <p class="text-body-md text-outline mt-1">Coba ubah filter atau kata kunci pencarian</p>
        </div>

    </div>

    <!-- ================================ -->
    <!-- TAB 2: CREATE PROJECT            -->
    <!-- ================================ -->
    <div id="panel-create" class="hidden p-container-padding">

        <div class="max-w-3xl mx-auto">

            <!-- Step Indicator -->
            <div class="flex items-center justify-center gap-3 mb-10">
                <div class="flex items-center gap-2">
                    <div id="step1-dot" class="step-dot active w-8 h-8 bg-primary rounded-full flex items-center justify-center text-white text-label-md font-bold">1</div>
                    <span id="step1-label" class="text-label-md font-bold text-primary">Info Project</span>
                </div>
                <div class="flex-1 h-0.5 bg-outline-variant max-w-[80px]"></div>
                <div class="flex items-center gap-2">
                    <div id="step2-dot" class="step-dot w-8 h-8 bg-outline-variant rounded-full flex items-center justify-center text-outline text-label-md font-bold">2</div>
                    <span id="step2-label" class="text-label-md text-outline">Detail Tambahan</span>
                </div>
                <div class="flex-1 h-0.5 bg-outline-variant max-w-[80px]"></div>
                <div class="flex items-center gap-2">
                    <div id="step3-dot" class="step-dot w-8 h-8 bg-outline-variant rounded-full flex items-center justify-center text-outline text-label-md font-bold">3</div>
                    <span id="step3-label" class="text-label-md text-outline">Review & Submit</span>
                </div>
            </div>

            <form id="create-project-form" method="POST" action="{{ route('user.project.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- STEP 1: Informasi Wajib -->
                <div id="form-step1" class="bg-white rounded-2xl card-shadow p-8">
                    <h3 class="font-headline-md text-headline-md text-on-background mb-1">📋 Informasi Project</h3>
                    <p class="text-body-md text-on-surface-variant mb-6">Isi informasi utama project Anda. Semua field bertanda * wajib diisi.</p>

                    <div class="space-y-5">
                        <!-- Nama Project -->
                        <div>
                            <label class="text-label-md font-bold text-on-surface block mb-1.5">Nama Project <span class="text-error">*</span></label>
                            <input id="f-nama" name="name" type="text" placeholder="Contoh: Aplikasi Inventory Toko..." maxlength="100" required
                                class="form-input w-full px-4 py-3 border border-outline-variant rounded-lg text-body-md transition-all"
                                oninput="validateNama()">
                            <div class="flex justify-between mt-1">
                                <p id="err-nama" class="text-[11px] text-error hidden">❌ Nama project tidak boleh kosong (min. 3 karakter)</p>
                                <p class="text-[11px] text-outline ml-auto" id="nama-count">0 / 100</p>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="text-label-md font-bold text-on-surface block mb-1.5">Deskripsi Project <span class="text-error">*</span></label>
                            <textarea id="f-deskripsi" name="description" rows="4" placeholder="Jelaskan tujuan, ruang lingkup, dan detail project..." required
                                class="form-input w-full px-4 py-3 border border-outline-variant rounded-lg text-body-md resize-none transition-all"
                                oninput="validateDeskripsi()"></textarea>
                            <div class="flex justify-between mt-1">
                                <p id="err-deskripsi" class="text-[11px] text-error hidden">❌ Deskripsi minimal 10 karakter</p>
                                <p class="text-[11px] text-outline ml-auto" id="deskripsi-count">0 karakter</p>
                            </div>
                        </div>

                        <!-- Kategori & Status -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="text-label-md font-bold text-on-surface block mb-1.5">Kategori <span class="text-error">*</span></label>
                                <select id="f-kategori" name="category" required class="form-input w-full px-4 py-3 border border-outline-variant rounded-lg text-body-md bg-white">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Development"> Development</option>
                                    <option value="Design"> Design</option>
                                    <option value="Marketing"> Marketing</option>
                                    <option value="Research"> Research</option>
                                    <option value="Lainnya"> Lainnya</option>
                                </select>
                                <p id="err-kategori" class="text-[11px] text-error hidden mt-1"> Pilih kategori project</p>
                            </div>
                            <div>
                                <label class="text-label-md font-bold text-on-surface block mb-1.5">Status</label>
                                <select id="f-status" name="status" class="form-input w-full px-4 py-3 border border-outline-variant rounded-lg text-body-md bg-white">
                                    <option value="Penfing">Pending</option>
                                    <option value="On-Going"> On-Going</option>
                                </select>
                            </div>
                        </div>

                        

                    </div><!-- end space-y-5 -->

                    <div class="flex justify-end mt-8">
                        <button type="button" onclick="goStep(2)" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold flex items-center gap-2 hover:opacity-90 transition-all active:scale-95">
                            Selanjutnya <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                    </div>
                </div>

                <!-- STEP 2: Detail Tambahan (Opsional) -->
                <div id="form-step2" class="hidden bg-white rounded-2xl card-shadow p-8">
                    <h3 class="font-headline-md text-headline-md text-on-background mb-1">⚙️ Detail Tambahan</h3>
                    <p class="text-body-md text-on-surface-variant mb-6">Field berikut bersifat opsional. Lewati jika belum diperlukan.</p>

                    <div class="space-y-5">

                        <!-- Deadline -->
                        <div>
                            <label class="text-label-md font-bold text-on-surface block mb-1.5">
                                <span class="material-symbols-outlined text-[16px] mr-1">event</span> Deadline Project
                            </label>
                            <input id="f-deadline" name="deadline" type="date" class="form-input w-full px-4 py-3 border border-outline-variant rounded-lg text-body-md"
                                min="{{ date('Y-m-d') }}">
                            <p id="err-deadline" class="text-[11px] text-error hidden mt-1">❌ Deadline tidak boleh lebih awal dari hari ini</p>
                        </div>

                        <!-- Project Password (opsional) -->
                        <div class="bg-surface-container-low border border-outline-variant/60 rounded-xl p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="material-symbols-outlined text-[20px] text-primary">lock</span>
                                <div>
                                    <label class="text-label-md font-bold text-on-surface block" for="f-join-password">Password Project <span class="text-outline font-normal">(Opsional)</span></label>
                                    <p class="text-[11px] text-on-surface-variant">Jika diisi, member harus memasukkan password ini saat join menggunakan kode.</p>
                                </div>
                            </div>
                            <div class="relative">
                                <input id="f-join-password" name="join_password" type="password"
                                    placeholder="Masukkan password project (min. 4 karakter)..."
                                    class="form-input w-full px-4 py-3 pr-12 border border-outline-variant rounded-lg text-body-md"
                                    minlength="4" maxlength="50">
                                <button type="button" onclick="togglePwdVisibility()" class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors">
                                    <span id="pwd-eye" class="material-symbols-outlined text-[20px]">visibility</span>
                                </button>
                            </div>
                            <p class="text-[11px] text-outline mt-1.5">🔑 Kode join akan di-generate otomatis. Password ini adalah lapisan keamanan tambahan.</p>
                        </div>

                        <!-- Dokumen -->
                        <div>
                            <label class="text-label-md font-bold text-on-surface block mb-1.5">
                                <span class="material-symbols-outlined text-[16px] mr-1">upload_file</span> Upload Dokumen
                            </label>
                            <div id="drop-zone" class="border-2 border-dashed border-outline-variant rounded-xl p-6 text-center cursor-pointer hover:border-primary hover:bg-primary/5 transition-all"
                                onclick="document.getElementById('f-file').click()">
                                <span class="material-symbols-outlined text-[40px] text-outline">cloud_upload</span>
                                <p class="text-body-md text-on-surface-variant mt-2">Klik atau drag & drop file di sini</p>
                                <p class="text-label-md text-outline mt-1">PDF, DOC, DOCX, PNG, JPG • Maks. 5MB</p>
                            </div>
                            <input id="f-file" name="document" type="file" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" class="hidden" onchange="handleFile(this)">
                            <div id="file-preview" class="hidden mt-3 bg-surface-container-low rounded-lg p-3 flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary">description</span>
                                <span id="file-name" class="text-body-md text-on-surface flex-1"></span>
                                <button type="button" onclick="clearFile()" class="text-error hover:opacity-70 transition-opacity">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>
                            <p id="err-file" class="text-[11px] text-error hidden mt-1">❌ File terlalu besar. Maksimal 5MB</p>
                        </div>

                        <!-- Links/References -->
                        <div>
                            <label class="text-label-md font-bold text-on-surface block mb-1.5">
                                <span class="material-symbols-outlined text-[16px] mr-1">link</span> Links / Referensi
                            </label>
                            <input id="f-links" name="reference_links" type="url" placeholder="https://docs.example.com/project-spec" class="form-input w-full px-4 py-3 border border-outline-variant rounded-lg text-body-md">
                            <p class="text-[11px] text-outline mt-1">URL dokumentasi atau referensi project</p>
                        </div>
                    </div>

                    <div class="flex justify-between mt-8">
                        <button type="button" onclick="goStep(1)" class="px-6 py-3 border border-outline-variant rounded-lg font-semibold flex items-center gap-2 text-on-surface-variant hover:bg-surface-container transition-all">
                            <span class="material-symbols-outlined">arrow_back</span> Kembali
                        </button>
                        <button type="button" onclick="goStep(3)" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold flex items-center gap-2 hover:opacity-90 transition-all active:scale-95">
                            Review Project <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                    </div>
                </div>

                <!-- STEP 3: Review & Submit -->
                <div id="form-step3" class="hidden bg-white rounded-2xl card-shadow p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">fact_check</span>
                        </div>
                        <div>
                            <h3 class="font-headline-md text-headline-md text-on-background">Review Project</h3>
                            <p class="text-body-md text-on-surface-variant">Pastikan data sudah benar sebelum submit.</p>
                        </div>
                    </div>

                    <div id="review-content" class="bg-surface-container-low rounded-xl p-6 space-y-4 mb-6">
                        <!-- Diisi oleh JS -->
                    </div>

                    <div class="bg-primary/5 border border-primary/20 rounded-xl p-4 flex items-start gap-3 mb-6">
                        <span class="material-symbols-outlined text-primary mt-0.5">info</span>
                        <p class="text-body-md text-on-surface-variant">Setelah project dibuat, Anda dapat mengundang lebih banyak anggota, upload dokumen, dan membuat milestone/task.</p>
                    </div>

                    <div class="flex justify-between">
                        <button type="button" onclick="goStep(2)" class="px-6 py-3 border border-outline-variant rounded-lg font-semibold flex items-center gap-2 text-on-surface-variant hover:bg-surface-container transition-all">
                            <span class="material-symbols-outlined">edit</span> Edit Data
                        </button>
                        <button type="button" onclick="submitProject()" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold flex items-center gap-2 hover:opacity-90 transition-all active:scale-95 shadow-sm">
                            <span class="material-symbols-outlined">rocket_launch</span> Buat Project!
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

<script src="{{ asset('js/joinproject.js') }}"></script>
<script>
    // Toggle password visibility in create form
    function togglePwdVisibility() {
        const inp = document.getElementById('f-join-password');
        const eye = document.getElementById('pwd-eye');
        if (inp.type === 'password') {
            inp.type = 'text';
            eye.textContent = 'visibility_off';
        } else {
            inp.type = 'password';
            eye.textContent = 'visibility';
        }
    }

    // Show/hide password field in join form based on code length
    // (always show it so user can type — backend will decide if it's needed)
    function checkPasswordField(val) {
        const wrapper = document.getElementById('join-password-wrapper');
        if (val.length >= 6) {
            wrapper.classList.remove('hidden');
        } else {
            wrapper.classList.add('hidden');
        }
    }

    // Auto-format join code input: uppercase + only alphanumeric
    document.getElementById('join-code-input')?.addEventListener('paste', function(e) {
        setTimeout(() => {
            this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '').substring(0, 8);
            checkPasswordField(this.value);
        }, 10);
    });
</script>