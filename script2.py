import sys, re

file_path = 'c:/Users/ALI_s Computer/Desktop/Pet-clinic/resources/views/dashboard.blade.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace using regex between .bottom-grid { ... } and .btn-sell-mobile { ... } inside the media query
pattern = r"(\.bottom-grid\s*\{\s*grid-template-columns:\s*1fr;\s*\})(.*?)(\.btn-sell-mobile\s*\{\s*width:\s*100%;\s*\})"

new_css = '''
            .favorites-grid-mobile {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 12px;
            }
            .favorite-item {
                flex-direction: column;
                align-items: stretch;
                position: relative;
                padding: 0;
                overflow: hidden;
            }
            .fav-img {
                width: 100%;
                height: 140px;
                border-radius: 12px 12px 0 0;
                object-fit: cover;
            }
            .fav-badge {
                position: absolute;
                top: 8px;
                left: 8px;
                background-color: white;
                color: #333;
                font-size: 8px;
                font-weight: 700;
                padding: 4px 8px;
                border-radius: 12px;
                z-index: 10;
                letter-spacing: 0.5px;
            }
            .fav-info {
                padding: 8px;
                padding-bottom: 12px;
            }
            .fav-title {
                font-size: 11px;
                font-weight: 600;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .fav-subtitle {
                font-size: 10px;
                margin-bottom: 2px;
            }
            .fav-price-mobile {
                display: block;
                font-size: 13px;
                font-weight: 700;
                color: var(--primary-green);
                margin-bottom: 6px;
            }
            .fav-meta {
                flex-wrap: wrap;
                gap: 4px;
                margin-top: 4px;
                display: flex;
            }
            .fav-meta span {
                font-size: 9px;
                color: #666;
                display: flex;
                align-items: center;
                gap: 2px;
            }
            .fav-meta span i {
                font-size: 10px;
            }
            .fav-meta span:nth-child(1) {
                order: 3;
                width: 100%;
                margin-top: 4px;
                border-top: 1px solid #eee;
                padding-top: 6px;
            }
            .fav-meta span:nth-child(2) {
                order: 1;
                margin-right: 6px;
            }
            .fav-meta span:nth-child(3) {
                order: 2;
            }
            .fav-actions {
                display: contents;
            }
            .fav-price {
                display: none !important;
            }
            .fav-heart {
                position: absolute;
                top: 8px;
                right: 8px;
                width: 24px;
                height: 24px;
                background-color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                display: flex !important;
                z-index: 10;
            }
            .fav-heart i {
                color: #666;
                font-size: 12px;
            }
            '''

match = re.search(pattern, content, re.DOTALL)
if match:
    new_content = content[:match.start(2)] + new_css + content[match.end(2):]
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print("Replaced successfully.")
else:
    print("Pattern not found.")

