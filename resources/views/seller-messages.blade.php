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
    
        @media (max-width: 768px) {
            .main-content {
                padding: 16px;
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
                min-height: calc(100vh - 200px);
                margin-bottom: 0;
            }
            .chat-sidebar {
                width: 100%;
                border-right: none;
                background-color:#f7f9f8;
            }
            .chat-window {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 10000;
                background: #fafafa;
                margin: 0;
                padding: 0;
                border: none;
                border-radius: 0;
            }
            body.chat-active .chat-window {
                display: flex;
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
            <button class="btn-notification">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </button>
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
                        <button class="chat-tab">New</button>
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
                        <button class="chat-back-btn" onclick="document.body.classList.remove('chat-active')" style="display: none; background: none; border: none; cursor: pointer; padding-right: 12px;">
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
                        <div class="dropdown-item">
                            <img src="{{ asset('images/minus-circle 1.svg') }}" alt="Clear chat">
                            <span>Clear chat</span>
                        </div>
                        <div class="dropdown-item">
                            <img src="{{ asset('images/hand 1.svg') }}" alt="Report">
                            <span>Report</span>
                        </div>
                        <div class="dropdown-item text-red">
                            <img src="{{ asset('images/ban.svg') }}" alt="Block">
                            <span>Block</span>
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
                <div class="chat-input-wrapper">
                    <div class="chat-input-box">
                        <button class="icon-btn">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M8 14s1.5 2 4 2 4-2 4-2"></path>
                                <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                <line x1="15" y1="9" x2="15.01" y2="9"></line>
                            </svg>
                        </button>
                        <input type="text" class="chat-input" placeholder="Write a reply...">
                        <button class="icon-btn">
                            <img src="{{ asset('images/clip-icon.svg') }}" alt="Attach">
                        </button>
                        <button class="send-btn">
                            <img src="{{ asset('images/send-icon.svg') }}" alt="Send">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main></div></div>

    <script>
        function toggleDropdown() {
            document.getElementById('chatDropdown').classList.toggle('show');
        }

        // Close dropdown when clicking outside
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
        }

        // Chat Tabs Filtering
        document.addEventListener('DOMContentLoaded', () => {
            const chatTabs = document.querySelectorAll('.chat-tab');
            const chatItems = document.querySelectorAll('.chat-item');

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
        });
    </script>
    <x-footer />
</body>
</html>
