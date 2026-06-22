/**
 * project_management.js
 * Handles search/filter, tab switching, and project detail modal
 * for the Admin Project Management page.
 *
 * Data dependency: window.projectsData must be injected by the blade
 * template before this script is loaded.
 */

/* ─────────────────────────────────────────────
   Search + Filter
───────────────────────────────────────────── */
const searchInput  = document.getElementById('projectSearch');
const statusFilter = document.getElementById('statusFilter');
const tableCount   = document.getElementById('tableCount');

function filterTable() {
    const q    = searchInput.value.toLowerCase();
    const st   = statusFilter.value;
    const rows = document.querySelectorAll('.project-row');
    let visible = 0;

    rows.forEach(row => {
        const matchQ = !q
            || row.dataset.name.includes(q)
            || row.dataset.category.includes(q)
            || row.dataset.creator.includes(q);
        const matchS = !st || row.dataset.status === st;

        if (matchQ && matchS) {
            row.style.display = '';
            visible++;
        } else {
            row.style.display = 'none';
        }
    });

    tableCount.textContent = `Showing ${visible} of ${rows.length} projects`;
}

searchInput.addEventListener('input', filterTable);
statusFilter.addEventListener('change', filterTable);


/* ─────────────────────────────────────────────
   Modal Tab Switching
───────────────────────────────────────────── */
function switchTab(name) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.modal-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('panel-' + name).classList.remove('hidden');
    document.getElementById('tab-' + name).classList.add('active');
}


/* ─────────────────────────────────────────────
   Status / Milestone Color Maps
───────────────────────────────────────────── */
const STATUS_COLORS = {
    'Active':    'bg-primary-container/20 text-primary',
    'Draft':     'bg-secondary/10 text-secondary',
    'Completed': 'bg-tertiary/10 text-tertiary',
    'On Hold':   'bg-error/10 text-error',
};

const MS_COLORS = {
    'Done':        { bg: 'bg-tertiary/10', text: 'text-tertiary', icon: 'check_circle' },
    'In Progress': { bg: 'bg-primary/10',  text: 'text-primary',  icon: 'pending' },
    'Pending':     { bg: 'bg-outline/10',  text: 'text-outline',  icon: 'radio_button_unchecked' },
};


/* ─────────────────────────────────────────────
   Render Helpers
───────────────────────────────────────────── */

/**
 * Render the Overview tab content for a project.
 * @param {Object} p - project data object
 */
function renderOverview(p) {
    const sc = STATUS_COLORS[p.status] || 'bg-outline/10 text-outline';

    document.getElementById('modal-badges').innerHTML = `
        <span class="px-2 py-1 bg-surface-container text-on-secondary-container rounded text-xs font-semibold">${p.project_id}</span>
        <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold ${sc}">${p.status}</span>
        <span class="px-2 py-1 bg-surface-container text-on-secondary-container rounded text-xs">${p.category}</span>
    `;

    document.getElementById('modal-description').textContent   = p.description || '—';
    document.getElementById('modal-creator').textContent       = p.creator;
    document.getElementById('modal-creator-email').textContent = p.creator_email;
    document.getElementById('modal-deadline').textContent      = p.deadline || '—';
    document.getElementById('modal-members-count').textContent = `${p.users_count} / ${p.max_members}`;
    document.getElementById('modal-members-label').textContent = `Members (${p.users_count})`;

    const membersHtml = p.users.length > 0
        ? p.users.map(u => `
            <div class="flex items-center gap-3 py-2 border-b border-outline-variant/20 last:border-0">
                <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm flex-shrink-0">
                    ${u.name.charAt(0).toUpperCase()}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-semibold text-sm text-on-background truncate">${u.name}</div>
                    <div class="text-xs text-outline truncate">${u.email}</div>
                </div>
                <span class="px-2 py-0.5 rounded text-[11px] font-semibold ${u.role === 'Owner' ? 'bg-primary-container/30 text-primary' : 'bg-secondary/10 text-secondary'}">${u.role}</span>
            </div>
        `).join('')
        : '<p class="text-on-surface-variant text-sm py-2">Belum ada anggota.</p>';

    document.getElementById('modal-members-list').innerHTML = membersHtml;
}

/**
 * Render a single milestone row (used in both Roadmap and Milestones tabs).
 * @param {Object} m - milestone object
 * @param {string} [extraClass=''] - additional wrapper classes
 * @returns {string} HTML string
 */
function renderMilestoneRow(m, extraClass = '') {
    const mc = MS_COLORS[m.status] || MS_COLORS['Pending'];
    return `
        <div class="flex items-center gap-3 py-2 pl-4 border-l-2 border-outline-variant/30 ml-4 ${extraClass}">
            <span class="material-symbols-outlined text-[18px] ${mc.text}">${mc.icon}</span>
            <div class="flex-1">
                <p class="text-sm font-semibold text-on-background">${m.title}</p>
                ${m.due_date ? `<p class="text-xs text-outline">Due: ${m.due_date}</p>` : ''}
            </div>
            <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold ${mc.bg} ${mc.text}">${m.status}</span>
        </div>`;
}

/**
 * Render the Roadmap tab content.
 * @param {Object} p - project data object
 */
function renderRoadmap(p) {
    const el = document.getElementById('roadmap-list');

    if (!p.roadmaps || p.roadmaps.length === 0) {
        el.innerHTML = `
            <div class="flex flex-col items-center gap-3 py-12 text-center">
                <span class="material-symbols-outlined text-5xl text-outline/40">map</span>
                <p class="text-on-surface-variant text-sm">Belum ada roadmap untuk proyek ini.</p>
            </div>`;
        return;
    }

    el.innerHTML = p.roadmaps.map((r, ri) => {
        const msRows = r.milestones && r.milestones.length > 0
            ? r.milestones.map(m => renderMilestoneRow(m)).join('')
            : '<p class="text-xs text-outline pl-4 py-2 italic">Tidak ada milestone di roadmap ini.</p>';

        return `
            <div class="border border-outline-variant/40 rounded-xl overflow-hidden mb-4">
                <div class="flex items-center gap-3 px-4 py-3 bg-surface-container-low/40">
                    <div class="w-7 h-7 rounded-full bg-primary text-white flex items-center justify-center text-xs font-bold flex-shrink-0">${ri + 1}</div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-on-background">${r.title}</p>
                        ${r.description ? `<p class="text-xs text-outline">${r.description}</p>` : ''}
                    </div>
                    <span class="text-xs text-outline">${r.milestones ? r.milestones.length : 0} milestone</span>
                </div>
                <div class="divide-y divide-outline-variant/10 px-2 pb-2 pt-1 bg-white">${msRows}</div>
            </div>`;
    }).join('');
}

/**
 * Render the Milestones tab content (all milestones with progress bar).
 * @param {Object} p - project data object
 */
function renderMilestones(p) {
    const el = document.getElementById('milestones-list');

    if (!p.milestones || p.milestones.length === 0) {
        el.innerHTML = `
            <div class="flex flex-col items-center gap-3 py-12 text-center">
                <span class="material-symbols-outlined text-5xl text-outline/40">flag</span>
                <p class="text-on-surface-variant text-sm">Belum ada milestone untuk proyek ini.</p>
            </div>`;
        return;
    }

    const done = p.milestones.filter(m => m.status === 'Done').length;
    const pct  = Math.round((done / p.milestones.length) * 100);

    const milestoneCards = p.milestones.map(m => {
        const mc = MS_COLORS[m.status] || MS_COLORS['Pending'];
        return `
            <div class="flex items-center gap-3 p-3 rounded-xl border border-outline-variant/30 bg-white hover:bg-surface-container-lowest transition-colors">
                <span class="material-symbols-outlined text-[22px] ${mc.text}">${mc.icon}</span>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-on-background truncate">${m.title}</p>
                    ${m.due_date ? `<p class="text-xs text-outline">Due: ${m.due_date}</p>` : ''}
                </div>
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold ${mc.bg} ${mc.text} flex-shrink-0">${m.status}</span>
            </div>`;
    }).join('');

    el.innerHTML = `
        <div class="mb-4 p-4 rounded-xl bg-surface-container-low/40 border border-outline-variant/30">
            <div class="flex justify-between mb-2">
                <span class="text-sm font-semibold text-on-background">Progress</span>
                <span class="text-sm font-bold text-primary">${pct}%</span>
            </div>
            <div class="w-full bg-outline/10 rounded-full h-2">
                <div class="bg-primary h-2 rounded-full transition-all" style="width:${pct}%"></div>
            </div>
            <p class="text-xs text-outline mt-1">${done} dari ${p.milestones.length} milestone selesai</p>
        </div>
        <div class="space-y-2">${milestoneCards}</div>
    `;
}

/**
 * Render the Links tab content.
 * @param {Object} p - project data object
 */
function renderLinks(p) {
    const el = document.getElementById('links-list');

    // Merge legacy reference_links + projectLinks
    const allLinks = [];
    if (p.reference_links) {
        allLinks.push({ title: 'Reference Link', url: p.reference_links });
    }
    if (p.links && p.links.length > 0) {
        p.links.forEach(l => allLinks.push(l));
    }

    if (allLinks.length === 0) {
        el.innerHTML = `
            <div class="flex flex-col items-center gap-3 py-12 text-center">
                <span class="material-symbols-outlined text-5xl text-outline/40">link_off</span>
                <p class="text-on-surface-variant text-sm">Belum ada link untuk proyek ini.</p>
            </div>`;
        return;
    }

    el.innerHTML = allLinks.map(l => {
        let domain = l.url;
        try { domain = new URL(l.url).hostname; } catch (e) { /* keep raw url */ }

        return `
            <a href="${l.url}" target="_blank" rel="noopener noreferrer"
               class="flex items-center gap-3 p-4 rounded-xl border border-outline-variant/30 bg-white hover:bg-primary/5 hover:border-primary/30 transition-all group">
                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <span class="material-symbols-outlined text-primary text-[20px]">open_in_new</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-on-background group-hover:text-primary transition-colors truncate">${l.title}</p>
                    <p class="text-xs text-outline truncate">${domain}</p>
                </div>
                <span class="material-symbols-outlined text-outline/40 group-hover:text-primary transition-colors text-[18px]">arrow_forward</span>
            </a>`;
    }).join('');
}


/* ─────────────────────────────────────────────
   Modal Open / Close
───────────────────────────────────────────── */

/**
 * Open the project detail modal and populate all tabs.
 * @param {number} id - project database ID
 */
function showProjectDetail(id) {
    const p = window.projectsData.find(x => x.id === id);
    if (!p) return;

    // Header
    document.getElementById('modalProjectName').textContent = p.name;
    document.getElementById('modalProjectId').textContent   = p.project_id;

    // Populate all tabs
    renderOverview(p);
    renderRoadmap(p);
    renderMilestones(p);
    renderLinks(p);

    // Always open on Overview tab
    switchTab('overview');

    const modal = document.getElementById('projectDetailModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeProjectDetail() {
    const modal = document.getElementById('projectDetailModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Close on backdrop click
document.getElementById('projectDetailModal').addEventListener('click', function (e) {
    if (e.target === this) closeProjectDetail();
});
