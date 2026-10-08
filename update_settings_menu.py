import re

file_path = 'c:/Users/ALI_s Computer/Desktop/Pet-clinic/resources/views/seller-settings.blade.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace Contact & Location with Contact <span class="hide-on-mobile">& Location</span>
content = content.replace('Contact & Location', 'Contact<span class="hide-on-mobile"> & Location</span>')

# Update menu-item CSS in the media query
pattern = r'(\.menu-item\s*\{[^}]*width:\s*104px;[^}]*\})'
def repl(m):
    return '''.menu-item {
                flex-direction: column;
                margin: 0;
                padding: 0;
                width: 108px;
                height: 68px;
                flex-shrink: 0;
                background-color: white;
                border-radius: 12px;
                gap: 8px;
                justify-content: center;
                align-items: center;
                border: 1px solid var(--border-color);
            }
            .hide-on-mobile { display: none; }'''

content = re.sub(pattern, repl, content, count=1)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)
print('Updated menu item sizing and contact text.')
