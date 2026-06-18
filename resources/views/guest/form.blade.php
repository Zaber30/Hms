<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptom Predictor - HealthConnect</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1B2A4A;
            --secondary: #14A0A6;
            --secondary-light: #E1F5F5;
            --success: #22C55E;
            --success-light: #DCFCE7;
            --bg: #F0F4F8;
            --surface: #FFFFFF;
            --border: #E2E8F0;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --text-hint: #94A3B8;
            --danger: #E24B4A;
            --danger-light: #FCEBEB;
            --amber: #EF9F27;
            --amber-light: #FAEEDA;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* ── Header ── */
        .header {
            background: var(--primary);
            padding: 28px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-icon {
            width: 44px;
            height: 44px;
            background: var(--secondary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .header-title {
            font-size: 22px;
            font-weight: 700;
            color: white;
            letter-spacing: -0.3px;
        }

        .header-sub {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.55);
            margin-top: 2px;
        }

        .header-badge {
            background: rgba(20, 160, 166, 0.2);
            color: var(--secondary);
            border: 1px solid rgba(20, 160, 166, 0.35);
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        /* ── Stepper ── */
        .stepper-wrap {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 0 40px;
        }

        .stepper {
            display: flex;
            max-width: 1100px;
            margin: 0 auto;
        }

        .step {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 18px 10px;
            position: relative;
            cursor: default;
        }

        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 27px;
            left: 60%;
            width: 80%;
            height: 2px;
            background: var(--border);
            z-index: 1;
        }

        .step.step-active:not(:last-child)::after,
        .step.step-done:not(:last-child)::after {
            background: var(--secondary);
        }

        .step-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid var(--border);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-hint);
            position: relative;
            z-index: 2;
            transition: all 0.35s;
        }

        .step.step-active .step-dot {
            border-color: var(--secondary);
            color: var(--secondary);
            transform: scale(1.15);
        }

        .step.step-done .step-dot {
            background: var(--secondary);
            border-color: var(--secondary);
            color: white;
        }

        .step-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-hint);
            margin-top: 8px;
        }

        .step.step-active .step-label {
            color: var(--primary);
        }

        .step.step-done .step-label {
            color: var(--secondary);
        }

        /* ── Layout ── */
        .main {
            max-width: 1400px;
            margin: 0 auto;
            padding: 32px 24px;
            display: grid;
            grid-template-columns: 360px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* ── Cards ── */
        .card {
            background: var(--surface);
            border-radius: 14px;
            border: 1px solid var(--border);
            overflow: hidden;
        }

        .card-hdr {
            padding: 18px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-hdr-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
        }

        .card-hdr h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
        }

        .card-hdr p {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .card-body {
            padding: 22px;
        }

        /* ── Form ── */
        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .field label .req {
            color: var(--danger);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input,
        .field select,
        .field input[type="number"] {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
            background: white;
            outline: none;
            transition: border-color 0.2s;
        }

        .input-wrap input:focus,
        .field select:focus,
        .field input[type="number"]:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 3px rgba(20, 160, 166, 0.12);
        }

        .field-hint {
            font-size: 11px;
            color: var(--text-hint);
            margin-top: 6px;
        }

        /* Suggestions */
        #suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            margin-top: 6px;
            background: white;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 50;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        #suggestions .sug-item {
            padding: 10px 14px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-main);
            border-bottom: 1px solid #F8FAFC;
            transition: background 0.15s;
        }

        #suggestions .sug-item:last-child {
            border-bottom: none;
        }

        #suggestions .sug-item:hover {
            background: var(--secondary-light);
            color: var(--secondary);
        }

        /* Tags */
        #selected {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            min-height: 32px;
        }

        .tag {
            background: var(--secondary-light);
            color: #0F6E56;
            border: 1px solid #9FE1CB;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .tag-remove {
            background: none;
            border: none;
            color: #0F6E56;
            cursor: pointer;
            font-size: 15px;
            line-height: 1;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .tag-remove:hover {
            color: var(--danger);
        }

        .empty-hint {
            font-size: 12px;
            color: var(--text-hint);
            font-style: italic;
        }

        /* Submit */
        #submitBtn {
            width: 100%;
            padding: 13px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: background 0.25s, opacity 0.25s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        #submitBtn:hover {
            background: #253861;
        }

        #submitBtn:disabled {
            opacity: 0.55;
            cursor: not-allowed;
        }

        /* Error */
        #errorMsg {
            border-left: 3px solid var(--danger);
            background: var(--danger-light);
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 13px;
            color: #991B1B;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        /* ── Empty state ── */
        .empty-state {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 60px 40px;
            text-align: center;
        }

        .empty-state .es-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: var(--secondary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: var(--secondary);
            margin: 0 auto 20px;
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .empty-state p {
            font-size: 13px;
            color: var(--text-muted);
        }

        /* ── Loading ── */
        .loading-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 60px;
            text-align: center;
        }

        .loading-card p {
            font-size: 14px;
            color: var(--text-muted);
            margin-top: 16px;
            font-weight: 600;
        }

        /* ── Result ── */
        .result-specialist {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .result-specialist-top {
            background: var(--primary);
            padding: 32px;
            text-align: center;
        }

        .result-specialist-top .res-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 10px;
        }

        .result-specialist-top .res-name {
            font-size: 36px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .result-specialist-top .res-sub {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
        }

        .res-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            border-top: 1px solid var(--border);
        }

        .res-summary-item {
            padding: 18px;
            text-align: center;
            border-right: 1px solid var(--border);
        }

        .res-summary-item:last-child {
            border-right: none;
        }

        .res-summary-item .rsv {
            font-size: 26px;
            font-weight: 700;
            color: var(--primary);
        }

        .res-summary-item .rsk {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-top: 4px;
        }

        .symptoms-row {
            padding: 20px 22px;
            border-top: 1px solid var(--border);
        }

        .symptoms-row h4 {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .info-box {
            margin: 0 22px 22px;
            padding: 12px 16px;
            background: #EFF6FF;
            border-left: 3px solid #3B82F6;
            border-radius: 8px;
            font-size: 12px;
            color: #1E40AF;
        }

        .reset-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: none;
            border: 1.5px solid var(--border);
            border-radius: 9px;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-muted);
            cursor: pointer;
            transition: all 0.2s;
        }

        .reset-btn:hover {
            border-color: var(--secondary);
            color: var(--secondary);
        }

        /* ── Specialist Cards ── */
        #matchingSpecialists {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
            justify-content: start;
        }

        .specialist-card {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            transition: box-shadow 0.2s;
            background: white;
        }

        .specialist-card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .sc-header {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            margin-bottom: 14px;
        }

        .sc-avatar {
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: var(--secondary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: var(--secondary);
            flex-shrink: 0;
        }

        .sc-name {
            font-size: 15px;
            font-weight: 700;
            color: var(--primary);
        }

        .sc-qual {
            font-size: 12px;
            color: var(--secondary);
            font-weight: 600;
            margin-top: 2px;
        }

        .sc-spec {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .sc-fee {
            margin-left: auto;
            text-align: right;
        }

        .sc-fee .fee-amt {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
        }

        .sc-fee .fee-lbl {
            font-size: 11px;
            color: var(--text-hint);
        }

        .sc-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 14px;
        }

        .sc-meta-item {
            background: #F8FAFC;
            border-radius: 8px;
            padding: 10px 12px;
        }

        .sc-meta-item .mk {
            font-size: 10px;
            color: var(--text-hint);
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .sc-meta-item .mv {
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
            margin-top: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sc-bio {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 14px;
            line-height: 1.5;
        }

        .sc-actions {
            display: flex;
            gap: 8px;
        }

        .btn-book {
            flex: 1;
            padding: 10px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: background 0.2s;
        }

        .btn-book:hover {
            background: #253861;
        }

        .btn-details {
            flex: 1;
            padding: 10px;
            background: none;
            color: var(--text-main);
            border: 1.5px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s;
        }

        .btn-details:hover {
            border-color: var(--secondary);
            color: var(--secondary);
        }

        /* ── What to know ── */
        .know-item {
            display: flex;
            gap: 14px;
            padding: 16px 0;
            border-bottom: 1px solid var(--border);
        }

        .know-item:last-child {
            border-bottom: none;
        }

        .know-icon {
            width: 36px;
            height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            flex-shrink: 0;
        }

        .know-item h4 {
            font-size: 13px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 5px;
        }

        .know-item p,
        .know-item ol {
            font-size: 13px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .know-item ol {
            padding-left: 16px;
        }

        .know-item ol li+li {
            margin-top: 4px;
        }

        /* Urgency badges */
        .urgency {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.4px;
        }

        .HIGH {
            background: #FEE2E2;
            color: #991B1B;
        }

        .MEDIUM {
            background: #FEF3C7;
            color: #92400E;
        }

        .LOW {
            background: #DCFCE7;
            color: #166534;
        }

        /* ── Prediction / res-item cards (file-2 style) ── */
        #predictionsList {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            justify-content: start;
        }

        .res-item {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px 22px;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .res-item:last-child {
            margin-bottom: 0;
        }

        .res-item:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transform: translateY(-1px);
        }

        .res-rank {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            font-size: 11px;
            font-weight: 800;
            flex-shrink: 0;
        }

        .rank-1 {
            background: #FFF3CD;
            color: #92400E;
            border: 1.5px solid #F59E0B;
        }

        .rank-2 {
            background: #F1F5F9;
            color: #475569;
            border: 1.5px solid #94A3B8;
        }

        .rank-3 {
            background: #FEF3C7;
            color: #78350F;
            border: 1.5px solid #D97706;
        }

        .res-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
            gap: 10px;
        }

        .res-head-left {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .res-disease {
            font-size: 17px;
            font-weight: 700;
            color: var(--primary);
            line-height: 1.2;
        }

        .res-specialist-label {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
        }

        .res-specialist-label i {
            color: var(--secondary);
            margin-right: 4px;
        }

        .bar-wrap {
            margin-bottom: 6px;
        }

        .bar-row {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .bar-row span:last-child {
            color: var(--primary);
            font-size: 13px;
        }

        .bar-bg {
            height: 9px;
            background: #F1F5F9;
            border-radius: 5px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 5px;
            width: 0;
            transition: width 1.2s cubic-bezier(.4, 0, .2, 1);
        }

        .bar-fill.conf-high {
            background: var(--secondary);
        }

        .bar-fill.conf-mid {
            background: var(--amber);
        }

        .bar-fill.conf-low {
            background: #94A3B8;
        }

        /* Spinner */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .spinner {
            display: inline-block;
            width: 36px;
            height: 36px;
            border: 3px solid var(--border);
            border-top-color: var(--secondary);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        /* Fade */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-up {
            animation: fadeUp 0.4s ease-out;
        }

        /* SHAP Symptoms */
        .shap-section {
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }

        .shap-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .shap-items {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .shap-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            background: #F8FAFC;
            border-radius: 8px;
            font-size: 12px;
        }

        .shap-indicator {
            width: 4px;
            height: 24px;
            border-radius: 2px;
            flex-shrink: 0;
        }

        .shap-indicator.positive {
            background: var(--secondary);
        }

        .shap-indicator.negative {
            background: #94A3B8;
        }

        .shap-symptom-name {
            flex: 1;
            font-weight: 600;
            color: var(--text-main);
        }

        .shap-symptom-name.active {
            color: var(--secondary);
        }

        .shap-desc {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-muted);
            min-width: 110px;
            text-align: center;
        }

        .shap-percentage {
            font-weight: 700;
            min-width: 50px;
            text-align: right;
        }

        .shap-percentage.positive {
            color: var(--secondary);
        }

        .shap-percentage.negative {
            color: #94A3B8;
        }

        .shap-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: var(--secondary-light);
            color: var(--secondary);
            font-size: 10px;
            font-weight: 800;
            margin-left: 4px;
        }

        @media (max-width: 800px) {
            .main {
                grid-template-columns: 1fr;
            }

            .header {
                padding: 20px;
            }

            .header-badge {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <div class="header-brand">
            <div class="header-icon"><i class="fas fa-heartbeat"></i></div>
            <div>
                <div class="header-title">Symptom Predictor</div>
                <div class="header-sub">HealthConnect · AI-Powered Specialist Matching</div>
            </div>
        </div>
        <div class="header-badge">Clinical AI</div>
    </div>

    <!-- Stepper -->
    <div class="stepper-wrap">
        <div class="stepper">
            <div class="step step-active" id="s1">
                <div class="step-dot">1</div>
                <div class="step-label">Intake</div>
            </div>
            <div class="step" id="s2">
                <div class="step-dot">2</div>
                <div class="step-label">Vectorizing</div>
            </div>
            <div class="step" id="s3">
                <div class="step-dot">3</div>
                <div class="step-label">AI Logic</div>
            </div>
            <div class="step" id="s4">
                <div class="step-dot">4</div>
                <div class="step-label">Recommendation</div>
            </div>
        </div>
    </div>

    <!-- Main -->
    <div class="main">

        <!-- Form Panel -->
        <div>
            <div class="card" style="position: sticky; top: 20px;">
                <div class="card-hdr">
                    <div class="card-hdr-icon" style="background:#EFF6FF; color:#3B82F6;">
                        <i class="fas fa-pen-to-square"></i>
                    </div>
                    <div>
                        <h2>Patient Intake</h2>
                        <p>Complete all fields for accurate results</p>
                    </div>
                </div>
                <div class="card-body">
                    <form id="healthForm">
                        @csrf

                        <!-- Symptoms -->
                        <div class="field">
                            <label>
                                <i class="fas fa-stethoscope" style="color:#E24B4A;"></i>
                                Symptoms <span class="req">*</span>
                            </label>
                            <div class="input-wrap">
                                <input type="text" id="symptom-input" placeholder="Type a symptom to search…">
                                <div id="suggestions" style="display:none;"></div>
                            </div>
                            <div class="field-hint"><i class="fas fa-info-circle" style="margin-right:4px;"></i>Select
                                all symptoms you're experiencing</div>
                        </div>

                        <div class="field">
                            <div id="selected"><span class="empty-hint">No symptoms selected yet</span></div>
                        </div>

                        <!-- Age -->
                        <div class="field">
                            <label>
                                <i class="fas fa-birthday-cake" style="color:#3B82F6;"></i>
                                Age <span class="req">*</span>
                            </label>
                            <input type="number" name="age" id="age" placeholder="e.g. 32" min="1"
                                max="150" required>
                        </div>

                        <!-- Gender -->
                        <div class="field">
                            <label>
                                <i class="fas fa-venus-mars" style="color:#8B5CF6;"></i>
                                Gender <span class="req">*</span>
                            </label>
                            <select name="gender" id="gender">
                                <option value="">Select gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- Submit -->
                        <button type="submit" id="submitBtn">
                            <span id="btnText"><i class="fas fa-flask-vial"></i> Analyze Symptoms</span>
                            <span id="btnLoading" style="display:none;"><i class="fas fa-spinner fa-spin"></i>
                                Analyzing…</span>
                        </button>

                        <!-- Error -->
                        <div id="errorMsg" style="display:none; margin-top:14px;">
                            <i class="fas fa-exclamation-circle" style="flex-shrink:0; margin-top:1px;"></i>
                            <p id="errorText"></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Results Panel -->
        <div id="resultPanel">

            <!-- Empty State -->
            <div id="emptyState" class="empty-state">
                <div class="es-icon"><i class="fas fa-stethoscope"></i></div>
                <h3>No Analysis Yet</h3>
                <p>Fill in the intake form and click <strong>Analyze Symptoms</strong> to get your personalized
                    specialist recommendation.</p>
            </div>

            <!-- Loading -->
            <div id="loadingState" class="loading-card" style="display:none;">
                <div class="spinner"></div>
                <p>Analyzing your symptoms…</p>
            </div>

            <!-- Result Card -->
            <div id="resultCard" style="display:none;" class="fade-up">

                <!-- Specialist Result -->
                <div class="result-specialist">
                    <div class="result-specialist-top">
                        <div class="res-label">Recommended Specialist</div>
                        <div class="res-name" id="specialistName"></div>
                        <div class="res-sub">Based on your symptoms, age, and gender</div>
                    </div>
                    <div class="res-summary">
                        <div class="res-summary-item">
                            <div class="rsv" id="summaryAge"></div>
                            <div class="rsk">Age</div>
                        </div>
                        <div class="res-summary-item">
                            <div class="rsv" id="summaryGender"></div>
                            <div class="rsk">Gender</div>
                        </div>
                        <div class="res-summary-item">
                            <div class="rsv" id="summarySymptomCount"></div>
                            <div class="rsk">Symptoms</div>
                        </div>
                    </div>
                    <div class="symptoms-row">
                        <h4>Reported Symptoms</h4>
                        <div id="summarySymptoms" style="display:flex; flex-wrap:wrap; gap:7px;"></div>
                    </div>
                    <div class="info-box">
                        <i class="fas fa-info-circle" style="margin-right:6px;"></i>
                        This is an informational recommendation. <strong>Please consult a healthcare professional for a
                            proper diagnosis.</strong>
                    </div>
                    <div style="padding: 0 22px 22px; text-align: center;">
                        <button class="reset-btn" onclick="resetForm()">
                            <i class="fas fa-redo"></i> Start New Analysis
                        </button>
                    </div>
                </div>

                <!-- System Predictions -->
                <div class="card" id="predictionsCard" style="margin-bottom: 16px; display:none;">
                    <div class="card-hdr">
                        <div class="card-hdr-icon" style="background:#EFF6FF; color:#3B82F6;">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div>
                            <h2>System Predictions</h2>
                            <p>Top specailists matches with model confidence scores</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="predictionsList"></div>
                    </div>
                </div>

                <!-- Available Specialists -->
                <div class="card" style="margin-bottom: 16px;">
                    <div class="card-hdr">
                        <div class="card-hdr-icon" style="background:var(--secondary-light); color:var(--secondary);">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div>
                            <h2>Available Specialists</h2>
                            <p>Matched to your recommendation</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="matchingSpecialists"></div>
                        <div id="noSpecialists"
                            style="display:none; text-align:center; padding: 30px 0; color: var(--text-muted); font-size: 14px;">
                            No matching specialists available at this time.
                        </div>
                    </div>
                </div>

                <!-- What You Should Know -->
                <div class="card">
                    <div class="card-hdr">
                        <div class="card-hdr-icon" style="background:var(--amber-light); color:var(--amber);">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div>
                            <h2>What You Should Know</h2>
                            <p>Guidance for your next steps</p>
                        </div>
                    </div>
                    <div class="card-body" style="padding-bottom: 8px;">
                        <div class="know-item">
                            <div class="know-icon" style="background:#EFF6FF; color:#3B82F6;"><i
                                    class="fas fa-clipboard-check"></i></div>
                            <div>
                                <h4>What does this mean?</h4>
                                <p>The specialist recommendation is based on your symptoms. Different specialists have
                                    expertise in different areas and can provide targeted care for your specific
                                    condition.</p>
                            </div>
                        </div>
                        <div class="know-item">
                            <div class="know-icon" style="background:var(--success-light); color:#166534;"><i
                                    class="fas fa-list-check"></i></div>
                            <div>
                                <h4>Next Steps</h4>
                                <ol>
                                    <li>Schedule an appointment with the recommended specialist</li>
                                    <li>Prepare a detailed list of your symptoms and when they started</li>
                                    <li>Bring any relevant medical records or test results</li>
                                    <li>Be prepared to discuss your complete medical history</li>
                                </ol>
                            </div>
                        </div>
                        <div class="know-item">
                            <div class="know-icon" style="background:var(--danger-light); color:#991B1B;"><i
                                    class="fas fa-triangle-exclamation"></i></div>
                            <div>
                                <h4>Emergency Notice</h4>
                                <p>If you're experiencing severe symptoms such as chest pain, difficulty breathing, loss
                                    of consciousness, or signs of stroke — <strong>seek emergency medical care
                                        immediately.</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let selectedSymptoms = [];

        const input = document.getElementById('symptom-input');
        const suggestBox = document.getElementById('suggestions');
        const selectedBox = document.getElementById('selected');
        const form = document.getElementById('healthForm');
        const submitBtn = document.getElementById('submitBtn');
        const errorMsg = document.getElementById('errorMsg');
        const errorText = document.getElementById('errorText');

        const steps = ['s1', 's2', 's3', 's4'];

        function setStep(active) {
            steps.forEach((id, i) => {
                const el = document.getElementById(id);
                el.classList.remove('step-active', 'step-done');
                if (i < active) el.classList.add('step-done');
                else if (i === active) el.classList.add('step-active');
            });
        }

        // Autocomplete
        input.addEventListener('keyup', async function() {
            const query = input.value.toLowerCase().trim();
            if (!query) {
                suggestBox.style.display = 'none';
                return;
            }
            try {
                const res = await fetch('http://127.0.0.1:5000/symptoms');
                if (!res.ok) {
                    console.error('API Error:', res.status, res.statusText);
                    suggestBox.style.display = 'none';
                    return;
                }
                const data = await res.json();
                if (!data.symptoms || !Array.isArray(data.symptoms)) {
                    console.error('Invalid response structure:', data);
                    suggestBox.style.display = 'none';
                    return;
                }
                const filtered = data.symptoms.filter(s =>
                    s.toLowerCase().includes(query) && !selectedSymptoms.includes(s)
                ).slice(0, 5);

                suggestBox.innerHTML = '';
                if (!filtered.length) {
                    suggestBox.style.display = 'none';
                    return;
                }
                suggestBox.style.display = 'block';
                filtered.forEach(symptom => {
                    const div = document.createElement('div');
                    div.className = 'sug-item';
                    div.textContent = symptom;
                    div.onclick = () => {
                        selectedSymptoms.push(symptom);
                        renderSelected();
                        input.value = '';
                        suggestBox.style.display = 'none';
                    };
                    suggestBox.appendChild(div);
                });
            } catch (err) {
                console.error('Fetch error:', err);
                suggestBox.style.display = 'none';
            }
        });

        document.addEventListener('click', e => {
            if (!e.target.closest('#symptom-input') && !e.target.closest('#suggestions'))
                suggestBox.style.display = 'none';
        });

        function renderSelected() {
            selectedBox.innerHTML = '';
            if (!selectedSymptoms.length) {
                selectedBox.innerHTML = '<span class="empty-hint">No symptoms selected yet</span>';
                return;
            }
            selectedSymptoms.forEach((s, i) => {
                const span = document.createElement('span');
                span.className = 'tag';
                span.innerHTML =
                    `<i class="fas fa-check-circle" style="font-size:11px;"></i> ${s} <button class="tag-remove" onclick="removeSymptom(${i})" type="button">×</button>`;
                selectedBox.appendChild(span);
            });
        }

        function removeSymptom(i) {
            selectedSymptoms.splice(i, 1);
            renderSelected();
        }

        // Form submission
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            if (!selectedSymptoms.length) {
                showError('Please select at least one symptom.');
                return;
            }
            const age = document.getElementById('age').value;
            const gender = document.getElementById('gender').value;
            if (!age || age < 1 || age > 150) {
                showError('Please enter a valid age between 1 and 150.');
                return;
            }
            if (!gender) {
                showError('Please select a gender.');
                return;
            }

            hideError();
            showLoading();
            setStep(1);

            try {
                setTimeout(() => setStep(2), 600);

                const response = await fetch('/predict', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        symptoms: selectedSymptoms,
                        age: parseInt(age),
                        gender
                    })
                });

                if (!response.ok) {
                    const d = await response.json().catch(() => ({}));
                    throw new Error(d.message || `Server error ${response.status}`);
                }

                setStep(3);
                const data = await response.json();
                setStep(3); // mark s4 active via displayResult
                displayResult(data, age, gender);

            } catch (err) {
                hideLoading();
                setStep(0);
                showError(err.message || 'Error getting prediction. Please try again.');
            }
        });

        function showLoading() {
            document.getElementById('emptyState').style.display = 'none';
            document.getElementById('loadingState').style.display = 'block';
            document.getElementById('resultCard').style.display = 'none';
            document.getElementById('btnText').style.display = 'none';
            document.getElementById('btnLoading').style.display = 'flex';
            submitBtn.disabled = true;
        }

        function hideLoading() {
            document.getElementById('loadingState').style.display = 'none';
            document.getElementById('btnText').style.display = 'inline';
            document.getElementById('btnLoading').style.display = 'none';
            submitBtn.disabled = false;
        }

        function displayResult(data, age, gender) {
            hideLoading();
            steps.forEach(id => document.getElementById(id).classList.remove('step-active', 'step-done'));
            ['s1', 's2', 's3'].forEach(id => document.getElementById(id).classList.add('step-done'));
            document.getElementById('s4').classList.add('step-active', 'step-done');

            const specialist = (data.predictions && data.predictions[0]) ?
                data.predictions[0].specialist :
                (data.top_specialist || 'General Physician');
            const matchingSpecialists = data.matching_specialists || [];

            document.getElementById('specialistName').textContent = specialist;
            document.getElementById('summaryAge').textContent = age;
            document.getElementById('summaryGender').textContent = gender;
            document.getElementById('summarySymptomCount').textContent = selectedSymptoms.length;

            const symDiv = document.getElementById('summarySymptoms');
            symDiv.innerHTML = '';
            selectedSymptoms.forEach(s => {
                const tag = document.createElement('span');
                tag.className = 'tag';
                tag.innerHTML = `<i class="fas fa-check-circle" style="font-size:11px;"></i> ${s}`;
                symDiv.appendChild(tag);
            });

            // Disease predictions — file-2 res-item style, top 3 only
            const predictions = data.predictions || [];
            const predictCard = document.getElementById('predictionsCard');
            const predList = document.getElementById('predictionsList');

            if (predictions.length) {
                predictCard.style.display = 'block';
                const top3 = predictions.slice(0, 3);
                const rankClass = ['rank-1', 'rank-2', 'rank-3'];

                predList.innerHTML = top3.map((p, idx) => {
                    const conf = parseFloat(p.disease_confidence) || 0;
                    const urgency = p.urgency || 'LOW';
                    const barClass = conf >= 70 ? 'conf-high' : conf >= 40 ? 'conf-mid' : 'conf-low';
                    const shapSymptoms = (p.shap_symptoms || []).slice(0, 5);

                    let shapHtml = '';
                    if (shapSymptoms.length) {
                        const getShapDescription = (value) => {
                            const abs = Math.abs(value);
                            if (value > 0) {
                                if (abs >= 30) return 'Strongly supports';
                                if (abs >= 15) return 'Moderately supports';
                                if (abs >= 5) return 'Slightly supports';
                                return 'Minimal support';
                            } else {
                                if (abs >= 30) return 'Strongly contradicts';
                                if (abs >= 15) return 'Moderately contradicts';
                                if (abs >= 5) return 'Slightly contradicts';
                                return 'Minimal contradiction';
                            }
                        };

                        const shapItems = shapSymptoms
                            .filter(s => {
                                const shap = parseFloat(s.shap_pct) || 0;
                                return shap > 0;
                            })
                            .map(s => {
                            const shap = parseFloat(s.shap_pct) || 0;
                            const absShap = Math.abs(shap).toFixed(2);
                            return `
                            <div class="shap-item">
                                <span class="shap-symptom-name">${s.symptom}</span>
                                <span class="shap-percentage positive">+${absShap}%</span>
                            </div>`;
                        }).join('');

                        shapHtml = `
                        <div class="shap-section">
                            <div class="shap-title">Symptom Contribution (SHAP)</div>
                            <div class="shap-items">${shapItems}</div>
                        </div>`;
                    }

                    return `
                <div class="res-item">
                    <div class="res-head">
                        <div class="res-head-left">
                            <div class="res-rank ${rankClass[idx]}">#${idx+1}</div>
                            <div>
                                <div class="res-disease">${p.disease}</div>
                                <div class="res-specialist-label">
                                    <i class="fas fa-user-md"></i>Specialist: <strong>${p.specialist}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bar-wrap">
                        <div class="bar-row">
                            <span>Model Confidence</span>
                            <span>${conf}%</span>
                        </div>
                        <div class="bar-bg">
                            <div class="bar-fill ${barClass}" data-width="${conf}"></div>
                        </div>
                    </div>
                    ${shapHtml}
                </div>`;
                }).join('');

                // Trigger animated bar fill
                requestAnimationFrame(() => setTimeout(() => {
                    predList.querySelectorAll('.bar-fill').forEach(bar => {
                        bar.style.width = bar.dataset.width + '%';
                    });
                }, 80));

            } else {
                predictCard.style.display = 'none';
            }

            const specCont = document.getElementById('matchingSpecialists');
            const noSpec = document.getElementById('noSpecialists');
            if (!matchingSpecialists.length) {
                specCont.innerHTML = '';
                noSpec.style.display = 'block';
            } else {
                noSpec.style.display = 'none';
                specCont.innerHTML = matchingSpecialists.map(doc => `
                <div class="specialist-card">
                    <div class="sc-header">
                        <div class="sc-avatar"><i class="fas fa-user-md"></i></div>
                        <div style="flex:1;">
                            <div class="sc-name">${doc.name}</div>
                            <div class="sc-qual">${doc.qualification}</div>
                            <div class="sc-spec">${doc.specialist}</div>
                        </div>
                        <div class="sc-fee">
                            <div class="fee-amt">BDT ${doc.consultation_fee}</div>
                            <div class="fee-lbl">Consult Fee</div>
                        </div>
                    </div>
                    <div class="sc-meta">
                        <div class="sc-meta-item">
                            <div class="mk">Experience</div>
                            <div class="mv">${doc.experience_years} years</div>
                        </div>
                        <div class="sc-meta-item">
                            <div class="mk">Clinic</div>
                            <div class="mv" title="${doc.clinic_address}">${doc.clinic_address}</div>
                        </div>
                    </div>
                    <p class="sc-bio">${doc.bio || 'Experienced specialist dedicated to patient care.'}</p>
                    <div class="sc-actions">
                        <a href="{{ route('login') }}" class="btn-book">
                            <i class="fas fa-calendar-plus"></i> Book Appointment
                        </a>
                        <button type="button" class="btn-details" onclick="viewDetails(${doc.id})">
                            <i class="fas fa-info-circle"></i> Details
                        </button>
                    </div>
                </div>
            `).join('');
            }

            document.getElementById('resultCard').style.display = 'block';
            setTimeout(() => document.getElementById('resultCard').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            }), 100);
        }

        function viewDetails(id) {
            alert('Doctor ID: ' + id);
        }

        function showError(msg) {
            errorText.textContent = msg;
            errorMsg.style.display = 'flex';
        }

        function hideError() {
            errorMsg.style.display = 'none';
        }

        function resetForm() {
            form.reset();
            selectedSymptoms = [];
            renderSelected();
            document.getElementById('resultCard').style.display = 'none';
            document.getElementById('emptyState').style.display = 'block';
            document.getElementById('loadingState').style.display = 'none';
            document.getElementById('predictionsCard').style.display = 'none';
            hideError();
            setStep(0);
            input.focus();
        }
    </script>
</body>

</html>
