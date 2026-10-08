import sys

file_path = 'c:/Users/ALI_s Computer/Desktop/Pet-clinic/resources/views/dashboard.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

import re

# Find the start of Recent Favorites CSS
start_idx = content.find('/* Recent Favorites */')
# Find the start of the mobile media query
end_idx = content.find('@media (max-width: 768px) {')

if start_idx != -1 and end_idx != -1:
    desktop_css = '''/* Recent Favorites */
        .favorite-item {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #eee;
        }
        .favorite-item:last-child {
            border-bottom: none;
        }
        .fav-badge {
            display: none;
        }
        .fav-img {
            width: 120px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }
        .fav-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .fav-title {
            font-weight: 600;
            font-size: 16px;
            color: #333;
            margin-bottom: 4px;
        }
        .fav-subtitle {
            color: var(--text-gray);
            font-size: 14px;
        }
        .fav-meta {
            display: flex;
            gap: 16px;
            margin-top: 8px;
        }
        .fav-meta span {
            color: var(--text-gray);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .fav-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
        }
        .fav-price {
            font-weight: 700;
            font-size: 18px;
            color: var(--primary-green);
        }
        .fav-price-mobile {
            display: none;
        }
        .fav-heart {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            cursor: pointer;
            transition: all 0.2s;
        }
        .fav-heart:hover {
            background-color: #ffeef0;
            color: #ff4b68;
        }

        .btn-sell-mobile {
            display: none;
        }

        '''

    # We need to preserve everything BEFORE /* Recent Favorites */
    # and everything from @media onwards.
    # Wait, before @media there is .btn-sell-mobile { display: none; } which is included in my desktop_css above.
    
    new_content = content[:start_idx] + desktop_css + content[end_idx:]
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print("Desktop CSS restored successfully.")
else:
    print("Failed to find boundaries.")
