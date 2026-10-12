<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - Pet Marketplace</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Additional Fonts for Header/Footer -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Manrope:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS for Header/Footer -->
    <link rel="stylesheet" href="{{ asset('css/pet-style.css') }}">
    <style>
        :root {
            --primary-green: #128c5a;
            --bg-color: #f7f9f8;
            --text-dark: #1f2937;
            --text-gray: #6b7280;
            --border-color: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Main Content */
        .main-content { width: 100%; flex-grow: 1; min-height: 100vh; display: flex; flex-direction: column; padding: 24px 0; }

        /* Welcome Banner */
        .welcome-banner {
            background-color: var(--primary-green);
            color: white;
            border-radius: 16px;
            padding: 24px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-shrink: 0;
        }

        .welcome-text h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 4px;
            color: white;
        }

        .welcome-text p {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.9);
        }

        .btn-notification {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.2s;
        }

        .btn-notification:hover {
            opacity: 0.8;
        }

        .btn-notification svg {
            width: 32px;
            height: 32px;
        }

        /* Chat Layout */
        .chat-container {
            position: sticky;
            top: 24px;
            height: 700px;
            display: flex;
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border-color);
            overflow: hidden;
            margin-bottom: 24px;
        }

        /* Left Sidebar (Chat List) */
        .chat-sidebar {
            width: 340px;
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .chat-sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            background: white;
            z-index: 10;
        }

        .chat-sidebar-header h2 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .search-box {
            width: 100%;
            padding: 10px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            margin-bottom: 16px;
        }
        
        .search-box::placeholder {
            color: #9ca3af;
        }

        .chat-tabs {
            display: flex;
            gap: 8px;
        }

        .chat-tab {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid var(--border-color);
            background: white;
            color: var(--text-gray);
        }

        .chat-tab.active {
            background: #e8f5e9;
            color: var(--primary-green);
            border-color: var(--primary-green);
        }

        .chat-list {
            flex-grow: 1;
            overflow-y: auto;
        }

        .chat-list::-webkit-scrollbar {
            width: 4px;
        }
        .chat-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .chat-item {
            padding: 16px 20px;
            display: flex;
            gap: 12px;
            cursor: pointer;
            border-bottom: 1px solid #E2E7E3;
            position: relative;
        }

        .chat-item:hover, .chat-item.active {
            background: #EAF7F0;
        }

        .chat-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            flex-shrink: 0;
        }

        .chat-item-info {
            flex-grow: 1;
            min-width: 0;
        }

        .chat-item-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 4px;
        }

        .chat-item-name {
            font-weight: 600;
            font-size: 15px;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-item-time {
            font-size: 12px;
            color: var(--text-gray);
        }

        .chat-item-pet {
            font-size: 13px;
            color: var(--primary-green);
            font-weight: 600;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-item-preview {
            font-size: 13px;
            color: var(--text-gray);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread-badge {
            background: var(--primary-green);
            color: white;
            font-size: 11px;
            font-weight: 600;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            right: 20px;
            top: 42px;
        }

        /* Right Window (Chat Details) */
        .chat-window {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background: #fafafa;
        }

        .chat-header {
            padding: 20px;
            background: white;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .chat-header-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-header-text h3 {
            font-size: 16px;
            font-weight: 600;
        }
        
        .chat-header-text p {
            font-size: 13px;
            color: var(--text-gray);
        }

        .chat-options-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: var(--text-gray);
            border-radius: 50%;
        }
        .chat-options-btn:hover {
            background: #f3f4f6;
        }

        /* Dropdown */
        .chat-dropdown {
            position: absolute;
            top: 60px;
            right: 20px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 160px;
            display: none;
            flex-direction: column;
            padding: 8px 0;
            z-scale: 10;
        }

        .chat-dropdown.show {
            display: flex;
        }

        .dropdown-item {
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 14px;
            color: var(--text-dark);
            cursor: pointer;
            transition: background 0.2s;
        }

        .dropdown-item:hover {
            background: #EAF7F0;
        }

        .dropdown-item img {
            width: 18px;
            height: 18px;
        }

        .dropdown-item.text-red {
            color: #ef4444;
        }

        /* Confirmation Modals */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(4px);
            z-index: 1050;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .modal-backdrop.show {
            opacity: 1;
            display: flex !important;
        }

        .modal-card {
            background: white;
            border-radius: 20px;
            padding: 32px 28px;
            width: 100%;
            max-width: 440px;
            text-align: center;
            position: relative;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: scale(0.95);
            transition: transform 0.25s ease;
        }

        .modal-backdrop.show .modal-card {
            transform: scale(1);
        }

        .modal-close-icon {
            position: absolute;
            top: 16px;
            right: 16px;
            background: none;
            border: none;
            color: #9ca3af;
            font-size: 18px;
            cursor: pointer;
            padding: 6px;
            border-radius: 50%;
            transition: color 0.2s, background-color 0.2s;
        }

        .modal-close-icon:hover {
            color: #111827;
            background: #f3f4f6;
        }

        .modal-icon-wrapper {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px auto;
            font-size: 24px;
        }

        .modal-icon-wrapper.danger {
            background-color: #fef2f2;
            color: #dc2626;
        }

        .modal-icon-wrapper.warning {
            background-color: #fffbe6;
            color: #d97706;
        }

        .modal-icon-wrapper.info {
            background-color: #eff6ff;
            color: #2563eb;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .modal-message {
            font-size: 14px;
            color: #6b7280;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
        }

        .btn-modal {
            flex: 1;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-modal-cancel {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-modal-cancel:hover {
            background: #e5e7eb;
        }

        .btn-modal-danger {
            background: #dc2626;
            color: white;
        }

        .btn-modal-danger:hover {
            background: #b91c1c;
        }

        .btn-modal-primary {
            background: var(--primary-green);
            color: white;
        }

        .btn-modal-primary:hover {
            background: #0f764a;
        }

        /* Cleared & Blocked Chat Notices */
        .cleared-chat-notice {
            text-align: center;
            padding: 32px 24px;
            color: #6b7280;
            font-size: 14px;
            background: #f9fafb;
            border-radius: 12px;
            border: 1px dashed #d1d5db;
            margin: auto 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .cleared-chat-notice i {
            font-size: 32px;
            color: #9ca3af;
        }

        .blocked-chat-banner {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .unblock-btn-sm {
            background: #dc2626;
            color: white;
            border: none;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .unblock-btn-sm:hover {
            background: #b91c1c;
        }

        .chat-item-blocked-tag {
            background: #fee2e2;
            color: #dc2626;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 4px;
            text-transform: uppercase;
            margin-left: 6px;
        }

        .toast-notification {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #111827;
            color: white;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            z-index: 2000;
            display: flex;
            align-items: center;
            gap: 10px;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
        }

        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        /* Context Card */
        .chat-context-card {
            margin: 20px 24px 0 24px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 12px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .chat-context-img {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
        }

        .chat-context-details h4 {
            font-size: 15px;
            font-weight: 600;
        }

        .chat-context-details p {
            font-size: 13px;
            color: var(--text-gray);
            margin-top: 4px;
        }

        /* Messages Area */
        .chat-messages {
            flex-grow: 1;
            padding: 24px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .chat-messages::-webkit-scrollbar {
            width: 6px;
        }
        .chat-messages::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .date-divider {
            text-align: center;
            margin: 8px 0;
        }

        .date-divider span {
            background: #f1f5f9;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            color: var(--text-gray);
            font-weight: 500;
        }

        .msg-bubble-container {
            display: flex;
            flex-direction: column;
            max-width: 70%;
        }

        .msg-bubble-container.received {
            align-self: flex-start;
        }

        .msg-bubble-container.sent {
            align-self: flex-end;
        }

        .msg-bubble {
            padding: 12px 16px;
            border-radius: 16px;
            font-size: 14px;
            line-height: 1.5;
            position: relative;
        }

        .msg-bubble-container.received .msg-bubble {
            background: #e5e7eb;
            color: var(--text-dark);
            border-bottom-left-radius: 4px;
        }

        .msg-bubble-container.sent .msg-bubble {
            background: var(--primary-green);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .msg-time {
            font-size: 11px;
            margin-top: 6px;
            display: inline-block;
        }

        .msg-bubble-container.received .msg-time {
            color: #6b7280;
            text-align: right;
            display: block;
        }

        .msg-bubble-container.sent .msg-time {
            color: rgba(255, 255, 255, 0.8);
            text-align: right;
            display: block;
        }

        /* Input Area */
        .chat-input-wrapper {
            padding: 20px 24px;
            background: white;
            border-top: 1px solid var(--border-color);
        }

        .chat-input-box {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 8px 16px;
        }

        .icon-btn {
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-gray);
        }
        
        .icon-btn img {
            width: 20px;
            height: 20px;
        }

        .chat-input {
            flex-grow: 1;
            border: none;
            outline: none;
            font-size: 14px;
            padding: 8px 0;
        }

        .chat-input::placeholder {
            color: #9ca3af;
        }

        .send-btn {
            background-color: var(--primary-green);
            border: none;
            border-radius: 8px;
            width: 32px;
            height: 32px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
        }

        .send-btn:hover {
            background-color: #0f764a;
        }

        .send-btn img {
            width: 16px;
            height: 16px;
            /* If the icon is black, we might want to invert it using filter, but assuming it's white or transparent */
        }

        /* Emoji Picker Popover */
        .emoji-picker-popover {
            position: absolute;
            bottom: calc(100% + 12px);
            left: 24px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
            padding: 12px;
            width: 290px;
            display: none;
            z-index: 100;
        }

        .emoji-picker-popover.show {
            display: block;
        }

        .emoji-picker-header {
            font-weight: 600;
            font-size: 12px;
            color: var(--text-gray);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .emoji-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 6px;
            max-height: 180px;
            overflow-y: auto;
        }

        .emoji-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            border-radius: 6px;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.15s, transform 0.1s;
        }

        .emoji-btn:hover {
            background: #f3f4f6;
            transform: scale(1.18);
        }

        /* Attachment Preview */
        .attachment-preview-wrapper {
            display: none;
            align-items: center;
            gap: 12px;
            background: #f8fafc;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 8px 12px;
            margin-bottom: 10px;
        }

        .attachment-preview-wrapper.show {
            display: flex;
        }

        .attachment-thumb {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }

        .attachment-info {
            flex-grow: 1;
            overflow: hidden;
        }

        .attachment-name {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .attachment-size {
            font-size: 11px;
            color: var(--text-gray);
        }

        .attachment-remove-btn {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            border-radius: 50%;
            width: 26px;
            height: 26px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: background 0.15s;
        }

        .attachment-remove-btn:hover {
            background: #fca5a5;
        }

        /* Attached Image in Message Bubble */
        .msg-attached-img {
            max-width: 240px;
            max-height: 200px;
            border-radius: 10px;
            margin-bottom: 6px;
            cursor: pointer;
            display: block;
            object-fit: cover;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: transform 0.15s, opacity 0.15s;
        }

        .msg-attached-img:hover {
            transform: scale(1.02);
            opacity: 0.95;
        }

        /* Typing Dots Animation */
        .typing-dots {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 10px 16px;
            min-width: 56px;
        }

        .typing-dots span {
            width: 7px;
            height: 7px;
            background-color: #9ca3af;
            border-radius: 50%;
            display: inline-block;
            animation: typingBounce 1.4s infinite ease-in-out both;
        }

        .typing-dots span:nth-child(1) {
            animation-delay: -0.32s;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: -0.16s;
        }

        @keyframes typingBounce {
            0%, 80%, 100% { transform: scale(0.3); opacity: 0.4; }
            40% { transform: scale(1); opacity: 1; }
        }

        /* Report Modal Styling */
        .report-modal-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px 28px 28px 28px;
            width: 90%;
            max-width: 440px;
            position: relative;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            max-height: 90vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .report-modal-title {
            font-size: 20px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 18px;
            padding-right: 24px;
        }

        .report-reasons-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
            max-height: 280px;
            overflow-y: auto;
            padding-right: 6px;
            margin-bottom: 18px;
        }

        .report-reasons-list::-webkit-scrollbar {
            width: 5px;
        }

        .report-reasons-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .report-reason-option {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
            user-select: none;
        }

        .report-reason-option input[type="radio"] {
            accent-color: var(--primary-green);
            width: 18px;
            height: 18px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .report-textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            outline: none;
            resize: none;
            height: 80px;
            margin-bottom: 20px;
            font-family: inherit;
            box-sizing: border-box;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .report-textarea:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 3px rgba(18, 140, 90, 0.15);
        }

        .btn-submit-report {
            background-color: var(--primary-green);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 14px 24px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s, transform 0.1s;
            display: block;
            text-align: center;
        }

        .btn-submit-report:hover {
            background-color: #0f764a;
        }
    
        @media (max-width: 991px) {
            .main-content {
                padding: 12px;
            }
            .welcome-banner {
                flex-direction: column;
                align-items: flex-start;
                padding: 20px;
                text-align: left;
            }
            .welcome-text {
                width: 100%;
            }
            .btn-notification {
                display: none;
            }
            .chat-container {
                border: none;
                margin: 0 -16px;
                border-radius: 0;
                height: auto;
                min-height: calc(100vh - 120px);
                margin-bottom: 0;
            }
            .chat-sidebar {
                width: 100%;
                border-right: none;
                background-color:#f7f9f8;
            }
            body.chat-active .chat-sidebar {
                display: none !important;
            }
            .chat-window {
                display: none;
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width: 100vw !important;
                height: 100vh !important;
                z-index: 99999 !important;
                background: #fafafa !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                border-radius: 0 !important;
                flex-direction: column !important;
            }
            body.chat-active .chat-window,
            .chat-container.chat-active .chat-window,
            .chat-window.active {
                display: flex !important;
            }
            footer {
                display: none !important;
            }
            body.chat-active header, body.chat-active .mobile-bottom-nav {
                display: none !important;
            }
            .chat-back-btn {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }
            .chat-header {
                padding: 12px 16px;
                flex-shrink: 0;
            }
            .chat-context-card {
                margin: 16px 16px 0 16px;
            }
            .chat-messages {
                padding: 16px;
            }
            .chat-input-wrapper {
                padding: 16px;
                flex-shrink: 0;
                padding-bottom: env(safe-area-inset-bottom, 16px);
            }
            /* Adjust chat tabs to scroll natively if they are long */
            .chat-tabs {
                overflow-x: auto;
                padding-bottom: 4px;
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .chat-tabs::-webkit-scrollbar {
                display: none;
            }
            .chat-tab {
                flex-shrink: 0;
            }
            .chat-sidebar-header {
                background-color: #f7f9f8;
            }
            .chat-item.active {
                background-color: transparent;
            }
            .chat-item:hover, .chat-item.active:hover {
                background-color: #EAF7F0;
            }
            .chat-tabs {
                justify-content: space-between;
                gap: 8px;
            }
            .chat-tab {
                width: 96px;
                max-width: 96px;
                height: 36px;
                border-radius: 10px;
                padding: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                flex: 1;
            }
        }
    </style>
</head>
<body>

    <x-header />

    <!-- Main Content -->
    <div class="shell-1440" style="flex-grow:1;"><div class="container"><main class="main-content">
        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-text">
                <h1>Messages / Inquiries</h1>
                <p>Reply to buyers and manage conversations related to your pet listings.</p>
            </div>
            <x-notification-bell />
        </div>

        <!-- Chat Container -->
        <div class="chat-container">
            <!-- Left Sidebar -->
            <div class="chat-sidebar">
                <div class="chat-sidebar-header">
                    <h2>Chats</h2>
                    <input type="text" class="search-box" placeholder="Search conversations...">
                    <div class="chat-tabs">
                        <button class="chat-tab active">All</button>
                        <button class="chat-tab">Unread</button>
                        <button class="chat-tab">Recent</button>
                    </div>
                </div>
                
                <div class="chat-list">
                    <!-- Chat Item 1 (Active) -->
                    <div class="chat-item active" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Ali+Raza&background=random" alt="Ali Raza" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Ali Raza</span>
                                <span class="chat-item-time">10m</span>
                            </div>
                            <div class="chat-item-pet">Golden Retriever Puppy</div>
                            <div class="chat-item-preview">Is the Golden Retriever still...</div>
                        </div>
                        <div class="unread-badge">2</div>
                    </div>

                    <!-- Chat Item 2 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Ali+Raza&background=random" alt="Ali Raza" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Ali Raza</span>
                                <span class="chat-item-time">10m</span>
                            </div>
                            <div class="chat-item-pet">Golden Retriever Puppy</div>
                            <div class="chat-item-preview">Is the Golden Retriever still...</div>
                        </div>
                    </div>

                    <!-- Chat Item 3 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Ali+Raza&background=random" alt="Ali Raza" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Ali Raza</span>
                                <span class="chat-item-time">1h</span>
                            </div>
                            <div class="chat-item-pet">Golden Retriever Puppy</div>
                            <div class="chat-item-preview">Is the Golden Retriever still...</div>
                        </div>
                    </div>

                    <!-- Chat Item 4 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Sarah+Khan&background=random" alt="Sarah Khan" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Sarah Khan</span>
                                <span class="chat-item-time">2h</span>
                            </div>
                            <div class="chat-item-pet">Persian Cat</div>
                            <div class="chat-item-preview">What is the final price?</div>
                        </div>
                    </div>

                    <!-- Chat Item 5 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Usman+Ahmed&background=random" alt="Usman Ahmed" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Usman Ahmed</span>
                                <span class="chat-item-time">3h</span>
                            </div>
                            <div class="chat-item-pet">German Shepherd</div>
                            <div class="chat-item-preview">Where are you located?</div>
                        </div>
                    </div>

                    <!-- Chat Item 6 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Aisha+Malik&background=random" alt="Aisha Malik" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Aisha Malik</span>
                                <span class="chat-item-time">5h</span>
                            </div>
                            <div class="chat-item-pet">British Shorthair</div>
                            <div class="chat-item-preview">Is this male or female?</div>
                        </div>
                    </div>

                    <!-- Chat Item 7 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Zain+Ali&background=random" alt="Zain Ali" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Zain Ali</span>
                                <span class="chat-item-time">1d</span>
                            </div>
                            <div class="chat-item-pet">Mini Lop Rabbit</div>
                            <div class="chat-item-preview">Can you deliver it to Islamabad?</div>
                        </div>
                    </div>

                    <!-- Chat Item 8 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Fatima+Tariq&background=random" alt="Fatima Tariq" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Fatima Tariq</span>
                                <span class="chat-item-time">1d</span>
                            </div>
                            <div class="chat-item-pet">African Grey Parrot</div>
                            <div class="chat-item-preview">How old is it?</div>
                        </div>
                    </div>

                    <!-- Chat Item 9 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Bilal+Mustafa&background=random" alt="Bilal Mustafa" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Bilal Mustafa</span>
                                <span class="chat-item-time">2d</span>
                            </div>
                            <div class="chat-item-pet">Shih Tzu Puppy</div>
                            <div class="chat-item-preview">I am interested, please reply.</div>
                        </div>
                    </div>

                    <!-- Chat Item 10 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Sana+Nadeem&background=random" alt="Sana Nadeem" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Sana Nadeem</span>
                                <span class="chat-item-time">2d</span>
                            </div>
                            <div class="chat-item-pet">Lovebird Pair</div>
                            <div class="chat-item-preview">Do they come with a cage?</div>
                        </div>
                    </div>

                    <!-- Chat Item 11 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Kamran+Shah&background=random" alt="Kamran Shah" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Kamran Shah</span>
                                <span class="chat-item-time">3d</span>
                            </div>
                            <div class="chat-item-pet">Beagle Puppy</div>
                            <div class="chat-item-preview">Thanks!</div>
                        </div>
                    </div>

                    <!-- Chat Item 12 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Nida+Hassan&background=random" alt="Nida Hassan" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Nida Hassan</span>
                                <span class="chat-item-time">4d</span>
                            </div>
                            <div class="chat-item-pet">Siberian Husky</div>
                            <div class="chat-item-preview">Are the vaccinations complete?</div>
                        </div>
                    </div>

                    <!-- Chat Item 13 -->
                    <div class="chat-item" onclick="document.body.classList.add('chat-active')">
                        <img src="https://ui-avatars.com/api/?name=Fahad+Qureshi&background=random" alt="Fahad Qureshi" class="chat-avatar">
                        <div class="chat-item-info">
                            <div class="chat-item-header">
                                <span class="chat-item-name">Fahad Qureshi</span>
                                <span class="chat-item-time">5d</span>
                            </div>
                            <div class="chat-item-pet">Cockatiel</div>
                            <div class="chat-item-preview">I will visit tomorrow morning.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Window -->
            <div class="chat-window">
                <!-- Chat Header -->
                <div class="chat-header">
                    <div class="chat-header-info">
                        <button class="chat-back-btn" onclick="document.body.classList.remove('chat-active'); document.querySelector('.chat-container')?.classList.remove('chat-active'); document.querySelector('.chat-window')?.classList.remove('active');" style="display: none; background: none; border: none; cursor: pointer; padding-right: 12px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </button>
                        <img src="https://ui-avatars.com/api/?name=Ali+Raza&background=random" alt="Ali Raza" class="chat-avatar">
                        <div class="chat-header-text">
                            <h3>Ali Raza</h3>
                            <p>Buyer inquiry</p>
                        </div>
                    </div>
                    
                    <button class="chat-options-btn" onclick="toggleDropdown()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="12" cy="5" r="1"></circle>
                            <circle cx="12" cy="19" r="1"></circle>
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div class="chat-dropdown" id="chatDropdown">
                        <div class="dropdown-item" id="clearChatOption" onclick="openClearChatModal()">
                            <img src="{{ asset('images/minus-circle 1.svg') }}" alt="Clear chat" onerror="this.src='https://api.iconify.design/lucide:minus-circle.svg'">
                            <span>Clear chat</span>
                        </div>
                        <div class="dropdown-item" id="reportOption" onclick="openReportModal()">
                            <img src="{{ asset('images/hand 1.svg') }}" alt="Report" onerror="this.src='https://api.iconify.design/lucide:thumbs-down.svg'">
                            <span>Report</span>
                        </div>
                        <div class="dropdown-item text-red" id="blockOption" onclick="handleBlockClick()">
                            <img src="{{ asset('images/ban.svg') }}" alt="Block" onerror="this.src='https://api.iconify.design/lucide:ban.svg'">
                            <span id="blockBtnLabel">Block</span>
                        </div>
                    </div>
                </div>

                <!-- Context Card -->
                <div class="chat-context-card">
                    <img src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever Puppy" class="chat-context-img" onerror="this.src='https://images.unsplash.com/photo-1600804340584-c7db2eacf0bf?auto=format&fit=crop&w=100&q=80'">
                    <div class="chat-context-details" style="flex-grow: 1;">
                        <h4>Golden Retriever Puppy</h4>
                        <p>Lahore</p>
                    </div>
                    <div class="chat-context-price" style="font-weight: 700; color: var(--primary-green); white-space: nowrap;">
                        Rs. 85,000
                    </div>
                </div>

                <!-- Messages -->
                <div class="chat-messages">
                    <div class="date-divider">
                        <span>Today</span>
                    </div>

                    <div class="msg-bubble-container received">
                        <div class="msg-bubble">
                            Hi, is the Golden Retriever still available?
                            <span class="msg-time">10:22 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container sent">
                        <div class="msg-bubble">
                            Yes, it is currently available.
                            <span class="msg-time">10:25 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container received">
                        <div class="msg-bubble">
                            Can you share vaccination details and when I can visit?
                            <span class="msg-time">10:26 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container sent">
                        <div class="msg-bubble">
                            Sure, all vaccinations are up to date. I will share the records.
                            <span class="msg-time">10:28 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container sent">
                        <div class="msg-bubble">
                            You can visit tomorrow evening between 5 PM and 8 PM. Does that work for you?
                            <span class="msg-time">10:28 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container received">
                        <div class="msg-bubble">
                            Tomorrow evening works perfectly for me.
                            <span class="msg-time">10:35 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container received">
                        <div class="msg-bubble">
                            Could you please share your exact address?
                            <span class="msg-time">10:35 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container sent">
                        <div class="msg-bubble">
                            Yes, it's House 123, Block C, Phase 1, DHA Lahore.
                            <span class="msg-time">10:40 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container received">
                        <div class="msg-bubble">
                            Got it. Is the price negotiable?
                            <span class="msg-time">10:45 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container sent">
                        <div class="msg-bubble">
                            We can discuss the price when you visit. I am open to slight negotiation.
                            <span class="msg-time">10:50 AM</span>
                        </div>
                    </div>

                    <div class="msg-bubble-container received">
                        <div class="msg-bubble">
                            Sounds good. See you tomorrow.
                            <span class="msg-time">10:55 AM</span>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="chat-input-wrapper" style="position: relative;">
                    <!-- Attachment Preview Container -->
                    <div id="attachmentPreviewWrapper" class="attachment-preview-wrapper">
                        <img id="attachmentThumb" src="" alt="Attachment" class="attachment-thumb">
                        <div class="attachment-info">
                            <div id="attachmentName" class="attachment-name">image.jpg</div>
                            <div id="attachmentSize" class="attachment-size">0 KB</div>
                        </div>
                        <button type="button" class="attachment-remove-btn" onclick="removeAttachment()"><i class="fa-solid fa-xmark"></i></button>
                    </div>

                    <!-- Emoji Picker Popover -->
                    <div id="emojiPickerPopover" class="emoji-picker-popover">
                        <div class="emoji-picker-header">Pick an emoji</div>
                        <div class="emoji-grid">
                            <button type="button" class="emoji-btn">😊</button>
                            <button type="button" class="emoji-btn">😃</button>
                            <button type="button" class="emoji-btn">😄</button>
                            <button type="button" class="emoji-btn">😍</button>
                            <button type="button" class="emoji-btn">👍</button>
                            <button type="button" class="emoji-btn">❤️</button>
                            <button type="button" class="emoji-btn">🙏</button>
                            <button type="button" class="emoji-btn">🐶</button>
                            <button type="button" class="emoji-btn">🐱</button>
                            <button type="button" class="emoji-btn">🐾</button>
                            <button type="button" class="emoji-btn">💰</button>
                            <button type="button" class="emoji-btn">📍</button>
                            <button type="button" class="emoji-btn">💉</button>
                            <button type="button" class="emoji-btn">✨</button>
                            <button type="button" class="emoji-btn">🎉</button>
                            <button type="button" class="emoji-btn">🤝</button>
                            <button type="button" class="emoji-btn">📞</button>
                            <button type="button" class="emoji-btn">🚗</button>
                            <button type="button" class="emoji-btn">🐕</button>
                            <button type="button" class="emoji-btn">🐈</button>
                            <button type="button" class="emoji-btn">🏆</button>
                        </div>
                    </div>

                    <div class="chat-input-box">
                        <button type="button" class="icon-btn" id="emojiToggleBtn" title="Insert Emoji">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                        </button>
                        <input type="text" class="chat-input" placeholder="Write a reply...">
                        <input type="file" id="chatFileInput" accept="image/*" style="display: none;">
                        <button type="button" class="icon-btn" id="attachFileBtn" title="Attach Image">
                            <img src="{{ asset('images/clip-icon.svg') }}" alt="Attach">
                        </button>
                        <button type="button" class="send-btn" id="sendMessageBtn" title="Send Message">
                            <img src="{{ asset('images/send-icon.svg') }}" alt="Send">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main></div></div>

    <!-- Clear Chat Confirmation Modal -->
    <div id="clearChatModal" class="modal-backdrop">
        <div class="modal-card">
            <button type="button" class="modal-close-icon" onclick="closeClearChatModal()"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-icon-wrapper warning">
                <i class="fa-solid fa-minus-circle"></i>
            </div>
            <h3 class="modal-title">Clear Chat</h3>
            <p class="modal-message">Are you sure you want to clear this chat with <strong id="clearChatUserName">Ali Raza</strong>? All messages in this conversation will be cleared.</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-modal-cancel" onclick="closeClearChatModal()">Cancel</button>
                <button type="button" class="btn-modal btn-modal-danger" id="confirmClearChatBtn">Clear Chat</button>
            </div>
        </div>
    </div>

    <!-- Block User Confirmation Modal -->
    <div id="blockUserModal" class="modal-backdrop">
        <div class="modal-card">
            <button type="button" class="modal-close-icon" onclick="closeBlockUserModal()"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-icon-wrapper danger">
                <i class="fa-solid fa-ban"></i>
            </div>
            <h3 class="modal-title" id="blockModalTitle">Block User</h3>
            <p class="modal-message" id="blockModalMessage">Are you sure you want to block <strong id="blockChatUserName">Ali Raza</strong>? They will no longer be able to send messages to you.</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-modal-cancel" onclick="closeBlockUserModal()">Cancel</button>
                <button type="button" class="btn-modal btn-modal-danger" id="confirmBlockUserBtn">Block User</button>
            </div>
        </div>
    </div>

    <!-- Report User Modal -->
    <div id="reportModal" class="modal-backdrop">
        <div class="report-modal-card">
            <button type="button" class="modal-close-icon" onclick="closeReportModal()"><i class="fa-solid fa-xmark"></i></button>
            <h3 class="report-modal-title">Report This User</h3>
            <form id="reportUserForm" onsubmit="handleReportSubmit(event)">
                <div class="report-reasons-list">
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Scam / Fraud" checked>
                        <span>Scam / Fraud</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Fake Listing or Misleading Product">
                        <span>Fake Listing or Misleading Product</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Asking for Payment Outside the Platform">
                        <span>Asking for Payment Outside the Platform</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Spam / Unwanted Messages">
                        <span>Spam / Unwanted Messages</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Harassment / Abusive Messages">
                        <span>Harassment / Abusive Messages</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Fake Identity / Impersonation">
                        <span>Fake Identity / Impersonation</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Suspicious Payment Activity">
                        <span>Suspicious Payment Activity</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Threats or Blackmail">
                        <span>Threats or Blackmail</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Sharing Personal Information">
                        <span>Sharing Personal Information</span>
                    </label>
                    <label class="report-reason-option">
                        <input type="radio" name="report_reason" value="Other">
                        <span>Other</span>
                    </label>
                </div>
                <textarea class="report-textarea" id="reportDetailsInput" placeholder="Additional details"></textarea>
                <button type="submit" class="btn-submit-report">Submit Report</button>
            </form>
        </div>
    </div>

    <!-- Image Lightbox Modal -->
    <div id="imageLightboxModal" class="modal-backdrop" onclick="closeImageLightboxModal()">
        <div style="position: relative; max-width: 90vw; max-height: 90vh;" onclick="event.stopPropagation()">
            <button type="button" class="modal-close-icon" onclick="closeImageLightboxModal()" style="color: white; background: rgba(0,0,0,0.6); border-radius: 50%; width: 36px; height: 36px;"><i class="fa-solid fa-xmark"></i></button>
            <img id="lightboxImg" src="" alt="Full view" style="max-width: 90vw; max-height: 85vh; border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); display: block; object-fit: contain;">
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toastNotification" class="toast-notification">
        <i class="fa-solid fa-circle-check" style="color:#22c55e;"></i>
        <span id="toastMessage">Action completed successfully.</span>
    </div>

    <script>
        // State variables
        let activeChatId = 'chat-1';
        let activeUserName = 'Ali Raza';
        let activePetName = 'Golden Retriever Puppy';
        let activePetPrice = 'Rs. 85,000';
        let currentAttachment = null;

        // Retrieve stored state from localStorage
        let clearedChats = JSON.parse(localStorage.getItem('cleared_chats') || '{}');
        let blockedUsers = JSON.parse(localStorage.getItem('blocked_users') || '{}');
        let customMessages = JSON.parse(localStorage.getItem('chat_messages_data') || '{}');

        // Sample message sets for different chats
        const chatMessagesData = {
            'chat-1': [
                { type: 'received', text: 'Hi, is the Golden Retriever still available?', time: '10:22 AM' },
                { type: 'sent', text: 'Yes, it is currently available.', time: '10:25 AM' },
                { type: 'received', text: 'Can you share vaccination details and when I can visit?', time: '10:26 AM' },
                { type: 'sent', text: 'Sure, all vaccinations are up to date. I will share the records.', time: '10:28 AM' },
                { type: 'sent', text: 'You can visit tomorrow evening between 5 PM and 8 PM. Does that work for you?', time: '10:28 AM' },
                { type: 'received', text: 'Tomorrow evening works perfectly for me.', time: '10:35 AM' },
                { type: 'received', text: 'Could you please share your exact address?', time: '10:35 AM' },
                { type: 'sent', text: "Yes, it's House 123, Block C, Phase 1, DHA Lahore.", time: '10:40 AM' },
                { type: 'received', text: 'Got it. Is the price negotiable?', time: '10:45 AM' },
                { type: 'sent', text: 'We can discuss the price when you visit. I am open to slight negotiation.', time: '10:50 AM' },
                { type: 'received', text: 'Sounds good. See you tomorrow.', time: '10:55 AM' }
            ],
            'chat-2': [
                { type: 'received', text: 'Hi, is the Golden Retriever still available?', time: '10:22 AM' },
                { type: 'sent', text: 'Yes, it is available.', time: '10:25 AM' }
            ],
            'chat-3': [
                { type: 'received', text: 'Hi, is the Golden Retriever still available?', time: '10:22 AM' }
            ],
            'chat-4': [
                { type: 'received', text: 'What is the final price for the Persian Cat?', time: '08:15 AM' },
                { type: 'sent', text: 'Hi Sarah! The final price is Rs. 45,000.', time: '08:20 AM' }
            ],
            'chat-5': [
                { type: 'received', text: 'Where are you located?', time: '07:45 AM' },
                { type: 'sent', text: 'We are located in DHA Phase 5, Lahore.', time: '07:50 AM' }
            ],
            'chat-6': [
                { type: 'received', text: 'Is this male or female?', time: '05:30 AM' }
            ],
            'chat-7': [
                { type: 'received', text: 'Can you deliver it to Islamabad?', time: 'Yesterday' }
            ],
            'chat-8': [
                { type: 'received', text: 'How old is it?', time: 'Yesterday' }
            ],
            'chat-9': [
                { type: 'received', text: 'I am interested, please reply.', time: '2 days ago' }
            ],
            'chat-10': [
                { type: 'received', text: 'Do they come with a cage?', time: '2 days ago' }
            ],
            'chat-11': [
                { type: 'received', text: 'Thanks!', time: '3 days ago' }
            ],
            'chat-12': [
                { type: 'received', text: 'Are the vaccinations complete?', time: '4 days ago' }
            ],
            'chat-13': [
                { type: 'received', text: 'I will visit tomorrow morning.', time: '5 days ago' }
            ]
        };

        // Merge saved chat messages from localStorage
        Object.keys(customMessages).forEach(id => {
            chatMessagesData[id] = customMessages[id];
        });

        // Ensure cleared chats start with an empty messages array
        Object.keys(clearedChats).forEach(id => {
            if (clearedChats[id]) {
                chatMessagesData[id] = [];
            }
        });

        const simulatedReplies = [
            "Thank you for the quick reply! That works for me.",
            "Sounds great! Can you please share any additional pictures if available?",
            "Got it. What time would be best to contact or visit?",
            "Awesome, thank you! I will keep you updated.",
            "Perfect! I will confirm my visit details shortly.",
            "Thanks! Is the price firm or negotiable?"
        ];

        function toggleDropdown() {
            document.getElementById('chatDropdown').classList.toggle('show');
        }

        window.onclick = function(event) {
            if (!event.target.closest('.chat-options-btn') && !event.target.closest('.chat-dropdown')) {
                var dropdowns = document.getElementsByClassName("chat-dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
            if (!event.target.closest('#emojiPickerPopover') && !event.target.closest('#emojiToggleBtn')) {
                hideEmojiPicker();
            }
        }

        function showToast(message) {
            const toast = document.getElementById('toastNotification');
            const toastMsg = document.getElementById('toastMessage');
            if (toast && toastMsg) {
                toastMsg.textContent = message;
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3200);
            }
        }

        // Open Clear Chat Modal
        function openClearChatModal() {
            const dropdown = document.getElementById('chatDropdown');
            if (dropdown) dropdown.classList.remove('show');
            const nameElem = document.getElementById('clearChatUserName');
            if (nameElem) nameElem.textContent = activeUserName;
            const modal = document.getElementById('clearChatModal');
            if (modal) modal.classList.add('show');
        }

        function closeClearChatModal() {
            const modal = document.getElementById('clearChatModal');
            if (modal) modal.classList.remove('show');
        }

        // Open Block User Modal
        let isUnblockingState = false;
        function handleBlockClick() {
            const dropdown = document.getElementById('chatDropdown');
            if (dropdown) dropdown.classList.remove('show');
            openBlockUserModal(!!blockedUsers[activeChatId]);
        }

        function openBlockUserModal(unblock = false) {
            isUnblockingState = unblock;
            const nameElem = document.getElementById('blockChatUserName');
            const titleElem = document.getElementById('blockModalTitle');
            const msgElem = document.getElementById('blockModalMessage');
            const confirmBtn = document.getElementById('confirmBlockUserBtn');

            if (nameElem) nameElem.textContent = activeUserName;
            
            if (unblock) {
                if (titleElem) titleElem.textContent = 'Unblock User';
                if (msgElem) msgElem.innerHTML = `Are you sure you want to unblock <strong>${activeUserName}</strong>? They will be able to message you again.`;
                if (confirmBtn) {
                    confirmBtn.textContent = 'Unblock User';
                    confirmBtn.className = 'btn-modal btn-modal-primary';
                }
            } else {
                if (titleElem) titleElem.textContent = 'Block User';
                if (msgElem) msgElem.innerHTML = `Are you sure you want to block <strong>${activeUserName}</strong>? They will no longer be able to send messages to you.`;
                if (confirmBtn) {
                    confirmBtn.textContent = 'Block User';
                    confirmBtn.className = 'btn-modal btn-modal-danger';
                }
            }
            
            const modal = document.getElementById('blockUserModal');
            if (modal) modal.classList.add('show');
        }

        function closeBlockUserModal() {
            const modal = document.getElementById('blockUserModal');
            if (modal) modal.classList.remove('show');
        }

        // Open Report Modal
        function openReportModal() {
            const dropdown = document.getElementById('chatDropdown');
            if (dropdown) dropdown.classList.remove('show');
            const modal = document.getElementById('reportModal');
            if (modal) modal.classList.add('show');
        }

        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            if (modal) modal.classList.remove('show');
        }

        function handleReportSubmit(e) {
            if (e) e.preventDefault();
            const detailsInput = document.getElementById('reportDetailsInput');
            if (detailsInput) detailsInput.value = '';
            closeReportModal();
            showToast(`Thank you. Your report regarding ${activeUserName} has been submitted.`);
        }

        // Emoji & Attachment Helpers
        function toggleEmojiPicker() {
            const picker = document.getElementById('emojiPickerPopover');
            if (picker) picker.classList.toggle('show');
        }

        function hideEmojiPicker() {
            const picker = document.getElementById('emojiPickerPopover');
            if (picker) picker.classList.remove('show');
        }

        function handleFileSelect(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                currentAttachment = {
                    name: file.name,
                    size: (file.size / 1024).toFixed(1) + ' KB',
                    dataUrl: event.target.result
                };
                showAttachmentPreview(currentAttachment);
            };
            reader.readAsDataURL(file);
        }

        function showAttachmentPreview(att) {
            const wrapper = document.getElementById('attachmentPreviewWrapper');
            const thumb = document.getElementById('attachmentThumb');
            const name = document.getElementById('attachmentName');
            const size = document.getElementById('attachmentSize');

            if (wrapper && thumb && name && size) {
                thumb.src = att.dataUrl;
                name.textContent = att.name;
                size.textContent = att.size;
                wrapper.classList.add('show');
            }
        }

        function removeAttachment() {
            currentAttachment = null;
            const wrapper = document.getElementById('attachmentPreviewWrapper');
            if (wrapper) wrapper.classList.remove('show');
            const fileInput = document.getElementById('chatFileInput');
            if (fileInput) fileInput.value = '';
        }

        function openImageLightboxModal(imgSrc) {
            const lightboxImg = document.getElementById('lightboxImg');
            const modal = document.getElementById('imageLightboxModal');
            if (lightboxImg && modal) {
                lightboxImg.src = imgSrc;
                modal.classList.add('show');
            }
        }

        function closeImageLightboxModal() {
            const modal = document.getElementById('imageLightboxModal');
            if (modal) modal.classList.remove('show');
        }

        function triggerSimulatedBuyerReply(targetChatId) {
            setTimeout(() => {
                if (activeChatId === targetChatId && !blockedUsers[targetChatId]) {
                    const messagesContainer = document.querySelector('.chat-messages');
                    if (messagesContainer && !document.getElementById('typingIndicatorBubble')) {
                        const typingEl = document.createElement('div');
                        typingEl.className = 'msg-bubble-container received typing-indicator-bubble';
                        typingEl.id = 'typingIndicatorBubble';
                        typingEl.innerHTML = `
                            <div class="msg-bubble typing-dots">
                                <span></span><span></span><span></span>
                            </div>
                        `;
                        messagesContainer.appendChild(typingEl);
                        messagesContainer.scrollTop = messagesContainer.scrollHeight;
                    }
                }
            }, 1200);

            setTimeout(() => {
                const typingEl = document.getElementById('typingIndicatorBubble');
                if (typingEl) typingEl.remove();

                if (!blockedUsers[targetChatId]) {
                    const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    const replyText = simulatedReplies[Math.floor(Math.random() * simulatedReplies.length)];

                    if (!chatMessagesData[targetChatId]) chatMessagesData[targetChatId] = [];
                    chatMessagesData[targetChatId].push({
                        type: 'received',
                        text: replyText,
                        time: timeStr
                    });
                    localStorage.setItem('chat_messages_data', JSON.stringify(chatMessagesData));

                    const activeItem = document.querySelector(`.chat-item[data-chat-id="${targetChatId}"]`);
                    if (activeItem) {
                        const preview = activeItem.querySelector('.chat-item-preview');
                        if (preview) preview.textContent = replyText;
                        const timeElem = activeItem.querySelector('.chat-item-time');
                        if (timeElem) timeElem.textContent = 'Just now';
                    }

                    if (activeChatId === targetChatId) {
                        renderActiveChat();
                    }
                }
            }, 2600);
        }

        // Render current active chat state
        function renderActiveChat() {
            // Update Header Name
            const headerName = document.querySelector('.chat-header-text h3');
            if (headerName) headerName.textContent = activeUserName;
            
            const headerAvatar = document.querySelector('.chat-header-info .chat-avatar');
            if (headerAvatar) headerAvatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(activeUserName)}&background=random`;

            // Update Context Card
            const ctxTitle = document.querySelector('.chat-context-details h4');
            if (ctxTitle) ctxTitle.textContent = activePetName;
            
            const ctxPrice = document.querySelector('.chat-context-price');
            if (ctxPrice) ctxPrice.textContent = activePetPrice;

            // Render Messages
            const messagesContainer = document.querySelector('.chat-messages');
            if (messagesContainer) {
                if (clearedChats[activeChatId]) {
                    messagesContainer.innerHTML = `
                        <div class="cleared-chat-notice">
                            <i class="fa-solid fa-circle-info"></i>
                            <p>You have cleared this chat history.</p>
                        </div>
                    `;
                } else {
                    const msgs = chatMessagesData[activeChatId] || [];
                    let html = `<div class="date-divider"><span>Today</span></div>`;
                    msgs.forEach(m => {
                        let imgHtml = m.image ? `<img src="${m.image}" alt="Attachment" class="msg-attached-img" onclick="openImageLightboxModal('${m.image}')">` : '';
                        let textHtml = m.text ? `<div>${m.text}</div>` : '';
                        html += `
                            <div class="msg-bubble-container ${m.type}">
                                <div class="msg-bubble">
                                    ${imgHtml}
                                    ${textHtml}
                                    <span class="msg-time">${m.time}</span>
                                </div>
                            </div>
                        `;
                    });
                    messagesContainer.innerHTML = html;
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            }

            // Render Blocked state
            const blockBtnLabel = document.getElementById('blockBtnLabel');
            const chatInput = document.querySelector('.chat-input');
            const sendBtn = document.querySelector('.send-btn');
            const inputWrapper = document.querySelector('.chat-input-wrapper');
            let banner = document.getElementById('blockedChatBanner');

            if (blockedUsers[activeChatId]) {
                if (blockBtnLabel) blockBtnLabel.textContent = 'Unblock';
                if (chatInput) {
                    chatInput.disabled = true;
                    chatInput.placeholder = 'You have blocked this user.';
                    chatInput.value = '';
                }
                if (sendBtn) sendBtn.style.opacity = '0.5';

                if (!banner && inputWrapper) {
                    banner = document.createElement('div');
                    banner.id = 'blockedChatBanner';
                    banner.className = 'blocked-chat-banner';
                    banner.innerHTML = `
                        <span><i class="fa-solid fa-ban" style="margin-right:6px;"></i> You have blocked this user.</span>
                        <button class="unblock-btn-sm" onclick="openBlockUserModal(true)">Unblock</button>
                    `;
                    inputWrapper.parentNode.insertBefore(banner, inputWrapper);
                }
            } else {
                if (blockBtnLabel) blockBtnLabel.textContent = 'Block';
                if (chatInput) {
                    chatInput.disabled = false;
                    chatInput.placeholder = 'Write a reply...';
                }
                if (sendBtn) sendBtn.style.opacity = '1';
                if (banner) banner.remove();
            }

            // Update sidebar items state & tags
            document.querySelectorAll('.chat-item').forEach(item => {
                const itemId = item.getAttribute('data-chat-id');
                let tag = item.querySelector('.chat-item-blocked-tag');
                if (blockedUsers[itemId]) {
                    if (!tag) {
                        const nameHeader = item.querySelector('.chat-item-name');
                        if (nameHeader) {
                            tag = document.createElement('span');
                            tag.className = 'chat-item-blocked-tag';
                            tag.textContent = 'Blocked';
                            nameHeader.appendChild(tag);
                        }
                    }
                } else if (tag) {
                    tag.remove();
                }

                if (clearedChats[itemId]) {
                    const prev = item.querySelector('.chat-item-preview');
                    if (prev) prev.textContent = 'Chat cleared';
                }
            });
        }

        // Initialize Chat Click Listeners & Handlers
        document.addEventListener('DOMContentLoaded', () => {
            const chatItems = document.querySelectorAll('.chat-item');
            const chatTabs = document.querySelectorAll('.chat-tab');

            chatTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    chatTabs.forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');

                    const filter = tab.textContent.trim().toLowerCase();

                    chatItems.forEach(item => {
                        const isUnread = item.querySelector('.unread-badge') !== null;
                        const timeText = item.querySelector('.chat-item-time').textContent;
                        const isRecent = timeText.includes('m') || timeText.includes('h');
                        const isNew = timeText.includes('m');

                        if (filter === 'all') {
                            item.style.display = '';
                        } else if (filter === 'unread' && isUnread) {
                            item.style.display = '';
                        } else if (filter === 'recent' && isRecent) {
                            item.style.display = '';
                        } else if (filter === 'new' && isNew) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            chatItems.forEach((item, index) => {
                const chatId = `chat-${index + 1}`;
                item.setAttribute('data-chat-id', chatId);

                const nameElem = item.querySelector('.chat-item-name');
                const petElem = item.querySelector('.chat-item-pet');

                if (nameElem) item.setAttribute('data-user-name', nameElem.textContent.replace('Blocked','').trim());
                if (petElem) item.setAttribute('data-pet-name', petElem.textContent.trim());

                item.addEventListener('click', () => {
                    chatItems.forEach(i => i.classList.remove('active'));
                    item.classList.add('active');

                    activeChatId = chatId;
                    activeUserName = item.getAttribute('data-user-name') || 'User';
                    activePetName = item.getAttribute('data-pet-name') || 'Pet';
                    activePetPrice = index === 3 ? 'Rs. 45,000' : index === 4 ? 'Rs. 65,000' : 'Rs. 85,000';

                    document.body.classList.add('chat-active');
                    const chatContainer = document.querySelector('.chat-container');
                    if (chatContainer) chatContainer.classList.add('chat-active');
                    const chatWin = document.querySelector('.chat-window');
                    if (chatWin) chatWin.classList.add('active');
                    renderActiveChat();
                });
            });

            // Auto-open specific chat if URL parameter is present (e.g. ?chat=1 for Ali Raza)
            const urlParams = new URLSearchParams(window.location.search);
            const chatParam = urlParams.get('chat') || urlParams.get('open');
            if (chatParam) {
                let targetChatToOpen = null;
                if (chatParam === '1' || chatParam.toLowerCase().includes('ali')) {
                    targetChatToOpen = document.querySelector('.chat-item[data-chat-id="chat-1"]') || chatItems[0];
                } else if (chatParam === '4' || chatParam.toLowerCase().includes('sarah')) {
                    targetChatToOpen = document.querySelector('.chat-item[data-chat-id="chat-4"]') || chatItems[3];
                } else {
                    targetChatToOpen = document.querySelector(`.chat-item[data-chat-id="chat-${chatParam}"]`) ||
                                       document.querySelector(`.chat-item[data-chat-id="${chatParam}"]`);
                }
                if (targetChatToOpen) {
                    targetChatToOpen.click();
                }
            }

            // Action: Confirm Clear Chat
            const confirmClearBtn = document.getElementById('confirmClearChatBtn');
            if (confirmClearBtn) {
                confirmClearBtn.addEventListener('click', () => {
                    clearedChats[activeChatId] = true;
                    chatMessagesData[activeChatId] = [];
                    localStorage.setItem('cleared_chats', JSON.stringify(clearedChats));
                    localStorage.setItem('chat_messages_data', JSON.stringify(chatMessagesData));

                    const activeItem = document.querySelector(`.chat-item[data-chat-id="${activeChatId}"]`);
                    if (activeItem) {
                        const preview = activeItem.querySelector('.chat-item-preview');
                        if (preview) preview.textContent = 'Chat cleared';
                        const badge = activeItem.querySelector('.unread-badge');
                        if (badge) badge.remove();
                    }

                    closeClearChatModal();
                    renderActiveChat();
                    showToast(`Chat with ${activeUserName} has been cleared.`);
                });
            }

            // Action: Confirm Block / Unblock User
            const confirmBlockBtn = document.getElementById('confirmBlockUserBtn');
            if (confirmBlockBtn) {
                confirmBlockBtn.addEventListener('click', () => {
                    if (isUnblockingState) {
                        delete blockedUsers[activeChatId];
                        localStorage.setItem('blocked_users', JSON.stringify(blockedUsers));
                        closeBlockUserModal();
                        renderActiveChat();
                        showToast(`${activeUserName} has been unblocked.`);
                    } else {
                        blockedUsers[activeChatId] = true;
                        localStorage.setItem('blocked_users', JSON.stringify(blockedUsers));
                        closeBlockUserModal();
                        renderActiveChat();
                        showToast(`${activeUserName} has been blocked.`);
                    }
                });
            }

            // Action: Confirm Report User
            const confirmReportBtn = document.getElementById('confirmReportUserBtn');
            if (confirmReportBtn) {
                confirmReportBtn.addEventListener('click', () => {
                    closeReportModal();
                    showToast(`Thank you. Your report regarding ${activeUserName} has been submitted.`);
                });
            }

            // Action: Attach file listener
            const attachBtn = document.getElementById('attachFileBtn');
            const fileInput = document.getElementById('chatFileInput');
            if (attachBtn && fileInput) {
                attachBtn.addEventListener('click', () => fileInput.click());
                fileInput.addEventListener('change', handleFileSelect);
            }

            // Action: Emoji button listener & pickers
            const emojiToggleBtn = document.getElementById('emojiToggleBtn');
            if (emojiToggleBtn) {
                emojiToggleBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    toggleEmojiPicker();
                });
            }

            document.querySelectorAll('.emoji-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    const emoji = btn.textContent.trim();
                    const chatInput = document.querySelector('.chat-input');
                    if (chatInput) {
                        chatInput.value += emoji;
                        chatInput.focus();
                    }
                });
            });

            // Action: Send Message
            const sendBtn = document.getElementById('sendMessageBtn');
            const chatInput = document.querySelector('.chat-input');

            const sendMessage = () => {
                const text = chatInput ? chatInput.value.trim() : '';
                if ((!text && !currentAttachment) || blockedUsers[activeChatId]) return;

                if (!chatMessagesData[activeChatId]) chatMessagesData[activeChatId] = [];
                const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                const newMsg = { type: 'sent', time: timeStr };
                if (text) newMsg.text = text;
                if (currentAttachment) newMsg.image = currentAttachment.dataUrl;

                chatMessagesData[activeChatId].push(newMsg);
                delete clearedChats[activeChatId];
                localStorage.setItem('cleared_chats', JSON.stringify(clearedChats));
                localStorage.setItem('chat_messages_data', JSON.stringify(chatMessagesData));

                if (chatInput) chatInput.value = '';
                removeAttachment();
                hideEmojiPicker();

                const activeItem = document.querySelector(`.chat-item[data-chat-id="${activeChatId}"]`);
                if (activeItem) {
                    const preview = activeItem.querySelector('.chat-item-preview');
                    if (preview) preview.textContent = text || 'Sent an attachment';
                    const timeElem = activeItem.querySelector('.chat-item-time');
                    if (timeElem) timeElem.textContent = 'Just now';
                }

                renderActiveChat();

                triggerSimulatedBuyerReply(activeChatId);
            };

            if (sendBtn) sendBtn.addEventListener('click', sendMessage);
            if (chatInput) {
                chatInput.addEventListener('keypress', (e) => {
                    if (e.key === 'Enter') sendMessage();
                });
            }

            // Render initial active chat state
            renderActiveChat();
        });
    </script>
    <x-footer />
</body>
</html>
