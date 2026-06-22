// Tab Switching
function switchTab(tab) {
    const joinPanel = document.getElementById('panel-join');
    const createPanel = document.getElementById('panel-create');
    const joinBtn = document.getElementById('tab-join');
    const createBtn = document.getElementById('tab-create');

    if (tab === 'join') {
        joinPanel.classList.remove('hidden');
        createPanel.classList.add('hidden');
        joinBtn.classList.add('active-tab');
        createBtn.classList.remove('active-tab');
        createBtn.classList.add('text-on-surface-variant');
    } else {
        createPanel.classList.remove('hidden');
        joinPanel.classList.add('hidden');
        createBtn.classList.add('active-tab');
        createBtn.classList.remove('text-on-surface-variant');
        joinBtn.classList.remove('active-tab');
        joinBtn.classList.add('text-on-surface-variant');
    }
}

// Search & Filter
function filterProjects() {
    const search = document.getElementById('search-project').value.toLowerCase();
    const kategori = document.getElementById('filter-kategori').value;
    const status = document.getElementById('filter-status').value;
    const cards = document.querySelectorAll('.project-card');
    let visible = 0;

    cards.forEach(card => {
        const name = card.dataset.name.toLowerCase();
        const kData = card.dataset.kategori;
        const sData = card.dataset.status;

        const matchSearch = name.includes(search);
        const matchKat = !kategori || kData === kategori;
        const matchStat = !status || sData === status;

        if (matchSearch && matchKat && matchStat) {
            card.style.display = '';
            visible++;
        } else {
            card.style.display = 'none';
        }
    });

    document.getElementById('empty-state').classList.toggle('hidden', visible > 0);
}

// Project Selection
let selectedProject = null;

function selectProject(el) {
    if (el.dataset.status === 'Inactive') return;

    document.querySelectorAll('.project-card').forEach(c => {
        c.classList.remove('selected');
        c.querySelector('.selected-check').classList.add('hidden');
    });

    el.classList.add('selected');
    el.querySelector('.selected-check').classList.remove('hidden');
    selectedProject = el;
}

// Join Modal
function openJoinModal(id, name, members, max) {
    document.getElementById('modal-project-id').value = id;
    document.getElementById('modal-project-name').textContent = name;
    document.getElementById('modal-after-members').textContent = `${parseInt(members) + 1} / ${max} orang`;
    
    const today = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    document.getElementById('modal-date').textContent = today;
    
    document.getElementById('join-modal').classList.remove('hidden');
}

function closeJoinModal() {
    document.getElementById('join-modal').classList.add('hidden');
}

function closeSuccessModal() {
    document.getElementById('success-modal').classList.add('hidden');
}

// CREATE PROJECT - Steps
function goStep(step) {
    if (step === 2 && !validateStep1()) return;
    if (step === 3 && !validateStep2()) return;

    document.getElementById('form-step1').classList.add('hidden');
    document.getElementById('form-step2').classList.add('hidden');
    document.getElementById('form-step3').classList.add('hidden');

    document.getElementById(`form-step${step}`).classList.remove('hidden');
    updateStepUI(step);

    if (step === 3) buildReview();
}

function updateStepUI(active) {
    [1, 2, 3].forEach(i => {
        const dot = document.getElementById(`step${i}-dot`);
        const label = document.getElementById(`step${i}-label`);
        if (i < active) {
            dot.classList.remove('bg-outline-variant', 'text-outline');
            dot.classList.add('done', 'bg-on-primary-fixed-variant', 'text-white');
            dot.innerHTML = '✓';
            label.classList.remove('text-outline');
            label.classList.add('text-on-surface-variant');
        } else if (i === active) {
            dot.classList.remove('bg-outline-variant', 'text-outline', 'done', 'bg-on-primary-fixed-variant');
            dot.classList.add('active', 'bg-primary', 'text-white');
            dot.innerHTML = i;
            label.classList.remove('text-outline');
            label.classList.add('font-bold', 'text-primary');
        } else {
            dot.classList.remove('active', 'done', 'bg-primary', 'bg-on-primary-fixed-variant', 'text-white');
            dot.classList.add('bg-outline-variant', 'text-outline');
            dot.innerHTML = i;
            label.classList.remove('font-bold', 'text-primary');
            label.classList.add('text-outline');
        }
    });
}

// Validation
function validateStep1() {
    let ok = true;
    
    const nama = document.getElementById('f-nama').value.trim();
    if (nama.length < 3) {
        document.getElementById('err-nama').classList.remove('hidden');
        document.getElementById('f-nama').classList.add('border-error');
        ok = false;
    }
    
    const deskripsi = document.getElementById('f-deskripsi').value.trim();
    if (deskripsi.length < 10) {
        document.getElementById('err-deskripsi').classList.remove('hidden');
        document.getElementById('f-deskripsi').classList.add('border-error');
        ok = false;
    }
    
    const kategori = document.getElementById('f-kategori').value;
    if (!kategori) {
        document.getElementById('err-kategori').classList.remove('hidden');
        ok = false;
    }
    
    return ok;
}

function validateStep2() {
    let ok = true;
    
    const deadline = document.getElementById('f-deadline').value;
    if (deadline) {
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        const dl = new Date(deadline);
        if (dl < today) {
            document.getElementById('err-deadline').classList.remove('hidden');
            ok = false;
        }
    }

    return ok;
}

function validateNama() {
    const val = document.getElementById('f-nama').value;
    document.getElementById('nama-count').textContent = `${val.length} / 100`;
    if (val.trim().length >= 3) {
        document.getElementById('err-nama').classList.add('hidden');
        document.getElementById('f-nama').classList.remove('border-error');
    }
}

function validateDeskripsi() {
    const val = document.getElementById('f-deskripsi').value;
    document.getElementById('deskripsi-count').textContent = `${val.length} karakter`;
    if (val.trim().length >= 10) {
        document.getElementById('err-deskripsi').classList.add('hidden');
        document.getElementById('f-deskripsi').classList.remove('border-error');
    }
}

function handleFile(input) {
    const file = input.files[0];
    if (!file) return;
    if (file.size > 5 * 1024 * 1024) {
        document.getElementById('err-file').classList.remove('hidden');
        input.value = '';
        return;
    }
    document.getElementById('err-file').classList.add('hidden');
    document.getElementById('file-name').textContent = file.name;
    document.getElementById('file-preview').classList.remove('hidden');
    document.getElementById('drop-zone').classList.add('hidden');
}

function clearFile() {
    document.getElementById('f-file').value = '';
    document.getElementById('file-preview').classList.add('hidden');
    document.getElementById('drop-zone').classList.remove('hidden');
}

// Review Builder
function buildReview() {
    const getVal = (id) => document.getElementById(id)?.value ?? '';
    const getText = (id) => document.getElementById(id)?.textContent ?? '';

    const nama      = getVal('f-nama');
    const deskripsi = getVal('f-deskripsi');
    const kategori  = getVal('f-kategori');
    const status    = getVal('f-status');
    const deadline  = getVal('f-deadline');
    const fileName  = getText('file-name');
    const links     = getVal('f-links');

    const deadlineText = deadline
        ? new Date(deadline).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })
        : '-';

    const rows = [
        ['📌 Nama Project', nama || '-'],
        ['📝 Deskripsi', deskripsi.length > 80 ? deskripsi.slice(0, 80) + '...' : (deskripsi || '-')],
        ['🏷️ Kategori', kategori || '-'],
        ['📊 Status', status || '-'],
        ['📅 Deadline', deadlineText],
        ['📎 Dokumen', fileName || '-'],
        ['🔗 Links', links || '-'],
    ];

    document.getElementById('review-content').innerHTML = rows.map(([label, value]) => `
        <div class="flex items-start gap-3">
            <span class="text-body-md text-on-surface-variant w-40 flex-shrink-0">${label}</span>
            <span class="text-body-md text-on-surface font-semibold flex-1">${value}</span>
        </div>
    `).join('<div class="border-t border-outline-variant/50"></div>');
}

// Submit Project
function submitProject() {
    document.getElementById('create-project-form').submit();
}

// Set min date for deadline
document.addEventListener('DOMContentLoaded', () => {
    const today = new Date().toISOString().split('T')[0];
    if (document.getElementById('f-deadline')) {
        document.getElementById('f-deadline').min = today;
    }
});
