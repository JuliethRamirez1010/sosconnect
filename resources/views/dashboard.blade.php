<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SOS Connect | Inicio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }

        button,
        input,
        select {
            font-family: inherit;
        }

        button {
            cursor: pointer;
        }

        .app {
            min-height: 100vh;
            display: flex;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 100;
            transition: .25s;
        }

        .sidebar-logo {
            height: 76px;
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid #f1f5f9;
        }

        .sidebar-logo strong {
            font-family: 'DM Sans', sans-serif;
            font-size: 21px;
            color: #0f766e;
        }

        .sidebar-logo span {
            color: #64748b;
            font-size: 11px;
            display: block;
            margin-top: 2px;
        }

        .logo-mark {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #0f766e;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
            font-weight: 700;
        }

        .sidebar-nav {
            padding: 22px 13px;
            flex: 1;
            min-height: 0;
            overflow-y: auto;
        }

        .nav-label {
            text-transform: uppercase;
            font-size: 10px;
            color: #94a3b8;
            font-weight: 700;
            letter-spacing: .08em;
            padding: 0 12px;
            margin-bottom: 8px;
        }

        .nav-item {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 0;
            background: transparent;
            color: #64748b;
            padding: 11px 12px;
            border-radius: 9px;
            margin-bottom: 3px;
            text-align: left;
            font-size: 13px;
            transition: .18s;
            text-decoration: none;
        }

        .nav-item:hover {
            background: #f0fdfa;
            color: #0f766e;
        }

        .nav-item.active {
            background: #ccfbf1;
            color: #0f766e;
            font-weight: 600;
        }

        .nav-icon {
            width: 20px;
            text-align: center;
        }

        .sidebar-bottom {
            padding: 14px;
            border-top: 1px solid #f1f5f9;
            flex-shrink: 0;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 10px;
            background: #f8fafc;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #ccfbf1;
            color: #0f766e;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 12px;
            font-weight: 700;
        }

        .profile-info {
            flex: 1;
            min-width: 0;
        }

        .profile-name {
            font-size: 12px;
            font-weight: 600;
            color: #334155;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .profile-role {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .logout-button {
            border: 0;
            background: transparent;
            color: #94a3b8;
            padding: 6px;
        }

        .logout-button:hover {
            color: #ef4444;
        }

        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
        }

        .topbar {
            height: 76px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .page-title h1 {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            font-size: 21px;
            font-weight: 700;
        }

        .page-title p {
            margin: 4px 0 0;
            color: #94a3b8;
            font-size: 11px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .notification {
            width: 38px;
            height: 38px;
            border: 1px solid #e2e8f0;
            background: white;
            border-radius: 9px;
            position: relative;
            color: #64748b;
        }

        .notification-dot {
            position: absolute;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #ef4444;
            top: 7px;
            right: 7px;
            border: 2px solid white;
        }

        .notification[aria-pressed="true"] { color:#0f766e; border-color:#99f6e4; background:#f0fdfa; }
        .notification.alarm-ringing { color:#047857; background:#d1fae5; border-color:#34d399; box-shadow:0 0 0 3px #10b98120; }
        .notification.alarm-ringing .notification-dot { background:#10b981; }
        .notification:not(.alarm-ringing) .notification-dot { display:none; }
        .notification.alarm-blocked { border-color:#f59e0b; background:#fffbeb; }
        .alarm-audio-status { padding:10px 14px; margin:0 0 16px; color:#854d0e; background:#fffbeb; border:1px solid #fde68a; border-radius:8px; font-size:12px; }
        .alarm-audio-status:empty { display:none; }

        .mobile-menu {
            display: none;
            border: 0;
            background: transparent;
            color: #475569;
        }

        /* =========================
           CONTENT
        ========================= */

        .content {
            padding: 28px 30px;
            max-width: 1500px;
            margin: auto;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
            animation: appear .2s ease;
        }

        @keyframes appear {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 19px;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f0fdfa;
            color: #0f766e;
        }

        .stat-label {
            color: #64748b;
            font-size: 12px;
        }

        .stat-value {
            font-family: 'DM Sans', sans-serif;
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
        }

        .stat-description {
            color: #94a3b8;
            font-size: 10px;
            margin-top: 4px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.55fr 1fr;
            gap: 20px;
        }

        .panel {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }

        .panel-header {
            padding: 17px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-header h2 {
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            font-size: 15px;
        }

        .panel-header span {
            font-size: 11px;
            color: #94a3b8;
        }

        /* ALERTS */

        .alert-list {
            padding: 5px 0;
        }

        .alert-row {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px 20px;
            border-bottom: 1px solid #f8fafc;
        }

        .alert-row:last-child {
            border-bottom: 0;
        }

        .alert-indicator {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .pending {
            background: #ef4444;
        }

        .attending {
            background: #f59e0b;
        }

        .completed {
            background: #10b981;
        }

        .alert-main {
            flex: 1;
        }

        .alert-patient {
            font-size: 12px;
            font-weight: 600;
            color: #334155;
        }

        .alert-meta {
            color: #94a3b8;
            font-size: 10px;
            margin-top: 3px;
        }

        .emergency-calls { display:grid; gap:16px; margin:0 0 20px; }
        .emergency-call { overflow:hidden; background:#fff; border:2px solid #ff5261; border-radius:14px; box-shadow:0 14px 30px #192b4015; }
        .emergency-call-head { display:flex; align-items:center; gap:10px; min-height:42px; padding:9px 14px; color:#fff; background:#e90012; font-size:12px; font-weight:800; }
        .emergency-call-head .call-status { margin-left:auto; color:#fff; background:#ffffff22; border-radius:999px; padding:5px 9px; font-size:10px; }
        .emergency-call-body { padding:14px; }
        .emergency-location { display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:14px; }
        .emergency-location > div { padding:10px; text-align:center; border:1px solid #ffd9dc; border-radius:9px; background:#fff3f4; }
        .emergency-location span { display:block; color:#ef7c86; font-size:9px; font-weight:800; letter-spacing:.1em; text-transform:uppercase; }
        .emergency-location strong { display:block; margin-top:3px; color:#bd1522; font-size:24px; }
        .emergency-details { display:grid; grid-template-columns:1fr 1fr; gap:14px; border-top:1px solid #edf1f5; padding-top:13px; }
        .emergency-details h3 { margin:0 0 6px; color:#8290a1; font-size:9px; letter-spacing:.08em; text-transform:uppercase; }
        .emergency-details p,.emergency-details li { margin:3px 0; color:#52657a; font-size:11px; line-height:1.55; overflow-wrap:anywhere; }
        .emergency-details .patient-title { color:#1d2d40; font-size:15px; font-weight:800; }
        .emergency-details ul { margin:0; padding-left:17px; }
        .emergency-medicines { display:grid; grid-template-columns:1fr 1fr; gap:7px; margin-top:11px; }
        .emergency-medicine { padding:8px 10px; background:#f5f8fb; border-radius:8px; color:#52657a; font-size:10px; }
        .emergency-call-foot { display:flex; align-items:center; justify-content:space-between; gap:10px; padding:10px 14px; border-top:1px solid #edf1f5; background:#fafbfd; color:#748397; font-size:10px; }
        .emergency-call-foot .action-small { background:#fff; }

        .status {
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 600;
        }

        .status-pending {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-attending {
            background: #fef3c7;
            color: #b45309;
        }

        .status-completed {
            background: #d1fae5;
            color: #047857;
        }

        .action-small {
            border: 1px solid #e2e8f0;
            background: white;
            padding: 6px 9px;
            border-radius: 7px;
            color: #64748b;
            font-size: 10px;
        }

        .action-small:hover {
            border-color: #0f766e;
            color: #0f766e;
        }

        /* ROOMS */

        .room-list {
            padding: 12px 20px 18px;
        }

        .room {
            margin-bottom: 15px;
        }

        .room:last-child {
            margin-bottom: 0;
        }

        .room-title {
            display: flex;
            justify-content: space-between;
            margin-bottom: 7px;
        }

        .room-title strong {
            font-size: 11px;
        }

        .room-title span {
            color: #94a3b8;
            font-size: 10px;
        }

        .beds {
            display: flex;
            gap: 7px;
        }

        .bed {
            flex: 1;
            padding: 8px;
            border-radius: 7px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            font-size: 10px;
        }

        .bed.occupied {
            background: #f0fdfa;
            border-color: #99f6e4;
        }

        .bed.disconnected {
            background: #fff7ed;
            border-color: #fed7aa;
        }

        .bed-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .bed-number {
            font-weight: 700;
        }

        .bed-status {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #10b981;
        }

        .disconnected .bed-status {
            background: #f97316;
        }

        .bed-name {
            color: #64748b;
            font-size: 9px;
        }

        /* =========================
           TABLE
        ========================= */

        .toolbar {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
        }

        .search {
            position: relative;
            width: 280px;
        }

        .search input {
            width: 100%;
            height: 38px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0 12px 0 35px;
            outline: none;
            font-size: 12px;
        }

        .search svg {
            position: absolute;
            left: 11px;
            top: 11px;
            color: #94a3b8;
        }

        .primary-button {
            border: 0;
            background: #0f766e;
            color: white;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 11px;
            font-weight: 600;
        }

        .primary-button:hover {
            background: #115e59;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }

        th {
            background: #f8fafc;
            color: #64748b;
            font-size: 10px;
            font-weight: 600;
            text-align: left;
            padding: 13px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 14px 15px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 11px;
            color: #475569;
        }

        tr:last-child td {
            border-bottom: 0;
        }

        .patient-name {
            color: #334155;
            font-weight: 600;
        }

        .history-report-link {
            display: inline-block;
            padding: 6px 9px;
            border: 1px solid #99e4d8;
            border-radius: 7px;
            color: #0f665f;
            background: #effbf8;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
        }

        .history-report-link:hover,
        .history-report-link:focus-visible {
            background: #ccfbef;
            text-decoration: underline;
        }

        .actions {
            display: flex;
            gap: 5px;
        }

        .icon-button {
            width: 29px;
            height: 29px;
            border-radius: 7px;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
        }

        .icon-button:hover {
            color: #0f766e;
            border-color: #99f6e4;
        }

        /* =========================
           ROOMS PAGE
        ========================= */

        .room-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .room-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 17px;
        }

        .room-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .room-card-header strong {
            font-size: 14px;
        }

        .floor {
            font-size: 10px;
            color: #94a3b8;
        }

        /* =========================
           MODAL
        ========================= */

        .modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 500;
            background: rgba(15,23,42,.45);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal.show {
            display: flex;
        }

        .modal-box {
            width: 100%;
            max-width: 470px;
            background: white;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 25px 70px rgba(15,23,42,.18);
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .modal-header h3 {
            margin: 0;
            font-family: 'DM Sans', sans-serif;
            font-size: 18px;
        }

        .close-modal {
            border: 0;
            background: #f1f5f9;
            width: 30px;
            height: 30px;
            border-radius: 7px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            font-size: 11px;
            font-weight: 600;
            color: #475569;
        }

        .field input,
        .field select,
        .field textarea {
            height: 40px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0 10px;
            outline: none;
            font-size: 12px;
        }

        .field textarea {
            height: auto;
            padding: 10px;
            resize: vertical;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: #0f766e;
        }

        .modal-footer {
            margin-top: 22px;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
        }

        .patient-editor .modal-box { max-width:820px; max-height:94vh; display:flex; flex-direction:column; padding:0; overflow:hidden; border:1px solid #dce7ee; }
        .patient-editor .modal-header { flex-shrink:0; margin:0; padding:17px 22px; color:white; background:linear-gradient(115deg,#102a43,#176b73); }
        .patient-editor .modal-header h3 { color:white; font-size:17px; }
        .patient-editor .modal-header p { margin:4px 0 0; color:#d0e5e8; font-size:11px; }
        .patient-editor .close-modal { color:white; background:#ffffff24; font-size:19px; }
        .patient-editor #modalFields { display:block; overflow:auto; padding:18px 22px; }
        .patient-editor .patient-form-section { margin-bottom:12px; padding:14px; border:1px solid #e3eaf0; border-radius:12px; background:linear-gradient(135deg,#fff,#f8fbfd); }
        .patient-editor .patient-section-heading { display:flex; align-items:center; gap:9px; margin-bottom:12px; }
        .patient-editor .patient-section-icon { display:grid; place-items:center; width:30px; height:30px; border-radius:9px; color:#116b70; background:#e7f5f3; font-size:14px; }
        .patient-editor .patient-section-heading h4 { margin:0; color:#183349; font-size:12px; }
        .patient-editor .patient-section-heading p { margin:3px 0 0; color:#8290a1; font-size:10px; }
        .patient-editor .patient-section-grid { display:grid; grid-template-columns:1fr 1fr; gap:11px; }
        .patient-editor .field { gap:5px; }
        .patient-editor .field label { color:#40566b; font-size:10px; }
        .patient-editor .field input,.patient-editor .field select,.patient-editor .field textarea { background:#fff; border-color:#dce5ec; }
        .patient-editor .field textarea { min-height:67px; }
        .patient-editor .modal-footer { flex-shrink:0; margin:0; padding:13px 22px; border-top:1px solid #e8eef3; background:#f8fafc; }
        .patient-editor .patient-device-note { color:#6f8294; font-size:10px; line-height:1.5; }
        .modal.report-modal .modal-box { max-width:500px; max-height:94vh; padding:0; overflow:hidden; }
        .report-modal .modal-header { margin:0; padding:15px 19px; color:#fff; background:#10263d; }
        .report-modal .modal-header h3 { color:#fff; font-size:14px; }
        .report-modal .modal-header p { margin:4px 0 0; color:#c7d2df; font-size:9px; }
        .report-modal .close-modal { color:#d5dee7; background:transparent; font-size:22px; }
        .report-modal #modalFields { display:block; max-height:calc(94vh - 135px); overflow:auto; padding:16px 19px; }
        .report-summary { display:flex; align-items:center; justify-content:space-between; gap:10px; margin-bottom:16px; padding:11px 12px; border:1px solid #e4ebf2; border-radius:10px; background:#f5f8fb; }
        .report-summary strong { color:#31475e; font-size:10px; }
        .report-summary span { display:block; margin-top:4px; color:#667b91; font-size:9px; }
        .report-summary-time { text-align:right; white-space:nowrap; }
        .report-summary-time strong { color:#d61c2c; }
        .report-field-title { display:block; margin:14px 0 8px; color:#52657a; font-size:9px; font-weight:800; letter-spacing:.07em; text-transform:uppercase; }
        .report-severity { display:grid; grid-template-columns:repeat(3,1fr); gap:7px; }
        .report-severity button { padding:8px 6px; border:1px solid #dbe3ec; border-radius:8px; color:#52657a; background:#fff; font-size:10px; font-weight:700; }
        .report-severity button.selected[data-value="stable"] { border-color:#169c6d; color:#fff; background:#169c6d; }
        .report-severity button.selected[data-value="moderate"] { border-color:#f59e0b; color:#fff; background:#f59e0b; }
        .report-severity button.selected[data-value="critical"] { border-color:#e11d31; color:#fff; background:#e11d31; }
        .report-symptoms { display:grid; grid-template-columns:1fr 1fr; gap:6px; max-height:184px; overflow:auto; padding-right:4px; }
        .report-symptom { display:flex; align-items:center; gap:7px; min-height:31px; padding:7px 9px; border:1px solid #dce5ee; border-radius:8px; color:#52657a; background:#fff; font-size:9px; cursor:pointer; }
        .report-symptom:has(input:checked) { border-color:#ef8990; color:#a61e2d; background:#fff4f4; }
        .report-symptom input { accent-color:#dc3545; }
        .report-custom-symptom { display:flex; gap:7px; margin-top:7px; }
        .report-custom-symptom input { flex:1; min-width:0; height:34px; padding:7px 9px; border:1px solid #dbe3ec; border-radius:8px; font-size:10px; }
        .report-custom-symptom button { border:0; border-radius:8px; padding:0 11px; color:#40566b; background:#edf2f6; font-size:9px; font-weight:700; }
        .report-notes { width:100%; min-height:76px; padding:9px 10px; border:1px solid #dbe3ec; border-radius:8px; font-size:10px; resize:vertical; }
        .report-modal .modal-footer { margin:0; padding:12px 18px; border-top:1px solid #e9eef3; background:#f8fafc; }

        .room-editor .modal-box { width:100%; max-width:710px; max-height:94vh; padding:0; overflow:hidden; display:flex; flex-direction:column; border:1px solid #dce7ee; }
        .room-editor .modal-header { margin:0; padding:23px 26px; background:#102c40; }
        .room-editor .modal-header h3 { color:#fff; font-size:20px; }
        .room-editor .modal-header p { margin:6px 0 0; color:#bed2dd; font-size:12px; line-height:1.5; }
        .room-editor .close-modal { color:#dce9ef; background:#ffffff12; border-radius:8px; width:32px; height:32px; }
        .room-editor #modalFields { display:block; overflow-y:auto; padding:24px 26px; }
        .room-form-section + .room-form-section { margin-top:24px; padding-top:22px; border-top:1px solid #e5edf1; }
        .room-form-section h4 { margin:0 0 14px; color:#17384e; font-size:14px; }
        .room-field-grid { display:grid; grid-template-columns:1fr 1fr; gap:15px; }
        .room-editor .field { display:flex; flex-direction:column; gap:7px; }
        .room-editor .field label { font-size:12px; color:#40576b; }
        .room-editor .field input,.room-editor .field select { width:100%; height:44px; font-size:13px; background:#fff; }
        .room-editor input:focus-visible,.room-editor select:focus-visible { outline:3px solid #0f766e25; outline-offset:1px; border-color:#0f766e; }
        .room-bed-fields { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:12px; margin-top:17px; }
        .room-preview { margin-top:22px; padding:17px; border:1px solid #cce6e1; border-radius:12px; background:#f2faf8; }
        .room-preview-title { display:flex; align-items:center; justify-content:space-between; gap:10px; margin-bottom:12px; color:#18453f; font-size:13px; }
        .room-preview-title span { font-size:11px; color:#56776f; }
        .room-preview-beds { display:flex; flex-wrap:wrap; gap:7px; }
        .room-preview-beds span { padding:8px 11px; border-radius:7px; background:white; border:1px solid #d5e8e3; color:#35665b; font-size:12px; overflow-wrap:anywhere; max-width:100%; }
        .room-help { margin:10px 0 0; color:#718595; font-size:11px; line-height:1.6; }
        .room-form-error { margin:0 0 18px; padding:12px; color:#a51d32; background:#fff0f1; border-radius:8px; font-size:12px; }
        .room-editor .modal-footer { margin:0; padding:16px 26px; border-top:1px solid #e5edf1; background:#f8fafc; }
        .room-editor .modal-footer button { min-height:42px; padding:0 18px; font-size:12px; }
        .rooms-status { margin:0 0 16px; color:#0f766e; font-size:12px; }
        .rooms-status:empty { display:none; }
        .room-empty { color:#64748b; font-size:13px; }
        @media(max-width:600px) {
            .room-editor .modal-header,.room-editor #modalFields,.room-editor .modal-footer { padding:18px; }
            .room-field-grid { grid-template-columns:1fr; }
            .room-bed-fields { grid-template-columns:repeat(2,minmax(0,1fr)); }
            .room-editor .modal-footer button { flex:1; padding:0 10px; }
        }

        .system-settings { max-width:1040px; margin:0 auto; }
        .settings-intro,.settings-card { border:1px solid #dfe7ee; border-radius:14px; background:#fff; box-shadow:0 4px 12px #15263b08; }
        .settings-intro { display:flex; align-items:center; justify-content:space-between; gap:16px; margin-bottom:18px; padding:20px; }
        .settings-kicker { display:inline-block; margin-bottom:7px; padding:5px 8px; border-radius:6px; color:#17446b; background:#eef4fa; font-size:9px; font-weight:800; letter-spacing:.07em; }
        .settings-intro h2 { margin:0; color:#102a43; font:800 21px 'DM Sans',sans-serif; }
        .settings-intro p { margin:5px 0 0; color:#718195; font-size:11px; }
        .settings-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
        .settings-card { padding:18px; }
        .settings-card.full { grid-column:1/-1; }
        .settings-card h3 { display:flex; align-items:center; gap:9px; margin:0 0 15px; padding-bottom:12px; border-bottom:1px solid #edf1f5; color:#173957; font:700 14px 'DM Sans',sans-serif; }
        .settings-card h3 span { font-size:16px; }
        .setting-row { display:flex; align-items:center; justify-content:space-between; gap:14px; padding:8px 0; }
        .setting-row strong { display:block; color:#334a61; font-size:11px; }
        .setting-row small { display:block; margin-top:4px; color:#8290a1; font-size:9px; }
        .setting-label { display:block; margin:10px 0 6px; color:#52657a; font-size:10px; font-weight:600; }
        .settings-card input[type="text"],.settings-card select { width:100%; height:38px; padding:0 10px; border:1px solid #dbe3ec; border-radius:8px; color:#31475e; background:#fff; font:11px Inter,Arial,sans-serif; }
        .setting-volume { display:flex; align-items:center; gap:10px; margin-top:10px; }
        .setting-volume input { flex:1; accent-color:#173957; }
        .setting-volume output { min-width:32px; color:#52657a; text-align:right; font-size:10px; }
        .settings-test { width:100%; margin-top:13px; padding:9px 12px; border:0; border-radius:8px; color:#334a61; background:#eff3f7; font-size:10px; font-weight:700; }
        .settings-note { margin-top:12px; color:#8a98a8; font-size:9px; }

        .secondary-button {
            border: 1px solid #e2e8f0;
            background: white;
            padding: 9px 14px;
            border-radius: 8px;
            font-size: 11px;
        }

        /* =========================
           MOBILE
        ========================= */

        @media(max-width:1100px) {

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .room-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width:750px) {

            .modal.patient-editor { padding:8px; }
            .patient-editor .modal-box { max-height:96vh; }
            .patient-editor #modalFields { padding:13px; }
            .patient-editor .patient-section-grid { grid-template-columns:1fr; }
            .patient-editor .patient-section-grid .field.full { grid-column:auto; }
            .report-modal #modalFields { padding:13px; }
            .settings-grid { grid-template-columns:1fr; }
            .settings-card.full { grid-column:auto; }
            .settings-intro { align-items:flex-start; flex-direction:column; }

            .emergency-details { grid-template-columns:1fr; }
            .emergency-medicines { grid-template-columns:1fr; }
            .emergency-call-foot { align-items:flex-start; flex-direction:column; }

            .sidebar {
                transform: translateX(-100%);
                box-shadow: 10px 0 30px rgba(15,23,42,.08);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                padding: 0 16px;
            }

            .mobile-menu {
                display: block;
                margin-right: 12px;
            }

            .page-title h1 {
                font-size: 17px;
            }

            .content {
                padding: 20px 15px;
            }

            .cards {
                grid-template-columns: 1fr 1fr;
                gap: 10px;
            }

            .stat-card {
                padding: 14px;
            }

            .stat-value {
                font-size: 23px;
            }

            .toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search {
                width: 100%;
            }

            .room-grid {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .field.full {
                grid-column: auto;
            }
        }

        @media(max-width:450px) {

            .cards {
                grid-template-columns: 1fr;
            }

            .top-actions {
                display: none;
            }

            .report-symptoms { grid-template-columns:1fr; }
            .settings-intro h2 { font-size:17px; }

            .alert-row {
                padding: 13px 12px;
            }
        }

    </style>

</head>


<body>

<div class="app">

    <!-- SIDEBAR -->

    <aside class="sidebar" id="sidebar">

        <div class="sidebar-logo">

            <div class="logo-mark">
                <img src="{{ asset('images/sos-connect.png') }}" alt="SOS Connect" style="width:100%;height:100%;object-fit:contain;border-radius:inherit;background:#fff;">
            </div>

            <div>
                <strong>SOS Connect</strong>
                <span>Gestión hospitalaria</span>
            </div>

        </div>


        <nav class="sidebar-nav">

            <div class="nav-label">Principal</div>

            <button class="nav-item active" onclick="showSection('dashboard', this)">
                <span class="nav-icon">▦</span>
                Inicio
            </button>

            <button class="nav-item" onclick="showSection('alerts', this)">
                <span class="nav-icon">♢</span>
                Alertas
            </button>

            <button class="nav-item" onclick="showSection('patients', this)">
                <span class="nav-icon">♙</span>
                Pacientes
            </button>

            <button class="nav-item" onclick="showSection('rooms', this)">
                <span class="nav-icon">▣</span>
                Habitaciones
            </button>

            <button class="nav-item" onclick="showSection('history', this)">
                <span class="nav-icon">◷</span>
                Historial
            </button>

            <button class="nav-item" onclick="showSection('settings', this)">
                <span class="nav-icon">⚙</span>
                Configuración
            </button>

            <div class="nav-label" style="margin-top:20px;">Mi cuenta</div>

            <a class="nav-item" href="{{ route('profile.edit') }}" target="_blank" rel="noopener" title="Abrir Perfil en otra pestaña y mantener las alertas activas">
                <span class="nav-icon" aria-hidden="true">♙</span>
                Perfil
            </a>

            <a class="nav-item" href="{{ route('security.edit') }}" target="_blank" rel="noopener" title="Abrir Seguridad en otra pestaña y mantener las alertas activas">
                <span class="nav-icon" aria-hidden="true">⚿</span>
                Seguridad
            </a>


            @if(auth()->check() && auth()->user()->role === 'admin')

                <div class="nav-label" style="margin-top:25px;">
                    Administración
                </div>

                <a class="nav-item" href="{{ route('admin.users.index') }}" target="_blank" rel="noopener" title="Abrir administración de usuarios en otra pestaña">
                    <span class="nav-icon">♙</span>
                    Usuarios
                </a>

            @endif

        </nav>


        <div class="sidebar-bottom">

            <div class="profile">

                <div class="avatar">

                    {{ strtoupper(substr(auth()->user()->name ?? 'US', 0, 2)) }}

                </div>

                <div class="profile-info">

                    <div class="profile-name">
                        {{ auth()->user()->name ?? 'Usuario' }}
                    </div>

                    <div class="profile-role">
                        {{ ucfirst(auth()->user()->role ?? 'Usuario') }}
                    </div>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="logout-button" title="Cerrar sesión">
                        ↪
                    </button>

                </form>

            </div>

        </div>

    </aside>


    <!-- MAIN -->

    <main class="main">

        <header class="topbar">

            <div style="display:flex;align-items:center;">

                <button
                    class="mobile-menu"
                    onclick="toggleSidebar()"
                >
                    ☰
                </button>

                <div class="page-title">

                    <h1 id="pageTitle">
                        Inicio
                    </h1>

                    <p id="pageSubtitle">
                        Resumen general del sistema
                    </p>

                </div>

            </div>


            <div class="top-actions">

                <button class="notification" id="soundToggle" type="button" aria-label="Estado de la alarma" title="Estado de la alarma">

                    🔔

                    <span class="notification-dot"></span>

                </button>

            </div>

        </header>


        <div class="content">
            <p id="alarmAudioStatus" class="alarm-audio-status" role="status" aria-live="polite"></p>


            <!-- ================= DASHBOARD ================= -->

            <section class="section active" id="dashboard">

                <div id="dashboardEmergencyCards" class="emergency-calls" aria-live="assertive"></div>

                <div class="cards">

                    <div class="stat-card">

                        <div class="stat-top">

                            <span class="stat-label">
                                Alertas activas
                            </span>

                            <div class="stat-icon">
                                ♢
                            </div>

                        </div>

                        <div class="stat-value" id="dashboardAlertCount">
                            0
                        </div>

                        <div class="stat-description">
                            Requieren atención
                        </div>

                    </div>


                    <div class="stat-card">

                        <div class="stat-top">

                            <span class="stat-label">
                                Pacientes
                            </span>

                            <div class="stat-icon">
                                ♙
                            </div>

                        </div>

                        <div class="stat-value" id="dashboardPatientCount">
                            {{ $patients->count() }}
                        </div>

                        <div class="stat-description">
                            Pacientes hospitalizados
                        </div>

                    </div>


                    <div class="stat-card">

                        <div class="stat-top">

                            <span class="stat-label">
                                Camas ocupadas
                            </span>

                            <div class="stat-icon">
                                ▣
                            </div>

                        </div>

                        <div class="stat-value" id="dashboardOccupiedBedCount">
                            {{ $patients->count() }}
                        </div>

                        <div class="stat-description">
                            De 14 camas disponibles
                        </div>

                    </div>


                    <div class="stat-card">

                        <div class="stat-top">

                            <span class="stat-label">
                                Dispositivos
                            </span>

                            <div class="stat-icon">
                                ◉
                            </div>

                        </div>

                        <div class="stat-value" id="dashboardDeviceCount">
                            {{ $patients->whereNotNull('device_id')->count() }}
                        </div>

                        <div class="stat-description">
                            Botones asignados a una cama
                        </div>

                    </div>

                </div>


                <div class="dashboard-grid">


                    <!-- ALERTAS -->

                    <div class="panel">

                        <div class="panel-header">

                            <h2>Alertas recientes</h2>

                            <span>Últimas alertas</span>

                        </div>


                        <div class="alert-list">
                            <div class="alert-row"><div class="alert-main"><div class="alert-meta">Cargando alertas…</div></div></div>
                        </div>

                    </div>


                    <!-- HABITACIONES -->

                    <div class="panel">

                        <div class="panel-header">

                            <h2>Estado de habitaciones</h2>

                            <span>Planta actual</span>

                        </div>


                        <div class="room-list">


                            <div class="room">

                                <div class="room-title">

                                    <strong>Habitación 301</strong>

                                    <span>2/3 ocupadas</span>

                                </div>

                                <div class="beds">

                                    <div class="bed occupied">

                                        <div class="bed-top">
                                            <span class="bed-number">A</span>
                                            <span class="bed-status"></span>
                                        </div>

                                        <div class="bed-name">
                                            Carlos Mendoza
                                        </div>

                                    </div>


                                    <div class="bed">

                                        <div class="bed-top">
                                            <span class="bed-number">B</span>
                                            <span class="bed-status"></span>
                                        </div>

                                        <div class="bed-name">
                                            Disponible
                                        </div>

                                    </div>


                                    <div class="bed">

                                        <div class="bed-top">
                                            <span class="bed-number">C</span>
                                            <span class="bed-status"></span>
                                        </div>

                                        <div class="bed-name">
                                            Disponible
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="room">

                                <div class="room-title">

                                    <strong>Habitación 302</strong>

                                    <span>1/2 ocupadas</span>

                                </div>

                                <div class="beds">

                                    <div class="bed">

                                        <div class="bed-top">
                                            <span class="bed-number">A</span>
                                            <span class="bed-status"></span>
                                        </div>

                                        <div class="bed-name">
                                            Disponible
                                        </div>

                                    </div>


                                    <div class="bed occupied">

                                        <div class="bed-top">
                                            <span class="bed-number">B</span>
                                            <span class="bed-status"></span>
                                        </div>

                                        <div class="bed-name">
                                            Ana Lucía Torres
                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="room">

                                <div class="room-title">

                                    <strong>Habitación 305</strong>

                                    <span>1/2 ocupadas</span>

                                </div>

                                <div class="beds">

                                    <div class="bed disconnected">

                                        <div class="bed-top">
                                            <span class="bed-number">A</span>
                                            <span class="bed-status"></span>
                                        </div>

                                        <div class="bed-name">
                                            Desconectada
                                        </div>

                                    </div>


                                    <div class="bed occupied">

                                        <div class="bed-top">
                                            <span class="bed-number">B</span>
                                            <span class="bed-status"></span>
                                        </div>

                                        <div class="bed-name">
                                            Carmen Ortiz
                                        </div>

                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </section>


            <!-- ================= ALERTAS ================= -->

            <section class="section" id="alerts">

                <div class="toolbar">

                    <div class="search">

                        <span>⌕</span>

                        <input
                            type="text"
                            placeholder="Buscar alerta..."
                            onkeyup="filterTable(this, 'alertsTable')"
                        >

                    </div>

                </div>


                <div id="activeEmergencyCards" class="emergency-calls" aria-live="assertive"></div>


                <div class="table-wrapper">

                    <table id="alertsTable">

                        <thead>

                            <tr>
                                <th>Paciente</th>
                                <th>Habitación</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Atendido por</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td class="patient-name">Carlos Mendoza</td>
                                <td>301 - A</td>
                                <td>08:14</td>
                                <td>
                                    <span class="status status-pending">
                                        Pendiente
                                    </span>
                                </td>
                                <td>-</td>
                                <td>
                                    <button class="action-small" onclick="openModal('Atender alerta')">
                                        Atender
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="patient-name">Ana Lucía Torres</td>
                                <td>302 - B</td>
                                <td>08:22</td>
                                <td>
                                    <span class="status status-attending">
                                        En atención
                                    </span>
                                </td>
                                <td>Patricia Soto</td>
                                <td>-</td>
                            </tr>

                            <tr>
                                <td class="patient-name">Roberto Jiménez</td>
                                <td>205 - A</td>
                                <td>07:55</td>
                                <td>
                                    <span class="status status-pending">
                                        Pendiente
                                    </span>
                                </td>
                                <td>-</td>
                                <td>
                                    <button class="action-small" onclick="openModal('Atender alerta')">
                                        Atender
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td class="patient-name">María Elena Vega</td>
                                <td>410 - C</td>
                                <td>07:30</td>
                                <td>
                                    <span class="status status-completed">
                                        Completada
                                    </span>
                                </td>
                                <td>Fernando Rojas</td>
                                <td>-</td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </section>


            <!-- ================= PACIENTES ================= -->

            <section class="section" id="patients">

                <div class="toolbar">

                    <div class="search">

                        <span>⌕</span>

                        <input
                            type="text"
                            placeholder="Buscar paciente..."
                            onkeyup="filterTable(this, 'patientsTable')"
                        >

                    </div>


                    <button
                        class="primary-button"
                        onclick="openPatientModal()"
                    >
                        + Nuevo paciente
                    </button>

                </div>


                <div class="table-wrapper">

                    <table id="patientsTable">

                        <thead>

                            <tr>
                                <th>Paciente</th>
                                <th>Edad</th>
                                <th>Habitación</th>
                                <th>Diagnóstico</th>
                                <th>Ingreso</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>

                        <tbody>
                            @forelse($patients as $patient)
                                <tr>
                                    <td class="patient-name">{{ $patient->name }}@if($patient->device_id)<div class="alert-meta">Pulsador: {{ $patient->device_id }}</div>@endif</td>
                                    <td>{{ $patient->age ?? '—' }}</td>
                                    <td>{{ $patient->room }} - {{ $patient->bed }}</td>
                                    <td>{{ $patient->diagnosis ?: '—' }}</td>
                                    <td>{{ $patient->admitted_at?->format('d/m/Y') ?? '—' }}</td>
                                    <td><button class="action-small" type="button" onclick="openPatientModal({{ $patient->id }})">Editar ficha</button></td>
                                </tr>
                            @empty
                                <tr><td colspan="6">Aún no hay pacientes. Usa “+ Nuevo paciente” para registrar uno y asignar su pulsador.</td></tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>


            <!-- ================= HABITACIONES ================= -->

            <section class="section" id="rooms">

                <div class="toolbar">

                    <div>
                        <strong style="font-size:14px;">
                            Habitaciones
                        </strong>

                        <div style="font-size:10px;color:#94a3b8;margin-top:4px;">
                            Estado de camas y dispositivos
                        </div>
                    </div>

                    <button
                        class="primary-button"
                        onclick="openRoomModal()"
                    >
                        + Nueva habitación
                    </button>

                </div>


                <p id="roomsStatus" role="status" aria-live="polite" class="rooms-status"></p>
                <div class="room-grid" id="roomGrid"></div>

            </section>


            <!-- ================= HISTORIAL ================= -->

            <section class="section" id="history">

                <div class="toolbar">

                    <div class="search">

                        <span>⌕</span>

                        <input
                            type="text"
                            placeholder="Buscar en historial..."
                            onkeyup="filterTable(this, 'historyTable')"
                        >

                    </div>

                </div>


                <div class="table-wrapper">

                    <table id="historyTable">

                        <thead>

                            <tr>
                                <th>Fecha</th>
                                <th>Paciente</th>
                                <th>Habitación</th>
                                <th>Atendido por</th>
                                <th>Hora atención</th>
                                <th>Notas</th>
                                <th>Reporte detallado</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td>05/09/2026</td>
                                <td class="patient-name">María Elena Vega</td>
                                <td>410 - C</td>
                                <td>Dr. Fernando Rojas</td>
                                <td>07:48</td>
                                <td>Cambio de medicación.</td>
                            </tr>

                            <tr>
                                <td>05/09/2026</td>
                                <td class="patient-name">Carmen Ortiz</td>
                                <td>305 - B</td>
                                <td>Enf. Patricia Soto</td>
                                <td>07:10</td>
                                <td>Dificultad para respirar.</td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </section>


            <!-- ================= CONFIGURACION ================= -->

            <section class="section" id="settings">
                <div class="system-settings">
                    <div class="settings-intro">
                        <div>
                            <span class="settings-kicker">AJUSTES DEL SISTEMA</span>
                            <h2>Configuración de SOS CONNECT</h2>
                            <p>Personaliza la alarma sonora, el turno activo y las extensiones de guardia.</p>
                        </div>
                        <button type="button" class="primary-button" id="saveSettings">Guardar cambios</button>
                    </div>

                    <div class="settings-grid">
                        <section class="settings-card">
                            <h3><span>🔔</span> Alertas sonoras y visuales</h3>
                            <p class="room-help">La alarma suena automáticamente mientras haya llamadas pendientes. Se detiene al atenderlas.</p>
                            <label class="setting-label" for="sirenVolume">Volumen de la alarma <output id="sirenVolumeValue">85%</output></label>
                            <div class="setting-volume"><span>🔈</span><input id="sirenVolume" type="range" min="10" max="100" value="85"><span>🔊</span></div>
                            <label class="setting-label" for="alarmTone">Tono de alarma</label>
                            <select id="alarmTone">
                                <option value="soft">Sirena suave de dos tonos</option>
                                <option value="beeps">Tres pitidos cortos</option>
                                <option value="chime">Campanilla suave</option>
                                <option value="original" selected>Sirena original</option>
                            </select>
                            <button type="button" class="settings-test" id="testSiren">🔊 Probar tono de alarma</button>
                        </section>

                        <section class="settings-card">
                            <h3><span>🧑‍⚕️</span> Turno y personal de guardia</h3>
                            <label class="setting-label" for="activeStaff">Usuario en turno activo</label>
                            <input id="activeStaff" type="text" value="{{ $user->name }}" readonly>
                            <label class="setting-label" for="activeShift">Horario de turno</label>
                            <select id="activeShift">
                                <option value="Mañana (07:00 - 15:00)">Mañana (07:00 - 15:00)</option>
                                <option value="Tarde (15:00 - 23:00)">Tarde (15:00 - 23:00)</option>
                                <option value="Noche (23:00 - 07:00)">Noche (23:00 - 07:00)</option>
                            </select>
                        </section>

                    </div>
                    <p class="settings-note" id="settingsSaved" role="status" aria-live="polite"></p>
                </div>
            </section>


            <!-- ================= USUARIOS ================= -->

            <section class="section" id="users">

                <div class="toolbar">

                    <div class="search">

                        <span>⌕</span>

                        <input
                            type="text"
                            placeholder="Buscar usuario..."
                            onkeyup="filterTable(this, 'usersTable')"
                        >

                    </div>

                    <button
                        class="primary-button"
                        onclick="openModal('Nuevo usuario')"
                    >
                        + Nuevo usuario
                    </button>

                </div>


                <div class="table-wrapper">

                    <table id="usersTable">

                        <thead>

                            <tr>
                                <th>Usuario</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Último acceso</th>
                                <th>Acciones</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td class="patient-name">
                                    Administrador Sistema
                                </td>

                                <td>
                                    admin@sosconnect.hn
                                </td>

                                <td>
                                    Administrador
                                </td>

                                <td>
                                    <span class="status status-completed">
                                        Activo
                                    </span>
                                </td>

                                <td>
                                    05/09/2026 08:10
                                </td>

                                <td>
                                    <div class="actions">

                                        <button
                                            class="icon-button"
                                            onclick="openModal('Editar usuario')"
                                        >
                                            ✎
                                        </button>

                                    </div>
                                </td>

                            </tr>


                            <tr>

                                <td class="patient-name">
                                    Enf. Patricia Soto
                                </td>

                                <td>
                                    p.soto@sosconnect.hn
                                </td>

                                <td>
                                    Enfermería
                                </td>

                                <td>
                                    <span class="status status-completed">
                                        Activo
                                    </span>
                                </td>

                                <td>
                                    05/09/2026 06:55
                                </td>

                                <td>
                                    <div class="actions">

                                        <button
                                            class="icon-button"
                                            onclick="openModal('Editar usuario')"
                                        >
                                            ✎
                                        </button>

                                    </div>
                                </td>

                            </tr>


                            <tr>

                                <td class="patient-name">
                                    Dr. Fernando Rojas
                                </td>

                                <td>
                                    f.rojas@sosconnect.hn
                                </td>

                                <td>
                                    Médico
                                </td>

                                <td>
                                    <span class="status status-completed">
                                        Activo
                                    </span>
                                </td>

                                <td>
                                    05/09/2026 07:40
                                </td>

                                <td>
                                    <div class="actions">

                                        <button
                                            class="icon-button"
                                            onclick="openModal('Editar usuario')"
                                        >
                                            ✎
                                        </button>

                                    </div>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </section>


        </div>

    </main>

</div>


<!-- MODAL -->

<div class="modal" id="modal">

    <div class="modal-box">

        <div class="modal-header">
            <div class="modal-heading">
                <h3 id="modalTitle">Nuevo registro</h3>
                <p id="modalSubtitle" hidden></p>
            </div>

            <button
                class="close-modal"
                onclick="closeModal()"
            >
                ×
            </button>

        </div>


        <div class="form-grid" id="modalFields">

            <div class="field">

                <label>Nombre</label>

                <input type="text" placeholder="Nombre">

            </div>


            <div class="field">

                <label>Apellido</label>

                <input type="text" placeholder="Apellido">

            </div>


            <div class="field full">

                <label>Correo electrónico</label>

                <input
                    type="email"
                    placeholder="correo@ejemplo.com"
                >

            </div>


            <div class="field">

                <label>Habitación</label>

                <input
                    type="text"
                    placeholder="Ej. 301"
                >

            </div>


            <div class="field">

                <label>Cama</label>

                <select>

                    <option>A</option>
                    <option>B</option>
                    <option>C</option>

                </select>

            </div>

        </div>


        <div class="modal-footer">

            <button
                class="secondary-button"
                onclick="closeModal()"
            >
                Cancelar
            </button>

            <button
                class="primary-button"
                id="modalSaveButton"
                onclick="saveModal()"
            >
                Guardar
            </button>

        </div>

    </div>

</div>


<script>

    const pageInfo = {

        dashboard: {
            title: 'Inicio',
            subtitle: 'Resumen general del sistema'
        },

        alerts: {
            title: 'Alertas',
            subtitle: 'Gestión de alertas de atención'
        },

        patients: {
            title: 'Pacientes',
            subtitle: 'Pacientes actualmente hospitalizados'
        },

        rooms: {
            title: 'Habitaciones',
            subtitle: 'Estado de habitaciones y camas'
        },

        history: {
            title: 'Historial',
            subtitle: 'Registro histórico de atenciones'
        },

        settings: {
            title: 'Configuración',
            subtitle: 'Preferencias de sirena y turnos'
        },

        users: {
            title: 'Usuarios',
            subtitle: 'Administración de usuarios del sistema'
        }

    };


    function showSection(section, button) {

        document
            .querySelectorAll('.section')
            .forEach(element => {
                element.classList.remove('active');
            });


        const selected = document.getElementById(section);

        if (selected) {
            selected.classList.add('active');
        }


        document
            .querySelectorAll('.nav-item')
            .forEach(element => {
                element.classList.remove('active');
            });


        if (button) {
            button.classList.add('active');
        }


        document.getElementById('pageTitle').textContent =
            pageInfo[section]?.title || 'Inicio';


        document.getElementById('pageSubtitle').textContent =
            pageInfo[section]?.subtitle || '';


        if (window.innerWidth <= 750) {
            document
                .getElementById('sidebar')
                .classList.remove('open');
        }

    }


    function toggleSidebar() {

        document
            .getElementById('sidebar')
            .classList.toggle('open');

    }


    let modalAction = null;
    let dashboardPatients = @json($patients->values());
    let dashboardRooms = @json($rooms->values());
    const dashboardStaff = @json($staff->map(fn ($person) => ['id' => $person->id, 'name' => $person->name, 'role' => $person->role])->values());
    let currentAlertsCache = [];
    const currentAttendingName = @json($user->name);

    function openModal(title) {
        modalAction = null;
        document.getElementById('modal').classList.remove('patient-editor', 'report-modal', 'room-editor');
        document.getElementById('modalSubtitle').hidden = true;
        document.getElementById('modalSaveButton').textContent = 'Guardar';

        document
            .getElementById('modalTitle')
            .textContent = title;

        document
            .getElementById('modal')
            .classList.add('show');

    }


    function closeModal() {
        document.getElementById('modalSaveButton').disabled = false;

        document
            .getElementById('modal')
            .classList.remove('show');
        document.getElementById('modal').classList.remove('patient-editor', 'report-modal', 'room-editor');

    }


    function saveModal() {
        if (modalAction?.type === 'room') {
            saveRoom();
            return;
        }
        if (modalAction?.type === 'patient') {
            savePatient();
            return;
        }

        if (modalAction?.type === 'report') {
            saveAlertReport(modalAction.alertId);
            return;
        }

        closeModal();
    }

    function openRoomModal() {
        openModal('Nueva habitación');
        modalAction = { type: 'room', saving: false };
        const modal = document.getElementById('modal');
        modal.classList.add('room-editor');
        document.getElementById('modalSubtitle').textContent = 'Define su ubicación y las camas que tendrá disponibles.';
        document.getElementById('modalSubtitle').hidden = false;
        const saveButton = document.getElementById('modalSaveButton');
        saveButton.textContent = 'Crear habitación';
        saveButton.disabled = false;
        document.getElementById('modalFields').innerHTML = `
            <p id="roomFormError" class="room-form-error" role="alert" hidden></p>
            <section class="room-form-section">
                <h4>Ubicación de la habitación</h4>
                <div class="room-field-grid">
                    <div class="field"><label for="roomNumber">Número o nombre de habitación</label><input id="roomNumber" type="text" maxlength="40" placeholder="Ej. 307" required autocomplete="off"></div>
                    <div class="field"><label for="roomFloor">Piso <span>(opcional)</span></label><input id="roomFloor" type="text" maxlength="40" placeholder="Ej. 3 o Planta baja" autocomplete="off"></div>
                </div>
            </section>
            <section class="room-form-section">
                <h4>Camas de la habitación</h4>
                <div class="field"><label for="roomBedCount">Cantidad de camas</label><select id="roomBedCount">${Array.from({length:12}, (_, i) => `<option value="${i+1}" ${i===1?'selected':''}>${i+1} ${i===0?'cama':'camas'}</option>`).join('')}</select></div>
                <div id="roomBedFields" class="room-bed-fields"></div>
                <p class="room-help">Cada cama debe tener un identificador diferente dentro de esta habitación.</p>
            </section>
            <div class="room-preview" aria-label="Vista previa de la habitación">
                <div class="room-preview-title"><strong id="roomPreviewName">Nueva habitación</strong><span id="roomPreviewFloor"></span></div>
                <div id="roomPreviewBeds" class="room-preview-beds"></div>
            </div>
        `;
        document.getElementById('roomBedCount').addEventListener('change', renderRoomBedFields);
        document.getElementById('roomNumber').addEventListener('input', updateRoomPreview);
        document.getElementById('roomFloor').addEventListener('input', updateRoomPreview);
        renderRoomBedFields();
        document.getElementById('roomNumber').focus();
    }

    function renderRoomBedFields() {
        const container = document.getElementById('roomBedFields');
        const previous = Array.from(container.querySelectorAll('input'), input => input.value);
        container.replaceChildren();
        const count = Number(document.getElementById('roomBedCount').value);
        for (let index = 0; index < count; index++) {
            const field = document.createElement('div');
            field.className = 'field';
            const label = document.createElement('label');
            label.htmlFor = `roomBed${index}`;
            label.textContent = `Identificador de cama ${index + 1}`;
            const input = document.createElement('input');
            input.id = label.htmlFor;
            input.value = previous[index] ?? String.fromCharCode(65 + index);
            input.maxLength = 20;
            input.required = true;
            input.addEventListener('input', updateRoomPreview);
            field.append(label, input);
            container.append(field);
        }
        updateRoomPreview();
    }

    function updateRoomPreview() {
        const number = document.getElementById('roomNumber').value.trim();
        const floor = document.getElementById('roomFloor').value.trim();
        document.getElementById('roomPreviewName').textContent = number ? `Habitación ${number}` : 'Nueva habitación';
        document.getElementById('roomPreviewFloor').textContent = floor ? `Piso ${floor}` : '';
        const beds = Array.from(document.querySelectorAll('#roomBedFields input'), input => {
            const label = document.createElement('span');
            label.textContent = `Cama ${input.value.trim() || '…'}`;
            return label;
        });
        document.getElementById('roomPreviewBeds').replaceChildren(...beds);
    }

    async function saveRoom() {
        if (modalAction.saving) return;
        const error = document.getElementById('roomFormError');
        error.hidden = true;
        const fields = document.querySelectorAll('#modalFields input');
        for (const input of fields) {
            if (!input.reportValidity()) return;
        }
        const data = {
            number: document.getElementById('roomNumber').value.trim(),
            floor: document.getElementById('roomFloor').value.trim() || null,
            beds: Array.from(document.querySelectorAll('#roomBedFields input'), input => input.value.trim()),
        };
        const button = document.getElementById('modalSaveButton');
        const action = modalAction;
        action.saving = true;
        button.disabled = true;
        button.textContent = 'Guardando…';
        try {
            const response = await fetch(@json(route('rooms.store')), {
                method:'POST',
                headers:{'Accept':'application/json','Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content},
                body:JSON.stringify(data),
            });
            const result = await response.json();
            if (!response.ok) {
                throw new Error(Object.values(result.errors || {}).flat()[0] || result.message || 'No se pudo guardar la habitación.');
            }
            dashboardRooms.push(result.room);
            renderRooms();
            if (modalAction === action) closeModal();
            document.getElementById('roomsStatus').textContent = `Habitación ${result.room.number} creada correctamente.`;
        } catch (failure) {
            if (modalAction === action && error.isConnected) {
                error.textContent = failure instanceof SyntaxError || failure instanceof TypeError
                    ? 'No se pudo guardar. Revisa la conexión y la sesión e inténtalo de nuevo.'
                    : failure.message;
                error.hidden = false;
            }
        } finally {
            action.saving = false;
            if (modalAction === action) {
                button.disabled = false;
                button.textContent = 'Crear habitación';
            }
        }
    }

    function renderRooms() {
        const roomMap = new Map(dashboardRooms.map(room => [room.number, { ...room, beds:[...room.beds] }]));
        for (const patient of dashboardPatients) {
            const room = roomMap.get(patient.room) || { number:patient.room, floor:null, beds:[] };
            if (!room.beds.includes(patient.bed)) room.beds.push(patient.bed);
            roomMap.set(patient.room, room);
        }
        const grid = document.getElementById('roomGrid');
        grid.replaceChildren();
        const rooms = Array.from(roomMap.values()).sort((a,b) => a.number.localeCompare(b.number, 'es', {numeric:true}));
        for (const room of rooms) {
            const card = infoText('div', 'room-card', '');
            card.replaceChildren();
            const header = document.createElement('div');
            header.className = 'room-card-header';
            header.append(infoText('strong', '', `Habitación ${room.number}`));
            if (room.floor) header.append(infoText('span', 'floor', `Piso ${room.floor}`));
            const beds = document.createElement('div');
            beds.className = 'beds';
            for (const bed of room.beds) {
                const patient = dashboardPatients.find(person => person.room === room.number && person.bed === bed);
                const tile = document.createElement('div');
                tile.className = `bed${patient ? ' occupied' : ''}`;
                const top = document.createElement('div');
                top.className = 'bed-top';
                top.append(infoText('span', 'bed-number', bed), document.createElement('span'));
                tile.append(top, infoText('div', 'bed-name', patient?.name || 'Disponible'));
                beds.append(tile);
            }
            card.append(header, beds);
            grid.append(card);
        }
        if (!rooms.length) grid.append(infoText('p', 'room-empty', 'Todavía no hay habitaciones. Crea la primera para organizar sus camas.'));
    }

    async function pollRooms() {
        try {
            const response = await fetch(@json(route('rooms.index')), {headers:{'Accept':'application/json'}});
            if (!response.ok) return;
            dashboardRooms = await response.json();
            renderRooms();
        } catch (error) {
            console.error('No se pudo actualizar la lista de habitaciones.', error);
        }
    }

    function openPatientModal(patientId = null) {
        const patient = patientId ? dashboardPatients.find(item => Number(item.id) === Number(patientId)) : null;
        modalAction = { type: 'patient', patientId: patient?.id || null };
        document.getElementById('modal').classList.remove('report-modal', 'room-editor');
        document.getElementById('modalTitle').textContent = patient ? 'Editar información del paciente' : 'Nuevo paciente';
        document.getElementById('modalSaveButton').textContent = patient ? 'Guardar cambios' : 'Guardar paciente';
        const modal = document.getElementById('modal');
        modal.classList.add('patient-editor');
        const subtitle = document.getElementById('modalSubtitle');
        subtitle.textContent = patient ? 'Actualiza la ficha clínica y la ubicación de su cama.' : 'Completa la ficha para asociarla al pulsador de una cama.';
        subtitle.hidden = false;
        document.getElementById('modalFields').innerHTML = `
            <section class="patient-form-section"><div class="patient-section-heading"><span class="patient-section-icon">♙</span><div><h4>Identificación del paciente</h4><p>Datos que verá el personal al responder</p></div></div><div class="patient-section-grid">
                <div class="field full"><label for="patientName">Nombre completo</label><input id="patientName" name="name" type="text" maxlength="255" required></div>
                <div class="field"><label for="patientDocument">Documento</label><input id="patientDocument" name="document_id" type="text" maxlength="80"></div>
                <div class="field"><label for="patientAge">Edad</label><input id="patientAge" name="age" type="number" min="0" max="120"></div>
                <div class="field"><label for="patientBlood">Tipo de sangre</label><input id="patientBlood" name="blood_type" type="text" maxlength="8" placeholder="O+"></div>
                <div class="field"><label for="patientAdmission">Fecha de ingreso</label><input id="patientAdmission" name="admitted_at" type="date"></div>
            </div></section>
            <section class="patient-form-section"><div class="patient-section-heading"><span class="patient-section-icon">▣</span><div><h4>Ubicación y atención</h4><p>La cama determina de dónde viene la llamada</p></div></div><div class="patient-section-grid">
                <div class="field"><label for="patientRoom">Habitación</label><input id="patientRoom" name="room" type="text" maxlength="40" required></div>
                <div class="field"><label for="patientBed">Cama</label><input id="patientBed" name="bed" type="text" maxlength="20" required></div>
                <div class="field full"><label for="patientNurse">Personal asignado</label><select id="patientNurse" name="assigned_nurse_id"><option value="">Sin asignar</option>${dashboardStaff.map(person => `<option value="${person.id}">${escapeHtml(person.name)} (${escapeHtml(person.role)})</option>`).join('')}</select></div>
            </div></section>
            <section class="patient-form-section"><div class="patient-section-heading"><span class="patient-section-icon">✚</span><div><h4>Información clínica</h4><p>Diagnóstico, padecimientos y medicamentos</p></div></div><div class="patient-section-grid">
                <div class="field full"><label for="patientDiagnosis">Diagnóstico principal</label><input id="patientDiagnosis" name="diagnosis" type="text" maxlength="255"></div>
                <div class="field full"><label for="patientConditions">Padecimientos, uno por línea</label><textarea id="patientConditions" name="conditions" rows="3" placeholder="Escribe padecimientos confirmados"></textarea></div>
                <div class="field full"><label for="patientMedications">Medicamentos, uno por línea: nombre | dosis | horario</label><textarea id="patientMedications" name="medications" rows="3" placeholder="Medicamento | dosis | horario"></textarea></div>
            </div></section>
            <section class="patient-form-section"><div class="patient-section-heading"><span class="patient-section-icon">⌁</span><div><h4>Contacto y pulsador</h4><p>Asocia un botón exclusivo para esta cama</p></div></div><div class="patient-section-grid">
                <div class="field"><label for="patientContact">Contacto de emergencia</label><input id="patientContact" name="emergency_contact_name" type="text" maxlength="255"></div>
                <div class="field"><label for="patientPhone">Teléfono de emergencia</label><input id="patientPhone" name="emergency_contact_phone" type="text" maxlength="40"></div>
                <div class="field full"><label for="patientDevice">ID único del pulsador ESP32 de esta cama</label><input id="patientDevice" name="device_id" type="text" maxlength="80" placeholder="esp32-boton-1" required><small class="patient-device-note">Debe coincidir exactamente con DEVICE_ID en el ESP32. Cada cama debe tener un ID diferente.</small></div>
            </div></section>
        `;
        const values = {
            patientName: patient?.name, patientDocument: patient?.document_id, patientAge: patient?.age,
            patientBlood: patient?.blood_type, patientRoom: patient?.room, patientBed: patient?.bed,
            patientDiagnosis: patient?.diagnosis, patientConditions: (patient?.conditions || []).join('\n'),
            patientMedications: (patient?.medications || []).map(m => [m.name, m.dose, m.schedule].filter(Boolean).join(' | ')).join('\n'),
            patientAdmission: patient?.admitted_at?.slice(0, 10), patientNurse: patient?.assigned_nurse_id,
            patientContact: patient?.emergency_contact_name, patientPhone: patient?.emergency_contact_phone,
            patientDevice: patient?.device_id,
        };
        Object.entries(values).forEach(([id, value]) => { if (value !== null && value !== undefined) document.getElementById(id).value = value; });
        document.getElementById('modal').classList.add('show');
        document.getElementById('patientName').focus();
    }

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, char => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[char]));
    }

    async function savePatient() {
        const fields = document.querySelectorAll('#modalFields [name]');
        const raw = Object.fromEntries(Array.from(fields, field => [field.name, field.value.trim()]));
        const patient = {
            ...raw,
            age: raw.age || null,
            assigned_nurse_id: raw.assigned_nurse_id || null,
            conditions: raw.conditions.split(/\r?\n/).map(value => value.trim()).filter(Boolean),
            medications: raw.medications.split(/\r?\n/).map(line => {
                const [name, dose = '', schedule = ''] = line.split('|').map(value => value.trim());
                return name ? { name, dose, schedule } : null;
            }).filter(Boolean),
        };

        try {
            const url = modalAction.patientId
                ? @json(route('patients.update', ['patient' => '__PATIENT_ID__'])).replace('__PATIENT_ID__', modalAction.patientId)
                : @json(route('patients.store'));
            const response = await fetch(url, {
                method: modalAction.patientId ? 'PATCH' : 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify(patient),
            });
            const result = await response.json();

            if (!response.ok) {
                const message = result.message || Object.values(result.errors || {}).flat()[0] || 'No se pudo guardar el paciente.';
                window.alert(message);
                return;
            }

            window.location.reload();
        } catch (error) {
            window.alert('No se pudo conectar con el servidor para guardar el paciente.');
        }
    }

    function openAlertReport(alertId) {
        modalAction = { type: 'report', alertId };
        const modal = document.getElementById('modal');
        modal.classList.remove('patient-editor', 'room-editor');
        modal.classList.add('report-modal');
        document.getElementById('modalTitle').textContent = '📋 Registrar Atención Sanitaria';
        document.getElementById('modalSaveButton').textContent = 'Guardar y finalizar llamada';
        const subtitle = document.getElementById('modalSubtitle');
        subtitle.textContent = 'SOS CONNECT — Registro de Síntomas al Responder';
        subtitle.hidden = false;

        const alert = currentAlertsCache.find(item => Number(item.id) === Number(alertId));
        const fields = document.getElementById('modalFields');
        fields.replaceChildren();

        const summary = document.createElement('div');
        summary.className = 'report-summary';
        const summaryPatient = document.createElement('div');
        const location = alert?.room ? `Hab. ${alert.room} - Cama ${alert.bed || '—'}` : `Pulsador ${alert?.device_id || '—'}`;
        summaryPatient.append(infoText('strong', '', `${location} · ${alert?.patient_name || 'Paciente sin asignar'}`));
        summaryPatient.append(infoText('span', '', `Atendido por: ${alert?.attended_by || currentAttendingName}`));
        const summaryTime = document.createElement('div');
        summaryTime.className = 'report-summary-time';
        summaryTime.append(infoText('span', '', 'Hora de llamada'));
        summaryTime.append(infoText('strong', '', (alert?.display_time || alert?.time || '—').split(' ').pop()));
        summaryTime.append(infoText('span', '', `Atención: ${alert?.attended_time || new Date().toLocaleTimeString('es-CO', {hour:'2-digit', minute:'2-digit'})}`));
        summary.append(summaryPatient, summaryTime);
        fields.append(summary);

        fields.append(infoText('span', 'report-field-title', 'Estado / gravedad al momento de atención'));
        const severity = document.createElement('div');
        severity.className = 'report-severity';
        const severityInput = document.createElement('input');
        severityInput.type = 'hidden';
        severityInput.id = 'alertSeverity';
        severityInput.value = 'moderate';
        [['stable','Estable'],['moderate','Moderado'],['critical','Crítico']].forEach(([value, label]) => {
            const button = document.createElement('button');
            button.type = 'button';
            button.dataset.value = value;
            button.textContent = label;
            if (value === 'moderate') button.classList.add('selected');
            button.addEventListener('click', () => {
                severityInput.value = value;
                severity.querySelectorAll('button').forEach(option => option.classList.toggle('selected', option === button));
            });
            severity.append(button);
        });
        fields.append(severityInput, severity);

        fields.append(infoText('span', 'report-field-title', 'Síntomas observados al atender al paciente'));
        const symptomGrid = document.createElement('div');
        symptomGrid.className = 'report-symptoms';
        const symptomValues = [
            'Dolor torácico / opresión', 'Disnea / dificultad para respirar',
            'Mareo / vértigo', 'Palpitaciones / taquicardia',
            'Dolor agudo de herida', 'Náuseas / vómitos',
            'Ansiedad / agitación', 'Cefalea / dolor de cabeza',
        ];
        function addSymptom(value, checked = false) {
            const label = document.createElement('label');
            label.className = 'report-symptom';
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.name = 'symptoms';
            checkbox.value = value;
            checkbox.checked = checked;
            label.append(checkbox, document.createTextNode(value));
            symptomGrid.append(label);
        }
        symptomValues.forEach(value => addSymptom(value));
        fields.append(symptomGrid);

        const customRow = document.createElement('div');
        customRow.className = 'report-custom-symptom';
        const customInput = document.createElement('input');
        customInput.type = 'text';
        customInput.maxLength = 255;
        customInput.placeholder = 'Otro síntoma específico...';
        customInput.setAttribute('aria-label', 'Otro síntoma específico');
        const addCustom = document.createElement('button');
        addCustom.type = 'button';
        addCustom.textContent = '+ Agregar';
        addCustom.addEventListener('click', () => {
            const value = customInput.value.trim();
            if (!value) return;
            const exists = Array.from(symptomGrid.querySelectorAll('input[name="symptoms"]')).some(input => input.value.toLocaleLowerCase() === value.toLocaleLowerCase());
            if (!exists) addSymptom(value, true);
            customInput.value = '';
        });
        customInput.addEventListener('keydown', event => { if (event.key === 'Enter') { event.preventDefault(); addCustom.click(); } });
        customRow.append(customInput, addCustom);
        fields.append(customRow);

        fields.append(infoText('span', 'report-field-title', 'Observaciones / acciones aplicadas'));
        const notes = document.createElement('textarea');
        notes.id = 'alertReport';
        notes.name = 'report';
        notes.className = 'report-notes';
        notes.maxLength = 5000;
        notes.placeholder = 'Ej.: Se suministró analgésico, se verificaron signos vitales, se acomodó al paciente...';
        notes.required = true;
        fields.append(notes);

        modal.classList.add('show');
        document.getElementById('alertReport').focus();
    }

    async function saveAlertReport(alertId) {
        const report = document.getElementById('alertReport').value.trim();
        if (!report) {
            window.alert('Escribe el reporte de atención antes de cerrar la alerta.');
            return;
        }

        try {
            const url = @json(route('alerts.complete', ['panicAlert' => '__ALERT_ID__'])).replace('__ALERT_ID__', alertId);
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({
                    report,
                    severity: document.getElementById('alertSeverity').value,
                    symptoms: Array.from(document.querySelectorAll('#modalFields input[name="symptoms"]:checked'), input => input.value),
                }),
            });
            const responseText = await response.text();
            let result = {};
            try { result = JSON.parse(responseText); } catch (error) { result = {}; }

            if (!response.ok || !result.ok) {
                const validationMessage = Object.values(result.errors || {}).flat()[0];
                const message = result.message || validationMessage || (response.status === 419
                    ? 'La sesión venció. Recarga la página de Inicio e inicia sesión de nuevo para guardar la atención.'
                    : `El servidor rechazó el reporte (HTTP ${response.status}).`);
                window.alert(message);
                return;
            }

            closeModal();
            await pollPanicAlerts();
        } catch (error) {
            window.alert('No se pudo conectar con el servidor para guardar el reporte.');
        }
    }

    async function attendAlert(alertId) {
        try {
            const url = @json(route('alerts.attend', ['panicAlert' => '__ALERT_ID__'])).replace('__ALERT_ID__', alertId);
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });
            const result = await response.json();

            if (!response.ok) {
                window.alert(result.message || 'No se pudo asignar la alerta.');
                return;
            }

            await pollPanicAlerts();
            openAlertReport(alertId);
        } catch (error) {
            window.alert('No se pudo conectar con el servidor para atender la alerta.');
        }
    }


    function filterTable(input, tableId) {

        const value =
            input.value.toLowerCase();

        const table =
            document.getElementById(tableId);

        if (!table) return;

        const rows =
            table.querySelectorAll('tbody tr');

        rows.forEach(row => {

            const text =
                row.textContent.toLowerCase();

            row.style.display =
                text.includes(value) ? '' : 'none';

        });

    }

    function renderPatientsTable(patients) {
        const tbody = document.querySelector('#patientsTable tbody');
        if (!tbody) return;
        tbody.replaceChildren();
        if (!patients.length) {
            const row = document.createElement('tr');
            const cell = infoText('td', '', 'Aún no hay pacientes registrados. Usa “+ Nuevo paciente” para agregar uno y asignar el pulsador de su cama.');
            cell.colSpan = 6;
            row.append(cell);
            tbody.append(row);
            return;
        }
        patients.forEach(patient => {
            const row = document.createElement('tr');
            const nameCell = addCell(row, patient.name, 'patient-name');
            const buttonInfo = infoText('div', 'alert-meta', patient.device_id ? `Pulsador de esta cama: ${patient.device_id}` : 'Sin pulsador asignado');
            nameCell.append(buttonInfo);
            addCell(row, patient.age ? String(patient.age) : '—');
            addCell(row, `${patient.room} - ${patient.bed}`);
            const diagnosisCell = addCell(row, patient.diagnosis || (patient.conditions || []).join(' · ') || '—');
            const blood = patient.blood_type ? `Sangre ${patient.blood_type}` : '';
            if (blood) diagnosisCell.append(infoText('div', 'alert-meta', blood));
            addCell(row, patient.admitted_at ? patient.admitted_at.slice(0, 10) : '—');
            const actions = document.createElement('td');
            const edit = document.createElement('button');
            edit.type = 'button';
            edit.className = 'action-small';
            edit.textContent = 'Editar ficha';
            edit.addEventListener('click', () => openPatientModal(patient.id));
            actions.append(edit);
            row.append(actions);
            tbody.append(row);
        });
    }

    async function pollPatients() {
        try {
            const response = await fetch(@json(route('patients.index')), { headers: { 'Accept': 'application/json' } });
            if (!response.ok) return;
            dashboardPatients = await response.json();
            renderPatientsTable(dashboardPatients);
            renderRooms();
            document.getElementById('dashboardPatientCount').textContent = String(dashboardPatients.length);
            document.getElementById('dashboardOccupiedBedCount').textContent = String(dashboardPatients.length);
            document.getElementById('dashboardDeviceCount').textContent = String(dashboardPatients.filter(patient => patient.device_id).length);
        } catch (error) {
            console.error('No se pudo actualizar la lista de pacientes.', error);
        }
    }

    let lastSeenAlertId = null;
    let firstAlertPoll = true;
    localStorage.removeItem('sos.alarmEnabled');
    let alarmVolume = Math.min(1, Math.max(0.1, Number(localStorage.getItem('sos.alarmVolume') || 0.85)));
    const alarmToneSelect = document.getElementById('alarmTone');
    if (localStorage.getItem('sos.alarmToneVersion') !== 'original-default-1') {
        localStorage.setItem('sos.alarmTone', 'original');
        localStorage.setItem('sos.alarmToneVersion', 'original-default-1');
    }
    const savedAlarmTone = localStorage.getItem('sos.alarmTone');
    if (Array.from(alarmToneSelect.options).some(option => option.value === savedAlarmTone)) {
        alarmToneSelect.value = savedAlarmTone;
    }
    let alarmAudioContext = null;
    let pendingAlertsExist = false;
    let alarmInterval = null;


    const activeAlarmNodes = new Set();

    function updateAlarmIndicator() {
        const button = document.getElementById('soundToggle');
        const ready = alarmAudioContext?.state === 'running';
        const ringing = pendingAlertsExist && ready && alarmInterval !== null;
        button.classList.toggle('alarm-ringing', ringing);
        button.classList.toggle('alarm-blocked', !ready);
        button.title = !ready
            ? 'Pulsa aquí o en la página para permitir el sonido de las alertas'
            : ringing ? 'Alarma sonando · Hay llamadas pendientes' : 'Sin llamadas pendientes · Sonido preparado';
        button.setAttribute('aria-label', button.title);
        document.getElementById('alarmAudioStatus').textContent = !ready
            ? 'Haz clic o pulsa una tecla en esta página para permitir el sonido de las alertas.'
            : '';
    }

    function syncAlarmSound() {
        if (!pendingAlertsExist || alarmAudioContext?.state !== 'running') {
            if (alarmInterval !== null) clearInterval(alarmInterval);
            alarmInterval = null;
            for (const oscillator of activeAlarmNodes) oscillator.stop();
            activeAlarmNodes.clear();
        } else if (alarmInterval === null) {
            playAlarmSound();
            alarmInterval = setInterval(playAlarmSound, 2500);
        }
        updateAlarmIndicator();
    }

    async function prepareAlarmAudio() {
        const AudioContextClass = window.AudioContext || window.webkitAudioContext;
        if (!AudioContextClass) {
            document.getElementById('alarmAudioStatus').textContent = 'Este navegador no admite sonido de alertas. Usa un navegador compatible.';
            return;
        }
        if (!alarmAudioContext) {
            alarmAudioContext = new AudioContextClass();
            alarmAudioContext.addEventListener('statechange', syncAlarmSound);
        }
        syncAlarmSound();
        try {
            await alarmAudioContext.resume();
            syncAlarmSound();
        } catch (error) {
            updateAlarmIndicator();
        }
    }

    function statusLabel(status) {
        return ({ pending: 'Pendiente', attending: 'En atención', completed: 'Completada' })[status] || 'Pendiente';
    }

    function makeStatus(status) {
        const badge = document.createElement('span');
        badge.className = `status status-${status === 'attending' ? 'attending' : status === 'completed' ? 'completed' : 'pending'}`;
        badge.textContent = statusLabel(status);
        return badge;
    }

    function addCell(row, value, className = '') {
        const cell = document.createElement('td');
        cell.textContent = value || '—';
        if (className) cell.className = className;
        row.append(cell);
        return cell;
    }

    function addAlertAction(cell, alert) {
        if (alert.status === 'completed') return;
        const button = document.createElement('button');
        button.className = 'action-small';
        if (alert.status === 'attending') {
            button.textContent = 'Dejar reporte';
            button.addEventListener('click', () => openAlertReport(alert.id));
        } else {
            button.textContent = 'Atender';
            button.addEventListener('click', () => attendAlert(alert.id));
        }
        cell.append(button);
    }

    function infoText(tag, className, text) {
        const element = document.createElement(tag);
        if (className) element.className = className;
        element.textContent = text || '—';
        return element;
    }

    function renderEmergencyCard(alert) {
        const card = document.createElement('article');
        card.className = 'emergency-call';

        const head = document.createElement('div');
        head.className = 'emergency-call-head';
        head.append(infoText('span', '', '●'));
        head.append(infoText('strong', '', '¡LLAMADA DE EMERGENCIA!'));
        head.append(infoText('span', '', alert.time || ''));
        head.append(infoText('span', 'call-status', alert.status === 'attending' ? 'Atendido ✓' : statusLabel(alert.status)));

        const body = document.createElement('div');
        body.className = 'emergency-call-body';
        const location = document.createElement('div');
        location.className = 'emergency-location';
        [['Habitación', alert.room], ['Cama', alert.bed]].forEach(([label, value]) => {
            const tile = document.createElement('div');
            tile.append(infoText('span', '', label), infoText('strong', '', value || '—'));
            location.append(tile);
        });
        body.append(location);

        const details = document.createElement('div');
        details.className = 'emergency-details';
        const patientInfo = document.createElement('div');
        patientInfo.append(infoText('h3', '', 'Paciente'), infoText('p', 'patient-title', alert.patient_name));
        patientInfo.append(infoText('p', '', [alert.patient_age ? `${alert.patient_age} años` : '', alert.blood_type ? `Sangre: ${alert.blood_type}` : '', alert.patient_document ? `Documento: ${alert.patient_document}` : ''].filter(Boolean).join(' · ')));
        patientInfo.append(infoText('p', '', `Ingresó: ${alert.admitted_at || 'Sin fecha registrada'}`));
        patientInfo.append(infoText('p', '', `Personal asignado: ${alert.assigned_nurse || 'Sin asignar'}`));
        patientInfo.append(infoText('p', '', alert.emergency_contact_name ? `Contacto: ${alert.emergency_contact_name}${alert.emergency_contact_phone ? ` · ${alert.emergency_contact_phone}` : ''}` : 'Contacto de emergencia no registrado'));

        const clinicalInfo = document.createElement('div');
        clinicalInfo.append(infoText('h3', '', 'Diagnóstico / padecimientos'));
        if (alert.diagnosis) clinicalInfo.append(infoText('p', '', alert.diagnosis));
        const conditions = Array.isArray(alert.conditions) ? alert.conditions.filter(Boolean) : [];
        if (conditions.length) {
            const list = document.createElement('ul');
            conditions.forEach(condition => list.append(infoText('li', '', condition)));
            clinicalInfo.append(list);
        } else if (!alert.diagnosis) {
            clinicalInfo.append(infoText('p', '', 'No hay información clínica registrada.'));
        }
        details.append(patientInfo, clinicalInfo);
        body.append(details);

        const medications = Array.isArray(alert.medications) ? alert.medications : [];
        const medicineSection = document.createElement('div');
        medicineSection.append(infoText('h3', '', 'Medicamentos en curso'));
        const medicineGrid = document.createElement('div');
        medicineGrid.className = 'emergency-medicines';
        if (medications.length) {
            medications.forEach(medication => medicineGrid.append(infoText('div', 'emergency-medicine', [medication.name, medication.dose, medication.schedule].filter(Boolean).join(' · '))));
        } else {
            medicineGrid.append(infoText('div', 'emergency-medicine', 'No hay medicamentos registrados.'));
        }
        medicineSection.append(medicineGrid);
        body.append(medicineSection);
        card.append(head, body);

        const foot = document.createElement('div');
        foot.className = 'emergency-call-foot';
        foot.append(infoText('span', '', `Hora ${alert.time || '—'} · Pulsador ${alert.device_id || 'sin ID'}`));
        const action = document.createElement('div');
        addAlertAction(action, alert);
        if (action.firstChild) foot.append(action.firstChild);
        card.append(foot);
        return card;
    }

    function renderEmergencyCards(alerts) {
        const activeAlerts = alerts.filter(alert => alert.status === 'pending' || alert.status === 'attending');
        ['dashboardEmergencyCards', 'activeEmergencyCards'].forEach(id => {
            const container = document.getElementById(id);
            if (!container) return;
            container.replaceChildren(...activeAlerts.map(renderEmergencyCard));
        });
        document.getElementById('dashboardAlertCount').textContent = String(activeAlerts.length);
    }

    function renderLiveAlerts(alerts) {
        renderEmergencyCards(alerts);
        const list = document.querySelector('.alert-list');
        if (list) {
            list.replaceChildren();
            alerts.slice(0, 5).forEach(alert => {
                const row = document.createElement('div');
                row.className = 'alert-row';
                const indicator = document.createElement('span');
                indicator.className = `alert-indicator ${alert.status === 'attending' ? 'attending' : alert.status === 'completed' ? 'completed' : 'pending'}`;
                const main = document.createElement('div');
                main.className = 'alert-main';
                const patient = document.createElement('div');
                patient.className = 'alert-patient';
                patient.textContent = alert.patient_name;
                const meta = document.createElement('div');
                meta.className = 'alert-meta';
                meta.textContent = `${alert.room ? `Habitación ${alert.room} · Cama ${alert.bed || '—'}` : `Pulsador ${alert.device_id}`} · ${alert.time}`;
                const details = document.createElement('div');
                details.className = 'alert-meta';
                details.textContent = [
                    alert.patient_age ? `${alert.patient_age} años` : '',
                    alert.blood_type ? `Sangre ${alert.blood_type}` : '',
                    alert.patient_document ? `Doc. ${alert.patient_document}` : '',
                    alert.diagnosis || alert.message,
                    ...(alert.conditions || []),
                    ...(alert.medications || []).map(medication => [medication.name, medication.dose, medication.schedule].filter(Boolean).join(' ')),
                    alert.assigned_nurse ? `Personal: ${alert.assigned_nurse}` : '',
                    alert.emergency_contact_name ? `Emergencia: ${alert.emergency_contact_name}${alert.emergency_contact_phone ? ` · ${alert.emergency_contact_phone}` : ''}` : '',
                ].filter(Boolean).join(' · ');
                main.append(patient, meta, details);
                row.append(indicator, main, makeStatus(alert.status));
                const actionCell = document.createElement('div');
                addAlertAction(actionCell, alert);
                if (actionCell.firstChild) row.append(actionCell.firstChild);
                list.append(row);
            });
            if (!alerts.length) list.textContent = 'Aún no se han recibido alertas del ESP32.';
        }

        const alertsBody = document.querySelector('#alertsTable tbody');
        if (alertsBody) {
            alertsBody.replaceChildren();
            alerts.forEach(alert => {
                const row = document.createElement('tr');
                const patientCell = addCell(row, alert.patient_name, 'patient-name');
                if (alert.diagnosis || alert.patient_document) {
                    const details = document.createElement('div');
                    details.className = 'alert-meta';
                    details.textContent = [alert.diagnosis, alert.patient_document ? `Doc. ${alert.patient_document}` : ''].filter(Boolean).join(' · ');
                    patientCell.append(details);
                }
                addCell(row, alert.room ? `${alert.room} - ${alert.bed || '—'}` : alert.device_id);
                addCell(row, alert.time);
                const statusCell = document.createElement('td');
                statusCell.append(makeStatus(alert.status));
                row.append(statusCell);
                addCell(row, alert.attended_by || '—');
                const actionCell = document.createElement('td');
                addAlertAction(actionCell, alert);
                row.append(actionCell);
                alertsBody.append(row);
            });
            if (!alerts.length) {
                const row = document.createElement('tr');
                const cell = addCell(row, 'Aún no hay alertas registradas.');
                cell.colSpan = 6;
                alertsBody.append(row);
            }
        }

        const historyBody = document.querySelector('#historyTable tbody');
        if (historyBody) {
            historyBody.replaceChildren();
            alerts.forEach(alert => {
                const row = document.createElement('tr');
                addCell(row, alert.display_time);
                addCell(row, `${alert.patient_name} · ${alert.message}`, 'patient-name');
                addCell(row, alert.room ? `${alert.room} - ${alert.bed || '—'}` : alert.device_id);
                addCell(row, alert.attended_by || '—');
                addCell(row, alert.attended_time || '—');
                addCell(row, alert.report || 'Sin reporte de atención.');
                const reportCell = addCell(row, '—');
                if (alert.report?.trim()) {
                    const link = document.createElement('a');
                    link.className = 'history-report-link';
                    link.href = @json(route('alerts.report', ['panicAlert' => '__ALERT_ID__'])).replace('__ALERT_ID__', alert.id);
                    link.target = '_blank';
                    link.rel = 'noopener';
                    link.textContent = 'Ver reporte';
                    link.setAttribute('aria-label', `Ver reporte de la alerta ${alert.id} (abre en otra pestaña)`);
                    reportCell.replaceChildren(link);
                }
                historyBody.append(row);
            });
            if (!alerts.length) {
                const row = document.createElement('tr');
                const cell = addCell(row, 'Aún no hay alertas registradas.');
                cell.colSpan = 7;
                historyBody.append(row);
            }
        }
    }

    const alarmTones = {
        soft: { wave: 'sine', level: 0.32, release: 0.12, notes: [
            [0, 0.37, 620], [0.42, 0.37, 880], [0.84, 0.37, 620], [1.26, 0.37, 880],
        ] },
        beeps: { wave: 'triangle', level: 0.24, release: 0.05, notes: [
            [0, 0.18, 900], [0.29, 0.18, 900], [0.58, 0.18, 900],
        ] },
        chime: { wave: 'sine', level: 0.30, release: 0.30, notes: [
            [0, 0.38, 660], [0.18, 0.42, 880], [0.38, 0.54, 1047],
        ] },
        original: { wave: 'triangle', level: 0.22, release: 0.22, notes: [
            [0, 2.32, 720, [[0.62, 1180], [1.24, 720], [1.86, 1180], [2.3, 720]]],
        ] },
    };

    function playAlarmSound(force = false) {
        if ((!pendingAlertsExist && !force) || alarmAudioContext?.state !== 'running') return;
        const start = alarmAudioContext.currentTime + 0.03;
        const tone = alarmTones[alarmToneSelect.value];
        const peak = Math.max(0.001, alarmVolume * tone.level);
        for (const [offset, duration, frequency, ramps = []] of tone.notes) {
            const noteStart = start + offset;
            const noteEnd = noteStart + duration;
            const oscillator = alarmAudioContext.createOscillator();
            const gain = alarmAudioContext.createGain();
            oscillator.type = tone.wave;
            oscillator.frequency.setValueAtTime(frequency, noteStart);
            for (const [time, pitch] of ramps) {
                oscillator.frequency.linearRampToValueAtTime(pitch, noteStart + time);
            }
            gain.gain.setValueAtTime(0.001, noteStart);
            gain.gain.exponentialRampToValueAtTime(peak, noteStart + 0.04);
            gain.gain.setValueAtTime(peak, noteEnd - tone.release);
            gain.gain.exponentialRampToValueAtTime(0.001, noteEnd);
            oscillator.connect(gain);
            gain.connect(alarmAudioContext.destination);
            if (!force) activeAlarmNodes.add(oscillator);
            oscillator.onended = () => {
                activeAlarmNodes.delete(oscillator);
                oscillator.disconnect();
                gain.disconnect();
            };
            oscillator.start(noteStart);
            oscillator.stop(noteEnd + 0.03);
        }
    }

    document.getElementById('soundToggle').addEventListener('click', prepareAlarmAudio);

    document.getElementById('sirenVolume').addEventListener('input', function () {
        alarmVolume = Number(this.value) / 100;
        document.getElementById('sirenVolumeValue').textContent = `${this.value}%`;
        localStorage.setItem('sos.alarmVolume', String(alarmVolume));
    });

    document.getElementById('testSiren').addEventListener('click', async () => {
        const AudioContextClass = window.AudioContext || window.webkitAudioContext;
        if (!AudioContextClass) {
            window.alert('Este navegador no permite reproducir el tono de alarma.');
            return;
        }
        alarmAudioContext ||= new AudioContextClass();
        await alarmAudioContext.resume();
        playAlarmSound(true);
    });

    document.getElementById('saveSettings').addEventListener('click', () => {
        localStorage.setItem('sos.alarmTone', alarmToneSelect.value);
        localStorage.setItem('sos.activeShift', document.getElementById('activeShift').value);
        localStorage.setItem('sos.alarmVolume', String(alarmVolume));
        document.getElementById('settingsSaved').textContent = 'Configuración guardada en este navegador.';
        setTimeout(() => { document.getElementById('settingsSaved').textContent = ''; }, 3500);
    });

    function loadSettings() {
        const volume = document.getElementById('sirenVolume');
        volume.value = String(Math.round(alarmVolume * 100));
        document.getElementById('sirenVolumeValue').textContent = `${volume.value}%`;
        const savedShift = localStorage.getItem('sos.activeShift');
        if (savedShift) document.getElementById('activeShift').value = savedShift;
        localStorage.removeItem('sos.directLines');
    }

    document.addEventListener('pointerdown', prepareAlarmAudio);
    document.addEventListener('keydown', prepareAlarmAudio);

    loadSettings();
    prepareAlarmAudio();

    async function pollPanicAlerts() {
        try {
            const response = await fetch(@json(route('alerts.latest')), { cache: 'no-store', headers: { 'Accept': 'application/json' } });
            if (!response.ok) return;
            const alerts = await response.json();
            currentAlertsCache = alerts;
            renderLiveAlerts(alerts);
            pendingAlertsExist = alerts.some(alert => alert.status === 'pending');
            syncAlarmSound();
            const newestId = alerts.length ? Math.max(...alerts.map(alert => alert.id)) : 0;
            if (!firstAlertPoll && newestId !== null && lastSeenAlertId !== null && newestId > lastSeenAlertId) {
                const newest = alerts.find(alert => alert.id === newestId);
                const notice = document.createElement('div');
                notice.textContent = `🚨 ${newest?.patient_name || 'Nueva alerta'} solicita ayuda (${newest?.time || ''})`;
                notice.setAttribute('role', 'alert');
                notice.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999;background:#b42318;color:#fff;padding:16px 22px;border-radius:10px;box-shadow:0 8px 28px #0003;font-weight:700;max-width:360px';
                document.body.append(notice);
                setTimeout(() => notice.remove(), 10000);
            }
            if (newestId !== null) lastSeenAlertId = Math.max(lastSeenAlertId ?? 0, newestId);
            firstAlertPoll = false;
        } catch (error) {
            console.error('No se pudo actualizar el historial de alertas.', error);
        }
    }

    document.querySelector('#alertsTable tbody')?.replaceChildren();
    document.querySelector('#historyTable tbody')?.replaceChildren();
    pollPanicAlerts();
    pollPatients();
    pollRooms();
    renderRooms();
    setInterval(pollPanicAlerts, 1000);
    setInterval(pollPatients, 5000);
    setInterval(pollRooms, 5000);


    document
        .getElementById('modal')
        .addEventListener('click', function(event) {

            if (event.target === this) {
                closeModal();
            }

        });

</script>

</body>

</html>

