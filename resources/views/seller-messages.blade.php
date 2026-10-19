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
            gap: 8px;
        }

        .chat-item-name {
            font-weight: 600;
            font-size: 15px;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            min-width: 0;
            flex: 1;
        }

        /* USER PROMPT: "yr msg per timer  q a rha hai" */
        .chat-item-time {
            font-size: 11.5px;
            color: var(--text-gray);
            white-space: nowrap;
            flex-shrink: 0;
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

        /* USER PROMPT: "ya delete q ni ho rha" */
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
            position: relative;
            transition: all 0.25s ease;
        }

        .btn-dismiss-context {
            background: transparent;
            border: none;
            color: #94a3b8;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-left: 8px;
            flex-shrink: 0;
            font-size: 14px;
        }
        .btn-dismiss-context:hover {
            color: #ef4444;
            background: #fee2e2;
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

        /* USER PROMPT: "msg mainin ko deleta ta kuch or krny ky liye whats app wala feature dy do" */
        .msg-bubble-container {
            display: flex;
            flex-direction: column;
            max-width: 72%;
            position: relative;
            margin-bottom: 6px;
        }

        .msg-bubble-container.received {
            align-self: flex-start;
        }

        .msg-bubble-container.sent {
            align-self: flex-end;
        }

        .msg-bubble {
            padding: 10px 34px 10px 14px;
            border-radius: 16px;
            font-size: 14px;
            line-height: 1.5;
            position: relative;
            word-break: break-word;
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

        /* Hover actions for WhatsApp experience */
        .msg-bubble-container:hover .msg-actions-trigger,
        .msg-bubble-container:hover .msg-react-trigger {
            opacity: 1;
            pointer-events: auto;
        }

        .msg-actions-trigger {
            position: absolute;
            top: 6px;
            right: 8px;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.85);
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4b5563;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.15s ease, background 0.15s ease, transform 0.1s ease;
            z-index: 5;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }

        .msg-bubble-container.sent .msg-actions-trigger {
            background: rgba(0, 0, 0, 0.25);
            color: #ffffff;
        }

        .msg-actions-trigger:hover {
            transform: scale(1.1);
            background: #ffffff;
            color: #111827;
        }

        .msg-bubble-container.sent .msg-actions-trigger:hover {
            background: rgba(0, 0, 0, 0.45);
            color: #ffffff;
        }

        /* Quick React Button beside bubble */
        .msg-react-trigger {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6b7280;
            font-size: 13px;
            opacity: 0;
            pointer-events: none;
            transition: all 0.15s ease;
            z-index: 6;
        }

        .msg-bubble-container.sent .msg-react-trigger {
            left: -34px;
        }

        .msg-bubble-container.received .msg-react-trigger {
            right: -34px;
        }

        .msg-react-trigger:hover {
            background: #f8fafc;
            color: #f59e0b;
            transform: translateY(-50%) scale(1.12);
        }

        /* Floating Quick Reactions Palette */
        .msg-quick-reactions {
            position: absolute;
            bottom: calc(100% + 4px);
            background: #ffffff;
            border-radius: 30px;
            padding: 4px 8px;
            display: none;
            align-items: center;
            gap: 4px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            border: 1px solid #e5e7eb;
            z-index: 50;
            animation: popUpReaction 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        @keyframes popUpReaction {
            from { opacity: 0; transform: scale(0.8) translateY(6px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        .msg-bubble-container.sent .msg-quick-reactions {
            right: 0;
        }
        .msg-bubble-container.received .msg-quick-reactions {
            left: 0;
        }

        .msg-quick-reactions.show {
            display: flex;
        }

        .quick-react-emoji {
            font-size: 18px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 3px 5px;
            border-radius: 50%;
            transition: transform 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .quick-react-emoji:hover {
            transform: scale(1.35);
        }

        /* Floating WhatsApp Message Dropdown Menu */
        .msg-dropdown-menu {
            position: absolute;
            top: 32px;
            right: 8px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15), 0 8px 10px -6px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            width: 175px;
            padding: 6px 0;
            z-index: 100;
            display: none;
            animation: fadeInMenu 0.12s ease-out;
        }

        @keyframes fadeInMenu {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .msg-dropdown-menu.show {
            display: block;
        }

        .msg-dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 16px;
            font-size: 13.5px;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            transition: background 0.15s;
        }

        .msg-dropdown-item:hover {
            background: #f3f4f6;
        }

        .msg-dropdown-item i {
            width: 16px;
            font-size: 14px;
            color: #6b7280;
        }

        .msg-dropdown-item.danger {
            color: #dc2626;
        }

        .msg-dropdown-item.danger i {
            color: #dc2626;
        }

        /* Quoted Reply inside Message Bubble */
        .msg-quoted-preview {
            background: rgba(0, 0, 0, 0.06);
            border-left: 3.5px solid var(--primary-green);
            border-radius: 8px;
            padding: 6px 10px;
            margin-bottom: 6px;
            font-size: 12px;
            cursor: pointer;
            text-align: left;
        }

        .msg-bubble-container.sent .msg-quoted-preview {
            background: rgba(0, 0, 0, 0.18);
            border-left-color: #a7f3d0;
            color: rgba(255, 255, 255, 0.95);
        }

        .msg-quoted-sender {
            font-weight: 700;
            font-size: 11.5px;
            margin-bottom: 2px;
            color: var(--primary-green);
        }

        .msg-bubble-container.sent .msg-quoted-sender {
            color: #a7f3d0;
        }

        .msg-quoted-text {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 260px;
            opacity: 0.9;
        }

        /* Active Reaction Badge on Message Bubble */
        .msg-reaction-badge {
            position: absolute;
            bottom: -8px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 1px 6px;
            font-size: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: inline-flex;
            align-items: center;
            gap: 2px;
            cursor: pointer;
            z-index: 4;
            transition: transform 0.1s;
        }

        .msg-reaction-badge:hover {
            transform: scale(1.1);
        }

        .msg-bubble-container.sent .msg-reaction-badge {
            right: 12px;
        }

        .msg-bubble-container.received .msg-reaction-badge {
            left: 12px;
        }

        /* Deleted Message Bubble Style */
        .msg-bubble.deleted-message {
            font-style: italic;
            color: #9ca3af !important;
            background: #f3f4f6 !important;
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px dashed #d1d5db;
        }

        .msg-bubble.deleted-message i {
            font-size: 13px;
            color: #9ca3af;
        }

        /* Starred icon in message */
        .msg-starred-icon {
            font-size: 10px;
            color: #f59e0b;
            margin-left: 4px;
            vertical-align: middle;
        }

        /* Reply Bar above Chat Input (WhatsApp style) */
        .chat-reply-bar {
            display: none;
            align-items: center;
            justify-content: space-between;
            background: #f0fdf4;
            border-left: 4px solid var(--primary-green);
            border-top: 1px solid #dcfce7;
            border-right: 1px solid #dcfce7;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 8px 16px;
            margin-bottom: 8px;
            animation: slideDownReply 0.18s ease-out;
        }

        @keyframes slideDownReply {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .chat-reply-bar.show {
            display: flex;
        }

        .chat-reply-bar-content {
            flex-grow: 1;
            overflow: hidden;
            padding-right: 12px;
        }

        .chat-reply-bar-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary-green);
            margin-bottom: 2px;
        }

        .chat-reply-bar-snippet {
            font-size: 12.5px;
            color: #4b5563;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .chat-reply-bar-close {
            background: none;
            border: none;
            font-size: 15px;
            color: #9ca3af;
            cursor: pointer;
            border-radius: 50%;
            width: 26px;
            height: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s;
        }

        .chat-reply-bar-close:hover {
            background: #e5e7eb;
            color: #111827;
        }

        /* Delete Options Group in Modal */
        .delete-options-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
            margin-top: 14px;
        }

        .btn-delete-opt {
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: #111827;
            transition: all 0.15s;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-delete-opt:hover {
            background: #f9fafb;
        }

        .btn-delete-opt.danger {
            background: #dc2626;
            color: #ffffff;
            border-color: #dc2626;
        }

        .btn-delete-opt.danger:hover {
            background: #b91c1c;
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
                    @forelse($conversations as $conv)
                        @php
                            $otherUser = $conv->otherParticipant($user->id);
                            $isActive = $activeConversation && $activeConversation->id === $conv->id;
                            // USER PROMPT: "yr msg kisy ko bhi live recieve ni ho rhy hain"
                            $unreadCount = $conv->messages()->where('sender_id', '!=', $user->id)->where('is_read', false)->count();
                        @endphp
                        {{-- USER PROMPT: "yr msg kisy ko bhi live recieve ni ho rhy hain" --}}
                        <a href="{{ route('seller.messages', ['conversation_id' => $conv->id]) }}" data-chat-id="chat-{{ $conv->id }}" class="chat-item {{ $isActive ? 'active' : '' }}" style="text-decoration:none; color:inherit;">
                            <img src="{{ $otherUser->avatar_url }}" alt="{{ $otherUser->name }}" class="chat-avatar" onerror="this.src='https://ui-avatars.com/api/?name=' . urlencode($otherUser->name) . '&background=random'">
                            <div class="chat-item-info">
                                <div class="chat-item-header">
                                    <span class="chat-item-name">{{ $otherUser->name }}</span>
                                    {{-- USER PROMPT: "yr msg per timer  q a rha hai" --}}
                                    <span class="chat-item-time">{{ $conv->formatted_time }}</span>
                                </div>
                                <div class="chat-item-pet">{{ $conv->listing ? $conv->listing->title : 'Listing' }}</div>
                                <div class="chat-item-preview">{{ $conv->latestMessage ? Str::limit($conv->latestMessage->body ?: $conv->latestMessage->message, 30) : 'No messages yet' }}</div>
                            </div>
                            @if($unreadCount > 0)
                                <div class="unread-badge">{{ $unreadCount }}</div>
                            @endif
                        </a>
                    @empty
                        <div style="text-align: center; padding: 40px 16px; color: #64748b; font-size: 14px;">
                            No conversations yet.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Right Window -->
            <div class="chat-window">
                <!-- Chat Header -->
                <div class="chat-header">
                    <div class="chat-header-info">
                        @php
                            $activeOtherUser = $activeConversation ? $activeConversation->otherParticipant($user->id) : null;
                            $activeListing = $activeConversation ? $activeConversation->listing : null;
                        @endphp
                        <button class="chat-back-btn" onclick="document.body.classList.remove('chat-active'); document.querySelector('.chat-container')?.classList.remove('chat-active'); document.querySelector('.chat-window')?.classList.remove('active');" style="display: none; background: none; border: none; cursor: pointer; padding-right: 12px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </button>
                        <img src="{{ $activeOtherUser ? $activeOtherUser->avatar_url : 'https://ui-avatars.com/api/?name=Chat&background=random' }}" alt="{{ $activeOtherUser ? $activeOtherUser->name : 'Chat' }}" class="chat-avatar" onerror="this.src='https://ui-avatars.com/api/?name=Chat&background=random'">
                        <div class="chat-header-text">
                            <h3>{{ $activeOtherUser ? $activeOtherUser->name : 'No conversation selected' }}</h3>
                            <p>{{ $activeOtherUser ? ($activeOtherUser->role === 'seller' ? 'Verified Seller' : 'Buyer Inquiry') . ' • Trust ' . $activeOtherUser->trust_score . '%' : 'Select a conversation from the left' }}</p>
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
                        {{-- USER PROMPT: "msg mainin ko deleta ta kuch or krny ky liye whats app wala feature dy do" --}}
                        <div class="dropdown-item" id="deleteChatOption" onclick="openDeleteConvModal()">
                            <i class="fa-regular fa-trash-can" style="font-size: 15px; color: #dc2626;"></i>
                            <span style="color: #dc2626;">Delete chat</span>
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
                @if($activeListing)
                {{-- USER PROMPT: "ya delete q ni ho rha" --}}
                <div class="chat-context-card" id="chatContextCard">
                    <img src="{{ $activeListing->primary_image_url }}" alt="{{ $activeListing->title }}" class="chat-context-img" onerror="this.src='{{ asset('images/pets/golden-retriever.jpg') }}'">
                    <div class="chat-context-details" style="flex-grow: 1;">
                        <h4><a href="{{ route('pet.details', ['slug' => $activeListing->slug ?: $activeListing->id]) }}" style="color:inherit; text-decoration:none;">{{ $activeListing->title }}</a></h4>
                        <p>{{ $activeListing->city }}</p>
                    </div>
                    <div class="chat-context-price" style="font-weight: 700; color: var(--primary-green); white-space: nowrap;">
                        {{ $activeListing->formatted_price }}
                    </div>
                    <button type="button" class="btn-dismiss-context" onclick="dismissContextCard(event)" title="Dismiss listing card">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                @endif

                <!-- Messages -->
                <div class="chat-messages">
                    @forelse($messages as $msg)
                        @php
                            $isSent = $msg->sender_id === $user->id;
                        @endphp
                        <div class="msg-bubble-container {{ $isSent ? 'sent' : 'received' }}">
                            <div class="msg-bubble">
                                @if($msg->type === 'offer')
                                    <div style="background: rgba(20, 122, 77, 0.08); padding: 10px 14px; border-radius: 8px; margin-bottom: 8px; border-left: 3px solid #147A4D;">
                                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #147A4D;">Price Offer Received</div>
                                        <div style="font-size: 18px; font-weight: 800; color: #17211C; margin: 4px 0;">{{ $msg->formatted_offer_amount }}</div>
                                        <div style="font-size: 12px; color: #64748b;">Status: <strong>{{ ucfirst($msg->offer_status) }}</strong></div>
                                        @if(!$isSent && $msg->offer_status === 'pending')
                                            <div style="margin-top: 8px; display: flex; gap: 8px;">
                                                <form action="{{ route('chat.respond-offer', ['messageId' => $msg->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="accepted">
                                                    <button type="submit" style="background:#147A4D; color:#fff; border:none; padding:4px 12px; border-radius:6px; font-size:12px; cursor:pointer;">Accept</button>
                                                </form>
                                                <form action="{{ route('chat.respond-offer', ['messageId' => $msg->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit" style="background:#dc2626; color:#fff; border:none; padding:4px 12px; border-radius:6px; font-size:12px; cursor:pointer;">Decline</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                @if($msg->attachment_path)
                                    <img src="{{ $msg->attachment_path }}" alt="Attachment" class="msg-attached-img" onclick="openImageLightboxModal('{{ $msg->attachment_path }}')">
                                @endif
                                <div>{{ $msg->body ?: $msg->message }}</div>
                                @if($msg->is_flagged)
                                    <div style="color: #dc2626; font-size: 11px; margin-top: 4px; font-weight: 600;">
                                        <i class="fa-solid fa-triangle-exclamation"></i> Warning: Never send advance money via JazzCash or Easypaisa before meeting.
                                    </div>
                                @endif
                                <span class="msg-time">
                                    {{ $msg->created_at->format('h:i A') }}
                                    @if($isSent)
                                        @if($msg->is_read)
                                            <i class="fa-solid fa-check-double" style="color:#38bdf8; font-size:11px; margin-left:3px;" title="Read"></i>
                                        @else
                                            <i class="fa-solid fa-check" style="font-size:11px; margin-left:3px; opacity:0.7;" title="Sent"></i>
                                        @endif
                                    @endif
                                </span>
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; color: #94a3b8; padding: 40px;">
                            Start this conversation by sending a message below.
                        </div>
                    @endforelse
                </div>

                <!-- Input Area -->
                <form action="{{ route('chat.send-message') }}" method="POST" class="chat-input-wrapper" id="chatInputForm" novalidate onsubmit="event.preventDefault(); return false;" style="position: relative;">
                    @csrf
                    <input type="hidden" name="conversation_id" value="{{ $activeConversation ? $activeConversation->id : '' }}">
                    
                    {{-- USER PROMPT: "msg mainin ko deleta ta kuch or krny ky liye whats app wala feature dy do" --}}
                    <!-- WhatsApp-Style Quoted Reply Bar -->
                    <div class="chat-reply-bar" id="chatReplyBar">
                        <div class="chat-reply-bar-content">
                            <div class="chat-reply-bar-title" id="replyBarSender">Replying to Ali Raza</div>
                            <div class="chat-reply-bar-snippet" id="replyBarSnippet">Message preview here...</div>
                        </div>
                        <button type="button" class="chat-reply-bar-close" onclick="cancelReply()" title="Cancel reply">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

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
                        <input type="text" name="message" class="chat-input" placeholder="Write a reply..." autocomplete="off">
                        <button type="button" class="send-btn" id="sendMessageBtn" title="Send Message">
                            <img src="{{ asset('images/send-icon.svg') }}" alt="Send">
                        </button>
                    </div>
                </form>
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

    {{-- USER PROMPT: "msg mainin ko deleta ta kuch or krny ky liye whats app wala feature dy do" --}}
    <!-- WhatsApp-Style Delete Message Modal -->
    <div id="deleteMessageModal" class="modal-backdrop">
        <div class="modal-card" style="max-width: 420px; padding: 24px;">
            <button type="button" class="modal-close-icon" onclick="closeDeleteMsgModal()"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-icon-wrapper danger">
                <i class="fa-regular fa-trash-can"></i>
            </div>
            <h3 class="modal-title" style="margin-bottom: 6px;">Delete message?</h3>
            <p class="modal-message" id="deleteMsgModalDesc" style="margin-bottom: 16px; font-size: 13.5px; color: #6b7280;">
                You can delete messages for everyone or just for yourself.
            </p>
            <div class="delete-options-group">
                <button type="button" class="btn-delete-opt danger" id="btnDeleteForEveryone" onclick="confirmDeleteMsg('for_everyone')">
                    <i class="fa-solid fa-users"></i> Delete for everyone
                </button>
                <button type="button" class="btn-delete-opt" id="btnDeleteForMe" onclick="confirmDeleteMsg('for_me')">
                    <i class="fa-solid fa-user"></i> Delete for me
                </button>
                <button type="button" class="btn-delete-opt" style="border:none; color:#6b7280; margin-top:4px;" onclick="closeDeleteMsgModal()">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    <!-- WhatsApp-Style Delete Conversation Modal -->
    <div id="deleteConversationModal" class="modal-backdrop">
        <div class="modal-card">
            <button type="button" class="modal-close-icon" onclick="closeDeleteConvModal()"><i class="fa-solid fa-xmark"></i></button>
            <div class="modal-icon-wrapper danger">
                <i class="fa-solid fa-trash-can"></i>
            </div>
            <h3 class="modal-title">Delete chat?</h3>
            <p class="modal-message">Are you sure you want to delete the chat with <strong id="deleteConvUserName">User</strong>? All messages in this conversation will be permanently deleted.</p>
            <div class="modal-actions">
                <button type="button" class="btn-modal btn-modal-cancel" onclick="closeDeleteConvModal()">Cancel</button>
                <button type="button" class="btn-modal btn-modal-danger" id="confirmDeleteConvBtn" onclick="confirmDeleteConversation()">Delete Chat</button>
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
        // USER PROMPT: "yr msg kisy ko bhi live recieve ni ho rhy hain"
        @php
            $currentOtherUser = $activeConversation ? $activeConversation->otherParticipant($user->id) : null;
            $currentListing = $activeConversation ? $activeConversation->listing : null;
            $initialDbMessages = $messages->map(function($m) use ($user) {
                $isSent = $m->sender_id === $user->id;
                return [
                    'id' => $m->id,
                    'type' => $isSent ? 'sent' : 'received',
                    'text' => $m->body ?: $m->message,
                    'time' => $m->created_at ? $m->created_at->format('h:i A') : '',
                    'isDeleted' => $m->type === 'deleted',
                    'is_read' => (bool) $m->is_read,
                    'msg_type' => $m->type,
                    'offer_amount' => $m->offer_amount,
                    'offer_status' => $m->offer_status,
                    'formatted_offer' => $m->formatted_offer_amount,
                    'sender_name' => $m->sender ? $m->sender->name : 'User',
                    'image' => $m->attachment_path,
                ];
            })->values();
        @endphp
        // State variables
        let activeChatId = '{{ $activeConversation ? "chat-" . $activeConversation->id : "chat-1" }}';
        let activeConversationDbId = {{ $activeConversation ? $activeConversation->id : 'null' }};
        let currentUserId = {{ $user->id }};
        let activeUserName = @json($currentOtherUser ? $currentOtherUser->name : '');
        let activePetName = @json($currentListing ? $currentListing->title : '');
        let activePetPrice = @json($currentListing ? $currentListing->formatted_price : '');
        let currentAttachment = null;
        let currentReplyingTo = null;
        let targetMsgIdxToDelete = null;

        // Retrieve stored state from localStorage
        let clearedChats = JSON.parse(localStorage.getItem('cleared_chats') || '{}');
        let blockedUsers = JSON.parse(localStorage.getItem('blocked_users') || '{}');
        // USER PROMPT: "yr msg kisy ko bhi live recieve ni ho rhy hain"
        try { localStorage.removeItem('chat_messages_data'); } catch(e) {}

        // Database messages are the single source of truth for active conversations!
        const chatMessagesData = {};
        @if($activeConversation)
            if (!clearedChats[activeChatId]) {
                chatMessagesData[activeChatId] = @json($initialDbMessages);
            } else {
                chatMessagesData[activeChatId] = [];
            }
        @else
            chatMessagesData['chat-1'] = [];
        @endif

        // Ensure cleared chats start empty
        Object.keys(clearedChats).forEach(id => {
            if (clearedChats[id]) {
                chatMessagesData[id] = [];
            }
        });

        // USER PROMPT: "yr msg kisy ko bhi live recieve ni ho rhy hain"
        // Real-time live polling function for receiving new messages and updating sidebar
        let isPolling = false;
        async function fetchLiveMessages() {
            if (isPolling) return;
            const chatForm = document.getElementById('chatInputForm');
            const convIdInput = chatForm ? chatForm.querySelector('input[name="conversation_id"]') : null;
            const convId = (convIdInput && convIdInput.value) ? convIdInput.value : activeConversationDbId;

            if (!convId) return;

            try {
                isPolling = true;
                const response = await fetch(`/chat/conversation/${convId}/messages`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) return;

                const data = await response.json();
                if (data && data.success && Array.isArray(data.messages)) {
                    const currentMsgs = chatMessagesData[activeChatId] || [];
                    const newMsgs = data.messages;

                    // Preserve any local reaction/starred states
                    newMsgs.forEach(nm => {
                        const existing = currentMsgs.find(cm => cm.id && cm.id === nm.id);
                        if (existing) {
                            if (existing.reactions) nm.reactions = existing.reactions;
                            if (existing.starred) nm.starred = existing.starred;
                        }
                    });

                    // Check if new messages arrived or message statuses changed
                    let hasChanged = currentMsgs.length !== newMsgs.length;
                    if (!hasChanged && newMsgs.length > 0) {
                        const lastCurrent = currentMsgs[currentMsgs.length - 1];
                        const lastNew = newMsgs[newMsgs.length - 1];
                        if (!lastCurrent || !lastNew || 
                            lastCurrent.id !== lastNew.id || 
                            lastCurrent.isDeleted !== lastNew.isDeleted || 
                            lastCurrent.text !== lastNew.text ||
                            lastCurrent.is_read !== lastNew.is_read) {
                            hasChanged = true;
                        }
                    }

                    if (hasChanged) {
                        chatMessagesData[activeChatId] = newMsgs;
                        // USER PROMPT: "clear chat ni ho rhy"
                        if (newMsgs.length > 0) {
                            delete clearedChats[activeChatId];
                            localStorage.setItem('cleared_chats', JSON.stringify(clearedChats));
                        }
                        renderActiveChat();
                    }

                    // Real-time Sidebar list update (previews & unread counters)
                    if (data.sidebar && Array.isArray(data.sidebar)) {
                        data.sidebar.forEach(item => {
                            const sideItem = document.querySelector(`.chat-item[data-chat-id="${item.chat_id}"]`);
                            if (sideItem) {
                                const previewEl = sideItem.querySelector('.chat-item-preview');
                                if (previewEl && item.latest_message) {
                                    previewEl.textContent = item.latest_message;
                                }
                                const timeEl = sideItem.querySelector('.chat-item-time');
                                if (timeEl && item.time_human) {
                                    timeEl.textContent = item.time_human;
                                }
                                let badgeEl = sideItem.querySelector('.unread-badge');
                                if (item.unread_count > 0) {
                                    if (!badgeEl) {
                                        badgeEl = document.createElement('div');
                                        badgeEl.className = 'unread-badge';
                                        sideItem.appendChild(badgeEl);
                                    }
                                    badgeEl.textContent = item.unread_count;
                                } else if (badgeEl) {
                                    badgeEl.remove();
                                }
                            }
                        });
                    }
                }
            } catch (err) {
                console.log('Chat live polling error:', err);
            } finally {
                isPolling = false;
            }
        }

        // Start live polling every 2.5 seconds
        setInterval(fetchLiveMessages, 2500);

        function escapeHtml(str) {
            if (!str) return '';
            return String(str)
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        function toggleDropdown() {
            document.getElementById('chatDropdown').classList.toggle('show');
        }

        // Global click handler to close dropdowns and popups
        window.onclick = function(event) {
            if (!event.target.closest('.chat-options-btn') && !event.target.closest('.chat-dropdown')) {
                const dropdowns = document.getElementsByClassName("chat-dropdown");
                for (let i = 0; i < dropdowns.length; i++) {
                    dropdowns[i].classList.remove('show');
                }
            }
            if (!event.target.closest('#emojiPickerPopover') && !event.target.closest('#emojiToggleBtn')) {
                hideEmojiPicker();
            }
            if (!event.target.closest('.msg-actions-trigger') && !event.target.closest('.msg-dropdown-menu')) {
                document.querySelectorAll('.msg-dropdown-menu.show').forEach(el => el.classList.remove('show'));
            }
            if (!event.target.closest('.msg-react-trigger') && !event.target.closest('.msg-quick-reactions')) {
                document.querySelectorAll('.msg-quick-reactions.show').forEach(el => el.classList.remove('show'));
            }
        };

        function showToast(message) {
            const toast = document.getElementById('toastNotification');
            const toastMsg = document.getElementById('toastMessage');
            if (toast && toastMsg) {
                toastMsg.textContent = message;
                toast.classList.add('show');
                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }
        }

        // USER PROMPT: "msg mainin ko deleta ta kuch or krny ky liye whats app wala feature dy do"
        // WhatsApp Message Actions Handlers
        function toggleMsgDropdown(event, idx) {
            event.stopPropagation();
            event.preventDefault();
            document.querySelectorAll('.msg-dropdown-menu.show').forEach(el => {
                if (el.id !== `msgDropdown-${idx}`) el.classList.remove('show');
            });
            document.querySelectorAll('.msg-quick-reactions.show').forEach(el => el.classList.remove('show'));
            const menu = document.getElementById(`msgDropdown-${idx}`);
            if (menu) menu.classList.toggle('show');
        }

        function toggleQuickReactions(event, idx) {
            event.stopPropagation();
            event.preventDefault();
            document.querySelectorAll('.msg-quick-reactions.show').forEach(el => {
                if (el.id !== `quickReactions-${idx}`) el.classList.remove('show');
            });
            document.querySelectorAll('.msg-dropdown-menu.show').forEach(el => el.classList.remove('show'));
            const palette = document.getElementById(`quickReactions-${idx}`);
            if (palette) palette.classList.toggle('show');
        }

        function openReactionPalette(idx) {
            const menu = document.getElementById(`msgDropdown-${idx}`);
            if (menu) menu.classList.remove('show');
            const palette = document.getElementById(`quickReactions-${idx}`);
            if (palette) palette.classList.add('show');
        }

        function addReaction(event, idx, emoji) {
            if (event) event.stopPropagation();
            const msgs = chatMessagesData[activeChatId] || [];
            if (!msgs[idx]) return;
            if (!msgs[idx].reactions) msgs[idx].reactions = [];
            const pos = msgs[idx].reactions.indexOf(emoji);
            if (pos > -1) {
                msgs[idx].reactions.splice(pos, 1);
            } else {
                msgs[idx].reactions = [emoji];
            }
            localStorage.setItem('chat_messages_data', JSON.stringify(chatMessagesData));
            document.querySelectorAll('.msg-quick-reactions.show').forEach(el => el.classList.remove('show'));
            renderActiveChat();
        }

        function removeReaction(idx) {
            const msgs = chatMessagesData[activeChatId] || [];
            if (!msgs[idx]) return;
            msgs[idx].reactions = [];
            localStorage.setItem('chat_messages_data', JSON.stringify(chatMessagesData));
            renderActiveChat();
        }

        function copyMessageText(idx) {
            const msgs = chatMessagesData[activeChatId] || [];
            if (!msgs[idx]) return;
            const textToCopy = msgs[idx].text || '';
            if (navigator.clipboard && textToCopy) {
                navigator.clipboard.writeText(textToCopy);
            }
            document.querySelectorAll('.msg-dropdown-menu.show').forEach(el => el.classList.remove('show'));
            showToast('Message copied to clipboard');
        }

        function toggleStarMessage(idx) {
            const msgs = chatMessagesData[activeChatId] || [];
            if (!msgs[idx]) return;
            msgs[idx].starred = !msgs[idx].starred;
            localStorage.setItem('chat_messages_data', JSON.stringify(chatMessagesData));
            document.querySelectorAll('.msg-dropdown-menu.show').forEach(el => el.classList.remove('show'));
            showToast(msgs[idx].starred ? 'Message starred' : 'Message unstarred');
            renderActiveChat();
        }

        function startReplyMessage(idx) {
            const msgs = chatMessagesData[activeChatId] || [];
            if (!msgs[idx]) return;
            const m = msgs[idx];
            currentReplyingTo = {
                idx: idx,
                sender: m.type === 'sent' ? 'You' : activeUserName,
                text: m.text || (m.image ? 'Photo attachment' : '')
            };
            
            document.querySelectorAll('.msg-dropdown-menu.show').forEach(el => el.classList.remove('show'));
            
            const replyBar = document.getElementById('chatReplyBar');
            const senderEl = document.getElementById('replyBarSender');
            const snippetEl = document.getElementById('replyBarSnippet');
            const chatInput = document.querySelector('.chat-input');
            
            if (replyBar && senderEl && snippetEl) {
                senderEl.textContent = `Replying to ${currentReplyingTo.sender}`;
                snippetEl.textContent = currentReplyingTo.text;
                replyBar.classList.add('show');
            }
            if (chatInput) chatInput.focus();
        }

        function cancelReply() {
            currentReplyingTo = null;
            const replyBar = document.getElementById('chatReplyBar');
            if (replyBar) replyBar.classList.remove('show');
        }

        function openDeleteMsgModal(idx) {
            const msgs = chatMessagesData[activeChatId] || [];
            if (!msgs[idx]) return;
            targetMsgIdxToDelete = idx;
            const m = msgs[idx];
            document.querySelectorAll('.msg-dropdown-menu.show').forEach(el => el.classList.remove('show'));
            
            const btnForEveryone = document.getElementById('btnDeleteForEveryone');
            const modalDesc = document.getElementById('deleteMsgModalDesc');
            
            if (m.type === 'sent') {
                if (btnForEveryone) btnForEveryone.style.display = 'flex';
                if (modalDesc) modalDesc.textContent = 'You can delete this message for everyone or just for yourself.';
            } else {
                if (btnForEveryone) btnForEveryone.style.display = 'none';
                if (modalDesc) modalDesc.textContent = 'Delete this message for yourself? It will be removed from your chat.';
            }
            
            const modal = document.getElementById('deleteMessageModal');
            if (modal) modal.classList.add('show');
        }

        function closeDeleteMsgModal() {
            targetMsgIdxToDelete = null;
            const modal = document.getElementById('deleteMessageModal');
            if (modal) modal.classList.remove('show');
        }

        function confirmDeleteMsg(deleteType) {
            if (targetMsgIdxToDelete === null) return;
            const msgs = chatMessagesData[activeChatId] || [];
            const targetMsg = msgs[targetMsgIdxToDelete];
            if (!targetMsg) return;

            const msgId = targetMsg.id;

            if (deleteType === 'for_everyone') {
                targetMsg.isDeleted = true;
                targetMsg.text = 'This message was deleted';
                delete targetMsg.image;
                delete targetMsg.reply_to;
                targetMsg.reactions = [];
                showToast('Message deleted for everyone');
            } else {
                msgs.splice(targetMsgIdxToDelete, 1);
                showToast('Message deleted for you');
            }

            localStorage.setItem('chat_messages_data', JSON.stringify(chatMessagesData));
            
            // Sync with backend API if message ID or conversation exists
            if (msgId) {
                fetch(`/chat/message/${msgId}/delete`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ delete_type: deleteType })
                }).catch(e => console.log('Delete sync:', e));
            }

            closeDeleteMsgModal();
            renderActiveChat();
        }

        // WhatsApp Conversation Deletion
        function openDeleteConvModal() {
            const dropdown = document.getElementById('chatDropdown');
            if (dropdown) dropdown.classList.remove('show');
            const nameEl = document.getElementById('deleteConvUserName');
            if (nameEl) nameEl.textContent = activeUserName;
            const modal = document.getElementById('deleteConversationModal');
            if (modal) modal.classList.add('show');
        }

        function closeDeleteConvModal() {
            const modal = document.getElementById('deleteConversationModal');
            if (modal) modal.classList.remove('show');
        }

        // USER PROMPT: "ya delete q ni ho rha"
        function dismissContextCard(event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            const card = document.getElementById('chatContextCard') || document.querySelector('.chat-context-card');
            if (card) {
                card.style.transition = 'all 0.25s ease';
                card.style.opacity = '0';
                card.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 250);
            }
            try {
                localStorage.setItem('dismiss_context_' + activeChatId, 'true');
            } catch(e) {}
            showToast('Listing details dismissed.');
        }

        // USER PROMPT: "ya delete q ni ho rha"
        function setEmptyChatState() {
            activeUserName = '';
            activePetName = '';
            activePetPrice = '';
            const headerName = document.querySelector('.chat-header-text h3');
            if (headerName) headerName.textContent = 'No conversation selected';
            const headerSub = document.querySelector('.chat-header-text p');
            if (headerSub) headerSub.textContent = 'Select a conversation from the left';
            const headerAvatar = document.querySelector('.chat-header-info .chat-avatar');
            if (headerAvatar) headerAvatar.src = 'https://ui-avatars.com/api/?name=Chat&background=random';
            
            const optionsBtn = document.querySelector('.chat-options-btn');
            if (optionsBtn) optionsBtn.style.display = 'none';

            const card = document.getElementById('chatContextCard') || document.querySelector('.chat-context-card');
            if (card) card.style.display = 'none';

            const messagesContainer = document.querySelector('.chat-messages');
            if (messagesContainer) {
                messagesContainer.innerHTML = `
                    <div class="cleared-chat-notice" style="margin-top: auto; margin-bottom: auto; text-align: center; padding: 40px 16px;">
                        <i class="fa-regular fa-comments" style="font-size: 38px; color: #94a3b8; margin-bottom: 12px; display: block;"></i>
                        <p style="color: #64748b; font-size: 15px; font-weight: 500;">No conversation selected</p>
                        <span style="color: #94a3b8; font-size: 13px;">Choose a chat from the sidebar to view messages</span>
                    </div>
                `;
            }

            const inputWrapper = document.querySelector('.chat-input-wrapper');
            if (inputWrapper) inputWrapper.style.display = 'none';
        }

        // USER PROMPT: "ya delete q ni ho rha"
        async function confirmDeleteConversation() {
            const userNameToDelete = activeUserName || 'User';
            clearedChats[activeChatId] = true;
            chatMessagesData[activeChatId] = [];
            try {
                localStorage.setItem('cleared_chats', JSON.stringify(clearedChats));
                delete blockedUsers[activeChatId];
                localStorage.setItem('blocked_users', JSON.stringify(blockedUsers));
            } catch(e) {}
            
            closeDeleteConvModal();
            showToast('Deleting conversation...');

            // Call backend API if real conversation id is known
            const chatForm = document.getElementById('chatInputForm');
            const convIdInput = chatForm ? chatForm.querySelector('input[name="conversation_id"]') : null;
            // USER PROMPT: "clear chat ni ho rhy"
            const convId = (convIdInput && convIdInput.value) ? convIdInput.value : activeConversationDbId;

            if (convId) {
                try {
                    const response = await fetch(`/chat/conversation/${convId}/delete`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });
                    const data = await response.json();
                    if (data && data.success) {
                        showToast(`Chat with ${userNameToDelete} deleted.`);
                        setTimeout(() => {
                            window.location.href = "{{ route('seller.messages') }}";
                        }, 400);
                        return;
                    }
                } catch (e) {
                    console.log('Delete conv sync error:', e);
                    setTimeout(() => {
                        window.location.href = "{{ route('seller.messages') }}";
                    }, 400);
                    return;
                }
            }

            // Client-side fallback if no convId:
            const activeItem = document.querySelector(`.chat-item[data-chat-id="${activeChatId}"]`);
            if (activeItem) {
                activeItem.remove();
            }

            const remainingItems = document.querySelectorAll('.chat-item');
            if (remainingItems.length > 0) {
                const nextItem = remainingItems[0];
                if (nextItem.href) {
                    window.location.href = nextItem.href;
                } else {
                    nextItem.click();
                }
            } else {
                setEmptyChatState();
                showToast(`Chat with ${userNameToDelete} deleted.`);
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
        // USER PROMPT: "in chat when remove the functionality of automatic reply like when i send some message chatbot automatically reply remove this functonality"
        // Automatic simulated reply function removed

        // USER PROMPT: "ya delete q ni ho rha"
        // Render current active chat state with WhatsApp message controls
        function renderActiveChat() {
            const hasChat = document.querySelector('.chat-item.active') || document.querySelector('.chat-item');
            const chatForm = document.getElementById('chatInputForm');
            const convIdInput = chatForm ? chatForm.querySelector('input[name="conversation_id"]') : null;
            const hasConv = convIdInput && convIdInput.value;

            if (!hasChat && !hasConv && !activeUserName) {
                setEmptyChatState();
                return;
            }

            // Update Header Name
            const headerName = document.querySelector('.chat-header-text h3');
            if (headerName && activeUserName) headerName.textContent = activeUserName;
            
            const headerAvatar = document.querySelector('.chat-header-info .chat-avatar');
            if (headerAvatar && activeUserName) headerAvatar.src = `https://ui-avatars.com/api/?name=${encodeURIComponent(activeUserName)}&background=random`;

            // Update Context Card
            const card = document.getElementById('chatContextCard') || document.querySelector('.chat-context-card');
            const isContextDismissed = localStorage.getItem('dismiss_context_' + activeChatId) === 'true';
            if (card) {
                if (isContextDismissed || !activePetName) {
                    card.style.display = 'none';
                } else {
                    card.style.display = 'flex';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            }

            const ctxTitle = document.querySelector('.chat-context-details h4');
            if (ctxTitle && activePetName) {
                const link = ctxTitle.querySelector('a');
                if (link) {
                    link.textContent = activePetName;
                } else {
                    ctxTitle.textContent = activePetName;
                }
            }
            
            const ctxPrice = document.querySelector('.chat-context-price');
            if (ctxPrice && activePetPrice) ctxPrice.textContent = activePetPrice;

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
                    msgs.forEach((m, idx) => {
                        let imgHtml = m.image ? `<img src="${m.image}" alt="Attachment" class="msg-attached-img" onclick="openImageLightboxModal('${m.image}')">` : '';
                        let textHtml = m.text ? `<div>${escapeHtml(m.text)}</div>` : '';
                        
                        let replyHtml = '';
                        if (m.reply_to) {
                            replyHtml = `
                                <div class="msg-quoted-preview">
                                    <div class="msg-quoted-sender">${escapeHtml(m.reply_to.sender)}</div>
                                    <div class="msg-quoted-text">${escapeHtml(m.reply_to.text)}</div>
                                </div>
                            `;
                        }

                        let reactionsHtml = '';
                        if (m.reactions && m.reactions.length > 0) {
                            reactionsHtml = `<div class="msg-reaction-badge" title="Reaction" onclick="removeReaction(${idx})">${m.reactions.join('')}</div>`;
                        }

                        let starHtml = m.starred ? '<i class="fa-solid fa-star msg-starred-icon" title="Starred"></i>' : '';

                        // USER PROMPT: "yr msg kisy ko bhi live recieve ni ho rhy hain"
                        let checkHtml = '';
                        if (m.type === 'sent') {
                            if (m.is_read) {
                                checkHtml = '<i class="fa-solid fa-check-double" style="color:#38bdf8; font-size:11px; margin-left:3px;" title="Read"></i>';
                            } else {
                                checkHtml = '<i class="fa-solid fa-check" style="font-size:11px; margin-left:3px; opacity:0.7;" title="Sent"></i>';
                            }
                        }

                        let offerHtml = '';
                        if (m.msg_type === 'offer' || m.type_raw === 'offer' || m.offer_amount) {
                            offerHtml = `
                                <div style="background: rgba(20, 122, 77, 0.08); padding: 10px 14px; border-radius: 8px; margin-bottom: 8px; border-left: 3px solid #147A4D;">
                                    <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #147A4D;">Price Offer Received</div>
                                    <div style="font-size: 18px; font-weight: 800; color: #17211C; margin: 4px 0;">${escapeHtml(m.formatted_offer || ('PKR ' + m.offer_amount))}</div>
                                    <div style="font-size: 12px; color: #64748b;">Status: <strong>${escapeHtml(m.offer_status ? (m.offer_status.charAt(0).toUpperCase() + m.offer_status.slice(1)) : 'Pending')}</strong></div>
                                </div>
                            `;
                        }

                        if (m.isDeleted) {
                            html += `
                                <div class="msg-bubble-container ${m.type}" data-msg-idx="${idx}">
                                    <div class="msg-bubble deleted-message">
                                        <i class="fa-solid fa-ban"></i>
                                        <span>This message was deleted</span>
                                        <span class="msg-time">${m.time}</span>
                                    </div>
                                </div>
                            `;
                        } else {
                            html += `
                                <div class="msg-bubble-container ${m.type}" data-msg-idx="${idx}">
                                    <!-- WhatsApp-Style Quick Reaction Smiley (Hover) -->
                                    <button type="button" class="msg-react-trigger" title="React with emoji" onclick="toggleQuickReactions(event, ${idx})">
                                        <i class="fa-regular fa-face-smile"></i>
                                    </button>
                                    
                                    <!-- Quick Reaction Palette -->
                                    <div class="msg-quick-reactions" id="quickReactions-${idx}">
                                        <button type="button" class="quick-react-emoji" onclick="addReaction(event, ${idx}, '👍')">👍</button>
                                        <button type="button" class="quick-react-emoji" onclick="addReaction(event, ${idx}, '❤️')">❤️</button>
                                        <button type="button" class="quick-react-emoji" onclick="addReaction(event, ${idx}, '😂')">😂</button>
                                        <button type="button" class="quick-react-emoji" onclick="addReaction(event, ${idx}, '😮')">😮</button>
                                        <button type="button" class="quick-react-emoji" onclick="addReaction(event, ${idx}, '😢')">😢</button>
                                        <button type="button" class="quick-react-emoji" onclick="addReaction(event, ${idx}, '🙏')">🙏</button>
                                    </div>

                                    <!-- The Message Bubble -->
                                    <div class="msg-bubble">
                                        <!-- WhatsApp Dropdown Chevron Button -->
                                        <button type="button" class="msg-actions-trigger" title="Message options" onclick="toggleMsgDropdown(event, ${idx})">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </button>

                                        ${offerHtml}
                                        ${replyHtml}
                                        ${imgHtml}
                                        ${textHtml}
                                        <span class="msg-time">${m.time}${checkHtml}${starHtml}</span>

                                        <!-- WhatsApp Floating Dropdown Menu -->
                                        <div class="msg-dropdown-menu" id="msgDropdown-${idx}">
                                            <div class="msg-dropdown-item" onclick="startReplyMessage(${idx})">
                                                <i class="fa-solid fa-reply"></i>
                                                <span>Reply</span>
                                            </div>
                                            <div class="msg-dropdown-item" onclick="openReactionPalette(${idx})">
                                                <i class="fa-regular fa-face-smile"></i>
                                                <span>React</span>
                                            </div>
                                            <div class="msg-dropdown-item" onclick="copyMessageText(${idx})">
                                                <i class="fa-regular fa-copy"></i>
                                                <span>Copy</span>
                                            </div>
                                            <div class="msg-dropdown-item" onclick="toggleStarMessage(${idx})">
                                                <i class="${m.starred ? 'fa-solid' : 'fa-regular'} fa-star" style="${m.starred ? 'color:#f59e0b;' : ''}"></i>
                                                <span>${m.starred ? 'Unstar' : 'Star'}</span>
                                            </div>
                                            <div class="msg-dropdown-item danger" onclick="openDeleteMsgModal(${idx})">
                                                <i class="fa-regular fa-trash-can"></i>
                                                <span>Delete</span>
                                            </div>
                                        </div>

                                        ${reactionsHtml}
                                    </div>
                                </div>
                            `;
                        }
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
                        const timeText = item.querySelector('.chat-item-time')?.textContent || '';
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
                // USER PROMPT: "there is some issue like if we clear chat and after clearing chat when we send message sometimes it show some previous messages from buyer sort out this"
                const chatId = item.getAttribute('data-chat-id') || `chat-${index + 1}`;
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
                    activePetPrice = 'Rs. 85,000';

                    document.body.classList.add('chat-active');
                    const chatContainer = document.querySelector('.chat-container');
                    if (chatContainer) chatContainer.classList.add('chat-active');
                    const chatWin = document.querySelector('.chat-window');
                    if (chatWin) chatWin.classList.add('active');
                    renderActiveChat();
                });
            });

            // USER PROMPT: "ya delete q ni ho rha"
            // Set initial active chat from currently active item or URL
            const activeConvItem = document.querySelector('.chat-item.active') || chatItems[0];
            if (activeConvItem) {
                activeChatId = activeConvItem.getAttribute('data-chat-id') || activeChatId;
                if (!activeUserName) {
                    activeUserName = activeConvItem.getAttribute('data-user-name') || '';
                }
                if (!activePetName) {
                    activePetName = activeConvItem.getAttribute('data-pet-name') || '';
                }
            } else {
                const convIdInput = document.querySelector('input[name="conversation_id"]');
                if (!convIdInput || !convIdInput.value) {
                    setEmptyChatState();
                }
            }

            // USER PROMPT: "there is some issue like if we clear chat and after clearing chat when we send message sometimes it show some previous messages from buyer sort out this"
            // Never re-inject dummy buyer messages if conversation is cleared or empty
            if (!chatMessagesData[activeChatId]) {
                chatMessagesData[activeChatId] = [];
            }

            // USER PROMPT: "ya delete q ni ho rha"
            // USER PROMPT: "clear chat ni ho rhy"
            // Action: Confirm Clear Chat
            const confirmClearBtn = document.getElementById('confirmClearChatBtn');
            if (confirmClearBtn) {
                confirmClearBtn.addEventListener('click', async () => {
                    clearedChats[activeChatId] = true;
                    chatMessagesData[activeChatId] = [];
                    try {
                        localStorage.setItem('cleared_chats', JSON.stringify(clearedChats));
                    } catch(e) {}

                    const activeItem = document.querySelector(`.chat-item[data-chat-id="${activeChatId}"]`);
                    if (activeItem) {
                        const preview = activeItem.querySelector('.chat-item-preview');
                        if (preview) preview.textContent = 'Chat cleared';
                        const badge = activeItem.querySelector('.unread-badge');
                        if (badge) badge.remove();
                    }

                    // Call backend API if real conversation id is known
                    const chatForm = document.getElementById('chatInputForm');
                    const convIdInput = chatForm ? chatForm.querySelector('input[name="conversation_id"]') : null;
                    const convId = (convIdInput && convIdInput.value) ? convIdInput.value : activeConversationDbId;

                    closeClearChatModal();
                    renderActiveChat();
                    showToast(`Chat with ${activeUserName || 'user'} has been cleared.`);

                    if (convId) {
                        try {
                            await fetch(`/chat/conversation/${convId}/clear`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            });
                            if (typeof fetchLiveMessages === 'function') {
                                fetchLiveMessages();
                            }
                        } catch(e) {
                            console.log('Clear conv error:', e);
                        }
                    }
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

            // USER PROMPT: "yr msg kisy ko bhi live recieve ni ho rhy hain"
            // Action: Send Message
            const sendBtn = document.getElementById('sendMessageBtn');
            const chatInput = document.querySelector('.chat-input');
            const chatForm = document.getElementById('chatInputForm');

            const sendMessage = () => {
                const text = chatInput ? chatInput.value.trim() : '';
                if ((!text && !currentAttachment) || blockedUsers[activeChatId]) return;

                if (clearedChats[activeChatId] || !chatMessagesData[activeChatId]) {
                    chatMessagesData[activeChatId] = [];
                }
                const timeStr = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                const newMsg = { type: 'sent', time: timeStr, is_read: false };
                if (text) newMsg.text = text;
                if (currentAttachment) newMsg.image = currentAttachment.dataUrl;

                // Quoted reply attachment if active
                if (currentReplyingTo) {
                    newMsg.reply_to = {
                        sender: currentReplyingTo.sender,
                        text: currentReplyingTo.text
                    };
                    cancelReply();
                }

                chatMessagesData[activeChatId].push(newMsg);
                delete clearedChats[activeChatId];
                localStorage.setItem('cleared_chats', JSON.stringify(clearedChats));

                // Send via AJAX to backend if activeConversation exists
                const conversationIdInput = chatForm ? chatForm.querySelector('input[name="conversation_id"]') : null;
                const conversationId = (conversationIdInput && conversationIdInput.value) ? conversationIdInput.value : activeConversationDbId;

                const msgBody = text || (currentAttachment ? 'Photo attachment' : '');
                const msgImage = currentAttachment ? currentAttachment.dataUrl : null;

                if (conversationId && (text || currentAttachment)) {
                    fetch("{{ route('chat.send-message') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            conversation_id: conversationId,
                            body: msgBody,
                            message: msgBody,
                            image: msgImage
                        })
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data && data.success && data.formatted_message) {
                            newMsg.id = data.formatted_message.id;
                        }
                        // Instantly poll to sync server state
                        fetchLiveMessages();
                    })
                    .catch(err => console.log('Message sync:', err));
                }

                if (chatInput) {
                    chatInput.value = '';
                    chatInput.focus();
                }
                removeAttachment();
                hideEmojiPicker();

                const activeItem = document.querySelector(`.chat-item[data-chat-id="${activeChatId}"]`);
                if (activeItem) {
                    const preview = activeItem.querySelector('.chat-item-preview');
                    if (preview) preview.textContent = text || 'Sent an attachment';
                    const timeElem = activeItem.querySelector('.chat-item-time');
                    // USER PROMPT: "yr msg per timer  q a rha hai"
                    if (timeElem) timeElem.textContent = timeStr;
                }

                renderActiveChat();
            };


            if (chatForm) {
                chatForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    sendMessage();
                    return false;
                });
            }

            if (sendBtn) {
                sendBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    sendMessage();
                });
            }

            if (chatInput) {
                chatInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' && !e.shiftKey) {
                        e.preventDefault();
                        e.stopPropagation();
                        sendMessage();
                    }
                });
            }

            // Render initial active chat state
            renderActiveChat();
        });
    </script>
    <x-footer />
</body>
</html>
