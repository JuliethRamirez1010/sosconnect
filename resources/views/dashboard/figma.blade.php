<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SOS Connect | Panel de alertas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box}body{margin:0;background:#f1f5f9;color:#172538;font-family:Inter,Arial,sans-serif}button,input,select,textarea{font:inherit}button{cursor:pointer}.topbar{height:64px;background:#fff;border-bottom:1px solid #dbe3ec;display:flex;align-items:center;justify-content:space-between;padding:0 max(24px,calc((100vw - 1180px)/2));position:sticky;top:0;z-index:10}.brand{display:flex;align-items:center;gap:9px;font-weight:800;color:#10263d;white-space:nowrap}.brand img{width:34px;height:34px;object-fit:contain}.tabs{display:flex;align-items:stretch;height:64px;gap:26px}.tab{border:0;background:transparent;color:#586b82;font-size:13px;font-weight:600;padding:0 7px;position:relative}.tab.active{color:#10263d}.tab.active:after{content:"";height:3px;background:#173957;border-radius:3px;position:absolute;bottom:0;left:7px;right:7px}.header-right{display:flex;align-items:center;gap:12px;color:#6c7d90;font-size:12px}.sound-toggle{border:1px solid #dbe3ec;border-radius:9px;padding:8px 11px;background:white;color:#27415d;font-size:12px;font-weight:700}.sound-toggle.active{border-color:#0e9f6e;color:#08784f;background:#effcf6}.logout{background:none;border:0;color:#6c7d90;font-size:12px}.container{max-width:1180px;margin:0 auto;padding:24px 22px 60px}.page{display:none}.page.active{display:block}.alert-heading{display:flex;align-items:center;gap:9px;color:#e31b35;text-transform:uppercase;letter-spacing:.12em;font-size:11px;font-weight:800;margin:0 0 14px}.live-dot{width:9px;height:9px;border-radius:50%;background:#fa5968;box-shadow:0 0 0 4px #ffe4e7}.emergency-card{border:2px solid #ff5261;border-radius:16px;background:white;overflow:hidden;box-shadow:0 18px 35px #192b4015;margin-bottom:20px}.emergency-head{height:40px;background:#e90012;color:white;display:flex;align-items:center;justify-content:space-between;padding:0 15px;font-size:12px;font-weight:800}.emergency-title{display:flex;align-items:center;gap:8px}.emergency-time{font-size:11px;opacity:.9;margin-left:auto;margin-right:12px;font-variant-numeric:tabular-nums}.attend-button{border:0;border-radius:8px;background:#fff;color:#c71927;padding:6px 11px;font-size:10px;font-weight:800}.location-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px;padding:15px 16px 12px}.location-tile{border:1px solid #ffd9dc;background:#fff3f4;border-radius:11px;text-align:center;padding:12px}.eyebrow{display:block;font-size:9px;letter-spacing:.1em;color:#8290a1;font-weight:800;text-transform:uppercase;margin-bottom:6px}.location-tile .eyebrow{color:#fa7c86}.location-value{font:800 28px 'DM Sans',sans-serif;color:#bd1522}.patient-info-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;border-top:1px solid #edf1f5;padding:15px 16px}.patient-name{font:800 17px 'DM Sans',sans-serif;color:#1d2d40;margin:0 0 7px}.patient-meta,.patient-small{color:#65768b;font-size:11px;line-height:1.7}.patient-small{font-size:10px}.conditions{margin:4px 0 0;padding:0 0 0 16px;color:#4d5d70;font-size:11px;line-height:1.8}.conditions li::marker{color:#f15b67}.medication-section{padding:0 16px 16px}.medication-grid{display:grid;grid-template-columns:1fr 1fr;gap:7px}.medication{display:flex;gap:10px;align-items:center;background:#f5f8fb;border-radius:9px;padding:9px 11px;min-height:45px}.medication-icon{width:24px;height:24px;display:grid;place-items:center;background:#e4ebf2;border-radius:6px;color:#52708a;font-size:13px}.medication strong{display:block;font-size:10px;color:#29394b}.medication span{display:block;margin-top:3px;font-size:9px;color:#8290a1}.empty-alert{background:white;border:1px solid #dde5ed;border-radius:14px;padding:28px;text-align:center;color:#718195}.stats{display:grid;grid-template-columns:repeat(3,1fr);gap:13px;margin:16px 0 24px}.stat{background:white;border:1px solid #dfe7ee;border-radius:12px;padding:15px 18px}.stat strong{display:block;font:800 25px 'DM Sans',sans-serif}.stat span{font-size:11px;color:#718195}.stat.green strong{color:#059669}.stat.orange strong{color:#e97500}.stat.red strong{color:#e11d31}.section-head{display:flex;align-items:center;justify-content:space-between;gap:14px;margin-bottom:17px}.section-head h1{margin:0;font:800 24px 'DM Sans',sans-serif}.section-head p{margin:5px 0 0;color:#6b7b8f;font-size:12px}.primary{border:0;border-radius:9px;background:#102a43;color:#fff;padding:10px 15px;font-size:12px;font-weight:700}.primary:hover{background:#1c4468}.search{border:1px solid #d9e2eb;border-radius:9px;padding:10px 12px;background:white;min-width:230px;font-size:12px}.table-wrap{overflow:auto;background:white;border:1px solid #dfe7ee;border-radius:13px}.data-table{border-collapse:collapse;width:100%;font-size:12px}.data-table th{text-align:left;color:#77879b;background:#f8fafc;font-size:10px;text-transform:uppercase;letter-spacing:.06em;padding:12px;border-bottom:1px solid #e9eef3}.data-table td{padding:13px 12px;border-bottom:1px solid #edf1f5;vertical-align:top}.data-table tr:last-child td{border-bottom:0}.cell-main{font-weight:700;color:#26384c}.cell-sub{display:block;color:#7b8b9c;font-size:10px;margin-top:4px;line-height:1.5}.edit-button,.secondary{border:1px solid #d7e0e8;border-radius:8px;background:#fff;color:#334a61;padding:7px 10px;font-size:10px;font-weight:700}.report-button{border:1px solid #ccd8e3;background:#fff;color:#334a61;border-radius:7px;padding:6px 8px;font-size:10px;font-weight:700}.severity-pill{border:1px solid #dbe3ec;background:#fff;border-radius:8px;color:#52657a;padding:8px 12px;min-width:90px;font-size:10px;font-weight:700}.severity-pill.selected[data-severity="stable"]{background:#169c6d;color:white;border-color:#169c6d}.severity-pill.selected[data-severity="moderate"]{background:#f59e0b;color:white;border-color:#f59e0b}.severity-pill.selected[data-severity="critical"]{background:#e11d31;color:white;border-color:#e11d31}.modal-overlay{display:none;position:fixed;inset:0;background:#111d2f80;backdrop-filter:blur(3px);z-index:50;align-items:center;justify-content:center;padding:18px}.modal-overlay.open{display:flex}.modal{background:white;width:min(100%,620px);max-height:94vh;overflow:auto;border-radius:15px;box-shadow:0 25px 70px #0b1f3c40}.modal-head{background:#10263d;color:white;padding:15px 19px;display:flex;align-items:center;justify-content:space-between}.modal-head h2{margin:0;font:800 14px 'DM Sans',sans-serif}.modal-head p{margin:4px 0 0;font-size:9px;color:#c7d2df}.close{border:0;background:transparent;color:#d5dee7;font-size:22px}.modal-body{padding:17px 19px}.summary-line{display:grid;grid-template-columns:1fr 1fr;gap:12px;background:#f5f8fb;border:1px solid #e8eef4;border-radius:11px;padding:12px;margin-bottom:17px}.summary-line strong{font-size:10px;color:#344a61}.summary-line span{display:block;color:#62768b;font-size:9px;margin-top:5px}.field-label{display:block;color:#52657a;text-transform:uppercase;letter-spacing:.07em;font-size:9px;font-weight:800;margin:15px 0 8px}.severity-row{display:flex;gap:8px}.symptom-grid{display:grid;grid-template-columns:1fr 1fr;gap:6px}.symptom{border:1px solid #dce5ee;border-radius:8px;padding:8px 9px;display:flex;gap:7px;align-items:center;font-size:10px;color:#52657a;cursor:pointer}.symptom:has(input:checked){border-color:#ef8990;background:#fff4f4;color:#a61e2d}.custom-symptom{display:flex;gap:7px;margin-top:7px}.custom-symptom input,.form-field input,.form-field select,.form-field textarea,.notes{width:100%;border:1px solid #dbe3ec;border-radius:8px;padding:9px 10px;font-size:11px;outline:none}.custom-symptom button{border:0;border-radius:8px;background:#eaf0f5;color:#334a61;padding:0 12px;font-size:10px;font-weight:700}.notes{min-height:82px;resize:vertical}.modal-foot{display:flex;justify-content:flex-end;gap:9px;background:#f8fafc;border-top:1px solid #e9eef3;padding:12px 18px}.patient-modal{width:min(100%,760px)}.patient-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:11px}.form-field{display:flex;flex-direction:column;gap:5px}.form-field.full{grid-column:1/-1}.form-field label{font-size:10px;font-weight:700;color:#53677d}.form-field textarea{min-height:67px;resize:vertical}.form-error{display:none;color:#b91c1c;background:#fef2f2;border-radius:8px;padding:9px 11px;font-size:11px;margin-bottom:12px}.form-error.show{display:block}.sound-help{background:white;border:1px solid #dde5ed;border-radius:12px;padding:17px;color:#607286;font-size:12px;line-height:1.7;max-width:720px}.pill{display:inline-flex;border-radius:99px;background:#eef3f8;padding:4px 8px;font-size:9px;font-weight:700;color:#52657a}
        @media(max-width:760px){.topbar{height:auto;min-height:62px;flex-wrap:wrap;padding:8px 14px}.brand{font-size:12px}.tabs{order:3;width:100%;height:46px;gap:7px;justify-content:space-between}.tab{font-size:10px;padding:0 4px}.tab.active:after{left:3px;right:3px}.header-right{gap:6px}.header-right .logout{display:none}.sound-toggle{padding:7px;font-size:10px}.container{padding:18px 12px 40px}.patient-info-grid{gap:11px}.stats{gap:7px}.stat{padding:11px}.stat strong{font-size:21px}.location-grid{gap:7px;padding:10px}.location-value{font-size:23px}.emergency-head{font-size:10px;padding:0 9px}.attend-button{padding:6px}.modal-overlay{padding:8px}.modal-body{padding:13px}.patient-form-grid{grid-template-columns:1fr}.form-field.full{grid-column:auto}}
        @media(max-width:480px){.brand img{width:29px;height:29px}.brand div{display:none}.header-right{font-size:10px}.tab{font-size:9px}.patient-info-grid{grid-template-columns:1fr}.medication-grid{grid-template-columns:1fr}.stats{grid-template-columns:1fr 1fr}.stats .stat:last-child{grid-column:1/-1}.section-head{align-items:flex-start;flex-wrap:wrap}.search{min-width:0;width:100%}.symptom-grid{grid-template-columns:1fr}.severity-row{gap:5px}.severity-pill{min-width:0;flex:1;padding:8px 5px}.summary-line{grid-template-columns:1fr}}
    </style>
</head>
<body>
<header class="topbar">
    <a class="brand" href="{{ route('dashboard') }}"><img src="{{ asset('images/sos-connect.png') }}" alt="SOS Connect"><div>SOS CONNECT <span style="display:block;font-size:9px;color:#7d8da0;font-weight:500">Sistema hospitalario</span></div></a>
    <nav class="tabs" aria-label="Secciones del panel">
        <button class="tab active" data-page="alerts">Panel de Alertas</button>
        <button class="tab" data-page="patients">Pacientes</button>
        <button class="tab" data-page="history">Registro</button>
        <button class="tab" data-page="settings">Configuración</button>
    </nav>
    <div class="header-right"><button id="soundToggle" class="sound-toggle" type="button" aria-pressed="false">🔔 Activar sonido</button><span>{{ $user->name }}</span><form method="POST" action="{{ route('logout') }}">@csrf<button class="logout" type="submit">Salir</button></form></div>
</header>

<main class="container">
    <section class="page active" id="page-alerts">
        <h1 class="alert-heading"><span class="live-dot"></span> Llamadas de emergencia activas — requieren atención inmediata (<span id="activeCount">0</span>)</h1>
        <div id="activeCalls" aria-live="polite"><div class="empty-alert">Esperando llamadas de emergencia…</div></div>
        <div class="stats">
            <div class="stat green"><strong id="handledCount">0</strong><span>Llamadas atendidas</span></div>
            <div class="stat orange"><strong id="pendingCount">0</strong><span>Pendientes de atención</span></div>
            <div class="stat red"><strong id="criticalCount">0</strong><span>Casos críticos activos</span></div>
        </div>
    </section>

    <section class="page" id="page-patients">
        <div class="section-head"><div><h1>Pacientes</h1><p>Registro clínico, ubicación actual y pulsador asignado.</p></div><button id="addPatient" class="primary">+ Agregar paciente</button></div>
        <input id="patientSearch" class="search" type="search" placeholder="Buscar por nombre, documento, habitación o cama">
        <div class="table-wrap" style="margin-top:13px"><table class="data-table"><thead><tr><th>Paciente</th><th>Habitación / cama</th><th>Diagnóstico</th><th>Pulsador</th><th>Personal asignado</th><th></th></tr></thead><tbody id="patientsBody"></tbody></table></div>
    </section>

    <section class="page" id="page-history">
        <div class="section-head"><div><h1>Registro de atenciones</h1><p>Historial de llamadas y reportes del personal.</p></div></div>
        <input id="historySearch" class="search" type="search" placeholder="Buscar en el registro">
        <div class="table-wrap" style="margin-top:13px"><table class="data-table"><thead><tr><th>Fecha y hora</th><th>Paciente / ubicación</th><th>Gravedad</th><th>Atendido por</th><th>Síntomas</th><th>Reporte</th></tr></thead><tbody id="historyBody"></tbody></table></div>
    </section>

    <section class="page" id="page-settings">
        <div class="section-head"><div><h1>Configuración</h1><p>Sonido de alarma y asignación de pulsadores.</p></div></div>
        <div class="sound-help"><strong>Alarma sonora</strong><br>Activa el botón 🔔 en la parte superior del panel. El navegador emitirá una alarma mientras haya llamadas pendientes; se detiene cuando el personal las atiende. Mantén abierto este panel en el computador de enfermería.<br><br><strong>Ubicación del paciente</strong><br>El ESP32 envía su ID de dispositivo. En Pacientes, el personal asigna ese ID al paciente y actualiza habitación y cama cuando se traslada. El panel relee los datos automáticamente cada cinco segundos.</div>
    </section>
</main>

<div id="reportModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="reportTitle">
    <div class="modal">
        <div class="modal-head"><div><h2 id="reportTitle">📋 Registrar atención sanitaria</h2><p>SOS CONNECT — Registro de Síntomas al Responder</p></div><button class="close" type="button" data-close="reportModal" aria-label="Cerrar">×</button></div>
        <div class="modal-body">
            <div class="summary-line"><div><strong id="reportPatient">Paciente</strong><span id="reportLocation">Habitación — · Cama —</span><span id="reportStaff">Atendido por: —</span></div><div style="text-align:right"><strong>Hora de llamada</strong><span id="reportCallTime">—</span><span id="reportAttendTime">Atención: —</span></div></div>
            <label class="field-label">Estado / gravedad al momento de atención</label>
            <div class="severity-row"><button type="button" class="severity-pill" data-severity="stable">Estable</button><button type="button" class="severity-pill selected" data-severity="moderate">Moderado</button><button type="button" class="severity-pill" data-severity="critical">Crítico</button></div>
            <label class="field-label">Síntomas observados al atender al paciente</label>
            <div class="symptom-grid" id="symptomGrid"></div>
            <div class="custom-symptom"><input id="customSymptom" placeholder="Otro síntoma específico..."><button type="button" id="addSymptom">+ Agregar</button></div>
            <label class="field-label" for="reportNotes">Observaciones / acciones aplicadas</label>
            <textarea id="reportNotes" class="notes" placeholder="Ej.: Se suministró analgésico, se verificaron signos vitales, se acomodó al paciente..."></textarea>
            <div id="reportError" class="form-error"></div>
        </div>
        <div class="modal-foot"><button class="secondary" type="button" data-close="reportModal">Cancelar</button><button id="saveReport" class="primary" type="button">Guardar y finalizar llamada</button></div>
    </div>
</div>

<div id="patientModal" class="modal-overlay" role="dialog" aria-modal="true" aria-labelledby="patientTitle">
    <div class="modal patient-modal">
        <div class="modal-head"><div><h2 id="patientTitle">Agregar paciente</h2><p>SOS CONNECT — Ficha del paciente</p></div><button class="close" type="button" data-close="patientModal" aria-label="Cerrar">×</button></div>
        <form id="patientForm">
            <div class="modal-body">
                <div id="patientError" class="form-error"></div>
                <div class="patient-form-grid">
                    <div class="form-field"><label for="pName">Nombre completo *</label><input id="pName" name="name" required maxlength="255"></div>
                    <div class="form-field"><label for="pDocument">Documento</label><input id="pDocument" name="document_id" maxlength="80"></div>
                    <div class="form-field"><label for="pAge">Edad</label><input id="pAge" name="age" type="number" min="0" max="120"></div>
                    <div class="form-field"><label for="pBlood">Tipo de sangre</label><select id="pBlood" name="blood_type"><option value="">Seleccionar</option><option>A+</option><option>A-</option><option>B+</option><option>B-</option><option>AB+</option><option>AB-</option><option>O+</option><option>O-</option></select></div>
                    <div class="form-field"><label for="pRoom">Habitación *</label><input id="pRoom" name="room" required maxlength="40"></div>
                    <div class="form-field"><label for="pBed">Cama *</label><input id="pBed" name="bed" required maxlength="20"></div>
                    <div class="form-field"><label for="pAdmitted">Fecha de ingreso</label><input id="pAdmitted" name="admitted_at" type="date"></div>
                    <div class="form-field"><label for="pNurse">Enfermero/a asignado/a</label><select id="pNurse" name="assigned_nurse_id"><option value="">Sin asignar</option>@foreach($staff as $member)<option value="{{ $member->id }}">{{ $member->name }} — {{ $member->role === 'doctor' ? 'Médico' : 'Enfermería' }}</option>@endforeach</select></div>
                    <div class="form-field full"><label for="pConditions">Diagnósticos / padecimientos (uno por línea)</label><textarea id="pConditions" rows="3" placeholder="Diabetes tipo 2&#10;Hipertensión arterial&#10;Insuficiencia cardíaca leve"></textarea></div>
                    <div class="form-field full"><label for="pMedications">Medicamentos en curso (uno por línea: nombre | dosis | frecuencia)</label><textarea id="pMedications" rows="3" placeholder="Metformina | 850 mg | 2 veces al día&#10;Enalapril | 10 mg | 1 vez al día"></textarea></div>
                    <div class="form-field"><label for="pEmergencyName">Contacto de emergencia</label><input id="pEmergencyName" name="emergency_contact_name" maxlength="255"></div>
                    <div class="form-field"><label for="pEmergencyPhone">Teléfono de emergencia</label><input id="pEmergencyPhone" name="emergency_contact_phone" maxlength="40"></div>
                    <div class="form-field full"><label for="pDevice">ID del pulsador ESP32</label><input id="pDevice" name="device_id" maxlength="80" placeholder="esp32-boton-1"><span class="cell-sub">La alerta de ese dispositivo se vincula con este paciente y su cama actual.</span></div>
                </div>
            </div>
            <div class="modal-foot"><button class="secondary" type="button" data-close="patientModal">Cancelar</button><button class="primary" type="submit">Guardar paciente</button></div>
        </form>
    </div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const currentUserName = @json($user->name);
    const patientIndexUrl = @json(route('patients.index'));
    const patientStoreUrl = @json(route('patients.store'));
    const patientUpdateTemplate = @json(route('patients.update', ['patient' => 'PATIENT_ID']));
    const alertsUrl = @json(route('alerts.latest'));
    const attendTemplate = @json(route('alerts.attend', ['panicAlert' => 'ALERT_ID']));
    const completeTemplate = @json(route('alerts.complete', ['panicAlert' => 'ALERT_ID']));
    const symptomOptions = ['Dolor torácico / opresión', 'Disnea / Dificultad para respirar', 'Mareo / Vértigo', 'Palpitaciones / Taquicardia', 'Dolor agudo de herida', 'Náuseas / Vómitos', 'Ansiedad / Agitación', 'Cefalea / Dolor de cabeza'];
    let patients = @json($patients);
    let alerts = [];
    let activeReportAlert = null;
    let selectedSeverity = 'moderate';
    let lastAlertId = null;
    let firstPoll = true;
    let soundEnabled = false;
    let audioContext = null;
    let ringTimer = null;

    document.querySelectorAll('.tab').forEach(tab => tab.addEventListener('click', () => {
        document.querySelectorAll('.tab').forEach(item => item.classList.toggle('active', item === tab));
        document.querySelectorAll('.page').forEach(page => page.classList.toggle('active', page.id === `page-${tab.dataset.page}`));
    }));

    document.querySelectorAll('[data-close]').forEach(button => button.addEventListener('click', () => closeModal(button.dataset.close)));
    document.querySelectorAll('.modal-overlay').forEach(overlay => overlay.addEventListener('click', event => { if (event.target === overlay) closeModal(overlay.id); }));
    document.getElementById('addPatient').addEventListener('click', () => openPatientModal());
    document.getElementById('patientForm').addEventListener('submit', savePatient);
    document.getElementById('patientSearch').addEventListener('input', () => renderPatients());
    document.getElementById('historySearch').addEventListener('input', () => renderHistory());
    document.getElementById('addSymptom').addEventListener('click', addCustomSymptom);
    document.getElementById('customSymptom').addEventListener('keydown', event => { if (event.key === 'Enter') { event.preventDefault(); addCustomSymptom(); } });
    document.querySelectorAll('.severity-pill').forEach(button => button.addEventListener('click', () => {
        selectedSeverity = button.dataset.severity;
        document.querySelectorAll('.severity-pill').forEach(pill => pill.classList.toggle('selected', pill === button));
    }));
    document.getElementById('saveReport').addEventListener('click', saveReport);

    function closeModal(id) { document.getElementById(id).classList.remove('open'); }
    function openModal(id) { document.getElementById(id).classList.add('open'); }
    function esc(value) { return String(value ?? '').replace(/[&<>"']/g, char => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[char])); }
    function locationText(patient) { return patient?.room ? `Habitación ${patient.room} · Cama ${patient.bed || '—'}` : 'Ubicación sin asignar'; }
    function statusText(status) { return ({pending:'Pendiente',attending:'Atendido',completed:'Finalizada'})[status] || 'Pendiente'; }
    function relativeTime(iso) {
        const seconds = Math.max(0, Math.floor((Date.now() - new Date(iso).getTime()) / 1000));
        return `${String(Math.floor(seconds / 60)).padStart(2,'0')}:${String(seconds % 60).padStart(2,'0')}`;
    }

    function renderActiveCalls() {
        const active = alerts.filter(alert => alert.status !== 'completed');
        document.getElementById('activeCount').textContent = active.length;
        document.getElementById('pendingCount').textContent = active.filter(alert => alert.status === 'pending').length;
        document.getElementById('handledCount').textContent = alerts.filter(alert => alert.status === 'completed').length;
        document.getElementById('criticalCount').textContent = active.filter(alert => alert.severity === 'critical').length;
        const root = document.getElementById('activeCalls');
        root.replaceChildren();
        if (!active.length) {
            const empty = document.createElement('div');
            empty.className = 'empty-alert';
            empty.textContent = 'No hay llamadas activas. El panel está escuchando los pulsadores.';
            root.append(empty);
            syncAlarm();
            return;
        }

        active.forEach(alert => {
            const card = document.createElement('article');
            card.className = 'emergency-card';
            const head = document.createElement('div');
            head.className = 'emergency-head';
            const title = document.createElement('span');
            title.className = 'emergency-title';
            title.innerHTML = '<span aria-hidden="true">●</span> ¡LLAMADA DE EMERGENCIA!';
            const elapsed = document.createElement('span');
            elapsed.className = 'emergency-time';
            elapsed.textContent = relativeTime(alert.triggered_at);
            const attend = document.createElement('button');
            attend.className = 'attend-button';
            attend.type = 'button';
            attend.textContent = alert.status === 'attending' ? 'Atendido ✓ · Reporte' : 'Atender';
            attend.addEventListener('click', () => attendAlert(alert));
            head.append(title, elapsed, attend);

            const patient = alert.patient || null;
            const room = document.createElement('div');
            room.className = 'location-grid';
            room.innerHTML = `<div class="location-tile"><span class="eyebrow">Habitación</span><strong class="location-value">${esc(alert.room || '—')}</strong></div><div class="location-tile"><span class="eyebrow">Cama</span><strong class="location-value">${esc(alert.bed || '—')}</strong></div>`;

            const info = document.createElement('div');
            info.className = 'patient-info-grid';
            const patientInfo = document.createElement('div');
            patientInfo.innerHTML = `<span class="eyebrow">Paciente</span><h2 class="patient-name">${esc(alert.patient_name)}</h2><div class="patient-meta">${esc(alert.patient_age ? `${alert.patient_age} años` : 'Edad no registrada')}　·　Sangre: ${esc(alert.blood_type || '—')}</div><div class="patient-small">Ingresó: ${esc(alert.admitted_at || '—')}</div><div class="patient-small">Enfermero/a asignado/a: ${esc(alert.assigned_nurse || 'Sin asignar')}</div><div class="patient-small">Contacto de emergencia: ${esc(alert.emergency_contact_name || '—')} — ${esc(alert.emergency_contact_phone || '—')}</div><div class="patient-small">Pulsador: ${esc(alert.device_id)}</div>`;
            const conditionInfo = document.createElement('div');
            conditionInfo.innerHTML = '<span class="eyebrow">Diagnóstico / padecimientos</span>';
            const conditions = Array.isArray(alert.conditions) ? alert.conditions : [];
            if (conditions.length) {
                const list = document.createElement('ul');
                list.className = 'conditions';
                conditions.forEach(condition => { const item = document.createElement('li'); item.textContent = condition; list.append(item); });
                conditionInfo.append(list);
            } else {
                const empty = document.createElement('div'); empty.className = 'patient-small'; empty.textContent = alert.diagnosis || 'Sin padecimientos registrados'; conditionInfo.append(empty);
            }
            info.append(patientInfo, conditionInfo);

            const meds = document.createElement('div');
            meds.className = 'medication-section';
            const medsLabel = document.createElement('span'); medsLabel.className = 'eyebrow'; medsLabel.textContent = 'Medicamentos en curso'; meds.append(medsLabel);
            const medsGrid = document.createElement('div'); medsGrid.className = 'medication-grid';
            (alert.medications || []).forEach(medication => {
                const item = document.createElement('div'); item.className = 'medication';
                item.innerHTML = `<span class="medication-icon">▤</span><div><strong>${esc(medication.name)}</strong><span>${esc(medication.dose || '')}${medication.dose && medication.schedule ? ' — ' : ''}${esc(medication.schedule || '')}</span></div>`;
                medsGrid.append(item);
            });
            if (!medsGrid.childElementCount) { const empty = document.createElement('span'); empty.className = 'patient-small'; empty.textContent = 'Sin medicamentos registrados'; medsGrid.append(empty); }
            meds.append(medsGrid);
            card.append(head, room, info, meds);
            root.append(card);
        });
        syncAlarm();
    }

    function renderPatients() {
        const body = document.getElementById('patientsBody');
        if (!body) return;
        const query = document.getElementById('patientSearch').value.trim().toLowerCase();
        const filtered = patients.filter(patient => [patient.name, patient.document_id, patient.room, patient.bed, patient.device_id, patient.diagnosis, ...(patient.conditions || [])].join(' ').toLowerCase().includes(query));
        body.replaceChildren();
        if (!filtered.length) {
            const row = document.createElement('tr'); const cell = document.createElement('td'); cell.colSpan = 6; cell.textContent = patients.length ? 'No hay pacientes que coincidan con la búsqueda.' : 'Aún no hay pacientes registrados.'; row.append(cell); body.append(row); return;
        }
        filtered.forEach(patient => {
            const row = document.createElement('tr');
            const name = document.createElement('td'); name.innerHTML = `<span class="cell-main">${esc(patient.name)}</span><span class="cell-sub">${esc(patient.age ? `${patient.age} años` : 'Edad —')} · Sangre ${esc(patient.blood_type || '—')}</span>`;
            const location = document.createElement('td'); location.innerHTML = `<span class="cell-main">${esc(patient.room)} / ${esc(patient.bed)}</span><span class="cell-sub">Ingreso ${esc(patient.admitted_at || '—')}</span>`;
            const conditions = document.createElement('td'); conditions.textContent = (patient.conditions || []).join(', ') || patient.diagnosis || '—';
            const device = document.createElement('td'); device.innerHTML = `<span class="pill">${esc(patient.device_id || 'Sin pulsador')}</span>`;
            const nurse = document.createElement('td'); nurse.textContent = patient.assigned_nurse?.name || 'Sin asignar';
            const actions = document.createElement('td'); const edit = document.createElement('button'); edit.className = 'edit-button'; edit.textContent = 'Editar / trasladar'; edit.addEventListener('click', () => openPatientModal(patient)); actions.append(edit);
            row.append(name, location, conditions, device, nurse, actions); body.append(row);
        });
    }

    function renderHistory() {
        const body = document.getElementById('historyBody');
        const query = document.getElementById('historySearch').value.trim().toLowerCase();
        const list = alerts.filter(alert => alert.status === 'completed').filter(alert => [alert.patient_name, alert.room, alert.bed, alert.attended_by, alert.report, ...(alert.symptoms || [])].join(' ').toLowerCase().includes(query));
        body.replaceChildren();
        if (!list.length) { const row = document.createElement('tr'); const cell = document.createElement('td'); cell.colSpan = 6; cell.textContent = 'Aún no hay atenciones finalizadas con reporte.'; row.append(cell); body.append(row); return; }
        list.forEach(alert => {
            const row = document.createElement('tr');
            const date = document.createElement('td'); date.textContent = alert.display_time;
            const patient = document.createElement('td'); patient.innerHTML = `<span class="cell-main">${esc(alert.patient_name)}</span><span class="cell-sub">${esc(locationText(alert))}</span>`;
            const severity = document.createElement('td'); severity.innerHTML = `<span class="pill">${esc(({stable:'Estable',moderate:'Moderado',critical:'Crítico'})[alert.severity] || '—')}</span>`;
            const staff = document.createElement('td'); staff.textContent = alert.attended_by || '—';
            const symptoms = document.createElement('td'); symptoms.textContent = (alert.symptoms || []).join(', ') || '—';
            const report = document.createElement('td'); report.textContent = alert.report || '—';
            row.append(date, patient, severity, staff, symptoms, report); body.append(row);
        });
    }

    function openPatientModal(patient = null) {
        const form = document.getElementById('patientForm');
        form.reset();
        form.dataset.patientId = patient?.id || '';
        document.getElementById('patientTitle').textContent = patient ? 'Actualizar / trasladar paciente' : 'Agregar paciente';
        form.querySelector('[type="submit"]').textContent = patient ? 'Guardar cambios' : 'Guardar paciente';
        if (patient) {
            ['name','document_id','age','blood_type','room','bed','diagnosis','admitted_at','assigned_nurse_id','emergency_contact_name','emergency_contact_phone','device_id'].forEach(key => { const field = form.elements.namedItem(key); if (field) field.value = key === 'admitted_at' ? String(patient[key] || '').slice(0, 10) : (patient[key] ?? ''); });
            document.getElementById('pConditions').value = (patient.conditions || []).join('\n');
            document.getElementById('pMedications').value = (patient.medications || []).map(item => [item.name,item.dose,item.schedule].filter(Boolean).join(' | ')).join('\n');
        }
        clearFormError('patientError');
        openModal('patientModal');
    }

    function clearFormError(id) { const error = document.getElementById(id); error.classList.remove('show'); error.textContent = ''; }
    function showFormError(id, message) { const error = document.getElementById(id); error.textContent = message; error.classList.add('show'); }

    async function savePatient(event) {
        event.preventDefault();
        clearFormError('patientError');
        const form = event.currentTarget;
        const formData = new FormData(form);
        const payload = Object.fromEntries(formData.entries());
        payload.age = payload.age || null;
        payload.assigned_nurse_id = payload.assigned_nurse_id || null;
        payload.conditions = document.getElementById('pConditions').value.split(/\n|,/).map(item => item.trim()).filter(Boolean);
        payload.medications = document.getElementById('pMedications').value.split('\n').map(line => line.split('|').map(part => part.trim())).filter(parts => parts[0]).map(([name,dose='',schedule='']) => ({name,dose,schedule}));
        const patientId = form.dataset.patientId;
        const url = patientId ? patientUpdateTemplate.replace('PATIENT_ID', patientId) : patientStoreUrl;

        try {
            const response = await fetch(url, { method: patientId ? 'PATCH' : 'POST', headers: {'Accept':'application/json','Content-Type':'application/json','X-CSRF-TOKEN':csrfToken}, body: JSON.stringify(payload) });
            const result = await response.json();
            if (!response.ok) { showFormError('patientError', result.message || Object.values(result.errors || {}).flat()[0] || 'No se pudo guardar la ficha.'); return; }
            closeModal('patientModal');
            await Promise.all([refreshPatients(), pollAlerts()]);
        } catch (error) { showFormError('patientError', 'No se pudo conectar con el servidor.'); }
    }

    async function refreshPatients() {
        const response = await fetch(patientIndexUrl, {headers:{'Accept':'application/json'}});
        if (response.ok) { patients = await response.json(); renderPatients(); }
    }

    async function attendAlert(alert) {
        if (alert.status === 'pending') {
            try {
                const response = await fetch(attendTemplate.replace('ALERT_ID', alert.id), {method:'POST',headers:{'Accept':'application/json','X-CSRF-TOKEN':csrfToken}});
                const result = await response.json();
                if (!response.ok) { window.alert(result.message || 'No se pudo asignar la llamada.'); return; }
                await pollAlerts();
                alert = alerts.find(item => item.id === alert.id) || alert;
            } catch (error) { window.alert('No se pudo conectar con el servidor.'); return; }
        }
        activeReportAlert = alert;
        selectedSeverity = alert.severity || 'moderate';
        document.querySelectorAll('.severity-pill').forEach(pill => pill.classList.toggle('selected', pill.dataset.severity === selectedSeverity));
        document.getElementById('reportPatient').textContent = alert.patient_name;
        document.getElementById('reportLocation').textContent = `${locationText(alert)} · ${alert.patient_age ? `${alert.patient_age} años` : 'Edad —'} · Sangre ${alert.blood_type || '—'}`;
        document.getElementById('reportStaff').textContent = `Atendido por: ${currentUserName}`;
        document.getElementById('reportCallTime').textContent = alert.display_time;
        document.getElementById('reportAttendTime').textContent = `Atención: ${alert.attended_time || new Date().toLocaleTimeString('es-CO',{hour:'2-digit',minute:'2-digit',second:'2-digit'})}`;
        document.getElementById('reportNotes').value = alert.report || '';
        document.getElementById('customSymptom').value = '';
        renderSymptoms(alert.symptoms || []);
        clearFormError('reportError');
        openModal('reportModal');
    }

    function renderSymptoms(selected = []) {
        const grid = document.getElementById('symptomGrid'); grid.replaceChildren();
        [...new Set([...symptomOptions, ...selected])].forEach(symptom => {
            const label = document.createElement('label'); label.className = 'symptom';
            const checkbox = document.createElement('input'); checkbox.type = 'checkbox'; checkbox.value = symptom; checkbox.checked = selected.includes(symptom);
            const text = document.createElement('span'); text.textContent = symptom;
            label.append(checkbox, text); grid.append(label);
        });
    }

    function addCustomSymptom() {
        const field = document.getElementById('customSymptom'); const value = field.value.trim();
        if (!value) return;
        const selected = Array.from(document.querySelectorAll('#symptomGrid input:checked'), input => input.value);
        selected.push(value); renderSymptoms(selected); field.value = '';
    }

    async function saveReport() {
        if (!activeReportAlert) return;
        const report = document.getElementById('reportNotes').value.trim();
        if (!report) { showFormError('reportError', 'Escribe las observaciones o acciones realizadas antes de finalizar.'); return; }
        clearFormError('reportError');
        const symptoms = Array.from(document.querySelectorAll('#symptomGrid input:checked'), input => input.value);
        try {
            const response = await fetch(completeTemplate.replace('ALERT_ID', activeReportAlert.id), {method:'POST',headers:{'Accept':'application/json','Content-Type':'application/json','X-CSRF-TOKEN':csrfToken},body:JSON.stringify({report,severity:selectedSeverity,symptoms})});
            const result = await response.json();
            if (!response.ok) { showFormError('reportError', result.message || Object.values(result.errors || {}).flat()[0] || 'No se pudo guardar el reporte.'); return; }
            closeModal('reportModal'); activeReportAlert = null; await pollAlerts();
        } catch (error) { showFormError('reportError', 'No se pudo conectar con el servidor.'); }
    }

    function playAlarm() {
        if (!soundEnabled || !audioContext) return;
        audioContext.resume();
        const start = audioContext.currentTime;
        [880,660,880].forEach((frequency,index) => {
            const oscillator = audioContext.createOscillator(); const gain = audioContext.createGain(); const at = start + index * .28;
            oscillator.type = 'sine'; oscillator.frequency.value = frequency;
            gain.gain.setValueAtTime(.001,at); gain.gain.exponentialRampToValueAtTime(.2,at+.02); gain.gain.exponentialRampToValueAtTime(.001,at+.22);
            oscillator.connect(gain); gain.connect(audioContext.destination); oscillator.start(at); oscillator.stop(at+.23);
        });
    }

    function syncAlarm() {
        const pending = alerts.some(alert => alert.status === 'pending');
        if (soundEnabled && pending && !ringTimer) { playAlarm(); ringTimer = setInterval(() => { if (alerts.some(alert => alert.status === 'pending')) playAlarm(); else { clearInterval(ringTimer); ringTimer = null; } }, 4500); }
        if ((!soundEnabled || !pending) && ringTimer) { clearInterval(ringTimer); ringTimer = null; }
    }

    document.getElementById('soundToggle').addEventListener('click', async event => {
        soundEnabled = !soundEnabled;
        const button = event.currentTarget;
        button.classList.toggle('active', soundEnabled); button.setAttribute('aria-pressed', String(soundEnabled));
        button.textContent = soundEnabled ? '🔔 Sonido activado' : '🔔 Activar sonido';
        const Context = window.AudioContext || window.webkitAudioContext;
        if (soundEnabled && Context) { audioContext ||= new Context(); await audioContext.resume(); }
        syncAlarm();
    });

    async function pollAlerts() {
        try {
            const response = await fetch(alertsUrl, {headers:{'Accept':'application/json'}});
            if (!response.ok) return;
            const fresh = await response.json();
            const newestId = fresh.length ? Math.max(...fresh.map(item => item.id)) : lastAlertId;
            if (!firstPoll && newestId !== null && lastAlertId !== null && newestId > lastAlertId) {
                const newest = fresh.find(item => item.id === newestId);
                if ('Notification' in window && Notification.permission === 'granted') new Notification('SOS Connect — llamada de emergencia', {body:`${newest.patient_name} · ${locationText(newest)}`});
            }
            alerts = fresh; lastAlertId = newestId; firstPoll = false;
            renderActiveCalls(); renderHistory();
        } catch (error) { console.error('No se pudieron actualizar las alertas.', error); }
    }

    document.getElementById('patientSearch').dispatchEvent(new Event('input'));
    document.getElementById('historySearch').dispatchEvent(new Event('input'));
    pollAlerts(); refreshPatients();
    setInterval(() => { pollAlerts(); refreshPatients(); }, 5000);
</script>
</body>
</html>
