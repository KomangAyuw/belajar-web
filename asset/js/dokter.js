function showPanel(id, el) {
    document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
    document.getElementById('panel-' + id).classList.add('active');
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    if (el) el.classList.add('active');

    const titles = {
        overview: 'Overview',
        jadwal: 'Jadwal Praktik',
        'daftar-pasien': 'Daftar Pasien',
        'rekam-medis': 'Rekam Medis',
        profil: 'Profil Saya'
    };
    document.getElementById('topbar-title').textContent = titles[id] || id;
    document.getElementById('topbar-bc').textContent = 'GlowCare Dokter → ' + (titles[id] || id);
}

function openModal(id) {
    document.getElementById(id).classList.add('open');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('open');
}

function closeModalOutside(e, id) {
    if (e.target.classList.contains('modal-overlay')) closeModal(id);
}

function showToast(msg) {
    const t = document.getElementById('toast');
    document.getElementById('toast-msg').textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3000);
}

function switchTab(tabId, el) {
    document.querySelectorAll('.rm-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.rm-content').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('tab-' + tabId).classList.add('active');
}

function showPasienDetail(nama) {
    const box = document.getElementById('pasien-detail-box');
    box.style.display = 'block';
    document.getElementById('detail-name').textContent = nama;
    document.getElementById('detail-avatar').textContent = nama.charAt(0);
    box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}