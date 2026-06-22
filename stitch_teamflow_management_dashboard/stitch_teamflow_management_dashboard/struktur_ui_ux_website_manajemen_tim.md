# Struktur UI/UX & Layout: Team Collaboration & Monitoring Dashboard

## 1. Konsep Visual & Brand Identity
*   **Warna Utama:** Teal (#008080) untuk kesan produktif dan tenang, atau Biru Navy (#1A365D) untuk kesan profesionalitas tinggi.
*   **Warna Latar:** Putih bersih dengan aksen abu-abu muda (#F8FAFC) untuk memisahkan area konten.
*   **Tipografi:** Menggunakan font Sans-Serif (seperti Inter) untuk keterbacaan maksimal.

## 2. Struktur Layout Utama (Layout Dasar)
*   **Sidebar (Kiri):** Lebar tetap (~250px), berisi Logo, Profil Singkat, dan Navigasi Menu. Warna sidebar sedikit lebih gelap atau menggunakan warna brand.
*   **Top Bar (Atas):** Berisi Search bar, Notifikasi, Pesan, dan Tombol Cepat (seperti "Tambah Tugas" untuk Admin).
*   **Main Content Area (Tengah/Kanan):** Area scrollable yang menampilkan konten dinamis berdasarkan menu yang dipilih.

---

## 3. Detail Halaman - Role: ADMIN
*   **Overview:** Widget statistik (Total Proyek, Anggota Aktif, Task Selesai) + Grafik garis (Aktivitas Tim).
*   **Manajemen User:** Tabel dengan fitur Filter, Pencarian, dan Tombol "Tambah Anggota". Kolom: Nama, Role, Status, Aksi.
*   **Manajemen Proyek:** Kanban Board atau List View untuk memantau progress tiap departemen.
*   **Diary & Activity:** Feed kronologis laporan harian dari semua user.
*   **Weekly Check-up:** Radar chart atau Bar chart performa mingguan.
*   **Calendar (Editable):** Interface kalender penuh (FullCalendar style) dengan fitur drag-and-drop dan modal untuk input jadwal.
*   **House Rules (Editable):** Text editor (Rich Text) untuk memperbarui dokumen internal.
*   **Piket (Editable):** Grid mingguan yang bisa di-klik untuk assign nama ke hari tertentu.

---

## 4. Detail Halaman - Role: USER (Anggota Tim)
*   **Proyek Saya:** Fokus pada kartu tugas yang di-assign ke user. Status: To Do, Doing, Done.
*   **Diary Proyek (Form):** Form sederhana: Judul Kerja, Deskripsi Progres, Kendala (Optional), dan Upload Lampiran.
*   **Calendar (Read-Only):** Tampilan kalender yang bersih tanpa tombol "Add/Edit". Hanya tooltip informasi saat hover.
*   **House Rules & Piket (Read-Only):** Layout dokumen yang rapi dan tabel jadwal statis yang kontras untuk memudahkan pengecekan.

---

## 5. Tips UX (User Experience)
*   **Status Indicators:** Gunakan label warna untuk status (Hijau: Selesai, Kuning: Proses, Merah: Terlambat/High Priority).
*   **Empty States:** Pastikan jika belum ada data, tampilkan ilustrasi atau teks instruksi yang ramah.
*   **Responsivitas:** Meskipun fokus desktop, pastikan elemen dashboard tidak pecah saat jendela browser di-resize.
*   **Role-Based Access Control (RBAC):** UI harus secara otomatis menyembunyikan tombol "Edit/Delete" untuk User agar tidak membingungkan.
*   **Feedback Loops:** Berikan notifikasi sukses (Toast) setelah user submit Diary atau Admin update jadwal.
