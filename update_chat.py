import sys, re

file_path = 'c:/Users/ALI_s Computer/Desktop/Pet-clinic/resources/views/seller-messages.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Add context card price HTML
old_context_card = '''                <!-- Context Card -->
                <div class="chat-context-card">
                    <img src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever Puppy" class="chat-context-img" onerror="this.src='https://images.unsplash.com/photo-1600804340584-c7db2eacf0bf?auto=format&fit=crop&w=100&q=80'">
                    <div class="chat-context-details">
                        <h4>Golden Retriever Puppy</h4>
                        <p>Lahore</p>
                    </div>
                </div>'''

new_context_card = '''                <!-- Context Card -->
                <div class="chat-context-card">
                    <img src="{{ asset('images/card_golden.jpg') }}" alt="Golden Retriever Puppy" class="chat-context-img" onerror="this.src='https://images.unsplash.com/photo-1600804340584-c7db2eacf0bf?auto=format&fit=crop&w=100&q=80'">
                    <div class="chat-context-details" style="flex-grow: 1;">
                        <h4>Golden Retriever Puppy</h4>
                        <p>Lahore</p>
                    </div>
                    <div class="chat-context-price" style="font-weight: 700; color: var(--primary-green); white-space: nowrap;">
                        Rs. 85,000
                    </div>
                </div>'''

content = content.replace(old_context_card, new_context_card)

# 2. Add Back Button to chat header
old_chat_header = '''                <!-- Chat Header -->
                <div class="chat-header">
                    <div class="chat-header-info">
                        <img src="https://ui-avatars.com/api/?name=Ali+Raza&background=random" alt="Ali Raza" class="chat-avatar">'''

new_chat_header = '''                <!-- Chat Header -->
                <div class="chat-header">
                    <div class="chat-header-info">
                        <button class="chat-back-btn" onclick="document.body.classList.remove('chat-active')" style="display: none; background: none; border: none; cursor: pointer; padding-right: 12px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </button>
                        <img src="https://ui-avatars.com/api/?name=Ali+Raza&background=random" alt="Ali Raza" class="chat-avatar">'''

content = content.replace(old_chat_header, new_chat_header)

# 3. Add JS to open chat
old_chat_item = '<div class="chat-item active">'
new_chat_item = '<div class="chat-item active" onclick="document.body.classList.add(\'chat-active\')">'
content = content.replace(old_chat_item, new_chat_item)
old_chat_item2 = '<div class="chat-item">'
new_chat_item2 = '<div class="chat-item" onclick="document.body.classList.add(\'chat-active\')">'
content = content.replace(old_chat_item2, new_chat_item2)

# 4. Add Mobile CSS
media_query = '''
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
            }
            .chat-window {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 1000;
                background: #fafafa;
                height: 100vh;
                margin: 0;
                padding: 0;
                border: none;
                border-radius: 0;
            }
            body.chat-active .chat-window {
                display: flex;
            }
            .chat-back-btn {
                display: flex !important;
                align-items: center;
                justify-content: center;
            }
            .chat-header {
                padding: 16px;
            }
            .chat-context-card {
                margin: 16px 16px 0 16px;
            }
            .chat-messages {
                padding: 16px;
            }
            .chat-input-wrapper {
                padding: 16px;
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
        }
'''

if '</style>' in content and '@media (max-width: 768px)' not in content:
    content = content.replace('</style>', media_query + '\n    </style>')

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Updates applied successfully.")
