<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reporte de atención #{{ $alert->id }} | SOS Connect</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; padding: clamp(14px, 4vw, 42px); background: #f1f5f9; color: #172538; font: 15px/1.5 Arial, sans-serif; }
        main, .toolbar { max-width: 760px; margin: 0 auto; }
        .toolbar { display: flex; justify-content: flex-end; margin-bottom: 12px; }
        button { padding: 9px 14px; border: 0; border-radius: 7px; background: #0f766e; color: white; font: inherit; font-weight: 700; cursor: pointer; }
        main { background: white; border: 1px solid #dbe4ed; border-radius: 12px; }
        header, .content { padding: clamp(18px, 4vw, 32px); }
        header { border-bottom: 3px solid #0f766e; }
        h1 { margin: 4px 0 0; font-size: 26px; line-height: 1.2; }
        h2 { font-size: 16px; margin: 24px 0 8px; color: #173753; break-after: avoid; }
        .brand { margin: 0; font-weight: 700; color: #0f766e; }
        .metadata { margin: 8px 0 0; color: #475569; }
        dl { display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 190px), 1fr)); gap: 14px; margin: 0; padding: 15px; border: 1px solid #dbe4ed; border-radius: 8px; }
        dt { color: #475569; font-size: 13px; }
        dd { margin: 2px 0 0; font-weight: 700; overflow-wrap: anywhere; }
        .notes { margin: 0; white-space: pre-wrap; overflow-wrap: anywhere; }
        ul { margin: 0; padding-left: 22px; overflow-wrap: anywhere; }
        @media print {
            @page { margin: 15mm; }
            body { padding: 0; background: white; }
            main { max-width: none; border: 0; }
            header, .content { padding: 0; }
            header { padding-bottom: 12px; margin-bottom: 18px; }
            .toolbar { display: none; }
            dl { break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <button type="button" id="print-report">Imprimir / Guardar como PDF</button>
    </div>
    <main>
        <header>
            <p class="brand">SOS Connect</p>
            <h1>Reporte de atención sanitaria</h1>
            <p class="metadata">Alerta #{{ $alert->id }} · Pulsador {{ $alert->device_id }}</p>
        </header>
        <div class="content">
            <dl>
                <div>
                    <dt>Paciente</dt>
                    <dd>{{ $alert->patient?->name ?? 'Sin paciente asignado' }}</dd>
                </div>
                <div>
                    <dt>Habitación</dt>
                    <dd>{{ $alert->patient?->room ?? 'Sin registro' }}</dd>
                </div>
                <div>
                    <dt>Cama</dt>
                    <dd>{{ $alert->patient?->bed ?? 'Sin registro' }}</dd>
                </div>
                <div>
                    <dt>Atendido por</dt>
                    <dd>{{ $alert->attendedBy?->name ?? 'Sin registro' }}</dd>
                </div>
                <div>
                    <dt>Fecha y hora de llamada</dt>
                    <dd>{{ $alert->triggered_at?->format('d/m/Y H:i:s') ?? 'Sin registro' }}</dd>
                </div>
                <div>
                    <dt>Fecha y hora de atención</dt>
                    <dd>{{ $alert->attended_at?->format('d/m/Y H:i:s') ?? 'Sin registro' }}</dd>
                </div>
            </dl>
            <h2>Estado o gravedad al momento de la atención</h2>
            <p class="notes">{{ match ($alert->severity) {
                'stable' => 'Estable',
                'moderate' => 'Moderado',
                'critical' => 'Crítico',
                default => 'Sin registro',
            } }}</p>
            <h2>Síntomas observados</h2>
            @if ($alert->symptoms)
                <ul>
                    @foreach ($alert->symptoms as $symptom)
                        <li>{{ $symptom }}</li>
                    @endforeach
                </ul>
            @else
                <p class="notes">Sin síntomas registrados.</p>
            @endif
            <h2>Observaciones y acciones aplicadas</h2>
            <p class="notes">{{ $alert->report }}</p>
        </div>
    </main>
    <script>
        document.getElementById('print-report').addEventListener('click', () => window.print());
    </script>
</body>
</html>
