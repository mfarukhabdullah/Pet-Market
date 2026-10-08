import re

file_path = 'c:/Users/ALI_s Computer/Desktop/Pet-clinic/resources/views/seller-settings.blade.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

media_query = '''
        @media (max-width: 768px) {
            .welcome-banner {
                padding: 24px 20px;
                border-radius: 12px;
            }
            .welcome-text h1 {
                font-size: 22px;
            }
            .welcome-text p {
                font-size: 14px;
            }
            .btn-notification {
                display: none;
            }
            
            .settings-card {
                flex-direction: column;
                background: transparent;
                border: none;
            }
            
            .settings-menu {
                width: 100%;
                flex-direction: row;
                border-right: none;
                padding: 0 4px 4px 4px; /* Add slight padding for scroll visual */
                margin-bottom: 24px;
                overflow-x: auto;
                gap: 12px;
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            .settings-menu::-webkit-scrollbar {
                display: none;
            }
            
            .menu-item {
                flex-direction: column;
                margin: 0;
                padding: 16px 8px;
                width: 104px;
                flex-shrink: 0;
                background-color: white;
                border-radius: 12px;
                gap: 8px;
                justify-content: center;
                border: 1px solid var(--border-color);
            }
            .menu-item.active {
                background-color: #eaf7f0;
                border-color: #eaf7f0;
                color: var(--primary-green);
            }
            
            .settings-content {
                background: white;
                border: 1px solid var(--border-color);
                border-radius: 16px;
                padding: 24px 16px;
            }
            
            .cover-photo-area {
                height: 140px;
            }
            .btn-upload-cover {
                padding: 8px 12px;
                border-radius: 8px;
                bottom: 12px;
                right: 12px;
                font-size: 13px;
            }
            
            .profile-photo-area {
                margin-top: -40px;
                padding-left: 16px;
                align-items: flex-end;
                z-index: 2;
                position: relative;
            }
            .avatar-preview {
                width: 80px;
                height: 80px;
                border: 4px solid white;
            }
            .btn-change-photo {
                margin-bottom: 4px;
                border-radius: 8px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 16px;
            }
            
            .form-actions {
                flex-direction: row;
                gap: 12px;
                margin-top: 24px;
            }
            .btn-cancel, .btn-save {
                flex: 1;
                text-align: center;
                padding: 14px 0;
            }
        }
    </style>
'''

# Replace the closing style tag with the media query + closing style tag
new_content = content.replace('    </style>', media_query)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(new_content)
print('Updated seller-settings.blade.php')
